<!doctype html>
<html lang="en">

<head>
    <title>Heoo School System - Register</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="{{ URL::asset('assets/css/login/style.css') }}">

    <style>
        /* Custom styles for responsive two-column layout */
        .two-column-form .form-group {
            margin-bottom: 1.5rem;
        }
        .two-column-form .form-group .icon {
            height: 50px;
        }
        @media (max-width: 767.98px) {
            .two-column-form .col-md-6 {
                margin-bottom: 1rem;
            }
        }
    </style>

</head>

<body>
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 text-center mb-5">
                    <h2 class="heading-section">Register</h2>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-10 col-lg-8">
                    <div class="login-wrap p-4 p-md-5">
                        <div class="d-flex">
                            <div class="w-100">
                                <h3 class="mb-4">Create Account</h3>
                            </div>
                            <div class="w-100">
                                <p class="social-media d-flex justify-content-end">
                                    <a href="#"
                                        class="social-icon d-flex align-items-center justify-content-center"><span
                                            class="fa fa-facebook"></span></a>
                                    <a href="#"
                                        class="social-icon d-flex align-items-center justify-content-center"><span
                                            class="fa fa-twitter"></span></a>
                                </p>
                            </div>
                        </div>
                        
                        <!-- Session Status -->
                        <x-auth-session-status class="mb-4" :status="session('status')" />

                        <form method="POST" action="{{ route('register') }}" class="login-form two-column-form">
                            @csrf

                            <div class="row">
                                <!-- Name -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="icon d-flex align-items-center justify-content-center">
                                            <span class="fa fa-user"></span>
                                        </div>
                                        <input id="name" type="text" class="form-control rounded-left" 
                                               name="name" :value="old('name')" placeholder="Full Name" 
                                               required autofocus autocomplete="name">
                                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                    </div>
                                </div>

                                <!-- Email Address -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="icon d-flex align-items-center justify-content-center">
                                            <span class="fa fa-envelope"></span>
                                        </div>
                                        <input id="email" type="email" class="form-control rounded-left" 
                                               name="email" :value="old('email')" placeholder="Email" 
                                               required autocomplete="username">
                                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <!-- Password -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="icon d-flex align-items-center justify-content-center">
                                            <span class="fa fa-lock"></span>
                                        </div>
                                        <input id="password" type="password" class="form-control rounded-left" 
                                               name="password" placeholder="Password" 
                                               required autocomplete="new-password">
                                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                    </div>
                                </div>

                                <!-- Confirm Password -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="icon d-flex align-items-center justify-content-center">
                                            <span class="fa fa-lock"></span>
                                        </div>
                                        <input id="password_confirmation" type="password" class="form-control rounded-left" 
                                               name="password_confirmation" placeholder="Confirm Password" 
                                               required autocomplete="new-password">
                                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                                    </div>
                                </div>
                            </div>

                            <div class="form-group d-flex align-items-center mt-4">
                                <div class="w-100">
                                    <p class="text-center mb-0">
                                        {{ __('Already registered?') }}
                                        <a href="{{ route('login') }}" class="text-primary">
                                            {{ __('Login here') }}
                                        </a>
                                    </p>
                                </div>
                            </div>

                            <div class="form-group d-flex align-items-center">
                                <div class="w-100 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary rounded submit">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="{{ URL::asset('assets/js/login/jquery.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/login/popper.js') }}"></script>
    <script src="{{ URL::asset('assets/js/login/bootstrap.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/login/main.js') }}"></script>

</body>

</html>