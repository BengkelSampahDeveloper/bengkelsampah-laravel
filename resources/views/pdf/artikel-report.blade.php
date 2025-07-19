<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Artikel Bengkel Sampah</title>
    <style>
        @page {
            margin: 2cm;
            size: A4;
        }
        
        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            font-size: 12px;
            line-height: 1.4;
            color: #333;
            margin: 0;
            padding: 0;
        }
        
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 3px solid #39746E;
            padding-bottom: 20px;
        }
        
        .header h1 {
            color: #39746E;
            font-size: 24px;
            font-weight: bold;
            margin: 0 0 10px 0;
        }
        
        .header .subtitle {
            font-size: 14px;
            color: #666;
            margin: 5px 0;
        }
        
        .info-section {
            margin-bottom: 25px;
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            border-left: 4px solid #39746E;
        }
        
        .info-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
        }
        
        .info-label {
            font-weight: bold;
            color: #39746E;
            min-width: 120px;
        }
        
        .info-value {
            color: #333;
        }
        
        .table-container {
            margin-top: 20px;
        }
        
        .artikel-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            font-size: 10px;
        }
        
        .artikel-table th {
            background-color: #39746E;
            color: white;
            padding: 12px 8px;
            text-align: left;
            font-weight: bold;
            border: 1px solid #ddd;
        }
        
        .artikel-table td {
            padding: 10px 8px;
            border: 1px solid #ddd;
            vertical-align: top;
        }
        
        .artikel-table tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        
        .content-cell {
            max-width: 200px;
            word-wrap: break-word;
            line-height: 1.3;
        }
        
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 10px;
            color: #666;
            border-top: 1px solid #ddd;
            padding-top: 15px;
        }
        
        .page-number {
            text-align: center;
            font-size: 10px;
            color: #666;
            margin-top: 10px;
        }
        
        .category-badge {
            background-color: #e9ecef;
            color: #495057;
            padding: 2px 6px;
            border-radius: 3px;
            font-size: 9px;
            font-weight: bold;
        }
        
        .no-data {
            text-align: center;
            padding: 40px;
            color: #666;
            font-style: italic;
        }
        
        .summary-stats {
            display: flex;
            justify-content: space-around;
            margin: 20px 0;
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
        }
        
        .stat-item {
            text-align: center;
        }
        
        .stat-number {
            font-size: 24px;
            font-weight: bold;
            color: #39746E;
        }
        
        .stat-label {
            font-size: 12px;
            color: #666;
            margin-top: 5px;
        }
        
        .cover-link {
            color: #007bff;
            text-decoration: underline;
            font-size: 10px;
            font-weight: 500;
        }
        
        .cover-link:hover {
            color: #0056b3;
        }
        
        .no-cover {
            color: #999;
            font-style: italic;
            font-size: 10px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>LAPORAN DATA ARTIKEL</h1>
        <div class="subtitle">BENGKEL SAMPAH</div>
        <div class="subtitle">Sistem Manajemen Artikel</div>
    </div>
    
    <div class="info-section">
        <div class="info-row">
            <span class="info-label">Periode:</span>
            <span class="info-value">{{ ucfirst(str_replace('_', ' ', $period)) }}</span>
        </div>
        <div class="info-row">
            <span class="info-label">Total Artikel:</span>
            <span class="info-value">{{ $artikels->count() }} artikel</span>
        </div>
        <div class="info-row">
            <span class="info-label">Kategori Filter:</span>
            <span class="info-value">{{ $categoryFilter ?? 'Semua Kategori' }}</span>
        </div>
        <div class="info-row">
            <span class="info-label">Tanggal Export:</span>
            <span class="info-value">{{ now()->format('d F Y H:i:s') }}</span>
        </div>
    </div>
    
    @if($artikels->count() > 0)
        <div class="summary-stats">
            <div class="stat-item">
                <div class="stat-number">{{ $artikels->count() }}</div>
                <div class="stat-label">Total Artikel</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">{{ $artikels->unique('kategori_id')->count() }}</div>
                <div class="stat-label">Kategori</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">{{ $artikels->unique('creator')->count() }}</div>
                <div class="stat-label">Creator</div>
            </div>
        </div>
        
        <div class="table-container">
            <table class="artikel-table">
                <thead>
                    <tr>
                        <th style="width: 5%;">No</th>
                        <th style="width: 8%;">ID</th>
                        <th style="width: 20%;">Judul Artikel</th>
                        <th style="width: 10%;">Kategori</th>
                        <th style="width: 10%;">Creator</th>
                        <th style="width: 10%;">Tanggal Dibuat</th>
                        <th style="width: 15%;">URL Cover</th>
                        <th style="width: 22%;">Content</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($artikels as $index => $artikel)
                    <tr>
                        <td style="text-align: center;">{{ $index + 1 }}</td>
                        <td style="text-align: center;">{{ $artikel->id }}</td>
                        <td><strong>{{ $artikel->title }}</strong></td>
                        <td>
                            <span class="category-badge">{{ $artikel->kategori->nama ?? '-' }}</span>
                        </td>
                        <td>{{ $artikel->creator }}</td>
                        <td>{{ $artikel->created_at->format('d/m/Y H:i') }}</td>
                        <td>
                            @if($artikel->cover)
                                <a href="{{ $artikel->cover }}" class="cover-link">
                                    Lihat Cover Image
                                </a>
                            @else
                                <span class="no-cover">Tidak ada cover</span>
                            @endif
                        </td>
                        <td class="content-cell">
                            {{ Str::limit(strip_tags($artikel->content), 120) }}
                            @if(strlen(strip_tags($artikel->content)) > 120)
                                ...
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="no-data">
            <h3>Tidak ada data artikel untuk periode yang dipilih</h3>
            <p>Silakan pilih periode lain atau tambahkan artikel baru.</p>
        </div>
    @endif
    
    <div class="footer">
        <p>Laporan ini dibuat secara otomatis oleh sistem Bengkel Sampah</p>
        <p>© {{ date('Y') }} Bengkel Sampah. All rights reserved.</p>
    </div>
    
    <div class="page-number">
        Halaman 1
    </div>
</body>
</html> 