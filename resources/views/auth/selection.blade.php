<!doctype html>
<html lang="{{ app()->getLocale() }}" dir="{{ LaravelLocalization::getCurrentLocaleDirection() }}">

<head>
    <title>{{ __('selection_trans.login.title') }} - {{ __('Heoo School System') }}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ URL::asset('assets/css/login/style.css') }}">

    <style>
        .role-selection {
            margin-top: 15px;
        }

        .role-card {
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            padding: 12px 10px;
            margin-bottom: 12px;
            text-align: center;
            cursor: pointer;
            transition: all 0.2s ease;
            background: white;
            height: 100%;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        }

        .role-card:hover {
            border-color: #4e73df;
            transform: translateY(-2px);
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
        }

        .role-card.active {
            border-color: #4e73df;
            background: #f8f9fe;
            box-shadow: 0 0 0 2px rgba(78, 115, 223, 0.15);
        }

        .role-icon {
            font-size: 24px;
            margin-bottom: 8px;
            transition: all 0.2s ease;
        }

        /* Different colors for each role icon */
        .role-card[data-role="admin"] .role-icon {
            color: #dc3545;
        }

        .role-card[data-role="teacher"] .role-icon {
            color: #28a745;
        }

        .role-card[data-role="student"] .role-icon {
            color: #17a2b8;
        }

        .role-card[data-role="parent"] .role-icon {
            color: #ffc107;
        }

        .role-title {
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 3px;
            color: #333;
        }

        .role-arrow {
            font-size: 14px;
            color: #6c757d;
            opacity: 0;
            transition: all 0.2s ease;
        }

        .role-card:hover .role-arrow,
        .role-card.active .role-arrow {
            opacity: 1;
            color: #4e73df;
        }

        .btn-continue {
            background: #4e73df;
            border: none;
            color: white;
            padding: 8px 25px;
            font-size: 13px;
            border-radius: 4px;
            transition: all 0.3s ease;
        }

        .btn-continue:hover {
            transform: translateY(-2px);
        }

        .welcome-sidebar {
            display: flex;
            flex-direction: column;
            justify-content: center;
            height: 100%;
            padding-right: 40px;
        }

        .welcome-title {
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 15px;
            color: #333;
            line-height: 1.2;
        }

        .welcome-subtitle {
            font-size: 20px;
            color: #a0c334;
            font-weight: 600;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 2px solid #e9ecef;
        }

        .welcome-sidebar p {
            color: #666;
            font-size: 14px;
            margin-top: 15px;
            line-height: 1.5;
        }

        .login-wrap {
            min-height: 450px;
            display: flex;
            align-items: center;
            background: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        /* Language Switcher */
        .language-switcher {
            position: absolute;
            bottom: -50px;
            left: 20px;
        }

        .lang-btn {
            background: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 4px;
            padding: 5px 12px;
            font-size: 14px;
            color: #495057;
            transition: all 0.2s ease;
        }

        .lang-btn:hover {
            background: #e9ecef;
            border-color: #4e73df;
        }

        .lang-btn.active {
            background: #4e73df;
            color: white;
            border-color: #4e73df;
        }

        @media (max-width: 767.98px) {
            .welcome-sidebar {
                padding-right: 0;
                text-align: center;
                margin-bottom: 30px;
                height: auto;
            }

            .welcome-title {
                font-size: 28px;
            }

            .welcome-subtitle {
                font-size: 18px;
            }

            .login-wrap {
                min-height: auto;
            }

            .language-switcher {
                position: static;
                text-align: center;
                margin-bottom: 20px;
            }
        }
    </style>
</head>

<body>
    <section class="ftco-section">
        <div class="container">


            <div class="row justify-content-center">
                <div class="col-md-10 col-lg-9">
                    <div class="login-wrap p-4 p-md-5">

                        <div class="row align-items-center">

                            <!-- Left Side: Welcome Message -->
                            <div class="col-md-5">
                                <div class="welcome-sidebar">
                                    <h2 class="welcome-title">{{ __('selection_trans.welcome') }}</h2>
                                    <h4 class="welcome-subtitle">{{ __('selection_trans.select_role') }}</h4>
                                    <p>{{ __('selection_trans.role_description') }}</p>
                                    <!-- Language Switcher -->
                                    <div class="language-switcher">
                                        @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                            <a rel="alternate" hreflang="{{ $localeCode }}"
                                                href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}"
                                                class="lang-btn {{ app()->getLocale() == $localeCode ? 'active' : '' }}">
                                                {{ strtoupper($localeCode) }}
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>


                            <!-- Right Side: Role Cards -->
                            <div class="col-md-7">
                                <div class="role-selection">
                                    <form id="roleForm" action="{{ route('login') }}" method="GET">
                                        @csrf
                                        <input type="hidden" name="role" id="selectedRole">

                                        <div class="row">
                                            <!-- Admin -->
                                            <div class="col-md-6 mb-3">
                                                <div class="role-card" data-role="admin">
                                                    <div class="role-icon">
                                                        <i class="fas fa-user-cog"></i>
                                                    </div>
                                                    <div class="role-title">{{ __('selection_trans.roles.admin') }}
                                                    </div>
                                                    <div class="role-arrow">
                                                        <i class="fas fa-arrow-right"></i>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Teacher -->
                                            <div class="col-md-6 mb-3">
                                                <div class="role-card" data-role="teacher">
                                                    <div class="role-icon">
                                                        <i class="fas fa-chalkboard-teacher"></i>
                                                    </div>
                                                    <div class="role-title">{{ __('selection_trans.roles.teacher') }}
                                                    </div>
                                                    <div class="role-arrow">
                                                        <i class="fas fa-arrow-right"></i>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Student -->
                                            <div class="col-md-6 mb-3">
                                                <div class="role-card" data-role="student">
                                                    <div class="role-icon">
                                                        <i class="fas fa-user-graduate"></i>
                                                    </div>
                                                    <div class="role-title">{{ __('selection_trans.roles.student') }}
                                                    </div>
                                                    <div class="role-arrow">
                                                        <i class="fas fa-arrow-right"></i>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Parent -->
                                            <div class="col-md-6 mb-3">
                                                <div class="role-card" data-role="parent">
                                                    <div class="role-icon">
                                                        <i class="fas fa-people-roof"></i>
                                                    </div>
                                                    <div class="role-title">{{ __('selection_trans.roles.parent') }}
                                                    </div>
                                                    <div class="role-arrow">
                                                        <i class="fas fa-arrow-right"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group text-center mt-4">
                                            <button type="submit" id="continueBtn" class="btn btn-primary btn-continue"
                                                disabled>
                                                {{ __('selection_trans.buttons.continue') }} <i
                                                    class="fas fa-arrow-right ml-1"></i>
                                            </button>
                                        </div>
                                    </form>

                                    <div class="text-center mt-3">
                                        <p class="mb-0" style="font-size: 13px; color: #6c757d;">
                                            {{ __('selection_trans.login.no_account') }}
                                            <a href="{{ LaravelLocalization::localizeUrl(route('register')) }}"
                                                class="text-primary">
                                                {{ __('selection_trans.login.register_here') }}
                                            </a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="{{ URL::asset('assets/js/login/jquery.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            let selectedRole = null;

            // Role selection
            $('.role-card').click(function() {
                $('.role-card').removeClass('active');
                $(this).addClass('active');
                selectedRole = $(this).data('role');
                $('#selectedRole').val(selectedRole);
                $('#continueBtn').prop('disabled', false);

                // Add role parameter to URL for localization
                const loginUrl = "{{ route('login') }}";
                $('#roleForm').attr('action', loginUrl + '?role=' + selectedRole);
            });

            // Handle form submission
            $('#roleForm').submit(function(e) {
                if (!selectedRole) {
                    e.preventDefault();
                    alert('{{ __('Please select a role first!') }}');
                    return false;
                }
                // Store role in sessionStorage
                sessionStorage.setItem('selectedRole', selectedRole);
                // Add role as query parameter
                $(this).attr('action', $(this).attr('action') + '?role=' + selectedRole);
            });


            // Add hover effects
            $('.role-card').hover(
                function() {
                    if (!$(this).hasClass('active')) {
                        $(this).css('transform', 'translateY(-2px)');
                    }
                },
                function() {
                    if (!$(this).hasClass('active')) {
                        $(this).css('transform', 'translateY(0)');
                    }
                }
            );

            // Enter key support
            $(document).keypress(function(e) {
                if (e.which === 13 && selectedRole) {
                    $('#roleForm').submit();
                }
            });

            // Restore previous selection
            const previousRole = sessionStorage.getItem('selectedRole');
            if (previousRole) {
                $(`.role-card[data-role="${previousRole}"]`).click();
            }
        });
    </script>
</body>

</html>
