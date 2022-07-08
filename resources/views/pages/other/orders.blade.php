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
                                <h2 class="text-white pb-2 fw-bold">Product Name</h2>
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
                                    <h4>Order details</h4>
                                </div>
                                <div class="card-body">
                                    <div class="top-table table-overflow">
                                        <table class="table table-striped ">
                                            <tbody><tr>
                                                <td width="30%">Order code</td>
                                                <td width="5%">:</td>
                                                <td> <span class="badge badge-info">8GSNZ3OAKL</span> </td>
                                            </tr>
                                            <tr>
                                                <td>Customer</td>
                                                <td>:</td>
                                                <td>domose</td>
                                            </tr>
                                            <tr>
                                                <td>Order total</td>
                                                <td>:</td>
                                                <td>
                                                    Rp. 187.000
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Recipient's name</td>
                                                <td>:</td>
                                                <td>domose</td>
                                            </tr>
                                            <tr>
                                                <td>Recipient phone</td>
                                                <td>:</td>
                                                <td><a style="color: #444; text-decoration:none" href="tel:0831231231023">0831231231023</a></td>
                                            </tr>
                                            <tr>
                                                <td>Shipping address</td>
                                                <td>:</td>
                                                <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Minus, cupiditate.</td>
                                            </tr>
                                            <tr>
                                                <td>Shipping</td>
                                                <td>:</td>
                                                <td>jne</td>
                                            </tr>
                                            <tr>
                                                <td>Shipping cost</td>
                                                <td>:</td>
                                                <td>Rp. 87.000</td>
                                            </tr>
                                            <tr>
                                                <td>Payment method</td>
                                                <td>:</td>
                                                <td>Transfer</td>
                                            </tr>
                                            <tr>
                                                <td>Evidence of transfer</td>
                                                <td>:</td>
                                                <td>
                                                    {{-- <p class="mt-2">Bukti Pembayaran</p> --}}
                                                    <button type="button" class="img-button" data-toggle="modal" data-target="#transfer-img">
                                                        <img class="img-order-details" src="{{ asset('assets/img/examples/product8.jpg') }}" width="200" height="200">
                                                      </button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Order status</td>
                                                <td>:</td>
                                                <td>
                                                    <span class="badge badge-secondary">Order Processed</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Shipping Receipt</td>
                                                <td>:</td>
                                                <td>
                                                    <form action="" class="form-inline" id="formresi" method="post" accept-charset="utf-8">
                                                        <input type="hidden" name="BaseCI_Token_Name" value="c36b6453e991f0004334cb067923dbc3">
                                                        <div class="form-group px-0">
                                                            <input type="text" class="form-control" name="_resi_" placeholder="Resis Pengiriman" id="noresi" value="">
                                                        </div>
                                                        <button type="submit" name="submit" id="resi" class="btn btn-info btn-sm ml-2 mb-2"> Input Receipt</button>
                                                        <button class="btn btn-warning btn-sm ml-2 mb-2 ubah" id="ubah" style="display: none;">change</button>
                                                    </form>                                                
                                                </td>
                                            </tr>
                                        </tbody></table>
                                    </div>
                                    
                                </div>
                            </div>
						</div>
                        <div class="col-md-6">
							<div class="card">
                                <div class="card-header card-warning">
                                    <div class="card-title">Product</div>
                                </div>
								<div class="card-body">
                                    <div class="bottom-table table-overflow">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <td>Gambar</td>
                                                    <td>Produk</td>
                                                    <td>Jumlah</td>
                                                    <td>Harga</td>
                                             </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td class="font-weight-bold">Total</td>
                                                    <td class="font-weight-bold">Rp. 100.000 </td>
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                                <tr>                                                                                        <tbody><tr>
                                                    <td>
                                                        <img class="img-product" src="{{ asset('assets/img/examples/product8.jpg') }}" alt="">
                                                    </td>
                                                    <td>Batik Nusantara </td>
                                                    <td>1</td>
                                                    <td>Rp. 100.000 </td>
                                                </tr>
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

    <!-- Modal -->
    <div class="modal fade bd-example-modal-lg" id="transfer-img" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Bukti transfer (kode transaksi)</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <img class="img-full" src="{{ asset('assets/img/examples/product8.jpg') }}" width="200" height="200">
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
    </script>
@endsection
