<!DOCTYPE html>
<html lang="id">

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>@yield('title') | Elips</title>
		<link rel="canonical" href="{{ rtrim(config('app.url'), '/').'/'.ltrim(request()->path(), '/') }}">
		<meta name="description" content="@yield('description')">
		<script>
			document.documentElement.setAttribute('data-theme', localStorage.getItem('theme') || 'mintlify');
		</script>
		@vite(['resources/css/app.css', 'resources/js/app.js'])
		<link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
		<style>
			.legal h2 { margin-top: 2.5rem; margin-bottom: 0.75rem; font-size: 1.25rem; font-weight: 600; scroll-margin-top: 5rem; }
			.legal h3 { margin-top: 1.5rem; margin-bottom: 0.5rem; font-weight: 600; }
			.legal p, .legal li { line-height: 1.75; color: color-mix(in oklab, var(--color-base-content) 80%, transparent); }
			.legal p + p { margin-top: 0.75rem; }
			.legal ul { margin-top: 0.5rem; padding-left: 1.25rem; list-style: disc; }
			.legal li + li { margin-top: 0.375rem; }
			.legal a { color: var(--color-primary); text-decoration: underline; text-underline-offset: 2px; }
		</style>
	</head>

	<body class="min-h-screen overflow-x-hidden bg-base-100 text-base-content">
		<header class="sticky top-0 z-50 border-b border-base-content/10 bg-base-100/90 backdrop-blur-md">
			<nav aria-label="Navigasi utama" class="mx-auto flex h-16 max-w-6xl items-center justify-between px-4 sm:px-8">
				<a href="{{ url('/') }}" class="flex items-center gap-2.5">
					<span class="flex size-9 items-center justify-center rounded-xl bg-primary text-primary-content">
						<span class="icon-[tabler--wallet] size-5" aria-hidden="true"></span>
					</span>
					<span class="text-lg font-semibold tracking-tight">Elips</span>
				</a>
				@auth
					<a href="{{ route('dashboard') }}" class="btn btn-primary btn-sm">Dashboard</a>
				@else
					<a href="{{ route('login') }}" class="btn btn-ghost btn-sm">Masuk</a>
				@endauth
			</nav>
		</header>

		<main class="mx-auto max-w-3xl px-4 py-12 sm:px-8 sm:py-16">
			<p class="text-sm font-medium text-primary">Legal</p>
			<h1 class="mt-2 text-3xl font-semibold tracking-tight sm:text-4xl">@yield('title')</h1>
			<p class="mt-3 text-sm text-base-content/60">Terakhir diperbarui: @yield('updated')</p>

			<article class="legal mt-8">
				@yield('content')
			</article>
		</main>

		<footer class="border-t border-base-content/10 bg-base-100">
			<div class="mx-auto flex max-w-6xl flex-wrap items-center justify-between gap-3 px-4 py-5 text-xs text-base-content/70 sm:px-8 sm:text-sm">
				<a href="{{ url('/') }}" class="font-semibold text-base-content">Elips</a>
				<div class="flex items-center gap-3 sm:gap-5">
					<a href="{{ route('privacy') }}" class="whitespace-nowrap hover:text-base-content">Privasi</a>
					<a href="{{ route('terms') }}" class="whitespace-nowrap hover:text-base-content">Syarat</a>
					<span class="whitespace-nowrap">&copy; {{ date('Y') }}</span>
				</div>
			</div>
		</footer>
	</body>

</html>
