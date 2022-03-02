@extends('templates.template')
@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <!-- Card header -->
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                        <h3 class="mb-0 ">NEW TRANSACTION</h3>
                    </div>
                        <div class="col-6 text-right">
                        </div>
                        <div class="col-md-12">
                            <br>
                            @if (count($errors) > 0)
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <ul>
                                        @foreach($errors->all() as $error)
                                            <li><strong>{{ $error }}</strong>.</li>
                                        @endforeach
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </ul>
                                </div>
                            @endif

                        @if (Session::has('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <span class="alert-icon"><i class="ni ni-like-2"></i></span>
                                    <span class="alert-text"><strong>Great!</strong> {!! Session::get('success') !!}!</span>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                    <div class="card-body">
                        <form method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <div class="input-group input-group-merge">
                                            <label for="example-text-input" class="col-md-3 col-form-label form-control-label">TITLE</label>
                                            <div class="col-md-9">
                                                <input class="form-control" name="title" value="{{@$personal_info->title}}" placeholder="MR / MRS / PROF" type="text" >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <div class="input-group input-group-merge">
                                            <label for="example-text-input" class="col-md-3 col-form-label form-control-label">SURNAME</label>
                                            <div class="col-md-9">
                                                <input class="form-control" name="surname" value="{{@$personal_info->surname}}" placeholder="First Name" type="text" >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <div class="input-group input-group-merge">
                                            <label for="example-text-input" class="col-md-3 col-form-label form-control-label">FIRST NAME</label>
                                            <div class="col-md-9">
                                                <input class="form-control" name="last_name" value="{{@$personal_info->first_name}}" placeholder="Last name" type="text" >
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <div class="input-group input-group-merge">
                                            <label for="example-text-input" class="col-md-3 col-form-label form-control-label">MIDDLE NAME</label>
                                            <div class="col-md-9">
                                                <input class="form-control" name="company" value="{{@$personal_info->middle_name}}" placeholder="Company" type="text" >
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <div class="input-group input-group-merge">
                                            <label for="example-text-input" class="col-md-3 col-form-label form-control-label">DATE OF BIRTH</label>
                                            <div class="col-md-9">
                                                <input class="form-control" name="score" value="{{@$personal_info->dob}}"  type="text">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <div class="input-group">
                                            <label for="example-text-input" class="col-md-3 col-form-label form-control-label">PLACE OF BIRTH </label>
                                            <div class="col-md-9">
                                                <input class="form-control" name="phone" type="text" value="{{@$personal_info->place_of_birth}}" >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <div class="input-group input-group-merge">
                                            <label for="example-text-input" class="col-md-3 col-form-label form-control-label">GENDER </label>
                                            <div class="col-md-9">
                                                <input class="form-control" name="email" value="{{@$personal_info->gender}}" placeholder="Email address" type="email" >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <div class="input-group input-group-merge">
                                            <label for="example-text-input" class="col-md-3 col-form-label form-control-label">NATIONALITY</label>
                                            <div class="col-md-9">
                                                <input class="form-control" name="address" value="{{@$personal_info->nationality}}" placeholder="Company" type="text" >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <div class="input-group input-group-merge">
                                            <label for="tags" class="col-md-3 col-form-label form-control-label">POSTAL ADDRESS</label>
                                            <div class="col-md-9">
                                                <input class="form-control" name="address" value="{{@$personal_info->postal_address}}" placeholder="Company" type="text" >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary  my-4">Submit</button>
                            </div>
                        </form>
                    </div>
            </div>
        </div>
    </div>
@endsection


@push('scripts')
    <script>
        $('#approval').on('change',function (e) {
            let value = $(this).val();

            if(value === 'Rejected')
            {
                $('#comment').removeClass('invisible')
            }
            else {
                $('#comment').addClass('invisible')
            }

        })
    </script>

    @endpush


