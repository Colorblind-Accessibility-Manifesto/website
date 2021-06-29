<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Colorblind Accessibility Manifesto</title>

        <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Zilla+Slab:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    </head>
    <body>
        <section class="container-fluid main-section flex-column">
            <div class="row">
                <div class="col-12 col-xl2-5">
                    <div class="logo-text">
                        Colorblind<br>
                        Accessibility<br>
                        Manifesto
                    </div>
                </div>
                <div class="col-12 col-xl2-7">
                    @include('fragments/menu')
                </div>
            </div>
            <div class="row align-items-end">
                <div class="col-12">
                    <div class="sos-call-for-dev">
                        <img src="{{ asset('img/emoji/sos-icon.png') }}" alt="sos-icon" />
                        <div>Call for devs</div>
                    </div>

                    <div class="sos-call-for-dev-sub">
                        We are currently working on developing a web extension
                        in order to help color-blind people surfing the internet.
                    </div>

                    <div class="sos-call-for-dev-sub">
                        Join the team by sending an email to <a href="mailto:{{ config('cam.config.signing-email.address') }}">{{ config('cam.config.signing-email.address') }}</a>
                    </div>
                </div>
            </div>
        </section>

        <script src="{{ mix('js/app.js') }}"></script>
    </body>
</html>
