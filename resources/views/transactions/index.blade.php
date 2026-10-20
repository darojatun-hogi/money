@extends('template.master')

@section('content')
	<header class="mb-5">
		<h1 class="text-2xl font-semibold tracking-tight">Transaksi</h1>
		<p class="mt-1 text-sm text-base-content/70">Lihat pemasukan, pengeluaran, dan transfer yang sudah kamu catat.</p>
	</header>

	@php
		$totalIncome = $summary->total_income ?? 0;
		$totalOutcome = $summary->total_outcome ?? 0;
		$totalTransferFee = $summary->total_transfer_fee ?? 0;
		$totalOut = $totalOutcome + $totalTransferFee;
		$net = $totalIncome - $totalOut;
	@endphp

	<dl class="mb-4 grid grid-cols-1 gap-3 sm:grid-cols-2 xl:grid-cols-3">
		<div class="min-w-0 rounded-lg border border-base-content/15 bg-base-100 p-4">
			<dt class="flex items-center gap-2 text-sm text-base-content/70">
				<span class="icon-[tabler--trending-up] size-5 text-success" aria-hidden="true"></span>
				<span>Pemasukan</span>
				@if ($isFiltered)
					<span class="badge badge-soft badge-xs badge-warning">Terfilter</span>
				@endif
			</dt>
			<dd class="mt-2 break-words text-xl font-bold tabular-nums text-success">Rp {{ number_format($totalIncome, 0, ',', '.') }}</dd>
		</div>
		<div class="min-w-0 rounded-lg border border-base-content/15 bg-base-100 p-4">
			<dt class="flex items-center gap-2 text-sm text-base-content/70">
				<span class="icon-[tabler--trending-down] size-5 text-error" aria-hidden="true"></span>
				<span>Pengeluaran</span>
				@if ($isFiltered)
					<span class="badge badge-soft badge-xs badge-warning">Terfilter</span>
				@endif
			</dt>
			<dd class="mt-2 break-words text-xl font-bold tabular-nums text-error">Rp {{ number_format($totalOut, 0, ',', '.') }}</dd>
			@if ($totalTransferFee > 0)
				<p class="mt-1 text-xs text-base-content/70">Termasuk biaya transfer Rp {{ number_format($totalTransferFee, 0, ',', '.') }}</p>
			@endif
		</div>
		<div class="min-w-0 rounded-lg border border-base-content/15 bg-base-100 p-4">
			<dt class="flex items-center gap-2 text-sm text-base-content/70">
				<span class="icon-[tabler--wallet] size-5 text-primary" aria-hidden="true"></span>
				<span>Selisih</span>
				@if ($isFiltered)
					<span class="badge badge-soft badge-xs badge-warning">Terfilter</span>
				@endif
			</dt>
			<dd class="mt-2 break-words text-xl font-bold tabular-nums {{ $net >= 0 ? 'text-primary' : 'text-error' }}">Rp {{ number_format($net, 0, ',', '.') }}</dd>
			<p class="mt-1 text-xs text-base-content/70">Pemasukan dikurangi pengeluaran dan biaya transfer.</p>
		</div>
	</dl>

	<section aria-label="Daftar transaksi" class="w-full rounded-lg border border-base-content/15 bg-base-100">
		<div class="flex flex-col gap-3 border-b border-base-content/10 p-3 sm:flex-row sm:items-center sm:justify-between sm:p-4">
			<form method="GET" action="{{ route('transactions.index') }}" class="flex min-w-0 items-center gap-2 sm:flex-1">
				<input type="hidden" name="type" value="{{ request('type') }}">
				<input type="hidden" name="wallet_id" value="{{ request('wallet_id') }}">
				<input type="hidden" name="category_id" value="{{ request('category_id') }}">
				<input type="hidden" name="transaction_name_id" value="{{ request('transaction_name_id') }}">
				<input type="hidden" name="date_from" value="{{ request('date_from') }}">
				<input type="hidden" name="date_to" value="{{ request('date_to') }}">
				<input type="search" name="search" value="{{ request('search') }}" placeholder="Cari deskripsi transaksi" aria-label="Cari deskripsi transaksi" class="input input-sm h-10 min-w-0 flex-1 rounded-sm sm:max-w-md">
				<button type="submit" class="btn btn-primary btn-sm h-10 min-h-10 shrink-0 rounded-sm">Cari</button>
			</form>
			<div class="flex flex-wrap items-center gap-2">
				<button type="button" class="btn btn-outline btn-sm h-10 min-h-10 rounded-sm" aria-haspopup="dialog" aria-controls="modal-transaction-filters" data-overlay="#modal-transaction-filters">
					<span class="icon-[tabler--adjustments] size-4" aria-hidden="true"></span>
					Filter lanjutan
					@if ($isFiltered) <span class="badge badge-primary badge-xs">Aktif</span> @endif
				</button>
				@if (request()->hasAny(['type', 'wallet_id', 'category_id', 'transaction_name_id', 'date_from', 'date_to', 'search']))
					<a href="{{ route('transactions.index') }}" class="btn btn-ghost btn-sm h-10 min-h-10 rounded-sm text-error">Hapus filter</a>
				@endif
				@can('money.transactions.create')
					<a href="{{ route('transactions.create') }}" class="btn btn-primary btn-sm h-10 min-h-10 rounded-sm"><span class="icon-[tabler--plus] size-4" aria-hidden="true"></span>Tambah transaksi</a>
				@endcan
			</div>
		</div>

		<div id="modal-transaction-filters" class="overlay modal overlay-open:opacity-100 overlay-open:duration-300 modal-middle hidden" role="dialog" tabindex="-1" aria-labelledby="transaction-filters-title">
			<div class="modal-dialog w-full max-w-2xl">
				<div class="modal-content">
					<div class="modal-header">
						<h2 id="transaction-filters-title" class="modal-title">Filter transaksi</h2>
						<button type="button" class="btn btn-text btn-circle btn-sm absolute end-3 top-3" aria-label="Tutup filter" data-overlay="#modal-transaction-filters"><span class="icon-[tabler--x] size-4" aria-hidden="true"></span></button>
					</div>
					<form method="GET" action="{{ route('transactions.index') }}">
						<div class="modal-body grid grid-cols-1 gap-4 sm:grid-cols-2">
							<label class="form-control"><span class="label mb-1 text-sm font-medium">Jenis transaksi</span><select id="transaction-filter-type" name="type" class="select select-sm h-10 w-full rounded-sm"><option value="">Semua jenis</option><option value="income" {{ request('type') === 'income' ? 'selected' : '' }}>Pemasukan</option><option value="outcome" {{ request('type') === 'outcome' ? 'selected' : '' }}>Pengeluaran</option><option value="transfer" {{ request('type') === 'transfer' ? 'selected' : '' }}>Transfer</option></select></label>
							<label class="form-control"><span class="label mb-1 text-sm font-medium">Dompet</span><select name="wallet_id" class="select select-sm h-10 w-full rounded-sm"><option value="">Semua dompet</option>@foreach ($wallets as $wallet)<option value="{{ $wallet->id }}" {{ request('wallet_id') == $wallet->id ? 'selected' : '' }}>{{ $wallet->name }}</option>@endforeach</select></label>
							<label class="form-control"><span class="label mb-1 text-sm font-medium">Kategori</span><select id="transaction-filter-category" name="category_id" class="select select-sm h-10 w-full rounded-sm"><option value="">Semua kategori</option>@foreach ($categories as $cat)<option value="{{ $cat->id }}" data-type="{{ $cat->type }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }} — {{ $cat->type === 'income' ? 'Pemasukan' : 'Pengeluaran' }}</option>@endforeach</select></label>
							<label class="form-control"><span class="label mb-1 text-sm font-medium">Nama kategori</span><select id="transaction-filter-name" name="transaction_name_id" class="select select-sm h-10 w-full rounded-sm"><option value="">Semua nama kategori</option>@foreach ($transactionNames as $transactionName)<option value="{{ $transactionName->id }}" data-category-id="{{ $transactionName->category_id }}" {{ request('transaction_name_id') == $transactionName->id ? 'selected' : '' }}>{{ $transactionName->name }}</option>@endforeach</select></label>
							<label class="form-control"><span class="label mb-1 text-sm font-medium">Kata kunci</span><input type="search" name="search" value="{{ request('search') }}" placeholder="Cari deskripsi" class="input input-sm h-10 w-full rounded-sm"></label>
							<label class="form-control"><span class="label mb-1 text-sm font-medium">Dari tanggal</span><input type="date" name="date_from" value="{{ request('date_from') }}" class="input input-sm h-10 w-full rounded-sm"></label>
							<label class="form-control"><span class="label mb-1 text-sm font-medium">Sampai tanggal</span><input type="date" name="date_to" value="{{ request('date_to') }}" class="input input-sm h-10 w-full rounded-sm"></label>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-ghost btn-sm" data-overlay="#modal-transaction-filters">Batal</button>
							<button type="submit" class="btn btn-primary btn-sm">Terapkan filter</button>
						</div>
					</form>
				</div>
			</div>
		</div>

		<div class="divide-y divide-base-content/10 px-3 py-2 sm:px-4">
			@forelse($transactions as $trx)
				<details class="group min-w-0 py-4">
					<summary class="grid cursor-pointer list-none grid-cols-[minmax(0,1fr)_auto] items-start gap-3 rounded-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-primary sm:items-center md:grid-cols-[15rem_minmax(0,1fr)_auto_auto]">
						<span class="flex min-w-0 flex-wrap items-center gap-x-3 gap-y-1">
							<span class="text-sm text-base-content/70">{{ $trx->date->format('d M Y') }}</span>
							@if ($trx->type === 'income')
								<span class="badge badge-soft badge-success w-28 justify-center text-xs">Pemasukan</span>
							@elseif ($trx->type === 'outcome')
								<span class="badge badge-soft badge-error w-28 justify-center text-xs">Pengeluaran</span>
							@else
								<span class="badge badge-soft badge-warning w-28 justify-center text-xs">Transfer</span>
							@endif
						</span>
						<span class="col-span-2 min-w-0 break-words text-sm text-base-content/70 md:col-span-1 md:truncate">{{ $trx->category->name ?? 'Tanpa kategori' }}</span>
						<span class="col-start-2 row-start-1 flex items-center gap-2 text-right md:col-auto md:row-auto md:contents">
							<span class="min-w-0 text-right">
								<p class="font-semibold tabular-nums {{ $trx->type === 'income' ? 'text-success' : ($trx->type === 'outcome' ? 'text-error' : 'text-warning') }}">
									@if ($trx->type === 'income') + @elseif ($trx->type === 'outcome') - @endif
									Rp {{ number_format($trx->amount, 0, ',', '.') }}
								</p>
								@if ($trx->type === 'transfer' && $trx->transfer_fee > 0)
									<p class="mt-1 text-xs text-base-content/70">Biaya Rp {{ number_format($trx->transfer_fee, 0, ',', '.') }}, dibayar {{ $trx->fee_bearer === 'sender' ? 'pengirim' : 'penerima' }}</p>
								@endif
							</span>
							<span class="icon-[tabler--chevron-down] size-5 shrink-0 text-base-content/60 transition-transform group-open:rotate-180" aria-hidden="true"></span>
						</span>
					</summary>

					<dl class="mt-3 grid grid-cols-1 gap-x-6 gap-y-3 border-t border-base-content/10 pt-3 text-sm sm:grid-cols-2">
						<div class="grid grid-cols-[5.5rem_minmax(0,1fr)] gap-3">
							<dt class="text-base-content/60">Dompet</dt>
							<dd class="min-w-0 break-words font-medium">
								{{ $trx->wallet->name ?? '-' }}
								@if ($trx->type === 'transfer' && $trx->toWallet)
									<span class="mx-1 text-base-content/50" aria-label="ke">→</span>{{ $trx->toWallet->name }}
								@endif
							</dd>
						</div>
						@if ($trx->transactionName)
							<div class="grid grid-cols-[5.5rem_minmax(0,1fr)] gap-3">
								<dt class="text-base-content/60">Nama</dt>
								<dd class="min-w-0 break-words">{{ $trx->transactionName->name }}</dd>
							</div>
						@endif
						<div class="grid grid-cols-[5.5rem_minmax(0,1fr)] gap-3">
							<dt class="text-base-content/60">Deskripsi</dt>
							<dd class="min-w-0 break-words">{{ $trx->description ?: 'Tanpa deskripsi' }}</dd>
						</div>
					</dl>

					<div class="mt-4 flex gap-2 border-t border-base-content/10 pt-3">
						@can('money.transactions.edit')
							<a href="{{ route('transactions.edit', $trx) }}" class="btn btn-ghost btn-sm min-h-10 flex-1 rounded-sm">
								<span class="icon-[tabler--pencil] size-4" aria-hidden="true"></span>Ubah
							</a>
						@endcan
						@can('money.transactions.delete')
							<button type="button" class="delete-btn btn btn-ghost btn-sm min-h-10 flex-1 rounded-sm text-error" aria-haspopup="dialog" aria-expanded="false" aria-controls="modal-delete" data-overlay="#modal-delete" data-action="{{ route('transactions.destroy', $trx) }}">
								<span class="icon-[tabler--trash] size-4" aria-hidden="true"></span>Hapus
							</button>
						@endcan
					</div>
				</details>
			@empty
				<div class="rounded-lg border border-base-content/15 px-4 py-10 text-center">
					<p class="font-medium">Belum ada transaksi yang cocok.</p>
					<p class="mt-1 text-sm text-base-content/70">Coba ubah filter atau tambahkan transaksi baru.</p>
					@can('money.transactions.create')
						<a href="{{ route('transactions.create') }}" class="btn btn-primary btn-sm mt-4">Tambah transaksi</a>
					@endcan
				</div>
			@endforelse
		</div>

	</section>

	<div class="mt-4">
		{{ $transactions->links('template.pagination') }}
	</div>

	<div id="modal-delete" class="overlay modal overlay-open:opacity-100 overlay-open:duration-300 modal-middle hidden" role="dialog" tabindex="-1" aria-labelledby="modal-delete-title">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h2 id="modal-delete-title" class="modal-title">Hapus transaksi?</h2>
					<button type="button" class="btn btn-text btn-circle btn-sm absolute end-3 top-3" aria-label="Tutup" data-overlay="#modal-delete">
						<span class="icon-[tabler--x] size-4" aria-hidden="true"></span>
					</button>
				</div>
				<div class="modal-body">Saldo dompet akan disesuaikan setelah transaksi dihapus.</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-soft btn-secondary" data-overlay="#modal-delete">Batal</button>
					<form id="delete-form" method="POST" class="inline">
						@csrf
						@method('DELETE')
						<button type="submit" class="btn btn-error">Hapus transaksi</button>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection

