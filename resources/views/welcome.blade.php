<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>E-Patrol Security</title>
        <link rel="shortcut icon" href="{{ asset('resources/assets/logo_epatrol.ico') }}" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v5.15.3/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link rel="preconnect" href="https://fonts.gstatic.com" />
        <link href="https://fonts.googleapis.com/css2?family=Tinos:ital,wght@0,400;0,700;1,400;1,700&amp;display=swap" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,wght@0,400;0,500;0,700;1,400;1,500;1,700&amp;display=swap" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="{{ asset('resources/css/styles.css') }}" rel="stylesheet" />
    </head>
    <body style="background-image: url('resources/img/logosimpel/monitor.jpg'); background-size: cover; background-repeat: no-repeat; opacity:1; ">
        <div class="masthead">
            {{-- <img src="{{asset('resources/img/logosimpel/KPU.png')}}" id="logo" style="width: 80px; height: 80px; position:absolute; top: 5px; left:5px;"> --}}
            <div class="masthead-content text-white">
                <div class="container-fluid px-4 px-lg-0">
                    <img src="{{asset('resources/img/logosimpel/logo_epatrol.jpg')}}" id="logo" style="width: 150px; height: 130px; margin-left: 65px">
                    <h1 class="fst-italic lh-1 mb-4">E-Patrol Security</h1>
                    {{-- <p class="mb-5">Sistem Manajemen Administrasi Terpadu</p> --}}
                    <form>
                        <!-- Email address input-->
                        <div class="row input-group-newsletter">
                            {{-- <div class="col-auto"><a href="{{ route('register') }}" class="btn btn-primary">Daftar</a></div> --}}
                            <div class="col-auto" href="{{ route('login') }}" ><a href="{{ route('login') }}" class="btn bg-light" style="margin-top: 1px; margin-left: 100px">Masuk</a></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div style="position:absolute; bottom: 0; right:0;color:white; padding-right:2px">
            <a>www.ciptasolutindo.id</a>
        </div>
        <!-- Social Icons-->
        <!-- For more icon options, visit https://fontawesome.com/icons?d=gallery&p=2&s=brands-->
        <div class="social-icons">
            <div class="d-flex flex-row flex-lg-column justify-content-center align-items-center h-100 mt-3 mt-lg-0">
                <!-- <a class="btn btn-dark m-3" href="#!"><i class="fab fa-twitter"></i></a>
                <a class="btn btn-dark m-3" href="#!"><i class="fab fa-facebook-f"></i></a>
                <a class="btn btn-dark m-3" href="#!"><i class="fab fa-instagram"></i></a> -->
            </div>
        </div>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="{{ asset('resources/js/scripts.js') }}"></script>
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <!-- * *                               SB Forms JS                               * *-->
        <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
    </body>
</html>
