<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice Besar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        body {
            font-size: 14px;
        }

        .card {
            margin: 0 auto;
            width: 80%;
            border: 1px solid #c7ccd1;
            border-radius: 8px;
        }

        .card-body {
            padding: 20px;
        }

        .text-center {
            text-align: center;
        }

        .text-end {
            text-align: end;
        }

        .text-start {
            text-align: start;
        }

        table {
            width: 100%;
            margin-bottom: 20px;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #b4b4b8;
            padding: 8px;
        }

        th {
            background-color: #afafb3;
        }

        tfoot {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="card mt-4 mb-4">
        <div class="card-body">
            <h2 class="mt-3 text-center"><b>Toko Besi Maju Jaya</b></h2>
            <p class="text-center">Jl.Pramuka, Kel.Argasunya, Kec.Harjamukti, Kota Cirebon.</p>
            <br>
            <table class="table mt-1">
                <tr>
                    <td><strong>Invoice:</strong>&emsp; #{{ $transaction->invoice_nomor }}</td>
                </tr>
                <tr>
                    <td><strong>Nama Kasir:</strong>&emsp; {{ $transaction->user->name }}</td>
                </tr>
                <tr>
                    <td><strong>Tanggal Transaksi:</strong>&emsp;
                        {{ date('d M Y | H:i:s ', strtotime($transaction->created_at)) }}</td>
                </tr>
            </table>
            <div class="table-responsive">
                <table class="table table-bordered table-sm">
                    <thead>
                        <tr>
                            <th style="width: 5%;"><b>No</b></th>
                            <th style="width: 40%;"><b>Produk</b></th>
                            <th style="width: 15%;"><b>Harga</b></th>
                            <th style="width: 10%;"><b>Jumlah</b></th>
                            <th style="width: 20%;"><b>Subtotal</b></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transaction_detail as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>Rp{{ number_format($item->harga_jual, 0, ',', '.') }}</td>
                                <td>{{ $item->jumlah }}</td>
                                <td>Rp{{ number_format($item->subtotal, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4" class="text-end"><strong>Total Harga:</strong></td>
                            <td class="text-start">
                                <strong>Rp{{ number_format($transaction->total_harga, 0, ',', '.') }}</strong>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4" class="text-end"><strong>Pajak:</strong></td>
                            <td class="text-start"><strong>Rp0</strong></td>
                        </tr>
                        <tr>
                            <td colspan="4" class="text-end"><strong>Total Bayar:</strong></td>
                            <td class="text-start">
                                <strong>Rp{{ number_format($transaction->total_harga, 0, ',', '.') }}</strong>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4" class="text-end"><strong>Tunai:</strong></td>
                            <td class="text-start">
                                <strong>Rp{{ number_format($transaction->jumlah_bayar, 0, ',', '.') }}</strong>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4" class="text-end"><strong>Kembalian:</strong></td>
                            <td class="text-start">
                                <strong>Rp{{ number_format($transaction->jumlah_bayar - $transaction->total_harga, 0, ',', '.') }}</strong>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</body>

</html>
