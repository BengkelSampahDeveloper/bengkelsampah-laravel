<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Data Sampah</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; color: #222; }
        h2 { text-align: center; color: #39746E; margin-bottom: 0; }
        h3 { color: #39746E; margin-top: 20px; margin-bottom: 10px; }
        .subtitle { text-align: center; margin-bottom: 16px; font-size: 13px; }
        table { width: 100%; border-collapse: collapse; margin-top: 16px; }
        th, td { border: 1px solid #bbb; padding: 6px 8px; }
        th { background: #39746E; color: #fff; font-weight: bold; text-align: center; }
        td { vertical-align: top; }
        .text-center { text-align: center; }
        
        /* Grid layout for prices */
        .prices-section { margin-top: 30px; }
        .prices-grid { 
            display: grid; 
            grid-template-columns: repeat(5, 1fr); 
            gap: 12px; 
            margin-top: 15px;
        }
        /* Responsive grid for different screen sizes */
        @media print {
            .prices-grid {
                grid-template-columns: repeat(4, 1fr);
                gap: 10px;
            }
        }
        .sampah-card {
            border: 1px solid #ddd;
            border-radius: 6px;
            padding: 10px;
            background: #f9f9f9;
            min-height: 120px;
        }
        .sampah-name {
            font-weight: bold;
            color: #39746E;
            font-size: 13px;
            margin-bottom: 8px;
            text-align: center;
            border-bottom: 1px solid #ddd;
            padding-bottom: 5px;
        }
        .price-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 3px;
            font-size: 10px;
            line-height: 1.2;
        }
        .bank-name {
            font-weight: 500;
            color: #555;
        }
        .price-value {
            font-weight: bold;
            color: #39746E;
        }
        .no-price {
            color: #999;
            font-style: italic;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 10px;
            color: #666;
            border-top: 1px solid #ddd;
            padding-top: 15px;
        }
    </style>
</head>
<body>
    <h2>LAPORAN DATA SAMPAH</h2>
    <div class="subtitle">
        Tanggal Export: {{ $exportDate }}<br>
        Total Data: {{ $totalData }} sampah
    </div>
    
    <!-- Main table without bank columns -->
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>ID Sampah</th>
                <th>Nama Sampah</th>
                <th>Deskripsi</th>
                <th>Satuan</th>
                <th>Tanggal Dibuat</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sampah as $index => $item)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td class="text-center">{{ $item->id }}</td>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->deskripsi ?? '-' }}</td>
                    <td class="text-center">{{ strtoupper($item->satuan) }}</td>
                    <td class="text-center">{{ $item->created_at->format('d/m/Y H:i') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Prices per branch section -->
    <div class="prices-section">
        <h3>DAFTAR HARGA SAMPAH PER CABANG</h3>
        <table width="100%" style="border-collapse: separate; border-spacing: 10px 10px;">
            @php $columns = 4; $i = 0; @endphp
            <tr>
            @foreach ($sampah as $item)
                <td style="border:1px solid #ddd; border-radius:6px; padding:8px; width:{{ 100/$columns }}%; vertical-align:top; background:#f9f9f9;">
                    <div style="font-weight:bold; color:#39746E; text-align:center; margin-bottom:6px; border-bottom:1px solid #eee; padding-bottom:4px; font-size:13px;">{{ $item->nama }}</div>
                    @foreach ($banks as $bank)
                        <div style="font-size:10px; display:flex; justify-content:space-between; margin-bottom:2px;">
                            <span style="color:#555;">{{ $bank->nama_bank_sampah }}</span>
                            <span style="font-weight:bold; color:#39746E;">{{ optional($item->prices->where('bank_sampah_id', $bank->id)->first())->harga ?? '-' }}</span>
                        </div>
                    @endforeach
                </td>
                @php $i++; @endphp
                @if ($i % $columns == 0)
                    </tr><tr>
                @endif
            @endforeach
            @if ($i % $columns != 0)
                @for ($j = 0; $j < $columns - ($i % $columns); $j++)
                    <td style="border:none;"></td>
                @endfor
            @endif
            </tr>
        </table>
    </div>
    <div class="footer">
        <p>Laporan ini dibuat secara otomatis oleh sistem Bengkel Sampah</p>
        <p>© {{ date('Y') }} Bengkel Sampah. Semua hak cipta dilindungi.</p>
    </div>
</body>
</html> 