@extends('dashboard')
@section('content')
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Sampah - Admin Panel</title>
    <link href="https://fonts.googleapis.com/css2?family=Urbanist:wght@400;500;600;700;900&display=swap" rel="stylesheet">
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

        .detail-container {
            flex: 1;
            background: #fff;
            border: 1px solid #E5E6E6;
            border-radius: 16px;
            padding: 24px;
        }

        .detail-header {
            margin-bottom: 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .detail-title {
            font-family: 'Urbanist', sans-serif;
            font-size: 18px;
            font-weight: 700;
            color: #242E2C;
        }

        .detail-actions {
            display: flex;
            gap: 8px;
        }

        .btn-back {
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
            text-decoration: none;
            display: inline-flex;
            align-items: center;
        }

        .btn-back:hover {
            background: #F8F9FA;
        }

        .btn-edit {
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
            text-decoration: none;
            display: inline-flex;
            align-items: center;
        }

        .btn-edit:hover {
            background: #2d5a55;
        }

        .detail-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 24px;
        }

        .detail-section {
            margin-bottom: 24px;
        }

        .detail-section h3 {
            font-family: 'Urbanist', sans-serif;
            font-size: 16px;
            font-weight: 600;
            color: #374151;
            margin-bottom: 12px;
            padding-bottom: 8px;
            border-bottom: 1px solid #E5E6E6;
        }

        .detail-item {
            margin-bottom: 16px;
        }

        .detail-label {
            font-family: 'Urbanist', sans-serif;
            font-size: 14px;
            font-weight: 500;
            color: #6B7271;
            margin-bottom: 4px;
        }

        .detail-value {
            font-family: 'Urbanist', sans-serif;
            font-size: 16px;
            font-weight: 500;
            color: #1e293b;
        }

        .detail-image {
            max-width: 300px;
            max-height: 300px;
            border-radius: 12px;
            border: 1px solid #E5E6E6;
        }

        .price-section {
            grid-column: 1 / -1;
            background: #F8F9FA;
            border-radius: 12px;
            padding: 20px;
        }

        .price-section h3 {
            border-bottom: none;
            margin-bottom: 16px;
        }

        .price-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 12px;
        }

        .price-card {
            background: #fff;
            border: 1px solid #E5E6E6;
            border-radius: 8px;
            padding: 16px;
        }

        .price-card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 8px;
        }

        .bank-name {
            font-family: 'Urbanist', sans-serif;
            font-size: 14px;
            font-weight: 600;
            color: #374151;
        }

        .price-value {
            font-family: 'Urbanist', sans-serif;
            font-size: 16px;
            font-weight: 700;
            color: #39746E;
        }

        .price-date {
            font-family: 'Urbanist', sans-serif;
            font-size: 12px;
            color: #6B7271;
        }

        .no-image {
            width: 300px;
            height: 200px;
            background: #F8F9FA;
            border: 2px dashed #E5E6E6;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #6B7271;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <header class="header">
        <div class="header-left">
            <h1>Sampah</h1>
            <span class="header-separator">/</span>
            <span class="header-subtitle">Detail Sampah</span>
        </div>
        <div class="user-info">
            <div class="notification"></div>
            <span class="user-name">{{ Auth::guard('admin')->user()->role ?? 'Admin' }}</span>
            <div class="user-avatar">{{ strtoupper(substr(Auth::guard('admin')->user()->name ?? 'AD', 0, 2)) }}</div>
        </div>
    </header>

    <div class="main-container">
        <div class="detail-container">
            <div class="detail-header">
                <h2 class="detail-title">Detail Sampah</h2>
                <div class="detail-actions">
                    <a href="{{ route('dashboard.sampah') }}" class="btn-back">Kembali</a>
                    <a href="{{ route('dashboard.sampah.edit', $sampah->id) }}" class="btn-edit">Edit</a>
                </div>
            </div>

            <div class="detail-content">
                <div class="detail-section">
                    <h3>Informasi Dasar</h3>
                    
                    <div class="detail-item">
                        <div class="detail-label">Nama Sampah</div>
                        <div class="detail-value">{{ $sampah->nama }}</div>
                    </div>

                    <div class="detail-item">
                        <div class="detail-label">Deskripsi</div>
                        <div class="detail-value">{{ $sampah->deskripsi ?: 'Tidak ada deskripsi' }}</div>
                    </div>

                    <div class="detail-item">
                        <div class="detail-label">Satuan</div>
                        <div class="detail-value">{{ strtoupper($sampah->satuan) }}</div>
                    </div>

                    <div class="detail-item">
                        <div class="detail-label">Tanggal Dibuat</div>
                        <div class="detail-value">{{ $sampah->created_at->format('d M Y H:i') }}</div>
                    </div>

                    <div class="detail-item">
                        <div class="detail-label">Terakhir Diupdate</div>
                        <div class="detail-value">{{ $sampah->updated_at->format('d M Y H:i') }}</div>
                    </div>
                </div>

                <div class="detail-section">
                    <h3>Gambar</h3>
                    @if($sampah->gambar)
                        <img src="{{ $sampah->gambar }}" alt="{{ $sampah->nama }}" class="detail-image">
                    @else
                        <div class="no-image">Tidak ada gambar</div>
                    @endif
                </div>

                <div class="price-section">
                    <h3>Harga per Bank Sampah</h3>
                    @if($sampah->prices->count() > 0)
                        <div class="price-grid">
                            @foreach($sampah->prices as $price)
                                <div class="price-card">
                                    <div class="price-card-header">
                                        <span class="bank-name">{{ $price->bankSampah->nama_bank_sampah ?? '-' }}</span>
                                        <span class="price-value">Rp {{ number_format($price->harga, 0, ',', '.') }}</span>
                                    </div>
                                    <div class="price-date">Diupdate: {{ $price->updated_at->format('d M Y H:i') }}</div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="detail-value">Belum ada harga yang diatur</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</body>
</html>
@endsection 