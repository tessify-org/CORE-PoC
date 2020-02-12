@extends("layouts.app")

@section("breadcrumbs")
    {!! Breadcrumbs::render("projects") !!}
@stop

@section("content")
    <div class="content-section__wrapper">
        <div class="content-section">

            <h1 class="page-title centered">Projecten</h1>
        
            @include("partials.feedback")

            <div class="page-controls mb">
                <div class="page-controls__right">
                    <v-btn color="success" href="{{ route('projects.create') }}">
                        <i class="fas fa-plus"></i>
                        Project toevoegen
                    </v-btn>
                </div>
            </div>

            @if ($projects->count() > 0)
                <div id="projects" class="elevation-1">
                    <div id="projects-header">
                        <div class="projects-header__column">Title</div>
                        <div class="projects-header__column">Status</div>
                    </div>
                    @foreach ($projects as $project)
                        <a class="project" href="{{ route('projects.view', $project->slug) }}">
                            <span class="project-title">{{ $project->title }}</span>
                            <span class="project-status">{{ $project->status->label }}</span>
                        </a>
                    @endforeach
                </div>
            @else
                <div id="no-projects" class="elevation-1">
                    Wees de eerste die een job toevoegd aan het platform!
                </div>
            @endif

        </div>
    </div>
@stop