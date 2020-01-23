@extends("layouts.app")

@section("breadcrumbs")
    {!! Breadcrumbs::render("jobs") !!}
@stop

@section("content")
    <div class="content-section">

        <h1 class="page-title centered">Job Board</h1>
    
        @include("partials.feedback")

    </div>
@stop