@extends('legal.layout')

@section('title', 'Kebijakan Privasi')
@section('description', 'Bagaimana Elips Money mengumpulkan, menggunakan, dan melindungi data pribadimu.')
@section('updated', '2 November 2026')

@section('content')
	@php($email = config('app.contact_email'))

	<p>Kebijakan Privasi ini menjelaskan bagaimana Elips Money ("Elips", "kami") di <a href="{{ url('/') }}">{{ url('/') }}</a> mengumpulkan, menggunakan, menyimpan, dan melindungi data pribadimu saat kamu memakai aplikasi pencatatan keuangan kami. Dengan memakai Elips, kamu menyetujui praktik yang dijelaskan di sini.</p>

	<h2 id="data">1. Data yang kami kumpulkan</h2>
	<h3>Data akun</h3>
	<ul>
		<li>Nama, username, dan alamat email yang kamu berikan saat mendaftar.</li>
		<li>Kata sandi, yang hanya disimpan dalam bentuk hash dan tidak pernah dapat kami baca.</li>
		<li>Jika kamu masuk dengan Google, kami menerima nama, alamat email, dan foto profil dari akun Google-mu. Kami tidak meminta akses ke Gmail, Google Drive, kontak, atau data Google lainnya.</li>
	</ul>
	<h3>Data keuangan yang kamu catat</h3>
	<ul>
		<li>Dompet beserta saldonya, transaksi (pemasukan, pengeluaran, transfer), kategori, nama transaksi, tanggal, dan catatan.</li>
		<li>Data ini kamu masukkan sendiri. Elips tidak terhubung ke rekening bank, kartu, atau e-wallet mana pun.</li>
	</ul>
	<h3>Data lain</h3>
	<ul>
		<li>Masukan (feedback) yang kamu kirim lewat aplikasi.</li>
		<li>Token API yang kamu buat sendiri dari halaman profil.</li>
		<li>Data teknis sesi: alamat IP, jenis browser, dan waktu aktivitas terakhir, untuk menjaga keamanan login.</li>
	</ul>

	<h2 id="penggunaan">2. Cara kami menggunakan data</h2>
	<ul>
		<li>Membuat dan mengelola akunmu, termasuk login, verifikasi email, dan reset kata sandi.</li>
		<li>Menampilkan dompet, transaksi, ringkasan, dan grafik keuanganmu.</li>
		<li>Menjaga keamanan layanan, misalnya mendeteksi sesi yang mencurigakan.</li>
		<li>Mengirim email yang berkaitan dengan akun, seperti verifikasi dan reset kata sandi.</li>
		<li>Menanggapi masukan dan memperbaiki layanan.</li>
	</ul>
	<p>Kami <strong>tidak</strong> menjual data pribadimu, tidak memakainya untuk iklan, dan tidak memakainya untuk melatih model kecerdasan buatan.</p>

	<h2 id="google">3. Data pengguna Google</h2>
	<p>Jika kamu memilih masuk dengan Google, Elips hanya memakai cakupan dasar (<code>openid</code>, <code>email</code>, <code>profile</code>) untuk mengenali dan membuat akunmu. Nama, email, dan foto profil itu hanya dipakai untuk login dan menampilkan profilmu di aplikasi, tidak dibagikan ke pihak ketiga, dan tidak dipakai untuk tujuan lain.</p>
	<p>Penggunaan dan pemindahan informasi yang diterima dari Google API oleh Elips mematuhi <a href="https://developers.google.com/terms/api-services-user-data-policy" target="_blank" rel="noopener">Google API Services User Data Policy</a>, termasuk persyaratan Limited Use.</p>

	<h2 id="berbagi">4. Berbagi data</h2>
	<p>Kami hanya membagikan data kepada penyedia layanan yang membantu kami menjalankan Elips, dan hanya sebatas yang mereka perlukan:</p>
	<ul>
		<li>Penyedia hosting dan database (termasuk Supabase) untuk menyimpan data akun dan keuangan.</li>
		<li>Penyedia layanan email untuk mengirim email akun.</li>
		<li>Google, jika kamu memilih masuk dengan Google.</li>
	</ul>
	<p>Kami juga dapat mengungkapkan data jika diwajibkan oleh hukum atau perintah otoritas yang berwenang.</p>

	<h2 id="sso">5. Akun Elips bersama</h2>
	<p>Satu akun Elips dapat dipakai di beberapa aplikasi Elips (misalnya Money dan Clip) melalui login terpusat di auth.elips.id. Data akun (nama, username, email) dipakai bersama untuk login, sedangkan data keuangan di Money hanya dapat diakses dari aplikasi Money.</p>

	<h2 id="cookie">6. Cookie dan penyimpanan lokal</h2>
	<ul>
		<li>Cookie sesi dan CSRF yang diperlukan agar kamu tetap login dan formulir aman.</li>
		<li>Penyimpanan lokal browser untuk mengingat pilihan tema.</li>
	</ul>
	<p>Kami tidak memakai cookie iklan atau pelacak pihak ketiga.</p>

	<h2 id="keamanan">7. Keamanan dan penyimpanan</h2>
	<p>Data dikirim melalui koneksi terenkripsi (HTTPS), kata sandi di-hash, dan akses ke database dibatasi. Data keuangan selalu terikat ke akunmu sehingga pengguna lain tidak dapat melihatnya. Tidak ada sistem yang sepenuhnya aman, tetapi kami berupaya melindungi datamu dengan langkah yang wajar.</p>
	<p>Kami menyimpan data selama akunmu aktif. Jika kamu meminta penghapusan, data akun dan keuanganmu akan dihapus dalam waktu paling lama 30 hari, kecuali yang wajib kami simpan menurut hukum.</p>

	<h2 id="hak">8. Hakmu</h2>
	<ul>
		<li>Melihat dan memperbarui data profil kapan saja dari halaman profil.</li>
		<li>Mengubah atau menghapus dompet, transaksi, dan kategori yang kamu buat.</li>
		<li>Meminta salinan atau penghapusan seluruh datamu dengan menghubungi kami.</li>
		<li>Mencabut akses Elips ke akun Google-mu melalui <a href="https://myaccount.google.com/permissions" target="_blank" rel="noopener">pengaturan izin akun Google</a>.</li>
	</ul>

	<h2 id="anak">9. Anak-anak</h2>
	<p>Elips tidak ditujukan untuk anak di bawah 13 tahun, dan kami tidak dengan sengaja mengumpulkan data mereka.</p>

	<h2 id="perubahan">10. Perubahan kebijakan</h2>
	<p>Kami dapat memperbarui kebijakan ini dari waktu ke waktu. Tanggal "Terakhir diperbarui" di atas akan ikut berubah, dan untuk perubahan penting kami akan memberi tahu lewat aplikasi atau email.</p>

	<h2 id="kontak">11. Hubungi kami</h2>
	<p>Untuk pertanyaan atau permintaan terkait privasi, hubungi <a href="mailto:{{ $email }}">{{ $email }}</a>.</p>
@endsection
