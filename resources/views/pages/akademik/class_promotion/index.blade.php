{{-- call header and footer --}}
@extends('layouts.main')
@section('title',  'Pengguna')

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
                                <h2 class="text-white pb-2 fw-bold">Kelas {{ $kelas->name.' '.$kelas->major->code }} </h2>
                                <h5 class="text-white op-7 mb-2">Kelola informasi Kelas {{ $kelas->name.' '.$kelas->major->code }}.</h5>
                            </div>
                            <div class="ml-md-auto py-2 py-md-0">
                                {{-- <a href="{{ route('akademik.pindah.class.add', ['class' => $kelas->code]) }}" class="btn btn-secondary btn-round"><i class="fa fa-plus-circle mr-2" aria-hidden="true"></i>Tambah Pelajaran</a> --}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="page-inner mt--5">
					<form action="{{ route('akademik.pindah.class.store', ['class' => $kelas->code	])}}" method="POST">
						@csrf
                    <div class="row">
						<div class="col-md-8">
							<div class="card">
								<div class="card-body">
									<div class="table-responsive">
										<table id="basic-datatables" class="display table table-striped table-hover" >
											<thead>
                                                <tr>
                                                    <th>No</th>
													<th>Nama Siswa</th>
													<th>NISN</th>
													<th style="text-align:center;"><input class="pindahAll" type="checkbox"></th>
												</tr>
											</thead>
											<tfoot>
												<tr>
													<th>No</th>
													<th>Nama Siswa</th>
													<th>NISN</th> 
													<th style="text-align:center;"><input class="pindahAll" type="checkbox"></th>
												</tr>
											</tfoot>
											<tbody>
												@foreach ($students as $student)
													
												<tr>
													<td>{{ $loop->iteration }}</td>
													<td>{{ $student->user->name }}</td>
													<td>{{ $student->nisn }}</td>
													<td style="text-align:center;">
														<input class="pilihSiswa" type="checkbox" name="siswa[]" value="{{ $student->id }}">
														{{-- <a href="{{ route('admin.users.edit', ['user' => $student->id]) }}" class="btn btn-warning btn-sm m-1"><i class="fas fa-pencil-alt mr-1"></i> Edit</a>
														<button type="button" id="delete" class="btn btn-danger btn-sm m-1" data-id="{{ $student->id }}"><i class="fas fa-trash mr-1"></i> Hapus</button> --}}
													</td>
												</tr>
												
												@endforeach
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="card">
								<div class="card-body">
									
									<div class="form-group col-md-12">
										<label for="kelas_dest">Kelas Tujuan</label>
										{{-- <input type="hidden" name="students[]"> --}}
										<select class="form-control" name="kelas_dest" id="kelas_dest" style="width: 100%" value="{{ old('kelas_dest') }}">
											<option value="">- PILIH -</option>
											@foreach ($classes as $class)
											<option value="{{ $class->id }}" {{ $kelas->id == $class->id ? 'disabled' : '' }}>{{ strtoupper($class->code) }}{{ $kelas->id == $class->id ? ' | Kelas saat ini' : '' }}</option> 
											@endforeach
											<option value="alumni">Alumni</option>
											
										</select>
										@error('kelas_dest') <span class="text-danger"> {{ $message }}</span> @enderror
									</div>
									<button type="submit" class="btn btn-primary mr	-2" style="float: right;">Pindah</button>
								</div>
							</div>
						</div>
					</div>
							
					</form>
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
			$('.pindahAll').on('click',function(){
				if(this.checked){
					$('.pilihSiswa').each(function(){
						this.checked = true;
					});
					$('.pindahAll').each(function(){
						this.checked = true;
					});
				}else{
					$('.pilihSiswa').each(function(){
						this.checked = false;
					});
					$('.pindahAll').each(function(){
						this.checked = false;
					});
				}
			});
			
			$('.pilihSiswa').on('click',function(){
				if($('.pilihSiswa:checked').length == $('.pilihSiswa').length){
					$('.pindahAll').prop('checked',true);
				}else{
					$('.pindahAll').prop('checked',false);
				}
			});
		});
		var table;
		var _token = "{{ csrf_token() }}";
		var title = 'Kelas {{ $kelas->name.' '.$kelas->major->code }}';
		var columns = [0, 1, 2];
        $(document).ready(function() {
			table =  $('#basic-datatables').DataTable({});
			
		});	
	</script>
	@include('layouts.swal')
@endsection
