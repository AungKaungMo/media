@extends('admin.layouts.app')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="d-flex flex-column items-center mt-4">

                    @if (Session::has('postUpdateSuccess'))
                        <div class="alert alert-success" role="alert">
                            {{ Session::get('postUpdateSuccess') }}
                        </div>
                    @endif

                    <form method="post" action="{{ route('UpdatingPost') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Post Name</label>
                            <input type="text" class="form-control" name="postName" placeholder="Enter post name"
                                value="{{ old('postName', $postData->title) }}">
                            @error('postName')
                                <div class=" text-danger">{{ $message }}</div>
                            @enderror

                        </div>

                        <div class="form-group">
                            <label>Post Description</label>
                            <textarea class="form-control" name="postDescription" placeholder="Enter post Description">{{ old('postDescription', $postData->description) }}</textarea>
                            @error('postDescription')
                                <div class=" text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Post Image</label>
                            <input type="file" class="form-control" name="postImage" placeholder="Enter post image"
                                value="{{ old('postImage', $postData->image) }}">
                            @error('postImage')
                                <div class=" text-danger">{{ $message }}</div>
                            @enderror

                        </div>

                        <div class="form-group">
                            <label>Category Id</label>
                            <select class="form-control" name="categoryId">
                                <option value="empty">Select Category</option>
                                @foreach ($category as $item)
                                    @if ($item->category_id == $postData->category_id)
                                        <option value="{{ $item->category_id }}" selected>{{ $item->title }}</option>
                                    @else
                                        <option value="{{ $item->category_id }}">{{ $item->title }}</option>
                                    @endif
                                @endforeach
                            </select>

                        </div>

                        <input type="hidden" value="{{ $postData->post_id }}" name="postId">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>

                </div>

            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
