@extends("layouts.app")

@section("breadcrumbs")
    {!! Breadcrumbs::render("jobs.delete", $job) !!}
@stop

@section("content")
    <div class="content-section__wrapper">
        <div class="content-section">

            <h1 id="delete-dialog__title" class="page-title centered">Job verwijderen</h1>
        
            @include("partials.feedback")

            <form action="{{ route('jobs.delete', $job->slug) }}" method="post">
                {{ csrf_field() }}

                <div id="delete-dialog" class="elevation-1">
                    <div id="delete-dialog__text">
                        Weet je zeker dat je dit project (<strong>{{ $job->title }}</strong>) wilt verwijderen?<br>
                        Alle data zal onomkeerbaar uit de database worden gewist.
                    </div>
                    <div id="delete-dialog__actions">
                        <div id="delete-dialog__actions-left">
                            <v-btn href="{{ route('jobs.view', $job->slug) }}" outlined>
                                <i class="fas fa-arrow-left"></i>
                                Nee<span class="extra-text">, terug</span>
                            </v-btn>
                        </div>
                        <div id="delete-dialog__actions-right">
                            <v-btn type="submit" color="red" dark>
                                <i class="fas fa-trash-alt"></i>
                                Ja<span class="extra-text">, verwijderen</span>
                            </v-btn>
                        </div>
                    </div>
                </div>

            </form>

        </div>
    </div>
@stop