<nav id="sidebar" class="sidebar">
	<div class="sidebar-content js-simplebar">
		<a class="sidebar-brand d-flex gap-1" href="/admin">
			<img src="{{ asset('assets-admin/img/logo.svg') }}" width="25" alt="">
			<span class="align-middle mt-2">teady Academy</span>
		</a>

		<ul class="sidebar-nav">
			<li class="sidebar-header">Dashboard</li>
			<li class="sidebar-item {{ request()->is('instructur/dashboard*') ? 'active' : '' }}">
				<a class="sidebar-link" href="{{ route('instructur.dashboard') }}">
					<i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
				</a>
			</li>
			<li class="sidebar-item {{ request()->is('instructur/users/student*') ? 'active' : '' }}">
				<a class="sidebar-link" href="{{ route('instructur.users.student') }}">
					<i class="align-middle" data-feather="users"></i> <span class="align-middle">Student</span>
				</a>
			</li>

			<li class="sidebar-item {{ request()->is('instructur/kursus*') ? 'active' : '' }}">
				<a class="sidebar-link" href="{{ route('instructur.index.course') }}">
					<i class="align-middle" data-feather="book"></i> <span class="align-middle">Kursus</span>
				</a>
			</li>

			<li class="sidebar-header">Halaman</li>
			<li class="sidebar-item">
				<a class="sidebar-link" href="{{ route('landing') }}">
					<i class="align-middle" data-feather="monitor"></i> <span class="align-middle">Halaman utama</span>
				</a>
				<a class="sidebar-link" href="{{ route('help.center') }}">
					<i class="align-middle" data-feather="monitor"></i> <span class="align-middle">Bantuan</span>
				</a>
			</li>
		</ul>
	</div>
</nav>
