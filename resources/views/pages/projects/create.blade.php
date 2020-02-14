@extends("layouts.app")

@section("breadcrumbs")
    {!! Breadcrumbs::render("projects.create") !!}
@stop

@section("content")
    <div class="content-section__wrapper">
        <div class="content-section">

            <h1 class="page-title centered">Project toevoegen</h1>
        
            @include("partials.feedback")

            <form action="{{ route('projects.create.post') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}

                <project-form
                    :project-statuses="{{ $statuses->toJson() }}"
                    :project-categories="{{ $categories->toJson() }}"
                    :work-methods="{{ $workMethods->toJson() }}"
                    :skills="{{ $skills->toJson() }}"
                    :errors="{{ $errors->toJson() }}"
                    :old-input="{{ $oldInput->toJson() }}"
                    back-href="{{ route('projects') }}"
                    create-resource-api-endpoint="{{ route('api.projects.resources.create.post') }}"
                    update-resource-api-endpoint="{{ route('api.projects.resources.update.post') }}"
                    delete-resource-api-endpoint="{{ route('api.projects.resources.delete.post') }}">
                </project-form>

            </form>

        </div>
    </div>
@stop