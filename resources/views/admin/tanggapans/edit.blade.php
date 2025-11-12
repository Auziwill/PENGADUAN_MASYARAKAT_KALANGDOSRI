<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Tanggapan - Admin SIPADU</title>
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
            max-width: 700px;
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
        .button.is-light {
            border-radius: 8px;
        }
        .textarea.is-danger, .select.is-danger select {
            border-color: #ff3860 !important;
        }
        .help.is-danger {
            color: #ff3860;
        }
    </style>
</head>
<body>
    <div class="container-box">
        <h1 class="title is-3 has-text-centered mb-5">Edit Tanggapan</h1>

        <form action="{{ route('admin.tanggapans.update', $tanggapan->id_tanggapan) }}" method="POST">
            @csrf
            @method('PUT') {{-- Use PUT method for update --}}

            <div class="field">
                <label class="label">Pilih Pengaduan</label>
                <div class="control">
                    <div class="select is-fullwidth @error('id_pengaduan') is-danger @enderror">
                        <select name="id_pengaduan" required>
                            <option value="">Pilih Pengaduan</option>
                            @foreach($pengaduans as $pengaduan)
                                <option value="{{ $pengaduan->id_pengaduan }}" 
                                    {{ old('id_pengaduan', $tanggapan->id_pengaduan) == $pengaduan->id_pengaduan ? 'selected' : '' }}>
                                    ID: {{ $pengaduan->id_pengaduan }} - {{ Str::limit($pengaduan->judul, 50) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                @error('id_pengaduan')
                    <p class="help is-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="field">
                <label class="label">Pilih Admin Penanggap</label>
                <div class="control">
                    <div class="select is-fullwidth @error('id_admin') is-danger @enderror">
                        <select name="id_admin" required>
                            <option value="">Pilih Admin</option>
                            @foreach($admins as $admin)
                                <option value="{{ $admin->id_user }}" 
                                    {{ old('id_admin', $tanggapan->id_admin) == $admin->id_user ? 'selected' : '' }}>
                                    {{ $admin->nama }} ({{ $admin->email }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                @error('id_admin')
                    <p class="help is-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="field">
                <label class="label">Isi Tanggapan</label>
                <div class="control">
                    <textarea class="textarea @error('isi_tanggapan') is-danger @enderror" name="isi_tanggapan" placeholder="Tulis tanggapan di sini..." rows="5" required>{{ old('isi_tanggapan', $tanggapan->isi_tanggapan) }}</textarea>
                </div>
                @error('isi_tanggapan')
                    <p class="help is-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="field is-grouped is-grouped-centered mt-5">
                <div class="control">
                    <button type="submit" class="button is-primary">
                        <span class="icon"><i class="fas fa-sync-alt"></i></span>
                        <span>Perbarui Tanggapan</span>
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
