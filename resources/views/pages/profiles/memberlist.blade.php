@extends("layouts.app")

@section("breadcrumbs")
    {!! Breadcrumbs::render("memberlist") !!}
@stop

@section("content")
    <div class="content-section">

        <h1 class="page-title centered">Memberlist</h1>
    
        @include("partials.feedback")

        @if ($users->count())
            <div id="memberlist" class="elevation-1">
                @foreach ($users as $user)
                    <a class="member" href="{{ route('profile', $user->slug) }}">
                        <div class="member-name">
                            {{ $user->formattedName }}
                        </div>
                        <div class="member-ministry">
                            {{ $user->currentAssignment->ministry->abbreviation }}
                        </div>
                        <div class="member-organization">
                            {{ $user->currentAssignment->organization->name }}
                        </div>
                        <div class="member-job-title">
                            {{ $user->currentAssignment->jobTitle->name }}
                        </div>
                        <div class="member-reputation">
                            Excellent
                        </div>
                    </a>
                @endforeach
            </div>
        @else
            <div id="no-members">We konden geen gebruikers vinden!</div>
        @endif

    </div>
@stop