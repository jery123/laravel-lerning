@extends('admin.admin_master')
@section('content')

<div class="content">

                    <!-- Start Content-->
                    <div class="container-xxl">

                        <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                            <div class="flex-grow-1">
                                <h4 class="fs-18 fw-semibold m-0">All Products</h4>
                            </div>

                            <div class="text-end">
                                <ol class="breadcrumb m-0 py-0">
                                    <a href="{{ route('add.product') }}" class="btn btn-primary">Add Product</a>
                                </ol>
                            </div>
                        </div>

                        <!-- Datatables  -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card">

                                    <div class="card-header">
                                        <h5 class="card-title mb-0">All Products</h5>
                                    </div><!-- end card header -->

                                    <div class="card-body">
                                        <table id="datatable" class="table table-bordered dt-responsive table-responsive nowrap">
                                            <thead>
                                            <tr>
                                                <th>S.I</th>
                                                <th>Image</th>
                                                <th>Name</th>
                                                <th>Warehouse</th>
                                                <th>Price</th>
                                                <th>In Stock</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($products as $key => $product)
                                                    <tr>
                                                        <td>{{ $key + 1 }}</td>
                                                        <td>
                                                            @php
                                                                $primaryImage = $product->images->first()->name ?? 'no_image.jpg';
                                                            @endphp
                                                            <img src="{{ asset($primaryImage) }}" alt="Product Image" style="width: 50px; height: 50px;">
                                                        </td>
                                                        <td>{{ $product->name }}</td>
                                                        <td>{{ $product->warehouse->name ?? 'N/A' }}</td>
                                                        <td>{{ $product->price }}</td>
                                                        <td>
                                                            @if($product->product_qty <=3)
                                                                <span class="badge text-bg-danger">{{ $product->product_qty }}</span>
                                                                @else
                                                                <h4>
                                                                    <span class="badge text-bg-secondary">{{ $product->product_qty }}</span>
                                                                </h4>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('edit.product', $product->id) }}" class="btn btn-info sm" title="Details">
                                                                <span class="mdi mdi-eye-circle mdi-18px"></span>
                                                            </a>
                                                            <a href="{{ route('edit.product', $product->id) }}" class="btn btn-success sm" title="Edit">
                                                                <span class="mdi mdi-book-edit mdi-18px"></span>
                                                            </a>
                                                            <a href="{{ route('delete.product', $product->id) }}" class="btn btn-danger sm" title="Delete" id="delete">
                                                                <span class="mdi mdi-delete-circle mdi-18px"></span>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                        </div>


                    </div> <!-- container-fluid -->

                </div> <!-- content -->


@endsection
