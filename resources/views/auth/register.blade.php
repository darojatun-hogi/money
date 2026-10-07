@extends('template.auth-master')

@section('title', 'Daftar | Elips')

@section('content')
	<div class="card bg-base-100 shadow-xl border border-base-300">
		<div class="card-body gap-5">

			{{-- Header --}}
			<div class="text-center space-y-2">
				<div class="flex justify-center">
					<div class="w-16 h-16 rounded-full bg-primary/15 flex items-center justify-center">
						<span class="icon-[tabler--user-plus] text-primary text-4xl"></span>
					</div>
				</div>
				<h1 class="text-2xl font-bold text-base-content">Buat akun Elips</h1>
				<p class="text-base-content/60 text-sm">Mulai catat keuanganmu dengan lebih teratur.</p>
			</div>

			{{-- Form --}}
			<form method="POST" action="{{ route('register') }}" class="space-y-4">
				@csrf

				{{-- Nama lengkap --}}
				<div class="form-control gap-1.5">
					<label class="label pb-0" for="name">
						<span class="label-text font-medium text-base-content">Nama lengkap</span>
					</label>
					<label
						class="input input-bordered w-full flex items-center gap-2 @error('name') input-error @enderror focus-within:input-primary">
						<span class="icon-[tabler--user] text-base-content/40"></span>
						<input id="name" type="text" name="name" value="{{ old('name') }}" placeholder="Nama lengkap"
							class="grow bg-transparent outline-none text-base-content placeholder:text-base-content/30" autofocus
							autocomplete="name" />
					</label>
					@error('name')
						<span class="text-error text-xs">{{ $message }}</span>
					@enderror
				</div>

				{{-- Nama pengguna --}}
				<div class="form-control gap-1.5">
					<label class="label pb-0" for="username">
						<span class="label-text font-medium text-base-content">Nama pengguna</span>
					</label>
					<label
						class="input input-bordered w-full flex items-center gap-2 @error('username') input-error @enderror focus-within:input-primary">
						<span class="icon-[tabler--user] text-base-content/40"></span>
						<input id="username" type="text" name="username" value="{{ old('username') }}" placeholder="Nama pengguna"
							class="grow bg-transparent outline-none text-base-content placeholder:text-base-content/30"
							autocomplete="username" />
					</label>
					@error('username')
						<span class="text-error text-xs">{{ $message }}</span>
					@enderror
				</div>

				{{-- Email --}}
				<div class="form-control gap-1.5">
					<label class="label pb-0" for="email">
						<span class="label-text font-medium text-base-content">Alamat email</span>
					</label>
					<label
						class="input input-bordered w-full flex items-center gap-2 @error('email') input-error @enderror focus-within:input-primary">
						<span class="icon-[tabler--mail] text-base-content/40"></span>
						<input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="example@email.com"
							class="grow bg-transparent outline-none text-base-content placeholder:text-base-content/30"
							autocomplete="email" />
					</label>
					@error('email')
						<span class="text-error text-xs">{{ $message }}</span>
					@enderror
				</div>

				{{-- Kata sandi --}}
				<div class="form-control gap-1.5">
					<label class="label pb-0" for="password">
						<span class="label-text font-medium text-base-content">Kata sandi</span>
					</label>
					<label
						class="input input-bordered w-full flex items-center gap-2 @error('password') input-error @enderror focus-within:input-primary">
						<span class="icon-[tabler--lock] text-base-content/40"></span>
						<input id="password" type="password" name="password" placeholder="••••••••"
							class="grow bg-transparent outline-none text-base-content placeholder:text-base-content/30"
							autocomplete="new-password" />
					</label>
					@error('password')
						<span class="text-error text-xs">{{ $message }}</span>
					@enderror
				</div>

				{{-- Konfirmasi kata sandi --}}
				<div class="form-control gap-1.5">
					<label class="label pb-0" for="password_confirmation">
						<span class="label-text font-medium text-base-content">Konfirmasi kata sandi</span>
					</label>
					<label class="input input-bordered w-full flex items-center gap-2 focus-within:input-primary">
						<span class="icon-[tabler--lock] text-base-content/40"></span>
						<input id="password_confirmation" type="password" name="password_confirmation" placeholder="••••••••"
							class="grow bg-transparent outline-none text-base-content placeholder:text-base-content/30"
							autocomplete="new-password" />
					</label>
				</div>

				{{-- Turnstile --}}
				<div>
					<div class="cf-turnstile" data-sitekey="{{ config('services.turnstile.site_key') }}"></div>
					@error('cf-turnstile-response')
						<span class="text-error text-xs mt-1 block">{{ $message }}</span>
					@enderror
				</div>

				{{-- Kirim --}}
				<button type="submit" class="btn btn-primary w-full mt-2">
					Buat akun
				</button>
			</form>

			{{-- Divider --}}
			<div class="divider text-base-content/30 text-xs my-1">atau</div>

			{{-- Login Link --}}
			<p class="text-center text-sm text-base-content/60">
				Sudah punya akun?
				@if (Route::has('login'))
					<a href="{{ route('login') }}" class="text-primary font-semibold hover:underline">Masuk</a>
				@endif
			</p>

		</div>
	</div>
@endsection
