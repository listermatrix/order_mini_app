<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
    <meta name="author" content="Creative Tim">
    <title>Admin - Login</title>

    <link rel="icon" href="https://demos.creative-tim.com/argon-dashboard-pro/assets/img/brand/favicon.png" type="image/png">

{{--    <link rel="icon" href="{{asset('img/logo.png')}}" type="image/png">--}}
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
    <!-- Icons -->
    <link rel="stylesheet" href="{{asset('vendor/nucleo/css/nucleo.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('vendor/@fortawesome/fontawesome-free/css/all.min.css')}}" type="text/css">
    <!-- Argon CSS -->
    <link rel="stylesheet" href="{{asset('css/argon.min.css')}}" type="text/css">
</head>

<body style="background-color: #007E33">

<div class="main-content">
    <!-- Header -->
    <div class="header  py-7 py-lg-8 pt-lg-10" style="background-color: #ff8f00">
        <div class="separator separator-bottom separator-skew zindex-100">
            <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
                <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
            </svg>
        </div>
    </div>
    <!-- Page content -->
    <div class="container mt--9 pb-5">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7">
                <div class="card bg-secondary border-0 mb-0">
                    <div class="card-header bg-transparent pb-4 text-center">
                        <div class="text-center mt-2 mb-3">
                            <a class="navbar-brand" href="">
{{--                                <img src="{{asset("img/new.png")}}" style="height: 70px; width: 100px">--}}
                            </a>
                        </div>
                        <h4><strong>Welcome,</strong> Please login</h4>
                    </div>
                    <div class="card-body px-lg-5 py-lg-5">
                        <div class="text-center text-muted mb-4">
                        </div>
                        <form role="form" method="post">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            {{csrf_field()}}
                            <div class="form-group mb-3">
                                <div class="input-group input-group-merge input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                    </div>
                                    <input class="form-control" name="login" placeholder="email or username" type="text">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group input-group-merge input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                    </div>
                                    <input class="form-control" name="password" placeholder="Password" type="password">
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary my-4">Login</button>
                                <a href="{{route('register')}}" class="btn btn-danger my-4">Register</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{asset("vendor/jquery/dist/jquery.min.js") }}"></script>
<script src="{{asset("vendor/bootstrap/dist/js/bootstrap.bundle.min.js") }}"></script>
<script src="{{asset("vendor/js-cookie/js.cookie.js")}}"></script>
<script src="{{asset("vendor/jquery.scrollbar/jquery.scrollbar.min.js")}}"></script>
<script src="{{asset("vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js")}}"></script>
<script src="{{asset("vendor/lavalamp/js/jquery.lavalamp.min.js")}}"></script>
<script src="{{asset("vendor/content.js")}}"></script>
<script src="{{asset("vendor/chart.js/dist/Chart.min.js")}}"></script>
<script src="{{asset("vendor/chart.js/dist/Chart.extension.js")}}"></script>
<script src="{{asset("js/argon.min.js")}}"></script>
</body>
</html>
