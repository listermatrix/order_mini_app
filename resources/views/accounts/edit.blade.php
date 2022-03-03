@extends('templates.template')
@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <!-- Card header -->
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                        <h3 class="mb-0 ">MSc Applicant</h3>
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

                            @if (\Session::has('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <span class="alert-icon"><i class="ni ni-like-2"></i></span>
                                    <span class="alert-text"><strong>Great!</strong> {!! \Session::get('success') !!}!</span>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                        </div>
                    </div>
                </div>
                    <div class="card-body">
                        <div class="nav-wrapper">
                            <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">

                                <li class="nav-item">
                                    <a class="nav-link mb-sm-3 mb-md-0 active" id="pinfo-tab" data-toggle="tab" href="#pinfo" role="tab" aria-controls="pinfo" aria-selected="true">Personal Info</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link mb-sm-3 mb-md-0 " id="academic_record-tab" data-toggle="tab" href="#academic_record" role="tab" aria-controls="academic_record" aria-selected="true">Educational Background</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link mb-sm-3 mb-md-0 " id="subjects-tab" data-toggle="tab" href="#subjects" role="tab" aria-controls="subjects" aria-selected="true">Education History</a>
                                </li>


                                <li class="nav-item">
                                    <a class="nav-link mb-sm-3 mb-md-0 " id="tabs-icons-text-1-tab" data-toggle="tab" href="#qualification" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true">Current Employer</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-2-tab" data-toggle="tab" href="#otherCourses" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false">Previous Employer</a>
                                </li>

                            </ul>

                            <br>

                            <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">

                                <li class="nav-item">
                                    <a class="nav-link mb-sm-3 mb-md-0" id="tabs-employment" data-toggle="tab" href="#employment" role="tab" aria-controls="tabs-icons-text-3" aria-selected="false">Additional Information</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-3-tab" data-toggle="tab" href="#recommendation" role="tab" aria-controls="tabs-icons-text-3" aria-selected="false">Recommendation</a>
                                </li>



                                <li class="nav-item">
                                    <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-3-tab" data-toggle="tab" href="#payment" role="tab" aria-controls="tabs-icons-text-3" aria-selected="false">Payment</a>
                                </li>


                                <li class="nav-item">
                                    <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-3-tab" data-toggle="tab" href="#status" role="tab" aria-controls="tabs-icons-text-3" aria-selected="false"><i class="fa fa-user-shield"></i> Admission Status</a>
                                </li>

                            </ul>
                        </div>

                        <div class="card shadow">
                            <div class="card-body">
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="pinfo" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
                                        <form>
                                            {{csrf_field()}}


                                            <div class="row">
                                            <div class="col-lg-4">

                                                <br>
                                                <br>
                                                    <h1 class="text-justify"> PERSONAL INFORMATION</h1>
                                                <hr>


                                            </div>
                                            </div>

                                            <p></p>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <div class="input-group input-group-merge">
                                                            <label for="example-text-input" class="col-md-3 col-form-label form-control-label">TITLE</label>
                                                            <div class="col-md-9">
                                                                <input class="form-control" name="title" value="{{@$personal_info->title}}" placeholder="MR / MRS / PROF" type="text" readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <div class="input-group input-group-merge">
                                                            <label for="example-text-input" class="col-md-3 col-form-label form-control-label">SURNAME</label>
                                                            <div class="col-md-9">
                                                                <input class="form-control" name="surname" value="{{@$personal_info->surname}}" placeholder="First Name" type="text" readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <div class="input-group input-group-merge">
                                                            <label for="example-text-input" class="col-md-3 col-form-label form-control-label">FIRST NAME</label>
                                                            <div class="col-md-9">
                                                                <input class="form-control" name="last_name" value="{{@$personal_info->first_name}}" placeholder="Last name" type="text" readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <div class="input-group input-group-merge">
                                                            <label for="example-text-input" class="col-md-3 col-form-label form-control-label">MIDDLE NAME</label>
                                                            <div class="col-md-9">
                                                                <input class="form-control" name="company" value="{{@$personal_info->middle_name}}" placeholder="Company" type="text" readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <div class="input-group input-group-merge">
                                                            <label for="example-text-input" class="col-md-3 col-form-label form-control-label">DATE OF BIRTH</label>
                                                            <div class="col-md-9">
                                                                <input class="form-control" name="score" value="{{@$personal_info->dob}}"  type="text" readonly="">
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
                                                                <input class="form-control" name="phone" type="text" value="{{@$personal_info->place_of_birth}}" readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <div class="input-group input-group-merge">
                                                            <label for="example-text-input" class="col-md-3 col-form-label form-control-label">GENDER </label>
                                                            <div class="col-md-9">
                                                                <input class="form-control" name="email" value="{{@$personal_info->gender}}" placeholder="Email address" type="email" readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <div class="input-group input-group-merge">
                                                            <label for="example-text-input" class="col-md-3 col-form-label form-control-label">NATIONALITY</label>
                                                            <div class="col-md-9">
                                                                <input class="form-control" name="address" value="{{@$personal_info->nationality}}" placeholder="Company" type="text" readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <div class="input-group input-group-merge">
                                                            <label for="tags" class="col-md-3 col-form-label form-control-label">POSTAL ADDRESS</label>
                                                            <div class="col-md-9">
                                                                <input class="form-control" name="address" value="{{@$personal_info->postal_address}}" placeholder="Company" type="text" readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>


                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <div class="input-group input-group-merge">
                                                            <label for="example-text-input" class="col-md-3 col-form-label form-control-label">RESIDENTIAL ADDRESS</label>
                                                            <div class="col-md-9">
                                                                <input class="form-control" name="title" value="{{@$personal_info->home_address}}" placeholder="MR / MRS / PROF" type="text" readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <div class="input-group input-group-merge">
                                                            <label for="example-text-input" class="col-md-3 col-form-label form-control-label">BUSINESS ADDRESS</label>
                                                            <div class="col-md-9">
                                                                <input class="form-control" name="first_name" value="{{@$personal_info->business_address}}" placeholder="First Name" type="text" readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <div class="input-group input-group-merge">
                                                            <label for="example-text-input" class="col-md-3 col-form-label form-control-label">HOME PHONE</label>
                                                            <div class="col-md-9">
                                                                <input class="form-control" name="last_name" value="{{@$personal_info->home_phone}}" placeholder="Last name" type="text" readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <div class="input-group input-group-merge">
                                                            <label for="example-text-input" class="col-md-3 col-form-label form-control-label">REGULAR EMAIL ADDRESS</label>
                                                            <div class="col-md-9">
                                                                <input class="form-control" name="company" value="{{@$personal_info->email}}" placeholder="Company" type="text" readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>



                                                        <h3 class="text-uppercase">Data needed for Visa Application </h3>
                                          <hr>


                                            <div class="row">

                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <div class="input-group input-group-merge">
                                                            <label for="example-text-input" class="col-md-3 col-form-label form-control-label">ID NUMBER</label>
                                                            <div class="col-md-9">
                                                                <input class="form-control" name="score" value="{{@$personal_info->id_number}}" placeholder="Score" type="text" readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <div class="input-group input-group-merge">
                                                            <label for="example-text-input" class="col-md-3 col-form-label form-control-label"> PASSPORT NUMBER</label>
                                                            <div class="col-md-9">
                                                                <input class="form-control" name="website" value="{{@$personal_info->passport_number}}" placeholder="Website" type="text" readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <div class="input-group">
                                                            <label for="example-text-input" class="col-md-3 col-form-label form-control-label">PLACE OF ISSUE </label>
                                                            <div class="col-md-9">
                                                                <input class="form-control" name="phone" value="{{@$personal_info->place_of_issue}}" placeholder="Phone" type="text" readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <div class="input-group input-group-merge">
                                                            <label for="example-text-input" class="col-md-3 col-form-label form-control-label">DATE OF ISSUE </label>
                                                            <div class="col-md-9">
                                                                <input class="form-control" name="date_of_issue" value="{{@$personal_info->date_of_issue}}"  readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <div class="input-group input-group-merge">
                                                            <label for="example-text-input" class="col-md-3 col-form-label form-control-label">DATE OF EXPIRATION </label>
                                                            <div class="col-md-9">
                                                                <input class="form-control" name="date_of_expiration" value="{{@$personal_info->date_of_expiration}}"  readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <div class="input-group input-group-merge">
                                                            <label for="example-text-input" class="col-md-3 col-form-label text-uppercase form-control-label">Place of issue of your visa </label>
                                                            <div class="col-md-9">
                                                                <textarea class="form-control" name="date_of_expiration" readonly>{{@$personal_info->embassy}}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>



                                            <h3 class="text-uppercase">Emergency Contact Information</h3>
                                            <hr>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <div class="input-group input-group-merge">
                                                            <label for="example-text-input" class="col-md-3 text-uppercase col-form-label form-control-label"> Person to be notified</label>
                                                            <div class="col-md-9">
                                                                <input class="form-control" name="address" value="{{@$personal_info->person_to_be_notified}}" placeholder="" type="text" readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <div class="input-group input-group-merge">
                                                            <label for="tags" class="col-md-3 col-form-label form-control-label text-uppercase">Type of relation</label>
                                                            <div class="col-md-9">
                                                                <input class="form-control" name="address" value="{{@$personal_info->type_of_relation}}" placeholder="" type="text" readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <div class="input-group input-group-merge">
                                                            <label for="example-text-input" class="col-md-3 col-form-label text-uppercase form-control-label">City</label>
                                                            <div class="col-md-9">
                                                                <input class="form-control" name="address" value="{{@$personal_info->city}}" placeholder="" type="text" readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <div class="input-group input-group-merge">
                                                            <label for="example-text-input" class="col-md-3 col-form-label text-uppercase form-control-label">Postal Code</label>
                                                            <div class="col-md-9">
                                                                <input class="form-control" name="address" value="{{@$personal_info->postal_code}}" placeholder="" type="text" readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <div class="input-group input-group-merge">
                                                            <label for="example-text-input" class="col-md-3 col-form-label text-uppercase form-control-label"> Home Phone</label>
                                                            <div class="col-md-9">
                                                                <input class="form-control" name="address" value="{{@$personal_info->em_home_phone}}" placeholder="" type="text" readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <div class="input-group input-group-merge">
                                                            <label for="example-text-input" class="col-md-3 col-form-label text-uppercase form-control-label">Mobile Phone</label>
                                                            <div class="col-md-9">
                                                                <input class="form-control" name="address" value="{{@$personal_info->em_mobile_phone}}" placeholder="" type="text" readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <div class="input-group input-group-merge">
                                                            <label for="example-text-input" class="col-md-3 col-form-label text-uppercase form-control-label">Address</label>
                                                            <div class="col-md-9">
                                                                <input class="form-control" name="address" value="{{@$personal_info->address}}" placeholder="" type="text" readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <div class="input-group input-group-merge">
                                                            <label for="example-text-input" class="col-md-3 col-form-label text-uppercase form-control-label"> Regular Email Address</label>
                                                            <div class="col-md-9">
                                                                <input class="form-control" name="address" value="{{@$personal_info->em_email}}" placeholder="" type="text" readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                        </form>
                                    </div>


                                    <div class="tab-pane fade" id="academic_record" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
                                        <form>

                                            <div class="row">
                                                <div class="col-lg-4">

                                                    <br>
                                                    <br>
                                                    <h1 class="text-justify"> EDUCATION BACKGROUND</h1>
                                                    <hr>

                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group row">
                                                        <div class="input-group input-group-merge">
                                                            <label for="example-text-input" class="col-md-4 col-form-label text-uppercase form-control-label">HIGHEST QUALIFICATION NAME</label>
                                                            <div class="col-md-8">
                                                                <input class="form-control" name="title" value="{{@$academic_records->highest_qualification}}" placeholder="MR / MRS / PROF" type="text" readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group row">
                                                        <div class="input-group input-group-merge">
                                                            <label for="example-text-input" class="col-md-4 col-form-label text-uppercase form-control-label">List Any Academic Distinctions, Honors or Scholarships Received</label>
                                                            <div class="col-md-8">
                                                                <textarea class="form-control" name="surname" placeholder="First Name" type="text" readonly>{{@$academic_records->academic_distinctions}}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>




                                        </form>
                                    </div>

                                    <div class="tab-pane fade" id="subjects" role="tabpanel" aria-labelledby="tabs-icons-text-3-tab">
                                        <form>

                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <br>
                                                    <br>
                                                    <h1 class="text-justify lato"> EDUCATIONAL HISTORY</h1>
                                                    <hr>

                                                </div>
                                            </div>


                                            <div class="table-responsive">
                                                <table class="table align-items-center table-flush">
                                                    <thead class="thead-light">
                                                    <tr>
                                                        <th scope="col" class="sort" data-sort="name">School</th>
                                                        <th scope="col" class="sort" data-sort="budget">From</th>
                                                        <th scope="col" class="sort" data-sort="status">To</th>
                                                        <th scope="col" class="sort" data-sort="status">Certificate</th>
                                                        <th scope="col" class="sort" data-sort="status">Specialization</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody class="list">
                                                    @foreach($subjects as $book)
                                                        <tr>
                                                            <td>
                                                                {{$book->educational_institution}}
                                                            </td>
                                                            <td class="budget">
                                                                {{$book->start_date == '0000-01-12' ? 'N/A' : strtoupper($book->start_date)}}
                                                            </td>
                                                            <td>
                                                                {{$book->finish_date == '0000-01-12' ? 'N/A' : strtoupper($book->finish_date)}}
                                                            </td>
                                                            <td>
                                                                {{strtoupper($book->certificate_obtained)}}
                                                            </td>

                                                            <td>
                                                                {{strtoupper($book->specialization)}}
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>


                                        </form>
                                    </div>

                                    <div class="tab-pane fade" id="qualification" role="tabpanel" aria-labelledby="tabs-icons-text-3-tab">
                                        <form>

                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <!-- Card image -->
                                                    <br>
                                                    <br>
                                                    <h1 class="text-justify lato"> CURRENT EMPLOYER</h1>
                                                    <hr>

                                                </div>
                                            </div>


                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <div class="input-group input-group-merge">
                                                            <label for="example-text-input" class="col-md-3 text-uppercase text-uppercase col-form-label form-control-label"> Name Company</label>
                                                            <div class="col-md-9">
                                                                <input class="form-control" name="title" value="{{@$employment->company}}" placeholder="MR / MRS / PROF" type="text" readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <div class="input-group input-group-merge">
                                                            <label for="example-text-input" class="col-md-3 text-uppercase col-form-label form-control-label">Type of Organization</label>
                                                            <div class="col-md-9">
                                                                <input class="form-control" name="surname" value="{{@$employment->organization_type}}" placeholder="First Name" type="text" readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <div class="input-group input-group-merge">
                                                            <label for="example-text-input" class="col-md-3 text-uppercase col-form-label form-control-label"> Business Address</label>
                                                            <div class="col-md-9">
                                                                <input class="form-control" name="last_name" value="{{@$employment->business_address}}" placeholder="Last name" type="text" readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <div class="input-group input-group-merge">
                                                            <label for="example-text-input" class="col-md-3  text-uppercase col-form-label form-control-label">City</label>
                                                            <div class="col-md-9">
                                                                <input class="form-control" name="company" value="{{@$employment->city}}" placeholder="Company" type="text" readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <div class="input-group input-group-merge">
                                                            <label for="example-text-input" class="col-md-3  text-uppercase col-form-label form-control-label">Postal Code</label>
                                                            <div class="col-md-9">
                                                                <input class="form-control" name="score" value="{{@$employment->postal_code}}"  type="text" readonly="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <div class="input-group input-group-merge">
                                                            <label for="example-text-input" class="col-md-3 text-uppercase col-form-label form-control-label">Country</label>
                                                            <div class="col-md-9">
                                                                <input class="form-control" name="score" value="{{@$employment->country}}"  type="text" readonly="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <div class="input-group input-group-merge">
                                                            <label for="example-text-input" class="col-md-3 text-uppercase col-form-label form-control-label">Business Phone</label>
                                                            <div class="col-md-9">
                                                                <input class="form-control" name="score" value="{{@$employment->business_phone}}"  type="text" readonly="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <div class="input-group input-group-merge">
                                                            <label for="example-text-input" class="col-md-3 text-uppercase col-form-label form-control-label"> Since Date</label>
                                                            <div class="col-md-9">
                                                                <input class="form-control" name="score" value="{{@$employment->since_date}}"  type="text" readonly="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <div class="input-group input-group-merge">
                                                            <label for="example-text-input" class="col-md-3  text-uppercase col-form-label form-control-label">  Job Description</label>
                                                            <div class="col-md-9">
                                                                <textarea class="form-control" rows="3" name="score"   type="text" readonly>{{@$employment->job_description}}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <div class="input-group input-group-merge">
                                                            <label for="example-text-input" class="col-md-3  text-uppercase col-form-label form-control-label"> Email</label>
                                                            <div class="col-md-9">
                                                                <input class="form-control" name="score" value="{{@$employment->email}}"  type="text" readonly="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>




                                        </form>
                                    </div>

                                    <div class="tab-pane fade" id="otherCourses" role="tabpanel" aria-labelledby="tabs-icons-text-3-tab">
                                        <form>

                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <br>
                                                    <br>
                                                    <h1 class="text-justify lato"> PREVIOUS  EMPLOYER</h1>
                                                    <hr>

                                                </div>
                                            </div>


                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <div class="input-group input-group-merge">
                                                            <label for="example-text-input" class="col-md-3 text-uppercase text-uppercase col-form-label form-control-label"> Name Company</label>
                                                            <div class="col-md-9">
                                                                <input class="form-control" name="title" value="{{@$sponsorship->company}}" placeholder="MR / MRS / PROF" type="text" readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <div class="input-group input-group-merge">
                                                            <label for="example-text-input" class="col-md-3 text-uppercase col-form-label form-control-label">Start Date</label>
                                                            <div class="col-md-9">
                                                                <input class="form-control" name="surname" value="{{@$sponsorship->start_date == '0000-01-12' ? 'N/A' : @$sponsorship->start_date}}" placeholder="First Name" type="text" readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <div class="input-group input-group-merge">
                                                            <label for="example-text-input" class="col-md-3 text-uppercase col-form-label form-control-label"> Finish Date</label>
                                                            <div class="col-md-9">
                                                                <input class="form-control" name="last_name" value="{{@$sponsorship->finish_date == '0000-01-12' ? 'N/A' : @$sponsorship->finish_date}}" placeholder="Last name" type="text" readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <div class="input-group input-group-merge">
                                                            <label for="example-text-input" class="col-md-3  text-uppercase col-form-label form-control-label">  Job Description</label>
                                                            <div class="col-md-9">
                                                                <textarea class="form-control" rows="3" name="score"   type="text" readonly>{{@$sponsorship->job_description}}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>




                                        </form>
                                    </div>

                                    <div class="tab-pane fade" id="employment" role="tabpanel" aria-labelledby="tabs-icons-text-3-tab">
                                        <form>

                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <!-- Card image -->
                                                    <br>
                                                    <br>
                                                    <h1 class="text-justify lato"> ADDITONAL INFORMATION</h1>
                                                    <hr>

                                                </div>
                                            </div>


                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group row">
                                                        <div class="input-group input-group-merge">
                                                            <label for="example-text-input" class="col-md-6 text-uppercase text-uppercase col-form-label form-control-label">What are your Professional / Learning Objectives For This Study ?</label>
                                                            <div class="col-md-6">
                                                                <textarea class="form-control" readonly>{{@$otherCourses->objectives}}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group row">
                                                        <div class="input-group input-group-merge">
                                                            <label for="example-text-input" class="col-md-6 text-uppercase col-form-label form-control-label"> List Your Most Important Expectations regarding this study</label>
                                                            <div class="col-md-6">
                                                                <textarea class="form-control" readonly>{{@$otherCourses->expectations}}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group row">
                                                        <div class="input-group input-group-merge">
                                                            <label for="example-text-input" class="col-md-6 text-uppercase col-form-label form-control-label"> What Other Information would you like to add ?</label>
                                                            <div class="col-md-6">
                                                                <textarea class="form-control" readonly>{{@$otherCourses->other_info}}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group row">
                                                        <div class="input-group input-group-merge">
                                                            <label for="example-text-input" class="col-md-6  text-uppercase col-form-label form-control-label">  Who recommended you to this program ?</label>
                                                            <div class="col-md-6">
                                                                <textarea class="form-control" rows="3" name="score"   type="text" readonly>{{@$otherCourses->recommender}}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                            <hr>
                                                <h3 class="text-uppercase"><i class="fa fa-signature"></i> STATEMENT</h3>
                                                <hr>
                                            <div class="row">
                                                <p class="text-justify">
                                                    I hereby certify that information given in this application form is complete and accurate to the best of my knowledge. I permit the Maastricht School of Management or its agents to use all reasonable means necessary to verify the information I have provided in this application

                                                    I am aware of the amount of the tuition fee and I cetify that I have the means to pay for the fees.
                                                </p>


                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <div class="input-group input-group-merge">
                                                            <label for="example-text-input" class="col-md-3 text-uppercase text-uppercase col-form-label form-control-label">Approval </label>
                                                            <div class="col-md-6">
                                                                <input type="text" class="form-control" value="{{@$otherCourses->approval}}" readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <div class="input-group input-group-merge">
                                                            <label for="example-text-input" class="col-md-3 text-uppercase text-uppercase col-form-label form-control-label">Date</label>
                                                            <div class="col-md-6">
                                                                <input type="text" class="form-control" value="{{@$otherCourses->date}}" readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>



                                            </div>


                                        </form>
                                    </div>

                                    <div class="tab-pane fade" id="recommendation" role="tabpanel" aria-labelledby="tabs-icons-text-3-tab">
                                        <form>

                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <!-- Card image -->
                                                    <br>
                                                    <br>
                                                    <h1 class="text-justify lato"> RECOMMENDATION FORM</h1>
                                                    <hr>

                                                </div>
                                            </div>


                                            <div class="table-responsive">
                                                <table class="table align-items-center table-flush">
                                                    <thead class="thead-light">
                                                    <tr>
                                                        <th scope="col" class="sort" data-sort="name">Document</th>
                                                        <th scope="col" class="sort" data-sort="budget">Created At</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody class="list">
                                                    @foreach($recommendation as $file)
                                                        <tr>
                                                            <td>
                                                               <a class="btn btn-default btn-sm" href="{{asset('storage/forms/recommendations/'.$file->file_name)}}">{{$file->file_name}}</a>
                                                            </td>
                                                            <td class="budget">
                                                                {{strtoupper($file->created_at)}}
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>


                                        </form>
                                    </div>

                                    <div class="tab-pane fade" id="payment" role="tabpanel" aria-labelledby="tabs-icons-text-3-tab">
                                        <form>

                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <!-- Card image -->
                                                    <br>
                                                    <br>
                                                    <h1 class="text-justify lato"> Payment</h1>
                                                    <hr>

                                                </div>
                                            </div>


                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <div class="input-group input-group-merge">
                                                            <label for="example-text-input" class="col-md-3 col-form-label form-control-label">MEDIUM</label>
                                                            <div class="col-md-9">
                                                                <input class="form-control" name="title" value="{{@$payment->bank == 'N/A' ? @$payment->mobile_number : @$payment->bank}}" placeholder="" type="text" readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <div class="input-group input-group-merge">
                                                            <label for="example-text-input" class="col-md-3 col-form-label form-control-label">REFERENCE NUMBER</label>
                                                            <div class="col-md-9">
                                                                <input class="form-control" name="surname" value="{{@$payment->pay_receipt_no}}" readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                        </form>
                                    </div>

                                    <div class="tab-pane fade" id="status" role="tabpanel" aria-labelledby="tabs-icons-text-3-tab">
                                        <form method="post" action="{{route('transaction.masters.approval',['request_code'=>$request_code])}}">
                                            {{csrf_field()}}
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <!-- Card image -->
                                                    <br>
                                                    <br>
                                                    <h1 class="text-justify lato"> ADMISSION STATUS</h1>
                                                    <hr>
                                                </div>
                                            </div>


                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <div class="input-group input-group-merge">
                                                            <label for="approval" class="col-md-3 col-form-label form-control-label">STATUS</label>
                                                            @php $var = @$verify->status @endphp
                                                            <div class="col-md-9">
                                                                <select class="form-control" name="status" data-toggle="select"  id="approval">
                                                                    <option></option>
                                                                    <option value="Approved" {{$var == 'Approved' ? 'selected' : ''}}>Approved</option>
                                                                    <option value="Rejected" {{$var == 'Rejected' ? 'selected' : ''}}>Disapproved</option>
                                                                </select>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row {{!empty($var) && $var == 'Rejected' ? '' :'invisible'}} " id="comment">
                                                        <div class="input-group input-group-merge">
                                                            <label for="comment" class="col-md-3 col-form-label form-control-label">COMMENT</label>
                                                            <div class="col-md-9">
                                                                <textarea class="form-control" name="comment" id="comment">{{@$verify->comment}}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="offset-9">
                                                    <button class="btn  btn-default">SAVE <i class="fa fa-plus-circle"></i></button>
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


