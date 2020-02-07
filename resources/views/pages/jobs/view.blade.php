@extends("layouts.app")

@section("breadcrumbs")
    {!! Breadcrumbs::render("jobs.view", $job) !!}
@stop

@section("content")
    <div id="job">

        <!-- Header -->
        <div id="job-header" class="controls-only" style="background-image: url({{ asset($job->header_image_url) }});">
            <div id="job-header__overlay"></div>
            <div id="job-header__content" class="content-section">
                <!-- Back button -->
                <div id="job-header__back-button">
                    <v-btn href="{{ route('jobs') }}">
                        <i class="fas fa-arrow-left"></i>
                        Terug naar overzicht
                    </v-btn>
                </div>
                <!-- Edit & delete buttons -->
                <div id="job-header__actions">
                    <v-btn class="icon-only" color="warning" href="{{ route('jobs.edit', $job->slug) }}">
                        <i class="fas fa-edit"></i>
                    </v-btn>
                    <v-btn class="icon-only" color="red" dark href="{{ route('jobs.delete', $job->slug) }}">
                        <i class="fas fa-trash-alt"></i>
                    </v-btn>
                </div>
            </div>
        </div>

        <!-- Content -->
        <div id="job-content" class="content-section__wrapper">
            <div class="content-section">
                
                <!-- Feedback -->
                @include("partials.feedback")

                <!-- Interactive view job -->
                <job-view
                    :job="{{ $job->toJson() }}"
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