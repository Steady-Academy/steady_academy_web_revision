@extends('admin.layouts.app')
@section('title', 'Detail Student | Basicschool')
@section('content')
	<div class="container-fluid p-0">
		<h1 class="h3 mb-3">Detail Data Student</h1>
		<nav style="--bs-breadcrumb-divider: '/';" aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
				<li class="breadcrumb-item active" aria-current="page">Users</li>
				<li class="breadcrumb-item"><a href="{{ route('admin.student.index') }}">Student</a></li>
				<li class="breadcrumb-item active" aria-current="page">{{ $student['uid'] }}</li>
				<li class="breadcrumb-item active" aria-current="page">Detail</li>
			</ol>
		</nav>
		<div class="row justify-content-center">
			<div class="col-7">
				<div class="card">
					<div class="card-header">
						<h5 class="card-title">Detail Student</h5>
						{{-- <h6 class="card-subtitle text-muted"><b>catatan:</b> jangan sebarkan data pribadi pengguna.</h6> --}}
						<div class="bg-warning bg-opacity-25 border border-4 border-top-0 border-bottom-0 border-end-0 border-warning">
							<p class="p-2"><b>Catatan:</b>Jangan sebarkan data pribadi pengguna.</p>
						</div>
					</div>
					<div class="card-body">
						<div class="row justify-content-center">
							<div class="col-12 text-center">
								<img src="{{ $student['photoUrl'] }}" width="150" height="150"
									class="rounded-circle border border-2 border-dark mb-4" alt="{{ $student['name'] }}">
							</div>
							<hr>
							<div class="col-12">
								<h3 class="fw-bold">Umum</h3>
								<dl class="row ">
									<dt class="col-sm-3">UID</dt>
									<dd class="col-sm-9">{{ $student['uid'] }}</dd>

									<dt class="col-sm-3">Nama</dt>
									<dd class="col-sm-9">{{ $student['name'] }}</dd>

									<dt class="col-sm-3">Email</dt>
									<dd class="col-sm-9">
										{{ $student['email'] }}
									</dd>

									<dt class="col-sm-3">Nomor Telepon</dt>
									<dd class="col-sm-9">{{ $student['phoneNumber'] }}</dd>

									<dt class="col-sm-3 text-truncate">Provider</dt>
									<dd class="col-sm-9">{{ $student['provider'] }}</dd>

									<dt class="col-sm-3">Terakhir Login</dt>
									<dd class="col-sm-9">
										{{ $student['login_at'] }}
									</dd>
									<dt class="col-sm-3">Terkonfirmasi</dt>
									<dd class="col-sm-9">
										{{ $student['is_confirmed'] == true ? 'Ya' : 'Tidak' }}
									</dd>
									<dt class="col-sm-3">Terverifikasi</dt>
									<dd class="col-sm-9">
										{{ $student['registered'] == true ? 'Ya' : 'Tidak' }}
									</dd>
									<dt class="col-sm-3">Tanggal Pembuatan Akun</dt>
									<dd class="col-sm-9">
										{{ $student['created_at'] }}
									</dd>
								</dl>
							</div>
							<hr>
							<div class="col-12">
								<h3 class="fw-bold">Kursus</h3>

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
