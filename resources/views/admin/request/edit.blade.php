@extends('admin.layouts.app')
@section('title', 'Edit Data Permintaan Instructur | Basicschool')
@section('content')
	<div class="container-fluid p-0">
		<h1 class="h3 mb-3">Edit Data Permintaan Instructur</h1>
		<nav style="--bs-breadcrumb-divider: '/';" aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
				<li class="breadcrumb-item"><a href="{{ route('admin.request.index') }}">Permintaan</a></li>
				<li class="breadcrumb-item active" aria-current="page">{{ $req_instructur['uid'] }}</li>
				<li class="breadcrumb-item active" aria-current="page">Edit</li>
			</ol>
		</nav>
		<div class="row justify-content-center">
			<div class="col-10">
				<div class="card">
					<div class="card-header">
						<h5 class="card-title">Edit Permintaan Instructur</h5>
						<h6 class="card-subtitle text-muted">Hati-hati data akan berubah tampa sepengetahuan pengguna.</h6>
					</div>
					<div class="card-body">
						<form id="edit" class="form" runat="server"
							action="{{ route('admin.request.update', $req_instructur['uid']) }}" method="POST" enctype="multipart/form-data">
							<input type="hidden" name="_method" value="PUT">
							<input type="hidden" name="uid" value="{{ $req_instructur['uid'] }}">
							<input type="hidden" name="oldPicture" value="{{ $req_instructur['photoUrl'] }}">
							@csrf
							@method('PUT')
							<div class="hstack justify-content-center">
								<div class="mb-3 text-center">
									<img src="{{ $req_instructur['photoUrl'] }}" alt="{{ $req_instructur['name'] }}"
										class="rounded-circle border border-2 border-dark bg-secondary" width="100" height="100" id="profile">
									<input type="file" accept="image/png, image/jpg, image/jpeg, image/svg"
										class="form-control my-2 @error('foto') is-invalid @enderror" id="profile_input" name="foto">
									<label for="profile" class="form-label mx-auto">Poto Profile</label>
									@error('foto')
										<div class="invalid-feedback">
											{{ $message }}
										</div>
									@enderror
								</div>
							</div>
							<div class="row">
								<div class="col-12 col-sm-6 col-xxl-6">
									<div class="mb-3">
										<label for="formGroupExampleInput" class="form-label">Nama</label>
										<input type="text" class="form-control @error('nama') is-invalid @enderror" id="formGroupExampleInput"
											name="nama" value="{{ $req_instructur['name'] }}" placeholder="Input instructur nama" required>
										@error('nama')
											<div class="invalid-feedback">
												{{ $message }}
											</div>
										@enderror
									</div>
								</div>
								<div class="col-12 col-sm-6 col-xxl-6">
									<div class="mb-3">
										<label for="formGroupExampleInput" class="form-label">Telepon</label>
										<input type="tel" class="form-control @error('telepon') is-invalid @enderror" id="formGroupExampleInput"
											value="{{ $req_instructur['phoneNumber'] }}" name="telepon" placeholder="+62" required>
										@error('telepon')
											<div class="invalid-feedback">
												{{ $message }}
											</div>
										@enderror
									</div>
								</div>
							</div>

							<div class="mb-3">
								<label for="formGroupExampleInput" class="form-label">Email</label>
								<input type="email" class="form-control @error('email') is-invalid @enderror" id="formGroupExampleInput"
									name="email" value="{{ $req_instructur['email'] }}" placeholder="Input instructur email" required>
								@error('email')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
								@enderror
							</div>

							<div class="row">
								<div class="col-12 col-sm-6 col-xx-6">
									<div class="mb-3">
										<label for="password" class="form-label">Password baru</label>
										<input type="password" class="form-control @error('password_baru') is-invalid @enderror" id="password"
											name="password_baru" placeholder="Input instructur password" required>
										@error('password')
											<div class="invalid-feedback">
												{{ $message }}
											</div>
										@enderror
									</div>
								</div>

								<div class="col-12 col-sm-6 col-xx-6">
									<div class="mb-3">
										<label for="password_confirmation" class="form-label">Konfirmasi Password</label>
										<input type="password_confirmation"
											class="form-control @error('password_confirmation_baru') is-invalid @enderror" id="password_confirmation"
											name="password_confirmation_baru" placeholder="Input konfirmasi password" required>
										@error('password_confirmation')
											<div class="invalid-feedback">
												{{ $message }}
											</div>
										@enderror
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-12 col-sm-6 col-xxl-6">
									<div class="mb-3">
										<label for="konfirmasi" class="form-label">Terkonfirmasi</label>
										<select class="form-control @error('konfirmasi') is-invalid @enderror" id="konfirmasi" name="konfirmasi">
											<option value="">Pilih </option>
											<option value="true" {{ $req_instructur['is_confirmed'] == true ? 'selected' : 'is_invalid' }}>true
											</option>
											<option value="false" {{ $req_instructur['is_confirmed'] == false ? 'selected' : 'is_invalid' }}>false
											</option>
										</select>
										@error('konfirmasi')
											<div class="invalid-feedback">
												{{ $message }}
											</div>
										@enderror
									</div>
								</div>
								<div class="col-12 col-sm-6 col-xxl-6">
									<div class="mb-3">
										<label for="terdaftar" class="form-label">Terdaftar</label>
										<select class="form-control @error('terdaftar') is-invalid @enderror" id="terdaftar" name="terdaftar">
											<option value="">Pilih</option>
											<option value="true" {{ $req_instructur['registered'] == true ? 'selected' : 'is_invalid' }}>true</option>
											<option value="false" {{ $req_instructur['registered'] == false ? 'selected' : 'is_invalid' }}>false
											</option>
										</select>
										@error('terdaftar')
											<div class="invalid-feedback">
												{{ $message }}
											</div>
										@enderror
									</div>
								</div>
							</div>
							<hr>
							<div class="col-12 text-end">
								<button type="reset" class="btn btn-danger fs-5">Reset</button>
								<button type="submit" class="btn btn-primary fs-5" onclick="confirmEdit()">Edit</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
@push('custom-script')
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script>
		function confirmEdit() {
			var form = $('#edit');
			const swalWithBootstrapButtons = Swal.mixin({
				customClass: {
					confirmButton: 'btn btn-primary mx-2',
					cancelButton: 'btn btn-dark mx-2'
				},
				buttonsStyling: false
			});
			event.preventDefault();
			swalWithBootstrapButtons.fire({
				title: 'Apakah anda yakin akan mengubah data?',
				text: "Jika kamu mengubah data, instructur akan mengetahui.",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonText: 'Ye, Ubah',
				cancelButtonText: 'Tidak, Batalkan',
				reverseButtons: true
			}).then((result) => {
				if (result.isConfirmed) {
					form.submit();
				} else if (
					/* Read more about handling dismissals below */
					result.dismiss === Swal.DismissReason.cancel
				) {
					swalWithBootstrapButtons.fire(
						'Dibatalkan',
						'Data tetap tersimpan',
						'error'
					)
				}
			})
		}

		profile_input.onchange = evt => {
			const [file] = profile_input.files
			if (file) {
				profile.src = URL.createObjectURL(file)
			}
		}
	</script>
@endpush
