@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-lg-12 mb-4 text-center">
				<h2 >Daftar Instruktur</h2>
			</div>
		</div>
		<!-- Search option START -->
                <div class="row mb-5 align-items-center justify-content-center">
                    <!-- Search bar -->
                    <div class="col-sm-6 col-xl-4">
                        <form class="border rounded p-2" method="GET" action="">
                            <div class="input-group input-borderless">
                                <input class="form-control me-1" name="instructor" type="search"
                                       value="{{-- {{ request('instructor') }} --}}" placeholder="Search instructor">
                                <button type="submit" class="btn btn-primary mb-0 rounded"><i class="fas fa-search"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Search option END -->
		<div class="row g-4 justify-content-center mb-5">
			{{-- Foreach disini --}}
			<div class="col-lg-10 col-xl-6">
                                    <div class="card shadow p-2">
                                        <div class="row g-0">
                                            <!-- Image -->
                                            <div class="col-md-4">
                                                <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png" class="rounded-3"
                                                     alt="...">
                                            </div>
                                            <!-- Card body -->
                                            <div class="col-md-8">
                                                <div class="card-body">
                                                    <!-- Title -->
                                                    <div class="d-sm-flex justify-content-sm-between mb-2 mb-sm-3">
                                                        <div>
                                                            <h5 class="card-title mb-0"><a
                                                                        href="#">Nama Instruktur</a>
                                                            </h5>
                                                            <p class="small mb-2 mb-sm-0">instruktur@/email.com</p>
                                                        </div>
                                                        <span class="h6 fw-light">4.3<i
                                                                    class="fas fa-star text-warning ms-1"></i></span>
                                                    </div>
                                                    <!-- Content -->
                                                    <p class="text-truncate-2 mb-3">{!!  Str::limit("Ini adalah about Instruktur", 99, '...')  !!} </p>
                                                    <!-- Info -->
                                                    <div class="d-sm-flex justify-content-sm-between align-items-center">
                                                        <!-- Title -->
                                                        <h6 class="text-orange mb-0">Course Instructor</h6>

                                                        <!-- Social button -->
                                                        {{-- <ul class="list-inline mb-0 mt-3 mt-sm-0">
                                                            <li class="list-inline-item {{ ($instructor->instructor_facebook != null) ? 'd-inline' : 'd-none' }}">
                                                                <a class="mb-0 me-1 text-facebook"
                                                                   href="{{ $instructor->instructor_facebook }}"><i
                                                                            class="fab fa-fw fa-facebook-f"></i></a>
                                                            </li>
                                                            <li class="list-inline-item {{ ($instructor->instructor_instagram != null) ? 'd-inline' : 'd-none' }}">
                                                                <a class="mb-0 me-1 text-instagram-gradient"
                                                                   href="{{ $instructor->instructor_instagram }}"><i
                                                                            class="fab fa-fw fa-instagram"></i></a>
                                                            </li>
                                                            <li class="list-inline-item {{ ($instructor->instructor_twitter != null) ? 'd-inline' : 'd-none' }}">
                                                                <a class="mb-0 me-1 text-twitter"
                                                                   href="{{ $instructor->instructor_twitter }}"><i
                                                                            class="fab fa-fw fa-twitter"></i></a>
                                                            </li>
                                                            <li class="list-inline-item {{ ($instructor->instructor_linkedin != null) ? 'd-inline' : 'd-none' }}">
                                                                <a class="mb-0 text-linkedin"
                                                                   href="{{ $instructor->instructor_linkedin }}"><i
                                                                            class="fab fa-fw fa-linkedin-in"></i></a>
                                                            </li>
                                                            <li class="list-inline-item {{ ($instructor->instructor_youtube != null) ? 'd-inline' : 'd-none' }}">
                                                                <a class="mb-0 text-youtube"
                                                                   href="{{ $instructor->instructor_youtube }}"><i
                                                                            class="fab fa-fw fa-youtube"></i></a>
                                                            </li>
                                                        </ul> --}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
			</div>
			<div class="col-lg-10 col-xl-6">
                                    <div class="card shadow p-2">
                                        <div class="row g-0">
                                            <!-- Image -->
                                            <div class="col-md-4">
                                                <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png" class="rounded-3"
                                                     alt="...">
                                            </div>
                                            <!-- Card body -->
                                            <div class="col-md-8">
                                                <div class="card-body">
                                                    <!-- Title -->
                                                    <div class="d-sm-flex justify-content-sm-between mb-2 mb-sm-3">
                                                        <div>
                                                            <h5 class="card-title mb-0"><a
                                                                        href="#">Nama Instruktur</a>
                                                            </h5>
                                                            <p class="small mb-2 mb-sm-0">instruktur@/email.com</p>
                                                        </div>
                                                        <span class="h6 fw-light">4.3<i
                                                                    class="fas fa-star text-warning ms-1"></i></span>
                                                    </div>
                                                    <!-- Content -->
                                                    <p class="text-truncate-2 mb-3">{!!  Str::limit("Ini adalah about Instruktur", 99, '...')  !!} </p>
                                                    <!-- Info -->
                                                    <div class="d-sm-flex justify-content-sm-between align-items-center">
                                                        <!-- Title -->
                                                        <h6 class="text-orange mb-0">Course Instructor</h6>

                                                        <!-- Social button -->
                                                        {{-- <ul class="list-inline mb-0 mt-3 mt-sm-0">
                                                            <li class="list-inline-item {{ ($instructor->instructor_facebook != null) ? 'd-inline' : 'd-none' }}">
                                                                <a class="mb-0 me-1 text-facebook"
                                                                   href="{{ $instructor->instructor_facebook }}"><i
                                                                            class="fab fa-fw fa-facebook-f"></i></a>
                                                            </li>
                                                            <li class="list-inline-item {{ ($instructor->instructor_instagram != null) ? 'd-inline' : 'd-none' }}">
                                                                <a class="mb-0 me-1 text-instagram-gradient"
                                                                   href="{{ $instructor->instructor_instagram }}"><i
                                                                            class="fab fa-fw fa-instagram"></i></a>
                                                            </li>
                                                            <li class="list-inline-item {{ ($instructor->instructor_twitter != null) ? 'd-inline' : 'd-none' }}">
                                                                <a class="mb-0 me-1 text-twitter"
                                                                   href="{{ $instructor->instructor_twitter }}"><i
                                                                            class="fab fa-fw fa-twitter"></i></a>
                                                            </li>
                                                            <li class="list-inline-item {{ ($instructor->instructor_linkedin != null) ? 'd-inline' : 'd-none' }}">
                                                                <a class="mb-0 text-linkedin"
                                                                   href="{{ $instructor->instructor_linkedin }}"><i
                                                                            class="fab fa-fw fa-linkedin-in"></i></a>
                                                            </li>
                                                            <li class="list-inline-item {{ ($instructor->instructor_youtube != null) ? 'd-inline' : 'd-none' }}">
                                                                <a class="mb-0 text-youtube"
                                                                   href="{{ $instructor->instructor_youtube }}"><i
                                                                            class="fab fa-fw fa-youtube"></i></a>
                                                            </li>
                                                        </ul> --}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
			</div>
			{{-- akhir foreach --}}
		</div>

		<div class="row align-items-center g-5">
			<div class="p-4 p-sm-5 rounded-3" style="background-color: #303F9F">
                    <div class="row justify-content-center position-relative">
                        <!-- Svg -->
                        
                        <!-- Action box -->
                        <div class="col-11 position-relative">
                            <div class="row align-items-center">
                                <!-- Title -->
                                <div class="col-lg-7">
                                    <h3 class="text-white">Bergabung Menjadi Instruktur!</h3>
                                    <p class="text-white mb-3 mb-lg-0">Berbagi ilmu dan menebar manfaat dengan bergabung
                                        menjadi Instruktur di Basicschool</p>
                                </div>
                                <!-- Button -->
                                <div class="col-lg-5 text-lg-end">
                                    <a href="{{ route("register") }}" class="btn btn-white mb-0">Daftar Menjadi
                                        Instruktur</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
		</div>
	</div>
@endsection