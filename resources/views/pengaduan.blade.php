<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dasbor Pelayanan Pengaduan - Pemerintah Daerah</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <script src="https://kit.fontawesome.com/a2e0e6cfd7.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Roboto+Serif:wght@500;600;700&display=swap" rel="stylesheet">
    <style>
        /* Variabel yang disesuaikan untuk konsistensi dengan Dashboard Admin */
        :root {
            --primary-color: #2c5282; /* Deeper, rich blue */
            --primary-hover: #224269; /* Even darker for hover */
            --primary-light: #e6f0fa; /* Very light blue for subtle accents */
            --success-color: #2f855a; /* Muted, professional green */
            --danger-color: #c53030; /* Authoritative red */
            --info-color: #3182ce; /* Clear, reliable info blue */

            --background-body: #f9fafb; /* Off-white for clean background, consistent with admin main-content */
            --gradient-background: linear-gradient(135deg, #2c5282, #1e3a5f); /* Primary gradient for body background */
            --card-bg: rgba(255, 255, 255, 0.98); /* Near-white background for cards */
            --border-color: #e2e8f0; /* Consistent light grey border */
            --card-shadow: 0 4px 12px rgba(0, 0, 0, 0.06); /* Subtle, soft shadow for cards */
            --card-shadow-hover: 0 8px 20px rgba(0, 0, 0, 0.1); /* Enhanced on hover */
            --heading-color: #1a202c; /* Very dark grey for headings */
            --text-color: #4a5568; /* Standard body text color */
        }

        body {
            background: var(--gradient-background); /* Body takes the primary gradient */
            min-height: 100vh;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif; /* Consistent font */
            color: var(--text-color);
            line-height: 1.7;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        .main-container {
            padding: 2.5rem 0; /* Consistent padding */
            min-height: 100vh;
        }

        .dashboard-header, .form-container, .history-container {
            background: var(--card-bg);
            backdrop-filter: blur(10px);
            border-radius: 14px; /* Consistent border-radius with admin cards */
            padding: 2.5rem; /* Consistent padding */
            margin-bottom: 2.5rem; /* Consistent margin */
            box-shadow: var(--card-shadow); /* Consistent shadow */
            border: 1px solid var(--border-color); /* Consistent border */
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out; /* Smoother transitions */
            position: relative;
            overflow: hidden; /* Ensures inner elements respect border-radius */
        }

        .dashboard-header:hover, .form-container:hover, .history-container:hover {
            transform: translateY(-5px); /* More noticeable lift on hover */
            box-shadow: var(--card-shadow-hover);
        }

        .dashboard-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px; /* Thicker top border */
            background: linear-gradient(90deg, var(--primary-color), var(--info-color)); /* More vibrant gradient */
            border-top-left-radius: 14px; /* Consistent with card border-radius */
            border-top-right-radius: 14px; /* Consistent with card border-radius */
        }

        .welcome-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1.5rem;
        }

        .welcome-text h1 {
            font-family: 'Roboto Serif', serif; /* Consistent formal font */
            font-size: 2.4rem; /* Larger and bolder title */
            font-weight: 700;
            color: var(--heading-color); /* Consistent heading color */
            margin-bottom: 0.75rem; /* Consistent margin */
            line-height: 1.2;
        }

        .welcome-text .subtitle {
            color: var(--text-color); /* Consistent text color */
            font-size: 1rem;
        }

        .header-actions {
            display: flex;
            gap: 1rem;
            align-items: center;
            text-align: right; /* Ensure text is right-aligned */
            flex-shrink: 0; /* Prevent shrinking on smaller screens */
        }
        .header-actions p {
            color: var(--text-color);
            font-weight: 500;
            font-size: 0.95rem;
        }
        .header-actions p.has-text-grey {
            color: #64748b !important; /* Specific muted grey for time */
        }


        .notification {
            border-radius: 10px; /* Consistent border-radius */
            border-left: 5px solid; /* Thicker border */
            animation: slideIn 0.4s ease forwards;
            margin-bottom: 1.75rem;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
            padding: 1.25rem 1.5rem; /* More generous padding */
            display: flex;
            align-items: center;
            gap: 0.8rem; /* Space between icon and text */
        }
        .notification .delete {
            margin-left: auto;
            margin-right: -0.5rem;
            opacity: 0.8;
            transition: opacity 0.2s ease;
        }
        .notification .delete:hover {
            opacity: 1;
        }


        .notification.is-success {
            border-left-color: var(--success-color); /* Consistent success color */
            background: #e6ffed; /* Lighter success background */
            color: var(--success-color); /* Consistent success color */
        }
        .notification.is-info.is-light {
            background-color: #e0f2fe; /* Light blue consistent with admin info tags */
            color: #0c4a6e; /* Darker blue consistent with admin info tags */
            border-left-color: var(--info-color); /* Consistent info color */
        }


        @keyframes slideIn {
            from { opacity: 0; transform: translateY(-15px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .section-title {
            font-family: 'Roboto Serif', serif; /* Consistent formal font */
            font-size: 1.8rem; /* Slightly larger for main sections */
            font-weight: 700;
            margin-bottom: 1.8rem;
            color: var(--heading-color); /* Consistent heading color */
            position: relative;
            padding-bottom: 0.8rem;
            display: flex;
            align-items: center;
            gap: 0.8rem;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 70px; /* Wider underline */
            height: 4px;
            background: linear-gradient(90deg, var(--primary-color), var(--info-color)); /* Consistent gradient */
            border-radius: 2px;
        }

        .label {
            font-weight: 600;
            color: var(--heading-color); /* Consistent label color */
            margin-bottom: 0.6rem;
            display: flex;
            align-items: center;
            gap: 0.6rem;
            font-size: 0.95rem;
        }

        .input, .textarea {
            border-radius: 8px; /* Consistent border-radius */
            border: 1px solid var(--border-color); /* Consistent border color */
            padding: 0.8rem 1rem;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            background: #fff;
            box-shadow: inset 0 1px 2px rgba(0,0,0,0.05); /* Subtle inner shadow */
        }

        .input:focus, .textarea:focus {
            border-color: var(--primary-color); /* Focus color from primary */
            box-shadow: 0 0 0 0.125em rgba(44, 82, 130, 0.25); /* More subtle shadow */
            transform: translateY(-1px);
        }

        .file-input-container {
            border: 2px dashed var(--border-color); /* Consistent border style */
            border-radius: 10px;
            padding: 2rem;
            text-align: center;
            transition: all 0.3s ease;
            cursor: pointer;
            background: #fdfdfe; /* Slightly off-white background */
        }

        .file-input-container:hover {
            border-color: var(--primary-color); /* Consistent hover border color */
            background: rgba(44, 82, 130, 0.05); /* Lighter primary on hover */
        }

        .file-input-container.has-file {
            border-color: var(--success-color); /* Consistent success color */
            background: rgba(47, 133, 90, 0.08); /* Lighter success on file selected */
        }

        .button {
            border-radius: 8px; /* Consistent border-radius */
            font-weight: 600; /* Consistent font-weight */
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1); /* Consistent transition */
            border: none;
            padding: 0.9rem 1.8rem; /* More generous padding */
            font-size: 0.95rem; /* Slightly larger text */
        }

        .button.is-primary {
            background: var(--primary-color); /* Solid primary color */
            color: white;
            box-shadow: 0 5px 15px rgba(44, 82, 130, 0.3); /* Consistent shadow */
        }

        .button.is-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 7px 20px rgba(44, 82, 130, 0.4);
            background: var(--primary-hover); /* Darker primary on hover */
            opacity: 1; /* Ensure opacity remains 1 */
        }

        .button.is-danger {
            background: var(--danger-color); /* Solid danger color */
            color: white;
            box-shadow: 0 4px 15px rgba(197, 48, 48, 0.3); /* Consistent shadow */
        }

        .button.is-danger:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(197, 48, 48, 0.4);
            background: #a52626; /* Darker red on hover */
        }

        .button-reset-custom {
            background: #cbd5e1 !important; /* Muted grey from admin scrollbar */
            color: #475569 !important; /* Darker grey text */
            box-shadow: 0 3px 8px rgba(171, 187, 204, 0.2);
        }
        .button-reset-custom:hover {
            background: #94a3b8 !important; /* Darker grey on hover */
            color: white !important;
            transform: translateY(-2px);
            box-shadow: 6px 15px rgba(171, 187, 204, 0.3);
        }

        .complaint-card {
            background: #ffffff;
            border-radius: 14px; /* Consistent border-radius */
            padding: 2.2rem; /* More padding */
            margin-bottom: 1.8rem;
            border: 1px solid var(--border-color); /* Consistent border */
            box-shadow: var(--card-shadow); /* Consistent shadow */
            transition: all 0.35s ease-in-out; /* Smoother transition */
            position: relative;
            overflow: hidden;
        }

        .complaint-card:hover {
            transform: translateY(-5px); /* More noticeable lift */
            box-shadow: var(--card-shadow-hover);
        }

        .complaint-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px; /* Thicker top border */
            background: linear-gradient(90deg, var(--primary-color), var(--info-color)); /* Consistent gradient */
            border-top-left-radius: 14px;
            border-top-right-radius: 14px;
        }

        .complaint-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 1.2rem;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .complaint-title {
            font-family: 'Roboto Serif', serif; /* Consistent formal font */
            font-size: 1.55rem; /* Slightly larger title */
            font-weight: 600;
            color: var(--heading-color); /* Consistent heading color */
            margin: 0;
            flex: 1;
        }

        .status-badge {
            padding: 0.6rem 1.2rem;
            border-radius: 9999px; /* Pill shape */
            font-size: 0.8rem;
            font-weight: 700;
            text-transform: capitalize; /* Capitalize status */
            letter-spacing: 0.7px;
            border: 1px solid transparent;
            transition: all 0.2s ease;
        }
        .status-badge:hover {
            transform: translateY(-1px) scale(1.02);
        }

        .status-menunggu {
            background: #fefce8; /* Consistent light yellow */
            color: #a16207; /* Consistent dark orange-brown */
            border-color: #fde047;
        }

        .status-diproses {
            background: #e0f2fe; /* Consistent light blue */
            color: #0d619f; /* Consistent deeper blue */
            border-color: #93c5fd;
        }

        .status-selesai {
            background: #dcfce7; /* Consistent light green */
            color: #1a6d4b; /* Consistent deeper green */
            border-color: #bbf7d0;
        }

        .complaint-content {
            margin-bottom: 1.2rem;
            line-height: 1.7;
            color: var(--text-color); /* Consistent text color */
            font-size: 0.95rem;
        }
        .complaint-content p strong {
            color: var(--heading-color);
        }
        .complaint-content .has-text-grey-light {
            color: #cbd5e1 !important; /* Lighter grey for icons */
        }

        .complaint-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.85rem;
            color: #64748b; /* Consistent muted grey */
            margin-bottom: 1.2rem;
            flex-wrap: wrap;
            gap: 0.8rem;
        }
        .complaint-meta i {
            margin-right: 0.4em;
        }


        .complaint-image {
            max-width: 300px; /* Larger image preview */
            height: auto;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            cursor: zoom-in;
            object-fit: cover;
            border: 1px solid var(--border-color); /* Added border to image */
        }

        .complaint-image:hover {
            transform: scale(1.02);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        .empty-state {
            text-align: center;
            padding: 4rem;
            color: #9aa7b8; /* Consistent muted grey for empty state */
            background: #f8fbfd; /* Lighter background for empty state */
            border-radius: 14px;
            border: 1px dashed var(--border-color); /* Consistent dashed border */
            box-shadow: var(--card-shadow);
        }

        .empty-state i {
            font-size: 3.8rem; /* Larger icon */
            color: #cbd5e1; /* Consistent lighter icon color */
            margin-bottom: 1.5rem;
        }
        .empty-state h3 {
            font-family: 'Roboto Serif', serif; /* Consistent formal font */
            font-size: 1.6rem; /* Slightly larger heading */
            color: var(--heading-color);
            margin-bottom: 0.75rem;
        }
        .empty-state p {
            font-size: 1rem;
            line-height: 1.6;
            color: var(--text-color);
        }

        .logout-section {
            text-align: center;
            margin-top: 3.5rem; /* More space */
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .main-container {
                padding: 1.5rem 0.75rem;
            }

            .dashboard-header, .form-container, .history-container {
                padding: 1.5rem;
                margin-bottom: 1.5rem;
            }

            .welcome-section {
                flex-direction: column;
                text-align: center;
                gap: 1rem;
            }

            .welcome-text h1 {
                font-size: 2rem; /* Adjusted for smaller screens */
            }

            .header-actions {
                flex-direction: column;
                align-items: center;
            }

            .section-title {
                font-size: 1.6rem; /* Adjusted for smaller screens */
                text-align: center;
                justify-content: center;
            }
            .section-title::after {
                left: 50%;
                transform: translateX(-50%);
            }

            .complaint-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .complaint-meta {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.75rem;
            }
            .complaint-image {
                max-width: 100%;
            }

            /* Perubahan untuk menumpuk tombol di mode mobile */
            .field.is-grouped {
                flex-direction: column;
            }
            .field.is-grouped .control {
                width: 100%;
            }
            .field.is-grouped .button {
                width: 100%; /* Memastikan tombol mengisi lebar penuh */
            }
        }
        
        .field-group {
            display: flex;
            gap: 1rem;
        }

        .field-group .field {
            flex-grow: 1;
        }

        /* Loading animation */
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.6; }
        }

        .loading {
            animation: pulse 1.5s infinite;
        }

        /* Image modal */
        .image-modal {
            display: none;
            position: fixed;
            z-index: 9999; /* Higher z-index to be on top of everything */
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.88); /* Even darker overlay */
            backdrop-filter: blur(12px); /* Stronger blur */
            overflow: auto;
        }

        .image-modal-content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            max-width: 95%; /* Wider on larger screens */
            max-height: 95%;
            border-radius: 16px; /* Slightly more rounded for modal */
            box-shadow: 0 0 40px rgba(0, 0, 0, 0.8); /* Stronger shadow */
            display: block;
            object-fit: contain; /* Ensures image fits within bounds without cropping */
        }

        .image-modal .close {
            position: absolute;
            top: 30px; /* More space from top */
            right: 45px; /* More space from right */
            color: white;
            font-size: 3rem; /* Larger close icon */
            cursor: pointer;
            transition: color 0.3s ease;
            text-shadow: 0 0 8px rgba(0,0,0,0.5); /* Subtle shadow for close icon */
        }
        .image-modal .close:hover {
            color: #dcdcdc; /* Lighter on hover */
        }

        /* Tanggapan section styles */
        .tanggapan-section {
            border-top: 1px solid #ebf2f7; /* Lighter, more subtle border */
            padding-top: 2rem; /* More padding */
            margin-top: 2rem; /* More margin */
        }

        .tanggapan-section h4 {
            color: var(--heading-color);
            display: flex;
            align-items: center;
            gap: 0.7rem;
            font-size: 1.3rem; /* Slightly larger title for tanggapan section */
            font-weight: 600;
            margin-bottom: 1.2rem; /* More space below title */
        }
        .tanggapan-section h4 .fas {
            color: var(--primary-color); /* Icon color matching primary */
        }

        .tanggapan-card {
            background-color: #f7fcff; /* Very light blue background for responses */
            border-left: 5px solid var(--primary-color); /* Consistent primary color for border */
            padding: 1.4rem 1.8rem; /* More generous padding */
            border-radius: 12px; /* Consistent border-radius */
            margin-bottom: 1rem;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
        }

        .tanggapan-card:last-child {
            margin-bottom: 0;
        }

        .tanggapan-card p.content {
            color: var(--text-color);
            margin-top: 0.8rem; /* More space above content */
            font-size: 0.95rem; /* Slightly larger content text */
            line-height: 1.6;
        }
        .tanggapan-card p.is-size-7 {
            font-size: 0.8rem; /* Slightly smaller for meta info */
            color: #718096; /* Muted grey for meta info */
            font-style: italic;
        }

        /* File input custom styling (adjusted to match primary color palette) */
        .file.is-primary-laut .file-cta {
            background: var(--primary-color); /* Solid primary color */
            color: #fff;
            border-color: transparent;
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 3px 8px rgba(44, 82, 130, 0.25);
            padding: 1rem 1.5rem; /* Larger click area */
            border-radius: 8px 0 0 8px; /* Match form inputs */
        }

        .file.is-primary-laut .file-cta:hover {
            background: var(--primary-hover); /* Darker primary on hover */
            box-shadow: 0 4px 12px rgba(44, 82, 130, 0.35);
        }

        .file.is-primary-laut .file-name {
            border: 1px solid var(--border-color); /* Consistent border color */
            background-color: #fdfdfe; /* Consistent light background */
            padding: 0.8rem 1rem;
            border-radius: 0 8px 8px 0; /* Match form inputs */
            /* Mengoptimalkan tampilan nama file:
               - white-space: nowrap;  -> Menjaga teks dalam satu baris.
               - overflow: hidden;     -> Menyembunyikan teks yang melebihi batas.
               - text-overflow: ellipsis; -> Menambahkan '...' jika teks terpotong.
               - flex-grow: 1;         -> Memungkinkan elemen mengambil ruang kosong sebanyak mungkin.
               - min-width: 0;         -> Penting dalam flexbox agar elemen bisa menyusut lebih dari ukuran kontennya.
            */
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            display: flex;
            align-items: center;
            flex-grow: 1;
            min-width: 0;
            /* Hapus atau komentar baris max-width ini jika ada sebelumnya,
               karena flex-grow dan min-width akan lebih efektif dalam konteks flexbox. */
            /* max-width: calc(100% - 140px); */
        }

        /* --- Perubahan warna teks "Belum ada berkas dipilih" menjadi hitam --- */
        #fileName {
            color: #000000 !important; /* Menetapkan warna hitam, menggunakan !important untuk memastikan override */
        }
    </style>
