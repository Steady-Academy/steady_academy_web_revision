@extends('instructur.layouts.app')
@section('title', 'Data Students | Steady Academy')
@push('custom-style')
	<style>
		div.dataTables_wrapper div.dataTables_processing {
			background-color: #fff !important;

		}

		.loading>#datatables-column-search-text-inputs_processing {
			width: 100%;
			position: relative;
		}

		div.dataTables_wrapper div.dataTables_processing .progress {
			background-color: #fff !important;
			width: 100%;
		}

		div.dataTables_wrapper div.dataTables_processing {
			left: 0;
			margin-left: 0px;
			margin-top: 0px;
			padding: 0px;
			position: absolute;
			text-align: center;
			top: 0;
			width: 200px;
		}
	</style>
@endpush
@section('content')
	<div class="container-fluid p-0">
		<h1 class="mb-3">Data Students</h1>
		<nav style="--bs-breadcrumb-divider: '/';" aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="#">Dashboard</a></li>
				<li class="breadcrumb-item active" aria-current="page">Users</li>
				<li class="breadcrumb-item active" aria-current="page">Students</li>
			</ol>
		</nav>
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-body">
						<div class="load my-5">
							<div class="d-flex justify-content-center" style="z-index: 999;">
								<div class="spinner-border text-primary fs-4" role="status" style="width: 3rem; height: 3rem;">
									<span class="visually-hidden">Loading...</span>
								</div>
							</div>
						</div>
						<div id="content" class="d-none">
							<div id="add" class="add align-items-center text-lg-start text-center my-2">
								<button class="btn btn-secondary mb-2"><i class="bi bi-arrow-repeat fs-4"></i> Reload </button>
								{{-- <a href="#" class="btn btn-success mb-2"><i class="fas fa-puzzle-piece me-2"></i>New Class Type
							</a> --}}
							</div>
							<div id="datatables-column-search-text-inputs_wrapper" class="dataTables_wrapper dt-bootstrap5">
								<div class="row ">
									<div class="col-sm-12">
										<table id="datatables-column-search-text-inputs" class="table table-striped dataTable" style="width: 100%;"
											aria-describedby="datatables-column-search-text-inputs_info">
											<div class="loading col-12 mt-2" style="height: 12px">

											</div>
											<thead>
												<tr>
													<th class="sorting sorting_asc" tabindex="0" aria-controls="datatables-column-search-text-inputs"
														rowspan="1" colspan="1" aria-sort="ascending" aria-label="Nama: activate to sort column descending"
														style="width: 179px;">Akun</th>
													<th class="sorting" tabindex="0" aria-controls="datatables-column-search-text-inputs" rowspan="1"
														colspan="1" aria-label="Telepon: activate to sort column ascending" style="width: 179px;">Telepon</th>
													<th class="no-short" tabindex="0" aria-controls="datatables-column-search-text-inputs" rowspan="1"
														colspan="1" aria-label="Terakhir Login: activate to sort column ascending" style="width: 179px;">
														Terakhir
														Login
													</th>
													<th class="no-short" tabindex="0" aria-controls="datatables-column-search-text-inputs" rowspan="1"
														colspan="1" aria-label="Provider: activate to sort column ascending" style="width: 179px;">Provider</th>
													<th class="no-short" tabindex="0" aria-controls="datatables-column-search-text-inputs" rowspan="1"
														colspan="1" aria-label="Tanggal dibuat: activate to sort column ascending" style="width: 179px;">Tanggal
														dibuat
													</th>
												</tr>
											</thead>
											<tbody>

											</tbody>
											<tfoot>
												<tr>
													<th rowspan="1" colspan="1">
														<input type="text" class="form-control" placeholder="Search Akun">
													</th>
													<th rowspan="1" colspan="1">
														<input type="text" class="form-control" placeholder="Search Telepon">
													</th>
													<th rowspan="1" colspan="1">
														<input type="text" class="form-control" placeholder="Search Terakhir Login">
													</th>
													<th rowspan="1" colspan="1">
														<input type="text" class="form-control" placeholder="Search Provider">
													</th>
													<th rowspan="1" colspan="1">
														<input type="text" class="form-control" placeholder="Search Tanggal dibuat">
													</th>
												</tr>
											</tfoot>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
@push('custom-script')
	<script>
		document.onreadystatechange = function() {
			if (document.readyState !== "complete") {
				document.querySelector("#content").classList.add('d-none');
				document.querySelector(
					".load").style.visibility = "visible";
			} else {
				document.querySelector(
					".load").style.display = "none";
				document.querySelector("#content").classList.remove('d-none');

			}
		};
	</script>
	<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
	<script src="{{ env('URL_NGROK') }}/assets-admin/js/page/dataTableStudentInstructur.js"></script>

	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

	<script type="text/javascript">
		function confirmDelete(username) {
			var form = $('#data-delete-' + username);
			const swalWithBootstrapButtons = Swal.mixin({
				customClass: {
					confirmButton: 'btn btn-danger mx-2',
					cancelButton: 'btn btn-dark mx-2'
				},
				buttonsStyling: false
			})

			swalWithBootstrapButtons.fire({
				title: 'kamu yakin?',
				text: "Jika anda menghapus anda tidak bisa mengembalikan data tersebut.",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonText: 'Yes, delete it!',
				cancelButtonText: 'No, cancel!',
				reverseButtons: true
			}).then((result) => {
				if (result.isConfirmed) {
					swalWithBootstrapButtons.fire(
						'Terhapus!',
						'Data berhasil dihapus.',
						'success'
					)
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
	</script>
	<script>
		function confirmDisable(username) {
			var form = $('#data-disable-' + username);
			const swalWithBootstrapButtons = Swal.mixin({
				customClass: {
					confirmButton: 'btn btn-danger mx-2',
					cancelButton: 'btn btn-dark mx-2'
				},
				buttonsStyling: false
			})

			swalWithBootstrapButtons.fire({
				title: 'Apakah anda yakin?',
				text: "Pengguna tidak akan bisa mengakses akunnya!",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonText: 'Ya, Bisukan!',
				cancelButtonText: 'Tidak, Batalkan!',
				reverseButtons: true
			}).then((result) => {
				if (result.isConfirmed) {
					swalWithBootstrapButtons.fire(
						'Dibisukan!',
						'Student berhasil dibisukan',
						'success'
					)
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
	</script>
	<script>
		function confirmEnable(username) {
			var form = $('#data-enable-' + username);
			const swalWithBootstrapButtons = Swal.mixin({
				customClass: {
					confirmButton: 'btn btn-danger mx-2',
					cancelButton: 'btn btn-dark mx-2'
				},
				buttonsStyling: false
			})

			swalWithBootstrapButtons.fire({
				title: 'Apakah anda yakin?',
				text: "Pengguna akan aktif kembali!",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonText: 'Ya, Aktifkan!',
				cancelButtonText: 'Tidak, Batalkan!',
				reverseButtons: true
			}).then((result) => {
				if (result.isConfirmed) {
					swalWithBootstrapButtons.fire(
						'Diaktifkan!',
						'Student berhasil diaktifkan',
						'success'
					)
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
	</script>
@endpush
