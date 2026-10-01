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
	<!-- Header Halaman -->
	<div class="mb-5 flex flex-col gap-1 sm:flex-row sm:items-center sm:justify-between">
		<div>
			<h1 class="text-2xl font-bold tracking-tight">Stock List</h1>
			<p class="text-sm text-base-content/70">Daftar analisis indikator saham harian.</p>
		</div>
	</div>

	<!-- Main Container -->
	<div class="w-full rounded-xl border border-base-200 bg-base-100 shadow-sm">

		<!-- Filter Form Bar -->
		<div class="border-b border-base-200 p-4">
			<form method="GET" action="{{ route('stock') }}" class="flex flex-wrap items-center gap-3">

				<!-- Search Input -->
				<div class="input input-sm flex w-full items-center gap-2 rounded-lg border-base-300 sm:w-60">
					<span class="icon-[tabler--search] text-base-content/50 size-4 shrink-0"></span>
					<input type="search" name="search" class="grow bg-transparent text-xs outline-none"
						placeholder="Cari kode saham..." value="{{ request('search') }}" />
				</div>

				<!-- Date Inputs -->
				<div class="flex items-center gap-2">
					<label class="input input-sm flex items-center gap-2 rounded-lg border-base-300">
						<span class="text-xs font-medium text-base-content/60">Dari</span>
						<input type="date" name="date_from" class="bg-transparent text-xs outline-none"
							value="{{ request('date_from') }}" />
					</label>
					<span class="text-xs text-base-content/40">-</span>
					<label class="input input-sm flex items-center gap-2 rounded-lg border-base-300">
						<span class="text-xs font-medium text-base-content/60">Sampai</span>
						<input type="date" name="date_to" class="bg-transparent text-xs outline-none"
							value="{{ request('date_to') }}" />
					</label>
				</div>

				<!-- Filter Actions -->
				<button type="submit" class="btn btn-sm btn-primary rounded-lg font-medium">
					<span class="icon-[tabler--filter] size-4"></span> Filter
				</button>

				@if (request()->hasAny(['search', 'date_from', 'date_to']))
					<a href="{{ route('stock') }}" class="btn btn-sm btn-ghost text-xs font-normal text-error hover:bg-error/10">
						<span class="icon-[tabler--x] size-4"></span> Hapus Filter
					</a>
				@endif
			</form>
		</div>

		<!-- Data Table -->
		<div class="overflow-x-auto">
			<table class="table table-md w-full" id="main-table">
				<thead>
					<tr
						class="border-b border-base-200 bg-base-200/50 text-xs uppercase tracking-wider font-semibold text-base-content/70">
						<th class="w-28">Date</th>
						<th class="w-24">Code</th>
						<th class="w-28 text-right">Price</th>
						<th class="w-20 text-right">Swing</th>
						<th class="w-20 text-right">Bearish</th>
						<th class="w-20 text-right">BOW</th>
						<th>Tags</th>
					</tr>
				</thead>
				<tbody class="divide-y divide-base-200 text-xs">
					@forelse($stock_indicators as $stock_indicator)
						<tr class="hover:bg-base-200/30 transition-colors">
							<!-- Date -->
							<td class="whitespace-nowrap font-medium text-base-content/80">
								{{ $stock_indicator->trade_date }}
							</td>

							<!-- Stock Code -->
							<td class="whitespace-nowrap">
								<a
									href="{{ route('stock', array_merge(request()->query(), ['search' => $stock_indicator->stock_code, 'page' => null])) }}"
									class="font-bold text-primary hover:underline" title="Cari {{ $stock_indicator->stock_code }}">
									{{ $stock_indicator->stock_code }}
								</a>
							</td>

							<!-- Price (Right Aligned & Formatted) -->
							<td class="whitespace-nowrap text-right font-mono font-semibold">
								{{ number_format($stock_indicator->stock_summary->close ?? 0, 0, ',', '.') }}
							</td>

							<!-- Indicators (Right Aligned) -->
							<td class="whitespace-nowrap text-right font-mono">{{ round($stock_indicator->swing_score, 0) . '/19' }}</td>
							<td class="whitespace-nowrap text-right font-mono">{{ round($stock_indicator->bearish_score, 0) . '/20' }}</td>
							<td class="whitespace-nowrap text-right font-mono">{{ round($stock_indicator->bow_score, 0) . '/9' }}</td>

							<!-- Tags (Clean Layout) -->
							<td>
								<div class="flex flex-wrap gap-1">
									@forelse($stock_indicator->signal_tags as $tags)
										@if (isset($tagConfigs[$tags]))
											@php $config = $tagConfigs[$tags]; @endphp
											<div class="tooltip">
												<div class="tooltip-toggle cursor-pointer" aria-label="{{ $config['label'] }}">
													<span
														class="badge badge-soft {{ $config['badge'] }} text-xs">{{ Str::ucfirst(str_replace('_', ' ', $tags)) }}</span>
												</div>
												<span class="tooltip-content tooltip-shown:opacity-100 tooltip-shown:visible" role="tooltip">
													<span class="tooltip-body">{{ $config['tooltip'] }}</span>
												</span>
											</div>
										@endif
									@empty
										<span class="text-xs text-gray-500">No tags available</span>
									@endforelse
								</div>
							</td>
						</tr>
					@empty
						<tr>
							<td colspan="7" class="text-center py-10 text-base-content/50">
								<div class="flex flex-col items-center justify-center gap-2">
									<span class="icon-[tabler--database-off] size-8 text-base-content/30"></span>
									<p class="text-sm">Tidak ada data indikator saham ditemukan</p>
								</div>
							</td>
						</tr>
					@endforelse
				</tbody>
			</table>
		</div>

		<!-- Footer / Pagination -->
		<div class="border-t border-base-200 p-4">
			{{ $stock_indicators->links() }}
		</div>
	</div>
@endsection
