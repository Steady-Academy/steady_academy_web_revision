<nav class="navbar navbar-expand navbar-light navbar-bg py-2">
	<a class="sidebar-toggle">
		<i class="hamburger align-self-center"></i>
	</a>

	<div class="navbar-collapse collapse">
		<ul class="navbar-nav navbar-align align-items-center">
			<li class="nav-item dropdown">
				<a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
					<i class="align-middle" data-feather="settings"></i>
				</a>
				<a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
					<img src="{{ $user['photoUrl'] }}" width="35" height="35" class="border border-1 border-dark rounded-circle"
						alt="{{ $user['name'] }}">
				</a>
				<div class="dropdown-menu dropdown-menu-end">
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
