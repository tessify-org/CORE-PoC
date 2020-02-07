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
        <div id="homepage-header__bg">
            <video autoplay muted loop id="myVideo">
                <source src="{{ asset('storage/videos/1.mp4') }}" type="video/mp4">
            </video>
        </div>
    </header>

    <div id="homepage">
    
        <div class="content-section__wrapper">
            <div class="content-section">

                <div id="homepage-cta">
                    <div id="homepage-cta__title">Er zijn al 8114 klussen aangemeld</div>
                    <div id="homepage-cta__subtext">Zoek op interesse, organisatie, of stad.</div>
                    <div id="homepage-cta__search-wrapper">
                        <div id="search-input__wrapper">
                            <input type="text" id="search-input">
                        </div>
                        <div id="search-submit__wrapper">
                            <button type="submit" id="search-submit">
                                Zoek
                                <i class="fas fa-arrow-right"></i>
                            </button>
                        </div>
                    </div>
                    <div id="homepage-cta__link-wrapper">
                        <a href="#">Meld je klus aan</a>
                    </div>
                </div>

                <div id="homepage-quick-links">
                    <div class="quick-link__wrapper">
                        <div class="quick-link">
                            <div class="quick-link__bg"></div>
                            <div class="quick-link__text">
                                Zo haal je meer uit je werk
                            </div>
                            <div class="quick-link__arrow">
                                <i class="fas fa-arrow-right"></i>
                            </div>
                        </div>
                    </div>
                    <div class="quick-link__wrapper">
                        <div class="quick-link">
                            <div class="quick-link__bg"></div>
                            <div class="quick-link__text">
                                Tips, uitleg en inspiratie
                            </div>
                            <div class="quick-link__arrow">
                                <i class="fas fa-arrow-right"></i>
                            </div>
                        </div>
                    </div>
                    <div class="quick-link__wrapper">
                        <div class="quick-link">
                            <div class="quick-link__bg"></div>
                            <div class="quick-link__text">
                                Méér doen als vrijwilleger
                            </div>
                            <div class="quick-link__arrow">
                                <i class="fas fa-arrow-right"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="homepage-second-cta">
                    <div id="second-cta">
                        <div id="second-cta__left">
                            <div id="second-cta__title">Er zijn al 8114 klussen aangemeld</div>
                            <div id="second-cta__subtext">Staat jouw klus er al tussen?</div>
                            <a id="second-cta__button" href="#">
                                Meld je klus aan
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                        <div id="second-cta__right">
                            <div id="second-cta__image"></div>
                        </div>
                    </div>
                </div>
                
                <div id="homepage-faq">
                    <h3 id="homepage-faq__title">Veelgestelde vragen</h3>
                    <div id="homepage-faq__list">
                        <a href="#" class="faq">
                            <span class="faq-icon">
                                <i class="fas fa-arrow-right"></i>
                            </span>
                            <span class="faq-text">Hoe kan ik meedoen?</span>
                        </a>
                        <a href="#" class="faq">
                            <span class="faq-icon">
                                <i class="fas fa-arrow-right"></i>
                            </span>
                            <span class="faq-text">Kan ik met een groep meedoen?</span>
                        </a>
                        <a href="#" class="faq">
                            <span class="faq-icon">
                                <i class="fas fa-arrow-right"></i>
                            </span>
                            <span class="faq-text">Mag ik ook prive klussen plaatsen?</span>
                        </a>
                        <a href="#" class="faq">
                            <span class="faq-icon">
                                <i class="fas fa-arrow-right"></i>
                            </span>
                            <span class="faq-text">How much wood could a woodchucker chuck if a woodchucker could chuck wood?</span>
                        </a>
                        <a href="#" class="faq">
                            <span class="faq-icon">
                                <i class="fas fa-arrow-right"></i>
                            </span>
                            <span class="faq-text">Hoeveel krullen krabt de kat van de trap?</span>
                        </a>
                        <a href="#" class="faq">
                            <span class="faq-icon">
                                <i class="fas fa-arrow-right"></i>
                            </span>
                            <span class="faq-text">Hoeveel t's zitten er in hottentottententoonstelling?</span>
                        </a>
                    </div>
                    <div id="homepage-faq__cta-wrapper">
                        <a href="#" id="homepage-faq__cta">
                            Bekijk alle veelgestelde vragen
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>

                <!-- How it works
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
                </div> -->

                <!-- What it means for you 
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
                </div>-->

                <!-- Success verhalen
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
                </div> -->

            </div>

        </div>
    </div>
@stop