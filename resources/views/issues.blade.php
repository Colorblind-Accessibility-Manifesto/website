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
    $count   = $filters->pluck('count')->sum();
@endphp

@if(count(config('cam.issues')) > 0)
    <section class="container-fluid issues-section" id="issues-section">

        <div class="filter-issues">
            <select id="filter-issues">
                <option value="" selected="selected" name="dsf">All ({{ $count }})</option>
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

<div class="modal-background {{ (isset($modal_open) && $modal_open || session()->has('success')) ? 'show' : '' }}" id="issue-modal">
    <div class="modal">

        <form action="{{ route('new-issue') }}" method="POST">
            {{ csrf_field() }}

            <div class="field-wrapper">
                <div class="field-icon description"></div>
                <div class="field-key">Fill in the fields below to make a report</div>
            </div>

            <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                </symbol>
                <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                </symbol>
                <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                </symbol>
            </svg>

            @if(count($errors) > 0)
                <div class="alert alert-warning d-flex align-items-center" role="alert">

                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Warning:">
                        <use xlink:href="#exclamation-triangle-fill"/>
                    </svg>

                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if(session()->has('success'))
                <div class="alert alert-success d-flex align-items-center" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                    <div>
                        The form has been successfully submitted.
                    </div>
                </div>
            @endif

            <div class="field-wrapper">
                <div class="field-icon world"></div>
                <div class="field-key">Website link (URL):</div>
                <div class="field-value">
                    <input type="text" name="url" @if ($errors->has('url')) class="error" @endif value="{{ request()->input('url') }}" />
                </div>
            </div>
            <div class="field-wrapper textarea">
                <div class="field-info">
                    <div class="field-icon list"></div>
                    <div class="field-key">Issue description:</div>
                </div>
                <div class="field-value">
                    <textarea name="issue" rows="3" @if ($errors->has('issue')) class="error" @endif>{{ request()->input('issue', old('issue')) }}</textarea>
                </div>
            </div>
            <div class="field-wrapper">
                <div class="field-icon calendar"></div>
                <div class="field-key">Date:</div>
                <div class="field-value short-width">
                    <input type="date" name="date" @if ($errors->has('date')) class="error" @endif value="{{ request()->input('date', old('date')) }}" />
                </div>
            </div>
            {!! NoCaptcha::display(['data-theme' => 'dark']) !!}

            <input class="btn btn-dark" type="submit" value="Add issue" />
        </form>

        <div class="modal-close"></div>
    </div>
</div>

{!! NoCaptcha::renderJs() !!}
<script src="{{ mix('js/app.js') }}"></script>
<script src="{{ mix('js/modal.js') }}"></script>
<script src="{{ mix('js/issues.js') }}"></script>
</body>
</html>
