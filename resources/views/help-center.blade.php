@extends('layouts.app')
@section('content')
	<section class="bg-primary bg-opacity-15 position-relative overflow-hidden pt-5 pt-lg-3 ">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 mx-auto text-center">
					<h1>Pusat Bantuan</h1>
					<p>Cari disini untuk mendapatkan jawaban dari pertanyaan mu.</p>
					<figure class="d-none d-xxl-block text-center">
						<img src="{{ asset('assets-user/images/helpcenter/help-center.svg') }}" alt="">
					</figure>
				</div>
			</div>
		</div>
	</section>
	<section>
		<div class="container">
			<div class="row">
				<div class="col">
					<!-- Tabs START -->
					<div class="row justify-content-center">
						<div class="col-lg-6">
							<ul class="nav nav-pills justify-content-center nav-pills-bg-soft mb-3" id="pills-tab" role="tablist">
								<li class="nav-item mx-1" role="presentation">
									<button class="nav-link mb-0 fw-bold active" id="pills-tab-8" data-bs-toggle="pill" data-bs-target="#pills-tab8"
										type="button" role="tab" aria-controls="pills-tab8" aria-selected="true">Student (Pelajar)</button>
								</li>
								<li class="nav-item mx-1" role="presentation">
									<button class="nav-link mb-0 fw-bold" id="pills-tab-9" data-bs-toggle="pill" data-bs-target="#pills-tab9"
										type="button" role="tab" aria-controls="pills-tab9" aria-selected="false">Instructur (Pengajar)</button>
								</li>
							</ul>
						</div>
					</div>
					<!-- Tabs contents -->
					<div class="tab-content" id="pills-tabContent">
						<!-- Content -->
						<div class="tab-pane fade show active" id="pills-tab8" role="tabpanel" aria-labelledby="pills-tab-8">
							<div class="container">
								<div class="row justify-content-center text-center">
									<h4 class="my-4">Pilih topik sesuai kendala pembelajaranmu.</h4>
									<div class="col-10">
										<div class="row gy-2">
											<div class="col">
												<div class="card border-1">
													<div class="card-body">
														<div class="d-flex align-items-center">
															<img src="{{ asset('assets-user/images/helpcenter/akun.png') }}" loading="lazy" width="50"
																alt="">
															<a href="{{ route('help.account') }}" class="fw-bold fs-h6 ms-1 m-0 stretched-link text-black">Akun &
																Keamanan</a>
														</div>
													</div>
												</div>
											</div>
											<div class="col">
												<div class="card border-1">
													<div class="card-body">
														<div class="d-flex align-items-center">
															<img src="{{ asset('assets-user/images/helpcenter/pembelajaran.png') }}" loading="lazy" width="50"
																alt="">
															<a href="{{ route('help.learning') }}"
																class="fw-bold fs-h6 ms-1 m-0 stretched-link text-black">Pembelajaran</a>
														</div>
													</div>
												</div>
											</div>
											<div class="col">
												<div class="card border-1">
													<div class="card-body">
														<div class="d-flex align-items-center">
															<img src="{{ asset('assets-user/images/helpcenter/pembayaran.png') }}" loading="lazy" width="50"
																alt="">
															<a href="{{ route('help.payment') }}"
																class="fw-bold fs-h6 ms-1 m-0 stretched-link text-black">Pembayaran</a>
														</div>
													</div>
												</div>
											</div>
											{{-- <div class="col">
												<div class="card border-1">
													<div class="card-body">
														<div class="d-flex align-items-center">
															<img src="{{ asset('assets-user/images/helpcenter/discount.png') }}" width="50" alt="">
															<a href="#" class="fw-bold fs-h6 ms-1 m-0 stretched-link text-black">Promosi</a>
														</div>
													</div>
												</div>
											</div> --}}
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- Content -->
						<div class="tab-pane fade" id="pills-tab9" role="tabpanel" aria-labelledby="pills-tab-9">
							<div class="container">
								<div class="row justify-content-center text-center">
									<h4 class="my-4">Pilih topik sesuai kendala pengajaranmu.</h4>
									<div class="col-10">
										<div class="row gy-2">
											<div class="col-12 col-lg">
												<div class="card border-1">
													<div class="card-body">
														<div class="d-flex align-items-center">
															<img src="{{ asset('assets-user/images/helpcenter/akun.png') }}" loading="lazy" width="50"
																alt="">
															<a href="#" class="fw-bold fs-h6 ms-1 m-0 stretched-link text-black">Akun & Keamanan</a>
														</div>
													</div>
												</div>
											</div>
											<div class="col-12 col-lg">
												<div class="card border-1">
													<div class="card-body">
														<div class="d-flex align-items-center">
															<img src="{{ asset('assets-user/images/helpcenter/pengajaran.png') }}" loading="lazy" width="50"
																alt="">
															<a href="#" class="fw-bold fs-h6 ms-1 m-0 stretched-link text-black">Pengajaran</a>
														</div>
													</div>
												</div>
											</div>
											<div class="col-12 col-lg">
												<div class="card border-1">
													<div class="card-body">
														<div class="d-flex align-items-center">
															<img src="{{ asset('assets-user/images/helpcenter/kursus.png') }}" loading="lazy" width="50"
																alt="">
															<a href="#" class="fw-bold fs-h6 ms-1 m-0 stretched-link text-black">Kursus</a>
														</div>
													</div>
												</div>
											</div>
											{{-- <div class="col-12 col-lg">
												<div class="card border-1">
													<div class="card-body">
														<div class="d-flex align-items-center">
															<img src="{{ asset('assets-user/images/helpcenter/discount.png') }}" width="50" alt="">
															<a href="#" class="fw-bold fs-h6 ms-1 m-0 stretched-link text-black">Promosi</a>
														</div>
													</div>
												</div>
											</div> --}}
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- Tabs END -->
				</div>
			</div>
		</div>
	</section>
	<section>
		<div class="container">
			<div class="row justify-content-center">
				<div class="col">
					<h4 class="my-4 text-center">Yang paling sering ditanyakan</h4>
					<div class="row justify-content-center">
						<div class="col-12 col-lg-8">
							<div class="accordion" id="accordionPanelsStayOpenExample">
								<div class="accordion-item">
									<h2 class="accordion-header" id="panelsStayOpen-headingOne">
										<button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse"
											data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="false"
											aria-controls="panelsStayOpen-collapseOne">
											Saya Ingin Mengatur Akun
										</button>
									</h2>
									<div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse"
										aria-labelledby="panelsStayOpen-headingOne">
										<div class="accordion-body">
											<p class="m-0">Keamanan data adalah prioritas utama kami. Kami terus pastikan bahwa kata sandi telah
												dienkripsi.</p>
											<p class="m-0"><a href="{{ route('help.account') }}" class="fw-bold">Selengkapnya</a></p>
										</div>
									</div>
								</div>
								<div class="accordion-item">
									<h2 class="accordion-header" id="panelsStayOpen-headingTwo">
										<button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse"
											data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false"
											aria-controls="panelsStayOpen-collapseTwo">
											Cara Mengakses Materi
										</button>
									</h2>
									<div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse"
										aria-labelledby="panelsStayOpen-headingTwo">
										<div class="accordion-body">
											<p class="m-0">
												Berikut beberapa langkah mudah untuk bisa login ke akun Steady Academy
											</p>
											<p class="m-0"><a href="{{ route('help.learning') }}" class="fw-bold">Selengkapnya</a></p>
										</div>
									</div>
								</div>
								<div class="accordion-item">
									<h2 class="accordion-header" id="panelsStayOpen-headingThree">
										<button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse"
											data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false"
											aria-controls="panelsStayOpen-collapseThree">
											Saya Tidak Menerima Kode OTP
										</button>
									</h2>
									<div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse"
										aria-labelledby="panelsStayOpen-headingThree">
										<div class="accordion-body">
											<p>
												Kode OTP atauOne-Time Password adalah kode verifikasi atau kata sandi dinamis yang terdiri dari 4 amupun 6
												digit angka unik dan rahasia yang biasanya dikirimkan melalui SMS atau e-mail yang tercantup pada akun Steady
												Academy kamu.
											</p>
											<p class="m-0"><a href="{{ route('help.account') }}" class="fw-bold">Selengkapnya</a></p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection
