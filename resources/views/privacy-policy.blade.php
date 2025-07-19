<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Privacy Policy - Bengkel Sampah</title>
    <link href="https://fonts.googleapis.com/css2?family=Urbanist:wght@300;400;500;600;700&display=swap" rel="stylesheet">
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
            background: var(--gray-50);
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            background: var(--white);
            box-shadow: var(--shadow-sm);
            padding: 1rem 0;
            margin-bottom: 2rem;
        }

        .nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
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

        .back-link {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
        }

        .back-link:hover {
            text-decoration: underline;
        }

        .content {
            background: var(--white);
            padding: 2rem;
            border-radius: 12px;
            box-shadow: var(--shadow-sm);
        }

        .content h1 {
            color: var(--accent-color);
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 1rem;
            text-align: center;
        }

        .content h2 {
            color: var(--accent-color);
            font-size: 1.5rem;
            font-weight: 600;
            margin: 2rem 0 1rem 0;
        }

        .content h3 {
            color: var(--accent-color);
            font-size: 1.25rem;
            font-weight: 600;
            margin: 1.5rem 0 0.75rem 0;
        }

        .content p {
            color: var(--text-secondary);
            margin-bottom: 1rem;
            text-align: justify;
        }

        .content ul {
            color: var(--text-secondary);
            margin: 1rem 0;
            padding-left: 2rem;
        }

        .content li {
            margin-bottom: 0.5rem;
        }

        .last-updated {
            background: var(--primary-light);
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 2rem;
            text-align: center;
            color: var(--primary-dark);
            font-weight: 500;
        }

        .contact-info {
            background: var(--gray-50);
            padding: 1.5rem;
            border-radius: 8px;
            margin-top: 2rem;
        }

        .contact-info h3 {
            color: var(--primary-color);
            margin-bottom: 1rem;
        }

        .contact-info p {
            margin-bottom: 0.5rem;
        }

        @media (max-width: 768px) {
            .container {
                padding: 10px;
            }
            
            .content {
                padding: 1.5rem;
            }
            
            .content h1 {
                font-size: 1.75rem;
            }
        }
    </style>
