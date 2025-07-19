<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Data User Bengkel Sampah</title>
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
            flex: 0 0 24%;
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
    </style>
</head>
<body>
    <div class="header">
        <h1>LAPORAN DATA USER</h1>
        <p>Bengkel Sampah - Sistem Manajemen User</p>
        <p>Total Data: {{ $users->count() }} user</p>
        <p>Tanggal Export: {{ now()->format('d F Y H:i:s') }}</p>
    </div>

    <!-- Statistik Umum -->
    <table class="summary-table" style="width:100%; margin: 20px 0 25px 0; border-collapse: separate; border-spacing: 12px 0; background: #f8f9fa; border-radius: 8px;">
        <tr>
            <td class="stat-td">
                <div class="stat-number">{{ $totalUsers ?? 0 }}</div>
                <div class="stat-label">Total User</div>
            </td>
            <td class="stat-td">
                <div class="stat-number">{{ number_format($totalPoint ?? 0, 0) }}</div>
                <div class="stat-label">Total Point</div>
            </td>
            <td class="stat-td">
                <div class="stat-number">{{ $totalSetoran ?? 0 }}</div>
                <div class="stat-label">Total Setoran</div>
            </td>
            <td class="stat-td" colspan="2">
                <div class="stat-number">{{ number_format($totalSampah ?? 0, 2) }} kg/unit</div>
                <div class="stat-label">Total Sampah</div>
            </td>
        </tr>
    </table>

    <!-- Tabel Detail User -->
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th style="width: 3%;">No</th>
                    <th style="width: 5%;">ID</th>
                    <th style="width: 15%;">Nama Lengkap</th>
                    <th style="width: 12%;">Identifier</th>
                    <th style="width: 8%;">Point</th>
                    <th style="width: 8%;">XP</th>
                    <th style="width: 10%;">Jumlah Setoran</th>
                    <th style="width: 39%;">Alamat</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $index => $user)
                @php
                    // Get user address
                    $userAddress = '-';
                    if ($user->addresses && $user->addresses->count() > 0) {
                        // Try to find default address first
                        $defaultAddress = $user->addresses->where('is_default', true)->first();
                        if ($defaultAddress) {
                            $userAddress = $defaultAddress->label_alamat . ' (' . $defaultAddress->nomor_handphone . ') ' . 
                                          $defaultAddress->detail_lain . ', ' . $defaultAddress->kecamatan . ', ' . 
                                          $defaultAddress->kota_kabupaten . ', ' . $defaultAddress->provinsi . ' ' . 
                                          $defaultAddress->kode_pos;
                        } else {
                            // Use first address if no default
                            $firstAddress = $user->addresses->first();
                            $userAddress = $firstAddress->label_alamat . ' (' . $firstAddress->nomor_handphone . ') ' . 
                                          $firstAddress->detail_lain . ', ' . $firstAddress->kecamatan . ', ' . 
                                          $firstAddress->kota_kabupaten . ', ' . $firstAddress->provinsi . ' ' . 
                                          $firstAddress->kode_pos;
                        }
                    }
                @endphp
                <tr>
                    <td style="text-align: center;">{{ $index + 1 }}</td>
                    <td style="text-align: center;">{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->identifier }}</td>
                    <td style="text-align: center;">{{ number_format($user->poin ?? 0, 0) }}</td>
                    <td style="text-align: center;">{{ number_format($user->xp ?? 0, 0) }}</td>
                    <td style="text-align: center;">{{ $user->setor ?? 0 }}</td>
                    <td style="font-size: 10px;">{{ $userAddress }}</td>
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