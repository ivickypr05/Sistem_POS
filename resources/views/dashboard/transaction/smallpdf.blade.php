<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Kecil</title>
    <style>
        @page {
            size: 58mm auto;
            /* Lebar dan panjang halaman */
            margin: 2mm;
            /* Margin halaman */
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 10px;
            width: 58mm;
        }

        .header {
            text-align: center;
            margin-bottom: 5px;
        }

        .header h2 {
            font-size: 12px;
            margin: 0;
        }

        .header p {
            font-size: 10px;
            margin: 0;
        }

        .transaction-info {
            margin-bottom: 5px;
            /* Dikurangi untuk mengurangi jarak */
        }

        .transaction-info td {
            padding-bottom: 2px;
            /* Dikurangi untuk mengurangi jarak */
        }

        table {
            width: 93%;
            border-collapse: collapse;
            margin-bottom: 5px;
            /* Dikurangi untuk mengurangi jarak */
        }

        tbody {
            border-bottom: 1px dotted #000
        }

        th,
        td {
            padding: 2px 0;
            font-size: 10px;
        }

        th {
            border-bottom: 1px #000;
            font-weight: bold;
            text-align: left;
        }

        tfoot {
            font-size: 10px;
            /* Ukuran font footer dikurangi */
        }

        tfoot td {
            padding-top: 2px;
            /* Dikurangi untuk mengurangi jarak */
        }

        .text-end {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="d-flex justify-content-center mb-5">
        <h2>
            <center>Toko Besi Maju Jaya</center>
        </h2>
        <p>Jl. Pramuka, Kel. Argasunya, Kec. Harjamukti, Kota Cirebon.</p>
    </div>

    <table class="transaction-info">
        <tr>
            <td><strong>Invoice:</strong> #{{ $transaction->invoice_nomor }}</td>
        </tr>
        <tr>
            <td><strong>Nama Kasir:</strong> {{ $transaction->user->name }}</td>
        </tr>
        <tr>
            <td><strong>Tanggal Transaksi:</strong> {{ date('d M Y | H:i:s', strtotime($transaction->created_at)) }}
            </td>
        </tr>
    </table>

    <table>
        <thead>
            <tr>
                <th>Produk</th>
                <th class="text-center">Jumlah</th>
                <th class="text-end">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transaction_detail as $index => $item)
                <tr>
                    <td>{{ $item->nama }}</td>
                    <td class="text-center">{{ $item->jumlah }}</td>
                    <td class="text-end">Rp{{ number_format($item->subtotal, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="2" class="text-end"><strong>Total Harga:</strong></td>
                <td class="text-end">Rp{{ number_format($transaction->total_harga, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td colspan="2" class="text-end"><strong>Pajak:</strong></td>
                <td class="text-end">Rp0</td>
            </tr>
            <tr class="mt-1 mb-1">
                <td colspan="2" class="text-end" style="border-top: 1px dotted #000;"><strong>Total Bayar:</strong>
                </td>
                <td class="text-end" style="border-top: 1px dotted #000;">
                    Rp{{ number_format($transaction->total_harga, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td colspan="2" class="text-end"><strong>Tunai:</strong></td>
                <td class="text-end">Rp{{ number_format($transaction->jumlah_bayar, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td colspan="2" class="text-end"><strong>Kembalian:</strong></td>
                <td class="text-end">
                    Rp{{ number_format($transaction->jumlah_bayar - $transaction->total_harga, 0, ',', '.') }}</td>
            </tr>
        </tfoot>
    </table>
</body>

</html>
