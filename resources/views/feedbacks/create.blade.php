@extends('template.master')

@section('content')
	<header class="mx-auto mb-5 w-full max-w-xl">
		<h1 class="text-2xl font-semibold tracking-tight">Kritik &amp; saran</h1>
		<p class="mt-1 text-sm text-base-content/70">Bagikan kendala atau ide untuk membantu Elips jadi lebih nyaman digunakan.</p>
	</header>

	<section aria-label="Formulir kritik dan saran" class="mx-auto w-full max-w-xl rounded-lg border border-base-content/15 bg-base-100 p-4 sm:p-6">
		<form action="{{ route('feedbacks.store') }}" method="POST" class="space-y-5">
			@csrf

			<div>
				<label class="label mb-1 text-sm font-medium" for="type">Jenis masukan</label>
				<select id="type" name="type" aria-describedby="type-help" class="select select-bordered h-11 w-full rounded-sm @error('type') select-error @enderror">
					<option value="">Pilih jenis masukan</option>
					<option value="kritik" {{ old('type') === 'kritik' ? 'selected' : '' }}>Kritik — laporkan kendala</option>
					<option value="saran" {{ old('type') === 'saran' ? 'selected' : '' }}>Saran — bagikan ide</option>
				</select>
				<p id="type-help" class="mt-1 text-xs text-base-content/70">Pilih kritik untuk hal yang perlu diperbaiki atau saran untuk ide baru.</p>
				@error('type')
					<p class="mt-1 text-xs text-error">{{ $message }}</p>
				@enderror
			</div>

			<div>
				<label class="label mb-1 text-sm font-medium" for="title">Judul</label>
				<input type="text" id="title" name="title" value="{{ old('title') }}" maxlength="255" class="input input-bordered h-11 w-full rounded-sm @error('title') input-error @enderror" placeholder="Contoh: Filter kategori sulit ditemukan">
				@error('title')
					<p class="mt-1 text-xs text-error">{{ $message }}</p>
				@enderror
			</div>

			<div>
				<label class="label mb-1 text-sm font-medium" for="message">Ceritakan masukanmu</label>
				<textarea id="message" name="message" rows="6" maxlength="2000" aria-describedby="message-help message-count" class="textarea textarea-bordered min-h-36 w-full resize-y rounded-sm @error('message') textarea-error @enderror" placeholder="Apa yang terjadi atau ide apa yang ingin kamu bagikan?">{{ old('message') }}</textarea>
				<div class="mt-1 flex items-start justify-between gap-3">
					<p id="message-help" class="text-xs text-base-content/70">Hindari menyertakan kata sandi atau informasi pribadi.</p>
					<p id="message-count" class="shrink-0 text-xs tabular-nums text-base-content/60" aria-live="polite">0/2.000 karakter</p>
				</div>
				@error('message')
					<p class="mt-1 text-xs text-error">{{ $message }}</p>
				@enderror
			</div>

			<div class="flex justify-end border-t border-base-content/10 pt-4">
				<button type="submit" class="btn btn-primary min-h-11 w-full rounded-sm sm:w-auto">
					<span class="icon-[tabler--send] size-5" aria-hidden="true"></span>
					Kirim masukan
				</button>
			</div>
		</form>
	</section>
@endsection

@push('scripts')
	<script>
		document.addEventListener('DOMContentLoaded', function() {
			const message = document.getElementById('message');
			const counter = document.getElementById('message-count');
			if (!message || !counter) return;

			const updateMessageCount = () => {
				counter.textContent = `${message.value.length.toLocaleString('id-ID')}/2.000 karakter`;
			};

			message.addEventListener('input', updateMessageCount);
			updateMessageCount();
		});
	</script>
@endpush
