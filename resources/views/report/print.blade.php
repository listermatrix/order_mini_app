<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
    <meta name="author" content="Creative Tim">
    <title>ADMISSION UNIT</title>
    <link rel="icon" href="{{asset('img/logo.png')}}" type="image/png">
    <link rel="stylesheet" href="{{asset('vendor/nucleo/css/nucleo.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/argon.min.css')}}" type="text/css">
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <img src="{{asset('img/logo.png')}}" class="" style="height: 70px" alt="">
                            <h3 class="mb-0">RUCST - ADMISSION REPORT</h3>
                        </div>
                        </div>
                    </div>


                <div class="card-body">
                    <div class="col-lg-12">
                        <div class="row">

                            <div class="col-md-12">
                                <table class="table table-striped table-bordered">
                                    <thead>

                                    </thead>
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
                        </div>




                        <br>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <h4>Undergratuae Request</h4>
                                @if(!$underPerson->isEmpty())
                                    <table class="table table-bordered">
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
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Program</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($mscPerson as $msc)
                                            <tr>
                                                <td>{{$msc->first_name.' '.$msc->middle_name.' '.$msc->surname }}</td>
                                                <td>{{$msc->prog_first}}</td>
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

                <div class="card-footer">

                </div>
            </div>
            </div>
        </div>
</div>
<script>
    window.print();
</script>

</body>
</html>
