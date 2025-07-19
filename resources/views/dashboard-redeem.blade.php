@extends('dashboard')

@section('title', 'Poin')

@section('content')
@include('partials.dashboard-header-bar', ['title' => 'Poin'])
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Poin - Admin Panel</title>
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

        .date-filter {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .date-filter input[type="date"] {
            width: 150px;
            padding: 6px 12px;
            border: 1px solid #E5E6E6;
            border-radius: 8px;
            font-family: 'Urbanist', sans-serif;
            font-size: 14px;
            color: #6B7271;
        }

        .date-filter input[type="date"]:focus {
            outline: none;
            border-color: #0FB7A6;
            box-shadow: 0 0 0 2px rgba(15, 183, 166, 0.1);
        }

        .btn-tambah-redeem {
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

        .btn-tambah-redeem:hover {
            background: #2d5a55;
        }

        .btn-tambah-redeem img {
            filter: brightness(0) invert(1);
        }

        .action-buttons {
            display: flex;
            gap: 6px;
        }

        .action-cell {
            text-align: center;
        }

        .action-buttons-cell {
            display: flex;
            gap: 4px;
            justify-content: center;
        }

        .action-btn {
            width: 32px;
            height: 32px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background-color 0.2s;
            text-decoration: none;
            background: transparent;
        }

        .detail-btn {
            background: transparent;
        }

        .detail-btn:hover {
            background: #F8F9FA;
        }

        .action-btn img {
            width: 16px;
            height: 16px;
        }

        .table-container {
            background: white;
            border-radius: 8px;
            overflow: hidden;
            margin-top: 8px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th {
            padding: 12px 16px;
            text-align: left;
            font-family: 'Urbanist', sans-serif;
            font-size: 14px;
            font-weight: 400;
            color: #6B7271;
            border-top: 1px solid #E5E6E6;
            border-bottom: 1px solid #E5E6E6;
        }

        .table td {
            padding: 0.5rem;
            border-bottom: 1px solid #e2e8f0;
            color: #1e293b;
        }

        .table tbody tr:hover {
            background: #F8F9FA;
        }

        .badge {
            padding: 4px 8px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
        }

        .badge-danger {
            background: #FDCED1;
            color: #F73541;
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

        .btn-info {
            background: #E3F4F1;
            color: #0FB7A6;
        }

        .btn-info:hover {
            background: #D1F2EB;
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

        .form-group {
            margin-bottom: 1rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: #39746E;
            font-size: 14px;
        }

        .form-control {
            width: 100%;
            padding: 8px 12px;
            border: 1px solid #E5E6E6;
            border-radius: 8px;
            font-size: 14px;
            font-family: 'Urbanist', sans-serif;
        }

        .form-control:focus {
            outline: none;
            border-color: #0FB7A6;
            box-shadow: 0 0 0 2px rgba(15, 183, 166, 0.1);
        }

        .form-control-file {
            padding: 6px 0;
        }

        .form-text {
            font-size: 12px;
            color: #6B7271;
            margin-top: 0.25rem;
        }

        .list-group {
            border: 1px solid #E5E6E6;
            border-radius: 8px;
            overflow: hidden;
        }

        .list-group-item {
            padding: 12px 16px;
            border-bottom: 1px solid #E5E6E6;
            background: #fff;
        }

        .list-group-item:last-child {
            border-bottom: none;
        }

        .list-group-item:hover {
            background: #F8F9FA;
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

        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 0.5rem;
            margin-top: 2rem;
        }

        .page-link {
            padding: 8px 12px;
            border: 1px solid #E5E6E6;
            background: #fff;
            color: #39746E;
            text-decoration: none;
            border-radius: 6px;
            font-size: 14px;
        }

        .page-link:hover {
            background: #F8F9FA;
        }

        .page-item.active .page-link {
            background: #39746E;
            color: #fff;
            border-color: #39746E;
        }

        .page-item.disabled .page-link {
            color: #6B7271;
            pointer-events: none;
            background: #F8F9FA;
        }

        /* Redeem Form Styles */
        .redeem-form-container {
            background: #fff;
            border: 1px solid #E5E6E6;
            border-radius: 16px;
            padding: 24px;
            margin-bottom: 2rem;
        }

        .redeem-form-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .redeem-form-title {
            font-size: 18px;
            font-weight: 700;
            color: #39746E;
        }

        .close-button {
            background: none;
            border: none;
            font-size: 20px;
            color: #6B7271;
            cursor: pointer;
            padding: 0;
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .close-button:hover {
            color: #39746E;
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

        /* Pagination Styles */
        .pagination-container {
            display: flex;
            justify-content: flex-end;
            align-items: flex-end;
            margin-top: 8px;
        }

        .pagination-info {
            font-family: 'Urbanist', sans-serif;
            font-size: 16px;
            font-weight: 500;
            color: #6B7271;
            margin-right: 8px;
            margin-bottom: 4px;
        }

        .pagination-btn {
            font-family: 'Urbanist', sans-serif;
            font-size: 18px;
            font-weight: 700;
            color: #39746E;
            background: none;
            border: none;
            padding: 4px 8px;
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
            padding: 2rem;
            color: #6B7271;
            font-family: 'Urbanist', sans-serif;
            font-size: 16px;
        }

        .btn-reset-filter {
            margin-left: 12px;
            padding: 8px 12px;
            background: #F8F9FA;
            border: 1px solid #E5E6E6;
            border-radius: 6px;
            cursor: pointer;
            font-size: 13px;
            font-weight: 500;
            color: #6B7271;
            transition: all 0.2s ease;
            font-family: 'Urbanist', sans-serif;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            height: 36px;
        }

        .btn-reset-filter:hover {
            background: #E9ECEF;
            border-color: #DEE2E6;
            color: #495057;
        }

        .btn-reset-filter svg {
            width: 14px;
            height: 14px;
        }

        /* Export Dropdown Styles */
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
    </style>
</head>
<body>
    <!-- Loading Overlay -->
    <div class="loading-overlay" id="pageLoadingOverlay" style="display: none;">
        <div class="loading-content">
            <div class="loading-spinner-large"></div>
            <p>Memuat data...</p>
        </div>
    </div>

    <div class="container">
        <div class="controls">
            <div class="search-filter">
                <div class="search-box" id="searchBox">
                    <input type="text" class="search-input" placeholder="Cari data disini" id="searchInput">
                    <img src="{{ asset('icon/ic_search.svg') }}" alt="Search" class="search-icon">
                </div>
                <div class="date-filter">
                    <input type="date" id="startDate">
                    <span style="margin: 0 8px; color: #6B7271;">s/d</span>
                    <input type="date" id="endDate">
                    <button type="button" class="btn-reset-filter" id="resetFilterBtn">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M3 12C3 7.03 7.03 3 12 3C16.97 3 21 7.03 21 12C21 16.97 16.97 21 12 21C7.03 21 3 16.97 3 12Z" stroke="currentColor" stroke-width="2"/>
                            <path d="M12 7V12L15 15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                        Reset
                    </button>
                </div>
            </div>
            <div class="action-buttons">
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
                <button type="button" class="btn-tambah-redeem" onclick="window.location.href='/dashboard/poin/create'">
                    <img src="{{ asset('icon/ic_add.svg') }}" alt="Add">
                    <span>Tambah Redeem</span>
                            </button>
                        </div>
        </div>

        <!-- History Section -->
        <div class="table-container">
            @if($redeems->count() > 0)
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>User</th>
                            <th>Identifier</th>
                            <th>Jumlah Poin</th>
                            <th>Alasan</th>
                            <th class="action-cell">Bukti</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($redeems as $index => $redeem)
                        <tr>
                            <td>{{ $redeems->firstItem() + $index }}</td>
                            <td>{{ \Carbon\Carbon::parse($redeem->tanggal)->format('d/m/Y') }}</td>
                            <td>{{ $redeem->user_name }}</td>
                            <td>{{ $redeem->user_identifier }}</td>
                            <td>
                                <span class="badge badge-danger">{{ number_format(abs($redeem->jumlah_point), 2, ',', '.') }} Poin</span>
                            </td>
                            <td>{{ $redeem->keterangan }}</td>
                            <td class="action-cell">
                                <div class="action-buttons-cell">
                                @if($redeem->bukti_redeem)
                                        <a href="{{ $redeem->bukti_redeem }}" target="_blank" class="action-btn detail-btn" title="Lihat Bukti">
                                            <img src="{{ asset('icon/ic_detail.svg') }}" alt="Detail">
                                    </a>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                
                <div class="pagination-container">
                    <div class="pagination-info" id="paginationInfo">
                        {{ $redeems->firstItem() ?? 0 }}-{{ $redeems->lastItem() ?? 0 }} of {{ $redeems->total() }}
                    </div>
                    <div class="pagination" id="pagination">
                        <button class="pagination-btn" onclick="window.location.href='{{ $redeems->previousPageUrl() }}'" {{ $redeems->onFirstPage() ? 'disabled' : '' }}>&lt;</button>
                        <button class="pagination-btn" onclick="window.location.href='{{ $redeems->nextPageUrl() }}'" {{ !$redeems->hasMorePages() ? 'disabled' : '' }}>&gt;</button>
                    </div>
                </div>
            @else
                <div class="no-results">
                    Tidak ada riwayat redeem yang ditemukan
                </div>
            @endif
            
            <!-- Hidden no-results div for JavaScript -->
            <div class="no-results" id="noResults" style="display: none;">
                Tidak ada riwayat redeem yang ditemukan
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
            <h2 class="modal-title">Export Excel Redeem</h2>
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
                            <input type="date" class="form-input" id="modalStartDate">
                        </div>
                        <div class="date-input-group">
                            <label class="form-label">Sampai Tanggal</label>
                            <input type="date" class="form-input" id="modalEndDate">
                        </div>
                    </div>
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
            <h2 class="modal-title">Export CSV Redeem</h2>
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
                            <input type="date" class="form-input" id="csvModalStartDate">
                        </div>
                        <div class="date-input-group">
                            <label class="form-label">Sampai Tanggal</label>
                            <input type="date" class="form-input" id="csvModalEndDate">
                        </div>
                    </div>
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
            <h2 class="modal-title">Export PDF Redeem</h2>
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
                            <input type="date" class="form-input" id="pdfModalStartDate">
                        </div>
                        <div class="date-input-group">
                            <label class="form-label">Sampai Tanggal</label>
                            <input type="date" class="form-input" id="pdfModalEndDate">
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="modal-buttons">
                <button class="modal-button cancel-button" id="cancelPdfBtn">Batal</button>
                <button class="modal-button confirm-button" id="confirmPdfBtn">Export PDF</button>
            </div>
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

        // Function to change page (for pagination)
        function changePage(page) {
            if (page < 1) return;
            
            const currentUrl = new URL(window.location);
            currentUrl.searchParams.set('page', page);
            window.location.href = currentUrl.toString();
        }

        // Search and filter functionality
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            const startDate = document.getElementById('startDate');
            const endDate = document.getElementById('endDate');
            const resetFilterBtn = document.getElementById('resetFilterBtn');
            
            // Show loading on initial page load
            showLoading('Memuat data...');
            
            // Hide loading after a short delay to simulate loading
            setTimeout(() => {
                hideLoading();
            }, 500);
            
            // Get URL parameters
            const urlParams = new URLSearchParams(window.location.search);
            const searchParam = urlParams.get('search');
            const startDateParam = urlParams.get('start_date');
            const endDateParam = urlParams.get('end_date');
            
            // Populate inputs with URL parameters
            if (searchParam) {
                searchInput.value = searchParam;
            }
            if (startDateParam) {
                startDate.value = startDateParam;
            }
            if (endDateParam) {
                endDate.value = endDateParam;
            }
            
            // Debounce function
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
            
            // Function to apply filters
            function applyFilters() {
                showLoading('Menerapkan filter...');
                
                const searchTerm = searchInput.value;
                const startDateValue = startDate.value;
                const endDateValue = endDate.value;
                
                // Build URL with parameters
                const currentUrl = new URL(window.location);
                currentUrl.searchParams.delete('page'); // Reset to first page
                
                if (searchTerm) {
                    currentUrl.searchParams.set('search', searchTerm);
                } else {
                    currentUrl.searchParams.delete('search');
                }
                
                // Only add date parameters if both dates are provided
                if (startDateValue && endDateValue) {
                    currentUrl.searchParams.set('start_date', startDateValue);
                    currentUrl.searchParams.set('end_date', endDateValue);
                } else {
                    currentUrl.searchParams.delete('start_date');
                    currentUrl.searchParams.delete('end_date');
                }
                
                // Navigate to filtered URL
                window.location.href = currentUrl.toString();
            }
            
            // Debounced version of applyFilters
            const debouncedApplyFilters = debounce(applyFilters, 300);
            
            // Function to check if both dates are selected and apply filter
            function checkAndApplyDateFilter() {
                if (startDate.value && endDate.value) {
                    // Validate that end date is not before start date
                    if (new Date(endDate.value) >= new Date(startDate.value)) {
                        debouncedApplyFilters();
                    } else {
                        // If end date is before start date, clear end date
                        endDate.value = '';
                        alert('Tanggal akhir tidak boleh sebelum tanggal awal');
                    }
                }
            }
            
            // Event listeners
            // Search only on Enter key
            searchInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    applyFilters();
                }
            });
            
            // Date filter on change with debouncing
            startDate.addEventListener('change', checkAndApplyDateFilter);
            
            endDate.addEventListener('change', checkAndApplyDateFilter);
            
            // Reset filter button
            resetFilterBtn.addEventListener('click', function() {
                searchInput.value = '';
                startDate.value = '';
                endDate.value = '';
                applyFilters();
            });
            
            // Also apply filters when both dates are manually entered
            startDate.addEventListener('blur', checkAndApplyDateFilter);
            
            endDate.addEventListener('blur', checkAndApplyDateFilter);
            
            // Pagination click event
            document.addEventListener('click', function(e) {
                if (e.target.closest('.pagination-btn')) {
                    showLoading('Memuat halaman...');
                }
            });
            
            // Export dropdown functionality
            const exportButton = document.getElementById('exportButton');
            const exportDropdown = document.getElementById('exportDropdown');
            
            exportButton.addEventListener('click', function(e) {
                e.stopPropagation();
                exportDropdown.classList.toggle('show');
            });
            
            // Close dropdown when clicking outside
            document.addEventListener('click', function(e) {
                if (!e.target.closest('.export-dropdown')) {
                    exportDropdown.classList.remove('show');
                }
            });
            
            // Export functions
            window.exportData = function(type) {
                exportDropdown.classList.remove('show');
                
                if (type === 'excel') {
                    showExportExcelModal();
                } else if (type === 'csv') {
                    showExportCsvModal();
                } else if (type === 'pdf') {
                    showExportPdfModal();
                } else {
                    alert('Format export ' + type + ' belum tersedia');
                }
            };

            // Export Excel Modal Functions
            function showExportExcelModal() {
                const modal = document.getElementById('exportExcelModal');
                modal.classList.add('show');
                
                // Set default dates
                const today = new Date();
                const yesterday = new Date(today);
                yesterday.setDate(yesterday.getDate() - 1);
                
                document.getElementById('modalStartDate').value = yesterday.toISOString().split('T')[0];
                document.getElementById('modalEndDate').value = today.toISOString().split('T')[0];
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
                const startDate = document.getElementById('modalStartDate').value;
                const endDate = document.getElementById('modalEndDate').value;
                
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
                
                // Build export URL with parameters
                let exportUrl = '/dashboard/poin/export/excel?';
                const params = new URLSearchParams();
                
                params.append('period', period);
                if (period === 'range') {
                    params.append('start_date', startDate);
                    params.append('end_date', endDate);
                }
                
                exportUrl += params.toString();
                
                // Download file
                window.location.href = exportUrl;
                
                // Close modal
                closeExportExcelModal();
                
                // Hide loading after a delay
                setTimeout(() => {
                    hideLoading();
                }, 2000);
            }

            // Modal event listeners
            document.getElementById('closeExportModalBtn').addEventListener('click', closeExportExcelModal);
            document.getElementById('cancelExportBtn').addEventListener('click', closeExportExcelModal);
            document.getElementById('confirmExportBtn').addEventListener('click', confirmExportExcel);
            document.getElementById('exportPeriod').addEventListener('change', handleExportPeriodChange);

            // Close modal when clicking outside
            document.getElementById('exportExcelModal').addEventListener('click', function(e) {
                if (e.target === this) {
                    closeExportExcelModal();
                }
            });

            // Export CSV Modal Functions
            function showExportCsvModal() {
                const modal = document.getElementById('exportCsvModal');
                modal.classList.add('show');
                
                // Set default dates
                const today = new Date();
                const yesterday = new Date(today);
                yesterday.setDate(yesterday.getDate() - 1);
                
                document.getElementById('csvModalStartDate').value = yesterday.toISOString().split('T')[0];
                document.getElementById('csvModalEndDate').value = today.toISOString().split('T')[0];
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
                const startDate = document.getElementById('csvModalStartDate').value;
                const endDate = document.getElementById('csvModalEndDate').value;
                
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
                
                // Build export URL with parameters
                let exportUrl = '/dashboard/poin/export/csv?';
                const params = new URLSearchParams();
                
                params.append('period', period);
                if (period === 'range') {
                    params.append('start_date', startDate);
                    params.append('end_date', endDate);
                }
                
                exportUrl += params.toString();
                
                // Download file
                window.location.href = exportUrl;
                
                // Close modal
                closeExportCsvModal();
                
                // Hide loading after a delay
            setTimeout(() => {
                    hideLoading();
            }, 2000);
            }

            // CSV Modal event listeners
            document.getElementById('closeCsvModalBtn').addEventListener('click', closeExportCsvModal);
            document.getElementById('cancelCsvBtn').addEventListener('click', closeExportCsvModal);
            document.getElementById('confirmCsvBtn').addEventListener('click', confirmExportCsv);
            document.getElementById('csvExportPeriod').addEventListener('change', handleCsvPeriodChange);

            // Close CSV modal when clicking outside
            document.getElementById('exportCsvModal').addEventListener('click', function(e) {
                if (e.target === this) {
                    closeExportCsvModal();
                }
            });

            // Export PDF Modal Functions
            function showExportPdfModal() {
                const modal = document.getElementById('exportPdfModal');
                modal.classList.add('show');
                
                // Set default dates
                const today = new Date();
                const yesterday = new Date(today);
                yesterday.setDate(yesterday.getDate() - 1);
                
                document.getElementById('pdfModalStartDate').value = yesterday.toISOString().split('T')[0];
                document.getElementById('pdfModalEndDate').value = today.toISOString().split('T')[0];
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
                const startDate = document.getElementById('pdfModalStartDate').value;
                const endDate = document.getElementById('pdfModalEndDate').value;
                
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
                
                // Build export URL with parameters
                let exportUrl = '/dashboard/poin/export/pdf?';
                const params = new URLSearchParams();
                
                params.append('period', period);
                if (period === 'range') {
                    params.append('start_date', startDate);
                    params.append('end_date', endDate);
                }
                
                exportUrl += params.toString();
                
                // Download file
                window.location.href = exportUrl;
                
                // Close modal
                closeExportPdfModal();
                
                // Hide loading after a delay
                setTimeout(() => {
                    hideLoading();
                }, 2000);
            }

            // PDF Modal event listeners
            document.getElementById('closePdfModalBtn').addEventListener('click', closeExportPdfModal);
            document.getElementById('cancelPdfBtn').addEventListener('click', closeExportPdfModal);
            document.getElementById('confirmPdfBtn').addEventListener('click', confirmExportPdf);
            document.getElementById('pdfExportPeriod').addEventListener('change', handlePdfPeriodChange);

            // Close PDF modal when clicking outside
            document.getElementById('exportPdfModal').addEventListener('click', function(e) {
                if (e.target === this) {
                    closeExportPdfModal();
                }
            });
});
</script>

</body>
</html>
@endsection 