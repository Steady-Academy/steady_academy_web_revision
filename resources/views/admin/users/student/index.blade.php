@extends('admin.layouts.app')
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
		@if (session('message'))
			<div class="alert alert-success alert-outline-coloured alert-dismissible " role="alert">
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				<div class="alert-icon">
					<i class="fas fa-check-circle fs-3"></i>
				</div>
				<div class="alert-message">
					<strong>Success</strong> {{ session('message') }}
				</div>
			</div>
		@elseif (session('error'))
			<div class="alert alert-danger alert-outline-coloured alert-dismissible " role="alert">
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				<div class="alert-icon">
					<i class="fas fa-exclamation-triangle fs-3"></i>
				</div>
				<div class="alert-message">
					<strong>Failed</strong> {{ session('error') }}
				</div>
			</div>
		@endif
		<div class="row position-relative">
			<div class="load">
				<div class="d-flex justify-content-center position-absolute top-50 start-50 translate-middle" style="z-index: 999;">
					<div class="spinner-border text-primary" role="status">
						<span class="visually-hidden">Loading...</span>
					</div>
				</div>
			</div>
			<div class="col-12">
				<div class="card">
					<div class="card-body">
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
													colspan="1" aria-label="Terakhir Login: activate to sort column ascending" style="width: 179px;">Terakhir
													Login
												</th>
												<th class="no-short" tabindex="0" aria-controls="datatables-column-search-text-inputs" rowspan="1"
													colspan="1" aria-label="Provider: activate to sort column ascending" style="width: 179px;">Provider</th>
												<th class="no-short" tabindex="0" aria-controls="datatables-column-search-text-inputs" rowspan="1"
													colspan="1" aria-label="Tanggal dibuat: activate to sort column ascending" style="width: 179px;">Tanggal
													dibuat
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
@endsection
@push('custom-script')
	<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
	<script src="https://c1e2-125-164-16-170.ap.ngrok.io/assets-admin/js/page/dataTableStudent.js"></script>

	<script>
		document.onreadystatechange = function() {
			if (document.readyState !== "complete") {
				document.querySelector(
					".card-body").style.visibility = "hidden";
				document.querySelector(
					".load").style.visibility = "visible";

			} else {
				document.querySelector(
					".load").style.display = "none";
				document.querySelector(
					".card-body").style.visibility = "visible";
			}
		};
	</script>

	{{-- <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}

	{{-- <script type="text/javascript">
		function confirmDelete(username) {
			var form = $('#data-' + username);
			const swalWithBootstrapButtons = Swal.mixin({
				customClass: {
					confirmButton: 'btn btn-danger mx-2',
					cancelButton: 'btn btn-dark mx-2'
				},
				buttonsStyling: false
			})

			swalWithBootstrapButtons.fire({
				title: 'Are you sure?',
				text: "You won't be able to revert this!",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonText: 'Yes, delete it!',
				cancelButtonText: 'No, cancel!',
				reverseButtons: true
			}).then((result) => {
				if (result.isConfirmed) {
					swalWithBootstrapButtons.fire(
						'Deleted!',
						'Your file has been deleted.',
						'success'
					)
					form.submit();
				} else if (
					/* Read more about handling dismissals below */
					result.dismiss === Swal.DismissReason.cancel
				) {
					swalWithBootstrapButtons.fire(
						'Cancelled',
						'The record are save',
						'error'
					)
				}
			})
		}
	</script> --}}
@endpush
