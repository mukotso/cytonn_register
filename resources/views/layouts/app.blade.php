<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Cytonn_register') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <link rel="shortcut icon" href="{{ asset('images/logo.jpeg') }}">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    <nav-bar inline-template v-cloak>
        <div class="font-sans antialiased">
            <nav class="flex items-center justify-between flex-wrap p-6">
                <div class="flex items-center flex-no-shrink text-blue-400 mr-6">
                    <span class="font-bold text-2xl tracking-tight">CYTONN REGISTER</span>
                </div>
                <div class="block sm:hidden">
                    <button @click="toggle"
                            class="flex items-center px-3 py-2 border rounded text-teal-lighter border-teal-light hover:text-white hover:border-white">
                       MENU
                    </button>
                </div>
                <div :class="open ? 'block': 'hidden'" class="w-full flex-grow sm:flex sm:items-center sm:w-auto">
                    <div class="text-sm sm:flex-grow">

                    </div>



                        <a @click=""
                           class=" text-2xl no-underline block mt-4 sm:inline-block sm:mt-0 text-teal-lighter hover:text-white mr-4">
                            <span class="material-icons"></span>
                            Home
                        </a>

                        <a href="/departments"
                           class=" text-2xl no-underline block mt-4 sm:inline-block sm:mt-0 text-teal-lighter hover:text-white mr-4">
                            <i class="fa fa-users text-blue-400 "></i>
                            Departments
                        </a>

                        <a href="/categories"
                           class=" text-2xl no-underline block mt-4 sm:inline-block sm:mt-0 text-teal-lighter hover:text-white mr-4">
                            <i class="fa fa-users text-blue-400 "></i>
                            Categories
                        </a>

                        <a href="/users"
                           class=" text-2xl no-underline block mt-4 sm:inline-block sm:mt-0 text-teal-lighter hover:text-white mr-4">
                            <i class="fa fa-cutlery"></i>
                            Users
                        </a>

                        <a @click=""
                           class=" text-2xl no-underline block mt-4 sm:inline-block sm:mt-0 text-teal-lighter hover:text-white mr-4">
                            <i class="fa fa-users text-blue-400 "></i>
                            My Events
                        </a>

                        <a @click=""
                           class=" text-2xl no-underline block mt-4 sm:inline-block sm:mt-0 text-teal-lighter hover:text-white mr-4">
                            <i class="mdi mdi-home text-blue-400 "></i>
                            All Events
                        </a>

{{--                        <a class="nav-item dropdown">--}}
{{--                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"--}}
{{--                               data-toggle="dropdown"--}}
{{--                               aria-haspopup="true" aria-expanded="false" v-pre>--}}
{{--                                {{ Auth::user()->email }} <span class="caret"></span>--}}
{{--                            </a>--}}


{{--                        </a>--}}


                            <a  href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                Logout
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>



                    </div>

            </nav>
        </div>


        {{--        <ul>--}}
        {{--            <li class="nav-item dropdown">--}}
        {{--                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"--}}
        {{--                   aria-haspopup="true" aria-expanded="false" v-pre>--}}
        {{--                    {{ Auth::user()->email }} <span class="caret"></span>--}}
        {{--                </a>--}}

        {{--
        {{--            </li>--}}
        {{--        </ul>--}}

    </nav-bar>


    <main class="py-4">
        @yield('content')
    </main>
</div>
</body>
</html>
