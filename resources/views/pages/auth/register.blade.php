@extends("layouts.app")

@section("breadcrumbs")
    {!! Breadcrumbs::render("auth.register") !!}
@stop

@section("content")
    <div class="content-section__wrapper">
        <div class="content-section">

            <h1 class="page-title centered">Register</h1>
        
            @include("partials.feedback")

            <form action="{{ route('auth.register.post') }}" method="post">
                {{ csrf_field() }}

                <register-form
                    :errors="{{ $errors->toJson() }}"
                    :old-input="{{ $oldInput->toJson() }}">
                </register-form>
            
            </form>

        </div>
    </div>
@stop