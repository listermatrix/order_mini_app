@extends('templates.master')
@section('content')


    <div class="col-md-12 spinner">
        <div class="d-flex justify-content-center">
            <div class="spinner-grow " style="width: 7rem; height: 7rem; color: #800020;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>

    </div>

    <div class="col-md-12 invisible" id="main-body">

        @if (count($errors) > 0)
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <ul>
                    @foreach($errors->all() as $error)
                        {{--<li>{{ $error }}</li>--}}
                        <li><strong>{{ $error }}</strong>.</li>

                    @endforeach
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </ul>
            </div>
        @endif

        @if (\Session::has('success'))
            <div class="alert alert-success">
                <ul>
                    <li>{!! \Session::get('success') !!}</li>
                </ul>
            </div>
        @endif
        <nav>
            <div class="nav nav-tabs md-tabs" id="nav-tab" role="tablist">
                <a class="nav-item nav-link  {{!$personal_info ? 'active' :''}} dark-grey-text" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Personal Info & etc</a>
                <a class="nav-item nav-link  {{$personal_info && !$education_background ? 'active' :''}} dark-grey-text" id="nav-school-tab" data-toggle="tab" href="#nav-school" role="tab" aria-controls="nav-school" aria-selected="false">Educational Background</a>
                <a class="nav-item nav-link  {{$education_background && count($education_history) == 0  ? 'active' :''}} dark-grey-text" id="nav-subject-tab" data-toggle="tab" href="#nav-subject" role="tab" aria-controls="nav-subject" aria-selected="false">Educational History</a>
                <a class="nav-item nav-link  {{count($education_history) > 0 && !$current_employer ? 'active' :''}} dark-grey-text" id="nav-current-tab" data-toggle="tab" href="#nav-current" role="tab" aria-controls="nav-qualification" aria-selected="false">Current Employer</a>
                <a class="nav-item nav-link  {{$current_employer && !$previous_employer ? 'active' :''}} dark-grey-text" id="nav-previous-tab" data-toggle="tab" href="#nav-previous" role="tab" aria-controls="nav-previous" aria-selected="false">Previous Employers</a>
                <a class="nav-item nav-link  {{$previous_employer && count($referee) == 0 ? 'active' :''}} dark-grey-text" id="nav-referee-tab" data-toggle="tab" href="#nav-referee" role="tab" aria-controls="nav-employment" aria-selected="false">Referees</a>
                <a class="nav-item nav-link  {{count($referee) > 1 && !$extra_info ? 'active' :''}} dark-grey-text" id="nav-additional-tab" data-toggle="tab" href="#nav-additional" role="tab" aria-controls="nav-sponsorship" aria-selected="false">Additional Information</a>
                <a class="nav-item nav-link  {{$extra_info && count($recommendation) == 0 ? 'active' :''}} dark-grey-text" id="nav-recommendation-tab" data-toggle="tab" href="#nav-recommendation" role="tab" aria-controls="nav-recommendation" aria-selected="false" style="font-weight: bold; color: #DC143C !important;">Recommendation</a>
                <a class="nav-item nav-link  {{count($recommendation) != 0  && !$payment ? 'active' :''}} dark-grey-text" id="nav-payment-tab" data-toggle="tab" href="#nav-payment" role="tab" aria-controls="nav-payment" aria-selected="false" style="font-weight: bold; color: #DC143C !important;"> Payment</a>
                <a class="nav-item nav-link  {{ $personal_info && $education_background && count($education_history) != 0 &&  $current_employer && $previous_employer &&  count($referee) != 0 && $extra_info && count($recommendation) != 0  && $payment ? 'active' :''}} dark-grey-text" id="nav-finish-tab" data-toggle="tab" href="#nav-finish" role="tab" aria-controls="nav-finish" aria-selected="false" style="font-weight: bold; color: #DC143C !important;"> Finish</a>
            </div>
        </nav>
        <div class="tab-content pt-5" id="nav-tabContent">
            {{--/***Personal Information Tab ****/--}}
            <div class="tab-pane fade {{!$personal_info ? 'show active' :''}}" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                <form class="border border-light p-5" method="post" action="{{route('applicant.masters.info.save',['request_code'=>$code])}}" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <h3 class="text-uppercase"><strong> Personal Information</strong></h3>
                    <hr>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="inputEmail4"><i class="fa fa-user text-dark"></i> Title </label>
                            @php $title = old('title',@$personal_info->title) @endphp
                            <select class="form-control" name="title">
                                <option></option>
                                <option value="Mr" {{$title == "Mr" ? 'selected' :''}}>Mr</option>
                                <option value="Ms" {{$title == "Ms" ? 'selected' :''}}>Ms</option>
                                <option value="Mrs" {{$title == "Mrs" ? 'selected' :''}}>Mrs</option>
                                <option value="Miss" {{$title == "Miss" ? 'selected' :''}}>Miss</option>
                                <option value="Rev" {{$title == "Rev" ? 'selected' :''}}>Rev</option>

                            </select>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="inputEmail4"><i class="fa fa-user text-dark"></i> Surname </label>
                            <input type="text" class="form-control" name="surname" value="{{old('surname',@$personal_info->surname)}}"  placeholder="Surname" autofocus>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="inputPassword4"><i class="fa fa-user text-dark"></i> First name </label>
                            <input type="text" class="form-control" name="first_name" value="{{old('first_name',@$personal_info->first_name)}}" placeholder="First name">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputPassword4"><i class="fa fa-user text-dark"></i> Middle name</label>
                            <input type="text" class="form-control" name="middle_name" value="{{old('middle_name',@$personal_info->middle_name)}}"  placeholder="Middle name">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputPassword4"><i class="fa fa-calendar text-dark"></i> Date of Birth  </label>
                            <input type="text" class="form-control birth" name="dob" value="{{old('dob',@$personal_info->dob)}}"  placeholder="date of birth">
                        </div>


                        <div class="form-group col-md-4">
                            <label for="inputPassword4"> <i class="fa fa-male text-dark"></i> Gender</label>
                            @php $value = @$personal_info->gender  @endphp
                            <select class="browser-default custom-select" name="gender">
                                <option></option>
                                <option value="MALE" {{$value == 'MALE' ? 'selected' : ''}}>MALE</option>
                                <option value="FEMALE" {{$value == 'FEMALE' ? 'selected' : ''}}>FEMALE</option>
                            </select>
                        </div>


                        <div class="form-group col-md-6">
                            <label for="inputPassword4"><i class="fa fa-map-marker text-dark"></i> Place of Birth</label>
                            <input type="text" class="form-control" name="place_of_birth" value="{{old('place_of_birth',@$personal_info->place_of_birth)}}" placeholder="place of birth">
                        </div>


                        <div class="form-group col-md-6">
                            <label for="inputPassword4"><i class="fa fa-id-card text-dark"></i>Nationality</label>
                            @php $value = @$personal_info->nationality  @endphp
                            <select class="browser-default custom-select" name="nationality">
                                <option></option>

                                @foreach($country as $nation)

                                    <option value="{{$nation->name}}" {{$value == $nation->name ? 'selected' : ''}}>{{$nation->name}}</option>

                                @endforeach
                                {{--<option value="GHANAIAN" {{$value == 'GHANAIAN' ? 'selected' : ''}}>GHANAIAN</option>--}}
                                {{--<option value="NIGERIAN" {{$value == 'NIGERIAN' ? 'selected' : ''}}>NIGERIAN</option>--}}
                                {{--<option value="MALIAN" {{$value == 'MALIAN' ? 'selected' : ''}}>MALIAN</option>--}}
                                {{--<option value="IVORIAN" {{$value == 'IVORIAN' ? 'selected' : ''}}>IVORIAN</option>--}}
                                {{--<option value="TOGOLAISE" {{$value == 'TOGOLAISE' ? 'selected' : ''}}>TOGOLAISE</option>--}}
                            </select>
                        </div>
                    </div>


                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="input"><i class="fa fa-address-book text-dark"></i> Business Address</label>
                            <textarea class="form-control" id="business_address" name="business_address">{{old('business_address',@$personal_info->business_address)}}</textarea>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="home_address"><i class="fa fa-address-book text-dark"></i> Home / Residential / Ghana Post GPS Address </label>
                            <textarea class="form-control" id="home_address" name="home_address">{{old('home_address',@$personal_info->home_address)}}</textarea>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="inputAddress2"><i class="fa fa-phone text-dark"></i>Mobile Phone </label>
                            <input type="text" class="form-control"  value="{{old('mobile_phone',@$personal_info->mobile_phone)}}"  name="mobile_phone" placeholder="Mobile Phone">
                        </div>


                        <div class="form-group col-md-6">
                            <label for="inputAddress2"><i class="fa fa-mail-bulk text-dark"></i> Regular Email Address </label>
                            <input type="email" class="form-control" value="{{old('email',@$personal_info->email)}}" name="email" placeholder="Email Address">
                        </div>
                    </div>

                    <h4>Data needed for Visa Application</h4>
                    <hr class="">

                    <div class="form-row">


                        <div class="form-group col-md-4">
                            <label for="id_number"><i class="fa fa-mail-bulk text-dark"></i> Identification Number </label>
                            <input type="text" id="id_number"  class="form-control" value="{{old('id_number',@$personal_info->id_number)}}" name="id_number" placeholder="Identification number">
                        </div>

                        <div class="form-group col-md-4">
                            <label for="passport_number"><i class="fa fa-mail-bulk text-dark"></i> Passport Number </label>
                            <input type="text" id="passport_number"  class="form-control" value="{{old('passport_number',@$personal_info->id_number)}}" name="passport_number" placeholder="Passport number">
                        </div>

                        <div class="form-group col-md-4">
                            <label for="place_of_issue"><i class="fa fa-map-marker text-dark"></i> Place of Issue </label>
                            <input type="text" id="place_of_issue"  class="form-control" value="{{old('place_of_issue',@$personal_info->place_of_issue)}}" name="place_of_issue" placeholder="Place">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="date_of_issue"><i class="fa fa-calendar text-dark"></i> Date of Issue </label>
                            <input type="date" id="date_of_issue"  class="form-control" value="{{old('date_of_issue',@$personal_info->date_of_issue)}}" name="date_of_issue" placeholder="Date">
                        </div>

                        <div class="form-grouptype_of_relation col-md-6">
                            <label for="date_of_expiration"><i class="fa fa-calendar text-dark"></i> Date of Expiration </label>
                            <input type="date" id="date_of_expiration"  class="form-control" value="{{old('date_of_expiration',@$personal_info->date_of_expiration)}}" name="date_of_expiration" placeholder="Date">
                        </div>


                        <div class="form-group col-md-12">
                            <label for="embassy"><i class="fa fa-mail-bulk text-dark"></i> Royal Dutch Embassy / <small>Consolate as place of issue of your visa</small> </label>
                            <textarea class="form-control" id="embassy" name="embassy" required>{{old('embassy',@$personal_info->embassy)}}</textarea>
                        </div>



                    </div>
                    <h4>Emergency Contact Information</h4>

                    <hr>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="person_to_be_notified"><i class="fa fa-user text-dark"></i> Person to be notified</label>
                            <input type="text" class="form-control" name="person_to_be_notified" id="person_to_be_notified" value="{{old('person_to_be_notified',@$personal_info->person_to_be_notified)}}" placeholder="Person to be notified" >
                        </div>


                        <div class="form-group col-md-4">
                            <label for="type_of_relation"><i class="fa fa-user text-dark"></i> Type of relation</label>
                            <input type="text" class="form-control" name="type_of_relation" id="type_of_relation" value="{{old('type_of_relation',@$personal_info->type_of_relation)}}" placeholder="Type of relation">
                        </div>


                        <div class="form-group col-md-4">
                            <label for="type_of_relation"><i class="fa fa-map-marker text-dark"></i> City</label>
                            <input type="text" class="form-control" name="city" id="city" value="{{old('city',@$personal_info->type_of_relation)}}" placeholder="City">
                        </div>

                        <div class="form-group col-md-4">
                            <label for="type_of_relation"><i class="fa fa-mail-bulk text-dark"></i> Postal Code </label>
                            <input type="text" class="form-control" name="postal_code" id="postal_code" value="{{old('postal_code',@$personal_info->type_of_relation)}}" placeholder="Postal Code">
                        </div>

                        <div class="form-group col-md-4">
                            <label for="inputPassword4"><i class="fa fa-id-card text-dark"></i>Country</label>
                            @php $value = @$personal_info->country  @endphp
                            <select class="browser-default custom-select" name="country">
                                <option></option>

                                @foreach($country as $nation)

                                    <option value="{{$nation->name}}" {{$value == $nation->name ? 'selected' : ''}}>{{$nation->name}}</option>

                                @endforeach

                            </select>
                        </div>


                        <div class="form-group col-md-4">
                            <label for="em_home_phone"><i class="fa fa-phone text-dark"></i> Home Phone </label>
                            <input type="text" class="form-control" name="em_home_phone" id="em_home_phone" value="{{old('em_home_phone',@$personal_info->em_home_phone)}}" placeholder="Home Phone" required>
                        </div>


                        <div class="form-group col-md-6">
                            <label for="em_mobile_phone"><i class="fa fa-phone text-dark"></i> Mobile Phone </label>
                            <input type="text" class="form-control" name="em_mobile_phone" id="em_mobile_phone" value="{{old('em_mobile_phone',@$personal_info->em_mobile_phone)}}" placeholder="Mobile Phone" required>
                        </div>



                        <div class="form-group col-md-6">
                            <label for="address"><i class="fa fa-address-book text-dark"></i> Address </label>
                            <input type="text" class="form-control" name="address" id="address" value="{{old('address',@$personal_info->address)}}" placeholder="Address" required>
                        </div>


                        <div class="form-group col-md-6">
                            <label for="address"><i class="fa fa-address-book text-dark"></i> Regular Email Address </label>
                            <input type="text" class="form-control" name="em_email" id="address" value="{{old('em_email',@$personal_info->em_email)}}" placeholder="Email" required>
                        </div>



                    </div>


                    <div class="col-md-4 offset-md-10">
                        <button type="submit" class="btn btn-md btn-dark-green lato">Submit</button>
                    </div>
                </form>
            </div>

            <div class="tab-pane fade {{$personal_info && !$education_background ? 'show active' :''}}" id="nav-school" role="tabpanel" aria-labelledby="nav-school-tab">
                <div class="col-md-10">
                    <div class="justify-content-center">
                        <form class="border border-light p-5" method="post" action="{{route('applicant.masters.education.background',['request_code'=>$code])}}">
                            {{csrf_field()}}
                            <h4 class="text-uppercase"><strong> Educational Background</strong></h4>
                            <hr>
                            <div class="form-row">
                                <div class="form-group col-md-7">
                                    {{--education_background--}}
                                    <label for="highest"><i class="fa fa-university"></i> Highest Qualification Name </label>
                                    @php $var = @$education_background->highest_qualification @endphp
                                    <select class="custom-select" required id="highest" name="highest_qualification">
                                        <option></option>
                                        <option value="PhD Degree"      {{$var == 'PhD' ? 'selected' : ''}}>PhD</option>
                                        <option value="Master Degree"   {{$var == 'Master Degree' ? 'selected' : ''}}  >Masters Degree</option>
                                        <option value="Bachelor Degree"   {{$var == 'Bachelor Degree' ? 'selected' : ''}} >Bachelors Degree</option>
                                        <option value="College Degree"    {{$var == 'College Degree' ? 'selected' : ''}}>College Degree</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-7">
                                    <label for="comment"><i class="fa fa-comment"></i> List Any Academic Distinctions, Honors or Scholarships Received</label>
                                    <textarea class="form-control" id="comment"  name="academic_distinctions" rows="3">{{old('academic_distinctions',@$education_background->academic_distinctions)}}

                                    </textarea>
                                </div>
                            </div>
                            <hr>
                            <div class="col-md-4 offset-md-10">
                                <button type="submit" class="btn btn-md btn-dark-green lato">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade {{$education_background && count($education_history) == 0 ? 'show active' :''}}" id="nav-subject" role="tabpanel" aria-labelledby="nav-subject-tab">
                <form class="border border-light p-5" method="post" action="{{route('applicant.masters.education.history',['request_code'=>$code])}}">
                                    {{csrf_field()}}
                    <h4 class="text-uppercase"><strong>Educational History </strong></h4>
                    <hr>
                    <div class="form-row">

                        <div class="form-group col-md-7">
                            <label for="comment"><i class="fa fa-comment"></i> Educational Institution / University </label>
                            <input type="text" class="form-control" id="comment"  name="educational_institution" >

                        </div>

                        <div class="form-group col-md-5">
                            <label for="highest"><i class="fa fa-university"></i> Degree / Diploma Obtained </label>
                            @php $var = @$education_background->highest_qualification @endphp
                            <select class="custom-select" required id="highest" name="certificate_obtained">
                                <option></option>
                                <option value="Master Degree"   {{$var == 'Diploma ' ? 'selected' : ''}}  >Diploma </option>
                                <option value="Bachelor Degree"   {{$var == 'Degree' ? 'selected' : ''}} > Degree</option>

                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="highest"><i class="fa fa-university"></i> Start Date </label>
                            <input class="form-control" name="start_date" type="date" >
                        </div>

                        <div class="form-group col-md-3">
                            <label for="highest"><i class="fa fa-university"></i> Finish Date </label>
                            <input class="form-control" name="finish_date" type="date" >
                        </div>

                        <div class="form-group col-md-6">
                            <label for="highest"><i class="fa fa-university"></i> Specialization </label>
                            <input class="form-control" name="specialization" type="text" >
                        </div>
                    </div>


                    <div class="col-md-4 offset-md-10">
                        <button type="submit" class="btn btn-md btn-dark-green lato">Submit</button>
                    </div>
             </form>
                <table class="table">
                    <thead class="black white-text">
                        <tr>
                            <th scope="col">University / School</th>
                            <th scope="col">Froml </th>
                            <th scope="col">To </th>
                            <th scope="col">Certificate </th>
                            <th scope="col">Specialization</th>
                            <th scope="col">#</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($education_history as $edu_h)
                            <form method="post" action="{{route('applicant.employment.edit',['id'=>$edu_h->id])}}">
                                {{csrf_field()}}
                                <tr>
                                    <td><input name="educational_institution" value="{{@$edu_h->educational_institution}}" class="form-control"></td>
                                    <td><input name="start_date" value="{{@$edu_h->start_date}}" type="text" class="form-control"></td>
                                    <td><input name="finish_date"   value="{{@$edu_h->finish_date}}" type="text" class="form-control"></td>
                                    <td><input name="certificate_obtained"   value="{{@$edu_h->certificate_obtained}}" type="text" class="form-control"></td>
                                    <td><textarea name="specialization" class="form-control">{{@$edu_h->specialization}}</textarea></td>
                                    <td><button type="submit" class="btn btn-sm rounded btn-dark-green lato"> Save</button></td>
                                </tr>
                            </form>
                        @endforeach
                            </tbody>
                                </table>
            </div>

            <div class="tab-pane fade {{count($education_history) > 0 && !$current_employer ? 'show active' :''}}" id="nav-current" role="tabpanel" aria-labelledby="nav-qualification-tab">
                <form class="border border-light p-5" method="post" action="{{route('applicant.masters.current.employer',['request_code'=>$code])}}">
                                    {{csrf_field()}}
                        <h4 class="text-uppercase"><strong> Current Employer </strong></h4>
                        <hr>

                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="address"><i class="fa fa-university text-dark"></i> Name of Organization / Company </label>
                                <input type="text" class="form-control" name="company" id="company" value="{{old('company',@$current_employer->company)}}" placeholder="Name of Organization" required>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="highest"><i class="fa fa-university"></i>Type of Organization </label>
                                @php $var = @$current_employer->organization_type @endphp
                                <select class="custom-select" required id="highest" name="organization_type">
                                    <option></option>
                                    <option value="Government"      {{$var == 'Government' ? 'selected' : ''}}>Government</option>
                                    <option value="Semi-Government"   {{$var == 'Semi-Government' ? 'selected' : ''}}  >Semi-Government</option>
                                    <option value="NGO"   {{$var == 'NGO' ? 'selected' : ''}} >NGO</option>
                                    <option value="Private Company"    {{$var == 'Private Company' ? 'selected' : ''}}>Private Company</option>
                                </select>

                            </div>

                            <div class="form-group col-md-4">
                                <label for="address"><i class="fa fa-address-book text-dark"></i> Business Address </label>
                                <input type="text" class="form-control" name="business_address" id="business_address" value="{{old('address',@$current_employer->business_address)}}" placeholder="Address" required>
                            </div>



                            <div class="form-row">

                                <div class="form-group col-md-4">
                                                <label for="address"><i class="fa fa-map-marker text-dark"></i> City </label>
                                                <input type="text" class="form-control" name="city" id="city" value="{{old('city',@$current_employer->city)}}" placeholder="City" required>
                                            </div>

                                            <div class="form-group col-md-4">
                                                <label for="address"><i class="fa fa-mail-bulk text-dark"></i> Postal Code </label>
                                                <input type="text" class="form-control" name="postal_code" id="postal_code" value="{{old('postal_code',@$current_employer->city)}}" placeholder=" Postal Code" required>
                                            </div>


                                            <div class="form-group col-md-4">
                                                <label for="country"><i class="fa fa-map-marker text-dark"></i> Country </label>

                                                 <select class="form-control" id="country" name="country">
                                                <option></option>

                                                @foreach($country as $nation)

                                                    <option value="{{$nation->name}}" {{$value == 'GHANAIAN' ? 'selected' : ''}}>{{$nation->name}}</option>

                                                @endforeach
                                                   </select>

                                            </div>


                                            <div class="form-group col-md-6">
                                                <label for="address"><i class="fa fa-phone text-dark"></i> Business Phone </label>
                                                <input type="text" class="form-control" name="business_phone" id="business_phone" value="{{old('business_phone',@$current_employer->business_phone)}}" placeholder="Business Phone " required>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label for="address"><i class="fa fa-mail-bulk text-dark"></i> Email </label>
                                                <input type="text" class="form-control" name="email" id="email" value="{{old('email',@$current_employer->email)}}" placeholder=" email" required>
                                            </div>

                                        </div>
                                    </div>

                                  <div class="form-row">

                                    <div class="form-group col-md-6">
                                        <label for="address"><i class="fa fa-user text-dark"></i> Current Position </label>
                                        <input type="text" class="form-control" name="position" id="position" value="{{old('position',@$current_employer->position)}}" placeholder="Position" required>
                                    </div>


                                    <div class="form-group col-md-6">
                                        <label for="address"><i class="fa fa-calendar text-dark"></i> Since Date </label>
                                        <input type="date" class="form-control" name="since_date" id="since_date" value="{{old('since_date',@$current_employer->since_date)}}" placeholder="since (mm/dd/yy)" required>
                                    </div>


                                    <div class="form-group col-md-12">
                                        <label for="job_description"><i class="fa fa-comment text-dark"></i> Job Description  </label>
                                        <textarea class="form-control" name="job_description" id="job_description">{{old('job_description',@$current_employer->job_description)}}</textarea>
                                    </div>



                                  </div>



                                    <div class="col-md-4 offset-md-10">
                                        <button type="submit" class="btn btn-md btn-dark-green lato">Submit</button>
                                    </div>
                                </form>
                <hr>
            </div>

            {{--  Previous --}}
            <div class="tab-pane fade {{ $current_employer  && !$previous_employer ? 'show active' :'' }}" id="nav-previous" role="tabpanel" aria-labelledby="nav-previous-tab-tab">
                <form class="border border-light p-5" method="post" action="{{route('applicant.masters.previous.employer',['request_code'=>$code])}}">
                    {{csrf_field()}}
                    <h4 class="text-uppercase"><strong> Previous Employer </strong></h4>
                    <hr>
                    <div class="form-row">


                        <div class="form-group col-md-4">
                            <label for="address"><i class="fa fa-university text-dark"></i> Name of Organization / Company </label>
                            <input type="text" class="form-control" name="company" id="company" value="{{old('company',@$previous_employer->company)}}" placeholder="Organization" required>
                        </div>


                        <div class="form-group col-md-4">
                            <label for="start_date"><i class="fa fa-address-book text-dark"></i> Start Date  </label>
                            <input type="date" class="form-control" name="start_date" id="start_date" value="{{old('address',@$previous_employer->start_date)}}" placeholder="" >
                        </div>


                        <div class="form-group col-md-4">
                            <label for="address"><i class="fa fa-map-marker text-dark"></i> Finish Date </label>
                            <input type="date" class="form-control" name="finish_date" id="finish_date" value="{{old('finish_date',@$previous_employer->finish_date)}}"  >
                        </div>


                        <div class="form-group col-md-6">
                            <label for="job_description"><i class="fa fa-map-marker text-dark"></i> Job Description  </label>
                            <textarea class="form-control" rows="4" name="job_description">{{old('job_description',@$previous_employer->job_description)}}</textarea>
                        </div>

                        </div>


                    <div class="col-md-4 offset-md-10">
                        <button type="submit" class="btn btn-md btn-dark-green lato">Submit</button>
                    </div>
                </form>
                <hr>
            </div>

            {{-- Referee --}}
            <div class="tab-pane fade {{$previous_employer && count($referee) < 1 ? 'show active' :'' }}" id="nav-referee" role="tabpanel" aria-labelledby="nav-referee-tab-tab">
                <form class="border border-light p-5" method="post" action="{{route('applicant.masters.referee.save',['request_code'=>$code])}}">
                    {{csrf_field()}}
                    <h4 class="text-uppercase"><strong> REFEREE </strong></h4>
                    <hr>
                    <div class="form-row">


                        <div class="form-group col-md-6">
                            <label for="name"><i class="fa fa-user-circle text-dark"></i> Name of Referee </label>
                            <input type="text" class="form-control" name="name" id="name" value="{{old('name')}}" placeholder="Name of referee" required>
                        </div>


                        <div class="form-group col-md-6">
                            <label for="position"><i class="fa fa-poo-storm text-dark"></i> Position </label>
                            <input type="text" class="form-control" name="position" id="position" value="{{old('position')}}" placeholder="" >
                        </div>

                    </div>

                    <div class="col-md-4 offset-md-10">
                        <button type="submit" class="btn btn-md btn-dark-green lato">Submit</button>
                    </div>
                </form>
                <hr>

                <table class="table">
                    <thead class="black white-text">
                    <tr>
                        <th scope="col">Name Of Referee</th>
                        <th scope="col">Positions </th>
                        <th scope="col">#</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($referee as $whip)
                        <form method="post" action="{{route('applicant.masters.referee.edit',['id'=>$whip->id])}}">
                            {{csrf_field()}}
                            <tr>
                                <td><input name="name" value="{{@$whip->name}}" class="form-control"></td>
                                <td><input name="position" value="{{@$whip->position}}" type="text" class="form-control"></td>
                                <td><button type="submit" class="btn btn-sm rounded btn-dark-green lato"> Save</button></td>
                            </tr>
                        </form>
                    @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Additonal Information --}}
            <div class="tab-pane fade {{ count($referee) > 1 && !$extra_info  ? 'show active' :''}}" id="nav-additional" role="tabpanel" aria-labelledby="nav-additional-tab">
                <form class="border border-light p-5" method="post" action="{{route('applicant.masters.save_extra_info.save',['request_code'=>$code])}}">
                    {{csrf_field()}}
                    <h4 class="text-uppercase"><strong> ADDITIONAL INFORMATION</strong></h4>
                    <hr>
                    <div class="form-row">

                        <div class="form-group col-md-6">
                            <label for="objectives"><i class="fa fa-university text-dark"></i> What are your Professional / Learning Objectives For This Study ? </label>
                              <textarea class="form-control" name="objectives">{{old('objectives',@$extra_info->objectives)}}</textarea>
                        </div>


                        <div class="form-group col-md-6">
                            <label for="start_date"><i class="fa fa-address-book text-dark"></i> List Your Most Important Expectations regarding this study  </label>
                            <textarea class="form-control" name="expectations">{{old('expectations',@$extra_info->expectations)}}</textarea>
                        </div>


                        <div class="form-group col-md-6">
                            <label for="address"><i class="fa fa-map-marker text-dark"></i> What Other Information would you like to add ? </label>
                            <textarea class="form-control" name="other_info">{{old('other_info',@$extra_info->other_info)}}</textarea>
                        </div>


                        <div class="form-group col-md-6">
                            <label for="recommender"><i class="fa fa-map-marker text-dark"></i> Who recommended you to this program ?  </label>
                            <textarea class="form-control" name="recommender">{{old('recommender',@$extra_info->recommender)}}</textarea>

                        </div>

                    </div>

                    <hr>

                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="objectives"><i class="fa fa-signature text-dark"></i> STATEMENT</label>
                            <hr>
                            <p>
                                I hereby certify that information given in this  application form is complete and accurate to the best of my knowledge.
                                I permit the Maastricht School of Management or  its agents to use all reasonable means necessary to verify the information
                                I have provided in this application
                            </p>
                            <p>
                                I am aware of the  amount of the tuition fee and I cetify that I have the means to pay for the fees.
                            </p>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="objectives"><i class="fa fa-check-circle text-dark"></i> Approval</label>

                            <select class="form-control" required name="approval">
                                <option></option>
                                <option value="yes"{{@$extra_info->approval == 'yes' ? 'selected' : '' }}>Yes</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="objectives"><i class="fa fa-calendar text-dark"></i> Date</label>
                            <input type="text" class="form-control" value="{{empty($extra_info) ? \Illuminate\Support\Carbon::parse(now()) : $extra_info->date}}" readonly>
                        </div>
                    </div>





                    <div class="col-md-4 offset-md-10">
                        <button type="submit" class="btn btn-md btn-dark-green lato">Submit</button>
                    </div>
                </form>
                <hr>
            </div>

            {{-- Recommendation --}}
            <div class="tab-pane fade {{count($recommendation) < 0 && $previous_employer ? 'show active' :''}}" id="nav-recommendation" role="tabpanel" aria-labelledby="nav-recommendation-tab">
                <form class="border border-light p-5" method="post" action="{{route('applicant.masters.recommendation.save',['request_code'=>$code])}}" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <h3 class="text-uppercase"><strong> RECOMMENDATION  </strong></h3>
                    <hr>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="is_english_studies"><i class="fa fa-file-alt text-dark"></i> File</label>
                            <input class="form-control" type="file" name="recommendation_file[]" multiple>
                        </div>
                    </div>
                    <div class="col-md-4 offset-md-10">
                        <button type="submit" class="btn btn-md btn-dark-green lato">Submit</button>
                    </div>
                </form>
                <hr>

                <div class="row">
                    <div class="col-md-8">
                        @foreach($recommendation as $file)
                            <ul class="list-group">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <a href="{{$file->id}}">{{$file->file_name}}</a>

                                    <a class="btn btn-sm rounded btn-dark-green" href="{{asset('storage/forms/recommendations/'.$file->file_name)}}"><i class="fa fa-eye"></i></a>
                                    <a class="btn btn-sm rounded btn-danger" href="{{route('applicant.masters.recommendation.delete',['id'=>$file->id])}}"><i class="fa fa-trash"></i></a>
                                </li>
                            </ul>
                        @endforeach
                    </div>
                </div>


            </div>

            {{-- Payment fonm --}}
            <div class="tab-pane fade {{count($recommendation) > 0 && !$payment  ? 'show active' :''}}" id="nav-payment" role="tabpanel" aria-labelledby="nav-payment-tab">
                <form class="border border-light p-5" method="post" action="{{route('applicant.store.payment',['request_code'=>$code])}}" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                    <h3 class="text-uppercase"><strong> Payment </strong></h3>
                                    <hr>
                                    <div class="form-row">

                                        <div class="form-group col-md-3">
                                            <label for="receipt_no"><i class="fa fa-money-bill text-dark"></i> PAYMENT METHOD </label>
                                            <!-- Default unchecked -->
                                            <div class="custom-control custom-radio">
                                                <input type="radio" class="custom-control-input type" value="momo" id="defaultUnchecked" name="type">
                                                <label class="custom-control-label" for="defaultUnchecked">Mobile Money</label>
                                            </div>


                                            <!-- Default checked -->
                                            <div class="custom-control custom-radio">
                                                <input type="radio" class="custom-control-input type" value="bank" id="defaultChecked" name="type" checked>
                                                <label class="custom-control-label" for="defaultChecked">Bank</label>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-4 phone">
                                            <label for="receipt_no"><i class="fa fa-money-bill-wave-alt text-dark"></i> Phone </label>
                                            <input class="form-control reference" id="mobile_number" type="text" value="{{old('mobile_number',@$payment->mobile_number)}}" name="mobile_number">
                                        </div>

                                        <div class="form-group col-md-4 bank">
                                            <label for="receipt_no"><i class="fa fa-money-bill-wave-alt text-dark"></i> BANK NAME </label>
                                            @php  $var = @$payment->bank  @endphp
                                            <select class="form-control selected-bank" name="bank">
                                                <option></option>
                                                <option value="ECOBANK GHANA LTD" {{$var == 'ECOBANK GHANA LTD' ? 'selected' : ''}}>ECOBANK GHANA LTD</option>
                                                <option value="ACCESS BANK" {{$var == 'ACCESS BANK' ? 'selected' : ''}}>ACCESS BANK</option>
                                                <option value="HFC BANK" {{$var == 'HFC BANK' ? 'selected' : ''}}>HFC BANK</option>
                                                <option value="CONSOLIDATED BANK OF GHANA (CBG)" {{$var == 'CONSOLIDATED BANK OF GHANA (CBG)' ? 'selected' : ''}}>CONSOLIDATED BANK OF GHANA (CBG)</option>
                                            </select>
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label for="receipt_no"><i class="fa fa-money-bill-wave-alt text-dark"></i> Payment Reference Number </label>
                                            <input class="form-control reference" id="receipt_no" type="text" value="{{old('receipt_no',@$payment->pay_receipt_no)}}" name="receipt_no" required>
                                        </div>

                                    </div>

                                    <hr>
                                    <div class="col-md-4 offset-md-10">
                                        <button type="submit" class="btn btn-md btn-dark-green lato">Submit</button>
                                    </div>
                                </form>
                    <hr>
            </div>


            {{-- Complete form --}}
            <div class="tab-pane fade {{$personal_info && $education_background && count($education_history) != 0 &&  $current_employer && $previous_employer &&  count($referee) != 0 && $extra_info && count($recommendation) != 0  && $payment  ? 'show active' :''}}" id="nav-finish" role="tabpanel" aria-labelledby="nav-finish-tab">
                <form class="border border-light p-5" method="post" action="{{route('applicant.masters.completed',['request_code'=>$code])}}" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <h3 class="text-uppercase"><strong> Completion </strong></h3>
                    <hr>
                    <div class="form-row">

                        <div class="form-group col-md-12">
                            <label for="receipt_no"><i class="fa fa-question-circle text-dark"></i> I HAVE MET ALL THE REQUIREMENTS IN THIS APPLICATION </label>
                            <!-- Default unchecked -->
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="yes" id="exampleRadios1" value="yes" {{!empty($process) ? 'checked' : ''}}>
                                <label class="form-check-label" for="exampleRadios1">
                                    Yes
                                </label>
                            </div>
                        </div>



                    </div>

                    <hr>
                    <div class="col-md-4 offset-md-10">
                        <button type="submit" class="btn btn-md btn-dark-green lato">Submit</button>
                    </div>
                </form>
                <hr>
            </div>





        </div>
    </div>


    <div class="modal fade" id="modelConfirm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h4 class="modal-title w-100 font-weight-bold"> Admission Preference</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="borer border-light p-5" method="post" action="{{route('applicant.admission.type',['request_code'=>$code])}}" enctype="multipart/form-data">
                    <div class="modal-body mx-3">
                        {{csrf_field()}}

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <!-- Default unchecked -->
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="admission_type" id="exampleRadios1" value="diploma" >
                                    <label class="form-check-label" for="exampleRadios1">
                                        Diploma/Certificate
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="admission_type" id="exampleRadios2" value="undergraduate" checked>
                                    <label class="form-check-label" for="exampleRadios2">
                                        Undergraduate
                                    </label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="admission_type" id="exampleRadios2" value="masters">
                                    <label class="form-check-label" for="exampleRadios2">
                                        Masters
                                    </label>
                                </div>


                            </div>


                        </div>

                        <div class="modal-footer d-flex justify-content-center">
                            <button class="btn btn-md btn-dark-green lato">Go </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        </div>



@endsection

@push('script')
    <script>
        //it means once the page has finished loading.............
        $(document).ready(function () {

            // $('#main-body').hide();

            //we start by hiding both forms

            var type = '{{$admission_type}}';

            if(type === '') {

                $('#modelConfirm').modal('toggle');
            }
            else {

                $('#main-body').removeClass('invisible');
                $('.spinner').hide();


            }

            $('.bank').hide();
            $('.momo').hide();

            //checks the mode of payment chosen of its momo or throgh the bank.
            $('.type').on('click',function () {
                let value = $(this).val(); // we pick the input value of the clicked element
                // we now compare the valiues with conditional statements  .. (if)
                if(value === 'bank'){
                    $('.bank').show();
                    $('.phone').hide();
                }
                else {
                    $('.bank').hide();
                    $('.phone').show();
                    // $('.selected-bank option:selected').prop("selected",false);
                    // $('.reference').val("");
                }
            });

            //for toggling admission type
            $('#admission-type').on('click',function (t) {
                t.preventDefault();
                $('#modelConfirm').modal('toggle');
            });

        })
    </script>
@endpush
