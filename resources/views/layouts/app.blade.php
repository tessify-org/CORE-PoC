<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>NNW @yield('page_title')</title>
        <link href="https://cdn.jsdelivr.net/npm/@mdi/font@4.x/css/materialdesignicons.min.css" rel="stylesheet">
        
        {{-- Laravel Mix - CSS File --}}
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        {{-- Font Awesome --}}
        <script defer src="https://use.fontawesome.com/releases/v5.8.2/js/all.js" integrity="sha384-DJ25uNYET2XCl5ZF++U8eNxPWqcKohUUBUpKGlNLMchM7q4Wjg2CUpjHLaL8yYPH" crossorigin="anonymous"></script>
        
    </head>
    <body>

        <v-app id="app" class="dark">

            <!-- Topnav -->
            <div id="topnav__wrapper">
                <div id="topnav">
                    <div id="topnav-logo__wrapper">
                        <a id="topnav-logo" href="{{ route('home') }}">
                            N<sup>2</sup>W
                        </a>
                    </div>
                    <div id="topnav-search__wrapper">
                        <form action="{{ route('search.post') }}" method="post">
                            {{ csrf_field() }}
                            <div id="topnav-search">
                                <input type="text" id="topnav-search__input" name="query" placeholder="Zoeken..">
                                <button type="submit" id="topnav-search__submit">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                    <div id="topnav-links__wrapper">
                        <ul id="topnav-links">
                            @if (!Auth::check())
                                <!-- Login -->
                                <li class="topnav-link__wrapper">
                                    <a class="topnav-link" href="{{ route('auth.login') }}">
                                        Login
                                    </a>
                                </li>
                                <!-- Register -->
                                <li class="topnav-link__wrapper">
                                    <a class="topnav-link" href="{{ route('auth.register') }}">
                                        Registeren
                                    </a>
                                </li>
                            @else
                                <!-- Jobs -->
                                <li class="topnav-link__wrapper">
                                    <a class="topnav-link" href="{{ route('jobs') }}">
                                        Job Board
                                    </a>
                                </li>
                                <!-- Leden -->
                                <li class="topnav-link__wrapper">
                                    <a class="topnav-link" href="{{ route('memberlist') }}">
                                        Ledenlijst
                                    </a>
                                </li>
                                <!-- Mijn profiel -->
                                <li class="topnav-link__wrapper">
                                    <a class="topnav-link" href="{{ route('profile') }}">
                                        Mijn profiel
                                    </a>
                                </li>
                                <!-- Logout -->
                                <li class="topnav-link__wrapper">
                                    <a class="topnav-link" href="{{ route('auth.logout') }}">
                                        Uitloggen
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
            
            <!-- Breadcrumbs -->
            @yield("breadcrumbs")

            <!-- Content -->
            <div id="content__wrapper">
                @yield("content")
            </div>

            <!-- Footer -->
            <footer id="footer__wrapper">
                <div id="footer">
                    &copy; Copyrighted by yours truly. This is the way. 2020 - &infin;
                </div>
            </div>

        </v-app>

        {{-- Laravel Mix - JS File --}}
        <script src="{{ mix('js/app.js') }}"></script>

    </body>
</html>