@push('scripts')
	<script>
		document.addEventListener('DOMContentLoaded', function() {
			const typeSelect = document.getElementById('transaction-filter-type');
			const categorySelect = document.getElementById('transaction-filter-category');
			const nameSelect = document.getElementById('transaction-filter-name');

			function updateCategoryOptions(clearInvalid = false) {
				if (!typeSelect || !categorySelect) return;

				const selectedType = typeSelect.value;
				Array.from(categorySelect.options).forEach(option => {
					if (!option.value) return;
					const matchesType = !selectedType || option.dataset.type === selectedType;
					option.hidden = !matchesType;
					option.disabled = !matchesType;
				});

				const selectedCategory = categorySelect.selectedOptions[0];
				if (clearInvalid && selectedCategory && selectedCategory.value && selectedCategory.disabled) {
					categorySelect.value = '';
				}
			}

			function updateNameOptions() {
				if (!categorySelect || !nameSelect) return;

				const selectedCategoryId = categorySelect.value;
				Array.from(nameSelect.options).forEach(option => {
					if (!option.value) return;
					const matchesCategory = !selectedCategoryId || option.dataset.categoryId === selectedCategoryId;
					option.hidden = !matchesCategory;
					option.disabled = !matchesCategory;
				});

				const selectedName = nameSelect.selectedOptions[0];
				if (selectedName && selectedName.value && selectedName.disabled) {
					nameSelect.value = '';
				}
			}

			updateCategoryOptions(true);
			updateNameOptions();
			typeSelect?.addEventListener('change', function() {
				updateCategoryOptions(true);
				updateNameOptions();
			});
			categorySelect?.addEventListener('change', updateNameOptions);

			const deleteButtons = document.querySelectorAll('.delete-btn');
			const deleteForm = document.getElementById('delete-form');
			deleteButtons.forEach(button => {
				button.addEventListener('click', function() {
					const action = this.getAttribute('data-action');
					if (deleteForm) deleteForm.setAttribute('action', action);
				});
			});
		});
	</script>
@endpush
