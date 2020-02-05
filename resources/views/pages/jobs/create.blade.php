@extends("layouts.app")

@section("breadcrumbs")
    {!! Breadcrumbs::render("jobs.create") !!}
@stop

@section("content")
    <div class="content-section__wrapper">
        <div class="content-section">

            <h1 class="page-title centered">Job toevoegen</h1>
        
            @include("partials.feedback")

            <form action="{{ route('jobs.create.post') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}

                <job-form
                    :job-statuses="{{ $statuses->toJson() }}"
                    :job-categories="{{ $categories->toJson() }}"
                    :work-methods="{{ $workMethods->toJson() }}"
                    :skills="{{ $skills->toJson() }}"
                    :errors="{{ $errors->toJson() }}"
                    :old-input="{{ $oldInput->toJson() }}"
                    back-href="{{ route('jobs') }}"
                    create-resource-api-endpoint="{{ route('api.jobs.resources.create.post') }}"
                    update-resource-api-endpoint="{{ route('api.jobs.resources.update.post') }}"
                    delete-resource-api-endpoint="{{ route('api.jobs.resources.delete.post') }}">
                </job-form>

            </form>

        </div>
    </div>
@stop