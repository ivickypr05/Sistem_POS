<!DOCTYPE html>
<html>

<head>
    <title>Laporan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        thead {
            background-color: #f2f2f2;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        tfoot {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        tfoot td {
            text-align: right;
        }

        tfoot td strong {
            color: #008000;
        }
    </style>
</head>

<body>
    <h1>Laporan</h1>
    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Penjualan</th>
                <th>Laba Kotor</th>
            </tr>
        </thead>
        <tbody>
            @php
                $total_laba_kotor = 0;
            @endphp
            @foreach ($reports as $item)
                @php
                    $total_laba_kotor += $item->total_laba_harian;
                @endphp
                <tr>
                    <td>{{ date('d M Y', strtotime($item->tanggal)) }}</td>
                    <td>Rp{{ number_format($item->total_harga_harian) }}</td>
                    <td>Rp{{ number_format($item->total_laba_harian) }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3" class="text-end"><strong>Total Laba Kotor:
                        Rp{{ number_format($total_laba_kotor) }}</strong></td>
            </tr>
        </tfoot>
    </table>
</body>

</html>
