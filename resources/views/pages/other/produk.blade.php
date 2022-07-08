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
                                <h2 class="text-white pb-2 fw-bold">List Product</h2>
                                <h5 class="text-white op-7 mb-2"></h5>
                            </div>
                            <div class="ml-md-auto py-2 py-md-0">
                                <a href="#" class="btn btn-secondary btn-round"><i class="fa fa-plus-circle mr-2" aria-hidden="true"></i>Add Product</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="page-inner mt--5">
                    <div class="row">
                        <div class="col-md-3">
							<div class="card card-post card-round">
								<img class="card-img-top" src="../assets/img/blogpost.jpg" alt="Card image cap">
								<div class="card-body">
									<div class="d-flex">
										<div class="info-post">
											<p class="username">Bubuk Kunyit/Turmeric Powder Bumbu Tabur Bumbu dapur masakan - 500 gr</p>
											<p class="date text-muted">Stok : 20</p>
										</div>
									</div>
									<div class="separator-solid"></div>
									<p class="card-category text-info mb-1"><a href="#">Rp.39.000</a></p>
									<h3 class="card-title">
										<a href="#">
											
										</a>
									</h3>
									<a href="#" class="btn btn-info btn-rounded btn-sm mr-1 mb-1"><i class="fas fa-percent mr-1"></i>Kelola Diskon</a>
									<a href="#" class="btn btn-warning btn-rounded btn-sm mr-1 mb-1"><i class="fas fa-pencil-alt mr-1" aria-hidden="true"></i>Edit</a>
                                    <a href="#" class="btn btn-danger btn-rounded btn-sm mr-1 mb-1"><i class="fa fa-trash mr-1" aria-hidden="true"></i>Delete</a>
								</div>
							</div>
						</div>
                        <div class="col-md-3">
							<div class="card card-post card-round">
								<img class="card-img-top" src="../assets/img/blogpost.jpg" alt="Card image cap">
								<div class="card-body">
									<div class="d-flex">
										<div class="info-post">
											<p class="username">Bubuk Kunyit/Turmeric Powder Bumbu Tabur Bumbu dapur masakan - 500 gr</p>
											<p class="date text-muted">Stok : 20</p>
										</div>
									</div>
									<div class="separator-solid"></div>
									<p class="card-category text-info mb-1"><a href="#">Rp.39.000</a></p>
									<h3 class="card-title">
										<a href="#">
											
										</a>
									</h3>
									<a href="#" class="btn btn-info btn-rounded btn-sm mr-1 mb-1"><i class="fas fa-percent mr-1"></i>Kelola Diskon</a>
									<a href="#" class="btn btn-warning btn-rounded btn-sm mr-1 mb-1"><i class="fas fa-pencil-alt mr-1" aria-hidden="true"></i>Edit</a>
                                    <a href="#" class="btn btn-danger btn-rounded btn-sm mr-1 mb-1"><i class="fa fa-trash mr-1" aria-hidden="true"></i>Delete</a>
								</div>
							</div>
						</div>
                        <div class="col-md-3">
							<div class="card card-post card-round">
								<img class="card-img-top" src="../assets/img/blogpost.jpg" alt="Card image cap">
								<div class="card-body">
									<div class="d-flex">
										<div class="info-post">
											<p class="username">Bubuk Kunyit/Turmeric Powder Bumbu Tabur Bumbu dapur masakan - 500 gr</p>
											<p class="date text-muted">Stok : 20</p>
										</div>
									</div>
									<div class="separator-solid"></div>
									<p class="card-category text-info mb-1"><a href="#">Rp.39.000</a></p>
									<h3 class="card-title">
										<a href="#">
											
										</a>
									</h3>
									<a href="#" class="btn btn-info btn-rounded btn-sm mr-1 mb-1"><i class="fas fa-percent mr-1"></i>Kelola Diskon</a>
									<a href="#" class="btn btn-warning btn-rounded btn-sm mr-1 mb-1"><i class="fas fa-pencil-alt mr-1" aria-hidden="true"></i>Edit</a>
                                    <a href="#" class="btn btn-danger btn-rounded btn-sm mr-1 mb-1"><i class="fa fa-trash mr-1" aria-hidden="true"></i>Delete</a>
								</div>
							</div>
						</div>
                        <div class="col-md-3">
							<div class="card card-post card-round">
								<img class="card-img-top" src="../assets/img/blogpost.jpg" alt="Card image cap">
								<div class="card-body">
									<div class="d-flex">
										<div class="info-post">
											<p class="username">Bubuk Kunyit/Turmeric Powder Bumbu Tabur Bumbu dapur masakan - 500 gr</p>
											<p class="date text-muted">Stok : 20</p>
										</div>
									</div>
									<div class="separator-solid"></div>
									<p class="card-category text-info mb-1"><a href="#">Rp.39.000</a></p>
									<h3 class="card-title">
										<a href="#">
											
										</a>
									</h3>
									<a href="#" class="btn btn-info btn-rounded btn-sm mr-1 mb-1"><i class="fas fa-percent mr-1"></i>Kelola Diskon</a>
									<a href="#" class="btn btn-warning btn-rounded btn-sm mr-1 mb-1"><i class="fas fa-pencil-alt mr-1" aria-hidden="true"></i>Edit</a>
                                    <a href="#" class="btn btn-danger btn-rounded btn-sm mr-1 mb-1"><i class="fa fa-trash mr-1" aria-hidden="true"></i>Delete</a>
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

