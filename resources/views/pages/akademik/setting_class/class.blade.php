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
                                <h2 class="text-white pb-2 fw-bold">Setting Kelas</h2>
                                <h5 class="text-white op-7 mb-2">Kelola informasi Setting Kelas.</h5>
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

							<a href="{{ route('akademik.setting.class.index', ['class'=>$class->code]) }}">
								<div class="col-sm-6 col-lg-3">
									<div class="card p-3">
										<div class="d-flex align-items-center">
											<span class="stamp stamp-md bg-{{ $warnanya[array_rand($warnanya)]  }} mr-3">
												{{ $class->name }}
											</span>
											<div>
												<h5 class="mb-1"><b><a href="{{ route('akademik.setting.class.index', ['class'=>$class->code]) }}">{{ $class->siswa }} <small>Siswa</small></a></b></h5>
												<small class="text-muted">{{ $class->mapel }} mata pelajaran</small>
											</div>
											@if (!$class->status)
												<span class="badge badge-danger" style="float: right"> Non Aktif</span>
											@endif
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
    
@endsection
