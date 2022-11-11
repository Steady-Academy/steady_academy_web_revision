@extends('admin.layouts.app')
@section('title', 'Edit Tipe Level | Steady Academy')
@section('content')

	<div class="container-fluid p-0">
		<h1 class="h3 mb-3">Edit Tipe Level</h1>
		<nav style="--bs-breadcrumb-divider: '/';" aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
				<li class="breadcrumb-item active" aria-current="page">Kategori</li>
				<li class="breadcrumb-item"><a href="{{ route('admin.tipe_level.index') }}">Tipe Level</a></li>
				<li class="breadcrumb-item active" aria-current="page">Edit</li>
			</ol>
		</nav>
		<div class="row justify-content-center">
			<div class="col-7">
				<div class="card">
					<div class="card-header">
						<h5 class="card-title">Edit Tipe Harga</h5>
						<div class="bg-warning bg-opacity-25 border border-4 border-top-0 border-bottom-0 border-end-0 border-warning">
							<p class="p-2"><b>Catatan:</b> Jangan menimpa data yang sudah tersedia.</p>
						</div>
					</div>
					<div class="card-body">
						<form class="form" runat="server" action="{{ route('admin.tipe_level.update', $level_type['id']) }}"
							method="POST" enctype="multipart/form-data" id="update">
							<input type="hidden" name="_method" value="PUT">
							<input type="hidden" name="uid" value="{{ $level_type['id'] }}">
							@csrf
							@method('PUT')
							<div class="row justify-content-center">
								<div class="col-10">
									<div class="mb-3">
										<label for="formGroupExampleInput" class="form-label">Nama Tipe Level</label>
										<input type="text" class="form-control @error('nama_tipe_level') is-invalid @enderror"
											id="formGroupExampleInput" name="nama_tipe_level" value="{{ $level_type['name'] }}"
											placeholder="Masukan Nama Tipe Level" required>
										@error('nama_tipe_level')
											<div class="invalid-feedback">
												{{ $message }}
											</div>
										@enderror
									</div>

									<div class="mb-3">
										<label for="deskripsi_tipe_level" class="form-label">Deskripsi Tipe Level</label>
										<textarea name="deskripsi_tipe_level" id="deskripsi_tipe_level" cols="10" rows="5" class="form-control"
										 placeholder="Masukan Deskripsi Tipe Level" required>{{ $level_type['description'] }}</textarea>
										@error('deskripsi_tipe_level')
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
								<button type="submit" class="btn btn-primary fs-5" onclick="confirmUpdate()">Submit</button>
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
		function confirmUpdate() {
			var form = $('#update');
			const swalWithBootstrapButtons = Swal.mixin({
				customClass: {
					confirmButton: 'btn btn-primary mx-2',
					cancelButton: 'btn btn-dark mx-2'
				},
				buttonsStyling: false
			});
			event.preventDefault();
			swalWithBootstrapButtons.fire({
				title: 'Apakah anda yakin akan menambahkan data ini?',
				text: "Data yang ditambahkan akan langsung tampil di end user",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonText: 'Ya, Tambahkan',
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
						'Data batal ditambahkan',
						'error'
					)
				}
			})
		}
	</script>
@endpush
