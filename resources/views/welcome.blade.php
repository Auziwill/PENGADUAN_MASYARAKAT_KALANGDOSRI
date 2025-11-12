<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIDUMAS - Sistem Pengaduan Masyarakat Desa Kalangdosari</title>
    <link href="{{ asset('css/welcome.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>

<body>
    <nav class="navbar ">
        <div class="nav-container">
            <div class="nav-logo">
                <img src="{{ asset('images/logo_cimahi.png') }}" alt="Logo Kecamatan Cimahi Utara">
                <span>SIDUMAS Desa Kalangdosari</span>
            </div>
            <div class="nav-menu">
                <a href="#home" class="nav-link">Beranda</a>
                <a href="#layanan" class="nav-link">Layanan</a>
                <a href="#tentang" class="nav-link">Tentang</a>
                <a href="#visimisi" class="nav-link">Visi & Misi</a>
                <a href="{{ route('login') }}" class="btn-login">Masuk</a>
            </div>
            <div class="hamburger">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </nav>

    <section id="home" class="hero ">
        <div class="hero-overlay "></div>
        <div class="hero-content  ">
            <div class="hero-text">
                <h1 class="hero-title">
                    <span class="gradient-text">SIDUMAS</span>
                    <br>Sistem Pengaduan Masyarakat 
                </h1>
                <p class="hero-subtitle">
                    Platform digital untuk menyampaikan keluhan, saran, dan aspirasi masyarakat Kecamatan Cimahi Utara.
                    Wujudkan Kecamatan Cimahi Utara yang lebih baik bersama-sama.
                </p>
            </div>
            <div class="hero-image">
                <div class="floating-card">
                    <i class="fas fa-city"></i>
                    <h3>Desa Kalangdosari</h3>
                    <p>Melayani dengan Hati</p>
                </div>
            </div>
        </div>
        <div class="scroll-indicator mt-80px">
            <div class="scroll-arrow"></div>
        </div>
    </section>

   <section class="stats">
    <div class="container">
        <div class="stats-grid">
            <div class="stat-item">
                <div class="stat-icon">
                    <i class="fas fa-file-alt"></i>
                </div>
                <div class="stat-number" data-target="{{ $totalPengaduan }}">{{ $totalPengaduan }}</div>
                <div class="stat-label">Total Pengaduan</div>
            </div>
            <div class="stat-item">
                <div class="stat-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="stat-number" data-target="{{ $pengaduanSelesai }}">{{ $pengaduanSelesai }}</div>
                <div class="stat-label">Pengaduan Selesai</div>
            </div>
            <div class="stat-item">
                <div class="stat-icon">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="stat-number" data-target="{{ $pengaduanDiproses }}">{{ $pengaduanDiproses }}</div>
                <div class="stat-label">Sedang Diproses</div>
            </div>
            <div class="stat-item">
                <div class="stat-icon">
                    <i class="fas fa-users"></i>
                </div>
                <div class="stat-number" data-target="{{ $penggunaAktif }}">{{ $penggunaAktif }}</div>
                <div class="stat-label">Pengguna Aktif</div>
            </div>
        </div>
    </div>
</section>
<br>
<br>
<br>    
<br>

    <!-- Charts Section -->
     <div class="container ">
        <div class="section-header">
                <h1>Laporan Per Kategori</h1>
            </div>
    <div class="row mb-4  border border-3 border-primary rounded-4 shadow-sm p-4">
        <div class="col-12-lg-8 mb-3">
                <div class="card-body ">
                    <canvas id="categoryChart" style="max-height: 400px;"></canvas>
                </div>
            </div>
        </div>
    </div>
 
