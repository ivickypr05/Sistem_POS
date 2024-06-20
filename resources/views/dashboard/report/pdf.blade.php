<!DOCTYPE html>
<html>

<head>
    <title>Laporan</title>
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
        }

        h1 {
            text-align: center;
            color: #000000;
            margin-bottom: 10px;
            font-weight: bold;
        }

        h2 {
            text-align: center;
            color: #000000;
            margin-bottom: 40px;
            font-size: 18px;
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
            color: #000000;
        }
    </style>
</head>

<body>
    @php
        $tanggal_awal = $reports->first()->tanggal;
        $tanggal_akhir = $reports->last()->tanggal;
    @endphp

    <h1><b>LAPORAN LABA KOTOR</b></h1>
    <h2>Periode: {{ date('d M Y', strtotime($tanggal_awal)) }} - {{ date('d M Y', strtotime($tanggal_akhir)) }}</h2>

    <table>
        <thead>
            <tr>
                <th>
                    <center>Tanggal</center>
                </th>
                <th>
                    <center>Penjualan</center>
                </th>
                <th>
                    <center>Laba Kotor</center>
                </th>
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
                    <td>
                        <center>{{ date('d M Y', strtotime($item->tanggal)) }}</center>
                    </td>
                    <td>
                        <center>Rp{{ number_format($item->total_harga_harian) }}</center>
                    </td>
                    <td>
                        <center>Rp{{ number_format($item->total_laba_harian) }}</center>
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="2" class="text-end"><strong>Total Laba Kotor:
                    </strong></td>
                <td class="text-center">Rp{{ number_format($total_laba_kotor) }}</td>
            </tr>
        </tfoot>
    </table>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
</body>

</html>
