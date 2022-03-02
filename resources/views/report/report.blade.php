@extends('templates.template')
@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <!-- Card header -->
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-12">
                            <h3 class="mb-0 ">Applicant Report Generation</h3>
                            <hr>
                        </div>
                            <div class="col-lg-12">
                                <a class="btn btn-default" href="{{route('report.print',['from'=>$from,'to'=>$to])}}">Print <i class="fa fa-file-pdf"></i></a>
                                <br>   <br>

                                <div class="row">

                                <div class="col-md-3">
                                    <table class="table table-striped">
                                    <tbody>


                                        <tr>
                                            <td>MSc Requests </td>
                                            <td>{{$msc}} </td>
                                        </tr>

                                        <tr>
                                            <td>Undergraduate Requests  </td>
                                            <td>{{$under}} </td>
                                        </tr>

                                        <tr>
                                            <td>Diploma Requests  </td>
                                            <td>{{$diploma}} </td>
                                        </tr>

                                        <tr>
                                            <td><b>TOTOAL REQUEST</b> </td>
                                            <td><b>{{$total}}</b></td>
                                        </tr>

                                    </tbody>

                                </table>
                                </div>
                                <div class="col-md-9">
                                </div>
                                </div>




                                <br>
                                <hr>
                                <div class="row">
                                    <div class="col-md-6">
                                           <h4>Undergratuae Request</h4>
                                        @if(!$underPerson->isEmpty())
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Program</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($underPerson as $under)
                                            <tr>
                                                <td>{{$under->first_name.' '.$under->middle_name.' '.$under->surname }}</td>
                                                <td>{{$under->prog_first}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                            @else
                                            N/A
                                        @endif
                                    </div>

                                    <div class="col-md-6">
                                        <h4>Master Program Request</h4>
                                            @if(!$mscPerson->isEmpty())
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Date</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($mscPerson as $msc)
                                                <tr>
                                                    <td>{{$msc->first_name.' '.$msc->middle_name.' '.$msc->surname }}</td>
                                                    <td>{{$msc->created_at}}</td>
                                                </tr>
                                            @endforeach

                                            </tbody>
                                        </table>
                                                @else
                                                <p class="">
                                                    N/A
                                                </p>
                                            @endif
                                    </div>

                                </div>
                                <br>
                                <br>
                                <div class="row">
                                    <div class="col-md-6">
                                        <h4>Diploma Program Request</h4>
                                        @if(!$diplomaPerson->isEmpty())
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Program</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($diplomaPerson as $diploma)
                                                <tr>
                                                    <td>{{$diploma->first_name.' '.$diploma->middle_name.' '.$diploma->surname }}</td>
                                                    <td>{{$diploma->prog_first}}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>

                                        </table>
                                            @else
                                            N/A
                                        @endif
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
    $('.datetime').datepicker();
</script>


@endpush
