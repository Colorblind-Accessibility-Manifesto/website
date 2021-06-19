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
<body class="issues-page">
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
                        {{ count(config('cam.issues')) }} open @if(count(config('cam.issues')) === 1) issue @else issues @endif found
                    @endif
                </h2>
                <button type="button" class="btn btn-dark" id="add-an-issue">Add an issue</button>
            </div>
        </div>
    </div>
</section>

@php
    $issues = collect(config('cam.issues'));
    $issues = $issues->map(function($issue) use ($issues) {
        $issue['slug'] = Str::slug($issue['title']);
        return $issue;
    });

    $issues = $issues->map(function($issue1) use ($issues) {
        $issue1['count'] = $issues->filter(function($issue2) use ($issue1) {
            return $issue1['slug'] === $issue2['slug'];
        })->count();
        return $issue1;
    });

    $filters = $issues->unique('slug');
@endphp

@if(count(config('cam.issues')) > 0)
    <section class="container-fluid issues-section" id="issues-section">

        <div class="filter-issues">
            <select id="filter-issues">
                <option value="">Choose the website:</option>
                @foreach($filters as $filter)
                    <option value="{!! $filter['slug'] !!}">{!! $filter['title'] !!} ({{ $filter['count'] }})</option>
                @endforeach
            </select>
        </div>


        @foreach($issues as $rule)
            <div class="issue" data-slug="{!! $rule['slug']  !!}">
                <h2>{!! $rule['title'] !!}</h2> <h4>{!! $rule['date']->format('Y-m-d') !!}</h4>
                <p>{!! $rule['description'] !!}</p>

                <hr />
            </div>
        @endforeach
    </section>
@endif

<div class="modal-background shsow" id="issue-modal">
    <div class="modal">
        <div class="field-wrapper">
            <div class="field-icon description"></div>
            <div class="field-key">Fill in the fields below to make a report</div>
        </div>
        <div class="field-wrapper">
            <div class="field-icon world"></div>
            <div class="field-key">Website link (URL):</div>
            <div class="field-value">
                <input type="text" name="url" />
            </div>
        </div>
        <div class="field-wrapper textarea">
            <div class="field-info">
                <div class="field-icon list"></div>
                <div class="field-key">Issue description:</div>
            </div>
            <div class="field-value">
                <textarea name="issue" rows="3"></textarea>
            </div>
        </div>
        <div class="field-wrapper">
            <div class="field-icon calendar"></div>
            <div class="field-key">Date:</div>
            <div class="field-value short-width">
                <input type="date" name="date" />
            </div>
        </div>
    </div>
</div>

<script src="{{ mix('js/app.js') }}"></script>
<script src="{{ mix('js/modal.js') }}"></script>
<script src="{{ mix('js/issues.js') }}"></script>
</body>
</html>
