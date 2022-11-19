@extends('layouts.app')
@section('content')
	<section class="pt-5 h-100"
		style="background-image:url({{ asset('assets-user/images/element/map.svg') }}); background-position: center left; background-size: cover;">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 col-xl-6 text-center mx-auto">
					<!-- Title -->
					<h1 class="mb-4">Kontak</h1>
				</div>
			</div>

			<!-- Contact info box -->
			<div class="row g-4 g-md-5 mt-0 mt-lg-3">
				<!-- Box item -->
				<div class="col-lg-4 mt-lg-0">
					<div class="card card-body shadow py-5 text-center h-100" style="background-color: #303F9F;">
						<!-- Title -->
						<h5 class="text-white mb-3">Kontak Customer Support</h5>
						<ul class="list-inline mb-0">
							<!-- Address -->
							<li class="list-item mb-3">
								<a href="#" class="text-white"> <i class="fas fa-fw fa-map-marker-alt me-2 mt-1"></i>Jl. Dadang Jebred
									Beledug, 401233 Bandung Barat, Indonesia </a>
							</li>
							<!-- Phone number -->
							<li class="list-item mb-3">
								<a href="#" class="text-white"> <i class="fas fa-fw fa-phone-alt me-2"></i>0892827271191 </a>
							</li>
							<!-- Email id -->
							<li class="list-item mb-0">
								<a href="#" class="text-white"> <i class="far fa-fw fa-envelope me-2"></i>support@steadyacademy.com </a>
							</li>
						</ul>
					</div>
				</div>

				<!-- Box item -->
				<div class="col-lg-4 mt-lg-0">
					<div class="card card-body shadow py-5 text-center h-100">
						<!-- Title -->
						<h5 class="mb-3">Alamat Kontak</h5>
						<ul class="list-inline mb-0">
							<!-- Address -->
							<li class="list-item mb-3 h6 fw-light">
								<a href="#"> <i class="fas fa-fw fa-map-marker-alt me-2 mt-1"></i>Jl. Cebek Cikarasak Buah Batu Bandung,
									Indonesia
								</a>
							</li>
							<!-- Phone number -->
							<li class="list-item mb-3 h6 fw-light">
								<a href="#"> <i class="fas fa-fw fa-phone-alt me-2"></i>0892837372121</a>
							</li>
							<!-- Email id -->
							<li class="list-item mb-0 h6 fw-light">
								<a href="#"> <i class="far fa-fw fa-envelope me-2"></i>dadang@jebred.com</a>
							</li>
						</ul>
					</div>
				</div>

				<!-- Box item -->
				<div class="col-lg-4 mt-lg-0">
					<div class="card card-body shadow py-5 text-center h-100">
						<!-- Title -->
						<h5 class="mb-3">Sekolah</h5>
						<ul class="list-inline mb-0">
							<!-- Address -->
							<li class="list-item mb-3 h6 fw-light">
								<a href="#"> <i class="fas fa-fw fa-map-marker-alt me-2 mt-1"></i>Jl.Sukarno Hatta Bandung Barat, Cicahem
								</a>
							</li>
							<!-- Phone number -->
							<li class="list-item mb-3 h6 fw-light">
								<a href="#"> <i class="fas fa-fw fa-phone-alt me-2"></i>02291919292 </a>
							</li>
							<!-- Email id -->
							<li class="list-item mb-0 h6 fw-light">
								<a href="#"> <i class="far fa-fw fa-envelope me-2"></i>ashiap@email.com </a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection
