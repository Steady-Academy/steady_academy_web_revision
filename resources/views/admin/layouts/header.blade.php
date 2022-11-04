<nav class="navbar navbar-expand navbar-light navbar-bg py-2">
	<a class="sidebar-toggle">
		<i class="hamburger align-self-center"></i>
	</a>
	{{-- @dd($notif) --}}

	<div class="navbar-collapse collapse">
		<ul class="navbar-nav navbar-align">
			<li class="nav-item dropdown">
				<a class="nav-link d-none d-sm-inline-block " href="#" data-bs-toggle="dropdown">
					<i class="bi bi-bell-fill fs-3 position-relative">
						@if ($notif != null)
							<span class="position-absolute top-0 start-100 translate-middle p-2 bg-danger border border-light rounded-circle"
								style="padding: 5px !important">
								<span class="visually-hidden">New alerts</span>
							</span>
						@endif
					</i>
				</a>
				<div class="dropdown-menu dropdown-menu-end dropdown-menu-lg">
					<h6 class="dropdown-header fw-bold">Permintaan Instruktur</h6>
					@foreach ($notif as $notification)
						<a class="dropdown-item" href="{{ route('admin.request.show', $notification['uid']) }}">
							<div class="user d-flex align-items-center">
								<div>
									<img src="{{ $notification['photoUrl'] }}" class="rounded-circle border border-1 border-dark me-2"
										width="30" height="30" alt="{{ $notification['name'] }}">
								</div>
								<div>
									<p class="mb-0 fw-bold">{{ Str::limit($notification['name'], '30', '...') }}</p>
									<p class="mb-0 small">{{ Str::limit($notification['email'], '30', '...') }}</p>
								</div>
							</div>
						</a>
						<div class="dropdown-divider"></div>
					@endforeach
					<a href="{{ route('admin.request.index') }}" class="dropdown-header text-center text-primary">
						Lihat semua
					</a>
				</div>
			</li>
			<li class="nav-item dropdown">
				<a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
					<i class="align-middle" data-feather="settings"></i>
				</a>
				<a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
					<img src="{{ $user['photoUrl'] }}" width="35" height="35" class="border border-1 border-dark rounded-circle"
						alt="{{ $user['name'] }}">
				</a>
				<div class="dropdown-menu dropdown-menu-end">
					<a class="dropdown-item" href="#"><i class="align-middle me-1" data-feather="user"></i> Profile</a>
					<a class="dropdown-item" href="pages-settings.html"><i class="align-middle me-1"
							data-feather="settings"></i>Settings & Privacy</a>
					<div class="dropdown-divider"></div>
					<a class="dropdown-item" href="#"><i class="align-middle me-1" data-feather="info"></i>Help</a>
					<a class="dropdown-item" href="{{ route('logout') }}"
						onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i
							class="align-middle me-1" data-feather="power"></i>Sign out</a>
					<form action="{{ route('logout') }}" id="logout-form" method="POST" class="d-none">
						@csrf
					</form>
				</div>
			</li>
		</ul>
	</div>
</nav>
