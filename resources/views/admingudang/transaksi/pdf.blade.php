<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Transaksi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 30px 40px;
            color: #333;
        }

        .header {
            border-bottom: 2px solid #4CAF50;
            padding-bottom: 20px;
            margin-bottom: 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            width: 150px;
        }

        .header-info {
            text-align: right;
        }

        h1 {
            margin: 0;
            color: #2c3e50;
            font-size: 24px;
            font-weight: bold;
        }

        .subtitle {
            color: #7f8c8d;
            font-size: 14px;
            margin-top: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }

        th {
            background-color: #27ae60;
            color: white;
            padding: 12px;
            text-align: left;
            font-size: 13px;
            text-transform: uppercase;
        }

        td {
            padding: 12px;
            border-bottom: 1px solid #ecf0f1;
            font-size: 13px;
        }

        tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        .status {
            font-weight: bold;
            text-transform: uppercase;
            font-size: 12px;
        }

        .masuk {
            color: #27ae60;
        }

        .keluar {
            color: #e74c3c;
        }

        .footer {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 2px solid #4CAF50;
            display: flex;
            justify-content: space-between;
            font-size: 12px;
            color: #7f8c8d;
        }

        .summary {
            margin-top: 25px;
            padding: 15px;
            background-color: #f8f9fa;
            border-radius: 5px;
        }

        .summary-item {
            display: flex;
            justify-content: space-between;
            margin: 8px 0;
        }

        .total {
            font-family: 'Courier New', monospace;
            font-weight: bold;
            color: #2c3e50;
        }
    </style>
</head>
<body>

    <div class="header">
        <div>
            <h1>Laporan Transaksi Gudang</h1>
            <p class="subtitle">Periode: {{ $startDate }} - {{ $endDate }}</p>
        </div>
        <div class="header-info">
            <div class="subtitle">Dibuat pada: {{ \Carbon\Carbon::now()->format('d/m/Y H:i') }}</div>
            <div class="subtitle">Halaman 1 dari 1</div>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 5%">No</th>
                <th style="width: 20%">Produk</th>
                <th style="width: 10%">Qty</th>
                <th style="width: 15%">Gudang</th>
                <th style="width: 15%">Admin</th>
                <th style="width: 15%">Tanggal</th>
                <th style="width: 10%">Tipe</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transaksis as $transaksi)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $transaksi->produk->nama }}</td>
                    <td>{{ number_format($transaksi->kuantitas) }}</td>
                    <td>{{ $transaksi->gudang->nama }}</td>
                    <td>{{ $transaksi->user->name }}</td>
                    <td>{{ \Carbon\Carbon::parse($transaksi->tanggal)->format('d/m/Y H:i') }}</td>
                    <td>
                        <span class="status {{ $transaksi->tipe }}">
                            {{ strtoupper($transaksi->tipe) }}
                        </span>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="summary">
        <div class="summary-item">
            <span>Total Transaksi Masuk:</span>
            <span class="total">{{ $totalMasuk }}</span>
        </div>
        <div class="summary-item">
            <span>Total Transaksi Keluar:</span>
            <span class="total">{{ $totalKeluar }}</span>
        </div>
        <div class="summary-item">
            <span>Total Keseluruhan:</span>
            <span class="total">{{ $totalTransaksi }}</span>
        </div>
    </div>

    <div class="footer">
        <div>
            <p>Jumlah Record: {{ count($transaksis) }}</p>
            <p>Dicetak oleh: {{ auth()->user()->name }}</p>
        </div>
        <div>
            <p>PT. Contoh Perusahaan</p>
            <p>Telp: (021) 123-4567 | Email: gudang@perusahaan.com</p>
        </div>
    </div>

</body>
</html>
