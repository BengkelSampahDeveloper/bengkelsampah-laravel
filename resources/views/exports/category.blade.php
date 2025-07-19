<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Kategori Sampah Bengkel Sampah</title>
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
        
        .category-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            font-size: 10px;
        }
        
        .category-table th {
            background-color: #39746E;
            color: white;
            padding: 12px 8px;
            text-align: left;
            font-weight: bold;
            border: 1px solid #ddd;
        }
        
        .category-table td {
            padding: 10px 8px;
            border: 1px solid #ddd;
            vertical-align: top;
        }
        
        .category-table tr:nth-child(even) {
            background-color: #f9f9f9;
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
        
        .no-data {
            text-align: center;
            padding: 40px;
            color: #666;
            font-style: italic;
        }
        
        .summary-stats {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin: 20px 0;
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            border: 1px solid #e9ecef;
            justify-content: flex-start;
        }
        
        .stat-item {
            flex: 0 0 24%; /* 4 per baris, sisakan gap */
            max-width: 24%;
            box-sizing: border-box;
            text-align: center;
            padding: 12px 6px;
            background-color: white;
            border-radius: 6px;
            border: 1px solid #dee2e6;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            margin-bottom: 0;
        }
        
        .stat-number {
            font-size: 20px;
            font-weight: bold;
            color: #39746E;
            margin-bottom: 6px;
            display: block;
        }
        
        .stat-label {
            font-size: 10px;
            color: #666;
            font-weight: 500;
            line-height: 1.2;
        }
        
        .sampah-list {
            font-size: 9px;
            color: #666;
            margin-top: 5px;
        }
        
        .sampah-item {
            display: inline-block;
            background-color: #E3F4F1;
            color: #39746E;
            padding: 1px 4px;
            border-radius: 2px;
            margin: 1px;
            font-size: 8px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>LAPORAN DATA KATEGORI SAMPAH</h1>
        <div class="subtitle">BENGKEL SAMPAH</div>
        <div class="subtitle">Sistem Manajemen Kategori</div>
    </div>
    
    <div class="info-section">
        <div class="info-row">
            <span class="info-label">Total Data:</span>
            <span class="info-value">{{ $totalData }} kategori</span>
        </div>
        <div class="info-row">
            <span class="info-label">Tanggal Export:</span>
            <span class="info-value">{{ $exportDate }}</span>
        </div>
    </div>

    

    <!-- Statistik Horizontal (summary-table) -->
    <table class="summary-table" style="width:100%; margin: 20px 0 25px 0; border-collapse: separate; border-spacing: 12px 0; background: #f8f9fa; border-radius: 16px;">
        <tr>
            <td class="stat-td" style="vertical-align: middle; text-align: center; padding: 32px 0; background: white; border-radius: 12px; border: 1.5px solid #e0e0e0;">
                <div class="stat-number" style="font-size: 2.8em; font-weight: bold; color: #39746E; margin-bottom: 10px; display: block; line-height: 1.1;">{{ $totalData }}</div>
                <div class="stat-label" style="font-size: 1.2em; color: #666; font-weight: 600; line-height: 1.2; margin-bottom: 0;">Total Kategori</div>
            </td>
            <td class="stat-td" style="vertical-align: middle; text-align: center; padding: 32px 0; background: white; border-radius: 12px; border: 1.5px solid #e0e0e0;">
                <div class="stat-number" style="font-size: 2.8em; font-weight: bold; color: #39746E; margin-bottom: 10px; display: block; line-height: 1.1;">{{ $categories->sum('sampah_count') }}</div>
                <div class="stat-label" style="font-size: 1.2em; color: #666; font-weight: 600; line-height: 1.2; margin-bottom: 0;">Total Item Sampah</div>
            </td>
        </tr>
    </table>

    <div class="table-container">
        @if($categories->count() > 0)
            <table class="category-table">
                <thead>
                    <tr>
                        <th style="width: 5%;">No</th>
                        <th style="width: 10%;">ID</th>
                        <th style="width: 25%;">Nama Kategori</th>
                        <th style="width: 15%;">Jumlah Sampah</th>
                        <th style="width: 25%;">Daftar Sampah</th>
                        <th style="width: 20%;">Tanggal Dibuat</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $index => $category)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $category->id }}</td>
                            <td style="font-weight: bold; color: #39746E;">{{ $category->nama }}</td>
                            <td style="text-align: center; font-weight: bold;">{{ $category->sampah_count }} item</td>
                            <td>
                                @if($category->sampahItems && $category->sampahItems->count() > 0)
                                    <div class="sampah-list">
                                        @foreach($category->sampahItems->take(5) as $sampah)
                                            <span class="sampah-item">{{ $sampah->nama }}</span>
                                        @endforeach
                                        @if($category->sampahItems->count() > 5)
                                            <span class="sampah-item">+{{ $category->sampahItems->count() - 5 }} lagi</span>
                                        @endif
                                    </div>
                                @else
                                    <span style="color: #999; font-style: italic;">Tidak ada data</span>
                                @endif
                            </td>
                            <td>{{ $category->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="no-data">
                Tidak ada data kategori untuk periode yang dipilih.
            </div>
        @endif
    </div>

    <div class="footer">
        <p>Laporan ini dibuat secara otomatis oleh sistem Bengkel Sampah</p>
        <p>© {{ date('Y') }} Bengkel Sampah. All rights reserved.</p>
    </div>

    <div class="page-number">
        Halaman 1
    </div>
</body>
</html> 