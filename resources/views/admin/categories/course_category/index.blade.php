@extends('admin.layouts.app')
@section('title', 'Data Kategori Kursus | Steady Academy')
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
		<h1 class="mb-3">Data Kategori Kursus</h1>
		<nav style="--bs-breadcrumb-divider: '/';" aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="#">Dashboard</a></li>
				<li class="breadcrumb-item active" aria-current="page">Kategori</li>
				<li class="breadcrumb-item active" aria-current="page">Kategori Kursus</li>
			</ol>
		</nav>
		<div class="row position-relative">
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
								<button class="btn btn-secondary mb-2"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
										viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
										stroke-linejoin="round" class="feather feather-rotate-cw align-middle me-2">
										<polyline points="23 4 23 10 17 10"></polyline>
										<path d="M20.49 15a9 9 0 1 1-2.12-9.36L23 10"></path>
									</svg> Reload </button>
								<a href="{{ route('admin.kursus_kategori.create') }}" class="btn btn-success mb-2"><svg
										xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
										stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
										class="feather feather-plus">
										<line x1="12" y1="5" x2="12" y2="19" />
										<line x1="5" y1="12" x2="19" y2="12" />
									</svg> Tambah Kategori </a>
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
														rowspan="1" colspan="1" aria-sort="ascending" aria-label="photo: activate to sort column descending"
														style="width: 179px;">Photo</th>
													<th class="sorting" tabindex="0" aria-controls="datatables-column-search-text-inputs" rowspan="1"
														colspan="1" aria-label="Nama: activate to sort column ascending" style="width: 179px;">Nama</th>
													<th class="no-short" tabindex="0" aria-controls="datatables-column-search-text-inputs" rowspan="1"
														colspan="1" aria-label="Deskripsi: activate to sort column ascending" style="width: 179px;">
														Deskripsi
													</th>
													<th class="short" tabindex="0" aria-controls="datatables-column-search-text-inputs" rowspan="1"
														colspan="1" aria-label="Tanggal dibuat: activate to sort column ascending" style="width: 179px;">
														Tanggal dibuat
													</th>
													<th class="short" tabindex="0" aria-controls="datatables-column-search-text-inputs" rowspan="1"
														colspan="1" aria-label="Tanggal diperbaharui: activate to sort column ascending"
														style="width: 179px;">
														Tanggal diperbaharui
													</th>
													<th class="no-short" tabindex="0" aria-controls="datatables-column-search-text-inputs" rowspan="1"
														colspan="1" aria-label="aksi: activate to sort column ascending" style="width: 179px;">Aksi</th>
												</tr>
											</thead>
											<tbody>

											</tbody>
											<tfoot>
												<tr>
													<th rowspan="1" colspan="1">
														<input type="text" class="form-control d-none" placeholder="Search Photo">
													</th>
													<th rowspan="1" colspan="1">
														<input type="text" class="form-control" placeholder="Search Nama">
													</th>
													<th rowspan="1" colspan="1">
														<input type="text" class="form-control" placeholder="Search Deskripsi">
													</th>
													<th rowspan="1" colspan="1">
														<input type="text" class="form-control" placeholder="Search Created At">
													</th>
													<th rowspan="1" colspan="1">
														<input type="text" class="form-control" placeholder="Search Updated At">
													</th>
													<th rowspan="1" colspan="1">
														<input type="text" class="form-control d-none" placeholder="Search Action">
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
	<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
	<script src="{{ env('URL_NGROK') }}/assets-admin/js/page/dataTableCourseCategory.js"></script>
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
@endpush
