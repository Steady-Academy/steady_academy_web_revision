@extends('help.layouts.app')
@section('help.tabs')
	<div class="d-flex align-items-center mb-3">
		<div class="card shadow">
			<img src="{{ asset('assets-user/images/helpcenter/pembelajaran.png') }}" width="60" alt="">
		</div>
		<div class="header-title">
			<p class="fw-bold fs-5 ms-2 m-0 text-black">Pembayaran</p>
			<a class="fw-bold text-primary ms-2 mt-3" href="{{ route('help.center') }}">Lihat Semua Topik</a>
		</div>
	</div>
	<div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
		<a class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill" href="#mencari-kursus" role="tab"
			aria-controls="mencari-kursus" aria-selected="true">Cara membayar kursus</a>
	</div>
@endsection
@section('help.content')
	<div class="tab-content pt-0" id="v-pills-tabContent">
		<div class="tab-pane fade show active" id="mencari-kursus" role="tabpanel" aria-labelledby="mencari-kursus-tab">
			<h3>Cara Pembayaran Kursus</h3>
			<hr>
			<div class="row gy-2">
				<div class="col-lg-6">
					<h5>1. Pilih Kursus</h5>
					<img src="{{ asset('assets-user/images/helpcenter/pembayaran-kursus.png') }}" loading="lazy" width="400"
						alt="">
				</div>
				<div class="col-lg-6">
					<h5>2. Lakukan Pembayaran</h5>
					<img src="{{ asset('assets-user/images/helpcenter/pembayaran-checkout.png') }}" loading="lazy" width="400"
						alt="">
				</div>
			</div>
		</div>
	</div>
@endsection
