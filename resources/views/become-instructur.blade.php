@extends('layouts.app')
@section('content')
	<section>
		<div class="container">
			<div class="row align-items-center">
				<div class="col">
					<img src="{{ asset('assets-user/images/instructur/instructur.svg') }}" width="550" alt="">
				</div>
				<div class="col-lg-6">
					<h1>
						Steady Instructur untuk pengajar
					</h1>
					<p class="h6">Platform belajar online untuk seluruh guru dan senior di dalam bidangnya di Indonesia.</p>
					<p class="h6 mb-3">Mengajar dari mana saja jadi mudah!</p>
					<a href="{{ route('register') }}" class="btn btn-primary fw-bold" type="button">Buat Akun</a>
				</div>
			</div>
		</div>
	</section>
	<section class="my-4 bg-primary bg-opacity-10">
		<h2 class="text-center mb-4">Kenapa Bergabung dengan Steady Instruktur ?</h2>
		<div class="container my-4">
			<div class="row justify-content-center my-4">
				<div class="col-sm-3">
					<div class="card shadow">
						<div class="card-body text-center">
							<img src="{{ asset('assets-user/images/instructur/easy.png') }}" class="my-2" width="80" alt="">
							<p class="h6">Mengajar dan memberi materi jadi praktis</p>
						</div>
					</div>
				</div>
				<div class="col-sm-3">
					<div class="card shadow">
						<div class="card-body text-center">
							<img src="{{ asset('assets-user/images/instructur/innovative.png') }}" class="my-2" width="80"
								alt="">
							<p class="h6">Bisa mengajar kapan pun dan di mana pun</p>
						</div>
					</div>
				</div>
				<div class="col-sm-3">
					<div class="card shadow">
						<div class="card-body text-center">
							<img src="{{ asset('assets-user/images/instructur/free.png') }}" class="my-2" width="80" alt="">
							<p class="h6">Bisa digunakan sepuasnya tanpa biaya</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<section>
		<div class="container">
			<div class="row justify-content-center align-items-center">
				<div class="col">
					<h3>Mengjar dari rumah jadi lebih mudah.</h3>
					<h3>Yuk, gabung Steady Instruktur!</h3>
					<a href="{{ route('register') }}" role="button" class="btn btn-primary fw-bold my-2">Buat Akun Sekarang!</a>
				</div>
				<div class="col">
					<img src="{{ asset('assets-user/images/instructur/teaching.svg') }}" width="450" alt="">
				</div>
			</div>
		</div>
	</section>
@endsection
