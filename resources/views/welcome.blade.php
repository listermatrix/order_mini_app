<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>CLI Admission</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">

    <link rel="icon" href="{{asset("img/favicon.ico")}}" type="image/x-icon" />
    <!-- Bootstrap core CSS -->
    <link href="{{asset('home/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="{{asset('home/css/mdb.min.css')}}" rel="stylesheet">
    <!-- Your custom styles (optional) -->
    <link href="{{asset('home/css/style.min.css')}}" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <style type="text/css">
        html,
        body,
        header,
        .view {
            height: 100%;
        }

        .lato {
            font-family: 'Lato', sans-serif;
        }

        .mont{
            font-family: 'Montserrat', sans-serif;
        }

        @media (max-width: 740px) {
            html,
            body,
            header,
            .view {
                height: 1000px;
            }
        }

        @media (min-width: 800px) and (max-width: 850px) {
            html,
            body,
            header,
            .view {
                height: 650px;
            }
        }
        @media (min-width: 800px) and (max-width: 850px) {
            .navbar:not(.top-nav-collapse) {
                background: #1C2331!important;
            }
        }
    </style>
</head>

<body class="lato">

<!-- Navbar -->
<nav class="navbar fixed-top navbar-expand-lg elegant-color-dark scrolling-navbar">
    <div class="container">

            <a class="navbar-brand" href="#"><img src="{{asset("img/new.png")}}" style="height: 2em"></a>


        <!-- Collapse -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Links -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <!-- Left -->
            <ul class="navbar-nav mr-auto" >
                <li class="nav-item active">
                    <a class="nav-link text-white" href="{{route('app.home')}}">Home
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item">
{{--                    <a class="nav-link" href="{{route('dashboard.index')}}">Dashboard</a>--}}
                </li>
                <li class="nav-item ">
                    <a class="nav-link text-white status" href="#">Admission Status</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-white" href="{{route('app.admission')}}">Admission Information</a>
                </li>
            </ul>

        </div>

    </div>
</nav>
<div class="view full-page-intro" style="background-image: url('{{asset('img/bkg.jpg')}}'); background-repeat: no-repeat; background-size: cover;">

    <!-- Mask & flexbox options-->
    <div class="mask rgba-black-light d-flex justify-content-center align-items-center">

            <div class="container">

            <br>
            <br>
            <div class="row wow fadeIn">
                <!--Grid column-->
                <div class="col-md-6 mb-4 white-text text-center text-md-left" style="background-color: rgba(0,0,0,0.5); border-radius: 0.5em">

                    <h1 class="display-4 font-weight-bold white-text mont" style="font-size: 50px">CLI Admissions</h1>

                    <hr class="hr-light">

                    <p>
                        <strong>Becoming a great Change Agent</strong>
                    </p>

                    <p class="mb-4 d-none d-md-block">
                        <strong>
                            Becoming the center of excellence in raising highly skillful, visionary and God-fearing
                            critical thinkers, ethical and passionate leaders to function as change-agents in the various
                            spheres of life.
                        </strong>
                    </p>

                </div>

                    </div>


                <a  href="{{route('applicant.index')}}" class="btn info-color-dark rounded proceed white-text">Go
                    <i class="fas fa-graduation-cap ml-2"></i>
                </a>


            </div>


        </div>


    </div>


<div class="modal fade" id="verify" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><strong>REQUEST CODE</strong>
                    <small class="text-muted font-italic">
                        <u>
                            Enter your request code or click on the  <i class="fa fa-redo text-success "></i> icon to generate one
                        </u>
                    </small>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-inline" method="get" action="{{route('applicant.records')}}">
                    {{csrf_field()}}
                    <label class="sr-only" for="inlineFormInputGroupUsername2">Request Code</label>
                    <div class="input-group mb-2 mr-sm-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text">#</div>
                        </div>
                        <input type="number" class="form-control py-0" name="request_code" id="request-code" placeholder="XXXXXX" required>
                    </div>
                    <div class="btn-group">
                        <a class="btn success-color-dark btn-sm generate white-text" title="GENERATE NEW REQUEST CODE" ><i class="fa fa-redo"></i></a>
                            &nbsp; &nbsp;
                        <button type="submit" class="btn success-color-dark btn-sm mt-0 white-text">Proceed</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm white-text" data-dismiss="modal" style="background-color: #800020">Close</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="status" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><strong>REQUEST CODE</strong>
                    <small class="text-muted font-italic">
                        <u>
                            Enter your request code to check your admission status<admission class=""></admission>
                        </u>
                    </small>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-inline" method="get" action="{{route('applicant.records')}}">
                    {{csrf_field()}}
                    <label class="sr-only" for="inlineFormInputGroupUsername2">Request Code</label>
                    <div class="input-group mb-2 mr-sm-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text">#</div>
                        </div>
                        <input type="number" class="form-control py-0" name="code" id="code"  required>
                    </div>
                    <div class="btn-group">
                        <button type="submit" class="btn success-color-dark btn-sm mt-0 white-text" id="check">check</button>
                    </div>
                </form>
                <br>
                <p id="info">

                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm white-text" data-dismiss="modal" style="background-color: #800020">Close</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="{{asset('home/js/jquery-3.3.1.min.js')}}"></script>
<script type="text/javascript" src="{{asset('home/js/popper.min.js')}}"></script>
<script type="text/javascript" src="{{asset('home/js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('home/js/mdb.min.js')}}"></script>
<script type="text/javascript">
    new WOW().init();
    $('.proceed').on('click',function (t) {
        t.preventDefault();
        let route = $(this).attr('href');
        $('#verify').modal('toggle');
    });

    $('.status').on('click',function (t) {
        t.preventDefault();
        $('#status').modal('toggle');


        $('#check').on('click',function (t) {
            t.preventDefault();
            let code = $('#code').val();
            $.ajax({
                url:'{{route('admission.status')}}',
                type:'get',
                data:{code:code},
                success:function (data) {
                    if(data.status === 'Rejected')
                    {
                        $('#info').html('Your registration was rejected due to the following reason. <br>' +data.msg);

                    }
                    else if(data.status === 'Approved')
                    {
                        $('#info').html('Your registration has been approved find the admission letter in the email used for registration');
                    }
                    else if(data.status === null) {
                        $('#info').html('THE REQUEST CODE YOU USED IS INVALID');
                    }
                },
                error:function () {
                    console.log('there is an error');
                }
            })
        })
    });

    $('.generate').on('click',function () {
        let route = '{{route('applicant.new.code')}}';
        $.ajax({
            type:'get',
            url:route,
            beforeSend:function () {

            },
            success:function (response) {
                console.log(response);
                $('#request-code').val(response);
            },
            error:function () {
                console.log('error');
            }

        })
    })
</script>
</body>

</html>
