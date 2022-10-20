@extends('auth.layouts.app')
@section('title', 'Masuk')
@section('content')
	<section>
		<div class="container">
			<div class="row justify-content-center align-items-center">
				<div class="col-sm-10 col-md-6 col-lg-5">
					<div class="card border-1 shadow rounded-4">
						<div class="card-body">
							<h1 class="h3 text-center">Verifikasi email kamu</h1>
							@if (session('resent'))
								<div class="alert alert-dark bg-dark fw-normal text-white py-2 px-3 align-items-center" style="border-radius: 30px"
									role="alert">
									<div class="d-flex align-items-center gap-3">
										<i class="bi bi-check-circle-fill fs-5 text-success"></i>
										<p class="m-0">{{ session('resent') }}</p>
									</div>
								</div>
							@endif
							@if (Session::has('error'))
								<div class="alert alert-dark bg-dark fw-normal text-white py-2 px-3 align-items-center"
									style="border-radius: 30px" role="alert">
									<div class="d-flex align-items-center gap-3">
										<i class="bi bi-x-circle-fill fs-5 text-danger"></i>
										<p class="m-0">{{ Session::get('error') }}</p>
									</div>
								</div>
							@endif
							<div class="row justify-content-center text-center">
								<div class="col-12 my-3">
									<img src="{{ asset('assets-user/images/auth/verification.svg') }}" width="250" alt="">
								</div>
								<div class="col">
									<p class="mb-3">
										Sebelum melanjutkan, silahkan cek email kamu untuk verifikasi.
										Jika kamu tidak menerima email silahkan tekan tombol dibawah
									</p>
									<form class="d-grid" method="POST" action="{{ route('send.email') }}">
										@csrf
										<button type="submit" class="btn btn-primary fw-bold">Kirim</button>.
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

@endsection
