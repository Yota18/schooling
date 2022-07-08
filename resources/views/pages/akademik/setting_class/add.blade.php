{{-- call header and footer --}}
@extends('layouts.main')
@section('title',  'Tambah pengguna')

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
						<div class="col-md-7">
							<div class="card">
                                <div class="card-header card-info">
                                    <div class="card-title">Form tambah Mata pelajaran kelas </div>
                                </div>
								<div class="card-body">
                                    <form action="{{ route('akademik.setting.class.store', ['class'=> $kelas->code]) }}" method="POST"  enctype="multipart/form-data">
										@csrf
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <label for="pelajaran">Mata Pelajaran</label>
                                                <select class="form-control" name="pelajaran" id="pelajaran" style="width: 100%" value="{{ old('pelajaran') }}">
                                                    <option value="">- PILIH -</option>
                                                    @foreach ($subjects as $subject)
                                                        <option value="{{ $subject->id }}" {{ old('pelajaran') == $subject->id ? 'selected' : '' }}>{{ $subject->name }}</option>
                                                    @endforeach
                                                    
                                                </select>
                                                @error('pelajaran') <span class="text-danger">Mata {{ $message }}</span> @enderror
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label for="pengajar">Guru Pengajar</label>
                                                <select class="form-control" name="pengajar" id="pengajar" style="width: 100%" value="{{ old('pengajar') }}">
                                                    <option value="">- PILIH -</option>
                                                    @foreach ($teachers as $teacher)
                                                        <option value="{{ $teacher->id }}" {{ old('pengajar') == $teacher->id ? 'selected' : '' }}>{{ $teacher->user->name }}</option> 
                                                    @endforeach
                                                    
                                                </select>
                                                @error('pengajar') <span class="text-danger">Guru {{ $message }}</span> @enderror
                                            </div>

                                        </div>
                                        <div class="mt-2 float-right">
                                            <a type="button" href="{{ route('akademik.setting.class.index', ['class' => $kelas->code]) }}" class="btn btn-warning btn-rounded ml-2">Kembali</a>
                                            <button type="submit" class="btn btn-primary btn-rounded ml-2">Tambah Jurusan</button>
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
