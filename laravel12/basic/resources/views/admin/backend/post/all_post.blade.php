@extends('admin.admin_master')
@section('admin')


    <div class="content">

        <!-- Start Content-->
        <div class="container-xxl">

            <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                <div class="text-end">
                    <ol class="breadcrumb m-0 py-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Reviews</a></li>
                        <li class="breadcrumb-item active">All Reviews</li>
                    </ol>
                </div>
            </div>

            <!-- Datatables  -->
            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-header">
                            <h5 class="card-title mb-0">All Review</h5>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <table id="datatable" class="table table-bordered dt-responsive table-responsive nowrap">
                                <thead>
                                    <tr>
                                        <th>Sl</th>
                                        <th>Category</th>
                                        <th>Title</th>
                                        <th>Image</th>
                                        <th>Description</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($posts as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $item['blog']['category_name'] }}</td>
                                        {{-- Or --}}
                                        {{-- <td>{{ $item->blog->category_name }}</td> --}}
                                        <td>{{ $item->post_title }}</td>
                                        <td>
                                            <img src="{{ asset($item->image) }}" alt="{{ $item->name }}" style="width: 70px; height: 40px;">
                                        </td>
                                        <td>
                                            {!! Str::limit($item->long_description, 50, '...') !!}
                                        </td>

                                        <td>
                                            <a href="{{ route('edit.blog.post', $item->id) }}" class="btn btn-success btn-sm">Edit</a>
                                            <a href="{{ route('delete.blog.post', $item->id) }}" class="btn btn-danger btn-sm" id="delete">Delete</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    {{-- @foreach ($review as $key => $item)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->position }}</td>
                                            <td>
                                                <img src="{{ $item->image }}" alt="{{ $item->name }}"
                                                    style="width: 70px; height: 40px;">
                                            </td>
                                            <td>{{ $item->message }}</td>
                                            <td>
                                                <a href="" class="btn btn-success btn-sm">Edit</a>
                                                <a href="" class="btn btn-danger btn-sm">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach --}}

                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>



        </div> <!-- container-fluid -->

    </div> <!-- content -->



@endsection
