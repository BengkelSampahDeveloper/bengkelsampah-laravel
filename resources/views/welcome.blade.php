<!DOCTYPE html>
<html lang="id">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bengkel Sampah - Company Profile</title>
    <link href="https://fonts.googleapis.com/css2?family=Urbanist:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
        <style>
        :root {
            --primary-color: #00B6A0;
            --primary-dark: #008378;
            --primary-light: #E3F4F1;
            --accent-color: #2D3748;
            --text-primary: #2D3748;
            --text-secondary: #6B7271;
            --white: #FFFFFF;
            --gray-50: #F7FAFC;
            --gray-100: #EDF2F7;
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Urbanist', sans-serif;
            line-height: 1.6;
            color: var(--text-primary);
            background: linear-gradient(135deg, var(--primary-light) 0%, var(--white) 100%);
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Header */
        .header {
            background: var(--white);
            box-shadow: var(--shadow-sm);
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
        }

        .nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 0;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .logo img {
            height: 40px;
            width: auto;
        }

        .logo-text {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary-color);
        }

        .nav-links {
            display: flex;
            gap: 2rem;
            list-style: none;
        }

        .nav-links a {
            text-decoration: none;
            color: var(--text-secondary);
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .nav-links a:hover {
            color: var(--primary-color);
        }

        .cta-button {
            background: var(--primary-color);
            color: var(--white);
            padding: 0.75rem 1.5rem;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .cta-button:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        /* Hero Section */
        .hero {
            padding: 120px 0 80px;
            text-align: center;
        }

        .hero h1 {
            font-size: 3.5rem;
            font-weight: 700;
            color: var(--accent-color);
            margin-bottom: 1.5rem;
            line-height: 1.2;
        }

        .hero h1 span {
            color: var(--primary-color);
        }

        .hero p {
            font-size: 1.25rem;
            color: var(--text-secondary);
            margin-bottom: 2.5rem;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .hero-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn-secondary {
            background: transparent;
            color: var(--primary-color);
            border: 2px solid var(--primary-color);
            padding: 0.75rem 1.5rem;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-secondary:hover {
            background: var(--primary-color);
            color: var(--white);
        }

        /* Sections */
        .section {
            padding: 80px 0;
        }

        .section:nth-child(even) {
            background: var(--white);
        }

        .section-title {
            text-align: center;
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--accent-color);
            margin-bottom: 1rem;
        }

        .section-subtitle {
            text-align: center;
            font-size: 1.125rem;
            color: var(--text-secondary);
            margin-bottom: 3rem;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-top: 3rem;
        }

        .feature-card {
            background: var(--white);
            padding: 2rem;
            border-radius: 16px;
            box-shadow: var(--shadow-lg);
            text-align: center;
            transition: all 0.3s ease;
            border: 1px solid var(--gray-100);
        }

        .feature-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-lg);
        }

        .feature-icon {
            width: 80px;
            height: 80px;
            background: var(--primary-light);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            font-size: 2rem;
            color: var(--primary-color);
        }

        .feature-card h3 {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--accent-color);
            margin-bottom: 1rem;
        }

        .feature-card p {
            color: var(--text-secondary);
            line-height: 1.6;
        }

        /* About Section */
        .about-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
            align-items: center;
        }

        .about-text h2 {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--accent-color);
            margin-bottom: 1.5rem;
        }

        .about-text p {
            font-size: 1.125rem;
            color: var(--text-secondary);
            margin-bottom: 1.5rem;
            line-height: 1.7;
        }

        .about-stats {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 2rem;
            margin-top: 2rem;
        }

        .stat-item {
            text-align: center;
            padding: 1.5rem;
            background: var(--white);
            border-radius: 12px;
            box-shadow: var(--shadow-sm);
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--primary-color);
            display: block;
        }

        .stat-label {
            color: var(--text-secondary);
            font-weight: 500;
        }

        .about-image {
            text-align: center;
        }

        .about-image img {
            max-width: 100%;
            height: auto;
            border-radius: 16px;
            box-shadow: var(--shadow-lg);
        }

        /* Contact Section */
        .contact-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
            align-items: center;
        }

        .contact-info h2 {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--accent-color);
            margin-bottom: 1.5rem;
        }

        .contact-info p {
            font-size: 1.125rem;
            color: var(--text-secondary);
            margin-bottom: 2rem;
        }

        .contact-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .contact-icon {
            width: 50px;
            height: 50px;
            background: var(--primary-color);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--white);
            font-size: 1.25rem;
        }

        .contact-text h4 {
            font-weight: 600;
            color: var(--accent-color);
            margin-bottom: 0.25rem;
        }

        .contact-text p {
            color: var(--text-secondary);
            margin: 0;
        }

        /* Footer */
        .footer {
            background: var(--accent-color);
            color: var(--white);
            padding: 3rem 0 1rem;
            text-align: center;
        }

        .footer-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .footer-section h3 {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .footer-section p {
            color: #CBD5E0;
            line-height: 1.6;
        }

        .footer-bottom {
            border-top: 1px solid #4A5568;
            padding-top: 1rem;
            color: #CBD5E0;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }

            .hero h1 {
                font-size: 2.5rem;
            }

            .about-content,
            .contact-content {
                grid-template-columns: 1fr;
                gap: 2rem;
            }

            .features-grid {
                grid-template-columns: 1fr;
            }

            .hero-buttons {
                flex-direction: column;
                align-items: center;
            }

            .about-stats {
                grid-template-columns: 1fr;
            }
        }
        </style>
    </head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="container">
            <nav class="nav">
                <div class="logo">
                    <img src="{{ asset('company/bengkelsampah.png') }}" alt="Bengkel Sampah Logo">
                    <span class="logo-text">Bengkel Sampah</span>
                </div>
                <ul class="nav-links">
                    <li><a href="#home">Beranda</a></li>
                    <li><a href="#about">Tentang</a></li>
                    <li><a href="#services">Layanan</a></li>
                    <li><a href="#contact">Kontak</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section id="home" class="hero">
        <div class="container">
            <h1>Solusi <span>Pengelolaan Sampah</span> yang Berkelanjutan</h1>
            <p>Kami membantu masyarakat dan bisnis dalam mengelola sampah dengan cara yang ramah lingkungan dan menguntungkan secara ekonomi.</p>
            <div class="hero-buttons">
                <a href="#services" class="cta-button">Pelajari Layanan</a>
                <a href="#contact" class="btn-secondary">Hubungi Kami</a>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="section">
        <div class="container">
            <h2 class="section-title">Mengapa Memilih Kami?</h2>
            <p class="section-subtitle">Kami menawarkan solusi lengkap untuk pengelolaan sampah yang efektif dan berkelanjutan</p>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-recycle"></i>
                    </div>
                    <h3>Pengelolaan Terpadu</h3>
                    <p>Sistem pengelolaan sampah yang terintegrasi dari pengumpulan hingga daur ulang dengan teknologi modern.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-leaf"></i>
                    </div>
                    <h3>Ramah Lingkungan</h3>
                    <p>Menggunakan metode yang ramah lingkungan dan mendukung upaya pelestarian alam untuk masa depan yang lebih baik.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-coins"></i>
                    </div>
                    <h3>Nilai Ekonomi</h3>
                    <p>Mengubah sampah menjadi sumber penghasilan dengan sistem reward dan insentif yang menarik.</p>
                                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-users"></i>
                            </div>
                    <h3>Komunitas Aktif</h3>
                    <p>Membangun komunitas yang peduli lingkungan dengan program edukasi dan pelatihan berkelanjutan.</p>
                                </div>
                            </div>
                                </div>
    </section>

    <!-- About Section -->
    <section id="about" class="section">
        <div class="container">
            <div class="about-content">
                <div class="about-text">
                    <h2>Tentang Bengkel Sampah</h2>
                    <p>Bengkel Sampah adalah platform inovatif yang menghubungkan masyarakat dengan sistem pengelolaan sampah yang terpadu. Kami berkomitmen untuk menciptakan lingkungan yang lebih bersih dan berkelanjutan.</p>
                    <p>Dengan teknologi modern dan pendekatan yang sistematis, kami membantu individu, keluarga, dan bisnis dalam mengelola sampah mereka dengan cara yang efektif dan menguntungkan.</p>
                    <div class="about-stats">
                        <div class="stat-item">
                            <span class="stat-number">1000+</span>
                            <span class="stat-label">Pengguna Aktif</span>
                            </div>
                        <div class="stat-item">
                            <span class="stat-number">50+</span>
                            <span class="stat-label">Bank Sampah</span>
                                </div>
                        <div class="stat-item">
                            <span class="stat-number">100+</span>
                            <span class="stat-label">Event Sukses</span>
                            </div>
                        <div class="stat-item">
                            <span class="stat-number">95%</span>
                            <span class="stat-label">Kepuasan</span>
                        </div>
                    </div>
                </div>
                <div class="about-image">
                    <img src="{{ asset('company/bengkelsampah.png') }}" alt="Bengkel Sampah Team">
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="section">
        <div class="container">
            <h2 class="section-title">Layanan Kami</h2>
            <p class="section-subtitle">Berbagai layanan pengelolaan sampah yang dapat disesuaikan dengan kebutuhan Anda</p>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-trash-alt"></i>
                    </div>
                    <h3>Pengumpulan Sampah</h3>
                    <p>Layanan pengumpulan sampah door-to-door dengan jadwal yang fleksibel dan teratur.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-sort"></i>
                    </div>
                    <h3>Pemilahan Sampah</h3>
                    <p>Pemilahan sampah berdasarkan jenis untuk memudahkan proses daur ulang dan pengolahan.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-recycle"></i>
                    </div>
                    <h3>Daur Ulang</h3>
                    <p>Proses daur ulang sampah menjadi produk baru yang bernilai ekonomi dan ramah lingkungan.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <h3>Edukasi</h3>
                    <p>Program edukasi dan pelatihan tentang pengelolaan sampah yang benar dan berkelanjutan.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <h3>Event Lingkungan</h3>
                    <p>Penyelenggaraan event dan program lingkungan untuk meningkatkan kesadaran masyarakat.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h3>Monitoring</h3>
                    <p>Sistem monitoring dan pelaporan real-time untuk tracking progress pengelolaan sampah.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="section">
        <div class="container">
            <div class="contact-content">
                <div class="contact-info">
                    <h2>Hubungi Kami</h2>
                    <p>Siap untuk memulai perjalanan pengelolaan sampah yang lebih baik? Hubungi kami sekarang dan mari kita bekerja sama untuk menciptakan lingkungan yang lebih bersih.</p>
                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div class="contact-text">
                            <h4>Alamat</h4>
                            <p>Desa Lembah Lubuk Raya, Kec. Angkola Barat<br>Kab. Tapanuli Selatan, Sumatera Utara 22735</p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="fas fa-phone"></i>
                        </div>
                        <div class="contact-text">
                            <h4>Telepon</h4>
                            <p>+62 821 6823 1808</p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="contact-text">
                            <h4>Email</h4>
                            <p>information@bengkelsampah.com</p>
                        </div>
                    </div>
                </div>
                <div class="contact-form">
                    <div style="background: var(--white); padding: 2rem; border-radius: 16px; box-shadow: var(--shadow-lg);">
                        <h3 style="margin-bottom: 1.5rem; color: var(--accent-color);">Kirim Pesan</h3>
                        <form>
                            <div style="margin-bottom: 1rem;">
                                <input type="text" placeholder="Nama Lengkap" style="width: 100%; padding: 0.75rem; border: 1px solid var(--gray-100); border-radius: 8px; font-family: inherit;">
                            </div>
                            <div style="margin-bottom: 1rem;">
                                <input type="email" placeholder="Email" style="width: 100%; padding: 0.75rem; border: 1px solid var(--gray-100); border-radius: 8px; font-family: inherit;">
                            </div>
                            <div style="margin-bottom: 1rem;">
                                <textarea placeholder="Pesan" rows="4" style="width: 100%; padding: 0.75rem; border: 1px solid var(--gray-100); border-radius: 8px; font-family: inherit; resize: vertical;"></textarea>
                            </div>
                            <button type="submit" class="cta-button" style="width: 100%;">Kirim Pesan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <h3>Bengkel Sampah</h3>
                    <p>Platform inovatif untuk pengelolaan sampah yang berkelanjutan dan menguntungkan bagi semua pihak.</p>
                </div>
                <div class="footer-section">
                    <h3>Layanan</h3>
                    <p>Pengumpulan Sampah<br>Pemilahan & Daur Ulang<br>Edukasi Lingkungan<br>Event & Program</p>
                </div>
                <div class="footer-section">
                    <h3>Kontak</h3>
                    <p>Desa Lembah Lubuk Raya, Kec. Angkola Barat<br>Kab. Tapanuli Selatan, Sumatera Utara 22735<br>+62 821 6823 1808<br>information@bengkelsampah.com</p>
                </div>
                <div class="footer-section">
                    <h3>Ikuti Kami</h3>
                    <p>Facebook<br>Instagram<br>Twitter<br>LinkedIn</p>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2025 Bengkel Sampah. Semua hak dilindungi. | 
                    <a href="{{ route('privacy.policy') }}" style="color: #CBD5E0; text-decoration: none;">Kebijakan Privasi</a> | 
                    <a href="{{ route('delete.account') }}" style="color: #CBD5E0; text-decoration: none;">Hapus Akun</a>
                </p>
            </div>
        </div>
    </footer>

    <script>
        // Smooth scrolling for navigation links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Add scroll effect to header
        window.addEventListener('scroll', function() {
            const header = document.querySelector('.header');
            if (window.scrollY > 100) {
                header.style.background = 'rgba(255, 255, 255, 0.95)';
                header.style.backdropFilter = 'blur(10px)';
            } else {
                header.style.background = 'var(--white)';
                header.style.backdropFilter = 'none';
            }
        });
    </script>
    </body>
</html>
