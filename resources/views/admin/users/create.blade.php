@extends('templates.template')
    @section('content')
        <div class="row">
            <div class="col-lg-12" >
                <div class="card-wrapper">

                    <div class="card">

                        <div class="card-header">
                            <h3 class="mb-0">Add Users</h3>
                        </div>

                        <div class="card-body">
                            <form method="post">
                                {{csrf_field()}}

                                @if ($errors->any())
                                    <div class="alert alert-warning">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <div class="input-group input-group-merge">
                                                <label for="example-text-input" class="col-md-3 col-form-label form-control-label">FIRST NAME</label>
                                                <div class="col-md-9">
                                                    <input class="form-control" name="first_name" value="{{old('first_name')}}" placeholder="First Name" type="text">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <div class="input-group input-group-merge">
                                                <label for="example-text-input" class="col-md-3 col-form-label form-control-label">MIDDLE NAME</label>
                                                <div class="col-md-9">
                                                    <input class="form-control" name="middle_name" value="{{old('middle_name')}}" placeholder="Middle Name" type="text">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <div class="input-group input-group-merge">
                                                <label for="example-text-input" class="col-md-3 col-form-label form-control-label">LAST NAME</label>
                                                <div class="col-md-9">
                                                    <input class="form-control" name="last_name" value="{{old('last_name')}}" placeholder="Last Name" type="text">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <div class="input-group input-group-merge">
                                                <label for="example-text-input" class="col-md-3 col-form-label form-control-label">EMAIL </label>
                                                <div class="col-md-9">
                                                    <input class="form-control" name="email" value="{{old('email')}}" placeholder="Email address" type="email">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <div class="input-group">
                                                <label for="example-text-input" class="col-md-3 col-form-label form-control-label">USER NAME</label>
                                                <div class="col-md-9">
                                                    <input class="form-control" name="username" placeholder="auto generated" type="text" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <div class="input-group">
                                                <label for="example-text-input" class="col-md-3 col-form-label form-control-label">ROLE</label>
                                                <div class="col-md-9">
                                                    <select class="form-control" name="role" data-toggle="select">
                                                        <option></option>
                                                        @foreach($roles as $role)
                                                            <option value="{{$role->id}}">{{strtoupper($role->name)}}</option>
                                                            @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="float-right">
                                     <button type="submit" class="btn btn-default">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>


                </div>
        </div>
        </div>
        @endsection
