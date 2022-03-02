<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>ADMISSION UNIT</title>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <img src="{{asset('img/logo.png')}}" class="" style="height: 90%; width: 100%" alt="">
        </div>
        <div class="col-md-9">
            <h1 style="font-size: 80px; font-weight: bold">CLI</h1>
            <h2 style="font-size: 40px; font-weight:bold">UNIVERSITY ADMISSIONS</h2>
            <h2>An Affiliate Institute Of</h2>
            <h4><b>KWAME NKRUMAH UNIVERSITY OF SCIENCE AND TECHNOLOGY</b></h4>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <table class="table table-striped table-bordered">
                <thead>

                </thead>
                <tbody>
                <tr>
                    <td>Masters  Requests </td>
                    <td>{{$msc}} </td>
                </tr>

                <tr>
                    <td>Undergraduate Requests  </td>
                    <td>{{$under}} </td>
                </tr>

                <tr>
                    <td>Diploma / Certificate Requests  </td>
                    <td>{{$diploma}} </td>
                </tr>

                <tr>
                    <td><b>TOTOAL REQUEST</b> </td>
                    <td><b>{{$total}}</b></td>
                </tr>

                </tbody>

            </table>
        </div>
    </div>

    <hr>

    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="text-uppercase">Undergratuae Request</h5>
                    @if(!$underPerson->isEmpty())
                        <table class="table table-bordered table-striped">
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
                    <h5 class="text-uppercase">Master Program Request</h5>
                    @if(!$mscPerson->isEmpty())
                        <table class="table table-bordered table-hover">
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


                <div class="col-md-6">
                    <h5 class="text-uppercase">Diploma Program Request</h5>
                    @if(!$diplomaPerson->isEmpty())
                        <table class="table table-bordered">
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
    <hr>
    <div class="row">
    </div>
</div>

<script>
    window.print()
</script>
</body>
</html>
