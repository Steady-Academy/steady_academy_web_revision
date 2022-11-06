<nav id="sidebar" class="sidebar">
	<div class="sidebar-content js-simplebar">
		<a class="sidebar-brand d-flex gap-1" href="/admin">
			<img src="{{ asset('assets-admin/img/logo.svg') }}" width="25" alt="">
			<span class="align-middle mt-2">teady Academy</span>
		</a>

		<ul class="sidebar-nav">
			<li class="sidebar-header">Dashboard</li>
			<li class="sidebar-item {{ request()->is('admin/dashboard*') ? 'active' : '' }}">
				<a class="sidebar-link" href="{{ route('admin.dashboard') }}">
					<i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
				</a>
			</li>
			<li class="sidebar-header">Data</li>
			<li class="sidebar-item {{ request()->is('admin/users*') ? 'active' : '' }}">
				<a href="#" class="sidebar-link {{ request()->is('admin/users*') ? '' : 'collapsed' }}"
					data-bs-target="#users" data-bs-toggle="collapse" aria-expanded="false">
					<i class="align-middle" data-feather="users"></i>
					<span class="align-middle">Users</span>
				</a>
				<ul id="users" class="sidebar-dropdown list-unstyled collapse {{ request()->is('admin/users*') ? 'show' : '' }}"
					data-bs-parent="#sidebar">
					<li class="sidebar-item {{ request()->is('admin/users/admin*') ? 'active' : '' }}">
						<a href="{{ route('admin.admin.index') }}" class="sidebar-link">Admin</a>
					</li>
					<li class="sidebar-item {{ request()->is('admin/users/student*') ? 'active' : '' }}">
						<a href="{{ route('admin.student.index') }}" class="sidebar-link">Student</a>
					</li>
					<li class="sidebar-item {{ request()->is('admin/users/instructur*') ? 'active' : '' }}">
						<a href="{{ route('admin.instructur.index') }}" class="sidebar-link">Instructor</a>
					</li>
				</ul>
			</li>
			<li class="sidebar-item {{ request()->is('admin/instructur/request*') ? 'active' : '' }}">
				<a class="sidebar-link" href="{{ route('admin.request.index') }}">
					<i class="align-middle" data-feather="send"></i> <span class="align-middle">Permintaan</span>
				</a>
			</li>
			<li class="sidebar-item {{ request()->is('admin/kategori*') ? 'active' : '' }}">
				<a class="sidebar-link {{ request()->is('admin/kategori*') ? '' : 'collapsed' }}" data-bs-target="#category"
					href="#" data-bs-toggle="collapse" aria-expanded="false">
					<i class="align-middle" data-feather="grid"></i>
					<span class="align-middle">Kategori</span>
				</a>
				<ul id="category"
					class="sidebar-dropdown list-unstyled collapse {{ request()->is('admin/kategori*') ? 'show' : '' }}"
					data-bs-parent="#sidebar">
					<li class="sidebar-item {{ request()->is('admin/kategori/kursus_kategori*') ? 'active' : '' }}">
						<a href="{{ route('admin.kursus_kategori.index') }}" class="sidebar-link">Kategori Kursus</a>
					</li>
					<li class="sidebar-item {{ request()->is('admin/kategori/tipe_harga*') ? 'active' : '' }}">
						<a href="{{ route('admin.tipe_harga.index') }}" class="sidebar-link">Tipe Harga</a>
					</li>
					<li class="sidebar-item {{ request()->is('admin/kategori/tags*') ? 'active' : '' }}">
						<a href="{{ route('admin.tags.index') }}" class="sidebar-link">Tags</a>
					</li>
					<li class="sidebar-item {{ request()->is('admin/kategori/tipe_level*') ? 'active' : '' }}">
						<a href="{{ route('admin.tipe_level.index') }}" class="sidebar-link">Tipe Level</a>
					</li>
				</ul>
			</li>

			<li class="sidebar-item ">
				<a class="sidebar-link" href="#">
					<i class="align-middle" data-feather="book"></i> <span class="align-middle">Kursus</span>
				</a>
			</li>

			<li class="sidebar-header">Halaman</li>
			<li class="sidebar-item">
				<a class="sidebar-link" href="#">
					<i class="align-middle" data-feather="monitor"></i> <span class="align-middle">Halaman utama</span>
				</a>
				<a class="sidebar-link" href="#">
					<i class="align-middle" data-feather="monitor"></i> <span class="align-middle">Bantuan</span>
				</a>
			</li>
		</ul>
	</div>
</nav>
