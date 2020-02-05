@extends("layouts.app")

@section("breadcrumbs")
    {!! Breadcrumbs::render("memberlist") !!}
@stop

@section("content")
    <div class="content-section__wrapper">
        <div class="content-section">

            <h1 class="page-title centered">Ledenlijst</h1>
        
            @include("partials.feedback")

            @if ($users->count())
                <div id="memberlist" class="elevation-1">
                    <div id="memberlist__header">
                        <div class="memberlist__header-column">Naam</div>
                        <div class="memberlist__header-column">Ministerie</div>
                        <div class="memberlist__header-column">Organisatie</div>
                        <div class="memberlist__header-column">Functie</div>
                        <div class="memberlist__header-column">Reputatie</div>
                    </div>
                    <div id="memberlist__content">
                        @foreach ($users as $user)
                            <a class="member" href="{{ route('profile', $user->slug) }}">
                                <div class="member-name">
                                    {{ $user->formattedName }}
                                </div>
                                @if ($user->currentAssignment)
                                    <div class="member-ministry">
                                        {{ $user->currentAssignment->ministry->abbreviation }}
                                    </div>
                                @endif
                                @if ($user->currentAssignment)
                                    <div class="member-organization">
                                        {{ $user->currentAssignment->organization->name }}
                                    </div>
                                @endif
                                @if ($user->currentAssignment)
                                    <div class="member-job-title">
                                        {{ $user->currentAssignment->jobTitle->name }}
                                    </div>
                                @endif
                                <div class="member-reputation">
                                    Excellent
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            @else
                <div id="no-members">We konden geen gebruikers vinden!</div>
            @endif

        </div>
    </div>
@stop