@extends("layouts.app")

@section("breadcrumbs")
    {!! Breadcrumbs::render("jobs.view", $job) !!}
@stop

@section("content")
    <div id="job">

        <!-- Header -->
        <div id="job-header" style="background-image: url({{ asset($job->header_image_url) }});">
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
                    <v-btn color="warning" href="{{ route('jobs.edit', $job->slug) }}">
                        <i class="fas fa-edit"></i>
                        Aanpassen
                    </v-btn>
                    <v-btn color="red" dark href="{{ route('jobs.delete', $job->slug) }}">
                        <i class="fas fa-trash-alt"></i>
                        Verwijderen
                    </v-btn>
                </div>
            </div>
            <!-- Title & description -->
            <div id="job-header__text-wrapper">
                <div id="job-header__text">
                    <!-- Title -->
                    <h1 id="job-header__title">{{ $job->title }}</h1>
                    <!-- Slogan -->
                    <h2 id="job-header__slogan">{{ $job->slogan }}</h2>
                    <!-- Stats -->
                    <div id="job-header__stats">
                        <!-- Status -->
                        <div class="stat">
                            <div id="job-status" class="{{ $job->status->name }} elevation-1">
                                {{ $job->status->label }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="content-section">
            
            @include("partials.feedback")

            <div id="job-content">
                <div id="job-content__left">

                    <div class="job-paragraph">
                        <h3 class="job-paragraph__title">Probleem dat wordt opgelost</h3>
                        <div class="job-paragraph__text">
                            {{ $job->problem }}
                        </div> 
                    </div>

                    <div class="job-paragraph">
                        <h3 class="job-paragraph__title">Projectomschrijving</h3>
                        <div class="job-paragraph__text">
                            {{ $job->description }}
                        </div>
                    </div>



                </div>
                <div id="job-content__right">

                    <div class="details elevation-1">
                        <div class="detail">
                            <div class="key">ID</div>
                            <div class="val">{{ $job->id }}</div>
                        </div>
                        <div class="detail">
                            <div class="key">Start op</div>
                            <div class="val">
                                @if (is_null($job->starts_at))
                                    <span class="italic">Nader te bepalen</span>
                                @else
                                    {{ $job->starts_at->format("d-m-Y") }}
                                @endif
                            </div>
                        </div>
                        <div class="detail">
                            <div class="key">Stopt op</div>
                            <div class="val">
                                @if (is_null($job->ends_at))
                                    <span class="italic">Nader te bepalen</span>
                                @else
                                    {{ $job->ends_at->format("d-m-Y") }}
                                @endif
                            </div>
                        </div>
                        <div class="detail">
                            <div class="key">Toegevoegd op</div>
                            <div class="val">{{ $job->created_at->format("d-m-Y") }}</div>
                        </div>
                        <div class="detail">
                            <div class="key">Toegevoegd door</div>
                            <div class="val">
                                <a href="{{ route('profile', $job->author->slug) }}">
                                    {{ $job->author->formattedName }}
                                </a>
                            </div>
                        </div>
                        <div class="detail">
                            <div class="key">Laatste gewijzigd op</div>
                            <div class="val">{{ $job->updated_at->format("d-m-Y") }}</div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
@stop