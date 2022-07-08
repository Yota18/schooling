{{-- call header and footer --}}
@extends('layouts.main')
@section('title',  'Edit kategori berita')

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
                                    <div class="card-title">Form Edit kategori berita</div>
                                </div>
								<div class="card-body">
                                    <form action="{{ route('master.news.category.update', ['NewsCategory' => $category->id]) }}" method="post">
                                        @csrf
                                        @method('put')
                                        <div class="form-group">
                                            <label for="name">Nama kategori berita</label>
                                            <input type="text" class="form-control" id="name" name="name" placeholder="Nama kategori berita"  value="{{ old('name', $category->name) }}">
                                            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                                        </div>
                                        <button class="btn btn-primary btn-rounded mt-2" type="submit">Edit Kategori </button>
                                        <a href="{{ route('master.news.category.index') }}" class="btn btn-warning btn-rounded ml-2 mt-2">Kembali</a>
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

