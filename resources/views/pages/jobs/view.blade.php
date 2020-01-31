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
                    <v-btn class="icon-only" color="warning" href="{{ route('jobs.edit', $job->slug) }}">
                        <i class="fas fa-edit"></i>
                    </v-btn>
                    <v-btn class="icon-only" color="red" dark href="{{ route('jobs.delete', $job->slug) }}">
                        <i class="fas fa-trash-alt"></i>
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

                    <v-tabs id="job-tabs" class="elevation-1">
                        <v-tab>Algemene informatie</v-tab>
                        <v-tab>Taken</v-tab>
                        <v-tab>Geschiedenis</v-tab>
                        <v-tab-item>
                            <div class="tab-content">

                                <div id="job-info">
                                    <div id="job-info__left">
                                        
                                        <!-- Probleemstelling -->
                                        <div class="job-paragraph">
                                            <h3 class="job-paragraph__title">Probleem dat wordt opgelost</h3>
                                            <div class="job-paragraph__text">
                                                {{ $job->problem }}
                                            </div> 
                                        </div>
                    
                                        <!-- Projectomschrijving -->
                                        <div class="job-paragraph">
                                            <h3 class="job-paragraph__title">Projectomschrijving</h3>
                                            <div class="job-paragraph__text">
                                                {{ $job->description }}
                                            </div>
                                        </div>

                                        <!-- Comments -->
                                        <comments
                                            per-page="3"
                                            target-type="job"
                                            target-id="{{ $job->id }}"
                                            :user="{{ $user->toJson() }}"
                                            :comments="{{ $comments->toJson() }}"
                                            create-comment-api-endpoint="{{ route('api.comments.create.post') }}"
                                            update-comment-api-endpoint="{{ route('api.comments.update.post') }}"
                                            delete-comment-api-endpoint="{{ route('api.comments.delete.post') }}">
                                        </comments>

                                    </div>
                                    <div id="job-info__right">

                                        <!-- Details -->
                                        <h3 class="sidebar-title">Details</h3>
                                        <div class="details compact bordered">
                                            <!-- ID -->
                                            <div class="detail">
                                                <div class="key">ID</div>
                                                <div class="val">{{ $job->id }}</div>
                                            </div>
                                            <!-- Category -->
                                            <div class="detail">
                                                <div class="key">Categorie</div>
                                                <div class="val">{{ $job->category->label }}</div>
                                            </div>
                                            <!-- Work method -->
                                            <div class="detail">
                                                <div class="key">Werkmethode</div>
                                                <div class="val">{{ $job->workMethod->label }}</div>
                                            </div>
                                            <!-- Starts at -->
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
                                            <!-- Ends at -->
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
                                            <!-- Created by -->
                                            <div class="detail">
                                                <div class="key">Toegevoegd door</div>
                                                <div class="val">
                                                    <a href="{{ route('profile', $job->author->slug) }}">
                                                        {{ $job->author->formattedName }}
                                                    </a>
                                                </div>
                                            </div>
                                            <!-- Created at -->
                                            <div class="detail">
                                                <div class="key">Toegevoegd op</div>
                                                <div class="val">{{ $job->created_at->format("d-m-Y H:m:s") }}</div>
                                            </div>
                                            <!-- Updated at -->
                                            <div class="detail">
                                                <div class="key">Laatste gewijzigd op</div>
                                                <div class="val">{{ $job->updated_at->format("d-m-Y H:m:s") }}</div>
                                            </div>
                                        </div>

                                        <!-- Team roles -->
                                        <h3 class="sidebar-title">Team members</h3>
                                        <div id="job-team-roles">
                                            @if ($job->teamRoles->count())
                                                <div id="job-team-roles__list">
                                                    @foreach ($job->teamRoles as $teamRole)
                                                        <div class="team-role">
                                                            <div class="team-role__avatar-wrapper">
                                                                <div class="team-role__avatar"></div>
                                                            </div>
                                                            <div class="team-role__text-wrapper">
                                                                <div class="team-role__name">{{ $teamRole->name }}</div>
                                                            </div>
                                                            <div class="team-role__actions">

                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @else
                                                <div id="job-no-team-roles">
                                                    Er zijn nog geen rollen gedefinieert
                                                </div>
                                            @endif
                                        </div>

                                        <!-- Resources -->
                                        <h3 class="sidebar-title">Resources</h3>
                                        <div id="job-resources">
                                            @if (count($job->resources))
                                                <div id="job-resources__list">
                                                    @foreach ($job->resources as $resource)
                                                        <div class="resource">
                                                            <div class="resource-icon">
                                                                <i class="far fa-file"></i>
                                                            </div>
                                                            <div class="resource-title">{{ $resource->title }}</div>
                                                            <div class="resource-size">{{ $resource->file_size }} kb</div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @else
                                                <div id="job-resources__empty">
                                                    Er zijn nog geen resources toegevoegd.
                                                </div>
                                            @endif
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </v-tab-item>
                        <v-tab-item>
                            <div class="tab-content">

                            </div>
                        </v-tab-item>
                        <v-tab-item>
                            <div class="tab-content">

                            </div>
                        </v-tab-item>
                    </v-tabs>
                    

        </div>
    </div>
@stop