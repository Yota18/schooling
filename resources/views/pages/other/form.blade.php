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
                                <h2 class="text-white pb-2 fw-bold">Form</h2>
                                <h5 class="text-white op-7 mb-2"></h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="page-inner mt--5">
                    <div class="row">
						<div class="col-md-6">
							<div class="card">
                                <div class="card-header card-info">
                                    <div class="card-title">Product form template</div>
                                </div>
								<div class="card-body">
                                    <div class="form-group">
                                        <label for="category">Product Category</label>
                                        <select class="form-control" id="category" name="category">
                                            <option>- Select Category -</option>
                                            <option value="food">Food</option>
                                            <option value="Drink">Drink</option>
                                            <option value="Clothes">Clothes</option>
                                            <option value="Property">Property</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="product-name">Product Name</label>
                                        <input type="text" class="form-control" id="product-name" name="product-name" placeholder="Write product name">
                                    </div>
                                    <div class="form-group">
                                        <label for="Product Description">Product Description</label>
                                        <textarea class="form-control" rows="5" name="product-description" placeholder="Write product description">
                                        </textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="Stock">Stock</label>
                                        <input type="text" class="form-control" id="Stock" name="_stock_" placeholder="Ex : 2" min="1">
                                    </div>
                                    <div class="form-group">
                                        <label for="Price">Price</label>
                                        <input type="text" class="form-control" id="Price" name="_price_" placeholder="Rp. ">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <p style="font-weight: 600">Thumbnail</p>
                                        <img class="img-preview img-fluid mb-3">
                                        <p id="file-name"></p>
                                        <label class="image-label" for="image"><i class="fas fa-file-upload"></i><span>Select File</span></label>
                                        <input type="file" class="form-control-file" id="image" name="image" onchange="previewImage()">
                                        <div class="info">
                                            <p>Max size : 1MB</p>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary btn-rounded">Add New Product</button>
								</div>
							</div>
						</div>
                        <div class="col-md-6">
							<div class="card">
                                <div class="card-header card-warning">
                                    <div class="card-title">Component form template</div>
                                </div>
								<div class="card-body">
                                    <div class="form-group">
                                        <label for="text">Text</label>
                                        <input type="text" class="form-control" id="text" placeholder="Write product name">
                                    </div>
									<div class="form-group">
                                        <label for="email2">Email</label>
                                        <input type="email" class="form-control" id="email2" placeholder="Enter Email">
                                        <small id="emailHelp2" class="form-text text-muted">We'll never share your email with anyone else.</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control" id="password" placeholder="Password">
                                    </div>
                                    <div class="form-group">
                                        <label for="disableinput">Disable Input</label>
                                        <input type="text" class="form-control" id="disableinput" placeholder="Enter Input" disabled="">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Example select</label>
                                        <select class="form-control" id="exampleFormControlSelect1">
                                            <option>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                            <option>5</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="comment">Comment</label>
                                        <textarea class="form-control" id="editor1" rows="5">
                                        </textarea>
                                    </div>
                                    <div class="form-check">
                                        <label>Gender</label><br>
                                        <label class="form-radio-label">
                                            <input class="form-radio-input" type="radio" name="optionsRadios" value="" checked="">
                                            <span class="form-radio-sign">Male</span>
                                        </label>
                                        <label class="form-radio-label ml-3">
                                            <input class="form-radio-input" type="radio" name="optionsRadios" value="">
                                            <span class="form-radio-sign">Female</span>
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Your skills</label>
                                        <div class="selectgroup selectgroup-pills">
                                            <label class="selectgroup-item">
                                                <input type="checkbox" name="value" value="HTML" class="selectgroup-input" checked="">
                                                <span class="selectgroup-button">HTML</span>
                                            </label>
                                            <label class="selectgroup-item">
                                                <input type="checkbox" name="value" value="CSS" class="selectgroup-input">
                                                <span class="selectgroup-button">CSS</span>
                                            </label>
                                            <label class="selectgroup-item">
                                                <input type="checkbox" name="value" value="PHP" class="selectgroup-input">
                                                <span class="selectgroup-button">PHP</span>
                                            </label>
                                            <label class="selectgroup-item">
                                                <input type="checkbox" name="value" value="JavaScript" class="selectgroup-input">
                                                <span class="selectgroup-button">JavaScript</span>
                                            </label>
                                            <label class="selectgroup-item">
                                                <input type="checkbox" name="value" value="Ruby" class="selectgroup-input">
                                                <span class="selectgroup-button">Ruby</span>
                                            </label>
                                            <label class="selectgroup-item">
                                                <input type="checkbox" name="value" value="Ruby" class="selectgroup-input">
                                                <span class="selectgroup-button">Ruby</span>
                                            </label>
                                            <label class="selectgroup-item">
                                                <input type="checkbox" name="value" value="C++" class="selectgroup-input">
                                                <span class="selectgroup-button">C++</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Size</label>
                                        <div class="selectgroup w-100">
                                            <label class="selectgroup-item">
                                                <input type="radio" name="value" value="50" class="selectgroup-input" checked="">
                                                <span class="selectgroup-button">S</span>
                                            </label>
                                            <label class="selectgroup-item">
                                                <input type="radio" name="value" value="100" class="selectgroup-input">
                                                <span class="selectgroup-button">M</span>
                                            </label>
                                            <label class="selectgroup-item">
                                                <input type="radio" name="value" value="150" class="selectgroup-input">
                                                <span class="selectgroup-button">L</span>
                                            </label>
                                            <label class="selectgroup-item">
                                                <input type="radio" name="value" value="200" class="selectgroup-input">
                                                <span class="selectgroup-button">XL</span>
                                            </label>
                                        </div>
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

            // stock format
            $('input[name="_stock_"]').on('keyup focusin focusout ', function(event) {
                if (event.which >= 37 && event.which <= 40) return;
                $(this).val(function(index, value) {
                    return value.replace(/\D/g, "");
                });
            });
            // price format
            $('input[name="_price_"]').on('keyup focusin focusout ', function(event) {
                if (event.which >= 37 && event.which <= 40) return;
                // format number
                $(this).val(function(index, value) {
                    return "Rp. " + value.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                });
            });

        var editor = CKEDITOR.replace("editor1", {
                height: 200,
            });
            CKFinder.setupCKEditor(editor);
    </script>
@endsection
