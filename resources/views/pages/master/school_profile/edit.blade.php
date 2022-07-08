{{-- call header and footer --}}
@extends('layouts.main')
@section('title',  'Edit pengguna')

@section('content')

<body>
    <div class="wrapper">
        {{-- call header --}}
        @include('layouts.header')
        {{-- call sidebar --}}
        @include('layouts.sidebar')

        <div class="main-panel">
			<div class="content">
                <div class="panel-header bg-primary-gradient">
                    <div class="page-inner py-5">
                        <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                            <div>
                                <h2 class="text-white pb-2 fw-bold"></h2>
                                <h5 class="text-white op-7 mb-2"></h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="page-inner mt--5">
                    <div class="row">
						<div class="col-md-8">
							<div class="card">
                                <div class="card-header card-info">
                                    <div class="card-title">Setting data sekolah</div>
                                </div>
								<div class="card-body">
                                    <form action="{{ route('master.school.profile.update')}}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('put')
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <label for="nama_sekolah">Nama Sekolah</label>
                                                <input type="text" class="form-control" id="nama_sekolah" name="nama_sekolah" aria-describedby="nama_sekolah" value="{{ old('nama_sekolah', $school->name) }}" >
                                                  @error('nama_sekolah') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="npsn">NPSN</label>
                                                <input type="text" class="form-control" id="npsn" name="npsn" aria-describedby="npsn" value="{{ old('npsn', $school->npsn) }}"  >
                                                @error('npsn') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                                            
                                            <div class="form-group  col-md-6">
                                                <label for="youtube">Youtube</label>
                                                <input type="text" class="form-control" id="youtube" name="youtube" aria-describedby="youtube" value="{{ old('youtube', $school->youtube) }}"  >
                                                @error('youtube') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="nss">NSS</label>
                                                <input type="text" class="form-control" id="nss" name="nss" aria-describedby="nss" value="{{ old('nss', $school->nss) }}"  >
                                                @error('nss') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                                            <div class="form-group  col-md-6">
                                                <label for="whatsapp">Whatsapp</label>
                                                <input type="text" class="form-control" id="whatsapp" name="whatsapp" aria-describedby="whatsapp" value="{{ old('whatsapp', $school->whatsapp) }}"  >
                                                @error('whatsapp') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                                            <div class="form-group  col-md-6">
                                                <label for="email">Email</label>
                                                <input type="email" class="form-control" id="email" name="email" aria-describedby="email" value="{{ old('email', $school->email) }}"  >
                                                @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                                            <div class="form-group  col-md-6">
                                                <label for="instagram">Instagram</label>
                                                <input type="text" class="form-control" id="instagram" name="instagram" aria-describedby="instagram" value="{{ old('instagram', $school->instagram) }}"  >
                                                @error('instagram') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                                            
                                            <div class="form-group  col-md-6">
                                                <label for="website">Website</label>
                                                <input type="text" class="form-control" id="website" name="website" aria-describedby="website" value="{{ old('website', $school->website) }}"  >
                                                @error('website') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                                            <div class="form-group  col-md-6">
                                                <label for="facebook">Facebook</label>
                                                <input type="text" class="form-control" id="facebook" name="facebook" aria-describedby="facebook" value="{{ old('facebook', $school->facebook) }}"  >
                                                @error('facebook') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                                            <div class="form-group  col-md-6">
                                                <label for="alamat">Alamat</label>
                                                <textarea class="form-control" id="alamat" name="alamat" rows="7" aria-describedby="alamat">{{ old('alamat', $school->address) }}</textarea>
                                                @error('alamat') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                                <p style="font-weight: 600">Logo Sekolah</p>
                                                <img src="{{ $school->image_url }}"  class="img-preview img-fluid mb-3" @if ($school->image == null)  style="display: none" @endif >
                                                <p id="file-name"></p>
                                                <label class="image-label" for="image"><i class="fas fa-file-upload"></i><span>Cari File</span></label>
                                                <input type="file" class="form-control-file" id="image" name="logo" onchange="previewImage()">
                                                <div class="info">
                                                    <p>Max size : 1MB</p>
                                                </div>
                                                @error('logo') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div><br>
                                            <div >
                                                <button type="submit" class="btn btn-primary btn-rounded ml-2 ">Edit Profil Sekolah</button>
                                            </div>
                                        </div>
                                    </form>
								</div>
							</div>
						</div>
					</div>
                </div>
            </div>
            <footer class="footer">
				<div class="container-fluid">
					
					<div class="copyright ml-auto">
						{{ date("Y") }}, made with <i class="fa fa-heart heart text-danger"></i> by <a href="https://www.tupaitech.net">Tupai Tech</a>
					</div>				
				</div>
			</footer>
        </div>
    </div>
</body>

@endsection

@section('js')
    <script>
            // thumbnail
            function previewImage() {
				const image = document.querySelector('#image');
				const imagePreview = document.querySelector('.img-preview');
				let filename = document.getElementById('file-name');
				imagePreview.style.display='block';

				const oFReader = new FileReader();
				oFReader.readAsDataURL(image.files[0]);
				filename.innerHTML = image.files[0].name;

				oFReader.onload =function (oFREvent) {
					imagePreview.src = oFREvent.target.result;					
				}
			}

        var editor = CKEDITOR.replace("editor1", {
                height: 200,
            });
            CKFinder.setupCKEditor(editor);
            var editor2 = CKEDITOR.replace("editor2", {
                height: 200,
            });
            CKFinder.setupCKEditor(editor2);
    </script>
@endsection
