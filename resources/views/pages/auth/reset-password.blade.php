@extends("layouts.app")

@section("breadcrumbs")
    {!! Breadcrumbs::render("auth.reset-password", ["code" => $code, "email" => $email]) !!}
@stop

@section("content")
    <div class="content-section__wrapper">
        <div class="content-section">

            <h1 class="page-title centered">@lang('auth.reset_password_title')</h1>
        
            @include("partials.feedback")

            <form action="{{ route('auth.reset-password.post', ['email' => $email, 'code' => $code]) }}" method="post">
                {{ csrf_field() }}

                <reset-password-form
                    code="{{ $code }}"
                    email="{{ $email }}"
                    :errors="{{ $errors->toJson() }}"
                    email-label-text="{{ __('auth.reset_password_form_email') }}"
                    code-label-text="{{ __('auth.reset_password_form_code') }}"
                    password-label-text="{{ __('auth.reset_password_form_password') }}"
                    password-confirmation-label-text="{{ __('auth.reset_password_form_password_confirmation') }}"
                    back-href="{{ route('auth.login') }}"
                    back-button-text="{{ __('auth.reset_password_form_back') }}"
                    submit-button-text="{{ __('auth.reset_password_form_submit') }}">
                </reset-password-form>

            </form>

        </div>
    </div>
@stop