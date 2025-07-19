<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Transaksi #{{ $transaction->id }}</title>
    <style>
        @page {
            margin: 3mm;
            size: 80mm auto; /* Auto height */
            padding: 0;
        }
        
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        
        body {
            margin: 0;
            padding: 3mm;
            font-family: 'Courier New', monospace;
            font-size: 9px;
            line-height: 1.2;
            color: #000;
            background: #fff;
            width: 74mm; /* Fixed width untuk 80mm paper minus margin */
            overflow: hidden;
        }
        
        .header {
            text-align: center;
            margin-bottom: 6px;
            border-bottom: 1px dashed #000;
            padding-bottom: 6px;
        }
        
        .logo {
            text-align: center;
            margin-bottom: 2px;
        }
        
        .logo img {
            width: 130px;
            height: auto;
            max-height: 150px;
            object-fit: contain;
        }
        
        .company-name {
            font-size: 10px;
            font-weight: bold;
            margin-bottom: 1px;
        }
        
        .company-address {
            font-size: 7px;
            margin-bottom: 1px;
        }
        
        .transaction-info {
            margin-bottom: 6px;
        }
        
        .transaction-id {
            font-size: 10px;
            font-weight: bold;
            text-align: center;
            margin-bottom: 3px;
        }
        
        .info-row {
            display: table;
            width: 100%;
            margin-bottom: 1px;
        }
        
        .info-label {
            display: table-cell;
            font-weight: bold;
            width: 40%;
            vertical-align: top;
        }
        
        .info-value {
            display: table-cell;
            text-align: right;
            width: 60%;
            vertical-align: top;
            word-break: break-word;
        }
        
        .divider {
            border-top: 1px dashed #000;
            margin: 4px 0;
            height: 1px;
            width: 100%;
        }
        
        .items-header {
            font-weight: bold;
            text-align: center;
            margin-bottom: 4px;
            border-bottom: 1px solid #000;
            padding-bottom: 2px;
            font-size: 9px;
        }
        
        .item-row {
            margin-bottom: 2px;
        }
        
        .item-name {
            font-weight: bold;
            margin-bottom: 1px;
            font-size: 8px;
        }
        
        .item-details {
            display: table;
            width: 100%;
            font-size: 7px;
            margin-left: 4px;
        }
        
        .item-details span:first-child {
            display: table-cell;
            width: 50%;
        }
        
        .item-details span:last-child {
            display: table-cell;
            text-align: right;
            width: 50%;
        }
        
        .total-section {
            border-top: 1px solid #000;
            margin-top: 4px;
            padding-top: 4px;
        }
        
        .total-row {
            display: table;
            width: 100%;
            margin-bottom: 1px;
        }
        
        .total-label {
            display: table-cell;
            font-weight: bold;
            width: 60%;
        }
        
        .total-value {
            display: table-cell;
            font-weight: bold;
            text-align: right;
            width: 40%;
        }
        
        .grand-total {
            font-size: 10px;
            font-weight: bold;
            border-top: 2px solid #000;
            padding-top: 2px;
            margin-top: 2px;
        }
        
        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 7px;
        }
        
        .thank-you {
            font-size: 9px;
            font-weight: bold;
            margin-bottom: 2px;
        }
        
        .status-badge {
            display: inline-block;
            padding: 1px 3px;
            border-radius: 2px;
            font-size: 7px;
            font-weight: bold;
            text-transform: uppercase;
            margin-top: 1px;
        }
        
        .status-selesai {
            background: #4CAF50;
            color: white;
        }
        
        .points-info {
            background: #f0f0f0;
            padding: 3px;
            margin: 4px 0;
            border-radius: 2px;
            font-size: 7px;
            border: 1px solid #ccc;
        }
        
        .points-row {
            display: table;
            width: 100%;
            margin-bottom: 1px;
        }
        
        .points-row span:first-child {
            display: table-cell;
            width: 60%;
        }
        
        .points-row span:last-child {
            display: table-cell;
            text-align: right;
            width: 40%;
            font-weight: bold;
        }
        
        /* Remove any potential height issues */
        html {
            height: auto !important;
        }
        
        body {
            height: auto !important;
            min-height: auto !important;
        }
        
        /* Print specific styles */
        @media print {
            body {
                -webkit-print-color-adjust: exact;
                color-adjust: exact;
                print-color-adjust: exact;
            }
            
            @page {
                margin: 3mm;
                size: 80mm auto;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <div class="logo">
            <img src="{{ asset('company/struk_logo.png') }}" alt="Logo">
        </div>
        <div class="company-name">{{ $bankSampah->nama_bank_sampah ?? 'Bank Sampah' }}</div>
        <div class="company-address">{{ $bankSampah->alamat_bank_sampah ?? 'Alamat Bank Sampah' }}</div>
        <div class="company-address">Telp: {{ $bankSampah->kontak_penanggung_jawab ?? '-' }}</div>
    </div>

    <!-- Transaction Info -->
    <div class="transaction-info">
        <div class="transaction-id">TRANSAKSI #{{ $transaction->id }}</div>

        <div class="info-row">
            <span class="info-label">Type:</span>
            <span class="info-value">{{ strtoupper($transaction->tipe_setor ?? '-') }}</span>
        </div>
        
        <div class="info-row">
            <span class="info-label">Customer Name:</span>
            <span class="info-value">{{ $transaction->user_name ?? '-' }}</span>
        </div>
        
        <div class="info-row">
            <span class="info-label">Customer Contact:</span>
            <span class="info-value">{{ $transaction->user_identifier ?? '-' }}</span>
        </div>
        
        @if($transaction->petugas_nama)
            <div class="info-row">
                <span class="info-label">Officer Name:</span>
                <span class="info-value">{{ $transaction->petugas_nama }}</span>
            </div>
            @if($transaction->petugas_contact)
                <div class="info-row">
                    <span class="info-label">Officer Contact:</span>
                    <span class="info-value">{{ $transaction->petugas_contact }}</span>
                </div>
            @endif
        @endif

        <div class="info-row">
            <span class="info-label">Tanggal Order:</span>
            <span class="info-value">{{ $transaction->created_at ? \Carbon\Carbon::parse($transaction->created_at)->format('d/m/Y H:i') : '-' }}</span>
        </div>
        
        <div class="info-row">
            <span class="info-label">Tanggal Selesai:</span>
            <span class="info-value">{{ $transaction->tanggal_selesai ? \Carbon\Carbon::parse($transaction->tanggal_selesai)->format('d/m/Y H:i') : '-' }}</span>
        </div>
        
        <div class="info-row">
            <span class="info-label">Tanggal Pencetakan:</span>
            <span class="info-value">{{ now()->format('d/m/Y H:i') }}</span>
        </div>
    </div>

    <div class="divider"></div>

    <!-- Items -->
    <div class="items-header">DAFTAR SAMPAH</div>
    
    @if(count($items) > 0)
        @foreach($items as $index => $item)
            <div class="item-row">
                <div class="item-name">
                    {{ $item['sampah_nama'] ?? 'Sampah' }}
                    @if(isset($item['status']) && $item['status'] === 'dihapus')
                        (DIHAPUS)
                    @elseif(isset($item['status']) && $item['status'] === 'ditambah')
                        (DITAMBAH)
                    @endif
                </div>
                <div class="item-details">
                    <span>Est: {{ number_format($item['estimasi_berat'] ?? 0, 1) }}kg</span>
                    <span>@ Rp{{ number_format($item['harga_per_satuan'] ?? 0) }}</span>
                </div>
                <div class="item-details">
                    <span>Aktual: {{ number_format($item['aktual_berat'] ?? 0, 1) }}kg</span>
                    <span>Rp{{ number_format($item['aktual_total'] ?? (($item['aktual_berat'] ?? 0) * ($item['harga_per_satuan'] ?? 0)), 0) }}</span>
                </div>
            </div>
        @endforeach
    @else
        <div class="item-row">
            <div class="item-name">Tidak ada data item</div>
        </div>
    @endif

    <div class="divider"></div>

    <!-- Totals -->
    <div class="total-section">
        <div class="total-row">
            <span class="total-label">Total Est Berat:</span>
            <span class="total-value">{{ number_format($totalEstimasiBerat, 1) }}kg</span>
        </div>
        
        <div class="total-row">
            <span class="total-label">Total Aktual:</span>
            <span class="total-value">{{ number_format($totalAktualBerat, 1) }}kg</span>
        </div>
        
        <div class="total-row">
            <span class="total-label">Est Total:</span>
            <span class="total-value">Rp{{ number_format($transaction->estimasi_total ?? 0, 0) }}</span>
        </div>
        
        <div class="total-row">
            <span class="total-label">Total Aktual:</span>
            <span class="total-value">Rp{{ number_format($transaction->aktual_total ?? 0, 0) }}</span>
        </div>

        <div class="total-row grand-total">
            <span class="total-label">Pendapatan:</span>
            @if($transaction->tipe_setor === 'tabung')
                <span class="total-value">{{ number_format($transaction->aktual_total ?? 0, 0) }} Poin</span>
            @elseif($transaction->tipe_setor === 'jual')
                <span class="total-value">Rp{{ number_format($transaction->aktual_total ?? 0, 0) }}</span>
            @elseif($transaction->tipe_setor === 'sedekah')
                <span class="total-value">Disedekahkan</span>
            @endif
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        <div class="thank-you">TERIMA KASIH</div>
        <div>Jaga lingkungan, mulai dari sampah</div>
        <div>Reduce • Reuse • Recycle</div>
    </div>
</body>
</html>