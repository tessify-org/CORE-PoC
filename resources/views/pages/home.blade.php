@extends("layouts.app")

@section("breadcrumbs")
    {!! Breadcrumbs::render("home") !!}
@stop

@section("content")
    
    <!-- Header -->
    <header id="homepage-header">
        <div id="homepage-header__content">
            @include("partials.feedback")
            <h1 class="page-title">Het Nieuwe Nieuwe Werken</h1>
            <h2 class="page-subtitle">Hoe werk jij?</h2>
        </div>
        <div id="homepage-header__overlay"></div>
    </header>

    <div id="homepage">

        <!-- How it works -->
        <div class="content-section__wrapper">
            <div class="content-section">
                <h3 class="content-section__title centered">Hoe het werkt</h3>
                <div id="how-it-works">
                    <div class="how-it-works__step-wrapper">
                        <div class="how-it-works__step">
                            <div class="how-it-works__step-image"></div>
                            <div class="how-it-works__text">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam hendrerit ante vitae massa gravida, at interdum odio auctor. Fusce sodales pharetra urna eu vestibulum. Sed condimentum quam non gravida consequat. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. 
                            </div>
                        </div>
                    </div>
                    <div class="how-it-works__step-wrapper">
                        <div class="how-it-works__step">
                            <div class="how-it-works__step-image"></div>
                            <div class="how-it-works__text">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam hendrerit ante vitae massa gravida, at interdum odio auctor. Fusce sodales pharetra urna eu vestibulum. Sed condimentum quam non gravida consequat. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.
                            </div>
                        </div>
                    </div>
                    <div class="how-it-works__step-wrapper">
                        <div class="how-it-works__step">
                            <div class="how-it-works__step-image"></div>
                            <div class="how-it-works__text">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam hendrerit ante vitae massa gravida, at interdum odio auctor. Fusce sodales pharetra urna eu vestibulum. Sed condimentum quam non gravida consequat. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- What it means for you -->
        <div class="content-section__wrapper alt">
            <div class="content-section">
                <h3 class="content-section__title centered">Wat betekend dit voor jou?</h3>
                <div id="what-it-means">
                    <div id="what-it-means__text">
                        Stuff and things. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam hendrerit ante vitae massa gravida, 
                        at interdum odio auctor. Fusce sodales pharetra urna eu vestibulum. Sed condimentum quam non gravida consequat. 
                        Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Pellentesque nec 
                        leo elementum, venenatis mauris ac, viverra mi. In id quam mattis, vestibulum enim vitae, ornare augue. Nam volutpat 
                        quam ut lectus euismod, eget gravida dui rutrum. Nam blandit dignissim sem at efficitur. Praesent molestie massa felis, 
                        a luctus lectus ultricies at. Proin a risus efficitur diam lacinia cursus ac in velit. Aliquam lacus mauris, fringilla 
                        eleifend fringilla ut, sagittis quis nisl. Praesent rhoncus pulvinar placerat. 
                    </div>
                    <div id="what-it-means__image-wrapper">
                        <div id="what-it-means__image"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Success verhalen -->
        <div class="content-section__wrapper">
            <div class="content-section">
                <h3 class="content-section__title centered">Succesverhalen</h3>
                <div id="success-stories">
                    <div class="success-story-wrapper">
                        <div class="success-story">
                            <div class="success-story__title">Gemeente Utrecht</div>
                            <div class="success-story__text">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam hendrerit ante vitae massa gravida, 
                                at interdum odio auctor. Fusce sodales pharetra urna eu vestibulum. Sed condimentum quam non gravida 
                                consequat. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. 
                                Pellentesque nec leo elementum, venenatis mauris ac, viverra mi.
                            </div>
                        </div>
                    </div>
                    <div class="success-story-wrapper">
                        <div class="success-story">
                            <div class="success-story__title">MinBZK</div>
                            <div class="success-story__text">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam hendrerit ante vitae massa gravida, 
                                at interdum odio auctor. Fusce sodales pharetra urna eu vestibulum. Sed condimentum quam non gravida 
                                consequat. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. 
                                Pellentesque nec leo elementum, venenatis mauris ac, viverra mi.
                            </div>
                        </div>
                    </div>
                    <div class="success-story-wrapper">
                        <div class="success-story">
                            <div class="success-story__title">Mijn oma</div>
                            <div class="success-story__text">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam hendrerit ante vitae massa gravida, 
                                at interdum odio auctor. Fusce sodales pharetra urna eu vestibulum. Sed condimentum quam non gravida 
                                consequat. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. 
                                Pellentesque nec leo elementum, venenatis mauris ac, viverra mi.
                            </div>
                        </div>
                    </div>
                </div>
            </div>  
        </div>

    </div>
@stop