<br>
<br>
<br>
     <div class="row">
         <div class="section-header">
                <h1>Trend Laporan Per Bulan</h1>
            </div>
            <div class="col-12">
                <div class="card ">
                    <div class="card-body ">
                        <div class="chart-container mt-5" style="height: 350px;">
                            <canvas id="trendChart" style="max-height: 400px;"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 mb-3">
                <div class="card">
                    <div class="section-header">
                    <h1>Status Laporan</h1>
                </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <canvas id="statusChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.0/chart.umd.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


        <script>
     const statusCtx = document.getElementById('statusChart').getContext('2d');
    const statusChart = new Chart(statusCtx, {
        type: 'doughnut',
        data: {
            labels: ['Menunggu', 'Proses', 'Selesai'],
            datasets: [{
                data: [
                    {{ $statusData['menunggu'] }},
                    {{ $statusData['proses'] }},
                    {{ $statusData['selesai'] }}
                ],
                backgroundColor: [
                    'rgba(250, 234, 7, 0.96)',
                    'rgba(24, 0, 240, 0.77)',
                    'rgba(56, 236, 11, 0.85)'
                ],
                borderColor: [
                    'rgba(255, 238, 3, 1)',
                    'rgba(10, 25, 238, 1)',
                    'rgba(0, 255, 55, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
            
        }
    });

    const ctx = document.getElementById('categoryChart').getContext('2d');
    
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: @json($kategoriLabels),
            datasets: [{
                data: @json($kategoriData),
                backgroundColor: ['#4A90E2', '#50A684', '#F5A623', '#E57373', '#4FC3F7', '#9E9E9E'],
                borderWidth: 2
            }]
            
        },
          borderColor: [
                        'rgb(13, 110, 253)',
                        'rgb(25, 135, 84)',
                        'rgb(255, 193, 7)',
                        'rgb(220, 53, 69)',
                        'rgb(13, 202, 240)',
                        'rgb(108, 117, 125)'
                    ],
        options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 10
                        }
                    }
                }
            }
    });

    const trendCtx = document.getElementById('trendChart');
        if (trendChart) {
            new Chart(trendChart.getContext('2d'), {
                type: 'line',
                data: {
                    labels: @json($trendLabels),
                    datasets: [{
                        label: 'Jumlah Laporan',
                        data: @json($trendCounts),
                        fill: true,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 2,
                        tension: 0.4,
                        pointBackgroundColor: 'rgba(75, 192, 192, 1)',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 2,
                        pointRadius: 4,
                        pointHoverRadius: 6
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top'
                        }
                    },
                    scales: {
                        x: {
                        grid: {
                           // Menghilangkan garis vertikal
                        }
                         },
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1,
                                precision: 0
                            }
                        }
                    }
                }
            });
        }
