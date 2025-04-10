<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Laporan Transaksi Modern</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
  <style>
    /* Reset & Global Styles */
    body {
      font-family: 'Open Sans', Arial, sans-serif;
      margin: 0;
      padding: 30px;
      background: #f5f5f5;
      font-size: 13px;
      color: #444;
    }
    h1, h2, h3, h4, p {
      margin: 0;
      padding: 0;
    }
    /* Header Section */
    .header {
      background: #ffffff;
      padding: 20px 30px;
      border-bottom: 3px solid #2c3e50;
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 25px;
      box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    }
    .header .title-section h1 {
      color: #2c3e50;
      font-size: 24px;
    }
    .header .title-section p.subtitle {
      color: #7f8c8d;
      font-size: 13px;
      margin-top: 5px;
    }
    .header-info {
      text-align: right;
      font-size: 12px;
      color: #555;
    }
    /* Table Styling */
    table {
      width: 100%;
      border-collapse: collapse;
      background: #ffffff;
      box-shadow: 0 2px 4px rgba(0,0,0,0.05);
      margin-bottom: 30px;
    }
    table th {
      background: #2980b9;
      color: #fff;
      text-align: left;
      padding: 12px 15px;
      font-weight: 600;
      font-size: 12px;
    }
    table td {
      padding: 12px 15px;
      border-bottom: 1px solid #ececec;
      font-size: 12px;
      vertical-align: top;
    }
    table tr:last-child td {
      border: none;
    }
    table tr:nth-child(even) {
      background: #fafafa;
    }
    /* Status Badge */
    .status {
      display: inline-block;
      padding: 4px 8px;
      border-radius: 4px;
      font-weight: bold;
      font-size: 11px;
      text-transform: uppercase;
    }
    .masuk {
      background: #e8f5e9;
      color: #27ae60;
    }
    .keluar {
      background: #ffebee;
      color: #e74c3c;
    }
    /* Summary Box */
    .summary {
      background: #ffffff;
      padding: 20px;
      border: 1px solid #ececec;
      border-left: 6px solid #27ae60;
      border-radius: 4px;
      max-width: 350px;
      box-shadow: 0 2px 4px rgba(0,0,0,0.05);
      margin-bottom: 30px;
    }
    .summary .summary-item {
      display: flex;
      justify-content: space-between;
      padding: 8px 0;
      border-bottom: 1px dashed #ddd;
    }
    .summary .summary-item:last-child {
      border-bottom: none;
    }
    .summary .total {
      font-family: 'Courier New', monospace;
      font-size: 14px;
      color: #2c3e50;
    }
    /* Footer */
    .footer {
      background: #ffffff;
      padding: 15px 30px;
      border-top: 2px solid #2c3e50;
      position: fixed;
      bottom: 0;
      left: 0;
      right: 0;
      display: flex;
      justify-content: space-between;
      font-size: 11px;
      color: #7f8c8d;
      box-shadow: 0 -2px 4px rgba(0,0,0,0.05);
    }
    .footer p {
      margin: 2px 0;
    }
    /* Page Number */
    .page-number {
      text-align: center;
      font-size: 11px;
      color: #7f8c8d;
      margin-top: 5px;
    }
  </style>
</head>
<body>
  <div class="header">
    <div class="title-section">
      <h1>Laporan Transaksi Gudang</h1>
      @if($startDate != '-' && $endDate != '-')
        <p class="subtitle">Periode: {{ \Carbon\Carbon::parse($startDate)->format('d/m/Y') }} s/d {{ \Carbon\Carbon::parse($endDate)->format('d/m/Y') }}</p>
      @else
        <p class="subtitle">Semua Data Transaksi</p>
      @endif
    </div>
    <div class="header-info">
      <p>Dibuat: {{ \Carbon\Carbon::now()->setTimezone('Asia/Jakarta')->format('d/m/Y H:i') }}</p>
      <p>User: {{ auth()->user()->name }}</p>
    </div>
  </div>

  <table>
    <thead>
      <tr>
        <th style="width: 5%;">No</th>
        <th style="width: 20%;">Produk</th>
        <th style="width: 10%;">Qty</th>
        <th style="width: 15%;">Gudang</th>
        <th style="width: 15%;">Admin</th>
        <th style="width: 15%;">Tanggal</th>
        <th style="width: 10%;">Tipe</th>
      </tr>
    </thead>
    <tbody>
      @foreach($transaksis as $transaksi)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ optional($transaksi->produk)->nama ?? '-' }}</td>
          <td style="text-align: right">{{ number_format($transaksi->kuantitas) }}</td>
          <td>{{ optional($transaksi->gudang)->nama ?? '-' }}</td>
          <td>{{ optional($transaksi->user)->name ?? '-' }}</td>
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
      <span class="total">{{ number_format($totalMasuk) }}</span>
    </div>
    <div class="summary-item">
      <span>Total Transaksi Keluar:</span>
      <span class="total">{{ number_format($totalKeluar) }}</span>
    </div>
    <div class="summary-item">
      <span>Total Record:</span>
      <span class="total">{{ number_format($totalTransaksi) }}</span>
    </div>
  </div>

  <div class="footer">
    <div>
      <p>PT. Contoh Perusahaan</p>
      <p>Telp: (021) 123-4567 | Email: gudang@perusahaan.com</p>
    </div>
    <div style="text-align: right">
      <p>Dokumen ini dicetak secara otomatis</p>
      <p>Valid tanpa tanda tangan</p>
    </div>
  </div>
  <script type="text/php">
    if (isset($pdf)) {
        $text = "Halaman {PAGE_NUM} dari {PAGE_COUNT}";
        $size = 10;
        $font = $fontMetrics->getFont("Open Sans");
        $width = $fontMetrics->get_text_width($text, $font, $size) / 2;
        $x = ($pdf->get_width() - $width) / 2;
        $y = $pdf->get_height() - 20;
        $pdf->page_text($x, $y, $text, $font, $size);
    }
  </script>
</body>
</html>
