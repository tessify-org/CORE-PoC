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

            <div id="topnav__wrapper">
                <div id="topnav">
                    <div id="topnav-logo__wrapper">
                        <a id="topnav-logo" href="{{ route('home') }}">
                            N<sup>2</sup>W
                        </a>
                    </div>
                    <div id="topnav-links__wrapper">
                        <ul id="topnav-links">
                            @if (!Auth::check())
                                <li class="topnav-link__wrapper">
                                    <a class="topnav-link" href="#">
                                        Login
                                    </a>
                                </li>
                                <li class="topnav-link__wrapper">
                                    <a class="topnav-link" href="#">
                                        Register
                                    </a>
                                </li>
                            @else
                                <li class="topnav-link__wrapper">
                                    <a class="topnav-link" href="#">

                                    </a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>

        </v-app>

        {{-- Laravel Mix - JS File --}}
        <script src="{{ mix('js/app.js') }}"></script>

    </body>
</html>