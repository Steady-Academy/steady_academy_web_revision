<nav class="navbar navbar-expand navbar-light navbar-bg py-2">
	<a class="sidebar-toggle">
		<i class="hamburger align-self-center"></i>
	</a>

	<div class="navbar-collapse collapse">
		<ul class="navbar-nav navbar-align align-items-center">
			<li class="nav-item dropdown">
				<a class="nav-icon dropdown-toggle" href="#" id="messagesDropdown" data-bs-toggle="dropdown" aria-expanded="true">
					<div class="position-relative">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
							stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
							class="feather feather-bell align-middle me-2">
							<path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
							<path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
						</svg>
						@if (count($notif) > 0)
							<span class="indicator">{{ count($notif) }}</span>
						@endif
					</div>
				</a>
				<div class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0" aria-labelledby="messagesDropdown"
					data-bs-popper="static">
					@if (count($notif) != 0)
						@if (count($notif) > 0)
							<div class="dropdown-menu-header">
								<div class="position-relative">
									{{ count($notif) }} Permintaan
								</div>
							</div>
						@endif
						<div class="list-group">
							<h6 class="dropdown-header fw-bold">Permintaan Instruktur</h6>
							@foreach ($notif as $notification)
								<a href="{{ route('admin.request.show', $notification['uid']) }}" class="list-group-item">
									<div class="row g-0 align-items-center">
										<div class="col-2">
											<img src="{{ $notification['photoUrl'] }}" class="avatar img-fluid rounded-circle"
												alt="{{ $notification['name'] }}">
										</div>
										<div class="col-10 ps-2">
											<div class="text-dark">{{ Str::limit($notification['name'], '30', '...') }}</div>
											<div class="text-muted small mt-1">{{ Str::limit($notification['email'], '30', '...') }}</div>
											<div class="text-muted small mt-1">{{ \Carbon\Carbon::parse($notification['register_at'])->diffForHumans() }}
											</div>
										</div>
									</div>
								</a>
							@endforeach
						</div>
						<div class="dropdown-menu-footer">
							<a href="{{ route('admin.request.index') }}" class="text-muted">Lihat semua</a>
						</div>
					@else
						<div class="dropdown-menu-footer">
							<h6 class="fw-bold text-center m-0">Tidak ada notifikasi.</h6>
						</div>
					@endif
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
					{{-- <a class="dropdown-item" href="#"><i class="align-middle me-1" data-feather="user"></i> Profile</a>
					<a class="dropdown-item" href="pages-settings.html"><i class="align-middle me-1"
							data-feather="settings"></i>Settings & Privacy</a> --}}
					<a class="dropdown-item" href="{{ route('help.center') }}"><i class="align-middle me-1"
							data-feather="info"></i>Bantuan</a>
					<div class="dropdown-divider"></div>
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
