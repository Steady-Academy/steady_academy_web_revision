@push('custom-styles')
	<style>
		.steper .line {
			flex: 1 0 20px;
			min-width: 1px;
			min-height: 1px;
			margin: auto;
			background-color: rgba(0, 0, 0, .12);
		}
	</style>
@endpush
<div>
	<header>
		<h1 class="h2 text-center">Ayo Lengkapi Datamu!</h1>
	</header>
	<section class="h-100">
		<div class="container">
			<div class="card border-1 rounded-3">
				<div class="card-header pt-4 pt-md-5 px-3 px-md-5 pb-4 pb-md-4">
					<div class="steper">
						<div class="d-flex">
							<div class="step text-center">
								<a href="#step-1" type="button"
									class="btn border-3 fw-bold {{ $currentStep != 1 ? 'border-secondary' : 'border-primary text-primary' }}"
									style="border-radius: 50px;">1</a>
								<p class="fw-bold {{ $currentStep != 1 ? '' : 'text-primary' }}">Profil</p>
							</div>
							<div class="line"></div>
							<div class="step text-center">
								<a href="#step-2" type="button"
									class="btn border-3 fw-bold {{ $currentStep != 2 ? 'border-secondary' : 'border-primary text-primary' }}"
									style="border-radius: 50px;">2</a>
								<p class="fw-bold {{ $currentStep != 2 ? '' : 'text-primary' }}">Dokumen</p>
							</div>
							<div class="line"></div>
							<div class="step text-center">
								<a href="#step-3" type="button"
									class="btn border-3 fw-bold {{ $currentStep != 3 ? 'border-secondary ' : 'border-primary text-primary' }}"
									style="border-radius: 50px;">3</a>
								<p class="fw-bold {{ $currentStep != 3 ? '' : 'text-primary' }}">Pratinjau</p>
							</div>
						</div>
					</div>
				</div>
				<div class="card-body px-3 px-md-5">
					<form wire:submit.prevent="register">
						@if ($currentStep == 1)
							<div class="step-one" id="step-1">
								<h3>Profil</h3>
								<hr>
								<div class="mb-3">
									<label for="nama_lengkap" class="form-label">Nama lengkap</label>
									<input type="text" class="form-control form-control-md @error('nama') is-invalid @enderror"
										wire:model="nama" placeholder="Masukkan Nama Lengkap" value="{{ old('nama') }}" required>
									@error('nama')
										<div class="error-message">
											<p>{{ $message }}</p>
										</div>
									@enderror
								</div>
								<div class="mb-3">
									<label for="email" class="form-label">Email</label>
									<input type="email" class="form-control form-control-md @error('email') is-invalid @enderror"
										wire:model="email" placeholder="Masukkan Email" value="{{ old('email') }}" disabled required>
									@error('email')
										<div class="error-message">
											{{ $message }}
										</div>
									@enderror
								</div>
								<div class="mb-3">
									<label for="foto" class="form-label">Foto Profil</label>
									<div class="mb-3 col-sm-3">
										<div
											class="foto justify-content-center text-center p-4 p-sm-5 border border-2 border-dashed position-relative rounded-4 d-grid">
											@if ($foto_temp)
												<img id="profile" src="{{ $foto_temp->temporaryUrl() }}"
													class="mb-3 rounded-circle border-dark border border-3 border-secondary" width="150" alt="">
											@elseif ($foto)
												<img id="profile" src="{{ $foto }}"
													class="mb-3 rounded-circle border-dark border-dark border border-3 border-secondary" width="150"
													alt="">
											@endif
											<div wire:loading wire:target="foto">
												<div class="spinner-border text-primary" role="status">
													<span class="visually-hidden">Loading...</span>
												</div>
											</div>
											<div wire:loading wire:target="foto_temp">
												<div class="spinner-border text-primary" role="status">
													<span class="visually-hidden">Loading...</span>
												</div>
											</div>
										</div>
										<label for="foto" class="form-label" style="cursor: pointer;">
											<input type="file" class="form-control form-control-sm mt-3 @error('foto') is-invalid @enderror"
												wire:model="{{ $foto_temp == '' ? 'foto_temp' : 'foto' }}" name="foto" id="foto"
												accept="image/png, image/jpg, image/jpeg, image/svg" required>
										</label>
									</div>

									@error('foto')
										<div class="error-message">
											{{ $message }}
										</div>
									@enderror
								</div>
								<div class="mb-3 col-2">
									<label for="tanggal" class="form-label">Tanggal Lahir</label>
									<input type="date" class="form-control form-control-sm @error('tanggal_lahir') is-invalid @enderror"
										wire:model="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required>
									@error('tanggal_lahir')
										<div class="error-message">
											{{ $message }}
										</div>
									@enderror
								</div>
								<div class="mb-3">
									<label for="email" class="form-label">Jenis Kelamin</label>
									<div class="gender">
										<div class="form-check form-check-inline">
											<input class="form-check-input @error('jenis_kelamin') is-invalid @enderror" type="radio"
												wire:model="jenis_kelamin" name="jenis_kelamin" id="laki-laki" value="laki-laki">
											<label class="form-check-label" for="laki-laki">
												Laki-laki
											</label>
										</div>
										<div class="form-check form-check-inline">
											<input class="form-check-input @error('jenis_kelamin') is-invalid @enderror" type="radio"
												wire:model="jenis_kelamin" name="jenis_kelamin" id="perempuan" value="perempuan">
											<label class="form-check-label" for="perempuan">
												Perempuan
											</label>
										</div>
									</div>
								</div>

								<div class="mb-3">

									<label class="form-label" for="kegiatan">Kegiatan</label>
									<select class="form-select form-select-md  @error('kegiatan') is-invalid @enderror" style="height: 50%"
										wire:model="kegiatan" name="kegiatan" id="kegiatan">
										<option value="">Pilih Kegiatan</option>
										<option value="Lainnya">Lainnya</option>
										<option value="Pekerja Kantoran">Pekerja Kantoran</option>
										<option value="Guru">Guru</option>
										<option value="Ibu Rumah Tangga">Ibu Rumah Tangga</option>
										<option value="Pegawai Sipil">Pegawai Sipil</option>
									</select>
									@error('kegiatan')
										<div class="invalid-feedback">
											{{ $message }}
										</div>
									@enderror

								</div>
								<h3>Alamat Domisili Saat ini</h3>
								<hr>
								<div class="mb-3">

									<label class="form-label" for="provinsi">Provinsi</label>
									<select class="form-select form-select-md  @error('provinsi_id') is-invalid @enderror" style="height: 50%"
										wire:model="provinsi_id" id="provinsi">
										<option value="">Pilih Provinsi</option>
										@foreach ($provinsi as $data)
											<option value="{{ $data->id }}"> {{ $data->nama }} </option>
										@endforeach
									</select>
									@error('provinsi_id')
										<div class="invalid-feedback">
											{{ $message }}
										</div>
									@enderror

								</div>
								<div class="mb-3">

									<label class="form-label" for="kota">Kota / Kabupaten</label>
									<select class="form-select form-select-md  @error('kota_id') is-invalid @enderror" style="height: 50%"
										wire:model="kota_id" id="kota">
										<option value="">Pilih Kota</option>
										@foreach ($kota as $data)
											<option value="{{ $data->id }}"> {{ $data->nama }} </option>
										@endforeach
									</select>
									@error('kota_id')
										<div class="invalid-feedback">
											{{ $message }}
										</div>
									@enderror

								</div>
								<div class="mb-3">
									<label for="poskode" class="form-label">Kode Pos</label>
									<input type="text" class="form-control form-control-md @error('poskode') is-invalid @enderror"
										wire:model="poskode" placeholder="Masukkan Kode Pos" value="{{ old('poskode') }}" required>
									@error('poskode')
										<div class="error-message">
											{{ $message }}
										</div>
									@enderror
								</div>
								<div class="mb-3">
									<label for="alamat" class="form-label">Alamat Lengkap</label>
									<textarea class="form-control form-control-md @error('alamat') is-invalid @enderror" placeholder="Detail Alamat"
									 wire:model="alamat" id="alamat" cols="30" rows="5" required>{{ old('alamat') }}</textarea>
									@error('alamat')
										<div class="error-message">
											{{ $message }}
										</div>
									@enderror
								</div>
								<h3>Kontak</h3>
								<hr>
								<div class="mb-3">
									<label for="telepon" class="form-label">No. Handphone</label>
									<div class="input-group input-group-md">
										<span class="input-group-text bg-light rounded-start border-1 text-secondary fw-bold text-small">+62</span>
										<input type="tel" class="form-control form-control-md @error('telepon') is-invalid @enderror"
											wire:model="telepon" maxlength="13" placeholder="Masukan telepon" value="{{ old('telepon') }}" required>
									</div>
									@error('telepon')
										<div class="error-message">
											{{ $message }}
										</div>
									@enderror
								</div>
								<div class="mb-3">
									<label for="instagram" class="form-label">Instagram</label>
									<input type="text" class="form-control form-control-md @error('instagram') is-invalid @enderror"
										wire:model="instagram" placeholder="(Opsional)" value="{{ old('instagram') }}" required>
									@error('instagram')
										<div class="error-message">
											{{ $message }}
										</div>
									@enderror
								</div>
								<div class="mb-3">
									<label for="facebook" class="form-label">Facebook</label>
									<input type="text" class="form-control form-control-md @error('facebook') is-invalid @enderror"
										wire:model="facebook" placeholder="(Opsional)" value="{{ old('facebook') }}" required>
									@error('facebook')
										<div class="error-message">
											{{ $message }}
										</div>
									@enderror
								</div>
								<div class="mb-3">
									<label for="website" class="form-label">Website</label>
									<input type="text" class="form-control form-control-md @error('website') is-invalid @enderror"
										wire:model="website" placeholder="(Opsional)" value="{{ old('website') }}" required>
									@error('website')
										<div class="error-message">
											{{ $message }}
										</div>
									@enderror
								</div>
							</div>

						@endif

						@if ($currentStep == 2)
							<div class="step-two">
								<div class="row">
									<h3>Dokumen Riwayat Hidup (CV)</h3>
									<hr>
									<div class="col-12">
										<div
											class="text-center justify-content-center align-items-center p-4 p-sm-5 border border-2 border-dashed position-relative rounded-3">
											<!-- Image -->
											@if ($dokumen)
												{{-- <img src="{{ $dokumen->temporaryUrl() }}" class="h-50px" alt="dokumen"> --}}
												<iframe src="{{ $dokumen->temporaryUrl() }}" align="top" height="620" width="100%"
													frameborder="0" scrolling="auto"></iframe>
											@endif
											<div wire:loading wire:target="dokumen">
												<div class="spinner-border text-primary" role="status">
													<span class="visually-hidden">Loading...</span>
												</div>
											</div>
											<div>
												<h6 class="my-2">Kirim Dokumen<a href="#!" class="text-primary"> Telusuri</a></h6>
												<span>
													<input class="form-control" type="file" accept="application/pdf, image/png, image/jpg, image/jpeg"
														wire:model="dokumen" id="image" required>
												</span>
												<p class="small mb-0 mt-2"><b>Catatan:</b> Hanya PNG, JPG, JPEG dan PDF. </p>
												@error('dokumen')
													<div class="error-message">
														{{ $message }}
													</div>
												@enderror
											</div>
										</div>
										<div class="mb-3">
											<h3>Alasanmu Menjadi Instruktur Steady Academy</h3>
											<label for="alasan" class="form-label">Alasan</label>
											<textarea class="form-control form-control-md @error('alasan') is-invalid @enderror" placeholder="Tulis alasanmu"
											 wire:model="alasan" id="alasan" cols="30" rows="5" required>{{ old('alasan') }}</textarea>
											@error('alasan')
												<div class="error-message">
													{{ $message }}
												</div>
											@enderror
										</div>
									</div>
								</div>
							</div>
						@endif

						@if ($currentStep == 3)
							<div class="step-3">
								<div class="row">
									<div class="col-8">
										<h3>Pratinjau</h3>
										<hr>
										<div class="mb-3">
											<label for="nama_lengkap" class="form-label">Nama lengkap</label>
											<input type="text" class="form-control form-control-md" wire:model="nama" value="{{ $nama }}"
												disabled>
										</div>
										<div class="mb-3">
											<label for="nama_lengkap" class="form-label">Email</label>
											<input type="email" class="form-control form-control-md" wire:model="email"
												value="{{ $email }}" disabled>
										</div>
										<div class="mb-3">
											<label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
											<input type="date" class="form-control form-control-md" wire:model="tanggal_lahir"
												value="{{ $tanggal_lahir }}" disabled>
										</div>
										<div class="mb-3">
											<label for="email" class="form-label">Jenis Kelamin</label>
											<div class="gender">
												<div class="form-check form-check-inline">
													<input class="form-check-input " type="radio" wire:model="jenis_kelamin" id="laki-laki"
														value="laki-laki" disabled>
													<label class="form-check-label" for="laki-laki">
														Laki-laki
													</label>
												</div>
												<div class="form-check form-check-inline">
													<input class="form-check-input " type="radio" wire:model="jenis_kelamin" id="perempuan"
														value="perempuan" disabled>
													<label class="form-check-label" for="perempuan">
														Perempuan
													</label>
												</div>
											</div>
										</div>
										<div class="mb-3">
											<label for="kegiatan" class="form-label">Kegiatan Saat Ini</label>
											<input type="text" class="form-control form-control-md" wire:model="kegiatan"
												value="{{ $kegiatan }}" disabled>
										</div>
										<h5>Alamat Domisili</h5>
										<hr>
										<div class="mb-3">
											<label for="provinsi" class="form-label">Provinsi</label>
											<input type="text" class="form-control form-control-md" wire:model="final_provinsi"
												value="{{ $final_provinsi }}" disabled>
										</div>
										<div class="mb-3">
											<label for="kota" class="form-label">Kota</label>
											<input type="text" class="form-control form-control-md" wire:model="final_kota"
												value="{{ $final_kota }}" disabled>
										</div>
										<div class="mb-3">
											<label for="provinsi" class="form-label">Kode Pos</label>
											<input type="text" class="form-control form-control-md" wire:model="poskode"
												value="{{ $poskode }}" disabled>
										</div>
										<div class="mb-3">
											<label for="alamat" class="form-label">Alamat Lengkap</label>
											<textarea class="form-control form-control-md" wire:model="alamat" id="alamat" cols="30" rows="5"
											 disabled>{{ $alamat }}</textarea>
										</div>
										<h5>Kontak</h5>
										<hr>
										<div class="mb-3">
											<label for="telepon" class="form-label">No. Handphone</label>
											<div class="input-group input-group-md">
												<span class="input-group-text bg-light rounded-start border-1 text-secondary fw-bold text-small">+62</span>
												<input type="tel" class="form-control form-control-md " wire:model="telepon"
													value="{{ $telepon }}" disabled>
											</div>
										</div>
										<div class="mb-3">
											<label for="instagram" class="form-label">Instagram</label>
											<input type="text" class="form-control form-control-md " wire:model="instagram"
												value="{{ $instagram }}" disabled>
										</div>
										<div class="mb-3">
											<label for="facebook" class="form-label">Facebook</label>
											<input type="text" class="form-control form-control-md " wire:model="facebook"
												value="{{ $facebook }}" disabled>

										</div>
										<div class="mb-3">
											<label for="website" class="form-label">Website</label>
											<input type="text" class="form-control form-control-md" wire:model="website"
												value="{{ $website }}" disabled>
										</div>
									</div>
									<div class="col-4">
										<div class="foto text-center">
											<div class="row justify-content-center">
												<div class="col-12 my-3">
													<p class="fw-bold">Foto Profil</p>
													@if ($foto_temp)
														<img id="profile" src="{{ $foto_temp->temporaryUrl() }}"
															class="mb-3 rounded-circle border-dark border border-3 border-secondary" width="150"
															alt="">
													@elseif ($foto)
														<img id="profile" src="{{ $foto }}"
															class="mb-3 rounded-circle border-dark border border-3 border-secondary" width="150"
															alt="">
													@endif
												</div>
												<div class="col-12 my-3">
													<p class="fw-bold">Lampiran Dokumen</p>
													@if ($dokumen)
														{{-- <img src="{{ $dokumen->temporaryUrl() }}" class="h-50px" alt="dokumen"> --}}
														<iframe src="{{ $dokumen->temporaryUrl() }}" align="top" height="450" width="100%"
															frameborder="0" scrolling="auto"></iframe>
													@endif

												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						@endif
						<div class="action-buttons d-flex justify-content-between bg-white pt-2 pb-2">
							@if ($currentStep == 1)
								<div></div>
							@endif

							@if ($currentStep == 2 || $currentStep == 3)
								<button type="button" class="btn btn-secondary fw-bold" wire:click="decreaseStep()"><i
										class="fas fa-arrow-left"></i> Kembali</button>
							@endif

							@if ($currentStep == 1 || $currentStep == 2)
								<button type="button" class="btn btn-primary fw-bold" wire:click="increaseStep()">Selanjutnya <i
										class="fas fa-arrow-right"></i></button>
							@endif

							@if ($currentStep == 3)
								<button type="submit" class="btn btn-primary">Submit <i class="fas fa-paper-plane"></i></button>
							@endif
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
</div>
@push('custom-scripts')
	{{-- <script>
		foto.onchange = evt => {
			const [file] = foto.files
			if (file) {
				profile.src = URL.createObjectURL(file);
				@this.set('foto', profile.src);
			}
		}
	</script> --}}
@endpush
