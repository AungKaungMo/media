@extends('admin.layouts.app')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row mt-4">

                    <div class="col-4">
                        <form method="post" action="{{ route('adminCategoryCreate') }}">
                            @csrf
                            <div class="form-group">
                                <label>Category Name</label>
                                <input type="text" class="form-control" name="categoryName"
                                    placeholder="Enter category name" value="{{ old('categoryName') }}">
                                @error('categoryName')
                                    <div class=" text-danger">{{ $message }}</div>
                                @enderror

                            </div>

                            <div class="form-group">
                                <label>Category Description</label>
                                <input type="text" class="form-control" name="categoryDescription"
                                    placeholder="Enter category Description" value="{{ old('categoryDescription') }}">
                                @error('categoryDescription')
                                    <div class=" text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
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
                                            <th>Category ID</th>
                                            <th>Category Name</th>
                                            <th>Description</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($allCategories as $items)
                                            <tr>
                                                <td>{{ $items->category_id }}</td>
                                                <td>{{ $items->title }}</td>
                                                <td>{{ $items->description }}</td>
                                                <td>
                                                    <a href="{{ route('updateCategory', $items->category_id) }}">
                                                        <button class="btn btn-sm bg-dark text-white"><i
                                                                class="fas fa-edit"></i></button>
                                                    </a>
                                                    <a href="{{ route('deleteCategory', $items->category_id) }}">
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
