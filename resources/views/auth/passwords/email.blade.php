@extends('auth.layouts.app')
@section('title', 'Lupa password')
@section('content')
	<section class="h-100">
		<div class="container">
			<div class="row justify-content-center align-item-center">
				<div class="col-sm-10 col-md-6 col-lg-4 d-none d-sm-none d-md-block">
					<img src="{{ asset('assets-user/images/auth/forgot.svg') }}" class="my-4" width="400" alt="">
				</div>
				<div class="col-sm-10 col-md-6 col-lg-6">
					<div class="card shadow border-1 rounded-4">
						<div class="card-body">
							<div class="m-sm-4">
								<div class="text-center mt-4">
									<h1 class="h3">Kesulitan mengakses akun kamu?</h1>
									<p>Masukkan email yang telah terdaftar di Steady Academy dan kami akan mengirimkan instruksi untuk mengganti
										kata
										sandi Anda.</p>
								</div>
							</div>
							@if (session('status'))
								<div class="alert alert-success" role="alert">
									{{ session('status') }}
								</div>
							@endif

							<form method="POST" action="{{ route('password.email') }}">
								@csrf
								<div class="mb-3">
									<label for="email" class="form-label">Email</label>
									<input type="email" class="form-control form-control-md" name="email" placeholder="Masukan email kamu"
										required>
								</div>

								@error('email')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
								<div class="text-center mt-3 d-grid">
									<button type="submit" class="btn btn-primary fw-bold">Kirim</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection
