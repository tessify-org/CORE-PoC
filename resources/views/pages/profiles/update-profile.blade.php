@extends("layouts.app")

@section("breadcrumbs")
    {!! Breadcrumbs::render("profile.update", $user) !!}
@stop

@section("content")
    <div class="content-section__wrapper">
        <div class="content-section">

            <!-- Page title -->
            <h1 class="page-title centered">Update Profiel</h1>

            <!-- Feedback -->
            @include("partials.feedback")

            <form action="{{ route('profile.update.post') }}" method="post">
                {{ csrf_field() }}

                <update-profile-form
                    :user="{{ $user->toJson() }}"
                    :ministries="{{ $ministries->toJson() }}"
                    :organizations="{{ $organizations->toJson() }}"
                    :departments="{{ $departments->toJson() }}"
                    :job-titles="{{ $jobTitles->toJson() }}"
                    :errors="{{ $errors->toJson() }}"
                    :old-input="{{ $oldInput->toJson() }}">
                </update-profile-form>

            </form>

        </div>
    </div>
@stop