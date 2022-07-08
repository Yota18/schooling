{{-- call header and footer --}}
@extends('layouts.main')
@section('title',  'Setting Kelas')

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
                                <h2 class="text-white pb-2 fw-bold">Kenaikan / Pindah Kelas</h2>
                                <h5 class="text-white op-7 mb-2">Kelola informasi Kenaikan / Pindah Kelas.</h5>
                            </div>
                            {{-- <div class="ml-md-auto py-2 py-md-0">
                                <a href="{{ route('master.users.staff.add') }}" class="btn btn-secondary btn-round"><i class="fa fa-plus-circle mr-2" aria-hidden="true"></i>Tambah Setting Kelas</a>
                            </div> --}}
                        </div>
                    </div>
                </div>
                <div class="page-inner mt--5">
                    <div class="row">
						@foreach ($classes as $class)

							<a href="{{ route('akademik.pindah.class.index', ['class'=>$class->code]) }}">
								<div class="col-sm-6 col-lg-3">
									<div class="card p-3">
										<div class="d-flex align-items-center">
											<span class="stamp stamp-md bg-{{ $warnanya[array_rand($warnanya)]  }} mr-3">
												{{ $class->name }}
											</span>
											<div>
												<h5 class="mb-1"><b><a href="{{ route('akademik.pindah.class.index', ['class'=>$class->code]) }}">{{ $class->siswa }} <small>Siswa</small></a></b></h5>
												<small class="text-muted">{{ $class->mapel }} mata pelajaran</small>
											</div>
										</div>
									</div>
								</div>
							</a>
							
						@endforeach
						
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
		var table;
		var _token = "{{ csrf_token() }}";
		var title = 'Pengguna';
		var columns = [0, 1, 2, 3];
        $(document).ready(function() {
			table =  $('#basic-datatables').DataTable({
				processing: true,
				serverSide: true,
                responsive: true,
				"lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "All"]],
                dom: 'Bflrtip',

                buttons: [
                    {
						extend: 'print',
						titleAttr: 'Print',
						exportOptions: {
							columns: columns
						},
						title: title,
						footer: true,
					},
                    {
						extend: 'excel',
						titleAttr: 'Excel',
						exportOptions: {
							columns: columns
						},
						title: title,
						footer: true,
					},
                    {
						extend: 'pdf',
						titleAttr: 'Pdf',
						exportOptions: {
							columns: columns
						},
						title: title,
						footer: true,
					},
                    {
						extend: 'csv',
						titleAttr: 'Csv',
						exportOptions: {
							columns: columns
						},
						title: title,
						footer: true,
					},
                    {
						extend: 'copy',
						titleAttr: 'Copy',
						exportOptions: {
							columns: columns
						},
						title: title,
						footer: true,
					},
                ],
				ajax: {
					url : '{!! route('master.users.staff.data') !!}',
					type : 'POST',
					data: {_token:_token},
				},
				columns: [
					{ data: 'id',
						render: function (data, type, row, meta) {
							return meta.row + meta.settings._iDisplayStart + 1;
						} 
					},
					{ data: 'user.name' },
					{ data: 'user.email' },
					{ data: 'user.position.name' },
					
					{
						data: 'id',
						render: function(data, type, row) {
							
							if(row.user["is_active"] == 1){
								// id,isactive
								return '\
								<a onclick="set_switch('+ data +','+ row.user["is_active"] +')" data-toggle="tooltip" title="Aktif">\
									<button type="button" class="btn btn-sm btn-success mt-1 mb-1"><i class="fas fa-toggle-on"></i> Aktif</button>\
								</a>';
							}else{
								return '\
								<a onclick="set_switch('+ data +','+ row.user["is_active"] +')" data-toggle="tooltip" title="Non Aktif">\
									<button type="button" class="btn btn-sm btn-black mt-1 mb-1"><i class="fas fa-toggle-off"></i> Non Aktif</button>\
								</a>'; 
								
							}
						}
					},
					{
						data: 'id',
						render: function(data, type, row){
							var url_edit = "{{url('/admin/user/staff/edit')}}"+"/"+data;
							return '\
							<a href="'+url_edit+'" class="btn btn-xs btn-warning my-1">Edit</a>\
							<button class="btn btn-xs btn-danger my-1" id="delete" onclick="delete_data('+row.user["id"]+', \'user/admin\')">Delete</button>';
						}
					},
				]
			});
			
		})
		// Switch Active
		function set_switch(id,isactive){
			$.ajax({
				type: 'POST',
				data: { 
					_token : _token,
					id: id,
					isactive: isactive,
				},
				url: '{!! route('master.users.staff.switch') !!}',
				dataType: 'JSON',
				success: function (data) {
					if (data.status == 'success') {
						table.ajax.reload(null, false);
						Swal.fire(
							'Success!',
							data.message,
							'success',
						)
					} else {
						table.ajax.reload(null, false);
						Swal.fire(
							'Oops...',
							data.message,
							'error',
						)
					}
				},
				error: function (ajaxContext) {
					Swal.fire(
						'Oops...',
						'The action you have requested is not allowed.',
						'error',
					)
				}
			});
		}
		
		</script>
		@include('layouts.swal')
@endsection
