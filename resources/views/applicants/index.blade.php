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
                    <a class="nav-item nav-link  {{!$records && count($schools) == 0 &&  count($subjects) == 0 && count($qualifications) == 0 && !$others  && count($employment) == 0 && !$sponsorship && !$honor && count($recommendation) == 0  ? 'active' :''}} dark-grey-text" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Personal Info & etc</a>
                    <a class="nav-item nav-link  {{$records && count($schools) == 0 ? 'active' :''}} dark-grey-text" id="nav-school-tab" data-toggle="tab" href="#nav-school" role="tab" aria-controls="nav-school" aria-selected="false">Academic Records</a>
                    <a class="nav-item nav-link  {{count($schools) != 0 && count($qualifications) == 0 ? 'active' :''}} dark-grey-text" id="nav-qualification-tab" data-toggle="tab" href="#nav-qualification" role="tab" aria-controls="nav-qualification" aria-selected="false">Qualifications</a>
                    <a class="nav-item nav-link  {{count($qualifications) !=0 && !$others ? 'active' :''}} dark-grey-text" id="nav-othercourses-tab" data-toggle="tab" href="#nav-othercourses" role="tab" aria-controls="nav-othercourses" aria-selected="false">Other Courses</a>
                    <a class="nav-item nav-link  {{$others && count($employment) == 0 ? 'active' :''}} dark-grey-text" id="nav-employment-tab" data-toggle="tab" href="#nav-employment" role="tab" aria-controls="nav-employment" aria-selected="false">Employment Records</a>
                    <a class="nav-item nav-link  {{count($employment) != 0 && !$sponsorship ? 'active' :''}} dark-grey-text" id="nav-sponsorship-tab" data-toggle="tab" href="#nav-sponsorship" role="tab" aria-controls="nav-sponsorship" aria-selected="false">Sponsorship</a>
                    <a class="nav-item nav-link  {{$sponsorship  && !$honor ? 'active' :''}} dark-grey-text" id="nav-honor-tab" data-toggle="tab" href="#nav-honor" role="tab" aria-controls="nav-honor" aria-selected="false" style="font-weight: bold; color: #DC143C !important;">Honor & Pledge</a>
                    <a class="nav-item nav-link  {{$honor && count($recommendation) == 0 ? 'active' :''}} dark-grey-text" id="nav-recommendation-tab" data-toggle="tab" href="#nav-recommendation" role="tab" aria-controls="nav-recommendation" aria-selected="false" style="font-weight: bold; color: #DC143C !important;">Recommendation</a>
                    <a class="nav-item nav-link  {{count($recommendation) != 0  && !$payment ? 'active' :''}} dark-grey-text" id="nav-payment-tab" data-toggle="tab" href="#nav-payment" role="tab" aria-controls="nav-payment" aria-selected="false" style="font-weight: bold; color: #DC143C !important;"> Payment</a>
                    <a class="nav-item nav-link  {{$records && count($schools) != 0 && count($qualifications) != 0 && $others  && count($employment) != 0 && !$sponsorship && !$honor && count($recommendation) != 0 && $payment ? 'active' :''}} dark-grey-text" id="nav-finish-tab" data-toggle="tab" href="#nav-finish" role="tab" aria-controls="nav-finish" aria-selected="false" style="font-weight: bold; color: #DC143C !important;"> Finish</a>
                </div>
            </nav>
            <div class="tab-content pt-5" id="nav-tabContent">
                {{--/***Personal Information Tab ****/--}}
                <div class="tab-pane fade {{!$records && count($schools) == 0 &&  count($subjects) == 0 && count($qualifications) == 0 && !$others  && count($employment) == 0 && !$sponsorship && !$honor && count($recommendation) == 0 ? 'show active' :''}}" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                    <form class="border border-light p-5" method="post" action="{{route('applicant.store.info',['request_code'=>$code])}}" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <h3 class="text-uppercase"><strong> Personal Information</strong></h3>
                        <hr>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="inputEmail4"><i class="fa fa-user text-dark"></i> Title {{@$records->title}} </label>
                                @php $title = old('title',@$records->title)  @endphp
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
                                <input type="text" class="form-control" name="surname" value="{{old('surname',@$records->surname)}}"  placeholder="Surname" autofocus>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="inputPassword4"><i class="fa fa-user text-dark"></i> First name </label>
                                <input type="text" class="form-control" name="first_name" value="{{old('first_name',@$records->first_name)}}" placeholder="First name">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputPassword4"><i class="fa fa-user text-dark"></i> Middle name</label>
                                <input type="text" class="form-control" name="middle_name" value="{{old('middle_name',@$records->middle_name)}}"  placeholder="Middle name">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputPassword4"><i class="fa fa-calendar text-dark"></i> Date of Birth  </label>
                                <input type="text" class="form-control birth" name="dob" value="{{old('dob',@$records->dob)}}"  placeholder="date of birth" readonly>
                            </div>
                            <div class="form-group col-md-4">
                                <div class="imageupload panel panel-default">
                                    <div class="panel-heading clearfix">
                                        <label for="inputPassword4"><strong><i class="fa fa-image text-dark"></i> Passport Picture</strong>* (max 2mb)</label>
                                    </div>
                                    <div class="file-tab panel-body">
                                        <label class="btn btn-primary btn-sm btn-file">
                                            <span>Browse</span>
                                            <input type="file" name="passport_pic">
                                        </label>
                                        <button type="button" class="btn btn-default btn-sm">Remove</button>
                                        @if(!empty($records->passport_pic))
                                            <a href="{{asset('storage/passport/'.@$records->passport_pic)}}">Open</a>
                                            @endif
                                    </div>

                                    <div class="url-tab panel-body">
                                        <div class="input-group">
                                            <input type="text" class="form-control hasclear" placeholder="Image URL">
                                            <div class="input-group-btn">
                                                <button type="button" class="btn btn-default btn-sm">Submit</button>
                                            </div>
                                        </div>
                                        <input type="hidden" name="image-url">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPassword4"><i class="fa fa-map text-dark"></i> Place of Birth</label>
                                <input type="text" class="form-control" name="pob" value="{{old('pob',@$records->pob)}}" placeholder="place of birth">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="inputPassword4"> <i class="fa fa-male text-dark"></i> Gender</label>
                                @php $value = @$records->gender  @endphp
                                <select class="browser-default custom-select" name="gender">
                                    <option></option>
                                    <option value="MALE" {{$value == 'MALE' ? 'selected' : ''}}>MALE</option>
                                    <option value="FEMALE" {{$value == 'FEMALE' ? 'selected' : ''}}>FEMALE</option>
                                </select>
                            </div>

                            <div class="form-group col-md-4">
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

                        <hr>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputAddress"><i class="fa fa-address-book text-dark"></i> Postal Address (P.O.Box)</label>
                                <input type="text" class="form-control" value="{{old('postal_address',@$records->postal_address)}}" name="postal_address" placeholder="1234 Main St">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="inputAddress2"><i class="fa fa-address-book text-dark"></i> Residential Address / Ghana Post GPS Address </label>
                                <input type="text" class="form-control"  value="{{old('residential_address',@$records->residential_address)}}" name="residential_address" placeholder="Residential Address">
                            </div>

                            <div class="form-group col-md-4">
                                <label for="inputAddress2"><i class="fa fa-phone text-dark"></i>Mobile Phone </label>
                                <input type="text" class="form-control"  value="{{old('mobile_phone',@$records->mobile_phone)}}"  name="mobile_phone" placeholder="Mobile Phone">
                            </div>

                            <div class="form-group col-md-4">
                                <label for="inputAddress2"><i class="fa fa-phone text-dark"></i> Home Phone </label>
                                <input type="text" class="form-control" value="{{old('home_phone',@$records->home_phone)}}" name="home_phone" placeholder="Home Phone">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputAddress2"><i class="fa fa-mail-bulk text-dark"></i> Regular Email Address </label>
                                <input type="email" class="form-control" value="{{old('regular_email_address',@$records->regular_email_address)}}" name="regular_email_address" placeholder="email">
                            </div>
                        </div>

                        <hr>
                        <h4 class=""><strong class="text-uppercase">Proposed Programmme of Study</strong><small>(Please refer from the program list)</small></h4>
                        <hr>
                        <p>
                            Please state the Programme you are applying for in order of preference (Applicant must note that all student are offered the same course during the first
                            year)
                        </p>
                        <div class="form-row">

                            <div class="form-group col-md-4">
                                <label for="inputCity"><i class="fa fa-gavel text-dark"></i> 1st Choice</label>
                                @php $value = @$records->prog_first  @endphp

                                <select class="browser-default custom-select" name="prog_first">
                                    <option></option>
                                    <option value="BSc. COMPUTER SCIENCE" {{$value == 'BSc. COMPUTER SCIENCE' ? 'selected' : ''}}>Bsc. COMPUTER SCIENCE</option>
                                    <option value="BSc. INFORMATION SYSTEMS SCIENCES" {{$value == 'BSc. INFORMATION SYSTEMS SCIENCES' ? 'selected' : ''}}>Bsc. INFORMATION SYSTEMS SCIENCES</option>
                                    <option value="BEng. APPLIED ELECTRONICS" {{$value == 'BEng. APPLIED ELECTRONICS' ? 'selected' : ''}}>BEng. APPLIED ELECTRONICS</option>
                                    <option value="BSc. MANAGEMENT WITH COMPUTING" {{$value == 'BSc. MANAGEMENT WITH COMPUTING' ? 'selected' : ''}}>BSc. MANAGEMENT WITH COMPUTING</option>
                                    <option value="BSc. BANKING AND FINANCE" {{$value == 'BSc. BANKING AND FINANCE' ? 'selected' : ''}}>BSc. BANKING AND FINANCE</option>
                                    <option value="BSc. ECONOMICS WITH COMPUTING" {{$value == 'BSc. ECONOMICS WITH COMPUTING' ? 'selected' : ''}}>BSc. ECONOMICS WITH COMPUTING</option>
                                    <option value="BSc. ACCOUNTING WITH INFORMATION SYSTEMS" {{$value == 'BSc. ACCOUNTING WITH INFORMATION SYSTEMS' ? 'selected' : ''}}>BSc. ACCOUNTING WITH INFORMATION SYSTEMS</option>
                                    <option value="BBa. E-COMMERCE" {{$value == 'BBa. E-COMMERCE' ? 'selected' : ''}}>BBa. E-COMMERCE</option>
                                    <option value="BSc. PSYCHOLOGY" {{$value == 'BSc. PSYCHOLOGY' ? 'selected' : ''}}>BSc. PSYCHOLOGY</option>
                                    <option value="BSc. THEOLOGY" {{$value == 'BSc. THEOLOGY' ? 'selected' : ''}}>BSc. THEOLOGY</option>

                                </select>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="inputCity"><i class="fa fa-gavel text-dark"></i> 2nd Choice</label>
                                @php $value = @$records->prog_second  @endphp

                                <select class="browser-default custom-select" name="prog_second">
                                    <option></option>
                                    <option value="BSc. COMPUTER SCIENCE" {{$value == 'BSc. COMPUTER SCIENCE' ? 'selected' : ''}}>Bsc. COMPUTER SCIENCE</option>
                                    <option value="BSc. INFORMATION SYSTEMS SCIENCES" {{$value == 'BSc. INFORMATION SYSTEMS SCIENCES' ? 'selected' : ''}}>Bsc. INFORMATION SYSTEMS SCIENCES</option>
                                    <option value="BEng. APPLIED ELECTRONICS" {{$value == 'BEng. APPLIED ELECTRONICS' ? 'selected' : ''}}>BEng. APPLIED ELECTRONICS</option>
                                    <option value="BSc. MANAGEMENT WITH COMPUTING" {{$value == 'BSc. MANAGEMENT WITH COMPUTING' ? 'selected' : ''}}>BSc. MANAGEMENT WITH COMPUTING</option>
                                    <option value="BSc. BANKING AND FINANCE" {{$value == 'BSc. BANKING AND FINANCE' ? 'selected' : ''}}>BSc. BANKING AND FINANCE</option>
                                    <option value="BSc. ECONOMICS WITH COMPUTING" {{$value == 'BSc. ECONOMICS WITH COMPUTING' ? 'selected' : ''}}>BSc. ECONOMICS WITH COMPUTING</option>
                                    <option value="BSc. ACCOUNTING WITH INFORMATION SYSTEMS" {{$value == 'BSc. ACCOUNTING WITH INFORMATION SYSTEMS' ? 'selected' : ''}}>BSc. ACCOUNTING WITH INFORMATION SYSTEMS</option>
                                    <option value="BBa. E-COMMERCE" {{$value == 'BBa. E-COMMERCE' ? 'selected' : ''}}>BBa. E-COMMERCE</option>
                                    <option value="BSc. PSYCHOLOGY" {{$value == 'BSc. PSYCHOLOGY' ? 'selected' : ''}}>BSc. PSYCHOLOGY</option>
                                    <option value="BSc. THEOLOGY" {{$value == 'BSc. THEOLOGY' ? 'selected' : ''}}>BSc. THEOLOGY</option>

                                </select>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="inputCity"><i class="fa fa-gavel text-dark"></i> 3rd Choice</label>
                                @php $value = @$records->prog_third  @endphp

                                <select class="browser-default custom-select" name="prog_third">
                                    <option></option>
                                    <option value="BSc. COMPUTER SCIENCE" {{$value == 'BSc. COMPUTER SCIENCE' ? 'selected' : ''}}>Bsc. COMPUTER SCIENCE</option>
                                    <option value="BSc. INFORMATION SYSTEMS SCIENCES" {{$value == 'BSc. INFORMATION SYSTEMS SCIENCES' ? 'selected' : ''}}>Bsc. INFORMATION SYSTEMS SCIENCES</option>
                                    <option value="BEng. APPLIED ELECTRONICS" {{$value == 'BEng. APPLIED ELECTRONICS' ? 'selected' : ''}}>BEng. APPLIED ELECTRONICS</option>
                                    <option value="BSc. MANAGEMENT WITH COMPUTING" {{$value == 'BSc. MANAGEMENT WITH COMPUTING' ? 'selected' : ''}}>BSc. MANAGEMENT WITH COMPUTING</option>
                                    <option value="BSc. BANKING AND FINANCE" {{$value == 'BSc. BANKING AND FINANCE' ? 'selected' : ''}}>BSc. BANKING AND FINANCE</option>
                                    <option value="BSc. ECONOMICS WITH COMPUTING" {{$value == 'BSc. ECONOMICS WITH COMPUTING' ? 'selected' : ''}}>BSc. ECONOMICS WITH COMPUTING</option>
                                    <option value="BSc. ACCOUNTING WITH INFORMATION SYSTEMS" {{$value == 'BSc. ACCOUNTING WITH INFORMATION SYSTEMS' ? 'selected' : ''}}>BSc. ACCOUNTING WITH INFORMATION SYSTEMS</option>
                                    <option value="BBa. E-COMMERCE" {{$value == 'BBa. E-COMMERCE' ? 'selected' : ''}}>BBa. E-COMMERCE</option>
                                    <option value="BSc. PSYCHOLOGY" {{$value == 'BSc. PSYCHOLOGY' ? 'selected' : ''}}>BSc. PSYCHOLOGY</option>
                                    <option value="BSc. THEOLOGY" {{$value == 'BSc. THEOLOGY' ? 'selected' : ''}}>BSc. THEOLOGY</option>

                                </select>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="inputCity"><i class="fa fa-clock text-dark"></i> Session</label>
                                @php $value = @$records->session  @endphp
                                <select class="browser-default custom-select" name="session">
                                    <option></option>
                                    <option value="Morning" {{$value == 'Morning' ? 'selected' : ''}}>Morning</option>
                                    <option value="Evening" {{$value == 'Evening' ? 'selected' : ''}}>Evening</option>
                                    <option value="Weekend" {{$value == 'Weekend' ? 'selected' : ''}}>Weekend</option>
                                </select>
                            </div>
                        </div>



                        <h4 class="text-uppercase"><strong>Source of information on CLI-Ghana</strong></h4>
                        <hr>
                        <div class="form-row">

                            <div class="form-group col-md-4">
                                <label for="inputCity"><i class="fa fa-info text-dark"></i> Source </label>
                                @php $value = @$records->source_of_info  @endphp
                                <select class="browser-default custom-select" name="source_of_info" id="source_of_info">
                                    <option></option>
                                    <option value="University Fair" {{$value == 'University Fair' ? 'selected' : ''}}>University Fair</option>
                                    <option value="Presentation" {{$value == 'Presentation' ? 'selected' : ''}}>Presentation</option>
                                    <option value="Radio" {{$value == 'Radio' ? 'selected' : ''}}>Radio</option>
                                    <option value="Tv" {{$value == 'Tv' ? 'selected' : ''}}>Tv</option>
                                    <option value="Personal Recommendation" {{$value == 'Personal Recommendation' ? 'selected' : ''}}>Personal Recommendation</option>
                                    <option value="Internet" {{$value == 'Internet' ? 'selected' : ''}}>Internet</option>
                                </select>
                            </div>


                            <div class="form-group col-md-4" id="name_of_recommender">
                                <label for="inputCity" class="black-text"><i class="fa fa-newspaper text-dark"></i> Recommender</label>
                                <input type="text" class="form-control" value="{{old('recommender',@@$records->recommender)}}" name="recommender" placeholder="Name / Institution">
                            </div>


                            <div class="form-group col-md-4">
                                <label for="inputCity" class="black-text"><i class="fa fa-newspaper text-dark"></i> Publication / Advertisement (Please State)</label>
                                <input type="text" class="form-control" value="{{old('pub_or_advert',@@$records->pub_or_advert)}}" name="pub_or_advert" placeholder="Publication">
                            </div>

                            <div class="form-group col-md-4">
                                <label for="inputCity" class="black-text"><i class="fa fa-question text-dark"></i> Other</label>
                                <input type="text" class="form-control" value="{{old('other',@$records->other)}}" name="other" placeholder="Other">
                            </div>
                        </div>
                        <div class="col-md-4 offset-md-10">
                            <button type="submit" class="btn btn-md btn-dark-green lato">Submit</button>
                        </div>
                    </form>
                </div>

                {{--/***Schools Attened Tab = Tab ****/--}}
                <div class="tab-pane fade {{$records && count($schools) == 0 ? 'show active' :''}}" id="nav-school" role="tabpanel" aria-labelledby="nav-school-tab">
                    <form class="border border-light p-5" method="post" action="{{route('applicant.store.school',['request_code'=>$code])}}">
                        {{csrf_field()}}
                        <h3 class="text-uppercase"><strong> Secondary School(s) Attended</strong></h3>
                        <hr>
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="inputEmail4"><i class="fa fa-university"></i> School Name </label>
                                <input type="text" class="form-control" name="sch_name" value="{{old('sch_name')}}" placeholder="School Name" required>
                            </div>

                            <div class="form-group col-md-3">
                                <label for="inputEmail4"><i class="fa fa-calendar"></i> From </label>
                                <input type="text" class="form-control datetime" name="from" value="{{old('from')}}"  placeholder="" readonly>
                            </div>

                            <div class="form-group col-md-3">
                                <label for="inputPassword4"><i class="fa fa-calendar"></i>To </label>
                                <input type="tex" class="form-control datetime" name="to" value="{{old('to')}}" placeholder="" readonly>
                            </div>


                            <div class="form-group col-md-3">
                                <label for="subject_name"><i class="fa fa-calendar"></i> Subject Name </label>
                                <select class="form-control" name="subject_name" id="subject_name">
                                    <option></option>
                                    <option value="Core Maths">Core Maths</option>
                                    <option value="English Language">English Language</option>
                                    <option value="Intergrated Science">Intergrated Science</option>
                                    <option value="Biology">Biology</option>
                                    <option value="Elective Maths">Elective Maths</option>
                                    <option value="Physics">Physics</option>
                                    <option value="Accounting">Accounting</option>
                                    <option value="Chemistry">Chemistry</option>
                                    <option value="Food and Nutrition">Food and Nutrition</option>
                                    <option value="Management in Living">Management in Living</option>
                                    <option value="French">French</option>
                                    <option value="Economics">Economics</option>
                                    <option value="Sewing">Sewing</option>
                                    <option value="General Knowledge In Art">General Knowledge In Art</option>
                                    <option value="History">History</option>
                                    <option value="Leather Work">Leather Work</option>
                                    <option value="Ceramics">Ceramics</option>
                                    <option value="Graphic Communications">Graphic Communications</option>
                                    <option value="Literature">Literature</option>
                                    <option value="ICT">ICT</option>
                                    <option value="Geography">Geography</option>
                                    <option value="Government">Government</option>
                                    <option value="Social Studies">Social Studies</option>
                                    <option value="Technical Drawings">Technical Drawing</option>

                                </select>
                            </div>
                        </div>

                        <div class="form-row">


                            <div class="form-group col-md-3">
                                <label for="inputPassword4"><i class="fa fa-calendar"></i> 1st Siting  </label>
                                <input type="text" class="form-control" name="first_sitting" value="{{old('first_sitting')}}" placeholder="" >
                            </div>

                            <div class="form-group col-md-3">
                                <label for="inputPassword4"><i class="fa fa-calendar"></i> 2nd Sitting </label>
                                <input type="text" class="form-control" name="second_sitting" value="{{old('second_sitting')}}" placeholder="" >
                            </div>

                            <div class="form-group col-md-3">
                                <label for="inputPassword4"><i class="fa fa-calendar"></i> 3rd Sitting </label>
                                <input type="tex" class="form-control" name="third_sitting" value="{{old('third_sitting')}}" placeholder="" >
                            </div>

                            <div class="form-group col-md-3">
                                <label for="inputPassword4"><i class="fa fa-calendar"></i> Index Number </label>
                                <input type="text" class="form-control" name="index_number" value="{{old('index_number')}}" placeholder="" >
                            </div>

                        </div>
                        <div class="col-md-4 offset-md-10">
                            <button type="submit" class="btn btn-md btn-dark-green lato">Submit</button>
                        </div>
                    </form>

                    <table class="table table-responsive table-sm">
                        <thead class="black white-text">
                        <tr>
                            <th scope="col" >School Name</th>
                            <th scope="col" >Subject</th>
                            <th scope="col">From</th>
                            <th scope="col">To</th>
                            <th scope="col">1st</th>
                            <th scope="col">2nd</th>
                            <th scope="col">3rd</th>
                            <th scope="col">Index</th>
                            <th scope="col">#</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($schools as $education)
                            <form method="post" action="{{route('applicant.school.edit',['id'=>$education->id])}}">
                                {{csrf_field()}}
                        <tr>
                            <td><label>
                                    <input name="sch_name" value="{{@$education->sch_name}}" class="form-control" >
                                </label></td>
                            <td><label>
                                    <select class="form-control" name="subject_name" id="subject_name">
                                        <option></option>
                                        <option value="Core Maths" {{@$education->subject_name  == 'Core Maths' ? 'selected' : ''}}>Core Maths</option>
                                        <option value="English Language" {{@$education->subject_name  == 'English Language' ? 'selected' : ''}}>English Language</option>
                                        <option value="Intergrated Science" {{@$education->subject_name  == 'Intergrated Science' ? 'selected' : ''}}>Intergrated Science</option>
                                        <option value="Agricultural Science" {{@$education->subject_name  == 'Agricultural Science'? 'selected' : ''}}>Agricultural Science</option>
                                        <option value="Biology" {{@$education->subject_name  == 'Biology'? 'selected' : ''}}>Biology</option>
                                        <option value="Elective Maths" {{@$education->subject_name  == 'Elective Maths'? 'selected' : ''}}>Elective Maths</option>
                                        <option value="Physics" {{@$education->subject_name  == 'Physics'? 'selected' : ''}}>Physics</option>
                                        <option value="Accounting" {{@$education->subject_name  == 'Accounting'? 'selected' : ''}}>Accounting</option>
                                        <option value="Chemistry" {{@$education->subject_name  == 'Chemistry'? 'selected' : ''}}>Chemistry</option>
                                        <option value="Food and Nutrition" {{@$education->subject_name  == 'Food and Nutrition'? 'selected' : '' }}>Food and Nutrition</option>
                                        <option value="Management in Living" {{@$education->subject_name  == 'Management in Living'? 'selected' : ''}}>Management in Living</option>
                                        <option value="French" {{@$education->subject_name  == 'French'? 'selected' : ''}}>French</option>
                                        <option value="Economics" {{@$education->subject_name  == 'Economics'? 'selected' : ''}}>Economics</option>
                                        <option value="Sewing" {{@$education->subject_name  == 'Sewing' ? 'selected' : ''}}>Sewing</option>
                                        <option value="General Knowledge In Art" {{@$education->subject_name  == 'General Knowledge In Art'? 'selected' : ''}}>General Knowledge In Art</option>
                                        <option value="History" {{@$education->subject_name  == 'History'? 'selected' : '' }}>History</option>
                                        <option value="Leather Work" {{@$education->subject_name  == 'Leather Work'? 'selected' : ''}}>Leather Work</option>
                                        <option value="Ceramics" {{@$education->subject_name  == 'Ceramics'? 'selected' : ''}}>Ceramics</option>
                                        <option value="Graphic Communications" {{@$education->subject_name  == 'Graphic Communications'? 'selected' : '' }}>Graphic Communications</option>
                                        <option value="Literature" {{@$education->subject_name  == 'Literature'? 'selected' : ''}}>Literature</option>
                                        <option value="ICT" {{@$education->subject_name  == 'ICT'? 'selected' : '' }}>ICT</option>
                                        <option value="Geography" {{@$education->subject_name  == 'Geography'? 'selected' : '' }}>Geography</option>
                                        <option value="Government" {{@$education->subject_name  == 'Government'? 'selected' : '' }}>Government</option>
                                        <option value="Social Studies" {{@$education->subject_name  == 'Social Studies'? 'selected' : '' }}>Social Studies</option>
                                        <option value="Technical Drawing" {{@$education->subject_name  == 'Technical Drawing'? 'selected' : '' }}>Technical Drawing</option>

                                    </select>
                                </label></td>
                            <td><label>
                                    <input name="from" value="{{@$education->from}}" type="text" class="form-control">
                                </label></td>
                            <td><label>
                                    <input name="to" value="{{@$education->to}}" type="text" class="form-control">
                                </label></td>
                            <td><label>
                                    <input name="first_sitting" value="{{@$education->first_sitting}}" type="text" class="form-control">
                                </label></td>
                            <td><label>
                                    <input name="second_sitting" value="{{@$education->second_sitting}}" type="text" class="form-control">
                                </label></td>
                            <td><label>
                                    <input name="third_sitting" value="{{@$education->third_sitting}}" type="text" class="form-control">
                                </label></td>
                            <td><label>
                                    <input name="index_number" value="{{@$education->index_number}}" type="text" class="form-control">
                                </label></td>
                            <td><button type="submit" class="btn btn-sm rounded btn-dark-green lato">  <i class="fa fa-save"></i></button></td>
                        </tr>
                            </form>
                        @endforeach

                        </tbody>
                    </table>
                </div>


                {{--/***Qualifaications ****/--}}
                <div class="tab-pane fade {{count($schools) != 0 && count($qualifications) == 0 ? 'show active' :''}}" id="nav-qualification" role="tabpanel" aria-labelledby="nav-qualification-tab">
                    <form class="border border-light p-5" method="post" action="{{route('applicant.store.qualification',['request_code'=>$code])}}">
                        {{csrf_field()}}
                        <h4 class="text-uppercase"><strong> Qualifications </strong></h4>
                        <hr>
                        <div class="form-row">
                            <div class="form-group col-md-5">
                                <label for="name"><i class="fa fa-university"></i>  Name </label>
                                <select class="form-control" name="name" id="name">
                                    <option></option>
                                    <option value="HND">HND</option>
                                    <option value="Diploma">Diploma</option>
                                    <option value="O level">O level</option>
                                    <option value="GCSE">GCSE</option>
                                    <option value="Higher National Certificate">Higher National Certificate</option>
                                    <option value="Certficate of Higher Education">Certficate of Higher Education</option>
                                    <option value="Foundation Degree">Foundation Degree</option>
                                    <option value="Bachelor's Degree">Bachelor's Degree</option>
                                    <option value="Graduate Diploma">Graduate Diploma</option>
                                    <option value="Graduate Certificate">Graduate Certificate</option>
                                    <option value="Degree Apprenticeship">Degree Apprenticeship</option>
                                </select>
                            </div>

                            <div class="form-group col-md-3">
                                <label for="inputEmail4"><i class="fa fa-calendar"></i> From </label>
                                <input type="text" class="form-control datetime" name="from" value="{{old('from')}}"  placeholder="" readonly>
                            </div>

                            <div class="form-group col-md-3">
                                <label for="inputPassword4"><i class="fa fa-calendar"></i> To </label>
                                <input type="text" class="form-control datetime" name="to" value="{{old('to')}}" placeholder="" readonly>
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
                            <th scope="col">#</th>
                            <th scope="col">Qualification Name</th>
                            <th scope="col">From </th>
                            <th scope="col">To </th>
                            <th scope="col">#</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($qualifications as $qualification)
                            <form method="post" action="{{route('applicant.qualification.edit',['id'=>$qualification->id])}}">
                                {{csrf_field()}}
                                <tr>
                                    <th scope="row">{{$qualification->id}}</th>
                                    <td>
                                        <select class="form-control" name="name" id="name">
                                            <option value="HND" {{@$qualification->name  == 'HND' ? 'selected' : ''}}>HND</option>
                                            <option value="Diploma"{{@$qualification->name  == 'Diploma' ? 'selected' : ''}}>Diploma</option>
                                            <option value="O level">{{@$qualification->name  == 'O level' ? 'selected' : ''}}O level</option>
                                            <option value="GCSE">{{@$qualification->name  == 'GCSE' ? 'selected' : ''}}GCSE</option>
                                            <option value="Higher National Certificate">{{@$qualification->name  == 'Higher National Certificate' ? 'selected' : ''}}Higher National Certificate</option>
                                            <option value="Certficate of Higher Education">{{@$qualification->name  == 'Certficate of Higher Education' ? 'selected' : ''}}Certficate of Higher Education</option>
                                            <option value="Foundation Degree">{{@$qualification->name  == 'Foundation Degree' ? 'selected' : ''}}Foundation Degree</option>
                                            <option value="Bachelors Degree">{{@$qualification->name  == 'Bachelors Degree' ? 'selected' : ''}}Bachelor's Degree</option>
                                            <option value="Graduate Diploma">{{@$qualification->name  == 'Graduate Diploma' ? 'selected' : ''}}Graduate Diploma</option>
                                            <option value="Graduate Certificate">{{@$qualification->name  == 'Graduate Certificate' ? 'selected' : ''}}Graduate Certificate</option>
                                            <option value="Degree Apprenticeship">{{@$qualification->name  == 'Degree Apprenticeship' ? 'selected' : ''}}Degree Apprenticeship</option>
                                        </select>
                                    </td>
                                    <td>
                                        <label>
                                            <input name="from" value="{{@$qualification->from}}" type="text" class="form-control">
                                        </label>
                                    </td>
                                    <td>
                                        <label>
                                            <input name="to"   value="{{@$qualification->to}}" type="text" class="form-control">
                                        </label>
                                    </td>
                                    <td><button type="submit" class="btn btn-sm rounded btn-dark-green lato"> Save</button></td>
                                </tr>
                            </form>
                        @endforeach

                        </tbody>
                    </table>
                    <hr>
                </div>

                {{--/***Other Courses Taken ****/--}}
                <div class="tab-pane fade {{count($qualifications) !=0 && !$others ? 'show active' :''}}" id="nav-othercourses" role="tabpanel" aria-labelledby="nav-othercourses-tab">
                    <form class="border border-light p-5" method="post" action="{{route('applicant.other_courses.store',['request_code'=>$code])}}">
                        {{csrf_field()}}
                        <h4 class="text-uppercase"><strong> Other Business or Management Courses taken </strong></h4>
                        <hr>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="summary"><i class="fa fa-book-open"></i> Summary of Business or Management Courses Undertaken </label>
                                <textarea type="text" id="summary" class="form-control" name="summary" cols="4" rows="5" required>{{old('summary',@$others->summary)}}
                                </textarea>
                            </div>
                        </div>

                        <div class="col-md-4 offset-md-10">
                            <button type="submit" class="btn btn-md btn-dark-green lato">Submit</button>
                        </div>
                    </form>
                    <hr>
                </div>

                {{--/***Employment Records ****/--}}
                <div class="tab-pane fade {{$others && count($employment) == 0  ? 'show active' :''}}" id="nav-employment" role="tabpanel" aria-labelledby="nav-employment-tab">
                    <form class="border border-light p-5" method="post" action="{{route('applicant.store.employment',['request_code'=>$code])}}">
                        {{csrf_field()}}
                        <h4 class="text-uppercase"><strong> CURRENT & PREVIOUS EMPLOYMENT RECORDS </strong></h4>
                        <hr>
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="inputEmail4"><i class="fa fa-university"></i>  From </label>
                                <input type="text" class="form-control datetime" name="from" value="{{old('from')}}" placeholder="" readonly>
                            </div>

                            <div class="form-group col-md-3">
                                <label for="inputEmail4"><i class="fa fa-calendar"></i> Till </label>
                                <input type="text" class="form-control datetime" name="till" value="{{old('till')}}"  placeholder="" readonly>
                            </div>

                            <div class="form-group col-md-5">
                                <label for="inputPassword4"><i class="fa fa-calendar"></i> Organization </label>
                                <input type="text" class="form-control" name="organization" value="{{old('organization')}}" placeholder="Name" required>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputPassword4"><i class="fa fa-calendar"></i> Position </label>
                                <input type="text" class="form-control" name="position" value="{{old('position')}}" placeholder="Position" required>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="inputPassword4"><i class="fa fa-calendar"></i> Salary </label>
                                <input type="text" class="form-control" name="salary" value="{{old('salary')}}" placeholder="Amount" required>
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
                            <th scope="col">#</th>
                            <th scope="col">From</th>
                            <th scope="col">Till </th>
                            <th scope="col">Organization </th>
                            <th scope="col">Position</th>
                            <th scope="col">Salary</th>
                            <th scope="col">#</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($employment as $record)
                            <form method="post" action="{{route('applicant.employment.edit',['id'=>$record->id])}}">
                                {{csrf_field()}}
                                <tr>
                                    <th scope="row">{{$record->id}}</th>
                                    <td><input name="from" value="{{@$record->from}}" class="form-control"></td>
                                    <td><input name="till" value="{{@$record->till}}" type="text" class="form-control"></td>
                                    <td><input name="organization"   value="{{@$record->organization}}" type="text" class="form-control"></td>
                                    <td><input name="position"   value="{{@$record->position}}" type="text" class="form-control"></td>
                                    <td><input name="salary"   value="{{@$record->salary}}" type="text" class="form-control"></td>
                                    <td><button type="submit" class="btn btn-sm rounded btn-dark-green lato"> Save</button></td>
                                </tr>
                            </form>
                        @endforeach

                        </tbody>
                    </table>
                    <hr>
                </div>

                {{--/***Sponsorship Records ****/--}}
                <div class="tab-pane fade {{count($employment) != 0 && !$sponsorship ? 'show active' :''}}" id="nav-sponsorship" role="tabpanel" aria-labelledby="nav-sponsorship-tab">
                    <form class="border border-light p-5" method="post" action="{{route('applicant.store.sponsorship',['request_code'=>$code])}}" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <h3 class="text-uppercase"><strong> SPONSORSHIP</strong></h3>
                        <hr>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="inputEmail4"><i class="fa fa-user text-dark"></i> Relationship of Sponsor to Applicant </label>
                                <input type="text" class="form-control" name="relationship_of_sponsor" value="{{old('relationship_of_sponsor',@$sponsorship->relationship_of_sponsor)}}"  placeholder="Relationship">
                            </div>

                            <div class="form-group col-md-4">
                                <label for=""><i class="fa fa-user text-dark"></i> Name of Sponsor: </label>
                                <input type="text" class="form-control" name="name_of_sponsor" value="{{old('name_of_sponsor', @$sponsorship->name_of_sponsor)}}"  placeholder="Name" autofocus>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="inputPassword4"><i class="fa fa-id-card text-dark"></i>Nationality</label>
                                @php $value = @$personal_info->nationality  @endphp
                                <select class="browser-default custom-select" name="nationality">
                                    <option></option>

                                    @foreach($country as $nation)

                                        <option value="{{$nation->name}}" {{$value == $nation->name ? 'selected' : ''}}>{{$nation->name}}</option>

                                    @endforeach

                                </select>
                            </div>
                            <div class="form-group col-md-5">
                                <label for=""><i class="fa fa-address-book text-dark"></i> Address of Sponsor</label>
                                <input type="text" class="form-control" name="address_of_sponsor" value="{{old('address_of_sponsor', @$sponsorship->address_of_sponsor)}}"  placeholder=" P.O.BOX .... ">
                            </div>
                            <div class="form-group col-md-3">
                                <label for=""><i class="fa fa-phone text-dark"></i> Phone Number  </label>
                                <input type="text" class="form-control" name="phone_no_of_sponsor" value="{{old('phone_no_of_sponsor',@$sponsorship->phone_no_of_sponsor)}}"  placeholder="+233 .... ">
                            </div>
                            <div class="form-group col-md-4">
                                <label for=""><strong><i class="fa fa-envelope text-dark"></i> Email Address </strong> *</label>
                                <input type="email" class="form-control" name="email_of_sponsor" value="{{old('email_of_sponsor',@$sponsorship->email_of_sponsor)}}" placeholder="email">
                            </div>
                            <div class="form-group col-md-4">
                                <label for=""><i class="fa fa-map text-dark"></i> Country of Residence</label>
                                <input type="text" class="form-control" name="country_of_sponsor" value="{{old('country_of_sponsor',@$sponsorship->country_of_sponsor)}}" placeholder=" Country">
                            </div>
                            <div class="form-group col-md-4">
                                <label for=""> <i class="fa fa-language text-dark"></i> Is English your first language? </label>
                                @php $value = @$sponsorship->is_english @endphp
                                <select class="browser-default custom-select" name="is_english">
                                    <option></option>
                                    <option value="YES" {{$value == 'YES' ? 'selected' : ''}}>YES</option>
                                    <option value="NO" {{$value == 'NO' ? 'selected' : ''}}>NO</option>
                                </select>
                            </div>

                            <div class="form-group col-md-4">
                                <label for=""><i class="fa fa-file text-dark"></i>If not, provide English language  qualifications
                                </label>
                                <input type="file" class="form-control" name="certificate" value="{{old('certificate',@$sponsorship->certificate)}}" placeholder="">
                            </div>
                        </div>

                        <hr>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="is_english_studies"><i class="fa fa-address-book text-dark"></i> Was English the language of instruction for your studies?</label>
                                @php $value = @$sponsorship->is_english_studies @endphp
                                <select class="browser-default custom-select" name="is_english_studies" id="is_english_studies">
                                    <option></option>
                                    <option value="YES" {{$value == 'YES' ? 'selected' : ''}}>YES</option>
                                    <option value="NO" {{$value == 'NO' ? 'selected' : ''}}>NO</option>
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="medical_condition"><i class="fa fa-address-book text-dark"></i> Any special needs,disability or medical condition? </label>
                                @php $value = @$sponsorship->medical_condition @endphp
                                <select class="browser-default custom-select" name="medical_condition" id="medical_condition">
                                    <option></option>
                                    <option value="YES" {{$value == 'YES' ? 'selected' : ''}}>YES</option>
                                    <option value="NO" {{$value == 'NO' ? 'selected' : ''}}>NO</option>
                                </select>
                            </div>

                            <div class="form-group col-md-12">
                                <label for="medical_condition_description" id="medical_condition_description"><i class="fa fa-phone text-dark"></i>If “Yes”,describe the disability or medical condition. </label>
                                <textarea class="form-control" name="medical_condition_description">{{old('medical_condition_description',@$sponsorship->medical_condition_description)}}</textarea>
                            </div>

                            <div class="form-group col-md-12">
                                <label for="study_reason"><i class="fa fa-phone text-dark"></i> Why do you wish to pursue the programme you have chosen?</label>
                                <textarea class="form-control" id="study_reason" name="study_reason">{{old('study_reason',@$sponsorship->study_reason)}}</textarea>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="impression"><i class="fa fa-mail-bulk text-dark"></i> Give a frank impression of yourself, indicating what you believe to be your main strengths and
                                    weaknesses </label>
                               <textarea id="impression" class="form-control" name="impression">{{old('impression',@$sponsorship->impression)}}</textarea>
                            </div>


                            <div class="form-group col-md-12">
                                <label for="achievement"><i class="fa fa-trophy text-dark"></i> What do you consider your most significant achievement to date ? why
                                is it significant to you ?</label>
                                <textarea id="achievement" class="form-control" name="achievement">{{old('achievement',@$sponsorship->achievement)}}</textarea>
                            </div>

                        </div>

                        <div class="col-md-4 offset-md-10">
                            <button type="submit" class="btn btn-md btn-dark-green lato">Submit</button>
                        </div>
                    </form>
                </div>
                {{--Honor and pledge--}}
                <div class="tab-pane fade {{$sponsorship  && !$honor ? 'show active' :''}}" id="nav-honor" role="tabpanel" aria-labelledby="nav-honor-tab">
                    <form class="border border-light p-5" method="post" action="{{route('applicant.store.honor.pledge',['request_code'=>$code])}}" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <h3 class="text-uppercase"><strong> HONOR PLEDGE </strong></h3>
                        <hr>
                        <div class="form-row">
                           <p class="text-justify">
                               I fully recognize that  <b class="font-weight-bold">CLI University College of Science & Technology</b> is founded to be and is committed to being a
                               Christian University offering a lifestyle of academic pursuit, developing human potential in a Christ-like manner to
                               meet, compete with and lead changing needs in the global environment.
                           </p>
                            <p class="text-justify">
                               I fully recognize that in signing this pledge, I become part of a purpose driven community committed to spiritual
                               renewal, social renewal, economic renewal and technological renewal bolstered by knowledge and Christian ethical
                               values.
                           </p>

                            <p class="text-justify">
                                <b class="font-weight-bold">I PLEDGE</b> to apply myself wholeheartedly to my intellectual pursuits, using them to the glory of <b class="font-weight-bold">God</b> and my Country.
                            <p class="text-justify">
                                <b class="font-weight-bold">I PLEDGE</b> to cultivate good social relationships; treating others as I would have myself treated. I will refrain from lies,
                               thievery, cheating, using improper language or inappropriately collaborate with other students on assignments. I will
                               be courteous at all times.
                            </p>

                            <p class="text-justify">
                                <b class="font-weight-bold">I PLEDGE</b> to refrain from immoral and illegal activities, off and on campus as well as other prohibited behaviour listed
                               in the Students Handbook.
                            </p>
                            <p class="text-justify">
                                <b class="font-weight-bold">I PLEDGE</b> to attend classes; all required Chapel services on campus and participate in all <b class="font-weight-bold">CLI-Ghana.</b> activities,
                               conducting myself with integrity and in a well behaved manner.
                            </p>
                            <p class="text-justify">
                                <b class="font-weight-bold">I PLEDGE</b> to dress decently and properly at all times during my education period in <b class="font-weight-bold">CLI-Ghana.</b> If my dressing is
                               found to be unacceptable at any time, I shall obey instructions to change immediately.
                            </p>
                               <p class="text-justify">
                                   <b class="font-weight-bold">I PLEDGE</b> to abide by the rules and regulations of the University. I accept that as a private institution, The University
                               reserves the right to require the withdrawal of a student at any time, if such an action is deemed right by the
                               Disciplinary Committee of the School.
                               I will keep this pledge to the best of my ability, so help me <b class="font-weight-bold">God</b>.
                           </p>
                        </div>

                        <hr>

                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="is_english_studies"><i class="fa fa-question-circle text-dark"></i> Agree</label>
                                @php $value = @$honor->state @endphp
                                <select class="browser-default custom-select" name="state" id="is_english_studies">
                                    <option value="1" {{$value == 1 ? 'selected' : ''}}>YES</option>
                                    <option value="2" {{$value == 2 ? 'selected' : ''}}>NO</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4 offset-md-10">
                            <button type="submit" class="btn btn-md btn-dark-green lato">Submit</button>
                        </div>
                    </form>
                </div>
                {{--Recommendation--}}
                <div class="tab-pane fade {{$honor && count($recommendation) == 0 ? 'show active' :''}}" id="nav-recommendation" role="tabpanel" aria-labelledby="nav-recommendation-tab">
                    <form class="border border-light p-5" method="post" action="{{route('applicant.store.recommendation',['request_code'=>$code])}}" enctype="multipart/form-data">
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
                                <a class="btn btn-sm rounded btn-danger" href="{{route('applicant.recommendation.delete',['id'=>$file->id])}}"><i class="fa fa-trash"></i></a>
                            </li>
                        </ul>
                        @endforeach
                        </div>
                    </div>


                </div>

                {{--Payment fonm--}}
                <div class="tab-pane fade {{count($recommendation) != 0 && $payment  ? 'show active' :''}}" id="nav-payment" role="tabpanel" aria-labelledby="nav-payment-tab">
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


