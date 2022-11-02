<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Login administrator steady academy">
	<meta name="author" content="Dadang Jebred">

	<title>Login</title>

	<link rel="shortcut icon" href="img/favicon.ico">

	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&amp;display=swap" rel="stylesheet">

	{{-- <link class="js-stylesheet" href="{{ asset('assets-admin/css/light.css') }}" rel="stylesheet">
	<script src="{{ asset('assets-admin/js/settings.js') }}"></script> --}}

	<link class="js-stylesheet" rel="stylesheet" href="{{ env('URL_NGROK') }}/assets-admin/css/light.css">
	{{-- <script src="{{ env('URL_NGROK') }}/assets-admin/js/settings.js"></script> --}}

	<!-- Include script -->
	{!! htmlScriptTagJsApi() !!}
</head>

<body data-theme="default" data-layout="fluid" data-sidebar-position="left" data-sidebar-behavior="sticky">
	<div class="main d-flex justify-content-center w-100">
		<main class="content d-flex p-0">
			<div class="container d-flex flex-column">
				<div class="row h-100">
					<div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
						<div class="d-table-cell align-middle">

							<div class="text-center mt-3 mb-3">
								<a href="{{ route('landing') }}">
									<img src="{{ asset('assets-user/images/logo.svg') }}" alt="Steady Academy Logo" class="img-fluid"
										width="250" height="250">
								</a>
							</div>

							<div class="card">
								<div class="card-body">
									<div class="m-sm-4">
										<div class="text-center">
											<h1 class="h2">Administrator </h1>
											@if (session('message'))
												<div class="alert-danger">
													{{ session('message') }}
												</div>
											@endif
										</div>
										<form class="form-group" method="POST" action="{{ route('admin.login') }}">
											@csrf
											<div class="mb-3">
												<label class="form-label">Email</label>
												<input class="form-control form-control-lg @error('email') is-invalid @enderror" type="email"
													name="email" placeholder="Masukkan email" required>
												@error('email')
													<div class="invalid-feedback">
														{{ $message }}
													</div>
												@enderror
											</div>
											<div class="mb-3">
												<label class="form-label">Password</label>
												<input class="form-control form-control-lg @error('password') is-invalid @enderror" type="password"
													name="password" placeholder="Masukkan password">
												@error('password')
													<div class="invalid-feedback">
														{{ $message }}
													</div>
												@enderror
											</div>
											<div class="form-group row">
												{!! htmlFormSnippet() !!}
												@if ($errors->has('g-recaptcha-response'))
													<div>
														<small class="text-danger">{{ $errors->first('g-recaptcha-response') }}</small>
													</div>
												@endif
											</div>
											<div class="text-center mt-3">
												<button type="submit" class="btn btn-lg btn-primary">Login</button>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</main>
	</div>
	{{-- <script src="{{ asset('assets-admin/js/app.js') }}"></script> --}}
	<script src="{{ env('URL_NGROK') }}/assets-admin/js/app.js"></script>
</body>

</html>
