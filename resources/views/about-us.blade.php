@extends('layouts.app')
@push('custom-styles')
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css" />
	<style>
		.swiper-slide {
			display: flex;
			align-items: center;
			justify-content: center;
			border-radius: 18px;
			font-size: 22px;
			font-weight: bold;
			color: #fff;
			background-color: #5C6BC0;
			border: 1px solid #303F9F;
		}
	</style>
@endpush
@section('content')
	<section class="position-relative overflow-hidden pt-5 pt-lg-3 ">
		<figure class="position-absolute top-50 translate-middle-y ms-n7 d-none d-xxl-block" style="left: 100px;">
			<img src="{{ asset('assets-user/images/about/fireworks.svg') }}" alt="">
		</figure>
		<figure class="position-absolute top-50 translate-middle-y ms-n7 d-none d-xxl-block" style="right: 0;">
			<img src="{{ asset('assets-user/images/about/fireworks.svg') }}" alt="">
		</figure>

		<div class="container">

			<div class="row">
				<div class="col">
					<h2 class="text-center">Tentang Kami</h2>
					<div class="row justify-content-center">
						<div class="d-none d-lg-block col-lg-8">
							<div class="swiper mySwiper" style="width: 600px; height: 420px;">
								<div class="swiper-wrapper text-white text-center">
									<div class="swiper-slide border-1">
										<div class="d-grid">
											<img src="{{ asset('assets-user/images/avatar/11.jpg') }}" loading="lazy" width="200" height="200"
												class="rounded-circle mx-auto border border-3 border-primary" alt="">
											<h3 class="text-white mb-0">Farrel Rafiardi Kusmana</h3>
											<p>UI/UX Designer | Front-end Desktop GUI</p>
											<figure class="text-center">
												<blockquote class="blockquote">
													<p>"Hidup akan lebih indah jika sama sama bermimpi"</p>
												</blockquote>
												<figcaption class="blockquote-footer text-white">
													<cite title="Source Title">Farrel Dewasa</cite>
												</figcaption>
											</figure>
										</div>
									</div>
									<div class="swiper-slide border-1">
										<div class="d-grid">
											<img src="{{ asset('assets-user/images/avatar/07.jpg') }}" loading="lazy" width="200" height="200"
												class="rounded-circle mx-auto border border-3 border-primary" alt="">
											<h3 class="text-white mb-0">Rifki Prayoga Lesmana</h3>
											<p>UI/UX Designer | Front-end Desktop GUI</p>
											<figure class="text-center">
												<blockquote class="blockquote">
													<p>"Nyerah? Jangann Hidup akan terasa bahagia"</p>
												</blockquote>
												<figcaption class="blockquote-footer text-white">
													<cite title="Source Title">Ripki Lesmana</cite>
												</figcaption>
											</figure>
										</div>
									</div>
									<div class="swiper-slide border-1">
										<div class="d-grid">
											<img src="{{ asset('assets-user/images/avatar/04.jpg') }}" loading="lazy" width="200" height="200"
												class="rounded-circle mx-auto border border-3 border-primary" alt="">
											<h3 class="text-white mb-0">M. Ilham Iskandar</h3>
											<p>Fullstack Desktop </p>
											<figure class="text-center">
												<blockquote class="blockquote">
													<p>"Senja begitu kuat, aku tidak terasa apa apa"</p>
												</blockquote>
												<figcaption class="blockquote-footer text-white">
													<cite title="Source Title">Is Kandar</cite>
												</figcaption>
											</figure>
										</div>
									</div>
									<div class="swiper-slide border-1">
										<div class="d-grid">
											<img src="{{ asset('assets-user/images/avatar/08.jpg') }}" loading="lazy" width="200" height="200"
												class="rounded-circle mx-auto border border-3 border-primary" alt="">
											<h3 class="text-white mb-0">Refi Fauzan</h3>
											<p>Fullstack Web | Fullstack Mobile | PM</p>
										</div>
									</div>
									<div class="swiper-slide border-1">
										<div class="d-grid">
											<img src="{{ asset('assets-user/images/avatar/05.jpg') }}" loading="lazy" width="200" height="200"
												class="rounded-circle mx-auto border border-3 border-primary" alt="">
											<h3 class="text-white mb-0">Dini Laylalani</h3>
											<p>UI/UX Designer</p>
											<figure class="text-center">
												<blockquote class="blockquote">
													<p>"Berbahagialah dengan aturan didunia ini"</p>
												</blockquote>
												<figcaption class="blockquote-footer text-white">
													From <cite title="Source Title">Dini Laylalani</cite>
												</figcaption>
											</figure>
										</div>
									</div>
									<div class="swiper-slide border-1">
										<div class="d-grid">
											<img src="{{ asset('assets-user/images/avatar/01.jpg') }}" loading="lazy" width="200" height="200"
												class="rounded-circle mx-auto border border-3 border-primary" alt="">
											<h3 class="text-white mb-0">Alya Aura Devina</h3>
											<p>UI/UX Designer</p>
											<figure class="text-center">
												<blockquote class="blockquote">
													<p>"Kenikmatan hanya bisa didapat setelah mati"</p>
												</blockquote>
												<figcaption class="blockquote-footer text-white">
													From <cite title="Source Title">Alya Devina</cite>
												</figcaption>
											</figure>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-8 d-lg-none d-block">
							<div class="swiper mySwiper" style="width: 200; height: 300;">
								<div class="swiper-wrapper text-white text-center">
									<div class="swiper-slide border-1 p-2">
										<div class="d-grid">
											<img src="{{ asset('assets-user/images/avatar/farrel.jpg') }}" loading="lazy" width="150"
												class="rounded-circle mx-auto border border-3 border-primary" alt="">
											<h2 class="text-white mb-0">Farrel Rafiardi Kusmana</h2>
											<p>UI/UX Designer | Front-end Desktop GUI</p>
											<figure class="text-center">
												<blockquote class="blockquote">
													<p>"Hidup akan lebih indah jika sama sama bermimpi"</p>
												</blockquote>
												<figcaption class="blockquote-footer text-white">
													<cite title="Source Title">Farrel Dewasa</cite>
												</figcaption>
											</figure>
										</div>
									</div>
									<div class="swiper-slide border-1 p-2">
										<div class="d-grid">
											<img src="{{ asset('assets-user/images/avatar/ripki.PNG') }}" loading="lazy" width="150"
												class="rounded-circle mx-auto border border-3 border-primary" alt="">
											<h2 class="text-white mb-0">Rifki Prayoga Lesmana</h2>
											<p>UI/UX Designer | Front-end Desktop GUI</p>
											<figure class="text-center">
												<blockquote class="blockquote">
													<p>"Nyerah? Jangann Hidup akan terasa bahagia"</p>
												</blockquote>
												<figcaption class="blockquote-footer text-white">
													<cite title="Source Title">Ripki Lesmana</cite>
												</figcaption>
											</figure>
										</div>
									</div>
									<div class="swiper-slide border-1 p-2">
										<div class="d-grid">
											<img src="{{ asset('assets-user/images/avatar/ilham.jpg') }}" loading="lazy" width="150"
												class="rounded-circle mx-auto border border-3 border-primary" alt="">
											<h2 class="text-white mb-0">M. Ilham Iskandar</h2>
											<p>Fullstack Desktop </p>
											<figure class="text-center">
												<blockquote class="blockquote">
													<p>"Senja begitu kuat, aku tidak terasa apa apa"</p>
												</blockquote>
												<figcaption class="blockquote-footer text-white">
													<cite title="Source Title">Is Kandar</cite>
												</figcaption>
											</figure>
										</div>
									</div>
									<div class="swiper-slide border-1 p-2">
										<div class="d-grid">
											<img src="{{ asset('assets-user/images/avatar/08.jpg') }}" loading="lazy" width="150"
												class="rounded-circle mx-auto border border-3 border-primary" alt="">
											<h2 class="text-white mb-0">Refi Fauzan</h2>
											<p>Fullstack Web | Fullstack Mobile | PM</p>
										</div>
									</div>
									<div class="swiper-slide border-1 p-2">
										<div class="d-grid">
											<img src="{{ asset('assets-user/images/avatar/dini.jpeg') }}" loading="lazy" width="150"
												class="rounded-circle mx-auto border border-3 border-primary" alt="">
											<h2 class="text-white mb-0">Dini Laylalani</h2>
											<p>UI/UX Designer</p>
											<figure class="text-center">
												<blockquote class="blockquote">
													<p>"Berbahagialah dengan aturan didunia ini"</p>
												</blockquote>
												<figcaption class="blockquote-footer text-white">
													From <cite title="Source Title">Dini Laylalani</cite>
												</figcaption>
											</figure>
										</div>
									</div>
									<div class="swiper-slide border-1 p-2">
										<div class="d-grid">
											<img src="{{ asset('assets-user/images/avatar/alya.jpeg') }}" loading="lazy" width="150"
												class="rounded-circle mx-auto border border-3 border-primary" alt="">
											<h2 class="text-white mb-0">Alya Aura Devina</h2>
											<p>UI/UX Designer</p>
											<figure class="text-center">
												<blockquote class="blockquote">
													<p>"Kenikmatan hanya bisa didapat setelah mati"</p>
												</blockquote>
												<figcaption class="blockquote-footer text-white">
													From <cite title="Source Title">Alya Devina</cite>
												</figcaption>
											</figure>
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
@push('custom-scripts')
	<script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
	<script>
		var swiper = new Swiper(".mySwiper", {
			effect: "cards",
			grabCursor: true,
		});
	</script>
@endpush
