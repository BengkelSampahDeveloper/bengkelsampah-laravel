@extends('dashboard')

@section('title', 'Tambah Redeem')

@section('content')
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Redeem - Admin Panel</title>
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
            padding: 1rem 2rem 0rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .header h1 {
            font-family: 'Urbanist', sans-serif;
            font-size: 22px;
            font-weight: 700;
            color: #39746E;
        }

        .header-separator {
            font-family: 'Urbanist', sans-serif;
            font-size: 22px;
            font-weight: 700;
            color: #6B7271;
        }

        .header-subtitle {
            font-family: 'Urbanist', sans-serif;
            font-size: 22px;
            font-weight: 400;
            color: #6B7271;
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
            max-width: 1400px;
            margin: 1rem 2rem 1rem 2rem;
            background: #fff;
            border: 1px solid #E5E6E6;
            border-radius: 16px;
            padding: 24px;
        }

        .form-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #E5E6E6;
        }

        .form-title {
            font-family: 'Urbanist', sans-serif;
            font-size: 20px;
            font-weight: 700;
            color: #39746E;
        }

        .form-actions {
            display: flex;
            gap: 1rem;
        }

        .btn-cancel {
            padding: 8px 16px;
            background: transparent;
            border: 1px solid #E5E6E6;
            border-radius: 8px;
            font-family: 'Urbanist', sans-serif;
            font-size: 14px;
            font-weight: 600;
            color: #6B7271;
            cursor: pointer;
            transition: all 0.2s;
        }

        .btn-cancel:hover {
            background: #F8F9FA;
        }

        .btn-submit {
            padding: 8px 16px;
            background: #39746E;
            border: 1px solid #39746E;
            border-radius: 8px;
            font-family: 'Urbanist', sans-serif;
            font-size: 14px;
            font-weight: 600;
            color: #DFF0EE;
            cursor: pointer;
            transition: all 0.2s;
        }

        .btn-submit:hover {
            background: #2d5a55;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: #39746E;
            font-size: 14px;
            font-family: 'Urbanist', sans-serif;
        }

        .form-input {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid #E5E6E6;
            border-radius: 8px;
            font-size: 14px;
            font-family: 'Urbanist', sans-serif;
            transition: all 0.2s;
        }

        .form-input:focus {
            outline: none;
            border-color: #0FB7A6;
            box-shadow: 0 0 0 2px rgba(15, 183, 166, 0.1);
        }

        .form-input::placeholder {
            color: #6B7271;
            font-family: 'Urbanist', sans-serif;
            font-size: 14px;
            font-weight: 400;
        }

        .search-box {
            position: relative;
            width: 100%;
            border-radius: 8px;
            border: 1px solid #E5E6E6;
            background: #fff;
            display: flex;
            align-items: center;
        }

        .search-input {
            width: 100%;
            border: none;
            outline: none;
            background: transparent;
            font-family: 'Urbanist', sans-serif;
            font-size: 14px;
            font-weight: 400;
            color: #1e293b;
            padding: 12px 40px 12px 16px;
            border-radius: 8px;
        }

        .search-input::placeholder {
            color: #6B7271;
            font-family: 'Urbanist', sans-serif;
            font-size: 14px;
            font-weight: 400;
        }

        .search-icon {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            width: 20px;
            height: 20px;
            pointer-events: none;
        }

        .list-group {
            border: 1px solid #E5E6E6;
            border-radius: 8px;
            overflow: hidden;
            margin-top: 1rem;
        }

        .list-group-item {
            padding: 16px;
            border-bottom: 1px solid #E5E6E6;
            background: #fff;
            cursor: pointer;
            transition: all 0.2s;
        }

        .list-group-item:last-child {
            border-bottom: none;
        }

        .list-group-item:hover {
            background: #F8F9FA;
        }

        .list-group-item.selected {
            background: #E3F4F1;
            border-left: 4px solid #0FB7A6;
        }

        .user-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .user-info-left h6 {
            margin-bottom: 0.25rem;
            color: #39746E;
            font-weight: 600;
            font-size: 14px;
        }

        .user-info-left small {
            color: #6B7271;
            font-size: 12px;
        }

        .user-points {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .badge {
            padding: 4px 8px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
        }

        .badge-success {
            background: #D1F2EB;
            color: #0FB7A6;
        }

        .btn {
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 4px;
            cursor: pointer;
            border: none;
            transition: all 0.2s;
        }

        .btn-primary {
            background: #39746E;
            color: #DFF0EE;
        }

        .btn-primary:hover {
            background: #2d5a55;
        }

        .btn-success {
            background: #0FB7A6;
            color: #fff;
        }

        .btn-success:hover {
            background: #0a8a7e;
        }

        .btn-secondary {
            background: #6c757d;
            color: #fff;
        }

        .btn-secondary:hover {
            background: #5a6268;
        }

        .form-text {
            font-size: 12px;
            color: #6B7271;
            margin-top: 0.25rem;
        }

        .alert {
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 1rem;
            font-size: 14px;
        }

        .alert-success {
            background: #D1F2EB;
            color: #0a8a7e;
            border: 1px solid #A8E6D9;
        }

        .alert-danger {
            background: #FDCED1;
            color: #F73541;
            border: 1px solid #FBB5BC;
        }

        .alert-warning {
            background: #FFF3CD;
            color: #856404;
            border: 1px solid #FFEAA7;
        }

        .alert-info {
            background: #E3F4F1;
            color: #0FB7A6;
            border: 1px solid #D1F2EB;
        }

        .spinner-border {
            width: 2rem;
            height: 2rem;
        }

        .text-center {
            text-align: center;
        }

        .text-muted {
            color: #6B7271;
        }

        .py-4 {
            padding-top: 1.5rem;
            padding-bottom: 1.5rem;
        }

        .mb-3 {
            margin-bottom: 1rem;
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

        /* Responsive Design */
        @media (max-width: 768px) {
            .header {
                padding: 1rem;
                flex-direction: column;
                gap: 1rem;
                align-items: flex-start;
            }

            .main-container {
                margin: 0 1rem 1rem 1rem;
            }

            .form-actions {
                flex-direction: column;
            }

            .btn-cancel,
            .btn-submit {
                width: 100%;
                justify-content: center;
            }

            .header-left {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.25rem;
            }

            .user-info {
                align-self: flex-end;
            }
        }

        @media (max-width: 480px) {
            .header {
                padding: 0.75rem;
            }

            .main-container {
                margin: 0 0.75rem 0.75rem 0.75rem;
                padding: 16px;
            }
        }
    </style>
</head>
<body>
    <!-- Loading Overlay -->
    <div class="loading-overlay" id="pageLoadingOverlay" style="display: none;">
        <div class="loading-content">
            <div class="loading-spinner-large"></div>
            <p>Memuat...</p>
        </div>
    </div>

    <header class="header">
        <div class="header-left">
            <h1>Poin</h1>
            <span class="header-separator">/</span>
            <span class="header-subtitle">Tambah Redeem</span>
        </div>
        <div class="user-info">
            <div class="notification"></div>
            <span class="user-name">{{ Auth::guard('admin')->user()->role ?? 'Super Admin' }}</span>
            <div class="user-avatar">{{ strtoupper(substr(Auth::guard('admin')->user()->name ?? 'SA', 0, 2)) }}</div>
        </div>
    </header>

    <div class="main-container">
        <div class="form-header">
            <h2 class="form-title">Form Redeem Poin</h2>
            <div class="form-actions">
                <button type="button" class="btn-cancel" onclick="window.history.back()">Kembali</button>
                <button type="submit" class="btn-submit" onclick="submitForm()" id="submitBtn" style="display: none;">Proses Redeem</button>
            </div>
        </div>

        <!-- Search Section -->
        <div class="form-group">
            <label class="form-label">Cari User</label>
            <div class="search-box">
                <input type="text" class="search-input" id="searchUser" placeholder="Cari user berdasarkan nama atau identifier..." onkeypress="handleSearchKeypress(event)">
                <svg class="search-icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M21 21L16.514 16.506L21 21ZM19 10.5C19 15.194 15.194 19 10.5 19C5.806 19 2 15.194 2 10.5C2 5.806 5.806 2 10.5 2C15.194 2 19 5.806 19 10.5Z" stroke="#6B7271" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>
        </div>

        <!-- Search Results -->
        <div id="searchResults" style="display: none;">
            <h6 style="margin-bottom: 1rem; color: #39746E; font-weight: 600;">Hasil Pencarian:</h6>
            <div id="userList" class="list-group"></div>
        </div>

        <!-- Redeem Form -->
        <div id="redeemForm" style="display: none;">
            <form id="redeemPointForm" enctype="multipart/form-data">
                <input type="hidden" id="userId" name="user_id">
                
                <div class="form-group">
                    <label for="jumlahPoint" class="form-label">Jumlah Poin yang Diredeem</label>
                    <input type="number" class="form-input" id="jumlahPoint" name="jumlah_point" min="1" required>
                    <small class="form-text">Maksimal: <span id="maxPoints"></span> poin</small>
                </div>

                <div class="form-group">
                    <label for="alasanRedeem" class="form-label">Alasan Redeem</label>
                    <textarea class="form-input" id="alasanRedeem" name="alasan_redeem" rows="3" maxlength="500" required placeholder="Masukkan alasan redeem poin..."></textarea>
                    <small class="form-text">Maksimal 500 karakter</small>
                </div>

                <div class="form-group">
                    <label for="buktiRedeem" class="form-label">Bukti Redeem (Foto)</label>
                    <input type="file" class="form-input" id="buktiRedeem" name="bukti_redeem" accept="image/*" required>
                    <small class="form-text">Format: JPG, PNG, JPEG. Maksimal 2MB</small>
                </div>
            </form>
        </div>

        <!-- Alert Messages -->
        <div id="alertContainer"></div>
    </div>

    <script>
        let selectedUser = null;

        // Loading Functions
        function showLoading(message = 'Memuat...') {
            const overlay = document.getElementById('pageLoadingOverlay');
            overlay.querySelector('p').textContent = message;
            overlay.style.display = 'flex';
        }

        function hideLoading() {
            document.getElementById('pageLoadingOverlay').style.display = 'none';
        }

        function handleSearchKeypress(event) {
            if (event.key === 'Enter') {
                searchUser();
            }
        }

        function searchUser() {
            const query = document.getElementById('searchUser').value.trim();
            if (!query) {
                showAlert('Masukkan nama atau identifier user untuk mencari', 'warning');
                return;
            }

            showLoading('Mencari user...');
            
            fetch('/dashboard/poin/search-user', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ query: query })
            })
            .then(response => response.json())
            .then(data => {
                hideLoading();
                displaySearchResults(data);
            })
            .catch(error => {
                hideLoading();
                showAlert('Terjadi kesalahan saat mencari user', 'danger');
                console.error('Error:', error);
            });
        }

        function displaySearchResults(users) {
            const userList = document.getElementById('userList');
            const searchResults = document.getElementById('searchResults');
            
            if (users.length === 0) {
                userList.innerHTML = '<div class="alert alert-info">Tidak ada user yang ditemukan</div>';
                searchResults.style.display = 'block';
                return;
            }

            userList.innerHTML = '';
            users.forEach(user => {
                const userItem = document.createElement('div');
                userItem.className = 'list-group-item';
                userItem.innerHTML = `
                    <div class="user-item">
                        <div class="user-info-left">
                            <h6>${user.name}</h6>
                            <small>${user.identifier}</small>
                        </div>
                        <div class="user-points">
                            <span class="badge badge-success">${user.poin} Poin</span>
                            <button class="btn btn-primary" onclick="selectUser(${user.id})">
                                Pilih
                            </button>
                        </div>
                    </div>
                `;
                userList.appendChild(userItem);
            });
            
            searchResults.style.display = 'block';
        }

        function selectUser(userId) {
            showLoading('Mengambil data user...');
            
            fetch(`/dashboard/poin/user/${userId}`)
            .then(response => response.json())
            .then(data => {
                hideLoading();
                if (data.error) {
                    showAlert(data.error, 'danger');
                    return;
                }
                
                selectedUser = data;
                document.getElementById('userId').value = data.id;
                document.getElementById('maxPoints').textContent = data.poin;
                document.getElementById('jumlahPoint').max = data.poin;
                
                // Hide search results and show form
                document.getElementById('searchResults').style.display = 'none';
                document.getElementById('redeemForm').style.display = 'block';
                document.getElementById('submitBtn').style.display = 'inline-flex';
            })
            .catch(error => {
                hideLoading();
                showAlert('Terjadi kesalahan saat mengambil data user', 'danger');
                console.error('Error:', error);
            });
        }

        function submitForm() {
            if (!selectedUser) {
                showAlert('Pilih user terlebih dahulu', 'warning');
                return;
            }
            
            const form = document.getElementById('redeemPointForm');
            const formData = new FormData(form);
            const jumlahPoint = parseInt(formData.get('jumlah_point'));
            
            if (jumlahPoint > selectedUser.poin) {
                showAlert('Jumlah poin melebihi poin yang tersedia', 'danger');
                return;
            }
            
            if (jumlahPoint <= 0) {
                showAlert('Jumlah poin harus lebih dari 0', 'danger');
                return;
            }
            
            if (!confirm(`Apakah Anda yakin ingin melakukan redeem ${jumlahPoint} poin untuk user ${selectedUser.name}?`)) {
                return;
            }
            
            showLoading('Memproses redeem...');
            
            fetch('/dashboard/poin/process', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                hideLoading();
                if (data.success) {
                    showAlert(data.message, 'success');
                    // Redirect to redeem list after 2 seconds
                    setTimeout(() => {
                        window.location.href = '/dashboard/poin';
                    }, 2000);
                } else {
                    showAlert(data.error || 'Terjadi kesalahan', 'danger');
                }
            })
            .catch(error => {
                hideLoading();
                showAlert('Terjadi kesalahan saat memproses redeem', 'danger');
                console.error('Error:', error);
            });
        }

        function showAlert(message, type) {
            const alertContainer = document.getElementById('alertContainer');
            const alertId = 'alert-' + Date.now();
            
            const alert = document.createElement('div');
            alert.className = `alert alert-${type}`;
            alert.id = alertId;
            alert.innerHTML = `
                ${message}
                <button type="button" style="float: right; margin-left: 1rem; background: none; border: none; font-size: 18px; cursor: pointer;" onclick="this.parentElement.remove()">×</button>
            `;
            
            alertContainer.appendChild(alert);
            
            // Auto remove after 5 seconds
            setTimeout(() => {
                const alertElement = document.getElementById(alertId);
                if (alertElement) {
                    alertElement.remove();
                }
            }, 5000);
        }
    </script>
</body>
</html>
@endsection
