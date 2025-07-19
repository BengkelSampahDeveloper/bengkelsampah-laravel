@extends('dashboard')
@section('content')
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artikel - Admin Panel</title>
    <link href="https://fonts.googleapis.com/css2?family=Urbanist:wght@400;700;900&display=swap" rel="stylesheet">
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

        .header h1 {
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

        .container {
            max-width: 1400px;
            background: #fff;
            border: 1px solid #E5E6E6;
            border-radius: 16px;
            padding: 16px 16px 16px 24px;
        }

        .controls {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 1rem;
        }

        .search-filter {
            display: flex;
            gap: 1rem;
            flex: 1;
        }

        .search-box {
            position: relative;
            flex: 1;
            max-width: 300px;
            border-radius: 18px;
            border: 1px solid #EFF0F0;
            background: #EFF0F0;
            display: flex;
            align-items: center;
        }

        .search-input {
            width: 100%;
            border: none;
            outline: none;
            background: transparent;
            font-family: 'Urbanist', sans-serif;
            font-size: 15px;
            font-weight: 400;
            color: #6B7271;
            padding: 6px 36px 6px 14px;
            border-radius: 18px;
        }

        .search-input::placeholder {
            color: #6B7271;
            font-family: 'Urbanist', sans-serif;
            font-size: 15px;
            font-weight: 400;
            opacity: 1;
        }

        .search-box:focus-within {
            background: #fff;
        }

        .search-input:focus {
            background: #fff;
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

        .search-box input {
            margin-right: 6px;
        }

        .filter-dropdown {
            position: relative;
        }

        .filter-button {
            padding: 0 1rem;
            background: white;
            border: 1px solid #E5E6E6;
            border-radius: 8px;
            font-family: 'Urbanist', sans-serif;
            font-size: 15px;
            font-weight: 600;
            color: #39746E;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 6px;
            height: 38px;
        }

        .filter-dropdown-content {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            background: white;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            z-index: 10;
            min-width: 200px;
            padding: 0.5rem;
        }

        .filter-dropdown-content.show {
            display: block;
        }

        .filter-option {
            padding: 8px 12px;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .filter-option:hover {
            background-color: #f3f4f6;
        }

        .filter-option label {
            cursor: pointer;
            font-family: 'Urbanist', sans-serif;
            font-size: 15px;
            color: #1e293b;
        }

        .action-buttons {
            display: flex;
            gap: 6px;
        }

        .delete-button {
            padding: 0 1rem;
            background: transparent;
            border: 1px solid #FDCED1;
            border-radius: 8px;
            font-family: 'Urbanist', sans-serif;
            font-size: 15px;
            font-weight: 600;
            color: #F73541;
            cursor: pointer;
            display: none;
            align-items: center;
            gap: 8px;
            height: 37px;
        }

        .add-button {
            padding: 0 1rem;
            background: #39746E;
            border: 1px solid #E5E6E6;
            border-radius: 8px;
            font-family: 'Urbanist', sans-serif;
            font-size: 15px;
            font-weight: 600;
            color: #DFF0EE;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            height: 37px;
        }

        .table-container {
            background: white;
            border-radius: 8px;
            overflow: hidden;
            margin-top: 8px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            padding: 12px 16px;
            text-align: left;
            font-family: 'Urbanist', sans-serif;
            font-size: 14px;
            font-weight: 400;
            color: #6B7271;
            border-top: 1px solid #E5E6E6;
            border-bottom: 1px solid #E5E6E6;
        }

        td {
            padding: 0.5rem;
            border-bottom: 1px solid #e2e8f0;
            color: #1e293b;
        }

        .checkbox-cell {
            width: 20px;
            text-align: center;
        }

        .article-checkbox {
            width: 17px;
            height: 17px;
            border-radius: 3px;
            border: 1px solid #E4E2DD;
            background-color: #FAF6F5;
            cursor: pointer;
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            position: relative;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .article-checkbox:checked {
            background-color: #39746E;
            border-color: #39746E;
        }

        .article-checkbox:checked::after {
            content: '';
            position: absolute;
            width: 5px;
            height: 8px;
            border: solid white;
            border-width: 0 2px 2px 0;
            transform: rotate(45deg);
            margin-top: -4px;
            margin-left: 0px;
        }

        .select-all-checkbox {
            width: 17px;
            height: 17px;
            border-radius: 3px;
            border: 1px solid #E4E2DD;
            background-color: #FAF6F5;
            cursor: pointer;
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            position: relative;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .select-all-checkbox:checked {
            background-color: #39746E;
            border-color: #39746E;
        }

        .select-all-checkbox:checked::after {
            content: '';
            position: absolute;
            width: 5px;
            height: 8px;
            border: solid white;
            border-width: 0 2px 2px 0;
            transform: rotate(45deg);
            margin-top: -4px;
            margin-left: 0px;
        }

        .image-cell {
            width: 100px;
        }

        .article-image {
            width: 100px;
            height: 56px;
            object-fit: cover;
            border-radius: 6px;
        }

        .title-cell {
            min-width: 200px;
            max-width: 300px;
        }

        .article-title {
            font-family: 'Urbanist', sans-serif;
            font-size: 12px;
            font-weight: 400;
            color: #6B7271;
            margin-bottom: 0.25rem;
        }

        .article-subtitle {
            font-size: 12px;
            color: #64748b;
        }

        .text-cell {
            min-width: 200px;
            max-width: 350px;
        }

        .article-text {
            font-family: 'Urbanist', sans-serif;
            font-size: 12px;
            font-weight: 400;
            color: #6B7271;
            line-height: 1.5;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .category-cell {
            width: 150px;
        }

        .category-tag {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            background: #DFF0EE;
            color: #6B7271;
            border-radius: 20px;
            font-family: 'Urbanist', sans-serif;
            font-size: 12px;
            font-weight: 400;
        }

        .action-cell {
            width: 100px;
            text-align: center;
        }

        .action-buttons-cell {
            display: flex;
            gap: 0.5rem;
            justify-content: center;
        }

        .action-button {
            padding: 0.25rem;
            background: none;
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 20%;
            transition: background-color 0.2s ease;
        }

        .action-button:hover {
            background-color: #f3f4f6;
        }

        .action-button img {
            width: 16px;
            height: 16px;
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
            backdrop-filter: blur(4px);
        }

        .modal.show {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .modal-content {
            background: white;
            border-radius: 16px;
            padding: 24px;
            position: relative;
            max-width: 400px;
            width: 90%;
            max-height: 90vh;
            overflow-y: auto;
        }

        .modal-close {
            position: absolute;
            top: 16px;
            right: 16px;
            background: none;
            border: none;
            cursor: pointer;
            padding: 4px;
            border-radius: 4px;
            transition: background-color 0.2s;
        }

        .modal-close:hover {
            background-color: #f3f4f6;
        }

        .modal-close img {
            width: 20px;
            height: 20px;
        }

        .modal-icon {
            width: 48px;
            height: 48px;
            margin: 0 auto 16px;
            display: block;
        }

        .modal-title {
            font-family: 'Urbanist', sans-serif;
            font-size: 18px;
            font-weight: 700;
            color: #1e293b;
            text-align: center;
            margin-bottom: 8px;
        }

        .modal-subtitle {
            font-family: 'Urbanist', sans-serif;
            font-size: 14px;
            color: #6B7271;
            text-align: center;
            margin-bottom: 24px;
        }

        .modal-buttons {
            display: flex;
            gap: 12px;
            margin-top: 24px;
        }

        .modal-button {
            flex: 1;
            padding: 12px 16px;
            border-radius: 8px;
            font-family: 'Urbanist', sans-serif;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            border: none;
            transition: all 0.2s;
        }

        .cancel-button {
            background: #F8F9FA;
            color: #6B7271;
            border: 1px solid #E5E6E6;
        }

        .cancel-button:hover {
            background: #E9ECEF;
        }

        .confirm-button {
            background: #39746E;
            color: #DFF0EE;
        }

        .confirm-button:hover {
            background: #2d5a55;
        }

        /* Export Form Styles */
        .export-form {
            margin: 20px 0;
        }

        .export-form .form-group {
            margin-bottom: 16px;
        }

        .export-form .form-label {
            display: block;
            font-family: 'Urbanist', sans-serif;
            font-size: 14px;
            font-weight: 500;
            color: #374151;
            margin-bottom: 8px;
        }

        .export-form .form-select,
        .export-form .form-input {
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

        .export-form .form-select:focus,
        .export-form .form-input:focus {
            outline: none;
            border-color: #39746E;
        }

        .date-range-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }

        .date-input-group {
            display: flex;
            flex-direction: column;
        }

        @media (max-width: 768px) {
            .date-range-row {
                grid-template-columns: 1fr;
            }
        }

        .no-results {
            text-align: center;
            padding: 3rem;
            color: #6b7280;
        }

        @media (max-width: 768px) {
            .container {
                padding: 1rem;
            }

            .controls {
                flex-direction: column;
                align-items: stretch;
            }

            .search-filter {
                flex-direction: column;
            }

            .table-container {
                overflow-x: auto;
            }

            .table {
                min-width: 800px;
            }
        }

        .pagination-container {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            margin-top: 8px;
        }

        .pagination-info {
            font-family: 'Urbanist', sans-serif;
            font-size: 16px;
            font-weight: 500;
            color: #6B7271;
            margin-right: 8px;
        }

        .pagination-btn {
            font-family: 'Urbanist', sans-serif;
            font-size: 18px;
            font-weight: 700;
            color: #39746E;
            background: none;
            border: none;
            padding: 4px 12px;
            border-radius: 6px;
            cursor: pointer;
            margin-left: 0;
            margin-right: 0;
            transition: background 0.2s;
        }
        .pagination-btn:disabled {
            color: #B0B0B0;
            cursor: not-allowed;
            background: none;
        }
        .pagination-btn:not(:disabled):hover {
            background: #EFF0F0;
        }

        /* Loading Styles */
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

        .table-loading {
            position: relative;
            min-height: 200px;
        }

        .table-loading::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255, 255, 255, 0.8);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 10;
        }

        .table-loading::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 30px;
            height: 30px;
            border: 3px solid #f3f3f3;
            border-top: 3px solid #00B6A0;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            z-index: 11;
        }

        .button-loading {
            position: relative;
            pointer-events: none;
            opacity: 0.7;
        }

        .button-loading::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 16px;
            height: 16px;
            border: 2px solid transparent;
            border-top: 2px solid currentColor;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        .search-box.loading .search-icon {
            animation: spin 1s linear infinite;
        }

        .filter-button.loading {
            pointer-events: none;
            opacity: 0.7;
        }

        .filter-button.loading::after {
            content: '';
            position: absolute;
            top: 50%;
            right: 12px;
            transform: translateY(-50%);
            width: 12px;
            height: 12px;
            border: 2px solid transparent;
            border-top: 2px solid #39746E;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        /* Export Button Styles */
        .export-dropdown {
            position: relative;
        }

        .export-button {
            padding: 0 1rem;
            background: #39746E;
            border: 1px solid #E5E6E6;
            border-radius: 8px;
            font-family: 'Urbanist', sans-serif;
            font-size: 15px;
            font-weight: 600;
            color: #DFF0EE;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            height: 37px;
            transition: all 0.2s;
        }

        .export-button:hover {
            background: #2d5a55;
        }

        .export-button img {
            filter: brightness(0) invert(1);
        }

        .export-dropdown-content {
            display: none;
            position: absolute;
            top: 100%;
            right: 0;
            background: white;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            z-index: 10;
            min-width: 180px;
            padding: 0.5rem;
            margin-top: 4px;
        }

        .export-dropdown-content.show {
            display: block;
        }

        .export-option {
            padding: 8px 12px;
            cursor: pointer;
            transition: background-color 0.2s;
            display: flex;
            align-items: center;
            gap: 8px;
            border-radius: 4px;
        }

        .export-option:hover {
            background-color: #f3f4f6;
        }

        .export-option img {
            width: 16px;
            height: 16px;
        }

        .export-option span {
            font-family: 'Urbanist', sans-serif;
            font-size: 14px;
            color: #1e293b;
        }
    </style>
</head>
<body>
    <!-- Loading Overlay -->
    <div class="loading-overlay" id="pageLoadingOverlay" style="display: none;">
        <div class="loading-content">
            <div class="loading-spinner-large"></div>
            <p>Memuat Artikel...</p>
        </div>
    </div>

    <!-- ================= HEADER & FILTER ================= -->
    @include('partials.dashboard-header-bar', ['title' => 'Artikel'])

    <div class="container">
        <div class="controls">
            <div class="search-filter">
                <div class="search-box" id="searchBox">
                    <input type="text" class="search-input" placeholder="Cari data disini" id="searchInput">
                    <img src="{{ asset('icon/ic_search.svg') }}" alt="Search" class="search-icon">
                </div>
                <div class="filter-dropdown">
                    <button class="filter-button" id="filterButton">
                        <span>Semua Kategori</span>
                        <img src="{{ asset('icon/ic_trailing.svg') }}" alt="Filter" width="16" height="16">
                    </button>
                    <div class="filter-dropdown-content" id="filterDropdown">
                        <div class="filter-option">
                            <label>Semua Kategori</label>
                        </div>
                        @foreach ($kategoris as $kategori)
                        <div class="filter-option">
                            <label>{{ $kategori->nama }}</label>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="action-buttons">
                <button class="delete-button" id="deleteButton">
                    <span>Hapus Artikel</span>
                    <img src="{{ asset('icon/ic_red_delete.svg') }}" alt="Delete" width="16" height="16">
                </button>
                <div class="export-dropdown">
                    <button class="export-button" id="exportButton">
                        <span>Export</span>
                        <img src="{{ asset('icon/ic_trailing.svg') }}" alt="Export" width="16" height="16">
                    </button>
                    <div class="export-dropdown-content" id="exportDropdown">
                        <div class="export-option" onclick="exportData('excel')">
                            <img src="{{ asset('icon/ic_laporan.svg') }}" alt="Excel">
                            <span>Export Excel</span>
                        </div>
                        <div class="export-option" onclick="exportData('csv')">
                            <img src="{{ asset('icon/ic_laporan.svg') }}" alt="CSV">
                            <span>Export CSV</span>
                        </div>
                        <div class="export-option" onclick="exportData('pdf')">
                            <img src="{{ asset('icon/ic_laporan.svg') }}" alt="PDF">
                            <span>Export PDF</span>
                        </div>
                    </div>
                </div>
                <button class="add-button" id="addButton">
                    <span>Tambah Artikel</span>
                    <img src="{{ asset('icon/ic_add.svg') }}" alt="Add" width="16" height="16">
                </button>
            </div>
        </div>

        <div class="table-container" id="tableContainer">
            <table class="table">
                <thead>
                    <tr>
                        <th class="checkbox-cell">
                            <input type="checkbox" id="selectAll" class="select-all-checkbox">
                        </th>
                        <th>Gambar</th>
                        <th>Judul</th>
                        <th>Text</th>
                        <th>Kategori</th>
                        <th>Creator</th>
                        <th>Created At</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="articleTableBody">
                    <!-- Data akan diisi oleh JavaScript -->
                </tbody>
            </table>
            <div class="no-results" id="noResults" style="display: none;">
                Tidak ada artikel yang ditemukan
            </div>
        </div>

        <div class="pagination-container" id="paginationContainer">
            <div class="pagination-info" id="paginationInfo"></div>
            <div class="pagination" id="pagination"></div>
        </div>
    </div>

    <div class="modal" id="deleteModal">
        <div class="modal-content">
            <button class="modal-close" id="closeModalBtn">
                <img src="{{ asset('icon/ic_close.svg') }}" alt="Close">
            </button>
            <img src="{{ asset('icon/ic_dialog_delete.svg') }}" alt="Delete" class="modal-icon">
            <h2 class="modal-title">Hapus Artikel</h2>
            <p class="modal-subtitle">Apakah Anda yakin ingin menghapus artikel yang dipilih?</p>
            <div class="modal-buttons">
                <button class="modal-button cancel-button" id="cancelDeleteBtn">Batal</button>
                <button class="modal-button confirm-button" id="confirmDeleteBtn">Hapus</button>
            </div>
        </div>
    </div>

    <!-- Export Excel Modal -->
    <div class="modal" id="exportExcelModal">
        <div class="modal-content">
            <button class="modal-close" id="closeExportModalBtn">
                <img src="{{ asset('icon/ic_close.svg') }}" alt="Close">
            </button>
            <img src="{{ asset('icon/ic_laporan.svg') }}" alt="Export" class="modal-icon">
            <h2 class="modal-title">Export Excel Artikel</h2>
            <p class="modal-subtitle">Pilih periode data yang ingin diexport</p>
            
            <div class="export-form">
                <div class="form-group">
                    <label class="form-label">Periode Export</label>
                    <select class="form-select" id="exportPeriod">
                        <option value="all">Semua Data</option>
                        <option value="today">Hari Ini</option>
                        <option value="yesterday">Kemarin</option>
                        <option value="this_week">Minggu Ini</option>
                        <option value="last_week">Minggu Lalu</option>
                        <option value="this_month">Bulan Ini</option>
                        <option value="last_month">Bulan Lalu</option>
                        <option value="this_year">Tahun Ini</option>
                        <option value="last_year">Tahun Lalu</option>
                        <option value="range">Range Waktu</option>
                    </select>
                </div>
                
                <div class="form-group" id="dateRangeGroup" style="display: none;">
                    <div class="date-range-row">
                        <div class="date-input-group">
                            <label class="form-label">Dari Tanggal</label>
                            <input type="date" class="form-input" id="startDate">
                        </div>
                        <div class="date-input-group">
                            <label class="form-label">Sampai Tanggal</label>
                            <input type="date" class="form-input" id="endDate">
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Filter Kategori (Opsional)</label>
                    <select class="form-select" id="exportCategory">
                        <option value="">Semua Kategori</option>
                        @foreach ($kategoris as $kategori)
                        <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            
            <div class="modal-buttons">
                <button class="modal-button cancel-button" id="cancelExportBtn">Batal</button>
                <button class="modal-button confirm-button" id="confirmExportBtn">Export Excel</button>
            </div>
        </div>
    </div>

    <!-- Export CSV Modal -->
    <div class="modal" id="exportCsvModal">
        <div class="modal-content">
            <button class="modal-close" id="closeCsvModalBtn">
                <img src="{{ asset('icon/ic_close.svg') }}" alt="Close">
            </button>
            <img src="{{ asset('icon/ic_laporan.svg') }}" alt="Export" class="modal-icon">
            <h2 class="modal-title">Export CSV Artikel</h2>
            <p class="modal-subtitle">Pilih periode data yang ingin diexport</p>
            
            <div class="export-form">
                <div class="form-group">
                    <label class="form-label">Periode Export</label>
                    <select class="form-select" id="csvExportPeriod">
                        <option value="all">Semua Data</option>
                        <option value="today">Hari Ini</option>
                        <option value="yesterday">Kemarin</option>
                        <option value="this_week">Minggu Ini</option>
                        <option value="last_week">Minggu Lalu</option>
                        <option value="this_month">Bulan Ini</option>
                        <option value="last_month">Bulan Lalu</option>
                        <option value="this_year">Tahun Ini</option>
                        <option value="last_year">Tahun Lalu</option>
                        <option value="range">Range Waktu</option>
                    </select>
                </div>
                
                <div class="form-group" id="csvDateRangeGroup" style="display: none;">
                    <div class="date-range-row">
                        <div class="date-input-group">
                            <label class="form-label">Dari Tanggal</label>
                            <input type="date" class="form-input" id="csvStartDate">
                        </div>
                        <div class="date-input-group">
                            <label class="form-label">Sampai Tanggal</label>
                            <input type="date" class="form-input" id="csvEndDate">
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Filter Kategori (Opsional)</label>
                    <select class="form-select" id="csvExportCategory">
                        <option value="">Semua Kategori</option>
                        @foreach ($kategoris as $kategori)
                        <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            
            <div class="modal-buttons">
                <button class="modal-button cancel-button" id="cancelCsvBtn">Batal</button>
                <button class="modal-button confirm-button" id="confirmCsvBtn">Export CSV</button>
            </div>
        </div>
    </div>

    <!-- Export PDF Modal -->
    <div class="modal" id="exportPdfModal">
        <div class="modal-content">
            <button class="modal-close" id="closePdfModalBtn">
                <img src="{{ asset('icon/ic_close.svg') }}" alt="Close">
            </button>
            <img src="{{ asset('icon/ic_laporan.svg') }}" alt="Export" class="modal-icon">
            <h2 class="modal-title">Export PDF Artikel</h2>
            <p class="modal-subtitle">Pilih periode data yang ingin diexport</p>
            
            <div class="export-form">
                <div class="form-group">
                    <label class="form-label">Periode Export</label>
                    <select class="form-select" id="pdfExportPeriod">
                        <option value="all">Semua Data</option>
                        <option value="today">Hari Ini</option>
                        <option value="yesterday">Kemarin</option>
                        <option value="this_week">Minggu Ini</option>
                        <option value="last_week">Minggu Lalu</option>
                        <option value="this_month">Bulan Ini</option>
                        <option value="last_month">Bulan Lalu</option>
                        <option value="this_year">Tahun Ini</option>
                        <option value="last_year">Tahun Lalu</option>
                        <option value="range">Range Waktu</option>
                    </select>
                </div>
                
                <div class="form-group" id="pdfDateRangeGroup" style="display: none;">
                    <div class="date-range-row">
                        <div class="date-input-group">
                            <label class="form-label">Dari Tanggal</label>
                            <input type="date" class="form-input" id="pdfStartDate">
                        </div>
                        <div class="date-input-group">
                            <label class="form-label">Sampai Tanggal</label>
                            <input type="date" class="form-input" id="pdfEndDate">
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Filter Kategori (Opsional)</label>
                    <select class="form-select" id="pdfExportCategory">
                        <option value="">Semua Kategori</option>
                        @foreach ($kategoris as $kategori)
                        <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            
            <div class="modal-buttons">
                <button class="modal-button cancel-button" id="cancelPdfBtn">Batal</button>
                <button class="modal-button confirm-button" id="confirmPdfBtn">Export PDF</button>
            </div>
        </div>
    </div>

    <!-- Include Loading Indicator Utility -->
    <script src="{{ asset('js/loading-utils.js') }}"></script>

    <script>
        // Data artikel dari backend
        let articles = [
            @foreach ($artikels as $artikel)
            {
                id: {{ $artikel->id }},
                image: @json($artikel->cover),
                title: @json($artikel->title),
                text: @json(Str::limit(strip_tags($artikel->content), 200)),
                category: @json($artikel->kategori->nama ?? '-'),
                creator: @json($artikel->creator),
                created_at: @json($artikel->created_at->format('d M Y H:i'))
            },
            @endforeach
        ];
        let filteredArticles = [...articles];
        let selectedCategory = null;
        let selectedArticles = [];
        let currentPage = 1;
        const itemsPerPage = 10;
        let totalPages = 1;

        document.addEventListener('DOMContentLoaded', function() {
            // Show initial loading
            showPageLoading('Memuat Artikel...');
            
            // Initial data loading
            const initialPaginationData = {
                current_page: {{ $artikels->currentPage() }},
                total: {{ $artikels->total() }},
                per_page: {{ $artikels->perPage() }},
                first_item: {{ $artikels->firstItem() ?? 0 }},
                last_item: {{ $artikels->lastItem() ?? 0 }}
            };
            
            // Simulate loading time for better UX
            setTimeout(() => {
                renderArticles();
                renderPagination(initialPaginationData);
                setupEventListeners();
                hidePageLoading();
            }, 500);
        });

        function setupEventListeners() {
            // Search with Enter key only
            document.getElementById('searchInput').addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    showLoading('Mencari artikel...');
                    filterArticles();
                }
            });

            document.getElementById('filterButton').addEventListener('click', function(e) {
                e.stopPropagation();
                document.getElementById('filterDropdown').classList.toggle('show');
            });

            document.querySelectorAll('.filter-option').forEach(option => {
                option.addEventListener('click', function() {
                    const category = this.querySelector('label').textContent;
                    selectedCategory = category === 'Semua Kategori' ? null : category.trim();
                    document.getElementById('filterButton').querySelector('span').textContent = selectedCategory || 'Semua Kategori';
                    document.getElementById('filterDropdown').classList.remove('show');
                    
                    // Show filter loading
                    showLoading('Memfilter artikel...');
                    filterArticles();
                });
            });

            document.getElementById('selectAll').addEventListener('change', function() {
                const checkboxes = document.querySelectorAll('.article-checkbox');
                checkboxes.forEach(cb => { cb.checked = this.checked; });
                updateSelectedArticles();
            });

            document.getElementById('addButton').addEventListener('click', function() {
                window.location.href = '{{ route("dashboard.artikel.create") }}';
            });

            document.getElementById('deleteButton').addEventListener('click', function() {
                if (selectedArticles.length > 0) { showDeleteModal(true); }
            });

            // Export dropdown
            document.getElementById('exportButton').addEventListener('click', function(e) {
                e.stopPropagation();
                document.getElementById('exportDropdown').classList.toggle('show');
            });

            document.addEventListener('click', function(e) {
                if (!e.target.closest('.filter-dropdown')) {
                    document.getElementById('filterDropdown').classList.remove('show');
                }
                if (!e.target.closest('.export-dropdown')) {
                    document.getElementById('exportDropdown').classList.remove('show');
                }
            });

            // Modal close
            document.getElementById('closeModalBtn').addEventListener('click', closeDeleteModal);
            document.getElementById('cancelDeleteBtn').addEventListener('click', closeDeleteModal);
            document.getElementById('confirmDeleteBtn').addEventListener('click', confirmDelete);

            // Action buttons in table
            document.getElementById('articleTableBody').addEventListener('click', function(e) {
                if (e.target.closest('.edit-button')) {
                    const id = e.target.closest('.edit-button').dataset.id;
                    window.location.href = `#edit-${id}`;
                } else if (e.target.closest('.delete-button')) {
                    const id = parseInt(e.target.closest('.delete-button').dataset.id);
                    selectedArticles = [id];
                    showDeleteModal(false);
                }
            });

            document.getElementById('deleteModal').addEventListener('click', function(e) { 
                if (e.target === this) { 
                    closeDeleteModal(); 
                } 
            });

            // Export Excel Modal
            document.getElementById('closeExportModalBtn').addEventListener('click', closeExportExcelModal);
            document.getElementById('cancelExportBtn').addEventListener('click', closeExportExcelModal);
            document.getElementById('confirmExportBtn').addEventListener('click', confirmExportExcel);
            document.getElementById('exportPeriod').addEventListener('change', handleExportPeriodChange);
            
            document.getElementById('exportExcelModal').addEventListener('click', function(e) { 
                if (e.target === this) { 
                    closeExportExcelModal(); 
                } 
            });

            // Export CSV Modal
            document.getElementById('closeCsvModalBtn').addEventListener('click', closeExportCsvModal);
            document.getElementById('cancelCsvBtn').addEventListener('click', closeExportCsvModal);
            document.getElementById('confirmCsvBtn').addEventListener('click', confirmExportCsv);
            document.getElementById('csvExportPeriod').addEventListener('change', handleCsvPeriodChange);
            
            document.getElementById('exportCsvModal').addEventListener('click', function(e) { 
                if (e.target === this) { 
                    closeExportCsvModal(); 
                } 
            });

            // Export PDF Modal
            document.getElementById('closePdfModalBtn').addEventListener('click', closeExportPdfModal);
            document.getElementById('cancelPdfBtn').addEventListener('click', closeExportPdfModal);
            document.getElementById('confirmPdfBtn').addEventListener('click', confirmExportPdf);
            document.getElementById('pdfExportPeriod').addEventListener('change', handlePdfPeriodChange);
            
            document.getElementById('exportPdfModal').addEventListener('click', function(e) { 
                if (e.target === this) { 
                    closeExportPdfModal(); 
                } 
            });
        }

        function filterArticles() {
            const searchTerm = document.getElementById('searchInput').value;
            currentPage = 1;
            loadArticles(searchTerm, selectedCategory, currentPage);
        }

        function changePage(page) {
            if (page < 1) return;
            
            // Show pagination loading
            showLoading('Memuat halaman...');
            
            const searchTerm = document.getElementById('searchInput').value;
            loadArticles(searchTerm, selectedCategory, page);
            document.querySelector('.table-container').scrollIntoView({ behavior: 'smooth' });
        }

        function loadArticles(search, category, page) {
            const url = new URL(window.location.href);
            url.searchParams.set('search', search);
            if (category) {
                url.searchParams.set('kategori', category);
            }
            url.searchParams.set('page', page);

            fetch(url.toString(), {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                console.log('Server response:', data); // Debug log
                
                if (data.artikels && data.artikels.data) {
                    // Update articles array with new data
                    articles = data.artikels.data.map(artikel => ({
                        id: artikel.id,
                        image: artikel.cover,
                        title: artikel.title,
                        text: artikel.content.substring(0, 200),
                        category: artikel.kategori ? artikel.kategori.nama : '-',
                        creator: artikel.creator,
                        created_at: new Date(artikel.created_at).toLocaleString('id-ID', {
                            day: '2-digit',
                            month: 'short',
                            year: 'numeric',
                            hour: '2-digit',
                            minute: '2-digit'
                        })
                    }));
                    
                    // Update filtered articles
                    filteredArticles = [...articles];
                    
                    // Update current page from server response
                    currentPage = data.artikels.current_page;
                    
                    // Render the updated data
                    renderArticles();
                    
                    // Update pagination using server's data
                    const paginationData = {
                        current_page: data.artikels.current_page,
                        total: data.artikels.total,
                        per_page: data.artikels.per_page,
                        first_item: data.artikels.from,
                        last_item: data.artikels.to
                    };
                    renderPagination(paginationData);
                    
                    selectedArticles = [];
                    updateSelectedArticles();
                } else {
                    // Handle empty response
                    articles = [];
                    filteredArticles = [];
                    renderArticles();
                    renderPagination({
                        current_page: 1,
                        total: 0,
                        per_page: itemsPerPage,
                        first_item: 0,
                        last_item: 0
                    });
                    selectedArticles = [];
                    updateSelectedArticles();
                }
                
                // Hide all loading states
                hideLoading();
            })
            .catch(error => {
                console.error('Error:', error);
                // Handle error by showing empty state
                articles = [];
                filteredArticles = [];
                renderArticles();
                renderPagination({
                    current_page: 1,
                    total: 0,
                    per_page: itemsPerPage,
                    first_item: 0,
                    last_item: 0
                });
                selectedArticles = [];
                updateSelectedArticles();
                
                // Hide all loading states
                hideLoading();
            });
        }

        function renderArticles() {
            const tbody = document.getElementById('articleTableBody');
            const noResults = document.getElementById('noResults');
            const paginationContainer = document.getElementById('paginationContainer');

            if (filteredArticles.length === 0) {
                tbody.innerHTML = '';
                noResults.style.display = 'block';
                paginationContainer.style.display = 'none';
                return;
            }

            noResults.style.display = 'none';
            paginationContainer.style.display = 'flex';

            // Use all articles from the current page
            tbody.innerHTML = filteredArticles.map(article => `
                <tr>
                    <td class="checkbox-cell">
                        <input type="checkbox" class="article-checkbox" value="${article.id}" onchange="updateSelectedArticles()">
                    </td>
                    <td class="image-cell">
                        <img src="${article.image}" alt="${article.title}" class="article-image">
                    </td>
                    <td class="title-cell">
                        <div class="article-title">${article.title}</div>
                    </td>
                    <td class="text-cell">
                        <div class="article-text">${article.text}</div>
                    </td>
                    <td class="category-cell">
                        <span class="category-tag">${article.category}</span>
                    </td>
                    <td class="category-cell">
                        <span class="category-tag">${article.creator}</span>
                    </td>
                    <td class="category-cell">
                        <span class="category-tag">${article.created_at}</span>
                    </td>
                    <td class="action-cell">
                        <div class="action-buttons-cell">
                            <button class="action-button edit-button" data-id="${article.id}" onclick="window.location.href='/dashboard/artikel/${article.id}/edit'">
                                <img src="{{ asset('icon/ic_edit.svg') }}" alt="Edit">
                            </button>
                            <button class="action-button delete-button" data-id="${article.id}">
                                <img src="{{ asset('icon/ic_delete.svg') }}" alt="Delete">
                            </button>
                        </div>
                    </td>
                </tr>
            `).join('');
        }

        function renderPagination(paginationData) {
            const paginationContainer = document.getElementById('paginationContainer');
            const paginationInfo = document.getElementById('paginationInfo');
            const pagination = document.getElementById('pagination');
            
            const { current_page, total, per_page, first_item, last_item } = paginationData;
            
            // Update pagination info
            paginationInfo.textContent = `${first_item}-${last_item} of ${total}`;
            
            // Calculate total pages
            const totalPages = Math.ceil(total / per_page);
            
            // Generate pagination buttons
            let paginationHTML = '';
            paginationHTML += `<button class="pagination-btn" onclick="changePage(${current_page - 1})" ${current_page <= 1 ? 'disabled' : ''}>&lt;</button>`;
            paginationHTML += `<button class="pagination-btn" onclick="changePage(${current_page + 1})" ${current_page >= totalPages ? 'disabled' : ''}>&gt;</button>`;
            pagination.innerHTML = paginationHTML;
        }

        function updateSelectedArticles() {
            const checkboxes = document.querySelectorAll('.article-checkbox:checked');
            selectedArticles = Array.from(checkboxes).map(cb => parseInt(cb.value));
            const selectAllCheckbox = document.getElementById('selectAll');
            const allCheckboxes = document.querySelectorAll('.article-checkbox');
            selectAllCheckbox.checked = allCheckboxes.length > 0 && selectedArticles.length === allCheckboxes.length;
            const deleteBtn = document.getElementById('deleteButton');
            if (selectedArticles.length > 0) { 
                deleteBtn.style.display = 'flex'; 
            } else { 
                deleteBtn.style.display = 'none'; 
            }
        }

        function debounce(func, wait) {
            let timeout;
            return function executedFunction(...args) {
                const later = () => {
                    clearTimeout(timeout);
                    func(...args);
                };
                clearTimeout(timeout);
                timeout = setTimeout(later, wait);
            };
        }

        function showDeleteModal(isMultiple) {
            const modal = document.getElementById('deleteModal');
            const title = document.querySelector('#deleteModal .modal-title');
            const subtitle = document.querySelector('#deleteModal .modal-subtitle');
            
            if (isMultiple) {
                title.textContent = 'Hapus Artikel';
                subtitle.textContent = `Apakah Anda yakin ingin menghapus ${selectedArticles.length} artikel yang dipilih?`;
            } else {
                title.textContent = 'Hapus Artikel';
                subtitle.textContent = 'Apakah Anda yakin ingin menghapus artikel ini?';
            }
            
            modal.classList.add('show');
        }

        function closeDeleteModal() { 
            document.getElementById('deleteModal').classList.remove('show'); 
        }

        function confirmDelete() {
            const confirmBtn = document.getElementById('confirmDeleteBtn');
            const originalText = confirmBtn.textContent;
            
            // Show loading on delete button
            confirmBtn.textContent = 'Menghapus...';
            confirmBtn.classList.add('button-loading');
            confirmBtn.disabled = true;
            
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            let url = '';
            let body = {};
            let isMultiple = selectedArticles.length > 1;
            
            if (isMultiple) {
                url = `/dashboard/artikel/0`;
                body = { ids: selectedArticles };
            } else {
                url = `/dashboard/artikel/${selectedArticles[0]}`;
                body = {};
            }

            fetch(url, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                },
                body: isMultiple ? JSON.stringify(body) : null
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    closeDeleteModal();
                    showLoading('Memuat ulang artikel...');
                    loadArticles(
                        document.getElementById('searchInput').value,
                        selectedCategory,
                        currentPage
                    );
                } else {
                    alert(data.message || 'Gagal menghapus artikel');
                }
                
                // Reset button
                confirmBtn.textContent = originalText;
                confirmBtn.classList.remove('button-loading');
                confirmBtn.disabled = false;
            })
            .catch(() => {
                alert('Gagal menghapus artikel');
                
                // Reset button
                confirmBtn.textContent = originalText;
                confirmBtn.classList.remove('button-loading');
                confirmBtn.disabled = false;
            });
        }

        // Loading Functions
        function showPageLoading(message = 'Memuat...') {
            const overlay = document.getElementById('pageLoadingOverlay');
            overlay.querySelector('p').textContent = message;
            overlay.style.display = 'flex';
        }

        function hidePageLoading() {
            document.getElementById('pageLoadingOverlay').style.display = 'none';
        }

        // Unified loading function - using the same loading as initial page load
        function showLoading(message = 'Memuat...') {
            showPageLoading(message);
        }

        function hideLoading() {
            hidePageLoading();
        }

        // Legacy functions - kept for compatibility but not used
        function showTableLoading() {
            showLoading('Memuat tabel...');
        }

        function hideTableLoading() {
            hideLoading();
        }

        function showSearchLoading() {
            showLoading('Mencari...');
        }

        function hideSearchLoading() {
            hideLoading();
        }

        function showFilterLoading() {
            showLoading('Memfilter...');
        }

        function hideFilterLoading() {
            hideLoading();
        }

        // Export Functions (Placeholder)
        function exportData(format) {
            // Close dropdown
            document.getElementById('exportDropdown').classList.remove('show');
            
            switch(format) {
                case 'excel':
                    showExportExcelModal();
                    break;
                case 'csv':
                    showExportCsvModal();
                    break;
                case 'pdf':
                    showExportPdfModal();
                    break;
                default:
                    alert('Format export tidak valid');
            }
        }

        function showExportExcelModal() {
            const modal = document.getElementById('exportExcelModal');
            modal.classList.add('show');
            
            // Set default dates
            const today = new Date();
            const yesterday = new Date(today);
            yesterday.setDate(yesterday.getDate() - 1);
            
            document.getElementById('startDate').value = yesterday.toISOString().split('T')[0];
            document.getElementById('endDate').value = today.toISOString().split('T')[0];
        }

        function closeExportExcelModal() {
            document.getElementById('exportExcelModal').classList.remove('show');
        }

        function handleExportPeriodChange() {
            const period = document.getElementById('exportPeriod').value;
            const dateRangeGroup = document.getElementById('dateRangeGroup');
            
            if (period === 'range') {
                dateRangeGroup.style.display = 'block';
            } else {
                dateRangeGroup.style.display = 'none';
            }
        }

        function confirmExportExcel() {
            const period = document.getElementById('exportPeriod').value;
            const category = document.getElementById('exportCategory').value;
            const startDate = document.getElementById('startDate').value;
            const endDate = document.getElementById('endDate').value;
            
            // Validate date range if selected
            if (period === 'range') {
                if (!startDate || !endDate) {
                    alert('Mohon pilih tanggal awal dan akhir');
                    return;
                }
                if (startDate > endDate) {
                    alert('Tanggal awal tidak boleh lebih besar dari tanggal akhir');
                    return;
                }
            }
            
            // Show loading on export button
            showLoading('Mengexport Excel...');
            
            // Prepare export data
            const exportData = {
                period: period,
                category: category,
                start_date: startDate,
                end_date: endDate
            };
            
            // Call export API
            fetch('/dashboard/artikel/export/excel', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json',
                },
                body: JSON.stringify(exportData)
            })
            .then(response => {
                if (response.ok) {
                    return response.blob();
                }
                throw new Error('Export failed');
            })
            .then(blob => {
                // Create download link
                const url = window.URL.createObjectURL(blob);
                const a = document.createElement('a');
                a.href = url;
                a.download = `artikel_export_${new Date().toISOString().split('T')[0]}.xlsx`;
                document.body.appendChild(a);
                a.click();
                window.URL.revokeObjectURL(url);
                document.body.removeChild(a);
                
                // Close modal
                closeExportExcelModal();
                
                // Show success message
                alert('Export Excel berhasil!');
            })
            .catch(error => {
                console.error('Export error:', error);
                alert('Gagal melakukan export Excel');
            })
            .finally(() => {
                // Hide loading
                hideLoading();
            });
        }

        function showExportCsvModal() {
            const modal = document.getElementById('exportCsvModal');
            modal.classList.add('show');
            
            // Set default dates
            const today = new Date();
            const yesterday = new Date(today);
            yesterday.setDate(yesterday.getDate() - 1);
            
            document.getElementById('csvStartDate').value = yesterday.toISOString().split('T')[0];
            document.getElementById('csvEndDate').value = today.toISOString().split('T')[0];
        }

        function closeExportCsvModal() {
            document.getElementById('exportCsvModal').classList.remove('show');
        }

        function handleCsvPeriodChange() {
            const period = document.getElementById('csvExportPeriod').value;
            const dateRangeGroup = document.getElementById('csvDateRangeGroup');
            
            if (period === 'range') {
                dateRangeGroup.style.display = 'block';
            } else {
                dateRangeGroup.style.display = 'none';
            }
        }

        function confirmExportCsv() {
            const period = document.getElementById('csvExportPeriod').value;
            const category = document.getElementById('csvExportCategory').value;
            const startDate = document.getElementById('csvStartDate').value;
            const endDate = document.getElementById('csvEndDate').value;
            
            // Validate date range if selected
            if (period === 'range') {
                if (!startDate || !endDate) {
                    alert('Mohon pilih tanggal awal dan akhir');
                    return;
                }
                if (startDate > endDate) {
                    alert('Tanggal awal tidak boleh lebih besar dari tanggal akhir');
                    return;
                }
            }
            
            // Show loading on export button
            showLoading('Mengexport CSV...');
            
            // Prepare export data
            const exportData = {
                period: period,
                category: category,
                start_date: startDate,
                end_date: endDate
            };
            
            // Call export API
            fetch('/dashboard/artikel/export/csv', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json',
                },
                body: JSON.stringify(exportData)
            })
            .then(response => {
                if (response.ok) {
                    return response.blob();
                }
                throw new Error('Export failed');
            })
            .then(blob => {
                // Create download link
                const url = window.URL.createObjectURL(blob);
                const a = document.createElement('a');
                a.href = url;
                a.download = `artikel_export_${new Date().toISOString().split('T')[0]}.csv`;
                document.body.appendChild(a);
                a.click();
                window.URL.revokeObjectURL(url);
                document.body.removeChild(a);
                
                // Close modal
                closeExportCsvModal();
                
                // Show success message
                alert('Export CSV berhasil!');
            })
            .catch(error => {
                console.error('Export error:', error);
                alert('Gagal melakukan export CSV');
            })
            .finally(() => {
                // Hide loading
                hideLoading();
            });
        }

        function showExportPdfModal() {
            const modal = document.getElementById('exportPdfModal');
            modal.classList.add('show');
            
            // Set default dates
            const today = new Date();
            const yesterday = new Date(today);
            yesterday.setDate(yesterday.getDate() - 1);
            
            document.getElementById('pdfStartDate').value = yesterday.toISOString().split('T')[0];
            document.getElementById('pdfEndDate').value = today.toISOString().split('T')[0];
        }

        function closeExportPdfModal() {
            document.getElementById('exportPdfModal').classList.remove('show');
        }

        function handlePdfPeriodChange() {
            const period = document.getElementById('pdfExportPeriod').value;
            const dateRangeGroup = document.getElementById('pdfDateRangeGroup');
            
            if (period === 'range') {
                dateRangeGroup.style.display = 'block';
            } else {
                dateRangeGroup.style.display = 'none';
            }
        }

        function confirmExportPdf() {
            const period = document.getElementById('pdfExportPeriod').value;
            const category = document.getElementById('pdfExportCategory').value;
            const startDate = document.getElementById('pdfStartDate').value;
            const endDate = document.getElementById('pdfEndDate').value;
            
            // Validate date range if selected
            if (period === 'range') {
                if (!startDate || !endDate) {
                    alert('Mohon pilih tanggal awal dan akhir');
                    return;
                }
                if (startDate > endDate) {
                    alert('Tanggal awal tidak boleh lebih besar dari tanggal akhir');
                    return;
                }
            }
            
            // Show loading on export button
            showLoading('Mengexport PDF...');
            
            // Prepare export data
            const exportData = {
                period: period,
                category: category,
                start_date: startDate,
                end_date: endDate
            };
            
            // Call export API
            fetch('/dashboard/artikel/export/pdf', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json',
                },
                body: JSON.stringify(exportData)
            })
            .then(response => {
                if (response.ok) {
                    return response.blob();
                }
                throw new Error('Export failed');
            })
            .then(blob => {
                // Create download link
                const url = window.URL.createObjectURL(blob);
                const a = document.createElement('a');
                a.href = url;
                a.download = `artikel_export_${new Date().toISOString().split('T')[0]}.pdf`;
                document.body.appendChild(a);
                a.click();
                window.URL.revokeObjectURL(url);
                document.body.removeChild(a);
                
                // Close modal
                closeExportPdfModal();
                
                // Show success message
                alert('Export PDF berhasil!');
            })
            .catch(error => {
                console.error('Export error:', error);
                alert('Gagal melakukan export PDF');
            })
            .finally(() => {
                // Hide loading
                hideLoading();
            });
        }
    </script>
</body>
</html>
@endsection 