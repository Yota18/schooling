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
                                <h2 class="text-white pb-2 fw-bold">Pengguna </h2>
                                <h5 class="text-white op-7 mb-2">Kelola informasi Pengguna.</h5>
                            </div>
                            <div class="ml-md-auto py-2 py-md-0">
                                <a href="{{ route('akademik.users.admin.add') }}" class="btn btn-secondary btn-round"><i class="fa fa-plus-circle mr-2" aria-hidden="true"></i>Tambah Pengguna</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="page-inner mt--5">
                    <div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-body">
									<div class="table-responsive">
										<table id="basic-datatables" class="display table table-striped table-hover" >
											<thead>
                                                <tr>
                                                    <th>No</th>
													<th>Nama</th>
													<th>Email</th>
													<th>Level</th>
													<th>Aktif</th>
													<th>Aksi</th>
												</tr>
											</thead>
											<tfoot>
												<tr>
													<th>No</th>
													<th>Nama</th>
													<th>Email</th>
													<th>Level</th>
													<th>Aktif</th>
													<th>Aksi</th>
												</tr>
											</tfoot>
											<tbody>
												{{-- @foreach ($users as $user)
													
												<tr>
													<td>{{ $loop->iteration }}</td>
													<td>{{ $user->name }}</td>
													<td>{{ $user->email }}</td>
													<td>{{ $user->status }}</td>
													<td>
														@if ($user->is_active)
															<button onclick="set_switch({{ $user->id }} , {{ $user->is_active }})" class="btn btn-sm btn-success">Active</button>
														@else
															<button onclick="set_switch({{ $user->id }} , {{ $user->is_active }})" class="btn btn-sm btn-dark">Not Active</button>
														@endif
														</td>
													<td>
														<a href="{{ route('admin.users.edit', ['user' => $user->id]) }}" class="btn btn-warning btn-sm m-1"><i class="fas fa-pencil-alt mr-1"></i> Edit</a>
														<button type="button" id="delete" class="btn btn-danger btn-sm m-1" data-id="{{ $user->id }}"><i class="fas fa-trash mr-1"></i> Hapus</button>
													</td>
												</tr>
												
												@endforeach --}}
											</tbody>
										</table>
									</div>
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
					url : '{!! route('akademik.users.admin.data') !!}',
					type : 'POST',
					data: {_token:_token},
				},
				columns: [
					{ data: 'id',
						render: function (data, type, row, meta) {
							return meta.row + meta.settings._iDisplayStart + 1;
						} 
					},
					{ data: 'name' },
					{ data: 'email' },
					{ 
						data: 'position.name',
						render: function(data, type, row){
							return '<div class="text-capitalize">'+data+'</div>';
						}
					},
					{
						data: 'id',
						render: function(data, type, row) {
							
							if(row.is_active == 1){
								// id,isactive
								return '\
								<a onclick="set_switch('+ data +','+ row.is_active +')" data-toggle="tooltip" title="Aktif">\
									<button type="button" class="btn btn-sm btn-success mt-1 mb-1"><i class="fas fa-toggle-on"></i> Aktif</button>\
								</a>';
							}else{
								return '\
								<a onclick="set_switch('+ data +','+ row.is_active +')" data-toggle="tooltip" title="Non Aktif">\
									<button type="button" class="btn btn-sm btn-black mt-1 mb-1"><i class="fas fa-toggle-off"></i> Non Aktif</button>\
								</a>'; 
								
							}
						}
					},
					{
						data: 'id',
						render: function(data, type, row){
							var url_edit = "{{url('/akademik/user/admin/edit')}}"+"/"+data;
							return '\
							<a href="'+url_edit+'" class="btn btn-xs btn-warning my-1">Edit</a>\
							<button class="btn btn-xs btn-danger my-1" id="delete" onclick="delete_data('+data+', \'user/admin\')">Delete</button>';
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
				url: '{!! route('master.users.admin.switch') !!}',
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
