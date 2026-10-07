<!DOCTYPE html>
<html lang="id">

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Beranda | Elips</title>
		<script>
			document.documentElement.setAttribute('data-theme', localStorage.getItem('theme') || 'mintlify');
		</script>
		@vite(['resources/css/app.css', 'resources/js/app.js'])
		<link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
		<style>
			a:focus-visible,
			button:focus-visible {
				outline: 2px solid currentColor;
				outline-offset: 3px;
			}
		</style>
	</head>

	<body class="min-h-screen overflow-x-hidden bg-base-100 text-base-content">
		<header class="sticky top-0 z-50 border-b border-base-content/10 bg-base-100/90 backdrop-blur-md">
			<nav aria-label="Navigasi utama" class="mx-auto flex h-16 max-w-6xl items-center justify-between px-4 sm:px-8">
				<a href="{{ url('/') }}" class="flex items-center gap-2.5 rounded-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-4 focus-visible:outline-primary">
					<span class="flex size-9 items-center justify-center rounded-xl bg-primary text-primary-content">
						<span class="icon-[tabler--wallet] size-5" aria-hidden="true"></span>
					</span>
					<span class="text-lg font-semibold tracking-tight">Elips</span>
				</a>

				<div class="hidden items-center gap-7 text-sm sm:flex">
					<a href="#fitur" class="text-base-content/70 transition-colors hover:text-base-content focus-visible:outline focus-visible:outline-2 focus-visible:outline-primary">Fitur</a>
					<a href="#cara-kerja" class="text-base-content/70 transition-colors hover:text-base-content focus-visible:outline focus-visible:outline-2 focus-visible:outline-primary">Cara kerja</a>
				</div>

				<div class="flex items-center gap-1 sm:gap-2">
					<div class="dropdown relative inline-flex [--auto-close:inside] [--offset:8] [--placement:bottom-end]">
						<button type="button" class="dropdown-toggle btn btn-text btn-circle size-10 text-base-content/70 hover:text-base-content" aria-label="Pilih tema warna" aria-haspopup="menu" aria-expanded="false">
							<span class="icon-[tabler--palette] size-5" aria-hidden="true"></span>
						</button>
						<div class="dropdown-menu dropdown-open:opacity-100 hidden w-64 p-3" role="menu">
							<div class="dropdown-header"><h2 class="text-sm font-semibold">Pilih tema</h2></div>
							<div class="mt-1 grid max-h-60 grid-cols-3 gap-1.5 overflow-y-auto p-0.5">
								@foreach ([['light', 'Light'], ['dark', 'Dark'], ['claude', 'Claude'], ['corporate', 'Corporate'], ['ghibli', 'Ghibli'], ['gourmet', 'Gourmet'], ['luxury', 'Luxury'], ['mintlify', 'Mintlify'], ['pastel', 'Pastel'], ['perplexity', 'Perplexity'], ['shadcn', 'Shadcn'], ['slack', 'Slack'], ['soft', 'Soft'], ['spotify', 'Spotify'], ['valorant', 'Valorant'], ['vscode', 'VS Code']] as [$id, $label])
									<button type="button" role="menuitem" onclick="setTheme('{{ $id }}')" data-theme-option="{{ $id }}" class="theme-option flex min-w-0 flex-col items-start gap-1 rounded-md border border-base-content/10 p-2 text-left transition hover:border-primary hover:bg-base-200 focus-visible:outline focus-visible:outline-2 focus-visible:outline-primary">
										<span class="flex gap-1" data-theme="{{ $id }}" aria-hidden="true">
											<span class="size-3 rounded-full bg-primary"></span>
											<span class="size-3 rounded-full bg-secondary"></span>
											<span class="size-3 rounded-full bg-accent"></span>
										</span>
										<span class="w-full truncate text-xs font-medium">{{ $label }}</span>
									</button>
								@endforeach
							</div>
						</div>
					</div>
					<a href="{{ route('login') }}" class="btn btn-ghost btn-sm hidden sm:inline-flex">Masuk</a>
					<a href="{{ route('register') }}" class="btn btn-primary btn-sm">Buat akun</a>
				</div>
			</nav>
		</header>

		<main>
			<section class="relative isolate overflow-hidden bg-gradient-to-b from-primary/10 via-base-100 to-base-200/50">
				<div class="pointer-events-none absolute inset-0 overflow-hidden" aria-hidden="true">
					<div class="absolute -right-16 top-10 size-48 rounded-full bg-warning/20 blur-2xl sm:right-[12%] sm:size-64"></div>
					<div class="absolute -bottom-16 -left-20 h-48 w-[70%] rounded-[50%] bg-primary/10"></div>
					<div class="absolute -bottom-24 -right-12 h-56 w-[65%] rounded-[50%] bg-secondary/15"></div>
				</div>

				<div class="relative mx-auto grid min-h-[calc(100svh-4rem)] w-full max-w-6xl grid-cols-1 items-center gap-8 px-4 py-12 sm:px-8 sm:py-16 lg:grid-cols-[0.9fr_1.1fr] lg:gap-8 lg:py-14">
					<div class="w-full min-w-0 space-y-5 sm:space-y-6">
						<p class="inline-flex items-center gap-2 rounded-full border border-primary/20 bg-base-100/70 px-3 py-1.5 text-sm font-medium text-primary">
							<span class="size-2 rounded-full bg-warning" aria-hidden="true"></span>
							Keuangan sehari-hari, terasa lebih ringan
						</p>
						<h1 class="max-w-xl text-4xl font-semibold leading-[1.08] tracking-tight sm:text-5xl lg:text-6xl">
							Pelan-pelan, pahami ke mana uangmu pergi.
						</h1>
						<p class="max-w-lg text-base leading-relaxed text-base-content/70 sm:text-lg">
							Catat pemasukan, pengeluaran, dan perpindahan antar dompet. Lihat saldo dan ringkasanmu dengan lebih jelas, tanpa membuat semuanya terasa rumit.
						</p>
						<div class="flex flex-col items-stretch gap-2.5 pt-1 sm:flex-row sm:items-center sm:gap-3">
							<a href="{{ route('register') }}" class="btn btn-primary btn-lg min-h-12 w-full justify-center whitespace-nowrap rounded-full px-6 sm:w-auto">Mulai mencatat</a>
							<a href="{{ route('login') }}" class="btn btn-ghost btn-lg min-h-12 w-full justify-center whitespace-nowrap rounded-full px-6 sm:w-auto">Masuk ke akun</a>
						</div>
					</div>

					<figure class="relative mx-auto flex w-full max-w-md items-center justify-center lg:max-w-none">
						<div class="pointer-events-none absolute inset-x-[8%] bottom-[8%] h-1/3 rounded-[50%] bg-primary/15 blur-xl" aria-hidden="true"></div>
						<img src="{{ asset('images/hero-illustration.png') }}" alt="Anak muda duduk di padang rumput sambil mencatat keuangan" class="relative h-auto w-full max-w-[34rem] object-contain drop-shadow-sm">
					</figure>
				</div>
			</section>

			<section id="fitur" class="scroll-mt-20 border-y border-base-content/10 bg-base-100">
				<div class="mx-auto grid max-w-6xl gap-8 px-4 py-14 sm:px-8 sm:py-16 lg:grid-cols-[0.8fr_1.2fr] lg:gap-16 lg:py-20">
					<div class="max-w-sm space-y-4">
						<p class="text-sm font-medium text-primary">Ruang kecil untuk kebiasaan baik</p>
						<h2 class="text-3xl font-semibold leading-tight sm:text-4xl">Catatan rapi, tanpa banyak langkah.</h2>
						<p class="leading-relaxed text-base-content/70">Mulai dari yang sederhana. Tambahkan dompet, catat transaksi, lalu lihat gambaran uangmu dari waktu ke waktu.</p>
					</div>
					<ul class="divide-y divide-base-content/10 border-y border-base-content/10">
						<li class="grid gap-2 py-5 first:pt-5 sm:grid-cols-[10rem_1fr] sm:gap-5">
							<h3 class="font-semibold">Dompet dan saldo</h3>
							<p class="text-sm leading-relaxed text-base-content/70">Pisahkan uang tunai, rekening, dan e-wallet dalam dompet pribadi.</p>
						</li>
						<li class="grid gap-2 py-5 sm:grid-cols-[10rem_1fr] sm:gap-5">
							<h3 class="font-semibold">Catatan transaksi</h3>
							<p class="text-sm leading-relaxed text-base-content/70">Catat uang masuk, uang keluar, atau perpindahan saldo antar dompet.</p>
						</li>
						<li class="grid gap-2 py-5 sm:grid-cols-[10rem_1fr] sm:gap-5">
							<h3 class="font-semibold">Kategori dan ringkasan</h3>
							<p class="text-sm leading-relaxed text-base-content/70">Kelompokkan transaksi, lalu lihat ringkasan dan grafik di dashboard.</p>
						</li>
					</ul>
				</div>
			</section>

			<section id="cara-kerja" class="scroll-mt-20 relative overflow-hidden bg-base-200/40">
				<div class="mx-auto max-w-6xl px-4 py-14 sm:px-8 sm:py-16 lg:py-20">
					<div class="mb-8 max-w-xl space-y-3 sm:mb-10">
						<p class="text-sm font-medium text-primary">Mulai dari sini</p>
						<h2 class="text-3xl font-semibold sm:text-4xl">Satu langkah kecil dalam satu waktu.</h2>
					</div>
					<ol class="grid gap-0 border-y border-base-content/10 sm:grid-cols-3 sm:divide-x sm:divide-base-content/10">
						<li class="grid grid-cols-[2.75rem_1fr] gap-x-3 border-b border-base-content/10 py-5 last:border-b-0 sm:block sm:border-b-0 sm:px-5 sm:py-6 sm:first:pl-0 sm:last:pr-0">
							<span class="row-span-2 flex size-10 items-center justify-center rounded-full bg-primary/10 text-sm font-semibold tabular-nums text-primary sm:mb-4">01</span>
							<h3 class="self-end font-semibold">Buat akun</h3>
							<p class="text-sm leading-relaxed text-base-content/70 sm:mt-2">Daftar untuk mulai menggunakan Elips.</p>
						</li>
						<li class="grid grid-cols-[2.75rem_1fr] gap-x-3 border-b border-base-content/10 py-5 last:border-b-0 sm:block sm:border-b-0 sm:px-5 sm:py-6">
							<span class="row-span-2 flex size-10 items-center justify-center rounded-full bg-primary/10 text-sm font-semibold tabular-nums text-primary sm:mb-4">02</span>
							<h3 class="self-end font-semibold">Tambahkan dompet</h3>
							<p class="text-sm leading-relaxed text-base-content/70 sm:mt-2">Pilih tempat untuk mencatat uangmu.</p>
						</li>
						<li class="grid grid-cols-[2.75rem_1fr] gap-x-3 py-5 sm:block sm:px-5 sm:py-6 sm:first:pl-0">
							<span class="row-span-2 flex size-10 items-center justify-center rounded-full bg-primary/10 text-sm font-semibold tabular-nums text-primary sm:mb-4">03</span>
							<h3 class="self-end font-semibold">Catat transaksi</h3>
							<p class="text-sm leading-relaxed text-base-content/70 sm:mt-2">Lihat perubahan saldo dan ringkasanmu.</p>
						</li>
					</ol>
				</div>
			</section>

			<section class="border-t border-base-content/10 bg-base-100">
				<div class="mx-auto flex max-w-6xl flex-col items-start gap-5 px-4 py-12 sm:px-8 sm:py-14 md:flex-row md:items-center md:justify-between">
					<div class="max-w-xl space-y-2">
						<h2 class="text-2xl font-semibold sm:text-3xl">Mulai dari satu transaksi.</h2>
						<p class="text-base-content/70">Buat akun, tambahkan dompet, lalu catat pemasukan atau pengeluaran pertamamu.</p>
					</div>
					<a href="{{ route('register') }}" class="btn btn-primary min-h-11 w-full shrink-0 rounded-full px-6 md:w-auto">Buat akun</a>
				</div>
			</section>
		</main>

		<footer class="border-t border-base-content/10 bg-base-100">
			<div class="mx-auto flex max-w-6xl flex-row items-center justify-between gap-3 px-4 py-5 text-xs text-base-content/70 sm:px-8 sm:text-sm">
				<a href="{{ url('/') }}" class="shrink-0 font-semibold text-base-content">Elips</a>
				<div class="flex items-center gap-3 sm:gap-5">
					<a href="{{ route('login') }}" class="whitespace-nowrap hover:text-base-content">Masuk</a>
					<a href="{{ route('register') }}" class="whitespace-nowrap hover:text-base-content">Buat akun</a>
					<span class="whitespace-nowrap">&copy; {{ date('Y') }}</span>
				</div>
			</div>
		</footer>
	</body>

</html>
