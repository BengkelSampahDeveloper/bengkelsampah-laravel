@extends('dashboard')
@section('content')
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Artikel - Admin Panel</title>
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

        .upload-area {
            border: 2px dashed #E5E6E6;
            border-radius: 8px;
            padding: 60px 20px;
            text-align: center;
            background: #fafafa;
            cursor: pointer;
            transition: all 0.2s;
        }

        .upload-area:hover {
            border-color: #39746E;
            background: #f0f9ff;
        }

        .upload-area.dragover {
            border-color: #39746E;
            background: #f0f9ff;
        }

        .upload-icon {
            width: 48px;
            height: 48px;
            margin: 0 auto 16px;
            opacity: 0.5;
        }

        .upload-text {
            font-family: 'Urbanist', sans-serif;
            font-size: 14px;
            font-weight: 500;
            color: #6B7271;
            margin-bottom: 4px;
        }

        .upload-subtext {
            font-family: 'Urbanist', sans-serif;
            font-size: 12px;
            color: #9CA3AF;
        }

        .file-input {
            display: none;
        }

        .image-preview {
            display: none;
            position: relative;
            max-width: 300px;
            margin: 16px auto 0;
        }

        .image-preview img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 8px;
        }

        .image-remove {
            position: absolute;
            top: 8px;
            right: 8px;
            width: 24px;
            height: 24px;
            background: rgba(0, 0, 0, 0.5);
            border: none;
            border-radius: 50%;
            color: white;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
        }

        .content-editor {
            min-height: 200px;
            border: 1px solid #E5E6E6;
            border-radius: 8px;
            padding: 12px;
            font-family: 'Urbanist', sans-serif;
            font-size: 14px;
            resize: vertical;
        }

        .content-editor:focus {
            outline: none;
            border-color: #39746E;
        }

        .category-sidebar {
            background: #fff;
            border: 1px solid #E5E6E6;
            border-radius: 16px;
            padding: 24px;
            width: 300px;
            height: fit-content;
        }

        .sidebar-title {
            font-family: 'Urbanist', sans-serif;
            font-size: 18px;
            font-weight: 700;
            color: #242E2C;
            margin-bottom: 16px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .sidebar-add-btn {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 8px 12px;
            background: transparent;
            border: 1px solid #39746E;
            border-radius: 8px;
            font-family: 'Urbanist', sans-serif;
            font-size: 14px;
            font-weight: 400;
            color: #39746E;
            cursor: pointer;
            transition: all 0.2s;
        }

        .sidebar-add-btn:hover {
            background: #39746E;
            color: white;
        }

        .sidebar-add-btn span:first-child {
            margin-left: 8px;
        }

        .category-list {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .category-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 8px 0;
        }

        .category-item-left {
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
        }

        .category-delete {
            width: 20px;
            height: 20px;
            cursor: pointer;
            opacity: 0.6;
            transition: opacity 0.2s;
        }

        .category-delete:hover {
            opacity: 1;
        }

        .category-radio {
            width: 16px;
            height: 16px;
            border-radius: 50%;
            border: 2px solid #E5E6E6;
            position: relative;
            cursor: pointer;
        }

        .category-radio.selected {
            border-color: #39746E;
        }

        .category-radio.selected::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 8px;
            height: 8px;
            background: #39746E;
            border-radius: 50%;
        }

        .category-label {
            font-family: 'Urbanist', sans-serif;
            font-size: 14px;
            color: #374151;
            cursor: pointer;
        }

        .char-count {
            font-family: 'Urbanist', sans-serif;
            font-size: 12px;
            color: #6B7271;
            text-align: right;
            margin-top: 4px;
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            .main-container {
                flex-direction: column;
                gap: 1rem;
            }
            
            .category-sidebar {
                width: 100%;
                order: -1;
            }
            
            .form-container {
                order: 1;
            }
        }

        @media (max-width: 768px) {
            .header {
                padding: 1rem;
                flex-direction: column;
                gap: 1rem;
                align-items: flex-start;
            }

            .main-container {
                margin: 0 1rem 1rem 1rem;
                flex-direction: column;
            }

            .form-container,
            .category-sidebar {
                padding: 16px;
                width: 100%;
            }

            .form-actions {
                flex-direction: column;
            }

            .btn-cancel,
            .btn-upload {
                width: 100%;
                justify-content: center;
            }

            .upload-area {
                padding: 40px 20px;
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
                flex-direction: column;
            }

            .form-container,
            .category-sidebar {
                padding: 12px;
                width: 100%;
            }

            .upload-area {
                padding: 30px 15px;
            }

            .upload-icon {
                width: 40px;
                height: 40px;
            }
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            animation: fadeIn 0.3s ease;
        }

        .modal.show {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .modal-content {
            background: white;
            border-radius: 20px;
            padding: 16px;
            max-width: 500px;
            width: 90%;
            text-align: center;
            position: relative;
            animation: slideIn 0.3s ease;
        }

        @keyframes slideIn {
            from { transform: translateY(-50px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        .modal-icon {
            width: 46px;
            height: 46px;
            margin: 20px 0 12px;
        }

        .modal-title {
            font-family: 'Urbanist', sans-serif;
            font-size: 18px;
            font-weight: 700;
            color: #242E2C;
            margin-bottom: 4px;
        }

        .modal-subtitle {
            font-family: 'Urbanist', sans-serif;
            font-size: 14px;
            font-weight: 400;
            color: #6B7271;
            margin-bottom: 20px;
        }

        .modal-close {
            position: absolute;
            top: 16px;
            right: 20px;
            background: none;
            border: none;
            width: 18px;
            height: 18px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 25%;
            transition: background-color 0.2s ease;
        }

        .modal-close:hover {
            background-color: #f3f4f6;
        }

        .modal-close img {
            width: 18px;
            height: 18px;
        }

        .modal-buttons {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .modal-button {
            width: 100%;
            padding: 8px;
            border-radius: 8px;
            font-family: 'Urbanist', sans-serif;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
        }

        .cancel-button {
            background: transparent;
            border: 1px solid #FDCED1;
            color: #F73541;
        }

        .confirm-button {
            background: #F73541;
            border: none;
            color: white;
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
            <p>Memuat...</p>
        </div>
    </div>

    <header class="header">
        <div class="header-left">
            <h1>Artikel</h1>
            <span class="header-separator">/</span>
            <span class="header-subtitle">Tambah Artikel</span>
        </div>
        <div class="user-info">
            <div class="notification"></div>
            <span class="user-name">{{ Auth::guard('admin')->user()->role ?? 'Super Admin' }}</span>
            <div class="user-avatar">{{ strtoupper(substr(Auth::guard('admin')->user()->name ?? 'SA', 0, 2)) }}</div>
        </div>
    </header>

    <div class="main-container">
        <div class="form-container">
            <div class="form-header">
                <h2 class="form-title">Artikel Baru</h2>
                <div class="form-actions">
                    <button type="button" class="btn-cancel" onclick="window.history.back()">Kembali</button>
                    <button type="submit" class="btn-upload" onclick="submitForm()">Upload</button>
                </div>
            </div>

            <form id="articleForm" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="form-label">Judul Artikel</label>
                    <input type="text" class="form-input" name="title" placeholder="Judul Disini" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Cover Artikel</label>
                    <div class="upload-area" onclick="triggerFileInput()">
                        <div class="upload-icon">
                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <polyline points="7,10 12,15 17,10" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <line x1="12" y1="15" x2="12" y2="3" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                            </svg>
                        </div>
                        <div class="upload-text">Pilih Gambar untuk artikel</div>
                        <div class="upload-subtext">Format: JPG, PNG, WebP (Max: 2MB)</div>
                    </div>
                    <input type="file" id="coverInput" name="cover" class="file-input" accept="image/*" onchange="previewImage(this)">
                    <div class="image-preview" id="imagePreview">
                        <img id="previewImg" src="" alt="Preview">
                        <button type="button" class="image-remove" onclick="removeImage()">&times;</button>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Konten Artikel</label>
                    <textarea class="form-input content-editor" name="content" placeholder="Isi konten disini sesuka hati" rows="10" oninput="updateCharCount(this)" required></textarea>
                    <div class="char-count" id="charCount">0 karakter</div>
                </div>
            </form>
        </div>

        <div class="category-sidebar">
            <div class="sidebar-title">
                <h3>Kategori</h3>
                <button type="button" class="sidebar-add-btn" onclick="showAddCategoryModal()">
                    <span>Tambah</span>
                    <span>+</span>
                </button>
            </div>
            <div class="category-list" id="categoryList">
                @foreach ($kategoris ?? [] as $kategori)
                <div class="category-item">
                    <div class="category-item-left" onclick="selectCategory({{ $kategori->id }})">
                        <div class="category-radio" id="radio-{{ $kategori->id }}"></div>
                        <span class="category-label">{{ $kategori->nama }}</span>
                    </div>
                    <img src="{{ asset('icon/ic_delete.svg') }}" alt="Delete" class="category-delete" onclick="deleteCategory({{ $kategori->id }})">
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Add Category Modal -->
    <div class="modal" id="addCategoryModal">
        <div class="modal-content">
            <button class="modal-close" onclick="closeAddCategoryModal()">
                <img src="{{ asset('icon/ic_close.svg') }}" alt="Close">
            </button>
            <img src="{{ asset('icon/ic_dialog_add.svg') }}" alt="Add" class="modal-icon">
            <h2 class="modal-title">Tambah Kategori</h2>
            <p class="modal-subtitle">Masukkan nama kategori baru</p>
            <div class="form-group" style="margin: 20px 0;">
                <input type="text" class="form-input" id="newCategoryName" placeholder="Masukkan nama kategori">
            </div>
            <div class="modal-buttons">
                <button class="modal-button cancel-button" onclick="closeAddCategoryModal()">Batal</button>
                <button class="modal-button confirm-button" onclick="addNewCategory()" style="background: #39746E;">Tambah</button>
            </div>
        </div>
    </div>

    <!-- Delete Category Modal -->
    <div class="modal" id="deleteCategoryModal">
        <div class="modal-content">
            <button class="modal-close" onclick="closeDeleteCategoryModal()">
                <img src="{{ asset('icon/ic_close.svg') }}" alt="Close">
            </button>
            <img src="{{ asset('icon/ic_dialog_delete.svg') }}" alt="Delete" class="modal-icon">
            <h2 class="modal-title">Hapus Kategori</h2>
            <p class="modal-subtitle" id="deleteCategoryMessage">Apakah Anda yakin ingin menghapus kategori ini?</p>
            <div class="modal-buttons">
                <button class="modal-button cancel-button" onclick="closeDeleteCategoryModal()">Batal</button>
                <button class="modal-button confirm-button" onclick="confirmDeleteCategory()" id="confirmDeleteBtn">Hapus</button>
            </div>
        </div>
    </div>

    <script>
        let selectedCategoryId = null;
        let categoryToDelete = null;

        // Loading Functions
        function showLoading(message = 'Memuat...') {
            const overlay = document.getElementById('pageLoadingOverlay');
            overlay.querySelector('p').textContent = message;
            overlay.style.display = 'flex';
        }

        function hideLoading() {
            document.getElementById('pageLoadingOverlay').style.display = 'none';
        }

        function triggerFileInput() {
            document.getElementById('coverInput').click();
        }

        function previewImage(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('previewImg').src = e.target.result;
                    document.getElementById('imagePreview').style.display = 'block';
                    document.querySelector('.upload-area').style.display = 'none';
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        function removeImage() {
            document.getElementById('coverInput').value = '';
            document.getElementById('imagePreview').style.display = 'none';
            document.querySelector('.upload-area').style.display = 'block';
        }

        function selectCategory(categoryId) {
            // Remove previous selection
            document.querySelectorAll('.category-radio').forEach(radio => {
                radio.classList.remove('selected');
            });
            
            // Add selection to clicked category
            document.getElementById('radio-' + categoryId).classList.add('selected');
            selectedCategoryId = categoryId;
        }

        function updateCharCount(textarea) {
            const count = textarea.value.length;
            document.getElementById('charCount').textContent = count + ' karakter';
        }

        function showAddCategoryModal() {
            document.getElementById('addCategoryModal').classList.add('show');
        }

        function closeAddCategoryModal() {
            document.getElementById('addCategoryModal').classList.remove('show');
            document.getElementById('newCategoryName').value = '';
        }

        function addNewCategory() {
            const categoryName = document.getElementById('newCategoryName').value.trim();
            if (!categoryName) {
                alert('Nama kategori tidak boleh kosong');
                return;
            }

            // Close modal first
            closeAddCategoryModal();

            // Show loading
            showLoading('Menambahkan kategori...');

            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            
            fetch('/dashboard/kategori', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                },
                body: JSON.stringify({
                    nama: categoryName
                })
            })
            .then(response => {
                console.log('Response status:', response.status);
                return response.json().then(data => {
                    if (!response.ok) {
                        throw new Error(data.message || 'Network response was not ok');
                    }
                    return data;
                });
            })
            .then(data => {
                console.log('Success data:', data);
                if (data.success) {
                    // Add new category to the list
                    const categoryList = document.getElementById('categoryList');
                    const newCategoryItem = document.createElement('div');
                    newCategoryItem.className = 'category-item';
                    newCategoryItem.innerHTML = `
                        <div class="category-item-left" onclick="selectCategory(${data.category.id})">
                            <div class="category-radio" id="radio-${data.category.id}"></div>
                            <span class="category-label">${data.category.nama}</span>
                        </div>
                        <img src="/icon/ic_red_delete.svg" alt="Delete" class="category-delete" onclick="deleteCategory(${data.category.id})">
                    `;
                    categoryList.appendChild(newCategoryItem);
                    
                    alert('Kategori berhasil ditambahkan');
                } else {
                    alert(data.message || 'Gagal menambahkan kategori');
                }
            })
            .catch(error => {
                console.error('Error details:', error);
                alert('Gagal menambahkan kategori: ' + error.message);
            })
            .finally(() => {
                hideLoading();
            });
        }

        function deleteCategory(categoryId) {
            categoryToDelete = categoryId;
            // Reset modal content
            document.getElementById('deleteCategoryMessage').textContent = 'Apakah Anda yakin ingin menghapus kategori ini?';
            document.getElementById('confirmDeleteBtn').textContent = 'Hapus';
            document.getElementById('confirmDeleteBtn').onclick = confirmDeleteCategory;
            document.getElementById('deleteCategoryModal').classList.add('show');
        }

        function closeDeleteCategoryModal() {
            document.getElementById('deleteCategoryModal').classList.remove('show');
            categoryToDelete = null;
        }

        function confirmDeleteCategory() {
            if (!categoryToDelete) return;

            // Close modal first
            closeDeleteCategoryModal();

            // Show loading
            showLoading('Menghapus kategori...');

            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            
            fetch(`/dashboard/kategori/${categoryToDelete}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Success - remove category from list
                    const categoryItem = document.querySelector(`[onclick="selectCategory(${categoryToDelete})"]`).parentElement;
                    categoryItem.remove();
                    alert('Kategori berhasil dihapus');
                } else if (data.has_articles) {
                    // Category has articles - show warning and ask for confirmation
                    document.getElementById('deleteCategoryMessage').textContent = data.message;
                    document.getElementById('confirmDeleteBtn').textContent = 'Hapus Semua';
                    document.getElementById('confirmDeleteBtn').onclick = forceDeleteCategory;
                    document.getElementById('deleteCategoryModal').classList.add('show');
                } else {
                    alert(data.message || 'Gagal menghapus kategori');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Gagal menghapus kategori. Silakan coba lagi.');
            })
            .finally(() => {
                hideLoading();
            });
        }

        function forceDeleteCategory() {
            if (!categoryToDelete) return;

            // Close modal first
            closeDeleteCategoryModal();

            // Show loading
            showLoading('Menghapus kategori dan artikel...');

            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            
            fetch(`/dashboard/kategori/${categoryToDelete}/force`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Success - remove category from list
                    const categoryItem = document.querySelector(`[onclick="selectCategory(${categoryToDelete})"]`).parentElement;
                    categoryItem.remove();
                    alert(data.message);
                } else {
                    alert(data.message || 'Gagal menghapus kategori');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Gagal menghapus kategori. Silakan coba lagi.');
            })
            .finally(() => {
                hideLoading();
            });
        }

        function submitForm() {
            const form = document.getElementById('articleForm');
            const formData = new FormData(form);
            
            // Validate required fields
            const title = formData.get('title');
            const content = formData.get('content');
            const cover = formData.get('cover');
            
            if (!title) {
                alert('Judul artikel tidak boleh kosong');
                return;
            }
            
            if (!content) {
                alert('Isi artikel tidak boleh kosong');
                return;
            }
            
            if (!cover) {
                alert('Cover artikel tidak boleh kosong');
                return;
            }
            
            if (!selectedCategoryId) {
                alert('Silakan pilih kategori artikel');
                return;
            }
            
            // Show loading
            showLoading('Menyimpan artikel...');
            
            formData.append('kategori_id', selectedCategoryId);
            
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            
            fetch('/dashboard/artikel', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                },
                body: formData
            })
            .then(response => {
                if (!response.ok) {
                    return response.json().then(data => {
                        throw new Error(data.message || 'Network response was not ok');
                    });
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    alert('Artikel berhasil ditambahkan');
                    window.location.href = '/dashboard/artikel';
                } else {
                    alert(data.message || 'Gagal menambahkan artikel');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Gagal menambahkan artikel: ' + error.message);
            })
            .finally(() => {
                hideLoading();
            });
        }

        // Drag and drop functionality
        const uploadArea = document.querySelector('.upload-area');
        
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            uploadArea.addEventListener(eventName, preventDefaults, false);
        });
        
        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }
        
        ['dragenter', 'dragover'].forEach(eventName => {
            uploadArea.addEventListener(eventName, highlight, false);
        });
        
        ['dragleave', 'drop'].forEach(eventName => {
            uploadArea.addEventListener(eventName, unhighlight, false);
        });
        
        function highlight(e) {
            uploadArea.classList.add('dragover');
        }
        
        function unhighlight(e) {
            uploadArea.classList.remove('dragover');
        }
        
        uploadArea.addEventListener('drop', handleDrop, false);
        
        function handleDrop(e) {
            const dt = e.dataTransfer;
            const files = dt.files;
            
            if (files.length > 0) {
                document.getElementById('coverInput').files = files;
                previewImage(document.getElementById('coverInput'));
            }
        }
    </script>
</body>
</html>
@endsection