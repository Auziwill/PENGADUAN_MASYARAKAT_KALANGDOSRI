    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Reset Kata Sandi - Pengaduan Masyarakat</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
        <!-- Sertakan gaya kustom Anda jika diperlukan -->
    </head>
    <body>
        <section class="section">
            <div class="container">
                <div class="columns is-centered">
                    <div class="column is-5-tablet is-4-desktop">
                        <div class="box">
                            <h1 class="title has-text-centered">Reset Kata Sandi</h1>
                            <form method="POST" action="{{ route('password.update') }}">
                                @csrf
                                <input type="hidden" name="token" value="{{ $token }}">
                                <div class="field">
                                    <label class="label">Email</label>
                                    <div class="control">
                                        <input class="input" type="email" name="email" value="{{ $email ?? old('email') }}" required autofocus>
                                    </div>
                                    @error('email')
                                        <p class="help is-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="field">
                                    <label class="label">Kata Sandi Baru</label>
                                    <div class="control">
                                        <input class="input" type="password" name="password" required>
                                    </div>
                                    @error('password')
                                        <p class="help is-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="field">
                                    <label class="label">Konfirmasi Kata Sandi Baru</label>
                                    <div class="control">
                                        <input class="input" type="password" name="password_confirmation" required>
                                    </div>
                                </div>
                                <div class="field">
                                    <div class="control">
                                        <button type="submit" class="button is-primary is-fullwidth">Reset Kata Sandi</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </body>
    </html>
    