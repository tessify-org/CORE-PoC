@extends("layouts.app")

@section("breadcrumbs")
    {!! Breadcrumbs::render("jobs") !!}
@stop

@section("content")
    <div class="content-section__wrapper">
        <div class="content-section">

            <h1 class="page-title centered">Job Board</h1>
        
            @include("partials.feedback")

            <div class="page-controls mb">
                <div class="page-controls__right">
                    <v-btn color="success" href="{{ route('jobs.create') }}">
                        <i class="fas fa-plus"></i>
                        Job toevoegen
                    </v-btn>
                </div>
            </div>

            @if ($jobs->count() > 0)
                <div id="jobs" class="elevation-1">
                    <div id="jobs-header">
                        <div class="jobs-header__column">Title</div>
                        <div class="jobs-header__column">Status</div>
                    </div>
                    @foreach ($jobs as $job)
                        <a class="job" href="{{ route('jobs.view', $job->slug) }}">
                            <span class="job-title">{{ $job->title }}</span>
                            <span class="job-status">{{ $job->status->label }}</span>
                        </a>
                    @endforeach
                </div>
            @else
                <div id="no-jobs" class="elevation-1">
                    Wees de eerste die een job toevoegd aan het platform!
                </div>
            @endif

        </div>
    </div>
@stop