</head>
<body>
    <div class="main-container">
        <div class="container is-max-desktop">
            <div class="dashboard-header">
                <div class="welcome-section">
                    <div class="welcome-text">
                        <h1>Selamat Datang, {{ Auth::user()->nama ?? 'Pengguna' }}</h1>
                        <p class="subtitle">Sistem Pelayanan Pengaduan Masyarakat Pemerintah Daerah</p>
                    </div>
                    <div class="header-actions">
                        <div class="is-flex is-flex-direction-column is-align-items-flex-end">
                            <p class="has-text-weight-semibold has-text-grey-dark" id="current-date"></p>
                            <p class="has-text-grey" id="current-time"></p>
                        </div>
                    </div>
                </div>
            </div>

            @if(session('success'))
                <div class="notification is-success">
                    <i class="fas fa-check-circle"></i>
                    <span>{{ session('success') }}</span>
                    <button class="delete"></button>
                </div>
            @endif
            @if(session('error'))
                <div class="notification is-danger">
                    <i class="fas fa-exclamation-circle"></i> {{-- Changed icon for error --}}
                    <span>{{ session('error') }}</span>
                    <button class="delete"></button>
                </div>
            @endif

            <div class="form-container">
                <h2 class="section-title">
                    <i class="fas fa-edit"></i>
                    Formulir Pengaduan Baru
                </h2>

                <form method="POST" action="{{ route('pengaduan.store') }}" enctype="multipart/form-data" id="complaintForm">
                    @csrf

                    <div class="field">
                        <label class="label">
                            <i class="fas fa-tag"></i>
                            Judul Pengaduan
                        </label>
                        <div class="control">
                            <input class="input" type="text" name="judul" placeholder="Contoh: Kerusakan Jalan di Area X" required>
                        </div>
                    </div>

                    <div class="field">
                        <label class="label">
                            <i class="fas fa-list"></i>
                            Kategori Pengaduan
                        </label>
                        <div class="mb-3">
                            <select name="id_kategori" id="id_kategori" class="form-control" required>
                                <option value="">Pilih kategori</option>
                                @if(isset($kategori) && count($kategori) > 0)
                                    @foreach ($kategori as $k)
                                        <option value="{{ $k->id_kategori }}">{{ $k->nama_kategori }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>

                    <div class="field">
                        <label class="label">
                            <i class="fas fa-file-alt"></i>
                            Deskripsi Lengkap Pengaduan
                        </label>
                        <div class="control">
                            <textarea class="textarea" name="isi" rows="5" placeholder="Sertakan detail kejadian, waktu, dan pihak terkait jika ada..." required></textarea>
                        </div>
                    </div>

                    <div class="field">
                        <label class="label">
                            <i class="fas fa-map-marked-alt"></i>
                            Lokasi Kejadian
                        </label>
                        <div class="control">
                            <input class="input" type="text" name="lokasi" placeholder="Contoh: Jl. Merdeka No. 45, Kel. Pusat, Kec. Maju">
                        </div>
                    </div>

                    <div class="field">
                        <label class="label">
                            <i class="fas fa-camera"></i>
                            Unggah Bukti Foto
                        </label>
                        <div class="control">
                            <div class="file has-name is-boxed is-primary-laut">
                                <label class="file-label file-input-container">
                                    <input class="file-input" type="file" name="foto" id="fileInput" accept="image/*">
                                    <span class="file-cta">
                                        <span class="file-icon">
                                            <i class="fas fa-upload"></i>
                                        </span>
                                        <span class="file-label">
                                            Pilih Foto
                                        </span>
                                    </span>
                                    <span class="file-name" id="fileName">
                                        Belum ada berkas dipilih
                                    </span>
                                </label>
                            </div>
                            <p class="help">Format yang didukung: JPG, PNG. Ukuran maksimal: 2MB.</p>
                        </div>
                    </div>

                    <div class="field is-grouped">
                        <div class="control">
                            <button type="submit" class="button is-primary is-large">
                                <i class="fas fa-paper-plane"></i>&nbsp;&nbsp;
                                Kirim Pengaduan
                            </button>
                        </div>
                        <div class="control">
                            <button type="reset" class="button is-light button-reset-custom">
                                <i class="fas fa-sync-alt"></i>&nbsp;&nbsp;
                                Reset Formulir
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="history-container">
                <h2 class="section-title">
                    <i class="fas fa-clipboard-list"></i>
                    Riwayat Pengaduan Anda
                </h2>

                @forelse($pengaduan as $item)
                    <div class="complaint-card">
                        <div class="complaint-header">
                            <h3 class="complaint-title">{{ $item->judul }}</h3>
                            <span class="status-badge status-{{ strtolower($item->status) }}">
                                {{ ucfirst($item->status) }}
                            </span>
                        </div>
                        
                        <div class="complaint-content">
        
                             @if($item->isi)
                                <p>
                                    <i class="field"></i> 
                                     <p><strong>Deskripsi</strong></p>
                                    <p>{{ $item->isi }}</p>
                                </p>
                            @endif


                            @if($item->lokasi)
                                <p>
                                    <i class="fas fa-map-marker-alt has-text-grey-light"></i> 
                                    <strong>Lokasi:</strong> {{ $item->lokasi }}
                                </p>
                            @endif
                           @if($item->kategori)
                                <p><i class="fas fa-folder-open has-text-grey-light"></i> 
                                    <strong>Kategori:</strong> {{ $item->kategori->nama_kategori }}
                                </p>
                            @endif
                        </div>
                        
                        <div class="complaint-meta">
                            <span><i class="fas fa-calendar-alt has-text-grey-light"></i> Diajukan: {{ $item->tanggal_pengaduan ? $item->tanggal_pengaduan->translatedFormat('d F Y, H:i:s') : 'Tanggal tidak tersedia' }} WIB</span>
                        </div>
                        
                        @if($item->foto)
                            <img src="{{ Storage::url($item->foto) }}" class="complaint-image" onclick="openImageModal(this.src)" alt="Foto bukti pengaduan">
                        @endif

                        {{-- Bagian untuk menampilkan tanggapan admin --}}
                        @if($item->tanggapan->isNotEmpty())
                            <div class="tanggapan-section">
                                <h4 class="title is-6 mb-3"><i class="fas fa-comment-dots"></i> Tanggapan dari Petugas:</h4>
                                @foreach($item->tanggapan as $tanggapan)
                                    <div class="tanggapan-card">
                                        <p class="is-size-7 has-text-grey-dark mb-1">
                                            Dari: <strong>{{ $tanggapan->admin->nama ?? 'Petugas Tidak Diketahui' }}</strong> pada {{ $tanggapan->tanggal_tanggapan->translatedFormat('d F Y, H:i:s') }} WIB
                                        </p>
                                        <p class="content is-small">{{ $tanggapan->isi_tanggapan }}</p>
                                    </div>
                                @endforeach
                                <div>
                        @else
                            <div class="notification is-info is-light mt-4">
                                <i class="fas fa-info-circle"></i> Belum ada tanggapan resmi untuk pengaduan ini. Mohon menunggu.
                            </div>
                        @endif
                </div>
                @empty
                    <div class="empty-state">
                        <i class="fas fa-box-open"></i>
                        <h3>Belum Ada Riwayat Pengaduan</h3>
                        <p>Anda belum mengajukan pengaduan apapun. Gunakan formulir di atas untuk membuat pengaduan baru.</p>
                    </div>
                @endforelse
        

            <div class="logout-section">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="button is-danger is-medium">
                        <i class="fas fa-sign-out-alt"></i>&nbsp;&nbsp;
                        Keluar
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="image-modal" id="imageModal" onclick="closeImageModal()">
        <span class="close">&times;</span>
        <img class="image-modal-content" id="modalImage" src="" alt="Foto bukti pengaduan">
    </div>

    <script src="https://kit.fontawesome.com/a2e0e6cfd7.js" crossorigin="anonymous"></script>
    
    <script>
        // File input handler
        document.getElementById('fileInput').addEventListener('change', function(e) {
            const fileInput = e.target;
            const fileName = document.getElementById('fileName');
            const fileInputContainer = document.querySelector('.file-input-container'); 
            
            if (fileInput.files.length > 0) {
                fileName.textContent = fileInput.files[0].name; // Just show file name
                fileInputContainer.classList.add('has-file');
            } else {
                fileName.textContent = 'Belum ada berkas dipilih';
                fileInputContainer.classList.remove('has-file');
            }
        });

        // Image modal functions
        function openImageModal(src) {
            const modal = document.getElementById('imageModal');
            const modalImg = document.getElementById('modalImage');
            modal.style.display = 'block';
            modalImg.src = src;
        }

        function closeImageModal() {
            document.getElementById('imageModal').style.display = 'none';
        }

        // Form validation and enhancement
        const form = document.getElementById('complaintForm');
        const inputs = form.querySelectorAll('.input, .textarea');
        
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.closest('.field').style.transform = 'translateY(-2px)';
            });
            
            input.addEventListener('blur', function() {
                this.closest('.field').style.transform = 'translateY(0)';
            });
        });

        // Auto-resize textarea
        document.querySelector('textarea[name="isi"]').addEventListener('input', function() {
            this.style.height = 'auto';
            this.style.height = this.scrollHeight + 'px';
        });

        // Form submission loading states
        form.addEventListener('submit', function(e) {
            const submitButton = form.querySelector('button[type="submit"]');
            if (submitButton) {
                submitButton.classList.add('loading');
                submitButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i>&nbsp;&nbsp;Mengirim...';
                submitButton.disabled = true; // Disable button to prevent multiple submissions
            }
        });

        // Auto-hide notifications
        document.querySelectorAll('.notification .delete').forEach(deleteBtn => {
            deleteBtn.addEventListener('click', function() {
                this.parentElement.style.opacity = '0';
                this.parentElement.style.transform = 'translateY(-20px)';
                setTimeout(() => {
                    this.parentElement.remove();
                }, 300);
            });
        });

        // Auto-hide notifications after 7 seconds
        setTimeout(() => {
            document.querySelectorAll('.notification').forEach(notification => {
                notification.style.opacity = '0';
                notification.style.transform = 'translateY(-20px)';
                setTimeout(() => {
                    notification.remove();
                }, 300);
            });
        }, 7000); // Increased to 7 seconds

        // Update clock automatically
        function updateClock() {
            const now = new Date();
            const timeString = now.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit', second: '2-digit' });
            const dateString = now.toLocaleDateString('id-ID', {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            });

            const dateElement = document.getElementById('current-date');
            const timeElement = document.getElementById('current-time');
            if (dateElement) {
                dateElement.textContent = dateString;
            }
            if (timeElement) {
                timeElement.textContent = timeString + ' WIB';
            }
        }

        setInterval(updateClock, 1000);
        updateClock(); // Initial call to display immediately

    </script>
</body>
</html>