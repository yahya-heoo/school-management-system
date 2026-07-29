<!doctype html>
<html lang="en">

<head>
    <title>Heoo School System - Forgot Password</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="{{ URL::asset('assets/css/login/style.css') }}">

</head>

<body>
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 text-center mb-5">
                    <h2 class="heading-section">Forgot Password</h2>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-7 col-lg-5">
                    <div class="login-wrap p-4 p-md-5">
                        <div class="d-flex">
                            <div class="w-100">
                                <h3 class="mb-4">Reset Password</h3>
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

                        <form method="POST" action="{{ route('password.email') }}" class="login-form">
                            @csrf
                            <p class="text-center mb-4">Enter your email address and we'll send you a link to reset your
                                password.</p>

                            <!-- Email Address -->
                            <div class="form-group">
                                <div class="icon d-flex align-items-center justify-content-center">
                                    <span class="fa fa-envelope"></span>
                                </div>
                                <input id="email" type="email" class="form-control rounded-left" name="email"
                                    :value="old('email')" placeholder="Email" required autofocus>
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>

                            <div class="form-group d-flex align-items-center mt-4">
                                <div class="w-100 d-flex justify-content-between">
                                    <a href="{{ route('login') }}" class="btn btn-secondary rounded">
                                        <i class="fa fa-arrow-left mr-2"></i>{{ __('Back to Login') }}
                                    </a>
                                    <button type="submit" class="btn btn-primary rounded submit">
                                        {{ __('Send Reset Link') }}
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
