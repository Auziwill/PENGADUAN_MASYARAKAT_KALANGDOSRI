<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Kata Sandi - Pengaduan Masyarakat Kota Cimahi</title>
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
                /* For forgot password, the gradient side can be on the left to match login/register if form is on right */
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
        
        .back-link {
            display: block;
            margin-top: 10px;
            color: #6c757d !important;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .back-link:hover {
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
                            {{-- This column contains the form (left side for consistency with register) --}}
                            <div class="col-lg-6">
                                <div class="card-body p-md-5 mx-md-4">
                                    <div class="text-center">
                                        <img src="{{ asset('images/logo_citra.png') }}" class="img-fluid" alt="Lambang Kota Cimahi">
                                        <h4 class="mt-1 mb-5 pb-1">Lupa Kata Sandi?</h4>
                                    </div>

                                    {{-- Menampilkan pesan sukses dari session (misal: "Link reset password telah dikirim!") --}}
                                    @if (session('status'))
                                        <div class="notification is-success">
                                            <i class="fas fa-check-circle"></i>
                                            <span class="block sm:inline">{{ session('status') }}</span>
                                        </div>
                                    @endif

                                    {{-- Menampilkan pesan error validasi --}}
                                    @if ($errors->any())
                                        <div class="notification is-danger">
                                            <ul class="list-unstyled mb-0">
                                                @foreach ($errors->all() as $error)
                                                    <li><i class="fas fa-exclamation-circle me-2"></i>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    <form method="POST" action="{{ route('password.email') }}">
                                        @csrf
                                        <p>Masukkan alamat email Anda yang terdaftar untuk mendapatkan link reset kata sandi.</p>

                                        {{-- Email --}}
                                        <div class="form-outline mb-4">
                                            <input type="email" id="email" name="email"
                                                   class="form-control @error('email') is-invalid @enderror"
                                                   placeholder="Alamat Email" value="{{ old('email') }}" required autofocus>
                                            <label class="form-label" for="email">Alamat Email</label>
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        {{-- Tombol Kirim Link Reset --}}
                                        <div class="text-center pt-1 mb-5 pb-1">
                                            <button type="submit" class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3">
                                                <i class="fas fa-envelope-open-text me-2"></i>Kirim Link Reset Kata Sandi
                                            </button>
                                            <a class="text-muted back-link" href="{{ route('login') }}">
                                                <i class="fas fa-arrow-left me-1"></i>Kembali ke Login
                                            </a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            {{-- This column contains the gradient background and explanatory text (right side) --}}
                            <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
                                <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                                    <h4 class="mb-4">Perbarui Keamanan Akun Anda</h4>
                                    <p class="small mb-0">Jika Anda lupa kata sandi, jangan khawatir. Kami akan membantu Anda mengembalikan akses ke akun Anda dengan mudah dan aman.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>