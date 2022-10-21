<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Steady Academy</title>

	{{-- style for ngrok --}}
	<link rel="stylesheet" href="https://dbf7-103-158-96-68.ap.ngrok.io/assets-user/css/style.css">
	<link rel="stylesheet" href="https://dbf7-103-158-96-68.ap.ngrok.io/assets-user/vendor/font-awesome/css/all.min.css">
	<link rel="stylesheet"
		href="https://dbf7-103-158-96-68.ap.ngrok.io/assets-user/vendor/bootstrap-icons/bootstrap-icons.css">
	<link rel="stylesheet" href="https://dbf7-103-158-96-68.ap.ngrok.io/assets-user/css/custom.css">

	{{-- Default style --}}
	{{-- <link rel="stylesheet" type="text/css" href="{{ asset('assets-user/vendor/font-awesome/css/all.min.css') }}">
	<link id="style-switch" rel="stylesheet" type="text/css" href="{{ asset('assets-user/css/style.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets-user/vendor/bootstrap-icons/bootstrap-icons.css') }}">
	<link rel="stylesheet" href="{{ asset('assets-user/css/custom.css') }}"> --}}

	@stack('custom-styles')

</head>

<body>

	@include('layouts.header')
	<main class="overflow-hidden">
		@yield('content')
	</main>
	@include('layouts.footer')


	@stack('custom-scripts')

	<script src="https://code.jquery.com/jquery-3.6.0.min.js"
		integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

	<script src="https://dbf7-103-158-96-68.ap.ngrok.io/assets-user/vendor/bootstrap/dist/js/bootstrap.bundle.min.js">
	</script>
	<script src="https://dbf7-103-158-96-68.ap.ngrok.io/assets-user/js/functions.js"></script>

	{{-- Default script --}}
	{{-- <script src="{{ asset('assets-user/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
	<script src="{{ asset('assets-user/js/functions.js') }}"></script> --}}
	{{-- <script src="https://kit.fontawesome.com/1fdacd4af1.js" crossorigin="anonymous"></script> --}}

</body>

</html>
