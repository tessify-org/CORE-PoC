@extends("layouts.app")

@section("breadcrumbs")
    {!! Breadcrumbs::render("auth.login") !!}
@stop

@section("content")
    <div class="content-section__wrapper">
        <div class="content-section">

            <h1 class="page-title centered">Login</h1>
        
            @include("partials.feedback")

            <form action="{{ route('auth.login.post') }}" method="post">
                {{ csrf_field() }}
                
                <login-form
                    :errors="{{ $errors->toJson() }}"
                    :old-input="{{ $oldInput->toJson() }}">
                </login-form>

            </form>

        </div>
    </div>
@stop