</head>
<body>
    <header class="header">
        <div class="container">
            <nav class="nav">
                <div class="logo">
                    <img src="{{ asset('company/bengkelsampah.png') }}" alt="Bengkel Sampah Logo">
                    <span class="logo-text">Bengkel Sampah</span>
                </div>
                <a href="/" class="back-link">← Kembali ke Beranda</a>
            </nav>
        </div>
    </header>

    <div class="container">
        <div class="content">
            <div class="last-updated">
                <strong>Terakhir diperbarui:</strong> 1 Januari 2025
            </div>

            <h1>Kebijakan Privasi</h1>

            <p>Aplikasi Bengkel Sampah ("kami", "kita", atau "aplikasi") menghargai privasi Anda dan berkomitmen untuk melindungi informasi pribadi yang Anda berikan kepada kami. Kebijakan Privasi ini menjelaskan bagaimana kami mengumpulkan, menggunakan, menyimpan, dan melindungi informasi Anda saat menggunakan aplikasi mobile Bengkel Sampah.</p>

            <h2>1. Informasi yang Kami Kumpulkan</h2>

            <h3>1.1 Informasi Pribadi</h3>
            <p>Kami dapat mengumpulkan informasi pribadi berikut:</p>
            <ul>
                <li>Nama lengkap</li>
                <li>Alamat email</li>
                <li>Nomor telepon</li>
                <li>Alamat tempat tinggal</li>
                <li>Foto profil (opsional)</li>
            </ul>

            <h3>1.2 Informasi Perangkat</h3>
            <p>Kami dapat mengumpulkan informasi tentang perangkat Anda:</p>
            <ul>
                <li>Model perangkat</li>
                <li>Sistem operasi</li>
                <li>Versi aplikasi</li>
                <li>Pengaturan bahasa</li>
                <li>Pengaturan zona waktu</li>
            </ul>

            <h3>1.3 Informasi Lokasi</h3>
            <p>Dengan izin Anda, kami dapat mengumpulkan informasi lokasi untuk:</p>
            <ul>
                <li>Menemukan bank sampah terdekat</li>
                <li>Mengoptimalkan layanan pengumpulan sampah</li>
                <li>Memberikan rekomendasi lokasi yang relevan</li>
            </ul>

            <h3>1.4 Informasi Penggunaan</h3>
            <p>Kami mengumpulkan informasi tentang bagaimana Anda menggunakan aplikasi:</p>
            <ul>
                <li>Fitur yang digunakan</li>
                <li>Waktu penggunaan</li>
                <li>Frekuensi penggunaan</li>
                <li>Data transaksi sampah</li>
                <li>Riwayat aktivitas</li>
            </ul>

            <h2>2. Bagaimana Kami Menggunakan Informasi Anda</h2>

            <p>Kami menggunakan informasi yang dikumpulkan untuk:</p>
            <ul>
                <li>Menyediakan dan memelihara layanan aplikasi</li>
                <li>Memproses transaksi sampah</li>
                <li>Mengirim notifikasi dan pembaruan</li>
                <li>Memberikan dukungan pelanggan</li>
                <li>Meningkatkan kualitas layanan</li>
                <li>Mengirim informasi promosi (dengan izin Anda)</li>
                <li>Memenuhi kewajiban hukum</li>
            </ul>

            <h2>3. Berbagi Informasi</h2>

            <p>Kami tidak menjual, memperdagangkan, atau mentransfer informasi pribadi Anda kepada pihak ketiga tanpa izin Anda, kecuali dalam situasi berikut:</p>
            <ul>
                <li>Dengan mitra bank sampah untuk memproses transaksi</li>
                <li>Dengan penyedia layanan yang membantu kami mengoperasikan aplikasi</li>
                <li>Ketika diperlukan oleh hukum atau untuk melindungi hak kami</li>
                <li>Dalam kasus merger, akuisisi, atau penjualan aset</li>
            </ul>

            <h2>4. Keamanan Data</h2>

            <p>Kami menerapkan langkah-langkah keamanan yang sesuai untuk melindungi informasi pribadi Anda:</p>
            <ul>
                <li>Enkripsi data dalam transit dan penyimpanan</li>
                <li>Kontrol akses yang ketat</li>
                <li>Pemantauan keamanan secara berkala</li>
                <li>Pelatihan keamanan untuk staf</li>
            </ul>

            <h2>5. Penyimpanan Data</h2>

            <p>Kami menyimpan informasi pribadi Anda selama diperlukan untuk menyediakan layanan atau sesuai dengan kewajiban hukum. Data dapat disimpan di server yang berlokasi di Indonesia atau negara lain yang memiliki standar perlindungan data yang memadai.</p>

            <h2>6. Hak Pengguna</h2>

            <p>Anda memiliki hak berikut terkait informasi pribadi Anda:</p>
            <ul>
                <li>Hak untuk mengakses informasi pribadi Anda</li>
                <li>Hak untuk memperbaiki informasi yang tidak akurat</li>
                <li>Hak untuk menghapus akun dan data pribadi</li>
                <li>Hak untuk membatasi pemrosesan data</li>
                <li>Hak untuk memindahkan data Anda</li>
                <li>Hak untuk menarik persetujuan</li>
            </ul>

            <h2>7. Cookie dan Teknologi Pelacakan</h2>

            <p>Aplikasi kami dapat menggunakan cookie dan teknologi pelacakan serupa untuk meningkatkan pengalaman pengguna dan menganalisis penggunaan aplikasi. Anda dapat mengontrol pengaturan cookie melalui pengaturan perangkat Anda.</p>

            <h2>8. Anak-Anak</h2>

            <p>Aplikasi kami tidak ditujukan untuk anak-anak di bawah 13 tahun. Kami tidak secara sadar mengumpulkan informasi pribadi dari anak-anak di bawah 13 tahun. Jika Anda adalah orang tua atau wali dan mengetahui bahwa anak Anda telah memberikan informasi pribadi kepada kami, silakan hubungi kami.</p>

            <h2>9. Perubahan Kebijakan Privasi</h2>

            <p>Kami dapat memperbarui Kebijakan Privasi ini dari waktu ke waktu. Kami akan memberi tahu Anda tentang perubahan material melalui aplikasi atau email. Penggunaan aplikasi setelah perubahan berarti Anda menyetujui kebijakan privasi yang diperbarui.</p>

            <h2>10. Hukum yang Berlaku</h2>

            <p>Kebijakan Privasi ini tunduk pada hukum Republik Indonesia. Setiap sengketa yang timbul akan diselesaikan melalui pengadilan yang berwenang di Indonesia.</p>

            <div class="contact-info">
                <h3>Hubungi Kami</h3>
                <p>Jika Anda memiliki pertanyaan tentang Kebijakan Privasi ini, silakan hubungi kami:</p>
                <p><strong>Email:</strong> information@bengkelsampah.com</p>
                <p><strong>Telepon:</strong> +62 821 6823 1808</p>
                <p><strong>Alamat:</strong> Desa Lembah Lubuk Raya, Kec. Angkola Barat, Kab. Tapanuli Selatan, Sumatera Utara 22735</p>
            </div>
        </div>
    </div>
</body>
</html> 