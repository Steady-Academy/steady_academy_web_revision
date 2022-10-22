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
							<p class="fw-bold text-primary">Profil</p>
						</div>
						<div class="line"></div>
						<div class="step text-center">
							<a href="#step-2" type="button"
								class="btn border-3 fw-bold {{ $currentStep != 2 ? 'border-secondary' : 'border-primary' }}"
								style="border-radius: 50px;">2</a>
							<p class="fw-bold">Dokument</p>
						</div>
						<div class="line"></div>
						<div class="step text-center">
							<a href="#step-3" type="button"
								class="btn border-3 fw-bold {{ $currentStep != 3 ? 'border-secondary ' : 'border-primary' }}"
								style="border-radius: 50px;">3</a>
							<p class="fw-bold">Pratinjau</p>
						</div>
					</div>
				</div>
			</div>
			<div class="card-body px-3 px-md-5">
				<form wire:submit.prevent="register">
					<div class="step-one">
						<h3>Profil</h3>
						<hr>
						<div class="mb-3">
							<label for="nama_lengkap" class="form-label">Nama lengkap</label>
							<input type="text" class="form-control form-control-md @error('nama') is-invalid @enderror" wire:model="nama"
								placeholder="Masukkan Nama Lengkap" value="{{ old('nama') }}" required>
							@error('nama')
								<div class="error-message">
									{{ $message }}
								</div>
							@enderror
						</div>
						<div class="mb-3">
							<label for="email" class="form-label">Email</label>
							<input type="email" class="form-control form-control-md @error('email') is-invalid @enderror"
								wire:model="email" placeholder="Masukkan Email" value="{{ old('email') }}" required>
							@error('email')
								<div class="error-message">
									{{ $message }}
								</div>
							@enderror
						</div>
						<div class="mb-3">
							<label for="foto" class="form-label">Foto Profil</label>
							<input type="file" class="form-control form-control-md @error('foto') is-invalid @enderror" wire:model="foto"
								placeholder="Pilih Foto" value="{{ old('foto') }}" required>
							@error('foto')
								<div class="error-message">
									{{ $message }}
								</div>
							@enderror
						</div>
						<div class="mb-3 col-2">
							<label for="tanggal" class="form-label">Tanggal Lahir</label>
							<input type="date" class="form-control form-control-md @error('tanggal') is-invalid @enderror"
								wire:model="tanggal" value="{{ old('tanggal') }}" required>
							@error('tanggal')
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
										wire:model="jenis_kelamin" id="laki-laki" value="laki-laki">
									<label class="form-check-label" for="laki-laki">
										Laki-laki
									</label>
								</div>
								<div class="form-check form-check-inline">
									<input class="form-check-input @error('jenis_kelamin') is-invalid @enderror" type="radio"
										wire:model="jenis_kelamin" id="perempuan" value="perempuan">
									<label class="form-check-label" for="perempuan">
										Perempuan
									</label>
								</div>
							</div>
						</div>

						<div class="mb-3">
							<div wire:ignore>
								<label class="form-label" for="kegiatan">Kegiatan Saat Ini</label>
								<select class="form-select form-select-md select2 @error('kegiatan') is-invalid @enderror" style="height: 50%"
									wireLmodel="kegiatan" id="kegitatan">
									<option></option>
									@foreach ($kegiatan as $data)
										<option value="{{ $data }}"> {{ $data }} </option>
									@endforeach
								</select>
								@error('kegiatan')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
								@enderror
							</div>
						</div>
						<h3>Alamat Domisili Saat ini</h3>
						<hr>
						<div class="mb-3">
							<div wire:ignore>
								<label class="form-label" for="provinsi">Provinsi</label>
								<select class="form-select form-select-md select2 @error('provinsi') is-invalid @enderror" style="height: 50%"
									wireLmodel="provinsi" id="provinsi">
									<option></option>
									@foreach ($provinsi as $data)
										<option value="{{ $data }}"> {{ $data }} </option>
									@endforeach
								</select>
								@error('provinsi')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
								@enderror
							</div>
						</div>
						<div class="mb-3">
							<div wire:ignore>
								<label class="form-label" for="kota">Kota / Kabupaten</label>
								<select class="form-select form-select-md select2 @error('kota') is-invalid @enderror" style="height: 50%"
									wireLmodel="kota" id="kota">
									<option></option>
									@foreach ($kota as $data)
										<option value="{{ $data }}"> {{ $data }} </option>
									@endforeach
								</select>
								@error('kota')
									<div class="invalid-feedback">
										{{ $message }}
									</div>
								@enderror
							</div>
						</div>
						<div class="mb-3">
							<label for="poskode" class="form-label">Kode Pos</label>
							<input type="text" class="form-control form-control-md @error('poskode') is-invalid @enderror"
								wire:model="postkode" placeholder="Masukkan Kode Pos" value="{{ old('poskode') }}" required>
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

					<div class="step-two">
						<div class="row">
							<h3>Dokumen Riwayat Hidup (CV)</h3>
							<hr>
							<div class="col-12">
								<div
									class="text-center justify-content-center align-items-center p-4 p-sm-5 border border-2 border-dashed position-relative rounded-3">
									<!-- Image -->
									<img src="assets/images/element/gallery.svg" class="h-50px" alt="">
									<div>
										<h6 class="my-2">Kirim Dokumen<a href="#!" class="text-primary">Telusuri</a></h6>
										<label style="cursor:pointer;">
											<span>
												<input class="form-control stretched-link" type="file" wire:model="dokumen" id="image"
													accept="image/dosc, image/png, image/jpg, image/jpeg, image/png" required>
											</span>
										</label>
										<p class="small mb-0 mt-2"><b>Catatan:</b> Hanya Docs, PNG, JPG, JPEG dan PDF. </p>
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

					<div class="step-3">
						<div class="row">
							<div class="col">
								<h3>Pratinjau</h3>
								<hr>
								<div class="foto text-center">
									<div class="row justify-content-center">
										<div class="col">
											<img src="{{ asset('assets-user/images/avatar/04.jpg') }}" class="rounded-circle" alt="">
										</div>
										<div class="col">
											<img src="{{ asset('assets-user/images/courses/4by3/15.jpg') }}" alt="">
										</div>
									</div>
								</div>
								<h5>Profil</h5>
								<hr>
								<div class="mb-3">
									<label for="nama_lengkap" class="form-label">Nama lengkap</label>
									<input type="text" class="form-control form-control-md" wire:model="nama" value="Dadang Jebred"
										disabled>
								</div>
								<div class="mb-3">
									<label for="nama_lengkap" class="form-label">Email</label>
									<input type="email" class="form-control form-control-md" wire:model="email" value="dadang@gmail.com"
										disabled>
								</div>
								<div class="mb-3">
									<label for="tanggal" class="form-label">Tanggal Lahir</label>
									<input type="date" class="form-control form-control-md" wire:model="tanggal" value="2022-08-12"
										disabled>
								</div>
								<div class="mb-3">
									<label for="email" class="form-label">Jenis Kelamin</label>
									<div class="gender">
										<div class="form-check form-check-inline">
											<input class="form-check-input " type="radio" wire:model="jenis_kelamin" id="laki-laki"
												value="laki-laki" checked disabled>
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
									<input type="text" class="form-control form-control-md" wire:model="kegiatan" value="Ibnu Rumah Tangga"
										disabled>
								</div>
								<h5>Alamat Domisili</h5>
								<hr>
								<div class="mb-3">
									<label for="provinsi" class="form-label">Provinsi</label>
									<input type="text" class="form-control form-control-md" wire:model="provinsi" value="Jawa Barat"
										disabled>
								</div>
								<div class="mb-3">
									<label for="kota" class="form-label">Kota</label>
									<input type="text" class="form-control form-control-md" wire:model="kota" value="Bandung" disabled>
								</div>
								<div class="mb-3">
									<label for="provinsi" class="form-label">Kode Pos</label>
									<input type="text" class="form-control form-control-md" wire:model="provinsi" value="40192" disabled>
								</div>
								<div class="mb-3">
									<label for="alamat" class="form-label">Alamat Lengkap</label>
									<textarea class="form-control form-control-md" wire:model="alamat" id="alamat" cols="30" rows="5"
									 required disabled>Jl. Dadang Sujati Kecamatan Kembang Jati Mulya RT01 RW06 Kab. Tanggerang </textarea>
								</div>
								<h5>Kontak</h5>
								<hr>
								<div class="mb-3">
									<label for="telepon" class="form-label">No. Handphone</label>
									<div class="input-group input-group-md">
										<span class="input-group-text bg-light rounded-start border-1 text-secondary fw-bold text-small">+62</span>
										<input type="tel" class="form-control form-control-md " wire:model="telepon" value="82121491054"
											required disabled>
									</div>
								</div>
								<div class="mb-3">
									<label for="instagram" class="form-label">Instagram</label>
									<input type="text" class="form-control form-control-md " wire:model="instagram" value="dadang" required
										disabled>
								</div>
								<div class="mb-3">
									<label for="facebook" class="form-label">Facebook</label>
									<input type="text" class="form-control form-control-md " wire:model="facebook" value="" required
										disabled>

								</div>
								<div class="mb-3">
									<label for="website" class="form-label">Website</label>
									<input type="text" class="form-control form-control-md" wire:model="website" value="www.dadang.com"
										required>
								</div>
							</div>
						</div>
					</div>

					<div class="action-buttons d-flex justify-content-between bg-white pt-2 pb-2">
						<button type="button" class="btn btn-secaondy fw-bold" wire:click="increaseStep()">Kembali<i
								class="fas fa-arrow-left"></i></button>
						<button type="button" class="btn btn-primary fw-bold" wire:click="increaseStep()">Selanjutnya <i
								class="fas fa-arrow-right"></i></button>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>

@push('script')
	<script>
		$('.select2').on('change', function(e) {
			var data = $('.select2').select2("val");
			@this.set('kota', data);
		});
	</script>
@endpush
