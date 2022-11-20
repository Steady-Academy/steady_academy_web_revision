@extends('help.layouts.app')
@section('help.tabs')
	<div class="d-flex align-items-center mb-3">
		<div class="card shadow">
			<img src="{{ asset('assets-user/images/helpcenter/akun.png') }}" width="60" alt="">
		</div>
		<div class="header-title">
			<p class="fw-bold fs-5 ms-2 m-0 text-black">Akun & Keamanan</p>
			<a class="fw-bold text-primary ms-2 mt-3" href="{{ route('help.center') }}">Lihat Semua Topik</a>
		</div>
	</div>
	<div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
		<a class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill" href="#cara-daftar-dan-login-student"
			role="tab" aria-controls="cara-daftar-dan-login-student" aria-selected="true">Cara Daftar & Login</a>
		<a class="nav-link" id="kendala-login-tab" data-bs-toggle="pill" href="#kendala-login" role="tab"
			aria-controls="kendala-login" aria-selected="false">Kendala Login</a>
		<a class="nav-link" id="atur-akun-tab" data-bs-toggle="pill" href="#atur-akun" role="tab" aria-controls="atur-akun"
			aria-selected="false">Atur Akun</a>
	</div>
@endsection
@section('help.content')
	<div class="tab-content pt-0" id="v-pills-tabContent">
		<div class="tab-pane fade show active" id="cara-daftar-dan-login-student" role="tabpanel"
			aria-labelledby="cara-daftar-dan-login-student-tab">
			<h3>Cara Daftar & Login</h3>
			<hr>
			<div class="row gy-2">
				<div class="col-lg-6">
					<h5>Cara Login</h5>
					<img src="{{ asset('assets-user/images/helpcenter/cara-login-student.png') }}" loading="lazy" width="400"
						alt="">
				</div>
				<div class="col-lg-6">
					<h5>Cara Daftar</h5>
					<img src="{{ asset('assets-user/images/helpcenter/cara-daftar-student.png') }}" loading="lazy" width="400"
						alt="">
				</div>
				<div class="col-lg-6">
					<h5>Verifikasi OTP</h5>
					<img src="{{ asset('assets-user/images/helpcenter/cara-login-otp-student.png') }}" loading="lazy" width="400"
						alt="">
				</div>
			</div>
		</div>
		<div class="tab-pane fade" id="kendala-login" role="tabpanel" aria-labelledby="kendala-login-tab">
			<h3>Saya Lupa Kata Sandi Steady Academy</h3>
			<hr>
			<div class="row gy-2">
				<div class="col-lg-6">
					<h5>1. Tekan Lupa Password</h5>
					<img src="{{ asset('assets-user/images/helpcenter/lupa-kata-sandi-student.png') }}" loading="lazy" width="400"
						alt="">
				</div>
				<div class="col-lg-6">
					<h5>2. Masukan Email</h5>
					<img src="{{ asset('assets-user/images/helpcenter/lupa-kata-sandi-student-email.png') }}" loading="lazy"
						width="400" alt="">
				</div>
				<div class="col">
					<h5>3. Masukan Password Baru</h5>
					<img src="{{ asset('assets-user/images/helpcenter/lupa-kata-sandi-student-password.png') }}"loading="lazy"
						width="400" alt="">
				</div>
			</div>
		</div>
		<div class="tab-pane fade" id="atur-akun" role="tabpanel" aria-labelledby="atur-akun-tab">
			<h3>Atur Akun </h3>
			<hr>
			<div class="row">
				<div class="col">
					<img src="{{ asset('assets-user/images/helpcenter/atur-akun-student.png') }}" loading="lazy" width="400"
						alt="">
				</div>
			</div>
		</div>
	</div>
@endsection
