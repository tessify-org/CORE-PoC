@extends("layouts.app")

@section("breadcrumbs")
    {!! Breadcrumbs::render("jobs.create") !!}
@stop

@section("content")
    <div class="content-section">

        <h1 class="page-title centered">Job toevoegen</h1>
    
        @include("partials.feedback")

        <form action="{{ route('jobs.create.post') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}

            <job-form
                :job-statuses="{{ $statuses->toJson() }}"
                :errors="{{ $errors->toJson() }}"
                :old-input="{{ $oldInput->toJson() }}"
                back-href="{{ route('jobs') }}">
            </job-form>

        </form>

    </div>
@stop