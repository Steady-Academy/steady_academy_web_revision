@extends('help.layouts.app')
@section('help.tabs')
	<div class="d-flex align-items-center mb-3">
		<div class="card shadow">
			<img src="{{ asset('assets-user/images/helpcenter/pembelajaran.png') }}" width="60" alt="">
		</div>
		<div class="header-title">
			<p class="fw-bold fs-5 ms-2 m-0 text-black">Pembelajaran</p>
			<a class="fw-bold text-primary ms-2 mt-3" href="{{ route('help.center') }}">Lihat Semua Topik</a>
		</div>
	</div>
	<div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
		<a class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill" href="#mencari-kursus" role="tab"
			aria-controls="mencari-kursus" aria-selected="true">Mencari Kursus</a>
		<a class="nav-link" id="video-tab" data-bs-toggle="pill" href="#video" role="tab" aria-controls="video"
			aria-selected="false">Video</a>
		<a class="nav-link" id="kuis-tab" data-bs-toggle="pill" href="#kuis" role="tab" aria-controls="kuis"
			aria-selected="false">Kuis</a>
		<a class="nav-link" id="rangkuman-tab" data-bs-toggle="pill" href="#rangkuman" role="tab" aria-controls="rangkuman"
			aria-selected="false">Rangkuman</a>
	</div>
@endsection
@section('help.content')
	<div class="tab-content pt-0" id="v-pills-tabContent">
		<div class="tab-pane fade show active" id="mencari-kursus" role="tabpanel" aria-labelledby="mencari-kursus-tab">
			<h3>Cara Mencari Kursus</h3>
			<hr>
			<div class="row gy-2">
				<div class="col-lg-6">
					<img src="{{ asset('assets-user/images/helpcenter/pembelajaran-cari-materi.png') }}" loading="lazy" width="400"
						alt="">
				</div>
			</div>
		</div>
		<div class="tab-pane fade" id="video" role="tabpanel" aria-labelledby="video-tab">
			<h3>Cara mengakses Video Materi</h3>
			<hr>
			<div class="row gy-2">
				<div class="col-lg-6">
					<img src="{{ asset('assets-user/images/helpcenter/pembelajaran-video-materi.png') }}" loading="lazy" width="400"
						alt="">
				</div>
			</div>
		</div>
		<div class="tab-pane fade" id="kuis" role="tabpanel" aria-labelledby="kuis-tab">
			<h3>Cara Mengakses Kuis Materi</h3>
			<hr>
			<div class="row">
				<div class="col-6">
					<img src="{{ asset('assets-user/images/helpcenter/pembelajaran-kuis-materi.png') }}" loading="lazy" width="400"
						alt="">
				</div>
			</div>
		</div>
		<div class="tab-pane fade" id="rangkuman" role="tabpanel" aria-labelledby="rangkuman-tab">
			<h3>Cara Mengakses Rangkuman Materi</h3>
			<hr>
			<div class="row">
				<div class="col-6">
					<img src="{{ asset('assets-user/images/helpcenter/pembelajaran-rangkuman-materi.png') }}" loading="lazy"
						width="400" alt="">
				</div>
			</div>
		</div>
	</div>
@endsection
