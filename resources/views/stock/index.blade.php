@extends('template.master')
@section('content')
	<div class="pb-4">
		<h1 class="text-2xl font-semibold tracking-tight">Stock</h1>
		<p class="text-base-content/70 mt-1">Stock List.</p>
	</div>

	<div class="border-base-content/25 w-full rounded-lg border bg-base-100 p-4 shadow-sm">
		<form method="GET" action="{{ route('stock') }}" class="mb-4 flex flex-wrap items-center gap-2">
			<div class="input input-sm flex w-full items-center gap-2 rounded-sm sm:max-w-[220px]">
				<span class="icon-[tabler--search] text-base-content/80 size-5 shrink-0"></span>
				<input type="search" name="search" class="grow bg-transparent outline-none" placeholder="Cari kode saham..."
					value="{{ request('search') }}" />
			</div>
			<label class="input input-sm flex w-full items-center gap-2 rounded-sm sm:w-auto">
				<span class="text-base-content/70 text-xs">Dari</span>
				<input type="date" name="date_from" class="bg-transparent outline-none" value="{{ request('date_from') }}" />
			</label>
			<label class="input input-sm flex w-full items-center gap-2 rounded-sm sm:w-auto">
				<span class="text-base-content/70 text-xs">Sampai</span>
				<input type="date" name="date_to" class="bg-transparent outline-none" value="{{ request('date_to') }}" />
			</label>
			<button type="submit" class="btn btn-sm btn-outline btn-primary rounded-sm">Filter</button>
			@if (request()->hasAny(['search', 'date_from', 'date_to']))
				<a href="{{ route('stock') }}"
					class="btn btn-sm btn-text flex items-center gap-1 p-0 h-auto min-h-0 font-normal normal-case text-base-content/60 hover:text-primary hover:bg-transparent shadow-none border-none">
					<span class="icon-[tabler--x] size-4"></span>Hapus filter
				</a>
			@endif
		</form>

		<div class="overflow-x-auto">
			<table class="table" id="main-table">
				<thead>
					<tr>
						<th>#</th>
						<th>date</th>
						<th>code</th>
						<th>price</th>
						<th>swing</th>
						<th>bearish</th>
						<th>bow</th>
						<th>tags</th>
					</tr>
				</thead>
				<tbody>
					@forelse($stock_indicators as $stock_indicator)
						<tr class="row-hover">
							<td>{{ $stock_indicator->id }}</td>
							<td class="whitespace-nowrap">{{ $stock_indicator->trade_date }}</td>
							<td class="whitespace-nowrap">
								<a
									href="{{ route('stock', array_merge(request()->query(), ['search' => $stock_indicator->stock_code, 'page' => null])) }}"
									class="link link-primary" title="Cari {{ $stock_indicator->stock_code }}">
									{{ $stock_indicator->stock_code }}
								</a>
							</td>
							<td class="whitespace-nowrap">{{ $stock_indicator->stock_summary->close }}</td>
							<td class="whitespace-nowrap">{{ $stock_indicator->swing_score }}</td>
							<td class="whitespace-nowrap">{{ $stock_indicator->bearish_score }}</td>
							<td class="whitespace-nowrap">{{ $stock_indicator->bow_score }}</td>
							<td>
								<div class="flex flex-wrap gap-1">
									@forelse($stock_indicator->signal_tags as $tags)
										@if (in_array($tags, [
												'volume_spike',
												'golden_cross',
												'rsi_oversold',
												'bullish_close',
												'foreign_accumulation',
												'uptrend_structure',
											]))
											<span class="badge badge-soft badge-primary text-xs">{{ $tags }}</span>
										@elseif(in_array($tags, [
												'death_cross',
												'rsi_overbought',
												'bearish_close',
												'foreign_distribution',
												'downtrend_structure',
												'volume_distribution',
											]))
											<span class="badge badge-soft badge-error text-xs">{{ $tags }}</span>
										@elseif(in_array($tags, [
												'uptrend_intact',
												'pullback_to_support',
												'volume_dry_up',
												'rsi_neutral_pullback',
												'foreign_holding_trough_dip',
											]))
											<span class="badge badge-soft badge-neutral text-xs">{{ $tags }}</span>
										@endif
									@empty
										<span class="text-xs text-gray-500">No tags available</span>
									@endforelse
								</div>
							</td>
						</tr>
					@empty
						<tr>
							<td colspan="8" class="text-center text-base-content/50 py-8">Tidak ada data stock indicator</td>
						</tr>
					@endforelse
				</tbody>
			</table>
		</div>
	</div>
	<div class="mt-4">
		{{ $stock_indicators->links() }}
	</div>
@endsection
