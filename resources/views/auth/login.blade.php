@extends('layouts.defaultLayout')
@section('content')


                    <form id="loginForm" method="POST" action="{{ route('login') }}" class="container mx-auto">
                        <img  src="{{ url('/images/logo2.png') }} " alt="logo">
                        @csrf

                        <div>
                            <label for="email" >{{ __('E-Mail Address') }}</label>

                            <div>
                                <input id="email" type="email"  name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label for="password">{{ __('Password') }}</label>

                            <div>
                                <input id="password" type="password"  name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>




                                <div class="login-btn-div">
                                    <button type="submit" id="loginBtn">
                                        {{ __('Login') }}
                                    </button>
                                </div>

                    </form>



@endsection
