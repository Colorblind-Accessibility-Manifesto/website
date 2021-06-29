<div class="navigation-buttons-container">
    <div class="navigation-buttons">
        @if(!Route::is('index'))
            <div class="btn-container">
                <a href="{{ url('/') }}" class="btn-wrapper">
                    <div class="btn-icon paper"></div>
                    <button type="button" class="btn btn-dark signing">
                        Read the manifesto
                    </button>
                </a>
            </div>
        @endif
        <div class="btn-container">
            <a href="mailto:{{ config('cam.config.signing-email.address') }}?subject={{ config('cam.config.signing-email.subject') }}&body={{ config('cam.config.signing-email.body') }}" class="btn-wrapper">
                <div class="btn-icon signing"></div>
                <button type="button" class="btn btn-dark signing">
                    Sign the manifesto
                </button>
            </a>
        </div>
        <div class="btn-container">
            <a href="{{ url('/issues') }}" class="btn-wrapper @if(Route::is('issues')) selected @endif">
                <div class="btn-icon crying"></div>
                <button type="button" class="btn btn-dark crying">
                    Read open issues
                </button>
            </a>
        </div>
    </div>
</div>
