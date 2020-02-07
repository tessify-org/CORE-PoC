@extends("layouts.app")

@section("breadcrumbs")
    {!! Breadcrumbs::render("profile", $user) !!}
@stop

@section("content")
    <div class="content-section__wrapper">
        <div class="content-section">

            <!-- Profile -->
            <div id="profile">

                <!-- Page title -->
                <h1 class="page-title centered">Profiel</h1>

                <!-- Profile header -->
                <div id="profile-header">
                    <div id="profile-header__avatar-wrapper">
                        <img id="profile-avatar" class="elevation-1" src="{{ is_null($user->avatar_url) ? Avatar::create($user->combinedName)->toBase64() : $user->avatar_url }}" />
                    </div>
                    <div id="profile-header__text-wrapper">
                        <h2 class="page-subtitle">{{ $user->combinedName }}</h2>
                        @if ($user->currentAssignment)
                            <h3 class="page-subtitle__subtext">
                                @if ($user->currentAssignment)
                                    {{ $user->currentAssignment->ministry->abbreviation }} - 
                                @endif
                                @if ($user->currentAssignment->organization)
                                    {{ $user->currentAssignment->organization->name }} - 
                                @endif
                                @if ($user->currentAssignment->department)
                                    {{ $user->currentAssignment->department->name }} -
                                @endif
                                @if ($user->currentAssignment->jobTitle)
                                    {{ $user->currentAssignment->jobTitle->name }}
                                @endif
                            </h3>
                        @endif
                    </div>
                </div>

                <!-- Feedback -->
                @include("partials.feedback")

                <!-- Profile information -->
                <div id="profile__info">

                    <!-- Account details -->
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
                            <div class="key">Telefoon nr.</div>
                            <div class="val">
                                @if (is_null($user->phone))
                                    <span class="italic">Niet opgegeven</span>
                                @else
                                    {{ $user->phone }}
                                @endif
                            </div>
                        </div>
                        @if ($user->currentAssignment)
                            <div class="detail">
                                <div class="key">Current assignment</div>
                                <div class="val">
                                    {{ $user->currentAssignment->ministry->name }}<br>
                                    {{ $user->currentAssignment->organization->name }}<br>
                                    {{ $user->currentAssignment->jobTitle->name }}
                                </div>
                            </div>
                        @endif
                        <div class="detail">
                            <div class="key">Created at</div>
                            <div class="val">{{ $user->created_at->format("d-m-Y") }}</div>
                        </div>
                        <div class="detail">
                            <div class="key">Updated at</div>
                            <div class="val">{{ $user->updated_at->format("d-m-Y") }}</div>
                        </div>
                    </div>
                    
                    <!--

                    <div id="profile__info-left"></div>
                    <div id="profile__info-right"></div>
                    -->
                    
                </div>

                <div id="profile__actions">
                    <v-btn color="primary" href="{{ route('profile.update') }}">
                        Update profiel
                    </v-btn>
                </div>

            </div>  

        </div>
    </div>
@stop