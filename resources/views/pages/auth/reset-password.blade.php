@extends("layouts.app")

@section("breadcrumbs")
    {!! Breadcrumbs::render("auth.reset-password") !!}
@stop

@section("content")
    <div class="content-section__wrapper">
        <div class="content-section">

            <h1 class="page-title centered">@lang('auth.reset_password_title')</h1>
        
            @include("partials.feedback")

            <form action="{{ route('auth.reset-password.post') }}" method="post">
                {{ csrf_field() }}



            </form>

        </div>
    </div>
@stop