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
			@php
				$db = app('firebase.firestore')->database();
			@endphp
			@foreach ($data as $course)
            @if ($course != [])
				@php
					$category = $db->document($course->data()['Category_course']->path())->snapshot();
					$video = $db
					    ->collection('Courses')
					    ->document($course->data()['id'])
					    ->collection('Curriculum')
					    ->documents();
					$videos = count(collect($video));
					$instructur = $db->document($course->data()['instructur']->path())->snapshot()
				@endphp
				<div class="col-12 col-sm-3">
					<div class="card border border-1 shadow shadow-sm" style="border-radius: 25px">
						<img class="card-img-top" src="{{ $course->data()['thumbnail_url'] }}"
							style="border-radius: 25px 25px 0 0; max-height:180px; max-widht:355px" alt="thumbnail">
						<div class="card-body py-2">
							<a href="{{ route('admin.show.course', $course->data()['id']) }}" class="card-title fs-h5 mb-1 fw-bold text-truncate text-decoration-none stretched-link"
								style="max-width: 330px">{{ $course->data()['name'] }}</a>
							<h6 class="card-title mb-1 fw-light">{{ $category->data()['name'] }}</h6>
							@foreach ($course->data()['Category_tags'] as $tag)
									<span class="badge bg-primary bg-opacity-25 py-1 px-2 text-primary me-2"
										style="font-size: 12px">{{ $tag->snapshot()->data()['name'] }}</span>
							@endforeach
                            <div class="d-flex my-2 align-items-center">
                                <img src="{{ $instructur->data()['photoUrl'] }}" width="25" height="25" class="border border-1 border-dark rounded-circle" alt="">
                                <h6 class="mb-0 ms-2">{{ $instructur->data()['name'] }}</h6>
                            </div>
							<div class="d-flex my-2">
								<p class="mb-0">{{ $videos }} Video</p>
                                @if ($course->data()['Category_price_type'] == "paid")
                                <h4 class="ms-auto fw-bold text-danger mb-0">{{ "Rp." . $course->data()['price'] }}</h4>
                                @else
                                <h4 class="ms-auto fw-bold text-success mb-0">{{ $course->data()['Category_price_type'] }}</h4>
                                @endif
							</div>
						</div>
					</div>
				</div>
                @else
                <h6 class="text-center">Tidak ada data kursus.</h6>
                @endif
			@endforeach
			{{-- @endif --}}
		</div>
	</div>

@endsection
