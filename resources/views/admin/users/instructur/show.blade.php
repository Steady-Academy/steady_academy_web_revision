@extends('admin.layouts.app')
@section('title', 'Detail Instructur | Basicschool')
@section('content')
	<div class="container-fluid p-0">
		<h1 class="h3 mb-3">Detail Data Instructur</h1>
		<nav style="--bs-breadcrumb-divider: '/';" aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
				<li class="breadcrumb-item active" aria-current="page">Users</li>
				<li class="breadcrumb-item"><a href="{{ route('admin.instructur.index') }}">Instructur</a></li>
				<li class="breadcrumb-item active" aria-current="page">{{ $instructur['uid'] }}</li>
				<li class="breadcrumb-item active" aria-current="page">Detail</li>
			</ol>
		</nav>
		<div class="row justify-content-center">
			<div class="col-12">
				<div class="card">
					<div class="card-header">
						<h5 class="card-title">Detail Instructur</h5>
						{{-- <h6 class="card-subtitle text-muted"><b>catatan:</b> jangan sebarkan data pribadi pengguna.</h6> --}}
						<div class="bg-warning bg-opacity-25 border border-4 border-top-0 border-bottom-0 border-end-0 border-warning">
							<p class="p-2"><b>Catatan:</b> Jangan sebarkan data pribadi pengguna.</p>
						</div>
					</div>
					<div class="card-body">
						<div class="row justify-content-center">
							<div class="col-12 text-center">
								<img src="{{ $instructur['photoUrl'] }}" width="150" height="150"
									class="rounded-circle border border-2 border-dark mb-4" alt="{{ $instructur['name'] }}">
							</div>
							<hr>
							<div class="col-sm-4">
								<h3 class="fw-bold">Umum</h3>
								<dl class="row ">
									<dt class="col-sm-4">UID</dt>
									<dd class="col-sm-8">{{ $instructur['uid'] }}</dd>

									<dt class="col-sm-4">Nama</dt>
									<dd class="col-sm-8">{{ $instructur['name'] }}</dd>

									<dt class="col-sm-4">Email</dt>
									<dd class="col-sm-8">
										{{ $instructur['email'] }}
									</dd>

									<dt class="col-sm-4">Nomor Telepon</dt>
									<dd class="col-sm-8">{{ $instructur['phoneNumber'] }}</dd>

									<dt class="col-sm-4 text-truncate">Provider</dt>
									<dd class="col-sm-8">{{ $instructur['provider'] }}</dd>

									<dt class="col-sm-4">Terakhir Login</dt>
									<dd class="col-sm-8">
										{{ $instructur['login_at'] }}
									</dd>
									<dt class="col-sm-4">Terkonfirmasi</dt>
									<dd class="col-sm-8">
										{{ $instructur['is_confirmed'] == true ? 'Ya' : 'Tidak' }}
									</dd>
									<dt class="col-sm-4">Terverifikasi</dt>
									<dd class="col-sm-8">
										{{ $instructur['registered'] == true ? 'Ya' : 'Tidak' }}
									</dd>
									<dt class="col-sm-4">Tanggal Pembuatan</dt>
									<dd class="col-sm-8">
										{{ $instructur['created_at'] }}
									</dd>
								</dl>
							</div>
							<div class="col-sm-4">
								<h3 class="fw-bold">Informasi Instruktur</h3>
								<dl class="row ">
									<dt class="col-sm-4">Jenis Kelamin</dt>
									<dd class="col-sm-8">{{ $instructur['profile']['jenis_kelamin'] }}</dd>
									<dt class="col-sm-4">Kegiatan saat ini</dt>
									<dd class="col-sm-8">{{ $instructur['profile']['kegiatan'] }}</dd>
									<dt class="col-sm-4">Tanggal Lahir</dt>
									<dd class="col-sm-8">{{ $instructur['profile']['tanggal_lahir'] }}</dd>
									<dt class="col-sm-4">Provinsi</dt>
									<dd class="col-sm-8">{{ $instructur['profile']['alamat']['provinsi'] }}</dd>

									<dt class="col-sm-4">Kota</dt>
									<dd class="col-sm-8">{{ $instructur['profile']['alamat']['kota'] }}</dd>

									<dt class="col-sm-4">Kode pos</dt>
									<dd class="col-sm-8">
										{{ $instructur['profile']['alamat']['kode_pos'] }}
									</dd>
									<dt class="col-sm-4">Alasan Lengkap</dt>
									<dd class="col-sm-8">{{ $instructur['profile']['alamat']['detail'] }}</dd>
									</dd>
									<dt class="col-sm-4">Alasan menjadi instructur</dt>
									<dd class="col-sm-8">{{ $instructur['profile']['alasan'] }}</dd>
									</dd>

								</dl>
								<h3 class="fw-bold">Social Media</h3>
								<dl class="row ">
									<dt class="col-sm-4">Instagram</dt>
									<dd class="col-sm-8">
										{{ $instructur['profile']['instagram'] == '' ? 'Tidak ada' : $instructur['profile']['instagram'] }}</dd>
									<dt class="col-sm-4">Facebook</dt>
									<dd class="col-sm-8">
										{{ $instructur['profile']['facebook'] == '' ? 'Tidak ada' : $instructur['profile']['facebook'] }}</dd>
									<dt class="col-sm-4">Website</dt>
									<dd class="col-sm-8">
										{{ $instructur['profile']['website'] == '' ? 'Tidak ada' : $instructur['profile']['website'] }}</dd>
								</dl>
							</div>
							<div class="col-sm-4">
								<h3 class="fw-bold">Dokumen Riwayat Hidup</h3>
								<iframe src="{{ $instructur['profile']['dokumen_cv'] }}" align="center" height="450" width="80%"
									frameborder="0" scrolling="auto" class="mb-3"></iframe>
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
