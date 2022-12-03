@extends('admin.layouts.app')
@section('title', 'Data Kursus | Steady Academy')
@section('content')
	<div class="container-fluid p-0">
		<div class="d-flex align-items-center justify-content-between">
			<h1 class="mb-3">Data Kursus</h1>
			<a href="{{ route('admin.add.course') }}" class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg" width="24"
					height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
					stroke-linejoin="round" class="feather feather-plus">
					<line x1="12" y1="5" x2="12" y2="19" />
					<line x1="5" y1="12" x2="19" y2="12" />
				</svg> Tambah Kursus</a>
		</div>
		<nav style="--bs-breadcrumb-divider: '/';" aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="#">Dashboard</a></li>
				<li class="breadcrumb-item active" aria-current="page">Kursus</li>
			</ol>
		</nav>
		<div class="row align-items-center g-2">
			{{-- @if (!is_array($data))
				<h6 class="text-center">Tidak ada data kursus.</h6>
			@else --}}
			@php
<<<<<<< HEAD

=======
>>>>>>> main
				$db = app('firebase.firestore')->database();
			@endphp
			@foreach ($data as $course)
				@php
<<<<<<< HEAD
					$category = $db->document($course->data()['Category_course']->path())->snapshot();
					// $tags = $db->document($course->data()['Category_tags']->path())->snapshot();
				@endphp

				{{-- {!!  !!} --}}
=======
					// $id_instructur = $course->data()['instructur']->id();
					// $category = $db
					//     ->collection('Users')
					//     ->document($id_instructur)
					//     ->snapshot();
					// $id = $course->data()['instructur']->id();A

					// $tags = $course->data()['Category_tags'];
					// foreach ($tags as $tag) {
					//     dd($tag->id());
					// }

					$category = $db->document($course->data()['Category_course']->path())->snapshot();
					$video = $db
					    ->collection('Courses')
					    ->document($course->data()['id'])
					    ->collection('Curriculum')
					    ->documents();
					$videos = count(collect($video));

					// $tags = $db->document($course->data()['Category_tags']->path())->snapshot();
					// $instructur = $db->document($course->data()['instructur']->path())->snapshot();
					// dd($instructur);

				@endphp
				{{-- {!! $db->collection() !!} --}}
>>>>>>> main
				<div class="col-12 col-sm-3">
					<div class="card border border-1 shadow shadow-sm" style="border-radius: 25px">
						<img class="card-img-top" src="{{ $course->data()['thumbnail_url'] }}"
							style="border-radius: 25px 25px 0 0; max-height:180px; max-widht:355px" alt="thumbnail">
						<div class="card-body py-2">
							<a href="#" class="card-title fs-h5 mb-1 fw-bold text-truncate text-decoration-none stretched-link"
								style="max-width: 330px">{{ $course->data()['name'] }}</a>
							<h6 class="card-title mb-1 fw-light">{{ $category->data()['name'] }}</h6>
<<<<<<< HEAD
							{{-- @foreach ($tags as $tag) --}}
							<span class="badge bg-primary bg-opacity-25 py-1 px-2 text-primary me-2"
								style="font-size: 12px">{{ $tag }}</span>
							{{-- @endforeach --}}
							<div class="d-flex my-2">
								<p class="mb-0">10 Video</p>
								<h4 class="ms-auto fw-bold text-success mb-0">{{ $course->data()['price'] }}</h4>
=======
							{{-- @foreach ($tags as $tag)
									<span class="badge bg-primary bg-opacity-25 py-1 px-2 text-primary me-2"
										style="font-size: 12px">{{ $tag }}</span>
								@endforeach --}}
							<div class="d-flex my-2">
								<p class="mb-0">{{ $videos }} Video</p>
								<h4 class="ms-auto fw-bold text-success mb-0">{{ $course->data()['Category_price_type'] }}</h4>
>>>>>>> main
							</div>
						</div>
					</div>
				</div>
			@endforeach
			{{-- @endif --}}
		</div>
	</div>

@endsection
