<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pengguna Baru - Admin SIPADU</title>
    <!-- Bulma CSS CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <!-- Font Awesome for icons -->
    <script src="https://kit.fontawesome.com/a2e0e6cfd7.js" crossorigin="anonymous"></script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f0f2f5 0%, #e0e4eb 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 2rem;
        }
        .container-box {
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            padding: 2.5rem;
            width: 100%;
            max-width: 600px;
        }
        .button.is-primary {
            background-color: #3273dc;
            border-color: transparent;
            color: white;
            border-radius: 8px;
        }
        .button.is-primary:hover {
            background-color: #276cda;
        }
        .button.is-link {
            background-color: #48c78e;
            border-color: transparent;
            color: white;
            border-radius: 8px;
        }
        .button.is-link:hover {
            background-color: #3eb57f;
        }
        .input.is-danger, .textarea.is-danger, .select.is-danger select {
            border-color: #ff3860 !important;
        }
        .help.is-danger {
            color: #ff3860;
        }
    </style>
</head>
<body>
    <div class="container-box">
        <h1 class="title is-3 has-text-centered mb-5">Tambah Pengguna Baru</h1>

        <form action="{{ route('admin.users.store') }}" method="POST">
            @csrf

            <div class="field">
                <label class="label">Nama</label>
                <div class="control has-icons-left">
                    <input class="input @error('nama') is-danger @enderror" type="text" name="nama" value="{{ old('nama') }}" placeholder="Masukkan Nama Lengkap" required>
                    <span class="icon is-small is-left">
                        <i class="fas fa-user"></i>
                    </span>
                </div>
                @error('nama')
                    <p class="help is-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="field">
                <label class="label">Email</label>
                <div class="control has-icons-left">
                    <input class="input @error('email') is-danger @enderror" type="email" name="email" value="{{ old('email') }}" placeholder="Masukkan Email" required>
                    <span class="icon is-small is-left">
                        <i class="fas fa-envelope"></i>
                    </span>
                </div>
                @error('email')
                    <p class="help is-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="field">
                <label class="label">Password</label>
                <div class="control has-icons-left">
                    <input class="input @error('password') is-danger @enderror" type="password" name="password" placeholder="Masukkan Password" required>
                    <span class="icon is-small is-left">
                        <i class="fas fa-lock"></i>
                    </span>
                </div>
                @error('password')
                    <p class="help is-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="field">
                <label class="label">Konfirmasi Password</label>
                <div class="control has-icons-left">
                    <input class="input" type="password" name="password_confirmation" placeholder="Konfirmasi Password" required>
                    <span class="icon is-small is-left">
                        <i class="fas fa-lock"></i>
                    </span>
                </div>
            </div>

            <div class="field">
                <label class="label">Role</label>
                <div class="control">
                    <div class="select is-fullwidth @error('role') is-danger @enderror">
                        <select name="role" required>
                            <option value="">Pilih Role</option>
                            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="masyarakat" {{ old('role') == 'masyarakat' ? 'selected' : '' }}>Masyarakat</option>
                        </select>
                    </div>
                </div>
                @error('role')
                    <p class="help is-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="field is-grouped is-grouped-centered mt-5">
                <div class="control">
                    <button type="submit" class="button is-primary">
                        <span class="icon"><i class="fas fa-save"></i></span>
                        <span>Simpan Pengguna</span>
                    </button>
                </div>
                <div class="control">
                    <a href="{{ route('admin.dashboard') }}" class="button is-light">
                        <span class="icon"><i class="fas fa-times"></i></span>
                        <span>Batal</span>
                    </a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
