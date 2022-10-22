@extends('layouts.app')
@push('custom-styles')
	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

	<style>
		.select2.select2-container {
			width: 100% !important;
		}

		.select2.select2-container .select2-selection {
			border: 1px solid #dde0e3;
			-webkit-border-radius: 3px;
			-moz-border-radius: 3px;
			border-radius: 3px;
			height: 40px;
			margin-bottom: 15px;
			outline: none !important;
			transition: all .15s ease-in-out;
		}

		.select2.select2-container .select2-selection .select2-selection__rendered {
			color: #333;
			line-height: 40px;
			padding-right: 33px;
		}

		.select2.select2-container .select2-selection .select2-selection__arrow {
			opacity: 1;
			background: rgba(245, 247, 249, 65) !important;
			border-left: 1px solid #dde0e3;
			-webkit-border-radius: 0 3px 3px 0;
			-moz-border-radius: 0 3px 3px 0;
			border-radius: 0 3px 3px 0;
			height: 38px;
			width: 33px;
		}


		/*
																						.select2-container--default .select2-dropdown {
																																border-color: #fff !important;
																												box-shadow: 0 3px 8px rgba(0, 0, 0, 0.25);
																												}
																												*/
		.select2.select2-container.select2-container--open .select2-selection.select2-selection--single {
			background: #f8f8f8;
			border: 1px solid #303F9F;
		}

		.select2 .select2-container .select2-container--default .select2-container--above .select2-container--open {
			border: 1px solid #303F9F;
		}

		.select2.select2-container.select2-container--open .select2-selection.select2-selection--single .select2-selection__arrow {
			-webkit-border-radius: 0 3px 0 0;
			-moz-border-radius: 0 3px 0 0;
			border-radius: 0 3px 0 0;
		}

		.select2.select2-container.select2-container--open .select2-selection.select2-selection--multiple {
			border: 1px solid #34495e;
		}

		.select2.select2-container .select2-selection--multiple {
			height: auto;
			min-height: 34px;
		}

		.select2.select2-container .select2-selection--multiple .select2-search--inline .select2-search__field {
			margin-top: 0;
			height: 32px;
		}

		.select2.select2-container .select2-selection--multiple .select2-selection__rendered {
			display: block;
			padding: 0 4px;
			line-height: 29px;
		}

		.select2.select2-container .select2-selection--multiple .select2-selection__choice {
			background-color: #f8f8f8;
			border: 1px solid #ccc;
			-webkit-border-radius: 3px;
			-moz-border-radius: 3px;
			border-radius: 3px;
			margin: 4px 4px 0 0;
			padding: 0 6px 0 22px;
			height: 24px;
			line-height: 24px;
			font-size: 12px;
			position: relative;
		}

		.select2.select2-container .select2-selection--multiple .select2-selection__choice .select2-selection__choice__remove {
			position: absolute;
			top: 0;
			left: 0;
			height: 22px;
			width: 22px;
			margin: 0;
			text-align: center;
			color: #e74c3c;
			font-weight: bold;
			font-size: 16px;
		}

		.select2-container .select2-dropdown {
			background: transparent;
			border: none;
			margin-top: -5px;
		}

		.select2-container .select2-dropdown .select2-search {
			padding: 0;
		}

		.select2-container .select2-dropdown .select2-search input {
			outline: none !important;
			border: 1px solid #5C6BC0 !important;
			border-radius: 5px 5px 0px 0px;
			border-bottom: none !important;
			padding: 4px 6px !important;
		}

		.select2-container .select2-dropdown .select2-results {
			padding: 0;
		}

		.select2-container .select2-dropdown .select2-results ul {
			background: #fff;
			border: 1px solid #5C6BC0;
			border-radius: 0px 0px 5px 5px;
		}

		.select2-container .select2-dropdown .select2-results ul .select2-results__option--highlighted[aria-selected] {
			background-color: #5C6BC0;
		}

		.steper .line {
			flex: 1 0 20px;
			min-width: 1px;
			min-height: 1px;
			margin: auto;
			background-color: rgba(0, 0, 0, .12);
		}
	</style>
	@livewireStyles
@endpush

@section('content')
	@livewire('form-instructur')
@endsection

@push('custom-scripts')
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

	<script>
		$(".select2").select2({
			placeholder: "Silahkan pilih",

		}).on('select2:opening', function() {
			$(this).data('select2').$dropdown.find(':input.select2-search__field').attr('placeholder', 'Cari Kota');
		}).val('');


		function formatSearchResult(result) {
			if (!result.id) {
				return result.text;
			}

			var query = $('.select2-search__field').val();
			var str = result.text;

			var regex = new RegExp(query, 'i');
			var indexQuery = (str.toLowerCase()).indexOf(query.toLowerCase());

			var highlightText = str.substring(indexQuery, indexQuery + query.length);
			var newStr = str.replace(regex, '<span style="font-weight:bold">' + highlightText + '</span>')

			return $('<span>' + newStr + '</span>');
		}
	</script>
	@stack('script')
	@livewireScripts
@endpush
