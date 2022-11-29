<!DOCTYPE html>
<html lang="en">

<head>
	<title>@yield('title')</title>

	<!-- Meta Tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="author" content="Dadang Jebred">
	<meta name="description" content="Belajar IT Di Bimbing Instruktur">

	<!-- Google Font -->
	<link rel="preconnect" href="https://fonts.googleapis.com/">
	<link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
	<link rel="icon" href="{{ env('URL_NGROK') }}/assets-user/images/favicon_io/favicon.ico">


	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&amp;display=swap" rel="stylesheet">
	<link rel="stylesheet" href="{{ env('URL_NGROK') }}/assets-user/vendor/bootstrap-icons/bootstrap-icons.css">

	<link class="js-stylesheet" rel="stylesheet" href="{{ env('URL_NGROK') }}/assets-admin/css/light.css">
	<link rel="stylesheet" href="{{ env('URL_NGROK') }}/assets-admin/css/custom.css">


	{{-- <link class="js-stylesheet" href="{{ asset('assets-admin/css/light.css') }}" rel="stylesheet">
	<link rel="stylesheet" href="{{ asset('assets-admin/css/custom.css') }}"> --}}
	<!-- END SETTINGS -->

	{{-- <link href="{{ asset('assets-admin/summernote/summernote.min.css') }}" rel="stylesheet"> --}}
	@livewireStyles
	@stack('custom-style')

</head>

<body data-theme="default" data-layout="fluid" data-sidebar-position="left" data-sidebar-behavior="sticky">
	<div class="wrapper">
		@include('admin.layouts.sidemenu')
		<div class="main">
			@include('admin.layouts.header')
			<main class="content">
				<div class="container-fluid p-0">
					@include('sweetalert::alert')
					@yield('content')
				</div>
			</main>
		</div>
	</div>


	{{-- <script src="{{ asset('assets-admin/summernote/summernote.min.js') }}"></script> --}}
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"
		integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
	@livewireScripts
	{{-- <script src="{{ asset('assets-admin/js/app.js') }}"></script> --}}
	<script src="{{ env('URL_NGROK') }}/assets-admin/js/app.js"></script>


	{{-- <script src="{{ asset('compiled/manifest.js') }}"></script>
	<script src="{{ asset('compiled/vendor.js') }}"></script> --}}

	{{-- <script src="{{ asset('compiled/app.js') }}" defer></script> --}}
	@stack('custom-script')

	{{-- <script>
	 $(document).ready(function() {
	  $('#summernote').summernote();
	 });
	</script> --}}

</body>

</html>
