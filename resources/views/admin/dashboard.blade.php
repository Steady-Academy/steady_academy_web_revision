@extends('admin.layouts.app')
@section('title', 'Admin Dashboard | Steady Academy')
@section('content')
	<div class="row mb-2 mb-xl-3">
		<div class="col-auto d-none d-sm-block">
			<h1 class="h3 mb-3">Dashboard</h1>
		</div>

		<div class="col-auto ms-auto text-end mt-n1">
			<a class="btn btn-light bg-white shadow-sm" href="#" data-bs-toggle="dropdown" data-bs-display="static">
				<i class="align-middle mt-n1" data-feather="calendar"></i> Hari ini |
				{{ $current = Carbon\Carbon::now()->format('d M Y') }}
			</a>
		</div>
	</div>
	<div class="row">
		<div class="col-12">
			<div class="w-100">
				<div class="row">
					<div class="col-sm-3 col-lg-12 col-xxl-3 d-flex">
						<div class="card illustration flex-fill">
							<div class="card-body p-0 d-flex flex-fill">
								<div class="row g-0 w-100">
									<div class="col-6">
										<div class="illustration-text p-3 m-1">
											<h4 class="illustration-text">{{ Auth::user()->displayName }}</h4>
											<p class="mb-0">Steady Academy Dashboard</p>
										</div>
									</div>
									<div class="col-6 align-self-end text-end">
										<img src="{{ asset('assets-admin/img/illustrations/searching.png') }}" alt="Searching"
											class="img-fluid illustration-img">
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-3 col-lg-12 col-xxl-3 d-flex">
						<div class="card flex-fill">
							<div class="card-body">
								<div class="row">
									<div class="col mt-0">
										<h5 class="card-title">Students</h5>
									</div>

									<div class="col-auto">
										<div class="stat stat-sm">
											<i class="align-middle" data-feather="users"></i>
										</div>
									</div>
								</div>
								<span class="h1 d-inline-block mt-1 mb-4">{{ $totalStudents }}</span>
								<div class="mb-0">
									{{-- {{-- @if ($studentsNew != '') --}}
									<span class="badge badge-soft-success me-2">+{{ $newStudents }} %</span>
									<span class="text-muted">Student Baru</span>
									{{-- @endif --}}
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-3 col-lg-12 col-xxl-3 d-flex">
						<div class="card flex-fill">
							<div class="card-body">
								<div class="row">
									<div class="col mt-0">
										<h5 class="card-title">Instructors</h5>
									</div>

									<div class="col-auto">
										<div class="stat stat-sm">
											<i class="align-middle" data-feather="users"></i>
										</div>
									</div>
								</div>
								<span class="h1 d-inline-block mt-1 mb-4">{{ $totalInstructurs }}</span>
								<div class="mb-0">
									{{-- @if ($instructorsNew != '') --}}
									<span class="badge badge-soft-success me-2">+{{ $newInstructurs }}%</span>
									<span class="text-muted">Instruktur Baru</span>
									{{-- @endif --}}
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-3 col-lg-12 col-xxl-3 d-flex">
						<div class="card flex-fill">
							<div class="card-body">
								<div class="row">
									<div class="col mt-0">
										<h5 class="card-title">Courses</h5>
									</div>

									<div class="col-auto">
										<div class="stat stat-sm">
											<i class="align-middle" data-feather="book-open"></i>
										</div>
									</div>
								</div>
								<span class="h1 d-inline-block mt-1 mb-4">{{ $totalCourses }}</span>
								<div class="mb-0">
									{{-- @if ($masterclassesNew != '') --}}
									<span class="badge badge-soft-success me-2">+{{ $newCourses }}%</span>
									<span class="text-muted">Kursus Baru</span>
									{{-- @endif --}}
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="row">

		<div class="col-12 col-lg-4 d-flex">
			<div class="card flex-fill">
				<div class="card-header">
					<h5 class="card-title mb-0">Ketertarikan</h5>
				</div>
				<div class="card-body">
					<div class="chart">
						<canvas id="chartjs-dashboard-radar"></canvas>
					</div>
				</div>
			</div>
		</div>
		<div class="col-12 col-lg-4 d-flex">
			<div class="card flex-fill w-100">
				<div class="card-header">
					<div class="card-actions float-end">
						<div class="dropdown position-relative">
							<a href="#" data-bs-toggle="dropdown" data-bs-display="static">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
									stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
									class="feather feather-more-horizontal align-middle">
									<circle cx="12" cy="12" r="1"></circle>
									<circle cx="19" cy="12" r="1"></circle>
									<circle cx="5" cy="12" r="1"></circle>
								</svg>
							</a>
						</div>
					</div>
					<h5 class="card-title mb-0">Kategori Berdasarkan Kursus</h5>
				</div>
				<div class="card-body d-flex w-100">
					<div class="align-self-center chart">
						<div class="chartjs-size-monitor">
							<div class="chartjs-size-monitor-expand">
								<div class=""></div>
							</div>
							<div class="chartjs-size-monitor-shrink">
								<div class=""></div>
							</div>
						</div>
						<canvas id="chartjs-dashboard-bar-devices" width="782" height="600" class="chartjs-render-monitor"
							style="display: block; height: 300px; width: 391px;"></canvas>
					</div>
				</div>
			</div>
		</div>
		<div class="col-12 col-lg-4 d-flex">
			<div class="card flex-fill w-100">
				<div class="card-header">
					<div class="card-actions float-end">
						<div class="dropdown position-relative">
							<a href="#" data-bs-toggle="dropdown" data-bs-display="static">
								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
									stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
									class="feather feather-more-horizontal align-middle">
									<circle cx="12" cy="12" r="1"></circle>
									<circle cx="19" cy="12" r="1"></circle>
									<circle cx="5" cy="12" r="1"></circle>
								</svg>
							</a>
						</div>
					</div>
					<h5 class="card-title mb-0">Permintaan Instructur</h5>
				</div>
				<table class="table table-striped my-0">
					<thead>
						<tr>
							<th class="d-none d-xl-table-cell w-50">Akun</th>
							<th class="text-end">No Teleon</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($requestInstructurs as $request)
							<tr>
								<td>
									<div class="d-flex gap-2">
										<img src="{{ $request->data()['photoUrl'] }}" class="rounded-circle border border-2 border-dark"
											width="50" height="50" alt="{{ $request->data()['name'] }}">
										<div class="text-left align-self-center">
											<h5 class="fw-bold mb-0">{{ $request->data()['name'] }}</h5>
											<p class="mb-0">{{ Str::limit($request->data()['email'], 20, '...') }}</p>
										</div>
									</div>
								</td>
								<td class="text-left">{{ $request->data()['phoneNumber'] }}</td>
								<td><a href="{{ route('admin.request.show', $request->data()['uid']) }}" class="btn btn-info"><i
											class="fas fa-search"></i></a></td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-12 col-lg-7 col-xl-12 d-flex">
			<div class="card flex-fill">
				<div class="card-header">
					<h5 class="card-title mb-0">Kursus</h5>
				</div>
				<table id="datatables-dashboard-traffic" class="table table-striped my-0">
					<thead>
						<tr>
							<th>Source</th>
							<th class="text-end">Users</th>
							<th class="d-none d-xl-table-cell text-end">Sessions</th>
							<th class="d-none d-xl-table-cell text-end">Bounce Rate</th>
							<th class="d-none d-xl-table-cell text-end">Avg. Session Duration</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Google</td>
							<td class="text-end">1023</td>
							<td class="d-none d-xl-table-cell text-end">1265</td>
							<td class="d-none d-xl-table-cell text-end text-success">27.23%</td>
							<td class="d-none d-xl-table-cell text-end">00:06:25</td>
						</tr>
						<tr>
							<td>Bing</td>
							<td class="text-end">504</td>
							<td class="d-none d-xl-table-cell text-end">623</td>
							<td class="d-none d-xl-table-cell text-end text-danger">66.76%</td>
							<td class="d-none d-xl-table-cell text-end">00:04:42</td>
						</tr>
						<tr>
							<td>Twitter</td>
							<td class="text-end">462</td>
							<td class="d-none d-xl-table-cell text-end">571</td>
							<td class="d-none d-xl-table-cell text-end text-success">31.53%</td>
							<td class="d-none d-xl-table-cell text-end">00:08:05</td>
						</tr>
						<tr>
							<td>Pinterest</td>
							<td class="text-end">623</td>
							<td class="d-none d-xl-table-cell text-end">770</td>
							<td class="d-none d-xl-table-cell text-end text-danger">52.81%</td>
							<td class="d-none d-xl-table-cell text-end">00:03:10</td>
						</tr>
						<tr>
							<td>Facebook</td>
							<td class="text-end">812</td>
							<td class="d-none d-xl-table-cell text-end">1003</td>
							<td class="d-none d-xl-table-cell text-end text-success">24.83%</td>
							<td class="d-none d-xl-table-cell text-end">00:05:56</td>
						</tr>
						<tr>
							<td>DuckDuckGo</td>
							<td class="text-end">693</td>
							<td class="d-none d-xl-table-cell text-end">856</td>
							<td class="d-none d-xl-table-cell text-end text-success">37.36%</td>
							<td class="d-none d-xl-table-cell text-end">00:09:12</td>
						</tr>
						<tr>
							<td>GitHub</td>
							<td class="text-end">713</td>
							<td class="d-none d-xl-table-cell text-end">881</td>
							<td class="d-none d-xl-table-cell text-end text-success">38.09%</td>
							<td class="d-none d-xl-table-cell text-end">00:06:19</td>
						</tr>
						<tr>
							<td>Direct</td>
							<td class="text-end">872</td>
							<td class="d-none d-xl-table-cell text-end">1077</td>
							<td class="d-none d-xl-table-cell text-end text-success">32.70%</td>
							<td class="d-none d-xl-table-cell text-end">00:09:18</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<script>
		document.addEventListener("DOMContentLoaded", function() {
			// Bar chart
			new Chart(document.getElementById("chartjs-dashboard-bar-devices"), {
				type: "bar",
				data: {
					labels: {!! $categoryName !!},
					datasets: [{
						label: "Mobile",
						backgroundColor: window.theme.primary,
						borderColor: window.theme.primary,
						hoverBackgroundColor: window.theme.primary,
						hoverBorderColor: window.theme.primary,
						data: [54, 67, 41, 55, 62, 45, 55, 73, 60, 76, 48, 79],
						barPercentage: .5,
						categoryPercentage: .5
					}, {
						label: "Desktop",
						backgroundColor: window.theme["primary-light"],
						borderColor: window.theme["primary-light"],
						hoverBackgroundColor: window.theme["primary-light"],
						hoverBorderColor: window.theme["primary-light"],
						data: [69, 66, 24, 48, 52, 51, 44, 53, 62, 79, 51, 68],
						barPercentage: .5,
						categoryPercentage: .5
					}]
				},
				options: {
					maintainAspectRatio: false,
					cornerRadius: 15,
					legend: {
						display: false
					},
					scales: {
						yAxes: [{
							gridLines: {
								display: false
							},
							ticks: {
								stepSize: 20
							},
							stacked: true,
						}],
						xAxes: [{
							gridLines: {
								color: "transparent"
							},
							stacked: true,
						}]
					}
				}
			});
		});
	</script>
	<script>
		document.addEventListener("DOMContentLoaded", function() {
			// Pie chart
			new Chart(document.getElementById("chartjs-dashboard-pie"), {
				type: "pie",
				data: {
					labels: ["Direct", "Affiliate", "E-mail", "Other"],
					datasets: [{
						data: [2602, 1253, 541, 1465],
						backgroundColor: [
							window.theme.primary,
							window.theme.warning,
							window.theme.danger,
							"#E8EAED"
						],
						borderWidth: 5,
						borderColor: window.theme.white
					}]
				},
				options: {
					responsive: !window.MSInputMethodContext,
					maintainAspectRatio: false,
					cutoutPercentage: 70,
					legend: {
						display: false
					}
				}
			});
		});
	</script>
	<script>
		document.addEventListener("DOMContentLoaded", function() {
			// Radar chart
			new Chart(document.getElementById("chartjs-dashboard-radar"), {
				type: "radar",
				data: {
					labels: {!! $categoryName !!},
					datasets: [{
						label: "Interests",
						backgroundColor: "rgba(0, 123, 255, 0.2)",
						borderColor: "#2979ff",
						pointBackgroundColor: "#2979ff",
						pointBorderColor: "#fff",
						pointHoverBackgroundColor: "#fff",
						pointHoverBorderColor: "#2979ff",
						data: [70, 53, 82, 60, 33]
					}]
				},
				options: {
					maintainAspectRatio: false,
					legend: {
						display: false
					}
				}
			});
		});
	</script>
	{{-- <script>
		document.addEventListener("DOMContentLoaded", function() {
			$("#datatables-dashboard-traffic").DataTable({
				pageLength: 8,
				lengthChange: false,
				bFilter: false,
				autoWidth: false,
				order: [
					[1, "desc"]
				]
			});
		});
	</script> --}}
@endsection
