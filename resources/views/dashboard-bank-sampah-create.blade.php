@extends('dashboard')
@section('content')
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Bank Sampah - Admin Panel</title>
    <link href="https://fonts.googleapis.com/css2?family=Urbanist:wght@400;500;600;700;900&display=swap" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Urbanist', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }

        body {
            font-family: 'Urbanist', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: #fff;
            color: #1e293b;
        }

        .header {
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .header-left h1 {
            font-family: 'Urbanist', sans-serif;
            font-size: 22px;
            font-weight: 400;
            color: #39746E;
        }

        .header-separator {
            font-family: 'Urbanist', sans-serif;
            font-size: 22px;
            font-weight: 400;
            color: #39746E;
        }

        .header-subtitle {
            font-family: 'Urbanist', sans-serif;
            font-size: 22px;
            font-weight: 700;
            color: #39746E;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .notification {
            position: relative;
            width: 24px;
            height: 24px;
            cursor: pointer;
        }

        .notification::before {
            content: "🔔";
            font-size: 18px;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #0FB7A6;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 14px;
            font-family: 'Urbanist', sans-serif;
        }

        .user-name {
            font-family: 'Urbanist', sans-serif;
            font-weight: 700;
            font-size: 16px;
            color: #39746E;
        }

        .main-container {
            display: flex;
            gap: 1rem;
            margin: 0 2rem 2rem 2rem;
        }

        .form-container {
            flex: 1;
            background: #fff;
            border: 1px solid #E5E6E6;
            border-radius: 16px;
            padding: 24px;
        }

        .form-header {
            margin-bottom: 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .form-title {
            font-family: 'Urbanist', sans-serif;
            font-size: 18px;
            font-weight: 700;
            color: #242E2C;
        }

        .form-actions {
            display: flex;
            gap: 8px;
        }

        .btn-cancel {
            padding: 8px 16px;
            background: transparent;
            border: 1px solid #FDCED1;
            border-radius: 8px;
            font-family: 'Urbanist', sans-serif;
            font-size: 14px;
            font-weight: 600;
            color: #F73541;
            cursor: pointer;
            transition: all 0.2s;
        }

        .btn-cancel:hover {
            background: #FDCED1;
        }

        .btn-save {
            padding: 8px 16px;
            background: #39746E;
            border: none;
            border-radius: 8px;
            font-family: 'Urbanist', sans-serif;
            font-size: 14px;
            font-weight: 600;
            color: #DFF0EE;
            cursor: pointer;
            transition: all 0.2s;
        }

        .btn-save:hover {
            background: #2d5a55;
        }

        .form-group {
            margin-bottom: 24px;
        }

        .form-label {
            display: block;
            font-family: 'Urbanist', sans-serif;
            font-size: 14px;
            font-weight: 500;
            color: #374151;
            margin-bottom: 8px;
        }

        .form-input {
            width: 100%;
            padding: 12px;
            border: 1px solid #E5E6E6;
            border-radius: 8px;
            font-family: 'Urbanist', sans-serif;
            font-size: 14px;
            color: #1e293b;
            background: #fff;
            transition: all 0.2s;
        }

        .form-input:focus {
            outline: none;
            border-color: #39746E;
        }

        .form-input::placeholder {
            color: #6B7271;
        }

        .form-textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #E5E6E6;
            border-radius: 8px;
            font-family: 'Urbanist', sans-serif;
            font-size: 14px;
            color: #1e293b;
            background: #fff;
            transition: all 0.2s;
            resize: vertical;
            min-height: 100px;
        }

        .form-textarea:focus {
            outline: none;
            border-color: #39746E;
        }

        .form-textarea::placeholder {
            color: #6B7271;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        .error-message {
            color: #dc2626;
            font-size: 12px;
            margin-top: 4px;
            font-family: 'Urbanist', sans-serif;
        }

        @media (max-width: 768px) {
            .form-row {
                grid-template-columns: 1fr;
            }
        }

        /* Loading Overlay Styles */
        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
        }

        .loading-content {
            background: white;
            padding: 2rem;
            border-radius: 8px;
            text-align: center;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .loading-spinner-large {
            width: 40px;
            height: 40px;
            border: 4px solid #f3f3f3;
            border-top: 4px solid #00B6A0;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin: 0 auto 1rem;
        }

        @keyframes spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
    </style>
</head>
<body>
    <!-- Loading Overlay -->
    <div class="loading-overlay" id="pageLoadingOverlay" style="display: none;">
        <div class="loading-content">
            <div class="loading-spinner-large"></div>
            <p id="loadingMessage">Memuat...</p>
        </div>
    </div>

    <header class="header">
        <div class="header-left">
            <h1>Bank Sampah</h1>
            <span class="header-separator">/</span>
            <span class="header-subtitle">Tambah Bank Sampah</span>
        </div>
        <div class="user-info">
            <div class="notification"></div>
            <span class="user-name">{{ Auth::guard('admin')->user()->role ?? 'Admin' }}</span>
            <div class="user-avatar">{{ strtoupper(substr(Auth::guard('admin')->user()->name ?? 'A', 0, 2)) }}</div>
        </div>
    </header>

    <div class="main-container">
        <div class="form-container">
            <div class="form-header">
                <h2 class="form-title">Form Tambah Bank Sampah</h2>
                <div class="form-actions">
                    <button class="btn-cancel" onclick="window.location.href='{{ route('dashboard.bank') }}'">Batal</button>
                    <button class="btn-save" onclick="submitForm()">Simpan</button>
                </div>
            </div>

            <form id="bankForm">
                <div class="form-group">
                    <label class="form-label">Nama Bank Sampah *</label>
                    <input type="text" class="form-input" name="nama_bank_sampah" placeholder="Masukkan nama bank sampah" required>
                    <div class="error-message" id="nama_error"></div>
                </div>

                <div class="form-group">
                    <label class="form-label">Alamat Bank Sampah *</label>
                    <textarea class="form-textarea" name="alamat_bank_sampah" placeholder="Masukkan alamat lengkap bank sampah" required></textarea>
                    <div class="error-message" id="alamat_error"></div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Nama Penanggung Jawab *</label>
                        <input type="text" class="form-input" name="nama_penanggung_jawab" placeholder="Masukkan nama penanggung jawab" required>
                        <div class="error-message" id="penanggung_jawab_error"></div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Kontak Penanggung Jawab *</label>
                        <input type="text" class="form-input" name="kontak_penanggung_jawab" placeholder="Masukkan nomor telepon/email" required>
                        <div class="error-message" id="kontak_error"></div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Foto Bank Sampah</label>
                    <input type="file" class="form-input" name="foto" accept=".jpeg,.jpg,.png,.webp" id="foto">
                    <div class="error-message" id="foto_error"></div>
                    <small style="color: #6B7271; font-size: 12px;">Format: JPEG, PNG, JPG, atau WebP. Maksimal: 2MB</small>
                </div>

                <div class="form-group">
                    <label class="form-label">Tipe Layanan *</label>
                    <select class="form-input" name="tipe_layanan" required>
                        <option value="">Pilih tipe layanan</option>
                        <option value="jemput">Jemput Saja</option>
                        <option value="tempat">Tempat Saja</option>
                        <option value="keduanya">Keduanya</option>
                    </select>
                    <div class="error-message" id="tipe_layanan_error"></div>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Loading helper functions
        function showLoading(message = 'Memuat...') {
            document.getElementById('loadingMessage').textContent = message;
            document.getElementById('pageLoadingOverlay').style.display = 'flex';
        }

        function hideLoading() {
            document.getElementById('pageLoadingOverlay').style.display = 'none';
        }

        function submitForm() {
            const form = document.getElementById('bankForm');
            const formData = new FormData(form);

            // Clear previous error messages
            clearErrors();

            // Show loading
            showLoading('Menyimpan Bank Sampah...');

            fetch('{{ route("dashboard.bank.store") }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.href = '{{ route("dashboard.bank") }}';
                } else {
                    // Handle validation errors
                    if (data.errors) {
                        Object.keys(data.errors).forEach(field => {
                            const errorElement = document.getElementById(field + '_error');
                            if (errorElement) {
                                errorElement.textContent = data.errors[field][0];
                            }
                        });
                    } else {
                        alert('Gagal membuat Bank Sampah: ' + data.message);
                    }
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat membuat Bank Sampah');
            })
            .finally(() => {
                hideLoading();
            });
        }

        function clearErrors() {
            const errorElements = document.querySelectorAll('.error-message');
            errorElements.forEach(element => {
                element.textContent = '';
            });
        }
    </script>
</body>
</html>
@endsection 