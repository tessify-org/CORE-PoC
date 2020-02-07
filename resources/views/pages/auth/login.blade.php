@extends("layouts.app")

@section("breadcrumbs")
    {!! Breadcrumbs::render("auth.login") !!}
@stop

@section("content")
    <div class="content-section__wrapper">
        <div class="content-section">

            @include("partials.feedback")

            <div id="login" class="elevation-1">
                <div id="login-left">

                    <h1 id="login-title">Aanmelden</h1>

                    <form action="{{ route('auth.login.post') }}" method="post">
                        {{ csrf_field() }}
                        
                        <login-form
                            :errors="{{ $errors->toJson() }}"
                            :old-input="{{ $oldInput->toJson() }}">
                        </login-form>

                        <div id="no-account">
                            Nog geen account? <a href="{{ route('auth.register') }}">Registreer nu!</a>
                        </div>

                    </form>

                </div>
                <div id="login-right">

                    <h2 class="login-subtitle">Wat is mijn NNW?</h2>
                    <div class="login-subtext">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus ipsum enim, tempor nec lobortis non, vulputate sit amet 
                        libero. Nunc eget interdum sem. Fusce eu luctus turpis, sed scelerisque turpis. Aliquam tortor nulla, hendrerit eu maximus 
                        eget, egestas nec lectus. Pellentesque convallis imperdiet faucibus.
                    </div>

                    <h2 class="login-subtitle">Meer weten?</h2>
                    <div class="login-subtext">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus ipsum enim, tempor nec lobortis non, vulputate sit amet 
                        libero. Nunc eget interdum sem. Fusce eu luctus turpis, sed scelerisque turpis. Aliquam tortor nulla, hendrerit eu maximus 
                        eget, egestas nec lectus. Pellentesque convallis imperdiet faucibus.
                    </div>

                </div>
            </div>

        </div>
    </div>
@stop