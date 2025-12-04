@extends('admin.admin_master')
@section('content')


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>


<div class="content">

                    <!-- Start Content-->
                    <div class="container-xxl">

                        <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                            <div class="flex-grow-1">
                                <h4 class="fs-18 fw-semibold m-0">Add Supplier</h4>
                            </div>

                            <div class="text-end">
                                <ol class="breadcrumb m-0 py-0">
                                    <li class="breadcrumb-item active">Add Supplier</li>
                                </ol>
                            </div>
                        </div>

                        <!-- Form Validation -->
                        <div class="row">

                            <div class="col-xl-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title mb-0">Browser Defaults</h5>
                                    </div><!-- end card header -->

                                    <div class="card-body">
                                        <form id="myForm" class="row g-3" method="POST" action="{{ route('store.supplier') }}" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group col-md-4">
                                                <label for="name" class="form-label">Supplier name</label>
                                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" >
                                                @error('name')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="email" class="form-label">Supplier email</label>
                                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" >
                                                @error('email')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="phone" class="form-label">Supplier phone</label>
                                                <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone') }}" >
                                                @error('phone')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label for="address" class="form-label">Supplier Address</label>
                                                <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" >{{ old('address') }}</textarea>
                                                @error('address')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="col-12">
                                                <button class="btn btn-primary" type="submit">Save Changes</button>
                                            </div>
                                        </form>
                                    </div> <!-- end card-body -->
                                </div> <!-- end card-->
                            </div> <!-- end col -->

                        </div>

                    </div> <!-- container-fluid -->

                </div>
<script type="text/javascript">
    $(document).ready(function (){
        $('#myForm').validate({
            rules: {
                name: {
                    required : true,
                },  
                email: {
                    required : true,
                }, 
                phone: {
                    required : true,
                }, 
                address: {
                    required : true,
                }, 
                
            },
            messages :{
                name: {
                    required : 'Please Enter Supplier Name',
                }, 
                email: {
                    required : 'Please Enter Supplier Email',
                }, 
                phone: {
                    required : 'Please Enter Supplier Phone',
                },  
                address: {
                    required : 'Please Enter Supplier Address',
                }
                 

            },
            errorElement : 'span', 
            errorPlacement: function (error,element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight : function(element, errorClass, validClass){
                $(element).addClass('is-invalid');
            },
            unhighlight : function(element, errorClass, validClass){
                $(element).removeClass('is-invalid');
            },
        });
    });
    
</script>
@endsection
