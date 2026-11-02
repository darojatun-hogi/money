@extends('legal.layout')

@section('title', 'Syarat & Ketentuan')
@section('description', 'Syarat dan ketentuan penggunaan Elips Money.')
@section('updated', '2 November 2026')

@section('content')
	@php($email = config('app.contact_email'))

	<p>Syarat & Ketentuan ini mengatur penggunaanmu atas Elips Money ("Elips", "kami", "layanan") di <a href="{{ url('/') }}">{{ url('/') }}</a>. Dengan membuat akun atau memakai layanan, kamu menyetujui syarat ini. Jika tidak setuju, mohon jangan memakai Elips.</p>

	<h2 id="layanan">1. Tentang layanan</h2>
	<p>Elips adalah aplikasi untuk mencatat dompet, pemasukan, pengeluaran, dan transfer antar dompet, serta melihat ringkasannya. Elips hanya alat pencatatan: kami tidak menyimpan, memindahkan, atau mengelola uang sungguhan, dan tidak terhubung ke bank atau penyedia pembayaran mana pun.</p>

	<h2 id="akun">2. Akun</h2>
	<ul>
		<li>Kamu harus berusia minimal 13 tahun untuk memakai Elips.</li>
		<li>Berikan informasi yang benar saat mendaftar, dan jaga kerahasiaan kata sandi serta token API-mu.</li>
		<li>Kamu bertanggung jawab atas semua aktivitas yang terjadi di akunmu. Beri tahu kami segera jika menduga akunmu disalahgunakan.</li>
		<li>Akun Elips dapat dipakai di aplikasi Elips lain melalui login terpusat; syarat ini berlaku untuk pemakaian Money.</li>
	</ul>

	<h2 id="penggunaan">3. Penggunaan yang dilarang</h2>
	<p>Kamu setuju untuk tidak:</p>
	<ul>
		<li>Memakai Elips untuk kegiatan yang melanggar hukum, termasuk pencucian uang atau penipuan.</li>
		<li>Mencoba mengakses akun atau data pengguna lain tanpa izin.</li>
		<li>Mengganggu, membebani, atau mencoba membobol sistem kami, termasuk lewat API secara berlebihan.</li>
		<li>Menyalin, menjual ulang, atau merekayasa balik layanan tanpa izin tertulis dari kami.</li>
	</ul>

	<h2 id="data">4. Datamu</h2>
	<p>Data keuangan yang kamu catat tetap milikmu. Kamu memberi kami izin terbatas untuk menyimpan dan memprosesnya hanya demi menjalankan layanan. Cara kami menangani data dijelaskan di <a href="{{ route('privacy') }}">Kebijakan Privasi</a>.</p>

	<h2 id="bukan-nasihat">5. Bukan nasihat keuangan</h2>
	<p>Ringkasan, grafik, dan angka di Elips hanya untuk membantumu memahami catatanmu sendiri. Itu bukan nasihat keuangan, investasi, pajak, atau hukum. Keputusan keuangan sepenuhnya tanggung jawabmu.</p>

	<h2 id="ketersediaan">6. Ketersediaan layanan</h2>
	<p>Kami berupaya menjaga Elips tetap tersedia dan akurat, tetapi layanan diberikan "sebagaimana adanya" tanpa jaminan bebas gangguan atau bebas kesalahan. Kami dapat mengubah, menambah, atau menghentikan fitur kapan saja. Sebaiknya simpan cadangan untuk catatan yang penting bagimu.</p>

	<h2 id="tanggung-jawab">7. Batasan tanggung jawab</h2>
	<p>Sejauh diizinkan hukum, Elips tidak bertanggung jawab atas kerugian tidak langsung, kehilangan data, atau kerugian finansial yang timbul dari pemakaian atau ketidakmampuan memakai layanan, termasuk akibat kesalahan pencatatan.</p>

	<h2 id="penghentian">8. Penghentian</h2>
	<p>Kamu dapat berhenti memakai Elips dan meminta penghapusan akun kapan saja dengan menghubungi kami. Kami dapat menangguhkan atau menutup akun yang melanggar syarat ini.</p>

	<h2 id="perubahan">9. Perubahan syarat</h2>
	<p>Kami dapat memperbarui syarat ini. Tanggal "Terakhir diperbarui" di atas akan ikut berubah, dan dengan tetap memakai Elips setelah perubahan, kamu dianggap menyetujui syarat yang baru.</p>

	<h2 id="hukum">10. Hukum yang berlaku</h2>
	<p>Syarat ini tunduk pada hukum Republik Indonesia.</p>

	<h2 id="kontak">11. Hubungi kami</h2>
	<p>Pertanyaan tentang syarat ini dapat dikirim ke <a href="mailto:{{ $email }}">{{ $email }}</a>.</p>
@endsection
