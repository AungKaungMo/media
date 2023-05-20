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

                                        @if (Session::has('updateinfo'))
                                            <div class="alert alert-success" role="alert">
                                                {{ Session::get('updateinfo') }}
                                            </div>
                                        @endif

                                        <div class="active tab-pane" id="activity">
                                            <form class="form-horizontal" method="post"
                                                action="{{ route('adminPfUpdate') }}">
                                                @csrf
                                                <div class="form-group row">
                                                    <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" name="adminName" class="form-control"
                                                            id="inputName" placeholder="Name"
                                                            value="{{ old('adminName', $user->name) }}">
                                                    </div>
                                                    @error('adminName')
                                                        <div class=" text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group row">
                                                    <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                                    <div class="col-sm-10">
                                                        <input type="email" name="adminEmail" class="form-control"
                                                            id="inputEmail" placeholder="Email"
                                                            value="{{ old('adminEmail', $user->email) }}">
                                                    </div>
                                                    @error('adminEmail')
                                                        <div class=" text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="form-group row">
                                                    <label for="inputPhone" class="col-sm-2 col-form-label">Phone</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" name="adminPhone" class="form-control"
                                                            id="inputPhone" placeholder="Phone" value="{{ $user->phone }}">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="inputAddress"
                                                        class="col-sm-2 col-form-label">Address</label>
                                                    <div class="col-sm-10">
                                                        <textarea name="adminAddress" class="form-control" id="inputAddress" placeholder="Enter Address">{{ $user->address }} </textarea>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="inputGender" class="col-sm-2 col-form-label">Gender</label>
                                                    <div class="col-sm-10">
                                                        <select class="form-control" name="adminGender" id="inputGender"
                                                            placeholder="Gender">
                                                            @if ($user->gender == 'Male')
                                                                <option value="empty">Choose Your Option</option>
                                                                <option value="Male" selected>Male</option>
                                                                <option value="Female">Female</option>
                                                                <option value="Custom">Custom</option>
                                                            @elseif ($user->gender == 'Female')
                                                                <option value="empty">Choose Your Option</option>
                                                                <option value="Male">Male</option>
                                                                <option value="Female" selected>Female</option>
                                                                <option value="Custom">Custom</option>
                                                            @elseif ($user->gender == 'Custom')
                                                                <option value="empty">Choose Your Option</option>
                                                                <option value="Male">Male</option>
                                                                <option value="Female">Female</option>
                                                                <option value="Custom" selected>Custom</option>
                                                            @else
                                                                <option value="empty" selected>Choose Your
                                                                    Option</option>
                                                                <option value="Male">Male</option>
                                                                <option value="Female">Female</option>
                                                                <option value="Custom">Custom</option>
                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <div class="offset-sm-2 col-sm-10">
                                                        <a href="{{ route('adminPswChange') }}">Change Password</a>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="offset-sm-2 col-sm-10">
                                                        <button type="submit"
                                                            class="btn bg-dark text-white">Update</button>
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
