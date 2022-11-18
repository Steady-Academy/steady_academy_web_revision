<!-- Header START -->
<header class="navbar-light navbar-sticky header-static">
	<!-- Logo Nav START -->
	<nav class="navbar navbar-expand-xl">
		<div class="container-fluid px-3 px-xl-5">
			<!-- Logo START -->
			<a class="navbar-brand" href="/">
				<img class="light-mode-item navbar-brand-item" src="{{ asset('assets-user/images/logo.svg') }}" alt="logo"
					style="max-width: 100%;">
			</a>
			<!-- Logo END -->

			<!-- Responsive navbar toggler -->
			<button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
				aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-animation">
					<span></span>
					<span></span>
					<span></span>
				</span>
			</button>

			<!-- Main navbar START -->
			<div class="navbar-collapse w-100 collapse" id="navbarCollapse">
				<!-- Nav category menu END -->

				<!-- Nav Main menu START -->
				<ul class="navbar-nav navbar-nav-scroll me-auto">
					<li class="nav-item">
						<a class="nav-link" href="{{ route('landing') }}" aria-haspopup="true" aria-expanded="false">Home</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="{{ route('help.center') }}" aria-haspopup="true" aria-expanded="false">Pusat Bantuan</a>
					</li>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="demoMenu" data-bs-toggle="dropdown" aria-haspopup="true"
							aria-expanded="false">Instruktur</a>
						<ul class="dropdown-menu" aria-labelledby="demoMenu">
							<li><a class="dropdown-item" href="">Jadi Instruktur</a></li>
							<li><a class="dropdown-item" href="">Daftar Instruktur</a></li>
						</ul>
					</li>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="demoMenu" data-bs-toggle="dropdown" aria-haspopup="true"
							aria-expanded="false">Tentang</a>
						<ul class="dropdown-menu" aria-labelledby="demoMenu">
							<li><a class="dropdown-item" href="{{ route('about.steady-academy') }}">Tentang Steady Academy</a></li>
							<li><a class="dropdown-item" href="{{ route('about.us') }}">Tentang Kami</a></li>
							<li><a class="dropdown-item" href="{{ route('contact.us') }}">Kontak Kami</a></li>
						</ul>
					</li>
					<!-- Nav item 4 Megamenu-->
					<li class="nav-item dropdown dropdown-fullwidth">
						<a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-haspopup="true"
							aria-expanded="false">Lainnya</a>
						<div class="dropdown-menu dropdown-menu-end pb-0" data-bs-popper="none">
							<div class="row p-4 g-2">
								<!-- Dropdown column item -->

								<h6 class="mb-0">Lainnya</h6>
								<hr>
								<!-- Dropdown item -->
								<div class="position-relative bg-primary-soft-hover rounded-2 transition-base p-3">
									<a class="stretched-link h6 mb-0" href="">Petunjuk Penggunaan</a>
									<p class="mb-0 small text-truncate-2">Speedily say has suitable disposal add
										boy. On forth doubt miles of child.</p>
								</div>
								<!-- Dropdown item -->
								<div class="position-relative bg-primary-soft-hover rounded-2 transition-base p-3">
									<a class="stretched-link h6 mb-0" href="">Privacy
										dan security</a>
									<p class="mb-0 small text-truncate-2">Speedily say has suitable disposal add
										boy. On forth doubt miles of child.</p>
								</div>
								<!-- Dropdown item -->
								<div class="position-relative bg-primary-soft-hover rounded-2 transition-base p-3">
									<a class="stretched-link h6 mb-0" href="">Syarat dan Ketentuan</a>
									<p class="mb-0 small text-truncate-2">Speedily say has suitable disposal add
										boy. On forth doubt miles of child.</p>
								</div>

							</div>
						</div>
					</li>
				</ul>
				<!-- Nav Main menu END -->

				<!-- Nav Search START -->
				@auth

					{{-- @php
						$uid = Session::get('uid');
						$user = app('firebase.auth')->getUser($uid);
						$snapshot = app('firebase.firestore')
						    ->database()
						    ->collection('Users')
						    ->document($uid)
						    ->snapshot();
					@endphp --}}
					<div class="text-center my-2">
						<div class="dropdown ms-1 ms-lg-0 ">
							<a class="fw-bold fs-6 text-dark" href="#" id="profileDropdown" type="button" data-bs-toggle="dropdown"
								aria-expanded="false" data-bs-display="static">
								{{-- {{ $user['name'] }}
								<i class="ms-2 bi bi-caret-down-fill"></i> --}}
								<img src="{{ $user['photoUrl'] }}" class="rounded-circle border border-1 border-dark" width="40"
									height="40" alt="{{ $user['name'] }}">
							</a>
							<ul class="dropdown-menu dropdown-animation dropdown-menu-end shadow pt-3" aria-labelledby="profileDropdown">
								<!-- Profile info -->
								<li class="px-3">
									<div class="d-flex align-items-center">
										<div>
											<a class="h6 text-truncate" href="#">{{ Str::limit($user['name'], '30', '...') }}</a>
											<p class="small m-0 text-truncate">{{ Str::limit($user['email'], '30', '...') }}</p>
										</div>
									</div>
									<hr>
								</li>
								<!-- Links -->

								@if ($user['registered'] == false)
									<li><a class="dropdown-item" href="{{ route('form.instructur') }}"><i
												class="bi bi-file-richtext fa-fw me-2"></i>Formulir
										</a>
									</li>
								@else
									<li><a class="dropdown-item" href="{{ route('instructur.dashboard') }}"><i
												class="bi bi-person fa-fw me-2"></i>Dashboard</a>
									</li>
									<li><a class="dropdown-item" href="#"><i class="bi bi-person fa-fw me-2"></i>Ubah Profil</a>
									</li>
									<li><a class="dropdown-item" href="#"><i class="bi bi-gear fa-fw me-2"></i>Setting Akun</a>
									</li>
									<li><a class="dropdown-item" href="#"><i class="bi bi-info-circle fa-fw me-2"></i>Bantuan</a>
									</li>
								@endif

								<li><a class="dropdown-item bg-danger-soft-hover" href="{{ route('logout') }}"
										onclick="event.preventDefault();
                                                             document.getElementById('logout-form').submit();"><i
											class="bi bi-power fa-fw me-2"></i>Sign Out</a></li>
								<form action="{{ route('logout') }}" id="logout-form" method="POST" class="d-none">
									@csrf
								</form>
							</ul>
						</div>
					</div>
				@else
					<div class="nav my-3 my-xl-0 px-4 flex-nowrap align-items-center text-center">
						<div class="nav-item w-100">
							<div class="login">
								<!-- Profile START -->
								<a href="{{ route('register') }}" class="btn btn-primary mb-0 fw-bold">Daftar Menjadi Instruktur</a>
								<!-- Profile START -->
							</div>
						</div>
					</div>
				@endauth
				<!-- Nav Search END -->
			</div>
			<!-- Main navbar END -->
		</div>
	</nav>
	<!-- Logo Nav END -->
</header>
<!-- Header END -->
