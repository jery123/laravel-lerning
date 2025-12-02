@extends('admin.admin_master')
@section('content')

<div class="content">

                    <!-- Start Content-->
                    <div class="container-xxl">

                        <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                            <div class="flex-grow-1">
                                <h4 class="fs-18 fw-semibold m-0">All Brands</h4>
                            </div>

                            <div class="text-end">
                                <ol class="breadcrumb m-0 py-0">
                                    <a href="{{ route('add.brand') }}" class="btn btn-primary">Add Brand</a>
                                </ol>
                            </div>
                        </div>

                        <!-- Datatables  -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card">

                                    <div class="card-header">
                                        <h5 class="card-title mb-0">All Brands</h5>
                                    </div><!-- end card header -->

                                    <div class="card-body">
                                        <table id="datatable" class="table table-bordered dt-responsive table-responsive nowrap">
                                            <thead>
                                            <tr>
                                                <th>S.I</th>
                                                <th>Brand Name</th>
                                                <th>Image</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($brands as $key => $brand)
                                                    <tr>
                                                        <td>{{ $key + 1 }}</td>
                                                        <td>{{ $brand->name }}</td>
                                                        <td>
                                                            <img src="{{ asset($brand->image) }}" style="width: 70px; height:40px;">
                                                        </td>
                                                        <td>
                                                            <a href="#" class="btn btn-info sm" title="Edit Data"><i class="fas fa-edit"></i></a>
                                                            <a href="#" class="btn btn-danger sm" title="Delete Data" id="delete"><i class="fas fa-trash-alt"></i></a>
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
