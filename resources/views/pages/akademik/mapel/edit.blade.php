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
                                    <div class="card-title">Form edit Pelajaran</div>
                                </div>
								<div class="card-body">
                                    <form action="{{ route('akademik.mapel.update', ['subject' => $mapel->id])}}" method="POST" enctype="multipart/form-data">
										@csrf
                                        @method('put')
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label for="pelajaran">Nama Pelajaran</label>
                                                <input type="text" class="form-control" id="pelajaran" name="pelajaran" placeholder="Nama Pelajaran" value="{{ old('pelajaran',  $mapel->name) }}" >
                                                @error('pelajaran') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="code">Kode Pelajaran</label>
                                                <input type="text" class="form-control" id="code" name="code" placeholder="Kode Pelajaran" value="{{ old('code',  $mapel->code) }}" >
                                                @error('code') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="category_pelajaran">Kategori Pelajaran</label>
                                                <select class="form-control" name="category_pelajaran" id="category_pelajaran" style="width: 100%" value="{{ old('category_pelajaran') }}">
                                                    <option value="">- PILIH -</option>
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}" {{ old('category_pelajaran', $mapel->category_subject_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                                    @endforeach
                                                    
                                                </select>
                                                @error('category_pelajaran') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="status">Status</label>
                                                <select class="form-control" name="status" id="status" style="width: 100%" value="{{ old('status') }}">
                                                    <option value="">- PILIH -</option>
                                                    <option value="1" {{ old('status',  $mapel->status) == '1' ? 'selected' : '' }}>Aktif</option>
                                                    <option value="0" {{ old('status',  $mapel->status) == '0' ? 'selected' : '' }}>Non Aktif</option>
                                                    
                                                </select>
                                                @error('status') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                                        </div>
                                        <div class=" float-right my-2">
                                            <a type="button" href="{{ route('akademik.mapel.index') }}" class="btn btn-warning btn-rounded ml-2">Kembali</a>
                                            <button type="submit" class="btn btn-primary btn-rounded ml-2 ">Edit Pelajaran</button>
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
