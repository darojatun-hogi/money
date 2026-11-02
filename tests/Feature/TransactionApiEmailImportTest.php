<?php

namespace Tests\Feature;

use App\Http\Middleware\EnsureAppAccess;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Support\Facades\Artisan;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

// Impor transaksi dari email (n8n): penolakan duplikat via email_message_id dan wallet_fallback.
// Hanya tabel keuangan (koneksi default → sqlite di phpunit.xml); user Supabase tidak disentuh.
class TransactionApiEmailImportTest extends TestCase
{
    private const MIGRATIONS = [
        '2026_04_23_100000_create_categories_table.php',
        '2026_04_23_100001_create_transaction_names_table.php',
        '2026_04_23_100002_create_wallets_table.php',
        '2026_04_23_100003_create_transactions_table.php',
        '2026_04_24_000000_add_uuid_to_finance_tables.php',
        '2026_04_26_000000_add_transfer_fee_to_transactions_table.php',
        '2026_11_02_000001_add_email_message_id_to_transactions_table.php',
    ];

    protected function setUp(): void
    {
        parent::setUp();

        foreach (self::MIGRATIONS as $file) {
            Artisan::call('migrate', ['--path' => 'database/migrations/'.$file]);
        }

        Sanctum::actingAs((new User())->forceFill(['id' => 7, 'name' => 'M Darojatun Hogi']));
        $this->withoutMiddleware(EnsureAppAccess::class);
    }

    private function wallet(string $name, int $balance = 0, int $userId = 7): Wallet
    {
        return Wallet::create(['name' => $name, 'balance' => $balance, 'user_id' => $userId]);
    }

    private function store(array $data)
    {
        return $this->postJson('/api/transactions', [
            'type'             => 'outcome',
            'amount'           => 10370,
            'wallet_name'      => 'Jago',
            'description'      => 'QRIS ke PT Xtra Pembayaran Aman-Q',
            'date'             => '2026-10-25',
            'email_message_id' => '<202610251408.94275054912@smtp-relay.mailin.fr>',
            ...$data,
        ]);
    }

    public function test_outcome_from_email_is_stored_with_message_id(): void
    {
        $jago = $this->wallet('Jago', 100000);

        $this->store([])->assertCreated()->assertJsonPath('data.type', 'outcome');

        $tx = Transaction::sole();
        $this->assertSame('<202610251408.94275054912@smtp-relay.mailin.fr>', $tx->email_message_id);
        $this->assertSame(7, $tx->user_id);
        $this->assertSame('89630.00', $jago->fresh()->balance);
    }

    public function test_duplicate_email_is_rejected_and_balance_unchanged(): void
    {
        $jago = $this->wallet('Jago', 100000);

        $this->store([])->assertCreated();
        $this->store([])
            ->assertStatus(409)
            ->assertJsonPath('data.uuid', Transaction::sole()->uuid);

        $this->assertSame('89630.00', $jago->fresh()->balance);
    }

    public function test_same_message_id_from_other_user_is_not_a_duplicate(): void
    {
        $this->wallet('Jago', 100000);
        $other = $this->wallet('Jago', 0, 8);
        Transaction::create([
            'type' => 'outcome', 'amount' => 1, 'wallet_id' => $other->id, 'date' => '2026-10-01',
            'user_id' => 8, 'email_message_id' => '<202610251408.94275054912@smtp-relay.mailin.fr>',
        ]);

        $this->store([])->assertCreated();
    }

    public function test_transactions_without_message_id_are_not_deduplicated(): void
    {
        $this->wallet('Jago', 100000);

        $this->store(['email_message_id' => null])->assertCreated();
        $this->store(['email_message_id' => null])->assertCreated();

        $this->assertSame(2, Transaction::count());
    }

    public function test_transfer_without_fee_to_existing_wallet(): void
    {
        $jago = $this->wallet('Jago', 100000);
        $dana = $this->wallet('DANA');

        $this->store(['type' => 'transfer', 'amount' => 28000, 'to_wallet_name' => 'DANA', 'wallet_fallback' => 'Cash'])
            ->assertCreated()
            ->assertJsonPath('data.to_wallet.name', 'DANA')
            ->assertJsonPath('data.transfer_fee', '0.00');

        $this->assertSame('72000.00', $jago->fresh()->balance);
        $this->assertSame('28000.00', $dana->fresh()->balance);
    }

    public function test_missing_destination_wallet_falls_back_to_new_cash_wallet(): void
    {
        $this->wallet('Jago', 100000);

        $this->store(['type' => 'transfer', 'amount' => 50000, 'to_wallet_name' => 'BCA', 'wallet_fallback' => 'Cash'])
            ->assertCreated()
            ->assertJsonPath('data.to_wallet.name', 'Cash');

        $cash = Wallet::where('name', 'Cash')->sole();
        $this->assertSame(7, $cash->user_id);
        $this->assertSame('50000.00', $cash->balance);
    }

    public function test_fallback_reuses_existing_cash_wallet(): void
    {
        $this->wallet('Jago', 100000);
        $cash = $this->wallet('Cash', 5000);

        $this->store(['type' => 'transfer', 'amount' => 50000, 'to_wallet_name' => 'Cash', 'wallet_fallback' => 'Cash'])
            ->assertCreated();

        $this->assertSame(1, Wallet::where('name', 'Cash')->count());
        $this->assertSame('55000.00', $cash->fresh()->balance);
    }

    public function test_transfer_resolving_to_same_wallet_is_rejected(): void
    {
        $this->store(['type' => 'transfer', 'amount' => 50000, 'to_wallet_name' => 'BCA', 'wallet_fallback' => 'Cash'])
            ->assertStatus(422)
            ->assertJsonValidationErrors('to_wallet_name');

        $this->assertSame(0, Transaction::count());
    }

    public function test_missing_wallet_without_fallback_still_returns_422(): void
    {
        $this->store(['wallet_name' => 'Tidak Ada'])
            ->assertStatus(422)
            ->assertJsonValidationErrors('wallet_name');

        $this->assertSame(0, Wallet::count());
    }
}
