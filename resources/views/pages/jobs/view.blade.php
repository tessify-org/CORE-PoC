@extends("layouts.app")

@section("breadcrumbs")
    {!! Breadcrumbs::render("jobs.view", $job) !!}
@stop

@section("content")
    <div class="content-section">

        <h1 class="page-title centered">Job</h1>
    
        @include("partials.feedback")

    </div>
@stop