@extends('dashboard')
@section('content')
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kategori - Admin Panel</title>
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

        .sampah-container {
            border: 1px solid #E5E6E6;
            border-radius: 8px;
            padding: 16px;
            background: #F8F9FA;
        }

        .sampah-list {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-bottom: 16px;
        }

        .sampah-tag {
            background: #E3F4F1;
            color: #39746E;
            padding: 6px 12px;
            border-radius: 16px;
            font-size: 14px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .sampah-tag .remove-btn {
            background: none;
            border: none;
            color: #39746E;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            padding: 0;
            width: 16px;
            height: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .sampah-input-group {
            display: flex;
            gap: 8px;
        }

        .sampah-input {
            flex: 1;
            padding: 8px 12px;
            border: 1px solid #E5E6E6;
            border-radius: 6px;
            font-family: 'Urbanist', sans-serif;
            font-size: 14px;
            color: #1e293b;
            background: #fff;
        }

        .sampah-input:focus {
            outline: none;
            border-color: #39746E;
        }

        .btn-add-sampah {
            padding: 8px 16px;
            background: #39746E;
            border: none;
            border-radius: 6px;
            font-family: 'Urbanist', sans-serif;
            font-size: 14px;
            font-weight: 600;
            color: #DFF0EE;
            cursor: pointer;
            transition: all 0.2s;
        }

        .btn-add-sampah:hover {
            background: #2d5a55;
        }

        .btn-add-sampah:disabled {
            background: #6B7271;
            cursor: not-allowed;
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
            <h1>Kategori</h1>
            <span class="header-separator">/</span>
            <span class="header-subtitle">Edit Kategori</span>
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
                <h2 class="form-title">Edit Kategori</h2>
                <div class="form-actions">
                    <button type="button" class="btn-cancel" onclick="window.history.back()">Kembali</button>
                    <button type="submit" class="btn-upload" onclick="submitForm()">Update Kategori</button>
                </div>
            </div>

            <form id="categoryForm">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label class="form-label">Nama Kategori *</label>
                    <input type="text" class="form-input" name="nama" value="{{ $category->nama }}" placeholder="Masukkan nama kategori" required>
                    <div class="error-message" id="nama_error"></div>
                </div>

                <div class="form-group">
                    <label class="form-label">Daftar Sampah *</label>
                    <div class="sampah-container">
                        <div class="sampah-list" id="sampahList">
                            <!-- Sampah items will be added here -->
                        </div>
                        <div class="sampah-input-group">
                            <select class="sampah-input" id="sampahSelect">
                                <option value="">Pilih sampah</option>
                                @foreach($sampahList as $sampah)
                                    <option value="{{ $sampah->id }}">{{ $sampah->nama }} ({{ strtoupper($sampah->satuan) }})</option>
                                @endforeach
                            </select>
                            <button type="button" class="btn-add-sampah" onclick="addSampah()">Tambah</button>
                        </div>
                        <div class="form-help">Minimal 1 jenis sampah harus ditambahkan</div>
                        <div class="error-message" id="sampah_error"></div>
                    </div>
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

        let sampahItems = @json($category->sampahItems->map(function($item) { return ['id' => $item->id, 'name' => $item->nama . ' (' . strtoupper($item->satuan) . ')']; }));

        function addSampah() {
            const select = document.getElementById('sampahSelect');
            const selectedOption = select.options[select.selectedIndex];
            
            if (select.value === '') {
                alert('Pilih sampah terlebih dahulu');
                return;
            }
            
            const sampahId = select.value;
            const sampahName = selectedOption.text;
            
            if (sampahItems.some(item => item.id == sampahId)) {
                alert('Sampah ini sudah ditambahkan');
                return;
            }
            
            sampahItems.push({
                id: sampahId,
                name: sampahName
            });
            
            select.value = '';
            renderSampahList();
            updateSubmitButton();
        }

        function removeSampah(index) {
            sampahItems.splice(index, 1);
            renderSampahList();
            updateSubmitButton();
        }

        function renderSampahList() {
            const container = document.getElementById('sampahList');
            container.innerHTML = '';
            
            sampahItems.forEach((item, index) => {
                const tag = document.createElement('div');
                tag.className = 'sampah-tag';
                tag.innerHTML = `
                    ${item.name}
                    <button type="button" class="remove-btn" onclick="removeSampah(${index})">&times;</button>
                `;
                container.appendChild(tag);
            });
        }

        function updateSubmitButton() {
            const submitBtn = document.querySelector('.btn-upload');
            if (sampahItems.length === 0) {
                submitBtn.disabled = true;
                submitBtn.style.opacity = '0.5';
            } else {
                submitBtn.disabled = false;
                submitBtn.style.opacity = '1';
            }
        }

        function submitForm() {
            // Show loading for form submission
            showLoading('Mengupdate kategori...');
            
            // Clear previous errors
            document.getElementById('nama_error').textContent = '';
            document.getElementById('sampah_error').textContent = '';
            
            const nama = document.querySelector('input[name="nama"]').value.trim();
            
            if (nama === '') {
                document.getElementById('nama_error').textContent = 'Nama kategori harus diisi';
                return;
            }
            
            if (sampahItems.length === 0) {
                document.getElementById('sampah_error').textContent = 'Minimal 1 jenis sampah harus ditambahkan';
                return;
            }
            
            const formData = new FormData();
            formData.append('_method', 'PUT');
            formData.append('nama', nama);
            sampahItems.forEach(item => {
                formData.append('sampah_ids[]', item.id);
            });
            
            fetch('{{ route("dashboard.category.update", $category->id) }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                hideLoading();
                if (data.success) {
                    alert('Kategori berhasil diupdate!');
                    window.location.href = '{{ route("dashboard.category") }}';
                } else {
                    alert('Gagal mengupdate kategori: ' + data.message);
                }
            })
            .catch(error => {
                hideLoading();
                console.error('Error:', error);
                alert('Terjadi kesalahan saat mengupdate kategori');
            });
        }

        // Initialize
        renderSampahList();
        updateSubmitButton();
    </script>
</body>
</html>
@endsection 