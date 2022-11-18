@extends('layouts.app')
@section('content')
	<section>
		<div class="container">
			<div class="row">
				<div class="col-lg">
					@yield('help.tabs')
				</div>
				<div class="col-lg-9">
					@yield('help.content')
				</div>
			</div>
		</div>
	</section>
@endsection
