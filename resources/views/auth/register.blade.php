@extends('auth.layouts.app')
@section('title', 'Daftar')
@section('content')
	<section class="h-100 py-3">
		<div class="container">
			<div class="row justify-content-center align-items-center">
				<div class="col-sm-10 col-md-6 col-lg-5">
					<div class="card border-1 shadow rounded-4">
						<div class="card-body">
							<div class="m-sm-2">
								<div class="text-center">
									<h1 class="h4">Daftar akun Steady Academy</h1>
								</div>
								<div class=" text-center">
									<span>Sudah punya akun?<a href="{{ route('login') }}" class="text-link fw-bold"> Masuk </a></span>
								</div>
								<div class="row">
									<div class="position-relative my-1">
										<hr>
										<p class="small position-absolute top-50 start-50 translate-middle bg-body px-2 text-center">Daftar lebih cepat
											melalui</p>
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
								<div class="position-relative my-1">
									<hr>
									<p class="small position-absolute top-50 start-50 translate-middle bg-body px-2 text-center">atau isi data kamu
										di bawah</p>
								</div>
							</div>
							<form method="POST" action="{{ route('register') }}">
								@csrf
								<div class="mb-3">
									<label for="nama_lengkap" class="form-label">Nama lengkap</label>
									<input type="text" class="form-control form-control-md @error('nama') is-invalid @enderror" name="nama"
										placeholder="Masukkan nama lengkap" value="{{ old('nama') }}" required>
									@error('nama')
										<div class="error-message">
											{{ $message }}
										</div>
									@enderror
								</div>
								<div class="mb-3">
									<label for="email" class="form-label">Email</label>
									<input type="email" class="form-control form-control-md @error('email') is-invalid @enderror" name="email"
										placeholder="Masukkan email " value="{{ old('email') }}" required>
									@error('email')
										<div class="error-message">
											{{ $message }}
										</div>
									@enderror
								</div>
								<div class="mb-3">
									<label for="telepon" class="form-label">Telepon</label>
									<div class="input-group input-group-md">
										<span class="input-group-text bg-light rounded-start border-1 text-secondary fw-bold text-small">+62</span>
										<input type="tel" class="form-control form-control-md @error('telepon') is-invalid @enderror"
											name="telepon" placeholder="Masukan telepon" value="{{ old('telepon') }}" required>
									</div>
									@error('telepon')
										<div class="error-message">
											{{ $message }}
										</div>
									@enderror
								</div>
								<div class="mb-3">
									<label for="password" class="form-label">Password</label>
									<div class="input-group input-group-md">
										<input type="password" class="form-control form-control-md @error('password') is-invalid @enderror"
											id="new-password" name="password" placeholder="Masukkan password " autocomplete="new-password" required>
										<span class="input-group-text bg-light rounded-end border-1 text-secondary px-3"><i class="fas fa-eye"
												id="togglePassword"></i></span>
									</div>
									@error('password')
										<div class="error-message">
											{{ $message }}
										</div>
									@enderror
								</div>
								<div class="mb-3">
									<label for="password" class="form-label">Konfirmasi password</label>
									<div class="input-group input-group-md">
										<input type="password" class="form-control form-control-md @error('password') is-invalid @enderror"
											id="password-confirm" name="password_confirmation" placeholder="Masukkan konfirmasi password"
											autocomplete="new-password" required>
										<span class="input-group-text bg-light rounded-end border-1 text-secondary px-3"><i class="fas fa-eye"
												id="toggleConfirm"></i></span>
									</div>
									@error('password_confirmation')
										<div class="error-message">
											{{ $message }}
										</div>
									@enderror
								</div>

								<div class="form-check align-items-center">
									<input id="term-service" type="checkbox" class="form-check-input" required>
									<label class="form-check-label text-small" for="term-service">Dengan mendaftar, kamu setuju untuk
										mengikuti <a href="#" class="text-link">Syarat Penggunaan</a> dan <a href="#"
											class="text-link">Kebijakan Privasi.</a></label>
								</div>
								<div class="text-center mt-3 mb-3 d-grid">
									<button type="submit" id="daftar" class="btn btn-primary fw-bold disabled">Daftar</button>
								</div>
							</form>
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
		$("#term-service").click(function() {
			if ($("#term-service:checked").length === 1) {
				$("#daftar").removeClass("disabled");
			} else {
				$("#daftar").addClass("disabled");
			}
		});

		const togglePassword = document.querySelector("#togglePassword");
		const toggleConfirm = document.querySelector("#toggleConfirm");
		const password = document.querySelector("#new-password");
		const confirm = document.querySelector('#password-confirm');

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

		toggleConfirm.addEventListener("click", function() {
			const type = confirm.getAttribute("type") === "password" ? "text" : "password";
			confirm.setAttribute("type", type);
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
