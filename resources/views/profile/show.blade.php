@extends('template.master')

@section('content')
	<header class="mb-5">
		<h1 class="text-2xl font-semibold tracking-tight">Profil</h1>
		<p class="mt-1 text-sm text-base-content/70">Kelola informasi akun dan akses API kamu.</p>
	</header>

	@if (session('api_token'))
		<div id="token-alert" class="alert alert-success mb-5 flex min-w-0 items-start gap-3 rounded-lg">
			<span class="icon-[tabler--circle-check] mt-0.5 size-5 shrink-0" aria-hidden="true"></span>
			<div class="min-w-0 flex-1">
				<p class="mb-2 text-sm font-semibold">Token API {{ session('success') ? 'diatur ulang' : 'dibuat' }}. Salin sekarang karena token ini tidak akan ditampilkan lagi.</p>
				<div class="flex min-w-0 items-start gap-2 sm:items-center">
					<code id="plain-token" class="min-w-0 flex-1 break-all rounded bg-black/10 px-2 py-1 text-xs font-mono">{{ session('api_token') }}</code>
					<button type="button" onclick="copyToken()" class="btn btn-ghost btn-sm min-h-10 shrink-0" aria-label="Salin token API">
						<span class="icon-[tabler--copy] size-4" aria-hidden="true"></span>
					</button>
				</div>
			</div>
		</div>
	@endif

	<div class="grid grid-cols-1 gap-4 lg:grid-cols-3 xl:gap-6">
		<section aria-label="Ringkasan profil" class="flex min-w-0 flex-col items-center justify-center gap-3 rounded-lg border border-base-content/15 bg-base-100 p-5 text-center sm:p-6 lg:col-span-1">
			<div class="avatar avatar-placeholder">
				<div class="flex size-20 items-center justify-center rounded-full bg-primary/15 text-primary">
					<span class="text-3xl font-bold">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
				</div>
			</div>
			<div class="min-w-0 max-w-full">
				<p class="break-words text-lg font-semibold">{{ $user->name }}</p>
				<p class="mt-1 break-all text-sm text-base-content/70">&#64;{{ $user->username }}</p>
				<p class="break-all text-sm text-base-content/70">{{ $user->email }}</p>
			</div>
			@if ($user->roles->isNotEmpty())
				<div class="flex flex-wrap justify-center gap-1.5">
					@foreach ($user->roles as $role)
						<span class="badge badge-primary badge-soft rounded-sm text-xs">{{ ucfirst($role->name) }}</span>
					@endforeach
				</div>
			@endif
		</section>

		<section aria-labelledby="profile-form-title" class="min-w-0 rounded-lg border border-base-content/15 bg-base-100 p-5 sm:p-6 lg:col-span-2">
			<h2 id="profile-form-title" class="mb-5 text-base font-semibold">Informasi akun</h2>
			<form action="{{ route('profile.update') }}" method="POST">
				@csrf
				@method('PUT')
				<div class="mb-6 grid grid-cols-1 gap-4 md:grid-cols-2">
					<div class="min-w-0">
						<label class="label mb-1 text-sm font-medium" for="name">Nama lengkap</label>
						<input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" class="input input-bordered w-full rounded-sm @error('name') input-error @enderror" autocomplete="name">
						@error('name') <p class="mt-1 text-xs text-error">{{ $message }}</p> @enderror
					</div>
					<div class="min-w-0">
						<label class="label mb-1 text-sm font-medium" for="username">Nama pengguna</label>
						<input type="text" id="username" name="username" value="{{ old('username', $user->username) }}" class="input input-bordered w-full rounded-sm @error('username') input-error @enderror" autocomplete="username">
						@error('username') <p class="mt-1 text-xs text-error">{{ $message }}</p> @enderror
					</div>
					<div class="min-w-0 md:col-span-2">
						<label class="label mb-1 text-sm font-medium" for="email">Alamat email</label>
						<input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" class="input input-bordered w-full rounded-sm @error('email') input-error @enderror" autocomplete="email">
						@error('email') <p class="mt-1 text-xs text-error">{{ $message }}</p> @enderror
					</div>
				</div>

				<div class="divider text-xs text-base-content/60">Ganti kata sandi</div>

				<div class="mb-6 grid grid-cols-1 gap-4 md:grid-cols-2">
					<div class="min-w-0">
						<label class="label mb-1 text-sm font-medium" for="password">Kata sandi baru</label>
						<input type="password" id="password" name="password" class="input input-bordered w-full rounded-sm @error('password') input-error @enderror" autocomplete="new-password" aria-describedby="password-help">
						<p id="password-help" class="mt-1 text-xs text-base-content/70">Kosongkan jika tidak ingin menggantinya.</p>
						@error('password') <p class="mt-1 text-xs text-error">{{ $message }}</p> @enderror
					</div>
					<div class="min-w-0">
						<label class="label mb-1 text-sm font-medium" for="password_confirmation">Konfirmasi kata sandi</label>
						<input type="password" id="password_confirmation" name="password_confirmation" class="input input-bordered w-full rounded-sm" autocomplete="new-password">
					</div>
				</div>

				<div class="flex justify-end">
					<button type="submit" class="btn btn-primary min-h-11 w-full rounded-sm sm:w-auto">
						<span class="icon-[tabler--device-floppy] size-5" aria-hidden="true"></span>
						Simpan perubahan
					</button>
				</div>
			</form>
		</section>
	</div>

	<section aria-labelledby="api-token-title" class="mt-4 min-w-0 rounded-lg border border-base-content/15 bg-base-100 p-5 sm:mt-6 sm:p-6">
		<div class="flex flex-col gap-3 sm:flex-row sm:items-start sm:justify-between">
			<div class="min-w-0">
				<h2 id="api-token-title" class="text-base font-semibold">Token API</h2>
				<p class="mt-1 text-sm text-base-content/70">Gunakan token ini untuk mengautentikasi permintaan ke API.</p>
			</div>
			@if ($hasToken)
				<span class="badge badge-success badge-soft hidden shrink-0 rounded-sm text-xs sm:inline-flex">Aktif</span>
			@else
				<span class="badge badge-neutral badge-soft hidden shrink-0 rounded-sm text-xs sm:inline-flex">Belum dibuat</span>
			@endif
		</div>

		<div class="mt-4 rounded-sm bg-base-200 px-4 py-3 text-sm text-base-content/70">
			@if ($hasToken)
				Token API aktif. Atur ulang jika kamu perlu membuat token baru.
			@else
				Kamu belum membuat token API.
			@endif
		</div>

		<div class="mt-4 grid grid-cols-1 gap-2 sm:flex sm:flex-wrap">
			@if (!$hasToken)
				<form action="{{ route('api-token.generate') }}" method="POST">
					@csrf
					<button type="submit" class="btn btn-primary btn-sm min-h-10 w-full rounded-sm sm:w-auto">
						<span class="icon-[tabler--key] size-4" aria-hidden="true"></span>Buat token
					</button>
				</form>
			@else
				<form action="{{ route('api-token.reset') }}" method="POST">
					@csrf
					<button type="submit" class="btn btn-warning btn-sm min-h-10 w-full rounded-sm sm:w-auto">
						<span class="icon-[tabler--refresh] size-4" aria-hidden="true"></span>Atur ulang token
					</button>
				</form>
				<form action="{{ route('api-token.revoke') }}" method="POST">
					@csrf
					@method('DELETE')
					<button type="submit" class="btn btn-error btn-sm min-h-10 w-full rounded-sm sm:w-auto" onclick="return confirm('Cabut token API? Akses API akan dinonaktifkan.')">
						<span class="icon-[tabler--trash] size-4" aria-hidden="true"></span>Cabut token
					</button>
				</form>
			@endif
		</div>

		<div class="mt-6 border-t border-base-content/10 pt-4">
			<h3 class="mb-3 text-sm font-semibold">Endpoint API</h3>
			<ul class="divide-y divide-base-content/10">
				@foreach ([['GET', '/api/user', 'Informasi akun'], ['GET', '/api/wallets', 'Daftar dompet'], ['GET', '/api/categories', 'Daftar kategori'], ['GET', '/api/transactions', 'Daftar transaksi'], ['POST', '/api/transactions', 'Buat transaksi']] as [$method, $path, $label])
					<li class="flex min-w-0 items-start gap-2 py-3 first:pt-0 sm:gap-3">
						<span class="badge badge-soft {{ $method === 'GET' ? 'badge-info' : 'badge-success' }} w-fit shrink-0 rounded-sm font-mono text-xs">{{ $method }}</span>
						<div class="min-w-0 flex-1">
							<code class="block break-all text-xs font-mono">{{ config('app.url') }}{{ $path }}</code>
							<p class="mt-1 text-xs text-base-content/70">{{ $label }}</p>
						</div>
					</li>
				@endforeach
			</ul>
		</div>
	</section>
@endsection

@push('scripts')
	<script>
		function copyToken() {
			const tokenElement = document.getElementById('plain-token');
			if (!tokenElement) return;

			navigator.clipboard.writeText(tokenElement.textContent.trim()).then(() => {
				const alert = document.getElementById('token-alert');
				if (alert) {
					const note = document.createElement('p');
					note.className = 'mt-1 text-xs font-medium';
					note.textContent = 'Token disalin.';
					alert.appendChild(note);
					setTimeout(() => note.remove(), 2000);
				}
			});
		}
	</script>
@endpush
