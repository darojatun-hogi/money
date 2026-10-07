@php
	$tagConfigs = [
	    // ── SWING (bullish) ─────────────────────────────
	    'volume_spike' => [
	        'label' => 'Volume Spike',
	        'badge' => 'badge-primary',
	        'tooltip' => 'volume_ratio ≥ 2 & hari naik (+3)',
	    ],
	    'golden_cross' => [
	        'label' => 'Golden Cross',
	        'badge' => 'badge-primary',
	        'tooltip' => 'MA5 baru menembus MA20 ke atas (+2)',
	    ],
	    'rsi_oversold' => [
	        'label' => 'RSI Oversold',
	        'badge' => 'badge-primary',
	        'tooltip' => 'RSI(14) ≤ 35 (+2)',
	    ],
	    'bullish_close' => [
	        'label' => 'Bullish Close',
	        'badge' => 'badge-primary',
	        'tooltip' => 'close_position ≥ 0.7 (+1)',
	    ],
	    'foreign_accumulation' => [
	        'label' => 'Foreign Accumulation',
	        'badge' => 'badge-primary',
	        'tooltip' => 'foreign_net_ratio ≥ 5% dari volume 5 hari (+2)',
	    ],
	    'breakout_20d' => [
	        'label' => 'Breakout 20D',
	        'badge' => 'badge-primary',
	        'tooltip' => 'Close di atas high tertinggi 20 hari (+2)',
	    ],
	    'trend_aligned' => [
	        'label' => 'Trend Aligned',
	        'badge' => 'badge-primary',
	        'tooltip' => 'MA20 > MA50 > MA200 (+2)',
	    ],
	    'macd_bullish_cross' => [
	        'label' => 'MACD Bullish Cross',
	        'badge' => 'badge-primary',
	        'tooltip' => 'Histogram MACD negatif → positif (+2)',
	    ],
	    'gap_up' => [
	        'label' => 'Gap Up',
	        'badge' => 'badge-primary',
	        'tooltip' => 'Gap open ≥ 2% & close ≥ open (+1)',
	    ],
	    'outperform_market' => [
	        'label' => 'Outperform Market',
	        'badge' => 'badge-primary',
	        'tooltip' => 'rs_20d ≥ 3% terhadap IHSG (+2)',
	    ],

	    // ── BEARISH ─────────────────────────────────────
	    'death_cross' => [
	        'label' => 'Death Cross',
	        'badge' => 'badge-error',
	        'tooltip' => 'MA5 baru menembus MA20 ke bawah (+3)',
	    ],
	    'rsi_overbought' => [
	        'label' => 'RSI Overbought',
	        'badge' => 'badge-error',
	        'tooltip' => 'RSI(14) ≥ 70 (+2)',
	    ],
	    'bearish_close' => [
	        'label' => 'Bearish Close',
	        'badge' => 'badge-error',
	        'tooltip' => 'close_position ≤ 0.3 (+1)',
	    ],
	    'foreign_distribution' => [
	        'label' => 'Foreign Distribution',
	        'badge' => 'badge-error',
	        'tooltip' => 'foreign_net_ratio ≤ -5% dari volume 5 hari (+2)',
	    ],
	    'breakdown_20d' => [
	        'label' => 'Breakdown 20D',
	        'badge' => 'badge-error',
	        'tooltip' => 'Close di bawah low terendah 20 hari (+2)',
	    ],
	    'volume_distribution' => [
	        'label' => 'Volume Distribution',
	        'badge' => 'badge-error',
	        'tooltip' => 'volume_ratio ≥ 2, hari turun, close_position ≤ 0.5 (+3)',
	    ],
	    'trend_broken' => [
	        'label' => 'Trend Broken',
	        'badge' => 'badge-error',
	        'tooltip' => 'MA20 < MA50 < MA200 (+2)',
	    ],
	    'macd_bearish_cross' => [
	        'label' => 'MACD Bearish Cross',
	        'badge' => 'badge-error',
	        'tooltip' => 'Histogram MACD positif → negatif (+2)',
	    ],
	    'gap_down' => [
	        'label' => 'Gap Down',
	        'badge' => 'badge-error',
	        'tooltip' => 'Gap open ≤ -2% & close ≤ open (+1)',
	    ],
	    'underperform_market' => [
	        'label' => 'Underperform Market',
	        'badge' => 'badge-error',
	        'tooltip' => 'rs_20d ≤ -3% terhadap IHSG (+2)',
	    ],

	    // ── BUY ON WEAKNESS ─────────────────────────────
	    'uptrend_intact' => [
	        'label' => 'Uptrend Intact',
	        'badge' => 'badge-info',
	        'tooltip' => 'Close > MA50 (+2)',
	    ],
	    'pullback_to_support' => [
	        'label' => 'Pullback to Support',
	        'badge' => 'badge-info',
	        'tooltip' => 'Close ≤ MA20 × 1.03 & ≥ Bollinger bawah (+2)',
	    ],
	    'volume_dry_up' => [
	        'label' => 'Volume Dry Up',
	        'badge' => 'badge-info',
	        'tooltip' => 'Hari turun & volume_ratio ≤ 0.8 (+2)',
	    ],
	    'rsi_neutral_pullback' => [
	        'label' => 'RSI Neutral Pullback',
	        'badge' => 'badge-info',
	        'tooltip' => 'RSI(14) di 40–55 (+1)',
	    ],
	    'foreign_holding_through_dip' => [
	        'label' => 'Foreign Holding',
	        'badge' => 'badge-info',
	        'tooltip' => 'Uptrend utuh, net asing 5 hari > 0, hari turun (+2)',
	    ],

	    // ── INFO (tanpa skor) ───────────────────────────
	    'illiquid' => [
	        'label' => 'Illiquid',
	        'badge' => 'badge-neutral',
	        'tooltip' => 'Rata-rata nilai transaksi 20 hari < Rp 1 miliar (0)',
	    ],
	];
