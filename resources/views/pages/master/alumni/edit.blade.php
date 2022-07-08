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
                                    <div class="card-title">Form edit Pengguna</div>
                                </div>
								<div class="card-body">
                                    <form action="{{ route('master.users.alumni.update', ['student' => $student->id])}}" method="POST" enctype="multipart/form-data">
										@csrf
                                        @method('put')
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <label for="nis">NIS</label>
                                                <input type="text" class="form-control" id="nis" name="nis" aria-describedby="nis" placeholder="nis" value="{{ old('nis', $student->nis) }}" >
                                                @error('nis') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="nisn">NISN</label>
                                                <input type="text" class="form-control" id="nisn" name="nisn" aria-describedby="nisn" placeholder="nisn" value="{{ old('nisn', $student->nisn) }}" >
                                                @error('nisn') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="name">Nama</label>
                                                <input type="text" class="form-control" id="name" name="name" aria-describedby="name" placeholder="Nama" value="{{ old('name', $student->user->name) }}" >
                                                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="email">Email</label>
                                                <input type="email" class="form-control" id="email" name="email" aria-describedby="email" placeholder="Email" value="{{ old('email', $student->user->email) }}"  >
                                                @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="class">Kelas</label>
                                                <select class="form-control" name="class" id="class" style="width: 100%">
                                                    <option value="">- PILIH -</option>
                                                    @foreach ($classes as $class)
                                                        <option value="{{ $class->id }}" {{ old('class', $student->classes_id) == $class->id ? 'selected' : '' }}>{{ strtoupper($class->code)  }}</option>
                                                    @endforeach
                                                    
                                                </select>
                                                @error('class') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="gender">Jenis Kelamin</label>
                                                <select class="form-control" name="gender" id="gender" style="width: 100%" value="{{ old('gender') }}">
                                                    <option value="">- PILIH -</option>
                                                    <option value="Laki-Laki" {{ old('gender', $student->gender) == 'Laki-Laki' ? 'selected' : '' }}>Laki-Laki</option>
                                                    <option value="Perempuan" {{ old('gender', $student->gender) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                                    
                                                </select>
                                                @error('gender') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="birthplace">Tempat Lahir</label>
                                                <input type="text" class="form-control" id="birthplace" name="birthplace" placeholder="Tempat lahir" value="{{ old('birthplace', $student->birthplace) }}" >
                                                @error('birthplace') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="birthdate">Tanggal Lahir</label>
                                                <input type="date" class="form-control" id="birthdate" name="birthdate"  placeholder="Tanggal lahir" value="{{ old('birthdate', $student->birthdate) }}"  >
                                                @error('birthdate') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="religion">Agama</label>
                                                <input type="text" class="form-control" id="religion" name="religion"  placeholder="Agama" value="{{ old('religion', $student->religion) }}"  >
                                                @error('religion') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="phone">Telepon</label>
                                                <input type="text" class="form-control" id="phone" name="phone"  placeholder="Telepon" value="{{ old('phone', $student->phone) }}"  >
                                                @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="generation">Angkatan</label>
                                                <input type="text" class="form-control" id="generation" name="generation"  placeholder="Angkatan" value="{{ old('generation', $student->generation) }}"  >
                                                @error('generation') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="status">Status</label>
                                                <select class="form-control" name="status" id="status" style="width: 100%" value="{{ old('status') }}">
                                                    <option value="">- PILIH -</option>
                                                    <option value="1" {{ old('status', $student->user->is_active) == '1' ? 'selected' : '' }}>Aktif</option>
                                                    <option value="0" {{ old('status', $student->user->is_active) == '0' ? 'selected' : '' }}>Non Aktif</option>
                                                    
                                                </select>
                                                @error('status') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                                            
                                            <div class="form-group col-md-12">
                                                <label for="address">Alamat</label>
                                                <textarea name="address" id="address" class="form-control" rows="5">{{ old('address', $student->address) }}</textarea>
                                                @error('address') <span class="text-danger">{{ $message }}</span> @enderror
                                            </div>
                                            
                                        </div>
                                        <div class="mt-2 float-right">
                                            <a type="button" href="{{ route('master.users.alumni.index') }}" class="btn btn-warning btn-rounded ml-2">Kembali</a>
                                            <button type="submit" class="btn btn-primary btn-rounded ml-2 ">Edit admin</button>
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
