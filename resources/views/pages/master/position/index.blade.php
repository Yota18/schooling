{{-- call header and footer --}}
@extends('layouts.main')

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
                                <h2 class="text-white pb-2 fw-bold">Daftar Jabatan</h2>
                                <h5 class="text-white op-7 mb-2">Kelola daftar jabatan disini.</h5>
                            </div>
                            <div class="ml-md-auto py-2 py-md-0">
                                <a href="{{ route('master.jabatan.add') }}" class="btn btn-secondary btn-round"><i class="fa fa-plus-circle mr-2" aria-hidden="true"></i>Tambah Jabatan baru</a>
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
													<th>Name</th>
													<th>Jabatan</th>
													<th>Action</th>
												</tr>
											</thead>
											<tfoot>
												<tr>
													<th>Name</th>
													<th>Jabatan</th>
													<th>Action</th>
												</tr>
											</tfoot>
											<tbody>

                                            </tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
                </div>
            </div>
        </div>
    </div>
</body>

@endsection

@section('js')
    <script>
        var table;
        var _token = "{{ csrf_token() }}";
        var title = 'Jabatan';
        var columns = [0, 1];
        $(document).ready(function() {
            table =  $('#basic-datatables').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                // ordering: false,
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
                    url : '{!! route('master.jabatan.data') !!}',
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
                    {
                        data: 'id',
                        render: function(data, type, row){
                            var url_edit = "{{ \Request::url() }}/edit"+"/"+data;
                            return '\
                            <a href="'+url_edit+'" class="btn btn-xs btn-warning my-1">Edit</a>\
                            <button class="btn btn-xs btn-danger my-1" id="delete" onclick="delete_data('+data+', \'jabatan\')">Hapus</button>';
                        }
                    },
                ]
				
			});
        })
		
    </script>
 @include('layouts.swal')
@endsection
