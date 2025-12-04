@extends('admin.admin_master')
@section('content')

<div class="content">

                    <!-- Start Content-->
                    <div class="container-xxl">

                        <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                            <div class="flex-grow-1">
                                <h4 class="fs-18 fw-semibold m-0">All Suppliers</h4>
                            </div>

                            <div class="text-end">
                                <ol class="breadcrumb m-0 py-0">
                                    <a href="{{ route('add.supplier') }}" class="btn btn-primary">Add Supplier</a>
                                </ol>
                            </div>
                        </div>

                        <!-- Datatables  -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card">

                                    <div class="card-header">
                                        <h5 class="card-title mb-0">All Suppliers</h5>
                                    </div><!-- end card header -->

                                    <div class="card-body">
                                        <table id="datatable" class="table table-bordered dt-responsive table-responsive nowrap">
                                            <thead>
                                            <tr>
                                                <th>S.I</th>
                                                <th>Supplier Name</th>
                                                <th>E-mail</th>
                                                <th>Phone</th>
                                                <th>Address</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($suppliers as $key => $supplier)
                                                    <tr>
                                                        <td>{{ $key + 1 }}</td>
                                                        <td>{{ $supplier->name }}</td>
                                                        <td>{{ $supplier->email }}</td>
                                                        <td>{{ $supplier->phone }}</td>
                                                        <td>{{ $supplier->address }}</td>
                                                        <td>
                                                            <a href="{{ route('edit.supplier', $supplier->id) }}" class="btn btn-info sm" title="Edit Data">Edit</a>
                                                            <a href="{{ route('delete.supplier', $supplier->id) }}" class="btn btn-danger sm" title="Delete Data" id="delete">Delete</a>
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
