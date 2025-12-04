@extends('admin.admin_master')
@section('content')


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>


<div class="content">

                    <!-- Start Content-->
                    <div class="container-xxl">

                        <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                            <div class="flex-grow-1">
                                <h4 class="fs-18 fw-semibold m-0">Edit Warehouse</h4>
                            </div>

                            <div class="text-end">
                                <ol class="breadcrumb m-0 py-0">
                                    <li class="breadcrumb-item active">Edit Warehouse</li>
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
                                        <form class="row g-3" method="POST" action="{{ route('update.warehouse') }}">
                                            @csrf

                                            <input type="hidden" name="id" value="{{ $warehouse->id }}">
                                            <div class="col-md-6">
                                                <label for="name" class="form-label">Warehouse name</label>
                                                <input type="text" class="form-control @error('name')
                                                    is-invalid
                                                @enderror" id="name" name="name" value="{{ $warehouse->name }}" required="">
                                                @error('name')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label for="email" class="form-label">Warehouse email</label>
                                                <input type="email" class="form-control @error('email')
                                                    is-invalid
                                                @enderror" id="email" name="email" value="{{ $warehouse->email }}" required="">
                                             @error('email')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label for="phone" class="form-label">Warehouse phone</label>
                                                <input type="text" class="form-control @error('phone')
                                                    is-invalid
                                                @enderror" id="phone" name="phone" value="{{ $warehouse->phone }}" required="">
                                             @error('phone')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label for="city" class="form-label">Warehouse city</label>
                                                <input type="text" class="form-control @error('city')
                                                    is-invalid
                                                @enderror" id="city" name="city" value="{{ $warehouse->city }}" required="">
                                             @error('city')
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
    $(document).ready(function() {
        $('#image').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#showImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>

@endsection
