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
						<a class="nav-link" href="" aria-haspopup="true" aria-expanded="false">Home</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="" aria-haspopup="true" aria-expanded="false">Pusat Bantuan</a>
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
							<li><a class="dropdown-item" href="">Tentang Steady Academy</a></li>
							<li><a class="dropdown-item" href="">Tentang Kami</a></li>
							<li><a class="dropdown-item" href="">Kontak Kami</a></li>
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
				<div class="nav my-3 my-xl-0 px-4 flex-nowrap align-items-center">
					<div class="nav-item w-100">
						<div class="login">
							<!-- Profile START -->
							<a href="{{ route('register') }}" class="btn btn-primary mb-0 fw-bold">Daftar Menjadi Instruktur</a>
							<!-- Profile START -->
						</div>
					</div>
				</div>
				<!-- Nav Search END -->
			</div>
			<!-- Main navbar END -->
		</div>
	</nav>
	<!-- Logo Nav END -->
</header>
<!-- Header END -->
