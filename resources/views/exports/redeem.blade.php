<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Redeem Poin Bengkel Sampah</title>
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
        
        .redeem-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            font-size: 10px;
        }
        
        .redeem-table th {
            background-color: #39746E;
            color: white;
            padding: 12px 8px;
            text-align: left;
            font-weight: bold;
            border: 1px solid #ddd;
        }
        
        .redeem-table td {
            padding: 10px 8px;
            border: 1px solid #ddd;
            vertical-align: top;
        }
        
        .redeem-table tr:nth-child(even) {
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
        
        .bukti-link {
            color: #007bff;
            text-decoration: underline;
            font-size: 10px;
            font-weight: 500;
        }
        
        .no-bukti {
            color: #999;
            font-style: italic;
            font-size: 10px;
        }
        
        .point-badge {
            background-color: #FDCED1;
            color: #F73541;
            padding: 2px 6px;
            border-radius: 3px;
            font-size: 9px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>LAPORAN DATA REDEEM POIN</h1>
        <div class="subtitle">BENGKEL SAMPAH</div>
        <div class="subtitle">Sistem Manajemen Poin</div>
    </div>
    
    <div class="info-section">
        <div class="info-row">
            <span class="info-label">Periode:</span>
            <span class="info-value">
                @switch($period)
                    @case('today')
                        Hari Ini
                        @break
                    @case('yesterday')
                        Kemarin
                        @break
                    @case('this_week')
                        Minggu Ini
                        @break
                    @case('last_week')
                        Minggu Lalu
                        @break
                    @case('this_month')
                        Bulan Ini
                        @break
                    @case('last_month')
                        Bulan Lalu
                        @break
                    @case('this_year')
                        Tahun Ini
                        @break
                    @case('last_year')
                        Tahun Lalu
                        @break
                    @case('range')
                        Range Waktu
                        @break
                    @default
                        Semua Data
                @endswitch
            </span>
        </div>
        <div class="info-row">
            <span class="info-label">Total Redeem:</span>
            <span class="info-value">{{ $redeems->count() }} redeem</span>
        </div>
        <div class="info-row">
            <span class="info-label">Total Poin Diredeem:</span>
            <span class="info-value">{{ number_format(abs($redeems->sum('jumlah_point'))) }} poin</span>
        </div>
        <div class="info-row">
            <span class="info-label">Tanggal Export:</span>
            <span class="info-value">{{ now()->format('d F Y H:i:s') }}</span>
        </div>
    </div>
    
    @if($redeems->count() > 0)
        <div class="summary-stats">
            <div class="stat-item">
                <div class="stat-number">{{ $redeems->count() }}</div>
                <div class="stat-label">Total Redeem</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">{{ $redeems->unique('user_id')->count() }}</div>
                <div class="stat-label">User Unik</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">{{ number_format(abs($redeems->sum('jumlah_point'))) }}</div>
                <div class="stat-label">Total Poin</div>
            </div>
        </div>
        
        <div class="table-container">
            <table class="redeem-table">
                <thead>
                    <tr>
                        <th style="width: 5%;">No</th>
                        <th style="width: 12%;">Tanggal</th>
                        <th style="width: 20%;">User</th>
                        <th style="width: 15%;">Identifier</th>
                        <th style="width: 12%;">Jumlah Poin</th>
                        <th style="width: 20%;">Alasan</th>
                        <th style="width: 16%;">Bukti Redeem</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($redeems as $index => $redeem)
                    <tr>
                        <td style="text-align: center;">{{ $index + 1 }}</td>
                        <td>{{ \Carbon\Carbon::parse($redeem->tanggal)->format('d/m/Y') }}</td>
                        <td><strong>{{ $redeem->user_name }}</strong></td>
                        <td>{{ $redeem->user_identifier }}</td>
                        <td>
                            <span class="point-badge">{{ number_format(abs($redeem->jumlah_point)) }} Poin</span>
                        </td>
                        <td>{{ $redeem->keterangan }}</td>
                        <td>
                            @if($redeem->bukti_redeem)
                                <a href="{{ $redeem->bukti_redeem }}" class="bukti-link">
                                    Lihat Bukti
                                </a>
                            @else
                                <span class="no-bukti">Tidak ada bukti</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="no-data">
            <h3>Tidak ada data redeem untuk periode yang dipilih</h3>
            <p>Silakan pilih periode lain atau cek kembali data redeem.</p>
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