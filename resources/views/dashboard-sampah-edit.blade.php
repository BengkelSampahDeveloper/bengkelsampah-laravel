@extends('dashboard')
@section('content')
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Sampah - Admin Panel</title>
    <link href="https://fonts.googleapis.com/css2?family=Urbanist:wght@400;500;600;700;900&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css" rel="stylesheet"/>
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

        .file-input-label.dragover {
            background-color: #f0f9ff;
            border-color: #39746E;
            transform: scale(1.02);
        }

        .current-image {
            max-width: 200px;
            max-height: 200px;
            border-radius: 8px;
            margin-top: 8px;
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

        .price-list {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .price-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 8px 12px;
            background: #F8F9FA;
            border-radius: 6px;
            font-size: 14px;
        }

        .price-item .bank-name {
            font-weight: 500;
            color: #374151;
        }

        .price-item .price-value {
            color: #39746E;
            font-weight: 600;
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

    <!-- Modal Crop -->
    <div id="cropModal" style="display:none;position:fixed;z-index:9999;top:0;left:0;width:100vw;height:100vh;background:rgba(0,0,0,0.7);align-items:center;justify-content:center;">
      <div style="background:#fff;padding:20px;border-radius:8px;max-width:90vw;max-height:90vh;">
        <img id="cropImage" style="max-width:80vw;max-height:70vh;">
        <div style="margin-top:10px;text-align:right;display:flex;gap:8px;justify-content:flex-end;">
          <button type="button" id="cropCancelBtn" style="padding:8px 16px;background:transparent;border:1px solid #FDCED1;border-radius:8px;font-family:'Urbanist',sans-serif;font-size:14px;font-weight:600;color:#F73541;cursor:pointer;transition:all 0.2s;">Batal</button>
          <button type="button" id="cropOkBtn" style="padding:8px 16px;background:#39746E;border:none;border-radius:8px;font-family:'Urbanist',sans-serif;font-size:14px;font-weight:600;color:#DFF0EE;cursor:pointer;transition:all 0.2s;">OK</button>
        </div>
      </div>
    </div>

    <header class="header">
        <div class="header-left">
            <h1>Sampah</h1>
            <span class="header-separator">/</span>
            <span class="header-subtitle">Edit Sampah</span>
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
                <h2 class="form-title">Edit Sampah</h2>
                <div class="form-actions">
                    <button type="button" class="btn-cancel" onclick="goBack()">Kembali</button>
                    <button type="submit" class="btn-upload" id="submitBtn" onclick="submitForm()">Update Sampah</button>
                </div>
            </div>

            <form id="sampahForm" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label class="form-label">Nama Sampah *</label>
                    <input type="text" class="form-input" name="nama" value="{{ $sampah->nama }}" placeholder="Masukkan nama sampah" required>
                    <div class="error-message" id="nama_error"></div>
                </div>

                <div class="form-group">
                    <label class="form-label">Deskripsi</label>
                    <textarea class="form-textarea" name="deskripsi" placeholder="Masukkan deskripsi sampah">{{ $sampah->deskripsi }}</textarea>
                    <div class="error-message" id="deskripsi_error"></div>
                </div>

                <div class="form-group">
                    <label class="form-label">Gambar</label>
                    @if($sampah->gambar)
                        <div style="margin-bottom: 12px;">
                            <label class="form-label">Gambar Saat Ini:</label>
                            <img src="{{ $sampah->gambar }}" alt="Current cover" class="current-image" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                            <div style="width:200px;height:200px;background:#f3f4f6;border-radius:8px;display:none;align-items:center;justify-content:center;color:#9ca3af;font-size:14px;text-align:center;">No Image</div>
                        </div>
                    @else
                        <div style="margin-bottom: 12px;">
                            <label class="form-label">Gambar Saat Ini:</label>
                            <div style="width:200px;height:200px;background:#f3f4f6;border-radius:8px;display:flex;align-items:center;justify-content:center;color:#9ca3af;font-size:14px;text-align:center;">No Image</div>
                        </div>
                    @endif
                    <div class="file-input-container">
                        <input type="file" class="file-input" id="gambar" name="gambar" accept="image/*">
                        <label for="gambar" class="file-input-label" id="fileLabel">
                            <span id="fileText">Klik untuk memilih gambar baru atau drag & drop</span>
                        </label>
                    </div>
                    <div class="form-help">Format: JPG, PNG, GIF. Maksimal 2MB. Kosongkan jika tidak ingin mengubah gambar.</div>
                    <div class="error-message" id="gambar_error"></div>
                    <img id="preview" class="preview-image" style="display: none;">
                </div>

                <div class="form-group">
                    <label class="form-label">Satuan *</label>
                    <select class="form-select" name="satuan" required>
                        <option value="">Pilih satuan</option>
                        <option value="kg" {{ $sampah->satuan == 'kg' ? 'selected' : '' }}>Kilogram (kg)</option>
                        <option value="unit" {{ $sampah->satuan == 'unit' ? 'selected' : '' }}>Unit</option>
                    </select>
                    <div class="error-message" id="satuan_error"></div>
                </div>

                <div class="price-info">
                    <h4>Harga per Bank Sampah</h4>
                    <p>Harga saat ini untuk setiap bank sampah:</p>
                    <div class="price-list">
                        @foreach($sampah->prices as $price)
                            <div class="price-item">
                                <span class="bank-name">{{ $price->bankSampah->nama_bank_sampah ?? '-' }}</span>
                                <span class="price-value">Rp {{ number_format($price->harga, 0, ',', '.') }}</span>
                            </div>
                        @endforeach
                    </div>
                    <p style="margin-top: 8px; font-size: 11px;">Untuk mengubah harga, gunakan menu pengaturan harga.</p>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>
    <script>
        let cropper;
        const input = document.getElementById('gambar');
        const modal = document.getElementById('cropModal');
        const cropImg = document.getElementById('cropImage');
        const preview = document.getElementById('preview');

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
            if (file) {
                const url = URL.createObjectURL(file);
                cropImg.src = url;
                modal.style.display = 'flex';
                if (cropper) cropper.destroy();
                setTimeout(() => {
                    cropper = new Cropper(cropImg, { viewMode: 1 });
                }, 100);
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
            
            const form = document.getElementById('sampahForm');
            const formData = new FormData(form);
            
            // Show loading states
            showButtonLoading();
            showLoading('Menyimpan data...');
            
            fetch('{{ route("dashboard.sampah.update", $sampah->id) }}', {
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
                    alert('Sampah berhasil diupdate!');
                    window.location.href = '{{ route("dashboard.sampah") }}';
                } else {
                    alert('Gagal mengupdate sampah: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                hideLoading();
                hideButtonLoading();
                alert('Terjadi kesalahan saat mengupdate sampah');
            });
        }

        // Crop modal event listeners
        document.getElementById('cropCancelBtn').onclick = function() {
            modal.style.display = 'none';
            if (cropper) cropper.destroy();
            input.value = '';
            preview.src = '';
            preview.style.display = 'none';
            document.getElementById('fileText').textContent = 'Klik untuk memilih gambar baru atau drag & drop';
            document.getElementById('fileLabel').classList.remove('has-file');
        };

        document.getElementById('cropOkBtn').onclick = function() {
            if (cropper) {
                cropper.getCroppedCanvas().toBlob(function(blob) {
                    const file = new File([blob], 'sampah-cropped.jpg', { type: 'image/jpeg' });
                    const dataTransfer = new DataTransfer();
                    dataTransfer.items.add(file);
                    input.files = dataTransfer.files;
                    const url = URL.createObjectURL(blob);
                    preview.src = url;
                    preview.style.display = 'block';
                    document.getElementById('fileText').textContent = file.name;
                    document.getElementById('fileLabel').classList.add('has-file');
                    modal.style.display = 'none';
                    cropper.destroy();
                }, 'image/jpeg');
            }
        };

        // Drag and drop functionality
        const fileLabel = document.getElementById('fileLabel');
        
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            fileLabel.addEventListener(eventName, preventDefaults, false);
        });
        
        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }
        
        ['dragenter', 'dragover'].forEach(eventName => {
            fileLabel.addEventListener(eventName, highlight, false);
        });
        
        ['dragleave', 'drop'].forEach(eventName => {
            fileLabel.addEventListener(eventName, unhighlight, false);
        });
        
        function highlight(e) {
            fileLabel.classList.add('dragover');
        }
        
        function unhighlight(e) {
            fileLabel.classList.remove('dragover');
        }
        
        fileLabel.addEventListener('drop', handleDrop, false);
        
        function handleDrop(e) {
            const dt = e.dataTransfer;
            const files = dt.files;
            
            if (files.length > 0) {
                document.getElementById('gambar').files = files;
                // Trigger the change event
                const event = new Event('change', { bubbles: true });
                document.getElementById('gambar').dispatchEvent(event);
            }
        }
    </script>
</body>
</html>
@endsection 