<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <link rel="icon" href="{{ asset('LandingPage/img/favicon.png') }}" sizes="32x32" type="image/png">
    <link href="{{ asset('LandingPage/css/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('LandingPage/css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('LandingPage/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('LandingPage/font-awesome-4.7.0/css/font-awesome.min.css') }}" rel="stylesheet">
</head>

<body>
    <div class="jumbotron jumbotron-fluid" id="banner"
        style="background-image: url('{{ asset('LandingPage/img/biometric-technology-background-with-fingerprint-scanning-system-virtual-screen-digital-remix.jpg') }}');">
        <div class="container text-center text-md-left">
            <header>
                <div class="row justify-content-between">
                    <div class="col-2">
                        <img src="{{ asset('LandingPage/img/logo.png') }}" alt="logo">
                    </div>
                </div>
            </header>
            <h1 data-aos="fade" data-aos-easing="linear" data-aos-duration="1000" data-aos-once="true"
                class="display-3 text-white font-weight-bold my-5">
                Ngopi Cuan<br> Pegawai Bolos
            </h1>
            <p data-aos="fade" data-aos-easing="linear" data-aos-duration="1000" data-aos-once="true"
                class="lead text-white my-4">
                berangkat kantor tapi ke warung kopi <br>
                (Eh, maksudnya ke kantor.)
            </p>
            <a href="{{ route('login') }}" data-aos="fade" data-aos-easing="linear" data-aos-duration="1000"
                data-aos-once="true" class="btn my-4 font-weight-bold atlas-cta cta-green">Get Started</a>
        </div>
    </div>
</body>
<script src="{{ asset('LandingPage/js/aos.js') }}"></script>
<script>
    AOS.init({});
</script>

</html>