{{--                {{Finis thing}}--}}

                <div class="tab-pane fade {{$records && count($schools) != 0 &&  count($subjects) != 0 && count($qualifications) != 0 && $others  && count($employment) != 0 && !$sponsorship && !$honor && count($recommendation) != 0 && $payment  ? 'show active' :''}}" id="nav-finish" role="tabpanel" aria-labelledby="nav-finish-tab">
                    <form class="border border-light p-5" method="post" action="{{route('applicant.masters.completed',['request_code'=>$code])}}" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <h3 class="text-uppercase"><strong> Completion </strong></h3>
                        <hr>
                        <div class="form-row">

                            <div class="form-group col-md-12">
                                <label for="receipt_no"><i class="fa fa-question-circle text-dark"></i> I HAVE MET ALL THE REQUIREMENTS IN THIS APPLICATION </label>
                                <!-- Default unchecked -->
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="yes" id="exampleRadios1" value="yes"  {{!empty($process) ? 'checked' : ''}}>
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
                                        <input class="form-check-input" type="radio" name="admission_type" id="exampleRadios3" value="masters">
                                        <label class="form-check-label" for="exampleRadios3">
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
    <script src="{{asset('js/bootstrap-imageupload.min.js')}}"></script>
    <script>
        var $imageupload = $('.imageupload');
        $imageupload.imageupload();

        $('#imageupload-disable').on('click', function() {
            $imageupload.imageupload('disable');
            $(this).blur();
        });

        $('#imageupload-enable').on('click', function() {
            $imageupload.imageupload('enable');
            $(this).blur();
        });

        $('#imageupload-reset').on('click', function() {
            $imageupload.imageupload('reset');
            $(this).blur();
        });
    </script>
    <script>


        //it means once the page has finished loading.............

            $(document).ready(function () {


                var type = '{{$admission_type}}';
                var name  =    $('#source_of_info').val();



                    if(type === '') {

                        $('#modelConfirm').modal('toggle');
                    }
                    else {

                        $('#main-body').removeClass('invisible');
                        $('.spinner').hide();


                    }

                 $('.momo').hide();
                 $('.phone').hide();
                 $('#name_of_recommender').hide();

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

                    }
                });

                //checks  the name of the recommender
                if(name === 'Personal Recommendation')
                {
                    $('#name_of_recommender').show();
                }


                $('#source_of_info').on('change',function () {
                    let value= $(this).val();
                    if(value === 'Personal Recommendation')
                    {
                        $('#name_of_recommender').show()
                    }
                    else {
                        $('#name_of_recommender').hide()
                    }
                });

                //for toggling admission tyoe
                $('#admission-type').on('click',function (t) {
                    t.preventDefault();
                    $('#modelConfirm').modal('toggle');
                });

            })
    </script>
    @endpush
