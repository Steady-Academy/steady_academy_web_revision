@extends('admin.layouts.app')
@section('title', 'Data Kursus | Steady Academy')
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
		<h1 class="mb-3">Data Kursus</h1>
		<nav style="--bs-breadcrumb-divider: '/';" aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="#">Dashboard</a></li>
				<li class="breadcrumb-item active" aria-current="page">Kursus</li>
			</ol>
		</nav>
		<div class="content">
			{{-- <button type="button" class="btn btn-primary my-1" data-bs-toggle="modal" data-bs-target="#centeredModalPrimary">
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
			</div> --}}
			<div id="smartwizard-default-primary" class="wizard wizard-primary mb-4 sw sw-theme-default sw-justified">
				<ul class="nav">
					<li class="nav-item"><a class="nav-link inactive active" href="#default-primary-step-1">First Step<br><small>Step
								description</small></a></li>
					<li class="nav-item"><a class="nav-link inactive" href="#default-primary-step-2">Second Step<br><small>Step
								description</small></a></li>
					<li class="nav-item"><a class="nav-link inactive" href="#default-primary-step-3">Third Step<br><small>Step
								description</small></a></li>
					<li class="nav-item"><a class="nav-link inactive" href="#default-primary-step-4">Fourth Step<br><small>Step
								description</small></a></li>
				</ul>

				<div class="tab-content" style="height: 61px;">
					<div id="default-primary-step-1" class="tab-pane" role="tabpanel" style="display: block;">
						Step Content 1
					</div>
					<div id="default-primary-step-2" class="tab-pane" role="tabpanel" style="display: none;">
						Step Content 2
					</div>
					<div id="default-primary-step-3" class="tab-pane" role="tabpanel" style="display: none;">
						Step Content 3
					</div>
					<div id="default-primary-step-4" class="tab-pane" role="tabpanel" style="display: none;">
						Step Content 4
					</div>
				</div>
				<div class="toolbar toolbar-bottom" role="toolbar" style="text-align: right;"><button
						class="btn sw-btn-prev disabled" type="button">Previous</button><button class="btn sw-btn-next"
						type="button">Next</button></div>
			</div>
		</div>
	</div>
@endsection
@push('custom-script')
	<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>

	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush
