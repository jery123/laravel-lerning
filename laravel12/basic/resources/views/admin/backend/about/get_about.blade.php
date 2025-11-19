@extends('admin.admin_master')

@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <div class="content">

        <!-- Start Content-->
        <div class="container-xxl">

            <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                <div class="flex-grow-1">
                    <h4 class="fs-18 fw-semibold m-0">{{ isset($about) ? 'Add' : 'Edit' }} About</h4>
                </div>
            </div>


            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-body">

                            <div class="tab-pane pt-4" id="profile_setting" role="tabpanel" aria-labelledby="setting_tab">
                                <div class="row">

                                    <div class="row">
                                        <div class="col-lg-12 col-xl-12">
                                            <div class="card border mb-0">

                                            <form action="{{ route('update.about') }}" method="post" enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $about->id ?? 0 }}">
                                                <div class="card-body">
                                                    <div class="form-group mb-3 row">
                                                        <label class="form-label">Title</label>
                                                        <div class="col-lg-12 col-xl-12">
                                                            <input class="form-control" type="text" name="title" value="{{ $about->title ?? '' }}">
                                                        </div>
                                                    </div> 

                                                    <div class="form-group mb-3 row">
                                                        <label class="form-label">Description</label>
                                                        <div class="col-lg-12 col-xl-12">
                                                            <textarea name="description" id="description" class="form-control" style="display: none;" ></textarea>
                                                            <div id="quill-editor" style="height: 400px;">
                                                                {!! $about->description ?? 'Enter description here...' !!}
                                                            </div>
                                                            {{-- <textarea name="description" class="form-control" >{{ $about->description ?? 'Enter description here...' }}</textarea> --}}
                                                        </div>
                                                    </div>

                                                    <div class="form-group mb-3 row">
                                                        <label class="form-label">About Photo</label>
                                                        <div class="col-lg-12 col-xl-12">
                                                            <input class="form-control" type="file" name="image" id="image">
                                                        </div>
                                                    </div>

                                                    <div class="form-group mb-3 row">
                                                        <div class="col-lg-12 col-xl-12">
                                                            <img src=" {{ isset($about) ? url(asset($about->image)) : '' }}"
                                                                    class="rounded-circle avatar-xxl img-thumbnail float-start" alt="image profile" id="showImage">
                                                        </div>
                                                    </div>

                                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                                </div><!--end card-body-->
                                            </form>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </div> <!-- end education -->
                        </div>
                    </div>
                </div>

                <script>
                    document.querySelector('form').onsubmit = function() {
                        alert("all done...");
                        var description = document.querySelector('#description');
                        description.value = quill.root.innerHTML;
                    }
                </script>

                <script type="text/javascript">
                    $(document).ready(function(){
                        $('#image').change(function(e){
                            var reader = new FileReader();
                            reader.onload = function(e){
                                $('#showImage').attr('src', e.target.result);
                            }
                            reader.readAsDataURL(e.target.files['0']);
                        })
                    })
                </script>
@endsection
