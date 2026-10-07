@extends('template.auth-master')

@section('title', 'Masuk | Elips')

@section('content')
	<div class="card bg-base-100 shadow-xl border border-base-300">
		<div class="card-body gap-5">

			{{-- Header --}}
			<div class="text-center space-y-2">
				<div class="flex justify-center">
					<div class="w-16 h-16 rounded-full bg-primary/15 flex items-center justify-center">
						<span class="icon-[tabler--user] text-primary text-4xl"></span>
					</div>
				</div>
				<h1 class="text-2xl font-bold text-base-content">Masuk ke Elips</h1>
				<p class="text-base-content/60 text-sm">Lanjutkan mencatat dan memahami keuanganmu.</p>
			</div>

			{{-- Form --}}
			<form method="POST" action="{{ route('login') }}" class="space-y-4">
				@csrf

				{{-- Email atau nama pengguna --}}
				<div class="form-control gap-1.5">
					<label class="label pb-0" for="username">
						<span class="label-text font-medium text-base-content">Email atau nama pengguna</span>
					</label>
					<label
						class="input input-bordered w-full flex items-center gap-2 @error('username') input-error @enderror focus-within:input-primary">
						<span class="icon-[tabler--user] text-base-content/40"></span>
						<input id="username" type="text" name="username" value="{{ old('username') }}"
							placeholder="Email atau nama pengguna"
							class="grow bg-transparent outline-none text-base-content placeholder:text-base-content/30" autofocus
							autocomplete="username" />
					</label>
					@error('username')
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
							autocomplete="current-password" />
					</label>
					@error('password')
						<span class="text-error text-xs">{{ $message }}</span>
					@enderror
				</div>

				{{-- Ingat saya dan lupa kata sandi --}}
				<div class="flex items-center justify-between">
					<label class="flex items-center gap-2 cursor-pointer">
						<input type="checkbox" name="remember" class="checkbox checkbox-primary checkbox-sm" />
						<span class="text-sm text-base-content/70">Ingat saya</span>
					</label>
					<a href="{{ route('password.request') }}" class="text-sm text-primary hover:underline">
						Lupa kata sandi?
					</a>
				</div>

				{{-- Kirim --}}
				<button type="submit" class="btn btn-primary w-full mt-2">
					Masuk
				</button>
			</form>

			{{-- Divider --}}
			<div class="divider text-base-content/30 text-xs my-1">atau</div>

			{{-- Register Link --}}
			<p class="text-center text-sm text-base-content/60">
				Belum punya akun?
				@if (Route::has('register'))
					<a href="{{ route('register') }}" class="text-primary font-semibold hover:underline">Buat akun</a>
				@endif
			</p>

		</div>
	</div>
@endsection
