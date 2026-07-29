<!doctype html>
<html lang="en">

<head>
    <title>Heoo School System - Parent Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .role-icon {
            font-size: 50px;
            margin-bottom: 15px;
            transition: all 0.2s ease;
            color: #a0c334;
            display: flex;
            justify-content: center;
        }
        .login-header {
            text-align: center;
            margin-bottom: 30px;
        }
        .login-title {
            margin-top: 10px;
        }
        body, html {
            height: 100%;
        }
        .ftco-section {
            display: flex;
            align-items: center;
            min-height: 100vh;
            padding-top: 60px;
            padding-bottom: 60px;
        }
        .login-wrap {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            position: relative;
            top: 0;
        }
    </style>
    <link rel="stylesheet" href="{{ URL::asset('assets/css/login/style.css') }}">

</head>

<body>
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-md-7 col-lg-5">
                    <div class="login-wrap p-4 p-md-5">
                        <div class="login-header">
                            <div class="role-icon">
                                <i class="fas fa-people-roof"></i>
                            </div>
                            <div class="w-100">
                                <h3 class="login-title mb-4" style="font-weight: 700;">Parent Login</h3>
                            </div>
                        </div>

                        <!-- Session Status -->
                        <x-auth-session-status class="mb-4" :status="session('status')" />

                        <form method="POST" action="{{ route('login') }}" class="login-form">
                            @csrf

                            <!-- Parent Email -->
                            <div class="form-group">
                                <div class="icon d-flex align-items-center justify-content-center">
                                    <span class="fas fa-people-roof"></span>
                                </div>
                                <input id="Parent_id" type="text" class="form-control rounded-left" name="email"
                                    :value="old('email')" placeholder="Parent Email" required autofocus
                                    autocomplete="username">
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>

                            <!-- Password -->
                            <div class="form-group">
                                <div class="icon d-flex align-items-center justify-content-center">
                                    <span class="fa fa-lock" ></span>
                                </div>
                                <input id="password" type="password" class="form-control rounded-left" name="password"
                                    placeholder="Password" required autocomplete="current-password">
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>

                            <!-- Login Button -->
                            <div class="form-group d-flex align-items-center">
                                <div class="w-100 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary rounded submit">
                                        {{ __('Log in') }}
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