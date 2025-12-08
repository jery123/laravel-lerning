@extends('admin.admin_master')
@section('content')

    <div class="content">

        <!-- Start Content-->
        <div class="container-xxl">

            <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                <div class="flex-grow-1">
                    <h4 class="fs-18 fw-semibold m-0">All Product Categories</h4>
                </div>

                <div class="text-end">
                    <ol class="breadcrumb m-0 py-0">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#standard-modal">
                            Add Category
                        </button>
                    </ol>
                </div>
            </div>

            <!-- Datatables  -->
            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-header">
                            <h5 class="card-title mb-0">All Product Categories</h5>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <table id="datatable" class="table table-bordered dt-responsive table-responsive nowrap">
                                <thead>
                                    <tr>
                                        <th>S.I</th>
                                        <th>Category Name</th>
                                        <th>Category Slug</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $key => $category)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $category->name }}</td>
                                            <td>{{ $category->slug }}</td>
                                            <td>
                                                <button type="button" id="{{ $category->id }}" onclick="categoryEdit(this.id)"
                                                    class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#category-edit">
                                                    Edit Category
                                                </button>
                                                {{-- <a href="{{ route('edit.product.category', $category->id) }}"
                                                    class="btn btn-info sm" title="Edit Data">Edit</a> --}}
                                                <a href="{{ route('delete.product.category', $category->id) }}"
                                                    class="btn btn-danger sm" title="Delete Data" id="delete">Delete</a>
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

    <!-- Add Modal -->
    <div class="modal fade" id="standard-modal" tabindex="-1" aria-labelledby="standard-modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="standard-modalLabel">Adding New Category</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('store.product.category') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="cat_name" class="form-label">Category Name</label>
                            <input type="text" class="form-control" id="cat_name" name="cat_name">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Edit Modal -->
    <div class="modal fade" id="category-edit" tabindex="-1" aria-labelledby="standard-modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="standard-modalLabel">Adding New Category</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('update.product.category') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" id="cat_id">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="cat_name" class="form-label">Category Name</label>
                            <input type="text" class="form-control" id="cat" name="cat_name">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<script>
    function categoryEdit(id){
        $.ajax({
            type: 'GET',
            url: '/edit/product/category/' + id,
            dataType: 'json',

            success: function(data){
                console.log(data);
                $('#cat').val(data.name);
                $('#cat_id').val(data.id);
            }
        })
    }
</script>

@endsection
