@extends('auth.layouts.app')
@section('title', 'Masuk')
@section('content')
	<section>
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6">
					<div class="card shadow border-1 rounded-4">
						<div class="card-body">
							<div class="m-sm-4">
								<h1 class="h3 text-center">Kesulitan mengakses akun kamu?</h1>
							</div>
							<div class="row justify-content-center align-items-center">
								<div class="col-sm-8 col-lg-10">
									@if (Session::has('error'))
										<div class="alert alert-danger alert-dismissible fade show">
											{{ Session::get('error') }}
											<button type="button" class="close" data-dismiss="alert">&times;</button>
										</div>
									@endif
									<div class="col-12 text-center">
										<img src="{{ asset('assets-user/images/auth/forgot.svg') }}" width="300" class="my-3" alt="">
									</div>


									@if ($errors->any())
										@foreach ($errors->all() as $error)
											<div class="alert alert-danger alert-dismissible fade show">
												{{ $error }}
												<button type="button" class="close" data-dismiss="alert">&times;</button>
											</div>
										@endforeach
									@endif
									<div class="col align-items-center">
										<p class="text-center fs-6">Masukkan email yang telah terdaftar di Steady Academy dan kami akan
											mengirimkan
											instruksi
											untuk mengganti
											kata
											sandi Anda.</p>
									</div>

									@if (Session::has('message'))
										<div class="alert alert-info alert-dismissible fade show">
											{{ Session::get('message') }}
										</div>
									@endif

									<form method="POST" action="{{ route('reset.store') }}">
										@csrf
										<label for="email">Email</label>
										<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
											value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus placeholder="Masukkan Email">
										@error('email')
											<div class="invalid-feedback">
												{{ $message }}
											</div>
										@enderror
										<div class="text-center my-3 d-grid">
											<button type="submit" class="btn btn-primary fw-bold">Kirim</button>
										</div>
									</form>
									{{--
									{!! Form::open(['method' => 'POST', 'action' => 'App\Http\Controllers\Auth\ResetController@store']) !!}

									<div class="form-group my-3">
										{!! Form::label('email', 'Email:') !!}
										{!! Form::email('email', null, ['class' => 'form-control']) !!}
									</div>


									<div class="form-group d-grid mb-3">
										{!! Form::submit('Kirim', ['class' => 'btn btn-primary fw-bold']) !!}
									</div>

									{!! Form::close() !!} --}}
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection
