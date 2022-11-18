@extends('layouts.app')
@section('content')
	<section class="h-100">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-12">
					<h2 class="mb-5 text-center">Tentang Steady Academy</h2>
					<div class="logo d-grid justify-content-center">
						<img src="{{ asset('assets-user/images/logo-icon.svg') }}" class="mx-auto" alt="">
						<img src="{{ asset('assets-user/images/logo.svg') }}" width="300" alt="">
					</div>
				</div>
				<div class="col-12 col-lg-8">
					<div class="card mt-3 border-1 mx-auto" style="border-radius: 30px;">
						<div class="card-body">
							<h5>Tentang Steady Academy</h5>
							<p class="text-black fs-6">
								<b>Steady Academy</b> adalah program kursus pembelajaran online berbasis website dan mobile.

							</p>
							<p class="text-black fs-6">
								Steady Academy Mengembangkan berbagai layanan belajar berbasis teknologi, termasuk video belajar, kuis
								serta konten-konten pendidikan lainnya yang bisa diakses melalui aplikasi Steady Academy.
							</p>
							<p class="text-black fs-6">
								Steady Academy memiliki misi untuk menyediakan dan memperluas pengetahuan IT melalui teknologi internet
								untuk semua kalangan khususnya para pelajar, kapan saja dan di mana saja.
							</p>
							<h5>Alasan Dibuatnya Steady Academy</h5>
							<p class="text-black fs-6">
								Kami menyadari adanya gap kemampuan atau skill antara akademisi yang diajarkan disekolah dan industri serta ingin
								berkontribusi juga untuk meningkatkan kapabilitas serta kemampuan IT Indonesia yang siap diserap oleh dunia
								Industri.
							</p>
							<p class="text-black fs-6">
								Dan juga untuk memenuhi tugas sekolah dalam pelajaran Pemograman Berbasis Web dan Mobile.
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection
