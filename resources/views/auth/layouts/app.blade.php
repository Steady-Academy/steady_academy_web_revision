<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>@yield('title')</title>
	<link rel="stylesheet" href="https://3f6b-103-158-96-68.ap.ngrok.io/assets-user/css/style.css">
	<link rel="stylesheet" href="https://3f6b-103-158-96-68.ap.ngrok.io/assets-user/vendor/font-awesome/css/all.min.css">
	<link rel="stylesheet"
		href="https://3f6b-103-158-96-68.ap.ngrok.io/assets-user/vendor/bootstrap-icons/bootstrap-icons.css">
	<link rel="stylesheet" href="https://3f6b-103-158-96-68.ap.ngrok.io/assets-user/css/custom.css">
	{{-- <link rel="stylesheet" type="text/css" href="{{ asset('assets-user/vendor/font-awesome/css/all.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets-user/css/style.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets-user/vendor/bootstrap-icons/bootstrap-icons.css') }}">
	<link rel="stylesheet" href="{{ asset('assets-user/css/custom.css') }}"> --}}
	@stack('custom-style')
</head>

<body>

	<div class="preloader bg-dark bg-opacity-25">
		<div class="preloader-item">
			<div class="spinner-border text-primary"></div>
		</div>
	</div>
	@include('auth.layouts.header')
	<main>
		<!-- Pre loader -->
		@yield('content')
	</main>
	@include('auth.layouts.footer')


	<script src="https://code.jquery.com/jquery-3.6.0.min.js"
		integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

	<script src="https://3f6b-103-158-96-68.ap.ngrok.io/assets-user/vendor/bootstrap/dist/js/bootstrap.bundle.min.js">
	</script>
	<script src="https://3f6b-103-158-96-68.ap.ngrok.io/assets-user/js/functions.js"></script>
	{{-- <script src="{{ asset('assets-user/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
	<script src="{{ asset('assets-user/js/functions.js') }}"></script> --}}


	@stack('custom-script')

</body>

</html>
