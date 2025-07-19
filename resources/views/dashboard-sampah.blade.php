@extends('dashboard')
@section('content')
<!-- ================= HEADER & FILTER ================= -->
@include('partials.dashboard-header-bar', ['title' => 'Sampah'])
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Sampah - Admin Panel</title>
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
            padding: 6px 40px 6px 14px;
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

        .search-btn {
            position: absolute;
            right: 8px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            padding: 4px;
            border-radius: 4px;
            transition: background-color 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .search-btn:hover {
            background-color: rgba(57, 116, 110, 0.1);
        }

        .search-btn img {
            width: 16px;
            height: 16px;
        }

        .action-buttons {
            display: flex;
            gap: 8px;
            align-items: center;
        }

        .add-button {
            padding: 0 1rem;
            background: #39746E;
            border: none;
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

        .add-button:hover {
            background: #2d5a55;
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

        .delete-button:hover {
            background: #FDCED1;
        }

        .table-container {
            margin-top: 20px;
            overflow-x: auto;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            font-family: 'Urbanist', sans-serif;
        }

        .table th {
            background: #F8F9FA;
            padding: 12px 16px;
            text-align: left;
            font-weight: 600;
            font-size: 14px;
            color: #39746E;
            border-bottom: 1px solid #e2e8f0;
        }

        .table td {
            padding: 12px 16px;
            border-bottom: 1px solid #e2e8f0;
            color: #1e293b;
        }

        .table tr:hover {
            background: #F8F9FA;
        }

        .checkbox-cell {
            width: 20px;
            text-align: center;
        }

        .sampah-checkbox, .select-all-checkbox {
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

        .sampah-checkbox:checked, .select-all-checkbox:checked {
            background-color: #39746E;
            border-color: #39746E;
        }

        .sampah-checkbox:checked::after, .select-all-checkbox:checked::after {
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

        .gambar-cell {
            width: 100px;
        }

        .sampah-gambar {
            width: 100px;
            height: 56px;
            object-fit: cover;
            border-radius: 6px;
        }

        .nama-sampah-cell {
            min-width: 200px;
            max-width: 300px;
        }

        .sampah-nama {
            font-family: 'Urbanist', sans-serif;
            font-size: 12px;
            font-weight: 600;
            color: #39746E;
        }

        .deskripsi-cell {
            min-width: 250px;
            max-width: 400px;
        }

        .sampah-deskripsi {
            font-family: 'Urbanist', sans-serif;
            font-size: 12px;
            font-weight: 400;
            color: #6B7271;
            line-height: 1.5;
        }

        .satuan-cell {
            min-width: 100px;
            max-width: 150px;
        }

        .sampah-satuan {
            font-family: 'Urbanist', sans-serif;
            font-size: 12px;
            font-weight: 400;
            color: #6B7271;
            line-height: 1.5;
        }

        .satuan-badge {
            background: #E3F4F1;
            color: #39746E;
            padding: 2px 8px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 500;
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

        .action-btn {
            width: 32px;
            height: 32px;
            border: none;
            border-radius: 6px;
            background: transparent;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s;
            text-decoration: none;
        }

        .action-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .action-btn img {
            width: 16px;
            height: 16px;
        }

        .action-btn.detail-btn {
            color: #3b82f6;
        }

        .action-btn.detail-btn:hover {
            background-color: #eff6ff;
        }

        .action-btn.edit-btn {
            color: #f59e0b;
        }

        .action-btn.edit-btn:hover {
            background-color: #fffbeb;
        }

        .action-btn.delete-btn {
            color: #ef4444;
        }

        .action-btn.delete-btn:hover {
            background-color: #fef2f2;
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

        .pagination {
            display: flex;
            gap: 8px;
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

        .no-results {
            text-align: center;
            padding: 3rem;
            color: #6b7280;
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
            padding: 2rem;
            max-width: 400px;
            width: 90%;
            position: relative;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        }

        .modal-close {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background: none;
            border: none;
            cursor: pointer;
            padding: 4px;
            border-radius: 4px;
            transition: background-color 0.2s;
        }

        .modal-close:hover {
            background-color: #F3F4F6;
        }

        .modal-icon {
            width: 48px;
            height: 48px;
            margin: 0 auto 1rem;
            display: block;
        }

        .modal-title {
            font-family: 'Urbanist', sans-serif;
            font-size: 20px;
            font-weight: 700;
            color: #1F2937;
            text-align: center;
            margin-bottom: 0.5rem;
        }

        .modal-subtitle {
            font-family: 'Urbanist', sans-serif;
            font-size: 14px;
            color: #6B7280;
            text-align: center;
            margin-bottom: 1.5rem;
        }

        .modal-buttons {
            display: flex;
            gap: 10px;
            margin-top: 20px;
            width: 100%;
        }

        .modal-button {
            flex: 1;
            padding: 12px 20px;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-align: center;
            text-decoration: none;
            display: inline-block;
        }

        .cancel-button {
            background-color: #f3f4f6;
            color: #374151;
        }

        .cancel-button:hover {
            background-color: #e5e7eb;
        }

        .confirm-button {
            background-color: #39746E;
            color: white;
        }

        .confirm-button:hover {
            background-color: #2d5a55;
        }

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
        @media (max-width: 768px) {
            .controls {
                flex-direction: column;
                align-items: stretch;
            }
            
            .search-filter {
                order: 2;
            }
            
            .action-buttons {
                order: 1;
                justify-content: center;
            }

            .table-container {
                overflow-x: auto;
            }
            
            .table th,
            .table td {
                padding: 8px 12px;
                font-size: 12px;
            }
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

    <div class="container">
        <div class="controls">
            <div class="search-filter">
                <div class="search-box">
                    <input type="text" class="search-input" placeholder="Cari sampah disini" id="searchInput">
                    <button type="button" class="search-btn" id="searchBtn" onclick="filterSampah()">
                    <img src="{{ asset('icon/ic_search.svg') }}" alt="Search" class="search-icon">
                    </button>
                </div>
            </div>
            <div class="action-buttons">
                @php $isCabang = Auth::guard('admin')->user()->role !== 'admin'; $idBankSampah = Auth::guard('admin')->user()->id_bank_sampah ?? null; @endphp
                @if(!$isCabang)
                <button class="delete-button" id="deleteButton" style="display: none;">
                    <span>Hapus Sampah</span>
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
                    <span>Tambah Sampah</span>
                    <img src="{{ asset('icon/ic_add.svg') }}" alt="Add" width="16" height="16">
                </button>
                @endif
            </div>
        </div>
        
        <div class="table-container">
            <table class="table">
                <thead>
                    <tr>
                        @if(!$isCabang)
                        <th class="checkbox-cell">
                            <input type="checkbox" class="select-all-checkbox" id="selectAll">
                        </th>
                        @endif
                        <th class="gambar-cell">Gambar</th>
                        <th class="nama-sampah-cell">Nama Sampah</th>
                        <th class="deskripsi-cell">Deskripsi</th>
                        <th class="satuan-cell">Satuan</th>
                        @if($isCabang)
                        <th class="harga-cell">Harga Cabang</th>
                        @endif
                        <th class="action-cell">Aksi</th>
                    </tr>
                </thead>
                <tbody id="sampahTableBody">
                    @foreach ($sampah as $item)
                        <tr>
                            @if(!$isCabang)
                            <td class="checkbox-cell">
                                <input type="checkbox" class="sampah-checkbox" value="{{ $item->id }}" onchange="updateSelectedSampah()">
                            </td>
                            @endif
                            <td class="gambar-cell">
                                @if($item->gambar)
                                    <img src="{{ $item->gambar }}" alt="{{ $item->nama }}" class="sampah-gambar">
                                @else
                                    <div class="sampah-gambar" style="background: #F8F9FA; display: flex; align-items: center; justify-content: center; color: #6B7271;">No Image</div>
                                @endif
                            </td>
                            <td class="nama-sampah-cell">
                                <span class="sampah-nama">{{ $item->nama }}</span>
                            </td>
                            <td class="deskripsi-cell">
                                <span class="sampah-deskripsi">{{ $item->deskripsi ? Str::limit($item->deskripsi, 50) : 'Tidak ada deskripsi' }}</span>
                            </td>
                            <td class="satuan-cell">
                                <span class="sampah-satuan">
                                    <span class="satuan-badge">{{ strtoupper($item->satuan) }}</span>
                                </span>
                            </td>
                            @if($isCabang)
                            <td class="harga-cell">
                                @php
                                    $hargaCabang = $item->prices->where('bank_sampah_id', $idBankSampah)->first();
                                @endphp
                                <span class="harga-cabang" id="harga-cabang-{{ $item->id }}">{{ $hargaCabang ? 'Rp' . number_format($hargaCabang->harga,0,',','.') : '-' }}</span>
                            </td>
                            @endif
                            <td class="action-cell">
                                <div class="action-buttons-cell">
                                    <a href="{{ route('dashboard.sampah.show', $item->id) }}" class="action-btn detail-btn" title="Detail">
                                        <img src="/icon/ic_detail.svg" alt="Detail">
                                    </a>
                                    @if($isCabang)
                                        <button class="action-btn edit-btn" title="Edit Harga" data-id="{{ $item->id }}" data-harga="{{ $hargaCabang ? $hargaCabang->harga : 0 }}">
                                            <img src="/icon/ic_edit.svg" alt="Edit Harga">
                                        </button>
                                    @else
                                        <a href="{{ route('dashboard.sampah.edit', $item->id) }}" class="action-btn edit-btn" title="Edit">
                                            <img src="/icon/ic_edit.svg" alt="Edit">
                                        </a>
                                        <button class="action-btn delete-btn" data-id="{{ $item->id }}" title="Hapus">
                                            <img src="/icon/ic_delete.svg" alt="Hapus">
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="no-results" id="noResults" style="display: none;">
                <h3>Belum ada data sampah</h3>
                <p>Mulai dengan menambahkan sampah pertama Anda</p>
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
            <h2 class="modal-title">Hapus Sampah</h2>
            <p class="modal-subtitle">Apakah Anda yakin ingin menghapus sampah yang dipilih?</p>
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
            <h2 class="modal-title">Export Excel Sampah</h2>
            <p class="modal-subtitle">Apakah Anda yakin ingin mengekspor data sampah?</p>
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
            <h2 class="modal-title">Export CSV Sampah</h2>
            <p class="modal-subtitle">Apakah Anda yakin ingin mengekspor data sampah?</p>
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
            <h2 class="modal-title">Export PDF Sampah</h2>
            <p class="modal-subtitle">Apakah Anda yakin ingin mengekspor data sampah?</p>
            <div class="modal-buttons">
                <button class="modal-button cancel-button" id="cancelPdfBtn">Batal</button>
                <button class="modal-button confirm-button" id="confirmPdfBtn">Export PDF</button>
            </div>
        </div>
    </div>

    <!-- Modal Edit Harga Cabang -->
    @if($isCabang)
    <div class="modal" id="editHargaModal">
        <div class="modal-content" style="max-width:400px;">
            <button class="modal-close" onclick="closeEditHargaModal()">
                <img src="{{ asset('icon/ic_close.svg') }}" alt="Close">
            </button>
            <h2 class="modal-title">Edit Harga Cabang</h2>
            <form id="formEditHarga" onsubmit="return submitEditHarga(event)">
                <input type="hidden" id="editHargaSampahId" name="sampah_id">
                <div class="form-group">
                    <label for="editHargaInput" class="form-label">Harga (Rp)</label>
                    <input type="number" id="editHargaInput" name="harga" class="form-input" min="0" required>
                </div>
                <div class="modal-buttons">
                    <button type="button" class="modal-button cancel-button" onclick="closeEditHargaModal()">Batal</button>
                    <button type="submit" class="modal-button confirm-button">Simpan</button>
                </div>
            </form>
        </div>
    </div>
    @endif

    <script>
        let selectedSampah = [];

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

        document.addEventListener('DOMContentLoaded', function() {
            // Show loading on initial page load
            showLoading('Memuat data...');
            
            // Hide loading after a short delay to simulate loading
            setTimeout(() => {
                hideLoading();
            }, 500);

            // Initial data loading
            const initialPaginationData = {
                current_page: {{ $sampah->currentPage() }},
                total: {{ $sampah->total() }},
                per_page: {{ $sampah->perPage() }},
                first_item: {{ $sampah->firstItem() ?? 0 }},
                last_item: {{ $sampah->lastItem() ?? 0 }}
            };
            
            // Handle no results and pagination visibility
            const tbody = document.getElementById('sampahTableBody');
            const noResults = document.getElementById('noResults');
            const paginationContainer = document.getElementById('paginationContainer');
            
            if ({{ $sampah->total() }} === 0) {
                tbody.style.display = 'none';
                noResults.style.display = 'block';
                paginationContainer.style.display = 'none';
            } else {
                tbody.style.display = 'table-row-group';
                noResults.style.display = 'none';
                paginationContainer.style.display = 'flex';
            }
            
            renderPagination(initialPaginationData);
            
            // Populate search input with current search term
            const urlParams = new URLSearchParams(window.location.search);
            const currentSearch = urlParams.get('search');
            if (currentSearch) {
                document.getElementById('searchInput').value = currentSearch;
            }
            
            setupEventListeners();
        });

        function setupEventListeners() {
            // Search only when Enter is pressed
            const searchInput = document.getElementById('searchInput');
            if (searchInput) {
                searchInput.addEventListener('keyup', function(e) {
                    if (e.key === 'Enter') {
                        filterSampah();
                    }
                });
            }
            const selectAll = document.getElementById('selectAll');
            if (selectAll) {
                selectAll.addEventListener('change', function() {
                    const checkboxes = document.querySelectorAll('.sampah-checkbox');
                    checkboxes.forEach(cb => { cb.checked = this.checked; });
                    updateSelectedSampah();
                });
            }
            const addButton = document.getElementById('addButton');
            if (addButton) {
                addButton.addEventListener('click', function() {
                    window.location.href = '{{ route("dashboard.sampah.create") }}';
                });
            }
            const deleteButton = document.getElementById('deleteButton');
            if (deleteButton) {
                deleteButton.addEventListener('click', function() {
                    if (selectedSampah.length > 0) { showDeleteModal(true); }
                });
            }
            const closeModalBtn = document.getElementById('closeModalBtn');
            if (closeModalBtn) closeModalBtn.addEventListener('click', closeDeleteModal);
            const cancelDeleteBtn = document.getElementById('cancelDeleteBtn');
            if (cancelDeleteBtn) cancelDeleteBtn.addEventListener('click', closeDeleteModal);
            const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
            if (confirmDeleteBtn) confirmDeleteBtn.addEventListener('click', confirmDelete);
            const sampahTableBody = document.getElementById('sampahTableBody');
            if (sampahTableBody) {
                sampahTableBody.addEventListener('click', function(e) {
                    if (e.target.closest('.detail-btn')) {
                        const id = e.target.closest('.detail-btn').getAttribute('data-id');
                        window.location.href = `/dashboard/sampah/${id}`;
                    } else if (e.target.closest('.edit-btn')) {
                        const btn = e.target.closest('.edit-btn');
                        const id = btn.getAttribute('data-id');
                        const harga = btn.getAttribute('data-harga');
                        if (typeof harga !== 'undefined' && harga !== null) {
                            openEditHargaModal(id, harga);
                        } else {
                            window.location.href = `/dashboard/sampah/${id}/edit`;
                        }
                    } else if (e.target.closest('.delete-btn')) {
                        const id = parseInt(e.target.closest('.delete-btn').getAttribute('data-id'));
                        selectedSampah = [id];
                        showDeleteModal(false);
                    }
                });
            }
            const deleteModal = document.getElementById('deleteModal');
            if (deleteModal) {
                deleteModal.addEventListener('click', function(e) { 
                    if (e.target === this) { 
                        closeDeleteModal(); 
                    } 
                });
            }
        }

        function filterSampah() {
            const searchTerm = document.getElementById('searchInput').value;
            
            // Show loading for search
            const overlay = document.getElementById('pageLoadingOverlay');
            const loadingText = overlay.querySelector('p');
            loadingText.textContent = 'Mencari data...';
            overlay.style.display = 'flex';
            
            // Always use server-side search for consistent browser behavior
            const url = new URL(window.location);
            if (searchTerm.trim() === '') {
                url.searchParams.delete('search');
                } else {
                url.searchParams.set('search', searchTerm);
            }
            url.searchParams.delete('page'); // Reset to first page when searching
            window.location.href = url.toString();
        }

        function changePage(page) {
            if (page < 1) return;
            
            // Show loading for pagination
            const overlay = document.getElementById('pageLoadingOverlay');
            const loadingText = overlay.querySelector('p');
            loadingText.textContent = 'Memuat halaman...';
            overlay.style.display = 'flex';
            
            // Always use server-side pagination
            const url = new URL(window.location);
            url.searchParams.set('page', page);
            window.location.href = url.toString();
        }

        function renderPagination(paginationData) {
            const paginationContainer = document.getElementById('paginationContainer');
            const paginationInfo = document.getElementById('paginationInfo');
            const pagination = document.getElementById('pagination');
            
            const { current_page, total, per_page, first_item, last_item } = paginationData;
            
            if (total === 0) {
                paginationInfo.textContent = '0-0 of 0';
                pagination.innerHTML = '';
                return;
            }
            
            paginationInfo.textContent = `${first_item}-${last_item} of ${total}`;
            
            const totalPages = Math.ceil(total / per_page);
            
            let paginationHTML = '';
            paginationHTML += `<button class="pagination-btn" onclick="changePage(${current_page - 1})" ${current_page <= 1 ? 'disabled' : ''}>&lt;</button>`;
            paginationHTML += `<button class="pagination-btn" onclick="changePage(${current_page + 1})" ${current_page >= totalPages ? 'disabled' : ''}>&gt;</button>`;
            pagination.innerHTML = paginationHTML;
        }

        function updateSelectedSampah() {
            const checkboxes = document.querySelectorAll('.sampah-checkbox:checked');
            selectedSampah = Array.from(checkboxes).map(cb => parseInt(cb.value));
            const selectAllCheckbox = document.getElementById('selectAll');
            const allCheckboxes = document.querySelectorAll('.sampah-checkbox');
            selectAllCheckbox.checked = allCheckboxes.length > 0 && selectedSampah.length === allCheckboxes.length;
            
            const deleteButton = document.getElementById('deleteButton');
            if (deleteButton) {
                if (selectedSampah.length > 0) {
                    deleteButton.style.display = 'flex';
                } else {
                    deleteButton.style.display = 'none';
                }
            }
        }

        function showDeleteModal(isMultiple) {
            const modal = document.getElementById('deleteModal');
            const title = document.querySelector('#deleteModal .modal-title');
            const subtitle = document.querySelector('#deleteModal .modal-subtitle');
            
            if (isMultiple) {
                title.textContent = 'Hapus Sampah';
                subtitle.textContent = `Apakah Anda yakin ingin menghapus ${selectedSampah.length} sampah yang dipilih?`;
            } else {
                title.textContent = 'Hapus Sampah';
                subtitle.textContent = 'Apakah Anda yakin ingin menghapus sampah ini?';
            }
            
            modal.classList.add('show');
        }

        function closeDeleteModal() { 
            const modal = document.getElementById('deleteModal');
            if (modal) modal.classList.remove('show'); 
        }

        function confirmDelete() {
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            let url = '';
            let body = {};
            let isMultiple = selectedSampah.length > 1;
            
            // Show loading for delete operation
            const overlay = document.getElementById('pageLoadingOverlay');
            const loadingText = overlay.querySelector('p');
            loadingText.textContent = 'Menghapus data...';
            overlay.style.display = 'flex';
            
            if (isMultiple) {
                url = `/dashboard/sampah/0`;
                body = { ids: selectedSampah };
            } else {
                url = `/dashboard/sampah/${selectedSampah[0]}`;
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
                hideLoading();
                    closeDeleteModal();
                
                if (data.success) {
                    // Show success message
                    alert(data.message || 'Sampah berhasil dihapus');
                    // Reload page to reflect changes
                    location.reload();
                } else {
                    alert('Gagal menghapus sampah: ' + (data.message || 'Unknown error'));
                }
            })
            .catch(error => {
                console.error('Delete error:', error);
                hideLoading();
                closeDeleteModal();
                alert('Terjadi kesalahan saat menghapus sampah');
            });
        }

        // Export Functions
        function exportData(format) {
            const exportDropdown = document.getElementById('exportDropdown');
            if (exportDropdown) exportDropdown.classList.remove('show');
            switch(format) {
                case 'excel':
                    document.getElementById('exportExcelModal').classList.add('show');
                    break;
                case 'csv':
                    document.getElementById('exportCsvModal').classList.add('show');
                    break;
                case 'pdf':
                    document.getElementById('exportPdfModal').classList.add('show');
                    break;
                default:
                    alert('Format export tidak valid');
            }
        }

        function exportExcel() {
            showLoading('Mengexport Excel...');
            const formData = new FormData();
            formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
            fetch("{{ route('dashboard.sampah.export.excel') }}", {
                method: 'POST',
                body: formData
            })
            .then(response => {
                if (response.ok) {
                    return response.blob();
                }
                throw new Error('Export failed');
            })
            .then(blob => {
                const url = window.URL.createObjectURL(blob);
                const a = document.createElement('a');
                a.href = url;
                a.download = `sampah_export_${new Date().toISOString().slice(0, 10)}.xlsx`;
                document.body.appendChild(a);
                a.click();
                window.URL.revokeObjectURL(url);
                hideLoading();
                document.getElementById('exportExcelModal').classList.remove('show');
            })
            .catch(error => {
                console.error('Export error:', error);
                hideLoading();
                alert('Gagal export Excel: ' + error.message);
            });
        }

        function exportCsv() {
            showLoading('Mengexport CSV...');
            const formData = new FormData();
            formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
            fetch("{{ route('dashboard.sampah.export.csv') }}", {
                method: 'POST',
                body: formData
            })
            .then(response => {
                if (response.ok) {
                    return response.blob();
                }
                throw new Error('Export failed');
            })
            .then(blob => {
                const url = window.URL.createObjectURL(blob);
                const a = document.createElement('a');
                a.href = url;
                a.download = `sampah_export_${new Date().toISOString().slice(0, 10)}.csv`;
                document.body.appendChild(a);
                a.click();
                window.URL.revokeObjectURL(url);
                hideLoading();
                document.getElementById('exportCsvModal').classList.remove('show');
            })
            .catch(error => {
                console.error('Export error:', error);
                hideLoading();
                alert('Gagal export CSV: ' + error.message);
            });
        }

        function exportPdf() {
            showLoading('Mengexport PDF...');
            const formData = new FormData();
            formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
            fetch("{{ route('dashboard.sampah.export.pdf') }}", {
                method: 'POST',
                body: formData
            })
            .then(response => {
                if (response.ok) {
                    return response.blob();
                }
                throw new Error('Export failed');
            })
            .then(blob => {
                const url = window.URL.createObjectURL(blob);
                const a = document.createElement('a');
                a.href = url;
                a.download = `sampah_export_${new Date().toISOString().slice(0, 10)}.pdf`;
                document.body.appendChild(a);
                a.click();
                window.URL.revokeObjectURL(url);
                hideLoading();
                document.getElementById('exportPdfModal').classList.remove('show');
            })
            .catch(error => {
                console.error('Export error:', error);
                hideLoading();
                alert('Gagal export PDF: ' + error.message);
            });
        }

        // Export modal event listeners
        const exportButton = document.getElementById('exportButton');
        if (exportButton) {
            exportButton.addEventListener('click', function(e) {
                e.stopPropagation();
                const exportDropdown = document.getElementById('exportDropdown');
                if (exportDropdown) exportDropdown.classList.toggle('show');
            });
        }
        document.addEventListener('click', function(e) {
            const exportDropdown = document.getElementById('exportDropdown');
            if (exportDropdown && !e.target.closest('.export-dropdown')) {
                exportDropdown.classList.remove('show');
            }
            if (e.target.classList.contains('modal')) {
                e.target.classList.remove('show');
            }
        });
        const closeExportModalBtn = document.getElementById('closeExportModalBtn');
        if (closeExportModalBtn) closeExportModalBtn.addEventListener('click', function() {
            document.getElementById('exportExcelModal').classList.remove('show');
        });
        const cancelExportBtn = document.getElementById('cancelExportBtn');
        if (cancelExportBtn) cancelExportBtn.addEventListener('click', function() {
            document.getElementById('exportExcelModal').classList.remove('show');
        });
        const confirmExportBtn = document.getElementById('confirmExportBtn');
        if (confirmExportBtn) confirmExportBtn.addEventListener('click', function() {
            exportExcel();
        });
        const closeCsvModalBtn = document.getElementById('closeCsvModalBtn');
        if (closeCsvModalBtn) closeCsvModalBtn.addEventListener('click', function() {
            document.getElementById('exportCsvModal').classList.remove('show');
        });
        const cancelCsvBtn = document.getElementById('cancelCsvBtn');
        if (cancelCsvBtn) cancelCsvBtn.addEventListener('click', function() {
            document.getElementById('exportCsvModal').classList.remove('show');
        });
        const confirmCsvBtn = document.getElementById('confirmCsvBtn');
        if (confirmCsvBtn) confirmCsvBtn.addEventListener('click', function() {
            exportCsv();
        });
        const closePdfModalBtn = document.getElementById('closePdfModalBtn');
        if (closePdfModalBtn) closePdfModalBtn.addEventListener('click', function() {
            document.getElementById('exportPdfModal').classList.remove('show');
        });
        const cancelPdfBtn = document.getElementById('cancelPdfBtn');
        if (cancelPdfBtn) cancelPdfBtn.addEventListener('click', function() {
            document.getElementById('exportPdfModal').classList.remove('show');
        });
        const confirmPdfBtn = document.getElementById('confirmPdfBtn');
        if (confirmPdfBtn) confirmPdfBtn.addEventListener('click', function() {
            exportPdf();
        });

        @if($isCabang)
        let currentEditSampahId = null;
        function openEditHargaModal(sampahId, harga) {
            currentEditSampahId = sampahId;
            document.getElementById('editHargaSampahId').value = sampahId;
            document.getElementById('editHargaInput').value = harga > 0 ? harga : '';
            document.getElementById('editHargaModal').classList.add('show');
        }
        function closeEditHargaModal() {
            document.getElementById('editHargaModal').classList.remove('show');
        }
        function submitEditHarga(e) {
            e.preventDefault();
            const sampahId = document.getElementById('editHargaSampahId').value;
            const harga = document.getElementById('editHargaInput').value;
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            fetch(`/dashboard/sampah/${sampahId}/update-harga`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                },
                body: JSON.stringify({ harga })
            })
            .then(res => res.json())
            .then(data => {
                if(data.success) {
                    document.getElementById('harga-cabang-' + sampahId).textContent = 'Rp' + parseInt(harga).toLocaleString('id-ID');
                    closeEditHargaModal();
                    alert('Harga berhasil diupdate');
                } else {
                    alert(data.message || 'Gagal update harga');
                }
            })
            .catch(() => alert('Gagal update harga'));
            return false;
        }
        @endif
    </script>
</body>
</html>
@endsection