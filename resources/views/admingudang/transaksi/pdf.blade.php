<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Laporan Transaksi</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <!-- Menggunakan Google Fonts untuk tampilan yang modern -->
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Open Sans', sans-serif;
      background: #f2f4f7;
      color: #333;
      margin: 0;
      padding: 30px 40px;
    }

    .header {
      display: flex;
      justify-content: space-between;
      align-items: flex-start;
      border-bottom: 2px solid #4CAF50;
      padding-bottom: 20px;
      margin-bottom: 25px;
    }

    .header .title-section {
      text-align: left;
    }

    .header h1 {
      margin: 0;
      font-size: 28px;
      color: #2c3e50;
    }

    .header .subtitle {
      font-size: 14px;
      color: #7f8c8d;
      margin-top: 5px;
    }

    .header-info {
      text-align: right;
      font-size: 13px;
      color: #555;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      background: #fff;
      box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
      margin-bottom: 25px;
    }

    table th {
      background: #27ae60;
      color: #fff;
      padding: 12px;
      text-align: left;
      text-transform: uppercase;
      font-size: 12px;
    }

    table td {
      padding: 12px;
      border-bottom: 1px solid #ecf0f1;
      font-size: 13px;
    }

    table tr:nth-child(even) {
      background: #f8f9fa;
    }

    .status {
      font-weight: bold;
      font-size: 12px;
      text-transform: uppercase;
    }

    .masuk {
      color: #27ae60;
    }

    .keluar {
      color: #e74c3c;
    }

    .summary {
      background: #fff;
      padding: 15px 20px;
      border-left: 4px solid #27ae60;
      border-radius: 5px;
      margin-bottom: 25px;
      max-width: 400px;
    }

    .summary-item {
      display: flex;
      justify-content: space-between;
      margin: 8px 0;
    }

    .total {
      font-family: 'Courier New', monospace;
      color: #2c3e50;
      font-weight: bold;
    }

    .footer {
      border-top: 2px solid #4CAF50;
      padding-top: 20px;
      display: flex;
      justify-content: space-between;
      font-size: 12px;
      color: #7f8c8d;
    }
  </style>
</head>
<body>

  <div class="header">
    <div class="title-section">
      <h1>Laporan Transaksi</h1>
      @if($startDate && $endDate)
        <p class="subtitle">Periode: {{ $startDate }} hingga {{ $endDate }}</p>
      @endif
    </div>
    <div class="header-info">
      <!-- Mengatur zona waktu ke Asia/Jakarta -->
      <p>Dibuat pada: {{ \Carbon\Carbon::now()->setTimezone('Asia/Jakarta')->format('d/m/Y H:i') }}</p>
      <p>Halaman 1 dari 1</p>
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
          <td>{{ \Carbon\Carbon::parse($transaksi->tanggal)->setTimezone('Asia/Jakarta')->format('d/m/Y H:i') }}</td>
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
