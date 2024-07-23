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
            margin: 0.5mm;
            /* Margin halaman */
        }

        body {
            font-family: 'Poppins', sans-serif;
            font-size: 11px;
            width: 85%;
            padding-left: 3mm;
            padding-top: 3mm;
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
            width: 95%;
            padding-left: 2px;
            border-collapse: collapse;
        }

        table td {
            padding-top: 4px;
            padding-bottom: 4px;
        }

        .text-center {
            text-align: center;
        }

        .text-end {
            text-align: right;
        }
    </style>
</head>

<body>
    <div class="header">
        <h2>TOKO BESI MAJU JAYA</h2>
        <p>Jl. Pramuka Kota Cirebon</p>
        <p>No HP : 0895354723068</p>
    </div>

    <table class="transaction-info">
        <tr>
            <td style="border-top: 1px dotted #000; border-bottom: 1px dotted #000">Invoice:
                #{{ $transaction->invoice_nomor }}</td>
        </tr>
        <tr>
            <td style="border-bottom: 1px dotted #000">Nama Kasir: {{ $transaction->user->name }}</td>
        </tr>
        <tr>
            <td style="border-bottom: 1px dotted #000">Tanggal:
                {{ date('d M Y H:i:s', strtotime($transaction->created_at)) }}</td>
        </tr>
    </table>

    <table>
        <tbody>
            @foreach ($transaction_detail as $index => $item)
                <tr>
                    <td>{{ $item->nama }}</td>
                    <td class="text-center">x{{ $item->jumlah }}</td>
                    <td class="text-end">Rp{{ number_format($item->subtotal, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="2" class="text-end" style="border-top: 1px dotted #000">Total Harga:
                </td>
                <td class="text-end" style="border-top: 1px dotted #000">
                    Rp{{ number_format($transaction->total_harga, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td colspan="2" class="text-end">Pajak:</td>
                <td class="text-end">Rp0</td>
            </tr>
            <tr>
                <td colspan="2" class="text-end" style="border-top: 1px dotted #000">Total
                    Pembayaran:</td>
                <td class="text-end" style="border-top: 1px dotted #000">
                    Rp{{ number_format($transaction->jumlah_bayar, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td style="border-bottom: 1px dotted #000" colspan="2" class="text-end">Kembalian:</td>
                <td style="border-bottom: 1px dotted #000" class="text-end">
                    Rp{{ number_format($transaction->jumlah_bayar - $transaction->total_harga, 0, ',', '.') }}</td>
            </tr>
        </tfoot>
    </table>
    <p style="text-align: center;">
        Terima kasih!
    </p>
</body>

</html>
