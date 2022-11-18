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
		<div class="content">
			<button type="button" class="btn btn-primary my-1" data-bs-toggle="modal" data-bs-target="#centeredModalPrimary">
				Primary
			</button>
			<div class="modal fade" id="centeredModalPrimary" tabindex="-1" style="display: none;" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Centered modal</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body m-3">
							<p class="mb-0">Use Bootstrap’s JavaScript modal plugin to add dialogs to your site for lightboxes, user
								notifications, or completely custom content.</p>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
							<button type="button" class="btn btn-primary">Save changes</button>
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

	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush
