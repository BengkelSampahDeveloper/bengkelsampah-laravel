@extends('dashboard')
@section('content')
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Sampah - Admin Panel</title>
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

        .btn-upload {
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

        .btn-upload:hover {
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
            resize: vertical;
            min-height: 100px;
            transition: all 0.2s;
        }

        .form-textarea:focus {
            outline: none;
            border-color: #39746E;
        }

        .form-textarea::placeholder {
            color: #6B7271;
        }

        .form-select {
            width: 100%;
            padding: 12px;
            border: 1px solid #E5E6E6;
            border-radius: 8px;
            font-family: 'Urbanist', sans-serif;
            font-size: 14px;
            color: #1e293b;
            background: #fff;
            cursor: pointer;
            transition: all 0.2s;
        }

        .form-select:focus {
            outline: none;
            border-color: #39746E;
        }

        .file-input-container {
            position: relative;
        }

        .file-input {
            position: absolute;
            opacity: 0;
            width: 100%;
            height: 100%;
            cursor: pointer;
        }

        .file-input-label {
            display: block;
            padding: 12px;
            border: 2px dashed #E5E6E6;
            border-radius: 8px;
            text-align: center;
            font-family: 'Urbanist', sans-serif;
            font-size: 14px;
            color: #6B7271;
            cursor: pointer;
            transition: all 0.2s;
        }

        .file-input-label:hover {
            border-color: #39746E;
            color: #39746E;
        }

        .file-input-label.has-file {
            border-color: #39746E;
            color: #39746E;
            background: #E3F4F1;
        }

        .preview-image {
            max-width: 200px;
            max-height: 200px;
            border-radius: 8px;
            margin-top: 12px;
        }

        .form-help {
            font-family: 'Urbanist', sans-serif;
            font-size: 12px;
            color: #6B7271;
            margin-top: 4px;
        }

        .error-message {
            color: #F73541;
            font-size: 12px;
            margin-top: 4px;
        }

        .price-info {
            background: #E3F4F1;
            border: 1px solid #39746E;
            border-radius: 8px;
            padding: 16px;
            margin-bottom: 16px;
        }

        .price-info h4 {
            font-family: 'Urbanist', sans-serif;
            font-size: 14px;
            font-weight: 600;
            color: #39746E;
            margin-bottom: 8px;
        }

        .price-info p {
            font-family: 'Urbanist', sans-serif;
            font-size: 12px;
            color: #6B7271;
            margin-bottom: 4px;
        }

        /* Loading Overlay Styles */
        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        .loading-content {
            background: white;
            padding: 2rem;
            border-radius: 8px;
            text-align: center;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .loading-spinner-large {
            width: 40px;
            height: 40px;
            border: 4px solid #f3f3f3;
            border-top: 4px solid #00B6A0;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin: 0 auto 1rem auto;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Button Loading State */
        .btn-upload.loading {
            position: relative;
            color: transparent;
        }

        .btn-upload.loading::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 16px;
            height: 16px;
            border: 2px solid transparent;
            border-top: 2px solid #DFF0EE;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }
    </style>
</head>
<body>
    <!-- Loading Overlay -->
    <div class="loading-overlay" id="pageLoadingOverlay" style="display: none;">
        <div class="loading-content">
            <div class="loading-spinner-large"></div>
            <p style="margin-top: 1rem; font-family: 'Urbanist', sans-serif; color: #374151;">Memuat data...</p>
        </div>
    </div>

    <header class="header">
        <div class="header-left">
            <h1>Sampah</h1>
            <span class="header-separator">/</span>
            <span class="header-subtitle">Tambah Sampah</span>
        </div>
        <div class="user-info">
            <div class="notification"></div>
            <span class="user-name">{{ Auth::guard('admin')->user()->role ?? 'Admin' }}</span>
            <div class="user-avatar">{{ strtoupper(substr(Auth::guard('admin')->user()->name ?? 'AD', 0, 2)) }}</div>
        </div>
    </header>

    <div class="main-container">
        <div class="form-container">
            <div class="form-header">
                <h2 class="form-title">Sampah Baru</h2>
                <div class="form-actions">
                    <button type="button" class="btn-cancel" onclick="goBack()">Kembali</button>
                    <button type="submit" class="btn-upload" id="submitBtn" onclick="submitForm()">Simpan Sampah</button>
                </div>
            </div>

            <form id="sampahForm" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="form-label">Nama Sampah *</label>
                    <input type="text" class="form-input" name="nama" placeholder="Masukkan nama sampah" required>
                    <div class="error-message" id="nama_error"></div>
                </div>

                <div class="form-group">
                    <label class="form-label">Deskripsi</label>
                    <textarea class="form-textarea" name="deskripsi" placeholder="Masukkan deskripsi sampah"></textarea>
                    <div class="error-message" id="deskripsi_error"></div>
                </div>

                <div class="form-group">
                    <label class="form-label">Gambar</label>
                    <div class="file-input-container">
                        <input type="file" class="file-input" id="gambar" name="gambar" accept="image/*">
                        <label for="gambar" class="file-input-label" id="fileLabel">
                            <span id="fileText">Klik untuk memilih gambar atau drag & drop</span>
                        </label>
                    </div>
                    <div class="form-help">Format: JPG, PNG, GIF. Maksimal 2MB</div>
                    <div class="error-message" id="gambar_error"></div>
                    <img id="preview" class="preview-image" style="display: none;">
                </div>

                <div class="form-group">
                    <label class="form-label">Satuan *</label>
                    <select class="form-select" name="satuan" required>
                        <option value="">Pilih satuan</option>
                        <option value="kg">Kilogram (kg)</option>
                        <option value="unit">Unit</option>
                    </select>
                    <div class="error-message" id="satuan_error"></div>
                </div>

                <div class="price-info">
                    <h4>Harga Awal</h4>
                    <p>Harga ini akan diterapkan ke semua bank sampah yang ada.</p>
                    <p>Anda dapat mengubah harga per bank sampah nanti di menu pengaturan harga.</p>
                </div>

                <div class="form-group">
                    <label class="form-label">Harga Awal *</label>
                    <input type="number" class="form-input" name="first_price" placeholder="Masukkan harga awal" min="0" step="100" required>
                    <div class="form-help">Harga dalam Rupiah</div>
                    <div class="error-message" id="first_price_error"></div>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Loading utility functions
        function showLoading(message = 'Memuat data...') {
            const overlay = document.getElementById('pageLoadingOverlay');
            const loadingText = overlay.querySelector('p');
            loadingText.textContent = message;
            overlay.style.display = 'flex';
        }

        function hideLoading() {
            const overlay = document.getElementById('pageLoadingOverlay');
            overlay.style.display = 'none';
        }

        function showButtonLoading() {
            const submitBtn = document.getElementById('submitBtn');
            submitBtn.classList.add('loading');
            submitBtn.disabled = true;
        }

        function hideButtonLoading() {
            const submitBtn = document.getElementById('submitBtn');
            submitBtn.classList.remove('loading');
            submitBtn.disabled = false;
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Show loading on initial page load
            showLoading('Memuat data...');
            
            // Hide loading after a short delay to simulate loading
            setTimeout(() => {
                hideLoading();
            }, 500);
        });

        // File input handling
        document.getElementById('gambar').addEventListener('change', function(e) {
            const file = e.target.files[0];
            const label = document.getElementById('fileLabel');
            const text = document.getElementById('fileText');
            const preview = document.getElementById('preview');

            if (file) {
                text.textContent = file.name;
                label.classList.add('has-file');

                // Show preview
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                }
                reader.readAsDataURL(file);
            } else {
                text.textContent = 'Klik untuk memilih gambar atau drag & drop';
                label.classList.remove('has-file');
                preview.style.display = 'none';
            }
        });

        function goBack() {
            window.history.back();
        }

        function submitForm() {
            // Clear previous errors
            document.getElementById('nama_error').textContent = '';
            document.getElementById('deskripsi_error').textContent = '';
            document.getElementById('gambar_error').textContent = '';
            document.getElementById('satuan_error').textContent = '';
            document.getElementById('first_price_error').textContent = '';
            
            const form = document.getElementById('sampahForm');
            const formData = new FormData(form);
            
            // Show loading states
            showButtonLoading();
            showLoading('Menyimpan data...');
            
            fetch('{{ route("dashboard.sampah.store") }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                hideLoading();
                hideButtonLoading();
                
                if (data.success) {
                    alert('Sampah berhasil dibuat!');
                    window.location.href = '{{ route("dashboard.sampah") }}';
                } else {
                    alert('Gagal membuat sampah: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                hideLoading();
                hideButtonLoading();
                alert('Terjadi kesalahan saat membuat sampah');
            });
        }
    </script>
</body>
</html>
@endsection 