<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Transaksi</title>
    <style>
        body {
            font-family: 'Arial, sans-serif';
            margin: 20px;
            padding: 0;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h1 {
            margin: 0;
            color: #333;
        }
        .header p {
            margin: 0;
            font-size: 14px;
            color: #777;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .footer {
            margin-top: 20px;
            text-align: right;
            font-size: 12px;
            color: #555;
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
                <th>No.</th>
                <th>Produk</th>
                <th>Kuantitas</th>
                <th>Gudang</th>
                <th>Admin</th>
                <th>Tanggal</th>
                <th>Tipe</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transaksis as $transaksi)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $transaksi->produk->nama }}</td>
                    <td>{{ $transaksi->kuantitas }}</td>
                    <td>{{ $transaksi->gudang->nama }}</td>
                    <td>{{ $transaksi->user->name }}</td>
                    <td>{{ \Carbon\Carbon::parse($transaksi->tanggal)->format('d-m-Y H:i') }}</td>
                    <td style="color: {{ $transaksi->tipe == 'masuk' ? 'green' : 'red' }};">
                        {{ ucfirst($transaksi->tipe) }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>Admin Gudang | {{ auth()->user()->name }}</p>
    </div>

</body>
</html>
