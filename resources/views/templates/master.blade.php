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

    <link rel="stylesheet" href="{{asset('css/tail.datetime-default.css')}}">

    <style type="text/css"  >
        html,
        body,
        header,
        .view {
            /*height: 0%;*/
        }

        .text-wine{
            color: #800020;
        }
        .lato {
            font-family: 'Lato', sans-serif;
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
<header>
    <nav class="navbar fixed-tp navbar-expand-lg navbar-dark   scrolling-navbar" style="background-color: #2E2E2E">
        <a class="navbar-brand" href="#"><img src="{{asset("img/favicon.ico")}}"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="{{route('app.home')}}">Home <span class="sr-only">(current)</span></a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#">Forms</a>
                </li>


                <li class="nav-item">
                    <a class="nav-link" href="#" id="admission-type">Admission Type</a>
                </li>




            </ul>

        </div>
    </nav>

    <nav class="navbar navbar-expand-md navbar-dark info-color-dark mb-5 no-content">

        <div class="mr-auto">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb clearfix d-none d-md-inline-flex pt-0">
                    <li class="breadcrumb-item"><a class="white-text" href="#!">Admission Form</a>
                        <i class="fas fa-angle-double-right mx-2 white-text" aria-hidden="true"></i></li>
                    <li class="breadcrumb-item active bread-value">Personal Information etc.</li>
                </ol>
            </nav>
        </div>
        <ul class="navbar-nav ml-auto nav-flex-icons">
            {{--<li class="nav-item">--}}
                {{--<a class="nav-link"><i class="fab fa-twitter"></i></a>--}}
            {{--</li>--}}
            {{--<li class="nav-item">--}}
                {{--<a class="nav-link"><i class="fab fa-google-plus-g"></i></a>--}}
            {{--</li>--}}
        </ul>
    </nav>

</header>
    <div class="container">
        <div class="row">
           @yield('content')
        </div>
    </div>
<br>
<footer class="page-footer font-small black">

    <!-- Copyright -->
    <div class="footer-copyright text-center py-3">© 2019 Copyright:
        <a href="https://mdbootstrap.com/education/bootstrap/"> RUCST - ADMISSIONS</a>
    </div>
    <!-- Copyright -->

</footer>
<!-- Footer -->
<script type="text/javascript" src="{{asset('home/js/jquery-3.3.1.min.js')}}"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="{{asset('home/js/popper.min.js')}}"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="{{asset('home/js/bootstrap.min.js')}}"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="{{asset('home/js/mdb.min.js')}}"></script>

<script src="{{asset('js/tail.datetime-full.js')}}"></script>
<script src="{{asset('js/tail.datetime-all.js')}}"></script>
<script>
    tail.DateTime(".datetime", {
        position: "bottom",
        startOpen: false,
        stayOpen: false,
        timeHours: true,
        timeMinutes: true,
        timeSeconds: true,

    });
    tail.DateTime(".birth", {
        position: "bottom",
        startOpen: false,
        stayOpen: false,
        timeHours: true,
        timeMinutes: true,
        timeSeconds: true,
        dateRanges: [
            // Will Disable 05-JAN -> 07-JAN completely
            {
                start: new Date(2019, 0, 1),
                end: new Date(2200, 0, 28)

    /* days: true */                // This is the default
            },


        ]

    });
</script>
    @stack('script')
</body>
</html>
