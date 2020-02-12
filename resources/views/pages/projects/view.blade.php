@extends("layouts.app")

@section("breadcrumbs")
    {!! Breadcrumbs::render("projects.view", $project) !!}
@stop

@section("content")
    <div id="project">

        <!-- Header -->
        <div id="project-header" class="controls-only" style="background-image: url({{ asset($project->header_image_url) }});">
            <div id="project-header__overlay"></div>
            <div id="project-header__content" class="content-section">
                <!-- Back button -->
                <div id="project-header__back-button">
                    <v-btn href="{{ route('projects') }}">
                        <i class="fas fa-arrow-left"></i>
                        Terug naar overzicht
                    </v-btn>
                </div>
                <!-- Edit & delete buttons -->
                <div id="project-header__actions">
                    <v-btn class="icon-only" color="warning" href="{{ route('projects.edit', $project->slug) }}">
                        <i class="fas fa-edit"></i>
                    </v-btn>
                    <v-btn class="icon-only" color="red" dark href="{{ route('projects.delete', $project->slug) }}">
                        <i class="fas fa-trash-alt"></i>
                    </v-btn>
                </div>
            </div>
        </div>

        <!-- Content -->
        <div id="project-content" class="content-section__wrapper">
            <div class="content-section">
                
                <!-- Feedback -->
                @include("partials.feedback")

                <!-- Interactive view project -->
                <project-view
                    :project="{{ $project->toJson() }}"
                    :user="{{ $user->toJson() }}"
                    :comments="{{ $comments->toJson() }}"
                    create-comment-api-endpoint="{{ route('api.comments.create.post') }}"
                    update-comment-api-endpoint="{{ route('api.comments.update.post') }}"
                    delete-comment-api-endpoint="{{ route('api.comments.delete.post') }}"
                    create-team-member-application-api-endpoint="{{ route('api.team-member-applications.create.post') }}"
                    update-team-member-application-api-endpoint="{{ route('api.team-member-applications.update.post') }}"
                    delete-team-member-application-api-endpoint="{{ route('api.team-member-applications.delete.post') }}"
                    accept-team-member-application-api-endpoint="{{ route('api.team-member-applications.accept.post') }}"
                    deny-team-member-application-api-endpoint="{{ route('api.team-member-applications.deny.post') }}">
                </job-view>

            </div>
        </div>
        
    </div>
@stop