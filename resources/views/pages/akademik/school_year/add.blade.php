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
                                    <div class="card-title">Form tambah Tahun Ajaran</div>
                                </div>
								<div class="card-body">
                                    <form action="{{ route('akademik.school.year.store') }}" method="POST"  enctype="multipart/form-data">
										@csrf
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <label for="tahun_ajaran">Tahun Ajaran</label>
                                                <input type="text" class="form-control" id="tahun_ajaran" name="tahun_ajaran" placeholder="Tahun Ajaran" value="{{ old('tahun_ajaran') }}" >
                                                @error('tahun_ajaran') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label for="semester">Semester</label>
                                                <select class="form-control" name="semester" id="semester" style="width: 100%" value="{{ old('semester') }}">
                                                    <option value="">- PILIH -</option>
                                                    <option value="1" {{ old('semester') == '1' ? 'selected' : '' }}>Semester 1</option>
                                                    <option value="2" {{ old('semester') == '2' ? 'selected' : '' }}>Semester 2</option>
                                                    
                                                </select>
                                                @error('semester') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                                            {{-- <div class="form-group col-md-12">
                                                <label for="status">Status</label>
                                                <select class="form-control" name="status" id="status" style="width: 100%" value="{{ old('status') }}">
                                                    <option value="">- PILIH -</option>
                                                    <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Aktif</option>
                                                    <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Non Aktif</option>
                                                    
                                                </select>
                                                @error('status') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div> --}}

                                        </div>
                                        <div class="mt-2 float-right">
                                            <a type="button" href="{{ route('akademik.school.year.index') }}" class="btn btn-warning btn-rounded ml-2">Kembali</a>
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
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/jquery.inputmask.bundle.min.js'></script>
    <script>
        $(document).ready(function(){
            
            $("#tahun_ajaran").inputmask({"mask": "9999/9999"});  
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
        

    </script>
@endsection
