<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Bank Sampah Bengkel Sampah</title>
    <style>
        @page {
            margin: 2cm;
            size: A4 landscape;
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
        
        .header p {
            margin: 5px 0;
            font-size: 12px;
            color: #666;
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
        
        .summary-section {
            margin-bottom: 20px;
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            border-left: 4px solid #39746E;
        }
        
        .summary-title {
            font-size: 14px;
            font-weight: bold;
            color: #39746E;
            margin-bottom: 10px;
        }
        
        .summary-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 8px;
        }
        
        .summary-item {
            display: flex;
            justify-content: space-between;
            padding: 4px 0;
            border-bottom: 1px solid #eee;
            font-size: 11px;
        }
        
        .summary-label {
            font-weight: bold;
            color: #555;
        }
        
        .summary-value {
            color: #39746E;
        }
        
        .table-container {
            margin-top: 20px;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            font-size: 9px;
        }
        
        th {
            background-color: #39746E;
            color: white;
            padding: 10px 6px;
            text-align: left;
            font-weight: bold;
            border: 1px solid #ddd;
        }
        
        td {
            padding: 8px 6px;
            border: 1px solid #ddd;
            vertical-align: top;
        }
        
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        
        .image-link {
            color: #007bff;
            text-decoration: underline;
            font-size: 8px;
            font-weight: 500;
        }
        
        .no-image {
            color: #999;
            font-style: italic;
            font-size: 8px;
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
        
        .status-badge {
            background-color: #e9ecef;
            color: #495057;
            padding: 2px 6px;
            border-radius: 3px;
            font-size: 8px;
            font-weight: bold;
        }
        
        .summary-table {
            background: #f8f9fa;
            border-radius: 8px;
        }
        .summary-table .stat-td {
            padding: 18px 0 10px 0;
            vertical-align: middle;
            text-align: center;
            background: none;
            border: none;
            /* Border right untuk pemisah antar item, kecuali paling kanan */
            border-right: 1.5px solid #e0e0e0;
        }
        .summary-table tr td:last-child {
            border-right: none !important;
        }
        .summary-table .stat-number {
            font-size: 2.5em;
            font-weight: bold;
            color: #39746E;
            margin-bottom: 6px;
            display: block;
            line-height: 1.1;
        }
        .summary-table .stat-label {
            font-size: 1em;
            color: #666;
            font-weight: 500;
            line-height: 1.2;
            margin-bottom: 0;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>LAPORAN DATA BANK SAMPAH</h1>
        <p>Periode: {{ ucfirst(str_replace('_', ' ', $period)) }}</p>
        <p>Total Data: {{ $bankSampah->count() }} bank sampah</p>
        <p>Tanggal Export: {{ now()->format('d F Y H:i:s') }}</p>
    </div>

    <!-- Statistik Umum (Horizontal Table, Clean) -->
    <table class="summary-table" style="width:100%; margin: 20px 0 25px 0; border-collapse: separate; border-spacing: 12px 0; background: #f8f9fa; border-radius: 8px;">
        <tr>
            <td class="stat-td">
                <div class="stat-number">{{ $totalBankSampah ?? 0 }}</div>
                <div class="stat-label">Total Bank Sampah</div>
            </td>
            <td class="stat-td">
                <div class="stat-number">{{ $totalSetoran ?? 0 }}</div>
                <div class="stat-label">Total Setoran</div>
            </td>
            <td class="stat-td">
                <div class="stat-number">{{ number_format($totalSampahKg ?? 0, 1) }} kg</div>
                <div class="stat-label">Total Sampah (kg)</div>
            </td>
            <td class="stat-td">
                <div class="stat-number">{{ $totalSampahUnit ?? 0 }}</div>
                <div class="stat-label">Total Sampah (unit)</div>
            </td>
        </tr>
        <tr>
            <td class="stat-td">
                <div class="stat-number">{{ number_format($totalPoint ?? 0, 0) }}</div>
                <div class="stat-label">Total Point Terdistribusi</div>
            </td>
            <td class="stat-td">
                <div class="stat-number">{{ $totalPelangganUnik ?? 0 }}</div>
                <div class="stat-label">Total Pelanggan Unik</div>
            </td>
            <td class="stat-td">
                <div class="stat-number">Rp {{ number_format($totalPembelian ?? 0, 0) }}</div>
                <div class="stat-label">Total Pembelian</div>
            </td>
            <td class="stat-td">
                <div class="stat-number">{{ $totalAdmin ?? 0 }}</div>
                <div class="stat-label">Total Admin</div>
            </td>
        </tr>
    </table>

    <!-- Ringkasan Per Bank Sampah -->
    <div class="summary-section">
        <div class="summary-title">RINGKASAN PER BANK SAMPAH</div>
        <div class="summary-grid">
            @foreach($bankSampahSummary ?? [] as $summary)
            <div class="summary-item">
                <span class="summary-label">{{ $summary['nama'] }}:</span>
                <span class="summary-value">
                    {{ $summary['setoran'] }} setoran, 
                    {{ number_format($summary['sampah_kg'], 1) }} kg, 
                    {{ number_format($summary['sampah_unit'], 0) }} unit, 
                    {{ number_format($summary['point'], 0) }} point
                </span>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Tabel Detail Bank Sampah -->
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th style="width: 3%;">No</th>
                    <th style="width: 5%;">ID</th>
                    <th style="width: 8%;">Kode</th>
                    <th style="width: 15%;">Nama Bank Sampah</th>
                    <th style="width: 20%;">Alamat</th>
                    <th style="width: 12%;">Penanggung Jawab</th>
                    <th style="width: 10%;">Kontak</th>
                    <th style="width: 8%;">Tipe Layanan</th>
                    <th style="width: 8%;">Gambar</th>
                    <th style="width: 11%;">Statistik</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bankSampah as $index => $bank)
                <tr>
                    <td style="text-align: center;">{{ $index + 1 }}</td>
                    <td style="text-align: center;">{{ $bank->id }}</td>
                    <td>{{ $bank->kode_bank_sampah }}</td>
                    <td>{{ $bank->nama_bank_sampah }}</td>
                    <td>{{ $bank->alamat_bank_sampah }}</td>
                    <td>{{ $bank->nama_penanggung_jawab }}</td>
                    <td>{{ $bank->kontak_penanggung_jawab }}</td>
                    <td style="text-align: center;">
                        <span class="status-badge">{{ ucfirst($bank->tipe_layanan) }}</span>
                    </td>
                    <td style="text-align: center;">
                        @if($bank->foto)
                            <a href="{{ $bank->foto }}" target="_blank" class="image-link">Lihat Gambar</a>
                        @else
                            <span class="no-image">Tidak ada gambar</span>
                        @endif
                    </td>
                    <td style="font-size: 8px;">
                        Sampah KG: {{ number_format($bankStats[$bank->id]['sampah_kg'] ?? 0, 1) }} kg<br>
                        Sampah UNIT: {{ number_format($bankStats[$bank->id]['sampah_unit'] ?? 0, 0) }} unit<br>
                        Point: {{ number_format($bankStats[$bank->id]['point'] ?? 0, 0) }}<br>
                        Pelanggan: {{ $bankStats[$bank->id]['pelanggan'] ?? 0 }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="footer">
        <p>Laporan ini dibuat secara otomatis oleh sistem Bengkel Sampah</p>
        <p>© {{ date('Y') }} Bengkel Sampah. Semua hak cipta dilindungi.</p>
    </div>
</body>
</html> 