{{-- call header and footer --}}
@extends('layouts.main')
@section('title',  'Edit karir')

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
                                    <div class="card-title">Form edit jabatan</div>
                                </div>
								<div class="card-body">
                                <form action="{{ route('master.jabatan.update', ['position' => $jabatan->id]) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('put')
                                    <div class="form-group">
                                        <label for="name">Nama jabatan</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Nama jabatan" value="{{ old('name', $jabatan->name) }}">
                                        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    
                                    <button class="btn btn-primary btn-rounded mt-2">Edit jabatan </button>
                                    <a href="{{ route('master.jabatan.index') }}" class="btn btn-warning btn-rounded ml-2">Kembali</a>
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

            // stock format
            $('input[name="_stock_"]').on('keyup focusin focusout ', function(event) {
                if (event.which >= 37 && event.which <= 40) return;
                $(this).val(function(index, value) {
                    return value.replace(/\D/g, "");
                });
            });
            // price format
            $('input[name="_price_"]').on('keyup focusin focusout ', function(event) {
                if (event.which >= 37 && event.which <= 40) return;
                // format number
                $(this).val(function(index, value) {
                    return "Rp. " + value.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                });
            });

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
