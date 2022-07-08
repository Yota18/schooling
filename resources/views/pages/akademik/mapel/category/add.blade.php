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
                                    <div class="card-title">Form tambah Kategori Pelajaran</div>
                                </div>
								<div class="card-body">
                                    <form action="{{ route('akademik.mapel.category.store') }}" method="POST"  enctype="multipart/form-data">
										@csrf
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <label for="category_pelajaran">Kategori Pelajaran</label>
                                                <input type="text" class="form-control" id="category_pelajaran" name="category_pelajaran" placeholder="Kategori Pelajaran" value="{{ old('category_pelajaran') }}" >
                                                @error('category_pelajaran') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                                            
                                            <div class="form-group col-md-12">
                                                <label for="status">Status</label>
                                                <select class="form-control" name="status" id="status" style="width: 100%" value="{{ old('status') }}">
                                                    <option value="">- PILIH -</option>
                                                    <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Aktif</option>
                                                    <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Non Aktif</option>
                                                    
                                                </select>
                                                @error('status') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>

                                        </div>
                                        <div class="mt-2 float-right">
                                            <a type="button" href="{{ route('akademik.mapel.category.index') }}" class="btn btn-warning btn-rounded ml-2">Kembali</a>
                                            <button type="submit" class="btn btn-primary btn-rounded ml-2">Tambah Kategori</button>
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
        $(document).ready(function(){
            $("#tahun_ajaran").inputmask("9999/9999");
            
            // $("#tahun_ajaran").inputmask({"mask": "9999/9999"});  
            // $(".tgl").inputmask("99-99-9999");  
            // $(".jam").inputmask("99:99");  
            // $('.select2').select2();
            // $('.rupiah').inputmask('decimal', {allowMinus:false, autoGroup: true, groupSeparator: '.', rightAlign: false, autoUnmask: true, removeMaskOnSubmit: true});
            // $(".tglcalendar").datepicker({
            //     todayHighlight: true,
            //     autoclose: true,
            //     format: "dd-mm-yyyy"
            // });  
        });
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
