<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Laba Kotor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            line-height: 1.6;
            background-color: #ffffff;
            /* Warna latar belakang */
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #343a40;
            /* Warna teks utama */
            margin-bottom: 20px;
        }

        h2 {
            text-align: center;
            color: #343a40;
            font-size: 1.5rem;
            /* Ukuran teks */
            margin-bottom: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
            background-color: #ffffff;
            /* Warna latar belakang tabel */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            /* Bayangan tabel */
        }

        th,
        td {
            padding: 12px;
            text-align: center;
            border-bottom: 1px solid #dee2e6;
            /* Garis bawah */
        }

        thead {
            background-color: #343a40;
            /* Warna latar belakang header tabel */
            color: #ffffff;
            /* Warna teks header */
        }

        tfoot {
            background-color: #343a40;
            color: #ffffff;
            /* Warna teks footer */
            font-weight: bold;
        }

        tfoot td {
            text-align: right;
            padding-top: 12px;
        }

        tfoot td strong {
            color: #ffffff;
            /* Warna teks total */
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="mb-4"><b>LAPORAN PENJUALAN & LABA KOTOR</b></h1>
        <h2 class="mb-5">Periode: {{ date('d M Y', strtotime($tanggal_awal)) }} -
            {{ date('d M Y', strtotime($tanggal_akhir)) }}</h2>

        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Penjualan</th>
                    <th scope="col">Laba Kotor</th>
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
                    <td colspan="2" class="text-end"><strong>Total Laba Kotor:</strong></td>
                    <td class="text-center">Rp{{ number_format($total_laba_kotor) }}</td>
                </tr>
            </tfoot>
        </table>
    </div>

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
