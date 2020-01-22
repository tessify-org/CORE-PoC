@extends("layouts.app")

@section("breadcrumbs")
    {!! Breadcrumbs::render("home") !!}
@stop

@section("content")
    <div class="content-section">

        @include("partials.feedback")

        <h1 class="page-title centered">Het Nieuwe Nieuwe Werken</h1>

        

    </div>
@stop