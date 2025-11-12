<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - Pengaduan Masyarakat Kota Cimahi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a2e0e6cfd7.js" crossorigin="anonymous"></script>
    <style>
        body {
            background-color: #eee;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .gradient-custom-2 {
            /* fallback for old browsers */
            background: #4169E1; /* Royal Blue as a fallback */

            /* Chrome 10-25, Safari 5.1-6 */
            background: -webkit-linear-gradient(to right, #4169E1, #00BFFF); /* Royal Blue to Deep Sky Blue */

            /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
            background: linear-gradient(to right, #4169E1, #00BFFF); /* Royal Blue to Deep Sky Blue */
        }

        @media (min-width: 768px) {
            .gradient-form {
                height: 100vh !important;
            }
        }
        @media (min-width: 769px) {
            .gradient-custom-2 {
                border-top-left-radius: .3rem;
                border-bottom-left-radius: .3rem;
            }
        }

        .card {
            border-radius: 1rem;
        }

        .card-body {
            padding: 2.5rem;
        }

        .text-center img {
            width: 185px; /* Sesuaikan ukuran jika diperlukan */
            height: auto;
            display: block;
            margin: 0 auto 1rem;
        }

        .form-outline .form-control {
            padding: 0.75rem 1rem;
            font-size: 1rem;
        }
        
        /* Tambahan styling untuk password toggle */
        .password-container {
            position: relative;
        }
        .password-toggle {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #6c757d;
        }

        .form-outline .form-label {
            font-weight: 600;
        }

        .btn-primary.btn-block {
            padding: 0.75rem 1.5rem;
            font-size: 1.1rem;
            font-weight: 600;
            border-radius: 0.5rem;
        }

        .notification {
            border-radius: 0.5rem;
            margin-bottom: 1rem;
            padding: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .notification.is-danger {
            background-color: #fce2e2;
            color: #9b2c2c;
            border: 1px solid #dc3545;
        }

        .notification.is-success {
            background-color: #e8f5e8;
            color: #2d7d2d;
            border: 1px solid #28a745;
        }

        .password-requirements {
            font-size: 0.875rem;
            color: #6c757d;
            margin-top: 0.25rem;
        }

        .password-requirements ul {
            margin: 0;
            padding-left: 1.2rem;
        }

        .password-requirements li {
            margin-bottom: 0.2rem;
        }

        .password-requirements li.valid {
            color: #28a745;
        }

        .password-requirements li.invalid {
            color: #dc3545;
        }

        .form-control.is-invalid {
            border-color: #dc3545;
        }

        .form-control.is-valid {
            border-color: #28a745;
        }

        .invalid-feedback {
            display: block;
            font-size: 0.875rem;
            color: #dc3545;
            margin-top: 0.25rem;
        }

        .back-to-login {
            display: block;
            margin-top: 10px;
            color: #6c757d !important;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .back-to-login:hover {
            color: #0056b3 !important;
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <section class="h-100 gradient-form">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-xl-10">
                    <div class="card rounded-3 text-black">
                        <div class="row g-0">
                            <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
                                <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                                    <h4 class="mb-4">Bergabung dengan Sistem Pengaduan Masyarakat</h4>
                                    <p class="small mb-0">Daftarkan diri Anda untuk dapat menyampaikan aspirasi dan keluhan terkait pelayanan publik di Kecamatan Cimahi Utara. Bersama-sama kita wujudkan pemerintahan yang transparan dan responsif.</p>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="card-body p-md-5 mx-md-4">
                                    <div class="text-center">
                                        <img src="{{ asset('images/logo_city.png') }}" class="img-fluid"
                                            alt="Lambang Kota Cimahi">
                                        <h4 class="mt-1 mb-5 pb-1">Buat Akun Baru</h4>
                                    </div>

                                    @if(session('error'))
                                        <div class="notification is-danger">
                                            <i class="fas fa-exclamation-triangle"></i>
                                            {{ session('error') }}
                                        </div>
                                    @endif

                                    @if(session('success'))
                                        <div class="notification is-success">
                                            <i class="fas fa-check-circle"></i>
                                            {{ session('success') }}
                                        </div>
                                    @endif

                                    <form method="POST" action="{{ route('register') }}" id="registerForm">
                                        @csrf
                                        <p>Silakan isi data berikut untuk membuat akun</p>

                                        <div class="form-outline mb-4">
                                            <input type="text" id="nama" name="nama" class="form-control @error('nama') is-invalid @enderror"
                                                placeholder="Nama Lengkap" value="{{ old('nama') }}" required />
                                            <label class="form-label" for="nama">Nama Lengkap</label>
                                            @error('nama')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-outline mb-4">
                                            <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                                placeholder="Alamat Email" value="{{ old('email') }}" required />
                                            <label class="form-label" for="email">Email</label>
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-outline mb-4 password-container">
                                            <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror"
                                                placeholder="Kata Sandi" required />
                                            <label class="form-label" for="password">Kata Sandi</label>
                                            <span toggle="#password" class="fa fa-fw fa-eye field-icon password-toggle"></span>
                                            <div class="password-requirements">
                                                <ul>
                                                    <li id="length-check">Minimal 8 karakter</li>
                                                    <li id="uppercase-check">Minimal 1 huruf besar</li>
                                                    <li id="lowercase-check">Minimal 1 huruf kecil</li>
                                                    <li id="number-check">Minimal 1 angka</li>
                                                    <li id="special-char-check">Minimal 1 karakter khusus (misal: _@$!%*#?&)</li>
                                                </ul>
                                            </div>
                                            @error('password')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-outline mb-4 password-container">
                                            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control"
                                                placeholder="Konfirmasi Kata Sandi" required />
                                            <label class="form-label" for="password_confirmation">Konfirmasi Kata Sandi</label>
                                            <span toggle="#password_confirmation" class="fa fa-fw fa-eye field-icon password-toggle"></span>
                                            <div id="password-match-feedback" class="invalid-feedback" style="display: none;">
                                                Kata sandi tidak cocok
                                            </div>
                                        </div>

                                        <input type="hidden" name="role" value="masyarakat" />

                                        <div class="text-center pt-1 mb-5 pb-1">
                                            <button type="submit" class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" id="submitBtn">
                                                <i class="fas fa-user-plus me-2"></i>Daftar
                                            </button>
                                            <a class="text-muted back-to-login" href="{{ route('login') }}">
                                                <i class="fas fa-arrow-left me-1"></i>Kembali ke Login
                                            </a>
                                        </div>

                                        <div class="d-flex align-items-center justify-content-center pb-4">
                                            <p class="mb-0 me-2">Sudah punya akun?</p>
                                            <a href="{{ route('login') }}" type="button" class="btn btn-outline-danger"> {{-- Changed btn-outline-primary to btn-outline-danger --}}
                                                <i class="fas fa-sign-in-alt me-1"></i>Masuk
                                            </a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const passwordInput = document.getElementById('password');
            const passwordConfirmInput = document.getElementById('password_confirmation');
            const submitBtn = document.getElementById('submitBtn');
            const form = document.getElementById('registerForm');

            // Password toggle functionality
            document.querySelectorAll('.password-toggle').forEach(toggle => {
                toggle.addEventListener('click', function() {
                    const target = document.querySelector(this.getAttribute('toggle'));
                    const icon = this;
                    if (target.getAttribute('type') === 'password') {
                        target.setAttribute('type', 'text');
                        icon.classList.remove('fa-eye');
                        icon.classList.add('fa-eye-slash');
                    } else {
                        target.setAttribute('type', 'password');
                        icon.classList.remove('fa-eye-slash');
                        icon.classList.add('fa-eye');
                    }
                });
            });

            // Password validation checks
            const checks = {
                length: document.getElementById('length-check'),
                uppercase: document.getElementById('uppercase-check'),
                lowercase: document.getElementById('lowercase-check'),
                number: document.getElementById('number-check'),
                specialChar: document.getElementById('special-char-check')
            };

            function validatePassword() {
                const password = passwordInput.value;
                const requirements = {
                    length: password.length >= 8,
                    uppercase: /[A-Z]/.test(password),
                    lowercase: /[a-z]/.test(password),
                    number: /\d/.test(password),
                    specialChar: /[_@$!%*#?&]/.test(password)
                };

                Object.keys(requirements).forEach(key => {
                    if (requirements[key]) {
                        checks[key].classList.add('valid');
                        checks[key].classList.remove('invalid');
                    } else {
                        checks[key].classList.add('invalid');
                        checks[key].classList.remove('valid');
                    }
                });

                return Object.values(requirements).every(req => req);
            }

            function checkPasswordMatch() {
                const password = passwordInput.value;
                const confirmPassword = passwordConfirmInput.value;
                const matchFeedback = document.getElementById('password-match-feedback');

                // Only show feedback if confirmPassword has content or if password is not empty
                if (confirmPassword || password) {
                    if (password !== confirmPassword) {
                        passwordConfirmInput.classList.add('is-invalid');
                        matchFeedback.style.display = 'block';
                        return false;
                    } else {
                        passwordConfirmInput.classList.remove('is-invalid');
                        // Add is-valid only if both fields have content and match
                        if (password && confirmPassword) {
                            passwordConfirmInput.classList.add('is-valid');
                        } else {
                            passwordConfirmInput.classList.remove('is-valid');
                        }
                        matchFeedback.style.display = 'none';
                        return true;
                    }
                } else {
                    // If both are empty, remove validation states
                    passwordConfirmInput.classList.remove('is-invalid', 'is-valid');
                    matchFeedback.style.display = 'none';
                    return true; // Consider empty as valid for initial state
                }
            }


            function updateSubmitButton() {
                // Ensure native form validation passes for all required fields first
                // This checks 'nama', 'email', 'password', 'password_confirmation' for 'required' attribute
                const isFormNativeValid = form.checkValidity();

                const isPasswordValid = validatePassword();
                const isPasswordMatch = checkPasswordMatch();

                // The submit button is enabled only if all native form validations pass,
                // AND password meets all requirements, AND passwords match.
                submitBtn.disabled = !(isFormNativeValid && isPasswordValid && isPasswordMatch);
            }

            passwordInput.addEventListener('input', function() {
                validatePassword();
                checkPasswordMatch(); // Re-check match when password changes
                updateSubmitButton();
            });

            passwordConfirmInput.addEventListener('input', function() {
                checkPasswordMatch();
                updateSubmitButton();
            });

            // Add event listeners to other input fields to ensure submit button updates
            // when other required fields are filled/emptied.
            document.getElementById('nama').addEventListener('input', updateSubmitButton);
            document.getElementById('email').addEventListener('input', updateSubmitButton);


            // Initial check on page load
            updateSubmitButton();
        });
    </script>
</body>
</html>
