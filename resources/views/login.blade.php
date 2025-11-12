<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Pengaduan Masyarakat Kota Cimahi</title>
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
                border-top-right-radius: .3rem;
                border-bottom-right-radius: .3rem;
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

        .form-outline .form-label {
            font-weight: 600;
        }

        .btn-primary.btn-block {
            padding: 0.75rem 1.5rem;
            font-size: 1.1rem;
            font-weight: 600;
            border-radius: 0.5rem;
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

        .forgot-password-link {
            display: block;
            margin-top: 10px;
            color: #6c757d !important;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .forgot-password-link:hover {
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
                            <div class="col-lg-6">
                                <div class="card-body p-md-5 mx-md-4">
                                    <div class="text-center">
                                        <img src="{{ asset('images/logo_city.png') }}" class="img-fluid"
                                             alt="Lambang Kota Cimahi">
                                        <h4 class="mt-1 mb-5 pb-1">Sistem Pengaduan Masyarakat Kecamatan Cimahi Utara</h4>
                                    </div>

                                    @if(session('error'))
                                        <div class="notification is-danger">
                                            <i class="fas fa-exclamation-triangle"></i>
                                            {{ session('error') }}
                                        </div>
                                    @endif

                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf
                                        <p>Silakan masuk ke akun Anda</p>

                                        <div class="form-outline mb-4">
                                            <input type="email" id="email" name="email" class="form-control"
                                                   placeholder="Alamat Email" required />
                                            <label class="form-label" for="email">Email</label>
                                        </div>

                                        <div class="form-outline mb-4 password-container">
                                            <input type="password" id="password" name="password" class="form-control"
                                                   placeholder="Kata Sandi" required />
                                            <label class="form-label" for="password">Kata Sandi</label>
                                            <span toggle="#password" class="fa fa-fw fa-eye field-icon password-toggle"></span>
                                        </div>

                                        <div class="text-center pt-1 mb-5 pb-1">
                                            <button type="submit" class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3">Masuk</button>
                                            <a class="text-muted forgot-password-link" href="{{ route('password.request') }}">Lupa Kata Sandi?</a>
                                        </div>

                                        <div class="d-flex align-items-center justify-content-center pb-4">
                                            <p class="mb-0 me-2">Belum punya akun?</p>
                                            <a href="{{ route('register') }}" type="button" class="btn btn-outline-danger">
                                                <i class="fas fa-sign-in-alt me-1"></i>Mendaftar
                                            </a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
                                <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                                    <h4 class="mb-4">Untuk Pelayanan Publik yang Lebih Baik di Kecamatan Cimahi Utara</h4>
                                    <p class="small mb-0">Sampaikan aspirasi dan keluhan Anda terkait pelayanan publik di Kota Cimahi. Setiap laporan yang Anda berikan akan membantu mewujudkan pemerintahan yang transparan dan responsif.</p>
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
    </script>
</body>
</html>
