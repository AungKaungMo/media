@extends('admin.layouts.app')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">


        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Admin List Page</h3>

                                @if (Session::has('successfully'))
                                    <div class="alert alert-success" role="alert">
                                        {{ Session::get('successfully') }}
                                    </div>
                                @endif

                                <div class="card-tools">
                                    <form action="{{ route('adminListSearch') }}" method="POST">
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
                                            <th>User ID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Address</th>
                                            <th>Gender</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($allUserDatas as $items)
                                            <tr>
                                                <td>{{ $items->id }}</td>
                                                <td>{{ $items->name }}</td>
                                                <td>{{ $items->email }}</td>
                                                <td>{{ $items->phone }}</td>
                                                <td>{{ $items->address }}</td>
                                                <td>{{ $items->gender }}</td>
                                                <td>
                                                    @if (auth()->user()->id == $items->id)
                                                        <a {{-- @if (count($allUserDatas) > 1) --}}
                                                            href="{{ route('deleteAdminList', $items->id) }}"
                                                            {{-- @else --}} {{-- href="#" @endif> --}} <button
                                                            class="btn btn-sm bg-danger text-white"><i
                                                                class="fas fa-trash-alt"></i></button>
                                                        </a>
                                                    @endif

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
