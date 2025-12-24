<!DOCTYPE html>
<html>
<head>
    <title>Laporan Produk</title>
    <style>
        body { font-family: 'Helvetica', sans-serif; font-size: 12px; color: #333; }
        .header { text-align: center; margin-bottom: 20px; border-bottom: 2px solid #444; padding-bottom: 10px; }
        .header h2 { margin: 0; text-transform: uppercase; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        table, th, td { border: 1px solid #666; }
        th { background-color: #f2f2f2; padding: 10px; text-align: center; }
        td { padding: 8px; vertical-align: middle; }
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        .total-row { background-color: #eee; font-weight: bold; }
    </style>
</head>
<body>
    <div class="header">
        <h2>{{ $title }}</h2>
        <p>Fleure Parfume - Tanggal Laporan: {{ $date }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="35%">Nama Produk</th>
                <th width="20%">Kategori</th>
                <th width="20%">Harga (IDR)</th>
                <th width="10%">Stok</th>
            </tr>
        </thead>
        <tbody>
            @php $totalStok = 0; @endphp
            @foreach($products as $index => $product)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ $product->name }}</td>
                <td class="text-center">{{ $product->category }}</td>
                <td class="text-right">{{ number_format($product->price, 0, ',', '.') }}</td>
                <td class="text-center">{{ $product->stock }}</td>
            </tr>
            @php $totalStok += $product->stock; @endphp
            @endforeach
        </tbody>
        <tfoot>
            <tr class="total-row">
                <td colspan="4" class="text-right">Total Unit Tersedia:</td>
                <td class="text-center">{{ $totalStok }}</td>
            </tr>
        </tfoot>
    </table>

    <div style="margin-top: 50px;">
        <p style="float: right; text-align: center;">
            Dicetak oleh,<br><br><br><br>
            ( Admin Fleure Parfume )
        </p>
    </div>
</body>
</html>