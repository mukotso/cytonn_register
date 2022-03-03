<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Cytonn-register') }}</title>

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
    <nav-bar :user="{{Auth::user()}}" inline-template v-cloak>
        <div class="font-sans antialiased">
            <nav class="flex items-center justify-between flex-wrap p-6">
                <div class="flex items-center flex-no-shrink  mr-6">
                    <span class="font-bold text-2xl tracking-tight">CYTONN REGISTER</span>
                </div>
                <div class="block sm:hidden">
                    <button @click="toggle"
                            class="flex items-center px-3 py-2 border rounded text-teal-lighter border-teal-light hover:text-white hover:border-white">
                      <i class="fa fa-bars"></i>
                    </button>
                </div>
                <div :class="open ? 'block': 'hidden'" class="w-full flex-grow sm:flex sm:items-center sm:w-auto">
                    <div class="text-sm sm:flex-grow">

                    </div>

                    <a href="/home"
                       class=" text-2xl no-underline block mt-4 sm:inline-block sm:mt-0 text-teal-lighter hover:text-white mr-4">
                        <span class="fa fa-home"></span>
                        Home
                    </a>

                    @if(Auth()->user()->is_admin==1)
                        <a href="/departments"
                           class=" text-2xl no-underline block mt-4 sm:inline-block sm:mt-0 text-teal-lighter hover:text-white mr-4">
                            <i class="fa fa-building text-blue-400 "></i>
                            Departments
                        </a>
                    @endif

                    <a href="/categories"
                       class=" text-2xl no-underline block mt-4 sm:inline-block sm:mt-0 text-teal-lighter hover:text-white mr-4">
                        <i class="fa fa-list-alt"></i>
                        Categories
                    </a>

                    @if(Auth()->user()->is_admin==1)
                        <a href="/users"
                           class=" text-2xl no-underline block mt-4 sm:inline-block sm:mt-0 text-teal-lighter hover:text-white mr-4">
                            <i class="fa fa-users"></i>
                            Users
                        </a>
                    @endif

                    <a href="/events"
                       class=" text-2xl no-underline block mt-4 sm:inline-block sm:mt-0 text-teal-lighter hover:text-white mr-4">
                        <i class="fa fa-calendar"></i>
                        Events
                    </a>

                    <a href="/profile"
                       class=" text-2xl no-underline block mt-4 sm:inline-block sm:mt-0 text-teal-lighter hover:text-white mr-4">
                        <i class="fa fa-user "></i>
                        Profile
                    </a>
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                       document.getElementById('logout-form').submit();">
                        <i class="fa fa-sign-out"></i>
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