</script>
    <section id="layanan" class="services">
        <div class="container">
            <div class="section-header">
                <h2>Layanan Kami</h2>
                <p>Berbagai jenis layanan yang tersedia di Kecamatan Cimahi Utara untuk masyarakat.</p>
            </div>
            <div class="services-grid">
                @php
                  $services = [
    ['icon' => 'fa-solid fa-id-card', 'title' => 'Pelayanan KTP'],
    ['icon' => 'fa-solid fa-users', 'title' => 'Pelayanan KK'],
    ['icon' => 'fa-solid fa-building', 'title' => 'Surat Persetujuan Bangunan (IMB)'],
    ['icon' => 'fa-solid fa-hand-holding-heart', 'title' => 'Surat Keterangan Tidak Mampu'],
    ['icon' => 'fa-solid fa-user-pen', 'title' => 'Surat Pengantar Perubahan Data Penduduk'],
    ['icon' => 'fa-solid fa-scroll', 'title' => 'Legalisir KK/KTP'],
    ['icon' => 'fa-solid fa-map-location-dot', 'title' => 'Surat Pengantar Pindah Kota'],
    ['icon' => 'fa-solid fa-baby', 'title' => 'Surat Keterangan Kelahiran'],
    ['icon' => 'fa-solid fa-envelope', 'title' => 'Surat Keterangan Ahli Waris'],
    ['icon' => 'fa-solid fa-ring', 'title' => 'Surat Keterangan Belum Menikah'],
    ['icon' => 'fa-solid fa-leaf', 'title' => 'Surat Izin Usaha Mikro'],
    ['icon' => 'fa-solid fa-masks-theater', 'title' => 'Surat Izin Keramaian'],
    ['icon' => 'fa-solid fa-chart-line', 'title' => 'Surat Pengajuan Izin Operasional'],
    ['icon' => 'fa-solid fa-calendar-days', 'title' => 'Surat Rekomendasi Kegiatan Masyarakat'],
    ['icon' => 'fa-solid fa-bullhorn', 'title' => 'Surat Keterangan Acara'],
];

                @endphp

                @foreach($services as $service)
                    <div class="service-card">
                        <div class="service-icon">
                            <i class="{{ $service['icon'] }}"></i>
                        </div>
                        <h3>{{ $service['title'] }}</h3>
                        <p>Ajukan permohonan dengan mudah.</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section id="tentang" class="about">
        <div class="container">
            <div class="about-content">
                <div class="about-text">
                    <h2>Tentang SIPADU</h2>
                    <p>
                        Sistem Pengaduan Masyarakat (SIPADU) Kecamatan Cimahi Utara adalah platform digital yang
                        memungkinkan masyarakat untuk menyampaikan keluhan, saran, dan aspirasi secara
                        online dengan mudah dan transparan.
                    </p>
                    <div class="features">
                        <div class="feature">
                            <i class="fas fa-clock"></i>
                            <div>
                                <h4>24/7 Tersedia</h4>
                                <p>Layanan dapat diakses kapan saja</p>
                            </div>
                        </div>
                        <div class="feature">
                            <i class="fas fa-eye"></i>
                            <div>
                                <h4>Transparan</h4>
                                <p>Proses penanganan dapat dipantau</p>
                            </div>
                        </div>
                        <div class="feature">
                            <i class="fas fa-mobile-alt"></i>
                            <div>
                                <h4>Mudah Digunakan</h4>
                                <p>Interface yang user-friendly</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="about-image">
                    <img src="{{ asset('images/logo_city.png') }}" alt="Kecamatan Cimahi Utara">
                </div>
            </div>
        </div>
    </section>

    <section class="how-it-works">
        <div class="container">
            <div class="section-header">
                <h2>Cara Menggunakan SIPADU</h2>
                <p>Proses sederhana untuk menyampaikan pengaduan Anda</p>
            </div>
            <div class="steps">
                <div class="step">
                    <div class="step-number">1</div>
                    <div class="step-content">
                        <h3>Login Akun</h3>
                        <p>Masukkan Akun Anda,jika belum punya Registrasi akun</p>
                    </div>
                </div>
            <div class="step-connector"></div>
                <div class="step">
                    <div class="step-number">2</div>
                    <div class="step-content">
                        <h3>Buat Pengaduan</h3>
                        <p>Isi formulir pengaduan dengan lengkap dan detail</p>
                    </div>
                </div>
                <div class="step-connector"></div>
                <div class="step">
                    <div class="step-number">3</div>
                    <div class="step-content">
                        <h3>Verifikasi</h3>
                        <p>Tim kami akan memverifikasi pengaduan yang masuk</p>
                    </div>
                </div>
                <div class="step-connector"></div>
                <div class="step">
                    <div class="step-number">4</div>
                    <div class="step-content">
                        <h3>Tindak Lanjut</h3>
                        <p>Pengaduan ditindaklanjuti oleh instansi terkait</p>
                    </div>
                </div>
                <div class="step-connector"></div>
                <div class="step">
                    <div class="step-number">5</div>
                    <div class="step-content">
                        <h3>Selesai</h3>
                        <p>Anda akan mendapat notifikasi penyelesaian</p>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section id="visimisi" class="visimisi">
        <div class="container">
            <div class="section-header">
                <h2>Visi, Misi & Tujuan</h2>
                <p>Komitmen kami untuk memberikan pelayanan terbaik bagi masyarakat.</p>
            </div>
            <div class="columns is-multiline">
                <div class="column is-full">
                    <div class="visimisi-card">
                        <h3 class="title is-4">Visi</h3>
                        <p>Menjadi platform pengaduan masyarakat terdepan yang mendorong partisipasi aktif warga dalam membangun Kecamatan Cimahi Utara.</p>
                    </div>
                </div>
                <div class="column is-half">
                    <div class="visimisi-card">
                        <h3 class="title is-4">Misi</h3>
                        <ul class="misi-list">
                            <li>Menyediakan kanal pengaduan yang mudah diakses dan user-friendly.</li>
                            <li>Memastikan setiap pengaduan diverifikasi dan ditindaklanjuti dengan cepat.</li>
                            <li>Meningkatkan transparansi proses penanganan pengaduan.</li>
                            <li>Membangun komunikasi dua arah antara pemerintah dan masyarakat.</li>
                        </ul>
                    </div>
                </div>
                <div class="column is-half">
                    <div class="visimisi-card">
                        <h3 class="title is-4">Tujuan</h3>
                        <ul class="tujuan-list">
                            <li>Meningkatkan efisiensi dan efektivitas pelayanan publik.</li>
                            <li>Menciptakan pemerintahan yang akuntabel dan responsif.</li>
                            <li>Membangun kepercayaan masyarakat terhadap pemerintah daerah.</li>
                            <li>Mengumpulkan data dan masukan berharga untuk perbaikan kebijakan.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <div class="footer-logo">
                        <img src="{{ asset('images/logo_cimahi.png') }}" alt="Logo Kecamatan Cimahi Utara">
                        <h3>SIPADU Kecamatan Cimahi Utara</h3>
                    </div>
                    <p>Sistem Pengaduan Masyarakat Kecamatan Cimahi Utara untuk pelayanan yang lebih baik.</p>
                    <div class="social-links">
                        <a href="https://www.tiktok.com/@kec.cimahi.utara"><i class="fab fa-tiktok"></i></a>
                        <a href="https://www.instagram.com/keccimahiutara/"><i class="fab fa-instagram"></i></a>
                        <a href="https://youtube.com/@kecamatancimahiutara5780?feature=shared"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
                <div class="footer-section">
                    <h4>Link Cepat</h4>
                    <ul>
                        <li><a href="#home">Beranda</a></li>
                        <li><a href="#layanan">Layanan</a></li>
                        <li><a href="#tentang">Tentang</a></li>
                        <li><a href="#visimisi">Visi & Misi</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h4>Jam Pelayanan</h4>
                    <div class="schedule">
                        <p><strong>Senin - Jumat:</strong><br>08:00 - 16:00 WIB</p>
                        <p><strong>Sabtu - Minggu:</strong><br>Tutup</p>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <p>© 2025 Budi Amin. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="{{ asset('js/welcome.js') }}"></script>
</body>
</html>