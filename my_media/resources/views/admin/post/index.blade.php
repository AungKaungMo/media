@extends('admin.layouts.app')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row mt-4">

                    <div class="col-4">
                        <form method="post" action="{{ route('postNew') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>Post Name</label>
                                <input type="text" class="form-control" name="postName" placeholder="Enter post name"
                                    value="{{ old('postName') }}">
                                @error('postName')
                                    <div class=" text-danger">{{ $message }}</div>
                                @enderror

                            </div>

                            <div class="form-group">
                                <label>Post Description</label>
                                <textarea class="form-control" name="postDescription" placeholder="Enter post Description">{{ old('postDescription') }}</textarea>
                                @error('postDescription')
                                    <div class=" text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Post Image</label>
                                <input type="file" class="form-control" name="postImage" placeholder="Enter post image"
                                    value="{{ old('postImage') }}">
                                @error('postImage')
                                    <div class=" text-danger">{{ $message }}</div>
                                @enderror

                            </div>

                            <div class="form-group">
                                <label>Category Id</label>
                                <select class="form-control" name="categoryId">
                                    <option value="empty">Select Category</option>
                                    @foreach ($category as $item)
                                        <option value="{{ $item->category_id }}">{{ $item->title }}</option>
                                    @endforeach
                                </select>

                            </div>

                            <button type="submit" class="btn btn-primary">Post</button>
                        </form>
                    </div>

                    <div class="col-8">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    Category List Page
                                </h3>

                                <div class="card-tools">
                                    <form action="{{ route('adminCategorySearch') }}" method="post">
                                        @csrf
                                        <div class="input-group input-group-sm" style="width: 150px;">
                                            <input type="text" name="searchKey" class="form-control float-right"
                                                placeholder="Search">

                                            <div class="input-group-append">
                                                <button type="submit" class="btn btn-default">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap text-center">
                                    <thead>
                                        <tr>
                                            <th>Post ID</th>
                                            <th>Post Name</th>
                                            {{-- <th>Description</th> --}}
                                            <th>Image</th>
                                            <th>Category Name</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($post as $item)
                                            <tr>
                                                <td>{{ $item->post_id }}</td>
                                                <td>{{ $item->title }}</td>
                                                {{-- <td>{{ $item->description }}</td> --}}
                                                <td><img @if ($item->image == null) src="{{ asset('defaultImage/default.png') }}"
                                                @else
                                                    src="{{ asset('postImage/' . $item->image) }}" @endif
                                                        width="100px"></td>
                                                <td>{{ $item->category_id }}</td>
                                                <td>
                                                    <a href="{{ route('updatePost', $item->post_id) }}">
                                                        <button class="btn btn-sm bg-dark text-white"><i
                                                                class="fas fa-edit"></i></button>
                                                    </a>
                                                    <a href="{{ route('postDelete', $item->post_id) }}">
                                                        <button class="btn btn-sm bg-danger text-white"><i
                                                                class="fas fa-trash-alt"></i></button>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>

            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
