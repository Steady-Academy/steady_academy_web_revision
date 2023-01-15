@extends('instructur.layouts.app')
@section('title', 'Detail Kursus | Steady Academy')
@section('content')
<div class="container-fluid p-0">
    <div class="d-flex align-items-center justify-content-between">
        <h1 class="mb-3">Detail Kursus</h1>
    </div>
    <nav style="--bs-breadcrumb-divider: '/';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('instructur.index.course') }}">Kursus</a></li>
            <li class="breadcrumb-item active" aria-current="page">Detail</li>
            <li class="breadcrumb-item active" aria-current="page">12312312</li>
        </ol>
    </nav>
    <div class="row align-items-center g-2">
        <div class="card">
            <div class="card-header">
                Detail
            </div>
            {{-- @dd($course) --}}
            <div class="card-body">
                <div id="default-primary-step-4" class="tab-pane" role="tabpanel" style="display: block;">
                    @php
                    $db = app('firebase.firestore')->database();
                            $category = $db->document($course->data()['Category_course']->path())->snapshot();
                            $video = $db
                                ->collection('Courses')
                                ->document($course->data()['id'])
                                ->collection('Curriculum')
                                ->documents();
                            $videos = count(collect($video));
                            $instructur = $db->document($course->data()['instructur']->path())->snapshot()
                        @endphp
                    <h3>Pratinjau</h3>
                    <hr>
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="card border border-1 shadow shadow-sm" style="border-radius: 25px">
                                    <img class="card-img-top" src="{{ $course->data()['thumbnail_url'] }}"
                                        style="border-radius: 25px 25px 0 0; max-height:180px; max-widht:355px" alt="thumbnail">
                                <div class="card-body py-2">
                                    <h5 class="card-title mb-1 fw-bold text-truncate" style="max-width: 330px;">{{ $course->data()['name'] }}</h5>
                                    <h6 class="card-title mb-1 fw-light">{{ $category->data()['name'] }}</h6>
                                    @foreach ($course->data()['Category_tags'] as $tag)
                                        <span class="badge bg-primary bg-opacity-25 py-1 px-2 text-primary me-2"
                                            style="font-size: 12px">{{  $tag->snapshot()->data()['name'] }}</span>
                                    @endforeach
                                    <div class="d-flex my-2">
                                        <p class="mb-0">{{ $videos }} Video</p>
                                        <h4 class="ms-auto fw-bold text-success mb-0">{{ $course->data()['Category_price_type'] == 'free' ? 'Gratis' : "Rp. " . $course->data()['price'] }}</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="detailed my-3">
                                <h6>Pembuat</h6>
                                <div class="creator d-flex align-items-center">
                                    <img src="{{ $instructur->data()['photoUrl'] }}" width="35" height="35"
                                        class="border border-1 border-dark rounded-circle me-1" alt="{{ $instructur->data()['name'] }}">
                                    <h5 class="mb-0 ms-2">{{ $instructur->data()['name'] }}</h5>
                                </div>
                                <hr>
                                <div class="hstack gap-1 gap-lg-3">
                                    <div class="category">
                                        <h6 class="text-start">Kategori</h6>
                                        <div class=" text-warp" style="width: 8rem;">{{ $category->data()['name'] }}</div>
                                    </div>
                                    <div class="vr"></div>
                                    <div class="video">
                                        <h6 class="text-start">Video</h6>
                                        <div class=" text-warp" style="width: 4rem;">{{ $videos }}
                                            Video</div>
                                    </div>
                                    <div class="vr"></div>
                                    <div class="harga">
                                        <h6 class="text-start">Harga</h6>
                                        <div class="text-wrap">{{ $course->data()['Category_price_type'] == 'free' ? 'Gratis' : "Rp." .$course->data()['price'] }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                         <div class="col-lg-4">
                            <div class="row">
                                <div class="col-12">
                                    <h3>Detail</h3>
                                    <h5>Video Preview</h5>
                                    <div class="row">
                                        <div class="col-12">
                                                <div class="ratio ratio-16x9 rounded-4">
                                                    <video id="player" playsinline class="my-2 mb-3 rounded-3" controls
                                                        data-poster="{{ $course->data()['thumbnail_url'] }}" width="355" height="200">
                                                        <source src="{{ $course->data()['preview_video_url'] }}">
                                                    </video>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <h5 class="mt-4">Deskripsi</h5>
                                    <p>{{ $course->data()['description'] }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <h3>Materi</h3>
                            <h5>Detail Materi</h5>
                            <div class="accordion mt-3" id="accordionExample">
                                {{-- @dd($video) --}}
                                @php
                                    $curriculums = $db->collection('Courses')->document($course->data()['id'])
                                                ->collection('Curriculum')
                                                ->documents();

                                @endphp
                                @dd($curriculums)
                                @foreach ($curriculums as $curriculum)
                                        @php
                                            $curriculum_sections = $db->collection('Courses')->document($course->data()['id'])
                                                                ->collection('Curriculum')
                                                                ->document($curriculum->data()['id'])
                                                                ->collection('Curriculum_section')
                                                                ->documents();
                                        @endphp
                                    <div class="accordion-item bg-white">
                                        <h2 class="accordion-header" id="heading{{ $loop->index }}">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#collapse{{ $loop->index }}" aria-expanded="true"
                                                aria-controls="collapse{{ $loop->index }}">
                                                <h4 class="fw-bold fs-5 mb-0">{{ $curriculum->data()['name'] }}</h4>
                                            </button>
                                        </h2>
                                        <div id="collapse{{ $loop->index }}" class="accordion-collapse collapse"
                                            aria-labelledby="heading{{ $loop->index }}" data-bs-parent="#accordionExample">
                                            <div class="accordion-body" id="{{ $loop->index }}">
                                                @foreach ($curriculum_sections as $curriculum_section)
                                                    @if ($curriculum_section != [])
                                                        <div class="d-flex align-items-center">
                                                            <button type="button" class="btn btn-link d-flex align-items-center" data-bs-toggle="modal"
                                                                data-bs-target="#detailSubMateri{{ $loop->index . $loop->parent->index }}">
                                                                <i class="bi bi-play-circle-fill text-primary fs-2"></i>
                                                                <h5 class="ms-2 mb-0">
                                                                    {{ $curriculum_section->data()['name'] }}
                                                                </h5>
                                                            </button>
                                                        </div>
                                                        <hr>
                                                    @endif
                                                    {{-- Detail Sub Materi --}}
                                                            <div class="modal fade" id="detailSubMateri{{ $loop->index . $loop->parent->index }}" tabindex="-1"
                                                                aria-hidden="true" wire:ignore>
                                                                <div class="modal-dialog modal-dialog-centered">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                                <h1 class="modal-title fs-5">Detail Sub Materi
                                                                                    {{ $curriculum->data()['name'] }}
                                                                                </h1>

                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="text-center">
                                                                                <div class="video-player rounded-3">
                                                                                        <video width="450" height="250" id="player" playsinline class="rounded-3" controls
                                                                                            src="{{ $curriculum_section->data()['video'] }}"></video>
                                                                                </div>
                                                                            </div>
                                                                            <div class="mb-3">
                                                                                <label for="nama_sub_materi">Nama Sub Materi</label>
                                                                                <input type="text" class="form-control"
                                                                                    value="{{ $curriculum_section->data()['name'] }}" readonly>
                                                                            </div>
                                                                            <div class="mb-3">
                                                                                <label for="nama_sub_materi">Deskripsi Sub Materi</label>
                                                                                <textarea cols="10" rows="5" readonly class="form-control">{{ $curriculum_section->data()['description'] }}</textarea>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
