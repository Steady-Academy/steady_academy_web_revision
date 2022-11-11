@extends('admin.layouts.app')
@section('title', 'Tambah Kategori | Steady Academy')
@section('content')
	<div class="container-fluid p-0">
		<h1 class="h3 mb-3">Tambah Kategori Kursus</h1>
		<nav style="--bs-breadcrumb-divider: '/';" aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
				<li class="breadcrumb-item active" aria-current="page">Kategori</li>
				<li class="breadcrumb-item"><a href="{{ route('admin.kursus_kategori.index') }}">Kategori Kursus</a></li>
				<li class="breadcrumb-item active" aria-current="page">Tambah</li>
			</ol>
		</nav>
		<div class="row justify-content-center">
			<div class="col-7">
				<div class="card">
					<div class="card-header">
						<h5 class="card-title">Tambah Kategori Kursus</h5>
						<div class="bg-warning bg-opacity-25 border border-4 border-top-0 border-bottom-0 border-end-0 border-warning">
							<p class="p-2"><b>Catatan:</b> Jangan tambahkan data yang sudah tersedia.</p>
						</div>
					</div>
					<div class="card-body">
						<form class="form" runat="server" action="{{ route('admin.kursus_kategori.store') }}" method="POST"
							enctype="multipart/form-data" id="create">
							@csrf
							<div class="row justify-content-center">
								<div class="col-10">
									<div class="mb-3 text-center">
										<img src="" alt="" class="rounded-3 border border-2 border-dark bg-secondary" width="100"
											height="100" id="photo">
										<input type="file" accept="image/png, image/jpg, image/jpeg, image/svg"
											class="form-control my-2 @error('photo') is-invalid @enderror" id="photo_input" name="photo">
										<label for="photo" class="form-label mx-auto">Photo</label>
										@error('photo')
											<div class="invalid-feedback">
												{{ $message }}
											</div>
										@enderror
									</div>
									<div class="mb-3">
										<label for="formGroupExampleInput" class="form-label">Nama Kategori</label>
										<input type="text" class="form-control @error('nama_kategori') is-invalid @enderror"
											id="formGroupExampleInput" name="nama_kategori" value="{{ old('nama_kategori') }}"
											placeholder="Masukan Nama Kategori" required>
										@error('nama_kategori')
											<div class="invalid-feedback">
												{{ $message }}
											</div>
										@enderror
									</div>


									<div class="mb-3">
										<label for="deskripsi_kategori" class="form-label">Deskripsi Kategori</label>
										<textarea name="deskripsi_kategori" id="deskripsi_kategori" cols="10" rows="5" class="form-control"
										 placeholder="Masukan Deskripsi Kategori" required>{{ old('deskripsi_kategori') }}</textarea>
										@error('deskripsi_kategori')
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
								<button type="submit" class="btn btn-primary fs-5" onclick="confirmCreate()">Submit</button>
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
		function confirmCreate() {
			var form = $('#create');
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
		photo_input.onchange = evt => {
			const [file] = photo_input.files
			if (file) {
				photo.src = URL.createObjectURL(file)
			}
		}
	</script>
@endpush
