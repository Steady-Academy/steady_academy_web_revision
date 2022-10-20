@extends('auth.layouts.app')
@section('title', 'Masuk')
@section('content')
	<section class="h-100">

		<div class="container">
			<div class="row justify-content-center align-items-center">
				<div class="col-sm-10 col-md-6 col-lg-5 d-none d-sm-none d-md-block">
					<img src="{{ asset('assets-user/images/auth/teaching.svg') }}" alt="">
				</div>
				<div class="col-sm-10 col-md-6 col-lg-5">
					<div class="card border-1 shadow rounded-4">
						<div class="card-body">
							<div class="m-sm-4">
								<div class="text-center mt-4">
									<h1 class="h3">Lanjutkan mengajarmu!</h1>
									<p>Masukkan akunmu untuk mengajar</p>
								</div>
							</div>
							@if (session('success'))
								<div class="alert alert-dark bg-dark fw-normal text-white py-2 px-3 align-items-center"
									style="border-radius: 30px" role="alert">
									<div class="d-flex align-items-center gap-3">
										<i class="bi bi-check-circle-fill fs-5 text-success"></i>
										<p class="m-0">{{ session('success') }}</p>
									</div>
								</div>
							@endif
							@if (session('message'))
								<div class="alert alert-dark bg-dark fw-normal text-white py-2 px-3 align-items-center"
									style="border-radius: 30px" role="alert">
									<div class="d-flex align-items-center gap-3">
										<i class="bi bi-x-circle-fill fs-5 text-danger"></i>
										<p class="m-0">{{ session('message') }}</p>
									</div>
								</div>
							@endif
							@if (Session::get('error'))
								<div class="alert alert-dark bg-dark fw-normal text-white py-2 px-3 align-items-center"
									style="border-radius: 30px" role="alert">
									<div class="d-flex align-items-center gap-3">
										<i class="bi bi-x-circle-fill fs-5 text-danger"></i>
										<p class="m-0">{{ Session::get('error') }}</p>
									</div>
								</div>
							@endif

							<form method="POST" action="{{ route('login') }}">
								@csrf
								<div class="mb-3">
									<label for="email" class="form-label">Email</label>
									<input type="email" class="form-control form-control-md" name="email" value="{{ old('email') }}"
										placeholder="Masukan email kamu" required>
								</div>
								<div class="mb-3">
									<label for="password" class="form-label">Password</label>
									<div class="input-group input-group-md">
										<input type="password" class="form-control form-control-md" id="current-password" name="password"
											placeholder="Masukkan password kamu" autocomplete="current-password" required>
										<span class="input-group-text bg-light rounded-end border-1 text-secondary px-3"><i class="fas fa-eye"
												id="togglePassword"></i></span>
									</div>
								</div>
								<div class="d-flex">
									<div class="form-check align-items-center">
										<input id="remember" type="checkbox" class="form-check-input" value="remember" name="remember" checked="">
										<label class="form-check-label text-small" for="remember">Remember me</label>
									</div>
									<a class="ms-auto text-link" href="{{ route('reset.index') }}">Lupa password?</a>
								</div>
								<div class="text-center mt-3 d-grid ">
									<button type="submit" id="btn-loading" class="btn btn-primary fw-bold">Masuk</button>
								</div>
								{{-- <button class="btn btn-primary" type="button" disabled>
									<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
									Loading...
								</button> --}}
							</form>
							<div class="row">
								<div class="position-relative my-1">
									<hr>
									<p class="small position-absolute top-50 start-50 translate-middle bg-body px-3">Atau dengan</p>
								</div>

								<div class="text-center mt-2 d-grid">
									<a class="btn border-secondary border-1 bg-white" style="border-radius: 20px;"
										onClick="socialSignin('google');">
										<img width="20px" style="margin-bottom:3px; margin-right:5px" alt="Google sign-in"
											src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/53/Google_%22G%22_Logo.svg/512px-Google_%22G%22_Logo.svg.png" />
										<span class="fa fa-google"></span>Dengan Google
									</a>
									<form id="social-login-form" action="" method="POST" style="display: none;">
										{{ csrf_field() }}
										<input id="social-login-access-token" name="social-login-access-token" type="text">
										<input id="social-login-tokenId" name="social-login-tokenId" type="text">
									</form>
								</div>
							</div>
							<!-- Sign up link -->
							<div class="my-3 text-center">
								<span>Belum punya akun?<a href="{{ route('register') }}" class="text-link fw-bold"> Daftar </a></span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection
@push('custom-script')
	<script src="https://www.gstatic.com/firebasejs/7.14.0/firebase-app.js"></script>
	<script src="https://www.gstatic.com/firebasejs/7.14.0/firebase-auth.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
	<script>
		// Initialize Firebase
		var firebaseConfig = {
			apiKey: "AIzaSyAdmDyXGIHeb0H-Sxrkp2c0D1217OFED7k",
			authDomain: "steady-academy-1e343.firebaseapp.com",
			projectId: "steady-academy-1e343",
			storageBucket: "steady-academy-1e343.appspot.com",
			messagingSenderId: "871626441910",
			appId: "1:871626441910:web:338aac3ee62db144329217",
			measurementId: "G-4F8LW9SBL8"
		};
		firebase.initializeApp(firebaseConfig);
		var facebookProvider = new firebase.auth.FacebookAuthProvider();
		var googleProvider = new firebase.auth.GoogleAuthProvider();
		var facebookCallbackLink = '/login/facebook/callback';
		var googleCallbackLink = '/login/google/callback';
		async function socialSignin(provider) {
			var socialProvider = null;
			if (provider == "facebook") {
				socialProvider = facebookProvider;
				document.getElementById('social-login-form').action = facebookCallbackLink;
			} else if (provider == "google") {
				socialProvider = googleProvider;
				document.getElementById('social-login-form').action = googleCallbackLink;
			} else {
				return;
			}
			firebase.auth().signInWithPopup(socialProvider).then(function(result) {
				result.user.getIdToken().then(function(result) {
					document.getElementById('social-login-tokenId').value = result;
					document.getElementById('social-login-form').submit();
				});
			}).catch(function(error) {
				// do error handling
				console.log(error);
			});
		}
	</script>

	<script>
		const togglePassword = document.querySelector("#togglePassword");
		const password = document.querySelector("#current-password");

		togglePassword.addEventListener("click", function() {
			const type = password.getAttribute("type") === "password" ? "text" : "password";
			password.setAttribute("type", type);
			if (type === "password") {
				this.classList.remove('fa-eye-slash');
				this.classList.add('fa-eye');
			} else {
				this.classList.remove('fa-eye');
				this.classList.add('fa-eye-slash');
			}
		});
	</script>
@endpush
