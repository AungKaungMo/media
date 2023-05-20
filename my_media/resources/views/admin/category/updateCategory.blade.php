@extends('admin.layouts.app')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class=" flex flex-column items-center  mt-4">
                    @if (Session::has('success'))
                        <div class="alert alert-success" role="alert">
                            {{ Session::get('success') }}
                        </div>
                    @endif
                    <form method="post" action="{{ route('newCategory') }}">
                        @csrf
                        <div class="form-group">
                            <label>Category Name</label>
                            <input type="text" class="form-control" name="categoryName" placeholder="Enter category name"
                                value="{{ old('categoryName', $categoryData->title) }}">
                            @error('categoryName')
                                <div class=" text-danger">{{ $message }}</div>
                            @enderror

                        </div>

                        <div class="form-group">
                            <label>Category Description</label>
                            <input type="text" class="form-control" name="categoryDescription"
                                placeholder="Enter category Description"
                                value="{{ old('categoryDescription', $categoryData->description) }}">
                            @error('categoryDescription')
                                <div class=" text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <input type="hidden" name="categoryId" value="{{ $categoryData->category_id }}">

                        <button type="submit" class="btn btn-primary">Update</button>

                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection
