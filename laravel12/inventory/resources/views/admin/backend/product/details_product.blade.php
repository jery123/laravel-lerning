@extends('admin.admin_master')
@section('content')



    <div class="content">

        <!-- Start Content-->
        <div class="container-xxl">

            <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                <div class="flex-grow-1">
                    <h4 class="fs-18 fw-semibold m-0">Product Details</h4>
                </div>

            <div class="text-end">
                <ol class="breadcrumb m-0 py-0">
                     <a href="{{ route('all.product') }}" class="btn btn-dark">Back</a>
                </ol>
            </div>
            </div>

            <hr/>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <h5 class=" mb-3">Product Images:</h5>
                            <div class="d-flex flex-wrap">
                                @forelse ($product->images as $image)
                                    <img src="{{ asset($image->name) }}" class="me-2 mb-2" width="100" height="100" style="oject-fit: cover; border: 1px solid #ddd; border-radius: 5px;" >
                                @empty
                                    <p class="text-danger">No image Available</p>
                                @endforelse
                            </div>
                        </div>
                        {{-- Display Product Details --}}
                        <div class="col-md-8">
                            <h5 class="mb-3">
                                Product Information
                            </h5>
                            <ul class="list-group mb-3">
                                <li class="list-group-item">
                                    <strong>Name:</strong>
                                    {{ $product->name }}
                                </li>
                                <li class="list-group-item">
                                    <strong>Code:</strong>
                                    {{ $product->code }}
                                </li>

                                <li class="list-group-item">
                                    <strong>Warehouse:</strong>
                                    {{ $product->warehouse->name ?? 'N/A' }}
                                </li>
                                <li class="list-group-item">
                                    <strong>Supplier:</strong>
                                    {{ $product->supplier->name ?? 'N/A' }}
                                </li>
                                <li class="list-group-item">
                                    <strong>Category:</strong>
                                    {{ $product->category->name ?? 'N/A' }}
                                </li>
                                <li class="list-group-item">
                                    <strong>Brand:</strong>
                                    {{ $product->brand->name ?? 'N/A' }}
                                </li>
                                <li class="list-group-item">
                                    <strong>Price:</strong>
                                    {{ $product->price ?? 'N/A' }}
                                </li>
                                <li class="list-group-item">
                                    <strong>Stock Alert:</strong>
                                    {{ $product->stock_alert ?? 'N/A' }}
                                </li>
                                <li class="list-group-item">
                                    <strong>Product QTY:</strong>
                                    {{ $product->product_qty ?? 'N/A' }}
                                </li>
                                <li class="list-group-item">
                                    <strong>Product Status:</strong>
                                    {{ $product->status ?? 'N/A' }}
                                </li>
                                
                                <li class="list-group-item">
                                    <strong>Product Note:</strong>
                                    {{ $product->note ?? 'N/A' }}
                                </li>
                                
                                <li class="list-group-item">
                                    <strong>Created on:</strong>
                                    {{ \Carbon\Carbon::parse($product->created_at)->format('F Y') ?? 'N/A' }}
                                </li>
                                

                            </ul>
                        </div> 
                         
                        <!-- Add more product details as needed -->
                    </div>
            </div>

        </div>
    </div>


@endsection
