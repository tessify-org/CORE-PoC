@extends("layouts.app")

@section("breadcrumbs")
    {!! Breadcrumbs::render("profile", $user) !!}
@stop

@section("content")
    <div class="content-section">

        <h1 class="page-title centered">Profiel</h1>
        
        @include("partials.feedback")


        <div id="profile">

            <div id="profile-header">
                <div id="profile-header__avatar-wrapper">
                    <div id="profile-avatar" class="elevation-1"></div>
                </div>
                <div id="profile-header__text-wrapper">
                    <h2 class="page-subtitle">{{ $user->combinedName }}</h2>
                    <h3 class="page-subtitle__subtext">
                        {{ $user->currentAssignment->ministry->abbreviation }} - {{ $user->currentAssignment->organization->name }} - {{ $user->currentAssignment->jobTitle->name }}
                    </h3>
                </div>
            </div>

            <div id="profile__info">
                <div id="profile__info-left">
                    <div class="details elevation-1">
                        <div class="detail">
                            <div class="key">Naam</div>
                            <div class="val">{{ $user->formattedName }}</div>
                        </div>
                        <div class="detail">
                            <div class="key">Email</div>
                            <div class="val">{{ $user->email }}</div>
                        </div>
                        <div class="detail">
                            <div class="key">Email activated</div>
                            <div class="val">
                                @if (is_null($user->email_activated_at))
                                    <span class="red-text">
                                        Not activated
                                    </span>
                                @else
                                    <span class="green-text">
                                        Activated on {{ $user->email_activated_at->format("d-m-Y") }}
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="detail">
                            <div class="key">Current assignment</div>
                            <div class="val">
                                {{ $user->currentAssignment->ministry->name }}<br>
                                {{ $user->currentAssignment->organization->name }}<br>
                                {{ $user->currentAssignment->jobTitle->name }}
                            </div>
                        </div>
                        <!-- <div class="detail">
                            <div class="key"></div>
                            <div class="val"></div>
                        </div> -->
                        <div class="detail">
                            <div class="key">Created at</div>
                            <div class="val">{{ $user->created_at->format("d-m-Y") }}</div>
                        </div>
                        <div class="detail">
                            <div class="key">Updated at</div>
                            <div class="val">{{ $user->updated_at->format("d-m-Y") }}</div>
                        </div>
                    </div>

                </div>
                <div id="profile__info-right">

                </div>
            </div>

        </div>

    </div>
@stop