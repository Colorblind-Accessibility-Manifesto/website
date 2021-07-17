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
                <div class="col-12 col-xl-6 bottom-left-text">
                    <a href="{{ url('/call-for-dev') }}">
                        <div class="sos-call-for-dev small">
                            <img src="{{ asset('img/emoji/sos-icon.png') }}" alt="sos-icon" />
                            <div>Call for devs</div>
                        </div>
                    </a>

                    <a href="#rules-section">Read the 10 rules</a>
                </div>
                <div class="col-12 col-xl-6 bottom-right-logo">
                    <img src="{{ mix('img/logo.svg') }}" alt="Logo" />
                </div>
            </div>
        </section>

        <section class="container-fluid rules-section" id="rules-section">
            @foreach(config('cam.rules') as $rule)
                <div class="rule">
                    <h2>{!! $rule['title'] !!}</h2>
                    <p>{!! $rule['rule'] !!}</p>
                </div>

                <hr />
            @endforeach
        </section>

        <section class="container-fluid signers-section">
            <h2>Colorblind Accessibility Manifesto</h2>
            <h5>is co-signed by <span class="adjust-line-height">{{ count(config('cam.signers')) }}</span> designers</h5>

            <div class="signers">
                @foreach(config('cam.signers') as $signer)
                    <div class="signer">
                        {{ $signer }}
                    </div>
                @endforeach
            </div>
        </section>

        @include('fragments/footer')

        <script src="{{ mix('js/app.js') }}"></script>
    </body>
</html>
