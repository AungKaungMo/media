@extends('admin.layouts.app')
@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <div class="row mt-4">
                    <div class="col-8 offset-3 mt-5">
                        <div class="col-md-9">
                            <div class="card">
                                <div class="card-header p-2">
                                    <legend class="text-center">User Profile</legend>
                                </div>
                                <div class="card-body">
                                    <div class="tab-content">

                                        @if (Session::has('passworderr'))
                                            <div class="alert alert-danger" role="alert">
                                                {{ Session::get('passworderr') }}
                                            </div>
                                        @endif

                                        <div class="active tab-pane" id="activity">
                                            <form class="form-horizontal" method="post"
                                                action="{{ route('adminPswUpdate') }}">
                                                @csrf

                                                <div class="form-group row">
                                                    <label for="oldpassword" class="col-sm-2 col-form-label">Old
                                                        Passwrd</label>
                                                    <div class="col-sm-10">
                                                        <input type="password" name="oldpassword" class="form-control"
                                                            id="oldpassword" placeholder="Old Password" value="">
                                                    </div>
                                                    @error('oldpassword')
                                                        <div class=" text-danger">{{ $message }}</div>
                                                    @enderror

                                                </div>
                                                <div class="form-group row">
                                                    <label for="newpassword" class="col-sm-2 col-form-label">New
                                                        Password</label>
                                                    <div class="col-sm-10">
                                                        <input type="password" name="newpassword" class="form-control"
                                                            id="newpassword" placeholder="New Password" value="">
                                                    </div>
                                                    @error('newpassword')
                                                        <div class=" text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="form-group row">
                                                    <label for="confirmpassword" class="col-sm-2 col-form-label">Confirm
                                                        Password</label>
                                                    <div class="col-sm-10">
                                                        <input type="password" name="confirmpassword" class="form-control"
                                                            id="confirmpassword" placeholder="Confirm Password"
                                                            value="">
                                                    </div>
                                                    @error('confirmpassword')
                                                        <div class=" text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                {{-- <div class="form-group row">
                                                    <div class="offset-sm-2 col-sm-10">
                                                        <a href="">Change Password</a>
                                                    </div>
                                                </div> --}}
                                                <div class="form-group row">
                                                    <div class="offset-sm-2 col-sm-10">
                                                        <button type="submit"
                                                            class="btn bg-dark text-white">Change</button>
                                                    </div>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
@endsection
