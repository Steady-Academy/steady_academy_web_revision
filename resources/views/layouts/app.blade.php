<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Steady Academy</title>

	{{-- style for ngrok --}}

	<link rel="stylesheet" href="{{ env('URL_NGROK') }}/assets-user/vendor/font-awesome/css/all.min.css">
	<link rel="stylesheet" href="{{ env('URL_NGROK') }}/assets-user/vendor/bootstrap-icons/bootstrap-icons.css">
	<link rel="icon" href="{{ env('URL_NGROK') }}/assets-user/images/favicon_io/favicon.ico">


	{{-- Default style --}}
	{{-- <link rel="stylesheet" type="text/css" href="{{ asset('assets-user/vendor/font-awesome/css/all.min.css') }}">
	<link id="style-switch" rel="stylesheet" type="text/css" href="{{ asset('assets-user/css/style.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets-user/vendor/bootstrap-icons/bootstrap-icons.css') }}">
	<link rel="stylesheet" href="{{ asset('assets-user/css/custom.css') }}"> --}}

	@stack('custom-styles')
	@livewireStyles
	<link rel="stylesheet" href="{{ env('URL_NGROK') }}/assets-user/css/style.css">
	<link rel="stylesheet" href="{{ env('URL_NGROK') }}/assets-user/css/custom.css">


</head>

<body>

	@include('layouts.header')
	<main class="overflow-hidden">
		@yield('content')
	</main>
	@include('layouts.footer')


	<script src="https://code.jquery.com/jquery-3.6.0.min.js"
		integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

	<script src="{{ env('URL_NGROK') }}/assets-user/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
	@livewireScripts
	@stack('custom-scripts')
	<script src="{{ env('URL_NGROK') }}/assets-user/js/functions.js"></script>
	{{-- <script>
		var hashVal = window.location.hash.split("#")[1];
		if ($('#' + hashVal).hasClass('jobs')) $('#' + hashVal).addClass('active');
	</script> --}}
	{{-- Default script --}}
	{{-- <script src="{{ asset('assets-user/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
	<script src="{{ asset('assets-user/js/functions.js') }}"></script> --}}
	{{-- <script src="https://kit.fontawesome.com/1fdacd4af1.js" crossorigin="anonymous"></script> --}}

</body>

</html>
