@push('custom-style')
	<style>
		div.dataTables_wrapper div.dataTables_processing {
			background-color: #fff !important;

		}

		.loading>#datatables-column-search-text-inputs_processing {
			width: 100%;
			position: relative;
		}

		div.dataTables_wrapper div.dataTables_processing .progress {
			background-color: #fff !important;
			width: 100%;
		}

		div.dataTables_wrapper div.dataTables_processing {
			left: 0;
			margin-left: 0px;
			margin-top: 0px;
			padding: 0px;
			position: absolute;
			text-align: center;
			top: 0;
			width: 200px;
		}
	</style>
	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
	<link rel="stylesheet" href="https://cdn.plyr.io/3.7.2/plyr.css" />
@endpush
<div>
	<div class="container-fluid p-0">
		<h1 class="mb-3">Tambah Data Kursus</h1>
		<nav style="--bs-breadcrumb-divider: '/';" aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="#">Dashboard</a></li>
				<li class="breadcrumb-item active" aria-current="page">Kursus</li>
				<li class="breadcrumb-item active" aria-current="page">Tambah Kursus</li>
			</ol>
		</nav>
		<div class="content">
			<form wire:submit.prevent="register">
				<div id="smartwizard-default-primary" class="wizard wizard-primary mb-4 sw sw-theme-default sw-justified">
					<ul class="nav">
						<li class="nav-item"><a class="nav-link {{ $currentStep != 1 ? 'inactive' : 'active' }}"
								href="#default-primary-step-1">Langkah
								Pertama<br><small>Detail Kursus</small></a></li>
						<li class="nav-item"><a class="nav-link {{ $currentStep != 2 ? 'inactive' : 'active' }}"
								href="#default-primary-step-2">Langkah Kedua<br><small>Kursus
									Media</small></a></li>
						<li class="nav-item"><a class="nav-link {{ $currentStep != 3 ? 'inactive' : 'active' }}"
								href="#default-primary-step-3">Langkah
								Ketiga<br><small>Kurikulum</small></a></li>
						<li class="nav-item"><a class="nav-link {{ $currentStep != 4 ? 'inactive' : 'active' }}"
								href="#default-primary-step-4">Langkah
								Keempat<br><small>Pratinjau</small></a></li>
					</ul>

					<div class="tab-content">
						@if ($currentStep == 1)
							<div id="default-primary-step-1" class="tab-pane" role="tabpanel" style="display: block;">
								<h3>Kursus Detail</h3>
								<hr>
								<div class="row">
									<div class="col-12">
										<div class="mb-3">
											<label for="nama_kursus" class="form-label">Nama Kursus</label>
											<input type="text" class="form-control form-control-md @error('nama_kursus') is-invalid @enderror"
												wire:model="nama_kursus" placeholder="Masukkan Nama Kursus" value="{{ old('nama_kursus') }}" required>
											@error('nama_kursus')
												<div class="invalid-feedback">
													{{ $message }}
												</div>
											@enderror
										</div>
									</div>
									<div class="col-sm-6">
										<div class="mb-3">
											<div wire:ignore>
												<label for="kategori_kursus" class="form-label">Kategori Kursus <small class="text-danger">* harus
														diisi</small></label>
												<select class="form-control select2 @error('kategori_kursus') is-invalid @enderror"
													wire:model="kategori_kursus" id="kategori_kursus">
													<option></option>
													@foreach ($kategori_kursus as $kategori)
														<option value="{{ $kategori->name }}">{{ $kategori->name }}</option>
													@endforeach
												</select>
											</div>
											@error('kategori_kursus')
												<div class="invalid-feedback">
													{{ $message }}
												</div>
											@enderror
										</div>
									</div>
									<div class="col-sm-6">
										<div class="mb-3">
											<div wire:ignore>
												<label for="level_kursus" class="form-label">Kursus Level <small class="text-danger">* harus
														diisi</small></label>
												<select class="form-control select2 @error('level_kursus') is-invalid @enderror" id="level_kursus"
													wire:model="level_kursus" id="level_kursus">
													<option></option>
													@foreach ($level_kursus as $level)
														<option value="{{ $level->name }}" {{ $level_kursus == $level->name ? 'selected' : '' }}>
															{{ $level->name }}</option>
													@endforeach
												</select>
											</div>
											@error('level_kursus')
												<div class="invalid-feedback">
													{{ $message }}
												</div>
											@enderror
										</div>
									</div>
									<div class="col-sm-6">
										<div class="mb-3">
											<label for="tipe_harga" class="form-label">Tipe Harga</label>
											<select class="form-control @error('tipe_harga') is-invalid @enderror" id="tipe_harga"
												wire:model="tipe_harga">
												<option value="">Pilih Tipe Harga</option>
												<option value="paid">Berbayar</option>
												<option value="free">Gratis</option>
											</select>
											@error('tipe_harga')
												<div class="invalid-feedback">
													{{ $message }}
												</div>
											@enderror
										</div>
									</div>
									<div class="col-sm-6">
										<div class="mb-3">
											<label for="harga_kursus" class="form-label">Harga</label>
											<input type="number" class="form-control form-control-md @error('harga_kursus') is-invalid @enderror"
												{{ $tipe_harga == 'free' || $tipe_harga == '' ? 'disabled' : '' }} wire:model="harga_kursus"
												placeholder="Harga Kursus" value="{{ old('harga_kursus') }}" required>
											@error('harga_kursus')
												<div class="invalid-feedback">
													{{ $message }}
												</div>
											@enderror
										</div>
									</div>
									<div class="col-sm-6">

										<div class="mb-3">
											<label for="waktu_kursus" class="form-label">Waktu</label>
											<input type="number" class="form-control form-control-md @error('waktu_kursus') is-invalid @enderror"
												wire:model="waktu_kursus" placeholder="Total waktu" value="{{ old('waktu_kursus') }}" required>
											@error('waktu_kursus')
												<div class="invalid-feedback">
													{{ $message }}
												</div>
											@enderror
										</div>

									</div>
									<div class="col-sm-1">
										<div class="mb-3">
											<label for="promo" class="form-label">Promo</label>
											<select class="form-control @error('promo') is-invalid @enderror" id="promo"
												{{ $tipe_harga == 'free' || $tipe_harga == '' ? 'disabled' : '' }} wire:model="promo">
												<option value="">Pilih</option>
												<option value="true">Ya</option>
												<option value="false">Tidak</option>
											</select>
											@error('promo')
												<div class="invalid-feedback">
													{{ $message }}
												</div>
											@enderror
										</div>
									</div>
									<div class="col-sm-3">
										<div class="mb-3">
											<label for="diskon" class="form-label">Diskon</label>
											<input type="number" class="form-control form-control-md @error('diskon') is-invalid @enderror"
												wire:model="diskon" {{ $promo == 'false' || $promo == '' ? 'disabled' : '' }} placeholder="diskon"
												value="{{ old('diskon') }}" required>
											@error('diskon')
												<div class="invalid-feedback">
													{{ $message }}
												</div>
											@enderror
										</div>
									</div>
									<div class="col-sm-2">
										<div class="mb-3">
											<label for="kode_promo" class="form-label">Kode Promo</label>
											<input type="text" class="form-control form-control-md @error('kode_promo') is-invalid @enderror"
												wire:model="kode_promo" {{ $promo == 'false' || $promo == '' ? 'disabled' : '' }}
												placeholder="kode promo" maxlength="8" value="{{ old('kode_promo') }}" required>
											@error('kode_promo')
												<div class="invalid-feedback">
													{{ $message }}
												</div>
											@enderror
										</div>
									</div>
									<div class="col-12">
										<div class="mb-3">
											<label for="deskripsi_kursus" class="form-label">Deskripsi Kursus</label>
											<textarea wire:model="deskripsi_kursus" id="deskripsi_kursus" cols="20" rows="7"
											 class="form-control form-control-md @error('deskripsi_kursus') is-invalid @enderror" placeholder="Deskripsi Kursus"
											 required>{{ old('deskripsi_kursus') }}</textarea>
											@error('deskripsi_kursus')
												<div class="invalid-feedback">
													{{ $message }}
												</div>
											@enderror
										</div>
									</div>
								</div>
							</div>
						@endif
						@if ($currentStep == 2)
							<div id="default-primary-step-2" class="tab-pane" role="tabpanel" style="display: block;">
								<h3>Kursus Media</h3>
								<hr>
								<div
									class="text-center justify-content-center align-items-center p-4 p-sm-5 border -border-2 border-dashed position-relative rounded-3 my-2">
									@if ($thumbnail)
										<img src="{{ $thumbnail->temporaryUrl() }}" class="rounded-4" width="350" height="180"
											style="border-radius: 10px;" alt="">
									@endif
									<div wire:loading wire:target="thumbnail">
										<div class="spinner-border text-primary" role="status">
											<span class="visually-hidden">Loading...</span>
										</div>
									</div>
									<div>
										<label for="thumbnail" class="h-6 my-2">Thumbnail <span class="text-primary">Telusuri</span></label>
										<div class="col-sm-4 mx-auto">
											<span>
												<input class="form-control @error('thumbnail') is-invalid @enderror"
													accept="image/png, image/jpg, image/jpeg" wire:model="thumbnail" id="thumbnail" type="file"
													required>
												@error('thumbnail')
													<div class="invalid-feedback">
														{{ $message }}
													</div>
												@enderror
											</span>
										</div>
										<p class="small mb-0 mt-2"><b>Catatan: </b> Hanya bisa PNG, JPG dan JPGE</p>
									</div>
								</div>
								<h3>Video Preview</h3>
								<hr>
								<div class="row justify-content-center text-center">
									<div class="col-6 text-center">
										<label for="video_preview">Unggah video</label>
										<input type="file" class="form-control mb-4 mt-2 @error('video_preview') is-invalid @enderror"
											accept="video/mp4,video/mkv" wire:model="video_preview">
										@error('video_preview')
											<div class="invalid-feedback">
												{{ $message }}
											</div>
										@enderror
									</div>
									<div wire:loading wire:target="video_preview">
										<div class="spinner-border text-primary" role="status">
											<span class="visually-hidden">Loading...</span>
										</div>
									</div>
									@if ($video_preview)
										<div class="video-player rounded-3">
											@if ($thumbnail)
												<video id="player" playsinline class="rounded-3" controls
													data-poster="{{ $thumbnail->temporaryUrl() }}">
													<source src="{{ $video_preview->temporaryUrl() }}" />
												</video>
											@else
												<video id="player" playsinline class="rounded-3" controls data-poster="{{ $thumbnail }}">
													<source src="{{ $video_preview->temporaryUrl() }}" />
												</video>
											@endif
										</div>
									@endif
								</div>
							</div>
						@endif
						@if ($currentStep == 3)
							<div id="default-primary-step-3" class="tab-pane" role="tabpanel" style="display: block;">
								<h3>Kurikulum Pembelajaran</h3>
								<hr>
								<div class="row">
									<div class="d-flex justify-content-between">
										<h4>Unggah video pembelajaran</h4>
										<button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#add_lecture">Tambah
											Pembelajaran</button>
									</div>
									<div class="row text-center">
										<div wire:loading wire:target="materi">
											<div class="spinner-border text-primary" role="status">
												<span class="visually-hidden">Loading...</span>
											</div>
										</div>
									</div>
									<div class="col-12 mt-4 mb-2">
										<div class="accordion" id="accordionExample">
											@foreach ($materi_sub_materi as $key => $value)
												<div class="accordion-item bg-white">
													<h2 class="accordion-header" id="heading{{ $loop->index }}">
														<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
															data-bs-target="#collapse{{ $loop->index }}" aria-expanded="true"
															aria-controls="collapse{{ $loop->index }}">

															<h4 class="fw-bold fs-5 mb-0">{{ $key }}</h4>
														</button>
													</h2>
													<div id="collapse{{ $loop->index }}" class="accordion-collapse collapse"
														aria-labelledby="heading{{ $loop->index }}" data-bs-parent="#accordionExample">
														<div class="accordion-body" wire:key="{{ $loop->index }}" id="{{ $loop->index }}">
															@foreach ($value as $keys => $values)
																@if ($values != [])
																	<div class="d-flex align-items-center">
																		<button type="button" class="btn btn-link d-flex align-items-center" data-bs-toggle="modal"
																			data-bs-target="#detailSubMateri{{ $loop->index . $loop->parent->index }}">
																			<i class="bi bi-play-circle-fill text-primary fs-2"></i>
																			<h5 class="ms-2 mb-0">
																				{{ $materi_sub_materi[$key][$loop->index][$loop->parent->index]['nama_sub_materi'] }}</h5>
																		</button>
																		{{-- <button type="button" class="btn btn-warning ms-auto mx-2" data-bs-toggle="modal"
																			data-bs-target="#editSubMateri{{ $loop->index . $loop->parent->index }}"
																			wire:click.prevent="updateSubMateriItem({{ '\'' . $key . '\'' . ',' . $loop->index . ',' . $loop->parent->index }})"
																			wire:key="{{ $key }}">
																			<i class="bi bi-pencil-fill"></i></button> --}}

																		<button type="button" class="btn btn-warning ms-auto mx-2" data-bs-toggle="modal"
																			data-bs-target="#editSubMateri{{ $loop->index . $loop->parent->index }}"
																			wire:click.prevent="updateSubMateriItem({{ '\'' . $key . '\'' . ',' . $loop->index . ',' . $loop->parent->index }})">
																			<i class="bi bi-pencil-fill"></i></button>

																		<button type="button" class="btn btn-danger"
																			onclick="confirm('Apakah kamu yakin menghapus sub materi  ({{ $materi_sub_materi[$key][$loop->index][$loop->parent->index]['nama_sub_materi'] }})  ? ') || event.stopImmediatePropagation()"
																			wire:click.prevent="removeSubMateriItems({{ '\'' . $key . '\'' . ',' . $loop->index . ',' . $loop->parent->index }})"><i
																				class="bi bi-trash-fill"></i></button>
																	</div>
																	<div class="row text-center">
																		<div wire:loading
																			wire:target="removeSubMateriItems({{ '\'' . $key . '\'' . ',' . $loop->index . ',' . $loop->parent->index }})">
																			<div class="spinner-border text-primary" role="status">
																				<span class="visually-hidden">Loading...</span>
																			</div>
																		</div>
																	</div>
																	<hr>
																@endif
															@endforeach

															<div class="d-flex ">
																<button type="button" class="btn btn-info" data-bs-toggle="modal"
																	data-bs-target="#addSubMateri{{ $loop->index }}">Tambah
																	sub materi</button>
																<button type="button" class="ms-auto me-1 btn btn-warning" data-bs-toggle="modal"
																	data-bs-target="#editMateri{{ $loop->index }}"
																	wire:click.prevent="updateMateriItem({{ '\'' . $key . '\'' }})">Edit Materi</button>
																<button type="button" class="btn btn-danger ms-1"
																	onclick="confirm('Apakah kamu yakin menghapus materi  ({{ $key }})  ? ') || event.stopImmediatePropagation()"
																	wire:click.prevent="removeMateriItems('{{ $key }}')">Hapus
																	Materi</button>
															</div>
														</div>
													</div>
												</div>
											@endforeach
										</div>
									</div>
								</div>
							</div>
						@endif
						@if ($currentStep == 4)
							<div id="default-primary-step-4" class="tab-pane" role="tabpanel" style="display: block;">
								Step Content 4
							</div>
						@endif
					</div>
					<div class="toolbar toolbar-bottom d-flex justify-content-between" role="toolbar">
						@if ($currentStep == 1)
							<div></div>
						@endif

						@if ($currentStep == 2 || $currentStep == 3 || $currentStep == 4)
							<button class="btn sw-btn-prev" type="button" wire:click="decreaseStep()">Kembali</button>
						@endif

						@if ($currentStep == 1 || $currentStep == 2 || $currentStep == 3)
							<button class="btn sw-btn-next" type="button" wire:click="increaseStep()">Selanjutnya</button>
						@endif

						@if ($currentStep == 4)
							<button class="btn btn-success" type="submit">Selesai</button>
						@endif
					</div>
				</div>
			</form>
		</div>
	</div>

	{{-- Detail Sub Materi --}}
	@foreach ($materi_sub_materi as $key => $value)
		@foreach ($value as $keys => $values)
			<div class="modal fade" id="detailSubMateri{{ $loop->index . $loop->parent->index }}" tabindex="-1"
				aria-labelledby="detailSubMateri{{ $loop->index . $loop->parent->index }}Label" aria-hidden="true"
				wire:ignore.self>
				<div class="modal-dialog modal-dialog-centered">
					<div class="modal-content">
						<div class="modal-header">
							<h1 class="modal-title fs-5" id="detailSubMateri{{ $loop->index . $loop->parent->index }}Label">Detail Sub
								Materi {{ $materi_sub_materi[$key][$loop->index][$loop->parent->index]['nama_sub_materi'] }}
							</h1>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
							<div class="text-center">
								<div class="video-player rounded-3">
									<video width="450" height="250" id="player" playsinline class="rounded-3" controls>
										<source src="{{ $materi_sub_materi[$key][$loop->index][$loop->parent->index]['nama_sub_materi'] }}" />
									</video>
								</div>
							</div>
							<div class="mb-3">
								<label for="nama_sub_materi">Nama Sub Materi</label>
								<input type="text" class="form-control"
									value="{{ $materi_sub_materi[$key][$loop->index][$loop->parent->index]['nama_sub_materi'] }}" readonly>
							</div>
							<div class="mb-3">
								<label for="deskripsi_sub_materi">Deskripsi Sub Materi</label>
								<textarea class="form-control" cols="10" rows="5" readonly>{{ $materi_sub_materi[$key][$loop->index][$loop->parent->index]['deskripsi_sub_materi'] }}</textarea>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
						</div>
					</div>
				</div>
			</div>
		@endforeach
	@endforeach

	{{-- Edit Sub Materi --}}
	@foreach ($materi_sub_materi as $key => $value)
		@foreach ($value as $keys => $values)
			<div class="modal fade" id="editSubMateri{{ $loop->index . $loop->parent->index }}" tabindex="-1"
				aria-labelledby="editSubMateri{{ $loop->index . $loop->parent->index }}Label" aria-hidden="true"
				wire:ignore.self>
				<div class="modal-dialog modal-dialog-centered">
					<div class="modal-content">
						<form
							wire:submit.prevent="updateSubMateri({{ '\'' . $key . '\'' . ',' . $loop->index . ',' . $loop->parent->index }})">
							<div class="modal-header">
								<h1 class="modal-title fs-5" id="editSubMateri{{ $loop->index . $loop->parent->index }}Label">Edit
									Sub
									Materi {{ $key }}
								</h1>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>
							<div class="modal-body">
								<div class="text-center">
									@if ($sub_materi_item)
										<div class="video-player rounded-3">

											<video width="450" height="250" id="player" playsinline class="rounded-3" controls>
												<source src="" />
											</video>
										</div>
									@endif
									<div wire:loading wire:target="sub_materi_item.{{ $key }}.{{ $loop->index }}.video_sub_materi"
										wire:key="{{ $key }}">
										<div class="spinner-border text-primary" role="status">
											<span class="visually-hidden">Loading...</span>
										</div>
									</div>
								</div>
								<div class="mb-3">
									<label for="video_sub_materi">Video Sub Materi</label>
									<input type="file" class="form-control @error('sub_materi_item.video_sub_materi') is-invalid @enderror"
										wire:model="sub_materi_item.{{ $key }}.{{ $loop->index }}.video_sub_materi"
										wire:key="{{ $key }}">

									@error('sub_materi_item.video_sub_materi')
										<div class="invalid-feedback">
											{{ $message }}
										</div>
									@enderror
								</div>
								<div class="mb-3">
									<label for="nama_sub_materi">Nama Sub Materi</label>
									<input type="text"
										wire:model.defer="sub_materi_item.{{ $key }}.{{ $loop->index }}.nama_sub_materi"
										wire:key="{{ $key }}"
										class="form-control @error('sub_materi_item.nama_sub_materi') is-invalid @enderror">
									@error('sub_materi_item.nama_sub_materi')
										<div class="invalid-feedback">
											{{ $message }}
										</div>
									@enderror
								</div>
								<div class="mb-3">
									<label for="deskripsi_sub_materi">Deskripsi Sub Materi</label>
									<textarea wire:model="sub_materi_item.{{ $key }}.{{ $loop->index }}.deskripsi_sub_materi"
									 wire:key="{{ $key }}" class="form-control @error('deskripsi_sub_materi') is-invalid @enderror"
									 cols="10" rows="5"></textarea>
									@error('deskripsi_sub_materi')
										<div class="invalid-feedback">
											{{ $message }}
										</div>
									@enderror
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
								<button type="submit" class="btn btn-primary">Simpan</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		@endforeach
	@endforeach

	{{-- Tambah Sub Materi --}}
	@foreach ($materi_sub_materi as $key => $value)
		<div class="modal fade" id="addSubMateri{{ $loop->index }}" tabindex="-1"
			aria-labelledby="addSubMateri{{ $loop->index }}Label" aria-hidden="true" wire:ignore.self>
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<form wire:submit.prevent="subMateri">
						<div class="modal-header">
							<h1 class="modal-title fs-5" id="addSubMateri{{ $loop->index }}Label">Tambah Sub
								Materi {{ $key }}
							</h1>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
							<div class="text-center">
								@if ($sub_materi_item)
									<div class="video-player rounded-3">

										<video width="450" height="250" id="player" playsinline class="rounded-3" controls>
											<source src="" />
										</video>
									</div>
								@endif
								<div wire:loading wire:target="sub_materi_item.{{ $key }}.{{ $loop->index }}.video_sub_materi"
									:key={{ $key }}>
									<div class="spinner-border text-primary" role="status">
										<span class="visually-hidden">Loading...</span>
									</div>
								</div>
							</div>
							<div class="mb-3">
								<label for="video_sub_materi">Video Sub Materi</label>
								<input type="file" class="form-control @error('sub_materi_item.video_sub_materi') is-invalid @enderror"
									wire:model="sub_materi_item.{{ $key }}.{{ $loop->index }}.video_sub_materi"
									:key="{{ $key }}">

								@error('sub_materi_item.video_sub_materi')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
								@enderror
							</div>
							<div class="mb-3">
								<label for="nama_sub_materi">Nama Sub Materi</label>
								<input type="text"
									wire:model.defer="sub_materi_item.{{ $key }}.{{ $loop->index }}.nama_sub_materi"
									:key="{{ $key }}"
									class="form-control @error('sub_materi_item.nama_sub_materi') is-invalid @enderror">
								@error('sub_materi_item.nama_sub_materi')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
								@enderror
							</div>
							<div class="mb-3">
								<label for="deskripsi_sub_materi">Deskripsi Sub Materi</label>
								<textarea wire:model="sub_materi_item.{{ $key }}.{{ $loop->index }}.deskripsi_sub_materi"
								 :key="{{ $key }}" class="form-control @error('deskripsi_sub_materi') is-invalid @enderror" cols="10"
								 rows="5"></textarea>
								@error('deskripsi_sub_materi')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
								@enderror
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
							<button type="submit" class="btn btn-primary">Simpan</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	@endforeach

	{{-- Edit Materi --}}
	@foreach ($materi_sub_materi as $key => $value)
		<div class="modal fade" id="editMateri{{ $loop->index }}" tabindex="-1"
			aria-labelledby="editMateri{{ $loop->index }}Label" aria-hidden="true" wire:ignore.self>
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<form wire:submit.prevent="updateMateri({{ '\'' . $key . '\'' }})">
						<div class="modal-header">
							<h1 class="modal-title fs-5" id="editMateri{{ $loop->index }}Label">Ubah Nama Materi Pembelajaran</h1>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
							<label for="nama_materi">Nama Materi</label>
							<input type="text" value="{{ $key }}" wire:model.defer="nama_materi_baru"
								class="form-control @error('nama_materi_baru') is-invalid @enderror">
							@error('nama_materi_baru')
								<div class="invalid-feedback">
									{{ $message }}
								</div>
							@enderror
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
							<button type="submit" class="btn btn-primary">Simpan</button>
						</div>
					</form>

				</div>
			</div>
		</div>
	@endforeach

	{{-- Tambah Materi --}}
	<div class="modal fade" id="add_lecture" tabindex="-1" aria-labelledby="add_lectureLabel" aria-hidden="true"
		wire:ignore.self>
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<form wire:submit.prevent="materi">
					<div class="modal-header">
						<h1 class="modal-title fs-5" id="add_lectureLabel">Tambah Materi Pembelajaran</h1>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<label for="nama_materi">Nama Materi</label>
						<input type="text" wire:model.defer="nama_materi"
							class="form-control @error('nama_materi') is-invalid @enderror">
						@error('nama_materi')
							<div class="invalid-feedback">
								{{ $message }}
							</div>
						@enderror
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
						<button type="submit" class="btn btn-primary">Simpan</button>
					</div>
				</form>

			</div>
		</div>
	</div>

	{{-- Modal Control --}}
	@foreach ($materi_sub_materi as $key => $value)
		@foreach ($value as $keys => $values)
			<script>
				window.addEventListener('show-form', event => {
					$('#editSubMateri{{ $loop->index . $loop->parent->index }}').modal('show')
				})
				window.addEventListener('hide-form', event => {
					$('#editSubMateri{{ $loop->index . $loop->parent->index }}').modal('hide')
				})
			</script>
		@endforeach
	@endforeach

	@foreach ($materi_sub_materi as $key => $value)
		<script>
			window.addEventListener('show-form', event => {
				$('#editMateri{{ $loop->index }}').modal('show')
			})
			window.addEventListener('hide-form', event => {
				$('#editMateri{{ $loop->index }}').modal('hide')
			})
		</script>
		<script>
			window.addEventListener('show-form', event => {
				$('#addSubMateri{{ $loop->index }}').modal('show')
			})
			window.addEventListener('hide-form', event => {
				$('#addSubMateri{{ $loop->index }}').modal('hide')
			})
		</script>
	@endforeach
</div>


@push('custom-script')
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
	<script src="https://cdn.plyr.io/3.7.2/plyr.polyfilled.js"></script>
	<script>
		$(document).ready(function() {
			$('.select2').select2({
				placeholder: "Silahkan Pilih"
			});

			$('#kategori_kursus').on('change', function(e) {
				var data = $('#kategori_kursus').select2("val");
				@this.set('kategori_kursus', data);
			})

			$('#level_kursus').on('change', function(e) {
				var data = $('#kategori_kursus').select2("val");
				@this.set('kategori_kursus', data);
			})

		});
	</script>
	{{-- @foreach ($sub_materi as $key => $value)
		<script>
			window.addEventListener('show-form', event => {
				$('#addSubMateri'.$key).modal('show')
			})
			window.addEventListener('hide-form', event => {
				$('#addSubMateri'.$key).modal('hide')
			})
		</script>
	@endforeach --}}

	<script>
		window.addEventListener('show-form', event => {
			$('#add_lecture').modal('show')
		})

		window.addEventListener('hide-form', event => {
			$('#add_lecture').modal('hide')
		})
	</script>

	<script>
		const player = new Plyr('#player');
	</script>
@endpush