@endphp
@extends('template.master')

@section('content')
	<header class="mb-5">
		<h1 class="text-2xl font-bold tracking-tight">Daftar Saham</h1>
		<p class="mt-1 text-sm text-base-content/70">Pantau harga penutupan dan skor indikator harian.</p>
	</header>

	<section aria-label="Filter saham" class="w-full rounded-xl border border-base-200 bg-base-100">
		<form method="GET" action="{{ route('stock') }}" class="grid grid-cols-1 items-end gap-3 p-4 sm:grid-cols-2 xl:grid-cols-[minmax(0,1fr)_auto_auto]">
			<label class="input input-sm flex h-10 w-full min-w-0 items-center gap-2 rounded-lg border-base-300 sm:col-span-2 xl:col-span-1">
				<span class="icon-[tabler--search] size-4 shrink-0 text-base-content/50" aria-hidden="true"></span>
				<span class="sr-only">Cari kode saham</span>
				<input type="search" name="search" class="min-w-0 grow bg-transparent text-sm outline-none" placeholder="Cari kode saham" value="{{ request('search') }}">
			</label>

			<div class="grid grid-cols-1 gap-3 sm:col-span-2 sm:grid-cols-2 xl:col-span-1">
				<label class="input input-sm flex h-10 w-full min-w-0 items-center gap-2 rounded-lg border-base-300">
					<span class="shrink-0 text-xs font-medium text-base-content/70">Dari</span>
					<input type="date" name="date_from" class="min-w-0 w-full bg-transparent text-sm outline-none" aria-label="Tanggal awal" value="{{ request('date_from') }}">
				</label>
				<label class="input input-sm flex h-10 w-full min-w-0 items-center gap-2 rounded-lg border-base-300">
					<span class="shrink-0 text-xs font-medium text-base-content/70">Sampai</span>
					<input type="date" name="date_to" class="min-w-0 w-full bg-transparent text-sm outline-none" aria-label="Tanggal akhir" value="{{ request('date_to') }}">
				</label>
			</div>

			<div class="flex flex-col gap-2 sm:col-span-2 sm:flex-row sm:items-center xl:col-span-1">
				<button type="submit" class="btn btn-primary btn-sm h-10 min-h-10 w-full rounded-lg font-medium sm:w-auto">Terapkan filter</button>
				@if (request()->hasAny(['search', 'date_from', 'date_to']))
					<a href="{{ route('stock') }}" class="btn btn-ghost btn-sm h-10 min-h-10 w-full rounded-lg text-error hover:bg-error/10 sm:w-auto">Hapus filter</a>
				@endif
			</div>
		</form>
	</section>

	<section aria-label="Hasil analisis saham" class="mt-4 w-full">
		<div class="space-y-3 xl:hidden">
			@forelse($stock_indicators as $stock_indicator)
				<article class="rounded-xl border border-base-200 bg-base-100 p-4">
					@php
						$displayTags = collect($stock_indicator->signal_tags)
							->filter(fn ($tag) => isset($tagConfigs[$tag]))
							->values();
					@endphp
					<div class="flex items-start justify-between gap-3">
						<p class="text-sm font-medium text-base-content/70">{{ $stock_indicator->trade_date }}</p>
						<a href="{{ route('stock', array_merge(request()->query(), ['search' => $stock_indicator->stock_code, 'page' => null])) }}" class="shrink-0 font-bold text-primary hover:underline focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary" aria-label="Filter kode saham {{ $stock_indicator->stock_code }}">
							{{ $stock_indicator->stock_code }}
						</a>
					</div>

					<div class="mt-3 flex items-baseline justify-between gap-3 border-b border-base-200 pb-3">
						<span class="text-sm text-base-content/70">Harga penutupan</span>
						<span class="text-lg font-semibold tabular-nums">Rp {{ number_format($stock_indicator->stock_summary->close ?? 0, 0, ',', '.') }}</span>
					</div>

					<dl class="grid grid-cols-3 gap-2 py-3 text-sm">
						<div>
							<dt class="text-xs text-base-content/70">Swing</dt>
							<dd class="mt-1 font-mono font-medium tabular-nums">{{ round($stock_indicator->swing_score, 0) }}/19</dd>
						</div>
						<div>
							<dt class="text-xs text-base-content/70">Bearish</dt>
							<dd class="mt-1 font-mono font-medium tabular-nums">{{ round($stock_indicator->bearish_score, 0) }}/20</dd>
						</div>
						<div>
							<dt class="text-xs text-base-content/70" aria-label="Buy on Weakness">BOW</dt>
							<dd class="mt-1 font-mono font-medium tabular-nums">{{ round($stock_indicator->bow_score, 0) }}/9</dd>
						</div>
					</dl>

					@if ($displayTags->isNotEmpty())
						<details class="group border-t border-base-200 pt-2">
							<summary class="flex min-h-11 cursor-pointer list-none items-center justify-between gap-3 rounded-sm text-sm font-medium focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary">
								<span class="group-open:hidden">Lihat {{ $displayTags->count() }} sinyal</span>
								<span class="hidden group-open:inline">Sembunyikan sinyal</span>
								<span class="icon-[tabler--chevron-down] size-4 transition-transform group-open:rotate-180" aria-hidden="true"></span>
							</summary>
							<div class="flex flex-wrap gap-1.5 pb-1 pt-2">
								@foreach ($displayTags as $tag)
									@php $config = $tagConfigs[$tag]; @endphp
									<span class="badge badge-soft {{ $config['badge'] }} h-auto max-w-full whitespace-normal break-words py-1 text-left text-xs" title="{{ $config['tooltip'] }}">{{ $config['label'] }}</span>
								@endforeach
							</div>
						</details>
					@else
						<p class="border-t border-base-200 pt-3 text-sm text-base-content/60">Belum ada sinyal untuk tanggal ini.</p>
					@endif
				</article>
			@empty
				<div class="rounded-xl border border-base-200 bg-base-100 px-4 py-10 text-center">
					<span class="icon-[tabler--database-off] mx-auto mb-2 block size-8 text-base-content/40" aria-hidden="true"></span>
					<p class="font-medium">Data saham tidak ditemukan.</p>
					<p class="mt-1 text-sm text-base-content/70">Ubah kode saham atau rentang tanggal, lalu coba lagi.</p>
				</div>
			@endforelse
		</div>

		<div class="hidden overflow-x-auto rounded-xl border border-base-200 bg-base-100 xl:block">
			<table class="table table-md w-full" id="main-table" aria-label="Indikator saham harian">
				<thead>
					<tr class="border-b border-base-200 bg-base-200/50 text-left text-xs font-semibold text-base-content/70">
						<th class="whitespace-nowrap">Tanggal</th>
						<th>Kode</th>
						<th class="whitespace-nowrap text-right">Harga (Rp)</th>
						<th class="text-right">Swing</th>
						<th class="text-right">Bearish</th>
						<th class="text-right">BOW</th>
						<th>Sinyal</th>
					</tr>
				</thead>
				<tbody class="divide-y divide-base-200 text-sm">
					@forelse($stock_indicators as $stock_indicator)
						<tr class="transition-colors hover:bg-base-200/30">
							<td class="whitespace-nowrap font-medium text-base-content/80">{{ $stock_indicator->trade_date }}</td>
							<td class="whitespace-nowrap">
								<a href="{{ route('stock', array_merge(request()->query(), ['search' => $stock_indicator->stock_code, 'page' => null])) }}" class="font-bold text-primary hover:underline" aria-label="Filter kode saham {{ $stock_indicator->stock_code }}">
									{{ $stock_indicator->stock_code }}
								</a>
							</td>
							<td class="whitespace-nowrap text-right font-mono font-semibold tabular-nums">{{ number_format($stock_indicator->stock_summary->close ?? 0, 0, ',', '.') }}</td>
							<td class="whitespace-nowrap text-right font-mono tabular-nums">{{ round($stock_indicator->swing_score, 0) }}/19</td>
							<td class="whitespace-nowrap text-right font-mono tabular-nums">{{ round($stock_indicator->bearish_score, 0) }}/20</td>
							<td class="whitespace-nowrap text-right font-mono tabular-nums">{{ round($stock_indicator->bow_score, 0) }}/9</td>
							<td>
								<div class="flex min-w-56 flex-wrap gap-1.5">
									@forelse($stock_indicator->signal_tags as $tag)
										@if (isset($tagConfigs[$tag]))
											@php $config = $tagConfigs[$tag]; @endphp
											<span class="badge badge-soft {{ $config['badge'] }} h-auto max-w-full whitespace-normal break-words py-1 text-left text-xs" title="{{ $config['tooltip'] }}">{{ $config['label'] }}</span>
										@endif
									@empty
										<span class="text-sm text-base-content/60">Belum ada sinyal.</span>
									@endforelse
								</div>
							</td>
						</tr>
					@empty
						<tr>
							<td colspan="7" class="py-10 text-center">
								<p class="font-medium">Data saham tidak ditemukan.</p>
								<p class="mt-1 text-sm text-base-content/70">Ubah kode saham atau rentang tanggal, lalu coba lagi.</p>
							</td>
						</tr>
					@endforelse
				</tbody>
			</table>
		</div>
	</section>

	<div class="mt-4 rounded-xl border border-base-200 bg-base-100 p-3 sm:p-4">
		{{ $stock_indicators->links() }}
	</div>
@endsection
