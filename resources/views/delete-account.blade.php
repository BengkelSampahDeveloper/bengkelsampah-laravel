<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Delete Account - Bengkel Sampah</title>
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
            --gray-200: #E2E8F0;
            --red-500: #EF4444;
            --red-100: #FEE2E2;
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
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
            max-width: 600px;
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

        .warning-box {
            background: var(--red-100);
            border: 1px solid var(--red-500);
            border-radius: 8px;
            padding: 1.5rem;
            margin-bottom: 2rem;
        }

        .warning-box h3 {
            color: var(--red-500);
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .warning-box p {
            color: var(--text-secondary);
            margin-bottom: 0.5rem;
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

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            color: var(--accent-color);
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid var(--gray-200);
            border-radius: 8px;
            font-family: inherit;
            font-size: 1rem;
        }

        .form-group textarea {
            resize: vertical;
            min-height: 100px;
        }

        .form-group input:focus,
        .form-group textarea:focus,
        .form-group select:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(0, 182, 160, 0.1);
        }

        .required {
            color: var(--red-500);
        }

        .submit-btn {
            background: var(--danger-color);
            color: white;
            padding: 1rem 2rem;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            width: 100%;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 48px;
        }

        .submit-btn:hover:not(:disabled) {
            background: var(--danger-hover);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(220, 38, 38, 0.3);
        }

        .submit-btn:disabled {
            background: #ccc;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }

        /* Loading Spinner Styles */
        .spinner {
            display: none;
            width: 18px;
            height: 18px;
            border: 2px solid rgba(255,255,255,0.3);
            border-radius: 50%;
            border-top-color: #fff;
            animation: spin 1s ease-in-out infinite;
            margin-right: 8px;
        }

        .submit-btn.loading .spinner {
            display: inline-block;
        }

        .submit-btn.loading .btn-text {
            opacity: 0.8;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        .info-box {
            background: var(--primary-light);
            border: 1px solid var(--primary-color);
            border-radius: 8px;
            padding: 1.5rem;
            margin: 2rem 0;
        }

        .info-box h3 {
            color: var(--primary-color);
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .info-box p {
            color: var(--text-secondary);
            margin-bottom: 0.5rem;
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
            <h1>Request Penghapusan Akun</h1>

            <div class="warning-box">
                <h3>⚠️ Peringatan Penting</h3>
                <p><strong>Penghapusan akun adalah tindakan yang tidak dapat dibatalkan.</strong></p>
                <p>Setelah akun Anda dihapus, semua data pribadi, riwayat transaksi, poin reward, dan informasi terkait lainnya akan dihapus secara permanen dari sistem kami.</p>
            </div>

            <h2>Apa yang Akan Terjadi Setelah Penghapusan Akun?</h2>
            <ul>
                <li>Semua data pribadi Anda akan dihapus secara permanen</li>
                <li>Riwayat transaksi sampah akan dihapus</li>
                <li>Poin reward yang belum digunakan akan hangus</li>
                <li>Akun tidak dapat dipulihkan kembali</li>
                <li>Anda perlu mendaftar ulang jika ingin menggunakan aplikasi di masa depan</li>
            </ul>

            <div class="info-box">
                <h3>Alternatif Sebelum Menghapus Akun</h3>
                <p>Sebelum memutuskan untuk menghapus akun, pertimbangkan opsi berikut:</p>
                <ul>
                    <li><strong>Nonaktifkan notifikasi:</strong> Anda dapat mematikan notifikasi push tanpa menghapus akun</li>
                    <li><strong>Hapus data tertentu:</strong> Hubungi kami untuk menghapus data spesifik</li>
                    <li><strong>Jeda sementara:</strong> Akun dapat dinonaktifkan sementara tanpa penghapusan permanen</li>
                </ul>
            </div>

            <h2>Form Request Penghapusan Akun</h2>
            <p>Silakan isi form di bawah ini untuk mengajukan permintaan penghapusan akun. Tim kami akan memverifikasi identitas Anda dan memproses permintaan dalam waktu 30 hari kerja.</p>

            <form id="deleteAccountForm" method="POST" action="{{ route('delete.account.submit') }}">
                @csrf
                
                @if(session('success'))
                    <div style="background: #D1FAE5; border: 1px solid #10B981; color: #065F46; padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem;">
                        {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div style="background: #FEE2E2; border: 1px solid #EF4444; color: #991B1B; padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem;">
                        <ul style="margin: 0; padding-left: 1.5rem;">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="form-group">
                    <label for="email">Email Akun <span class="required">*</span></label>
                    <input type="email" id="email" name="email" required placeholder="Masukkan email yang terdaftar" value="{{ old('email') }}">
                </div>

                <div class="form-group">
                    <label for="phone">Nomor Telepon <span class="required">*</span></label>
                    <input type="tel" id="phone" name="phone" required placeholder="Masukkan nomor telepon yang terdaftar" value="{{ old('phone') }}">
                </div>

                <div class="form-group">
                    <label for="fullName">Nama Lengkap <span class="required">*</span></label>
                    <input type="text" id="fullName" name="fullName" required placeholder="Masukkan nama lengkap sesuai KTP" value="{{ old('fullName') }}">
                </div>

                <div class="form-group">
                    <label for="reason">Alasan Penghapusan Akun <span class="required">*</span></label>
                    <select id="reason" name="reason" required>
                        <option value="">Pilih alasan penghapusan</option>
                        <option value="privacy" {{ old('reason') == 'privacy' ? 'selected' : '' }}>Khawatir tentang privasi data</option>
                        <option value="no_longer_use" {{ old('reason') == 'no_longer_use' ? 'selected' : '' }}>Tidak lagi menggunakan aplikasi</option>
                        <option value="duplicate_account" {{ old('reason') == 'duplicate_account' ? 'selected' : '' }}>Memiliki akun ganda</option>
                        <option value="technical_issues" {{ old('reason') == 'technical_issues' ? 'selected' : '' }}>Masalah teknis yang tidak teratasi</option>
                        <option value="service_quality" {{ old('reason') == 'service_quality' ? 'selected' : '' }}>Tidak puas dengan kualitas layanan</option>
                        <option value="other" {{ old('reason') == 'other' ? 'selected' : '' }}>Lainnya</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="explanation">Penjelasan Detail (Opsional)</label>
                    <textarea id="explanation" name="explanation" placeholder="Berikan penjelasan lebih detail tentang alasan penghapusan akun...">{{ old('explanation') }}</textarea>
                </div>

                <div class="form-group">
                    <label for="confirmation">Konfirmasi <span class="required">*</span></label>
                    <select id="confirmation" name="confirmation" required>
                        <option value="">Pilih konfirmasi</option>
                        <option value="yes" {{ old('confirmation') == 'yes' ? 'selected' : '' }}>Ya, saya yakin ingin menghapus akun saya secara permanen</option>
                        <option value="no" {{ old('confirmation') == 'no' ? 'selected' : '' }}>Tidak, saya ingin membatalkan permintaan ini</option>
                    </select>
                </div>

                <button type="submit" class="submit-btn" id="submitBtn" disabled>
                    <div class="spinner"></div>
                    <span class="btn-text">Kirim Request Penghapusan Akun</span>
                </button>
            </form>

            <div class="info-box">
                <h3>Proses Penghapusan Akun</h3>
                <p><strong>1. Verifikasi Identitas:</strong> Tim kami akan memverifikasi identitas Anda melalui email dan telepon</p>
                <p><strong>2. Konfirmasi Final:</strong> Anda akan diminta untuk mengkonfirmasi permintaan penghapusan</p>
                <p><strong>3. Penghapusan Data:</strong> Semua data akan dihapus dalam waktu 30 hari kerja</p>
                <p><strong>4. Konfirmasi Selesai:</strong> Anda akan menerima email konfirmasi setelah proses selesai</p>
            </div>

            <div class="contact-info">
                <h3>Butuh Bantuan?</h3>
                <p>Jika Anda memiliki pertanyaan atau mengalami kesulitan, silakan hubungi tim dukungan kami:</p>
                <p><strong>Email:</strong> information@bengkelsampah.com</p>
                <p><strong>Telepon:</strong> +62 821 6823 1808</p>
                <p><strong>Jam Operasional:</strong> Senin - Jumat, 09:00 - 17:00 WIB</p>
            </div>
        </div>
    </div>

    <script>
        // Form validation
        const form = document.getElementById('deleteAccountForm');
        const submitBtn = document.getElementById('submitBtn');
        const confirmationSelect = document.getElementById('confirmation');

        // Enable/disable submit button based on confirmation
        confirmationSelect.addEventListener('change', function() {
            submitBtn.disabled = this.value !== 'yes';
        });

        // Real-time form validation
        const requiredFields = form.querySelectorAll('[required]');
        
        function validateForm() {
            let isValid = true;
            
            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    isValid = false;
                }
            });
            
            if (confirmationSelect.value !== 'yes') {
                isValid = false;
            }
            
            submitBtn.disabled = !isValid;
        }

        requiredFields.forEach(field => {
            field.addEventListener('input', validateForm);
            field.addEventListener('change', validateForm);
        });

        // Form submit with loading indicator
        form.addEventListener('submit', function(e) {
            const btnText = submitBtn.querySelector('.btn-text');
            
            // Show loading state
            submitBtn.classList.add('loading');
            submitBtn.disabled = true;
            btnText.textContent = 'Mengirim Request...';
            
            // Form will submit normally, but button shows loading state
        });

        // Initial validation
        validateForm();
    </script>
</body>
</html> 