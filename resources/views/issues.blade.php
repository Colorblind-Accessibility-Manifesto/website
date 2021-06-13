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
<section class="container-fluid main-section issue-section flex-column">
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
    <div class="row issue-row">
        <div class="col-12">
            <div class="issue-row-container">
                <div class="emoticon @if(count(config('cam.issues')) === 0) celebration @else crying @endif"></div>
                <h2>
                    @if(count(config('cam.issues')) === 0)
                        There are no open issues
                    @else
                        {{ count(config('cam.issues')) }} Open @if(count(config('cam.issues')) === 1) issue @else issues @endif found
                    @endif
                </h2>

            </div>
        </div>
    </div>
</section>

@if(count(config('cam.issues')) > 0)
    <section class="container-fluid issues-section" id="issues-section">
        @foreach(config('cam.issues') as $rule)
            <div class="issue">
                <h2>{!! $rule['title'] !!}</h2> <h4>{!! $rule['date']->format('Y-m-d') !!}</h4>
                <p>{!! $rule['description'] !!}</p>
            </div>

            <hr />
        @endforeach
    </section>
@endif

<script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
