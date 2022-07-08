@extends('layouts.main')

@section('content')

<body>
	<div class="wrapper">
		@include('layouts.header')

		@include('layouts.sidebar')

		<div class="main-panel">
			<div class="content">
				<div class="panel-header bg-primary-gradient">
					<div class="page-inner py-5">
						<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
							<div>
								<h2 class="text-white pb-2 fw-bold">Edit Access Key</h2>
								{{-- <h5 class="text-white op-7 mb-2">Free Bootstrap 4 Admin Dashboard</h5> --}}
							</div>
						</div>
					</div>
				</div>
				<div class="page-inner mt--5">
                    <div class="row mt--2">
                        <div class="col-md-4">
							<div class="card full-height">
								<div class="card-body">
									<form action="{{route('accesskey.update', ['apiUser'=>$accessKey->id])}}" method="POST">
										@method('put')
										@csrf
										<div class="form-group">
										  <label for="name">Project Name</label>
										  <input type="text" class="form-control" id="name" name="name" aria-describedby="Project Name" value="{{ old('name', $accessKey->project_name) }}">
										  @error('name') <span class="text-danger">{{ $message }}</span> @enderror
										  {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>  --}}
										</div>
										<div class="form-group">
											<label class="form-label">Ability</label>
											<div class="selectgroup selectgroup-pills">
												<label class="selectgroup-item">
													<input type="checkbox" name="ability[]" value="*" class="selectgroup-input">
													<span class="selectgroup-button">All</span>
												</label>
												<label class="selectgroup-item">
													<input type="checkbox" name="ability[]" value="Semua" class="selectgroup-input">
													<span class="selectgroup-button">Semua</span>
												</label>
												<label class="selectgroup-item">
													<input type="checkbox" name="ability[]" value="PHP" class="selectgroup-input">
													<span class="selectgroup-button">Login</span>
												</label>
												<label class="selectgroup-item">
													<input type="checkbox" name="ability[]" value="JavaScript" class="selectgroup-input">
													<span class="selectgroup-button">Register</span>
												</label>
												{{-- <label class="selectgroup-item">
													<input type="checkbox" name="ability[]" value="Ruby" class="selectgroup-input">
													<span class="selectgroup-button">Ruby</span>
												</label>
												<label class="selectgroup-item">
													<input type="checkbox" name="ability[]" value="Ruby" class="selectgroup-input">
													<span class="selectgroup-button">Ruby</span>
												</label>
												<label class="selectgroup-item">
													<input type="checkbox" name="ability[]" value="C++" class="selectgroup-input">
													<span class="selectgroup-button">C++</span>
												</label> --}}
											</div>
											@error('ability') <span class="text-danger">{{ $message }}</span> @enderror
										</div>
										<div class="form-check">
											<label>Gender</label><br/>
											<label class="form-radio-label">
												<input class="form-radio-input" type="radio" name="active" value="1"  checked="">
												<span class="form-radio-sign">Active</span>
											</label>
											<label class="form-radio-label ml-3">
												<input class="form-radio-input" type="radio" name="active" value="0">
												<span class="form-radio-sign">Not Active</span>
											</label>
											@error('active') <span class="text-danger">{{ $message }}</span> @enderror
										</div>
										<button type="submit" class="btn btn-primary btn-rounded ml-2">Submit</button>
										<a href="{{ route('accesskey.index') }}" class="btn btn-danger btn-rounded ml-2">Cancel</a>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<footer class="footer">
				<div class="container-fluid">
					<nav class="pull-left">
						<ul class="nav">
							<li class="nav-item">
								<a class="nav-link" href="https://www.themekita.com">
									ThemeKita
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="#">
									Help
								</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="#">
									Licenses
								</a>
							</li>
						</ul>
					</nav>
					<div class="copyright ml-auto">
						2018, made with <i class="fa fa-heart heart text-danger"></i> by <a href="https://www.themekita.com">ThemeKita</a>
					</div>				
				</div>
			</footer>
		</div>
		
	</div>

	@endsection
	