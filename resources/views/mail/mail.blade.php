<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Stok Produk Menipis!</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            width: 100%;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 20px auto;
        }

        .header {
            background-color: #ff0000;
            color: #fff;
            padding: 10px;
            text-align: center;
            border-top-left-radius: 5px;
            border-top-right-radius: 5px;
        }

        .content {
            padding: 20px;
        }

        .footer {
            text-align: center;
            padding: 10px;
            color: #777;
            font-size: 12px;
        }

        .button {
            display: inline-block;
            padding: 10px 20px;
            margin: 20px 0;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f4f4f4;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Pemberitahuan Stok Produk Menipis</h1>
        </div>
        <div class="content">
            <p>Halo,</p>
            <p>Kami ingin memberitahukan bahwa stok salah satu produk kami sedang menipis. Untuk memastikan bahwa Anda
                tidak kehabisan stok, kami menyarankan Anda untuk segera melakukan pembelanjaan.</p>
            <p>Berikut adalah daftar produk yang sedang menipis:</p>
            <table>
                <thead>
                    <tr>
                        <th>Kode Produk</th>
                        <th>Nama Produk</th>
                        <th>Stok</th>
                    </tr>
                </thead>
                <tbody>
                    @for ($i = 0; $i < count($data); $i++)
                        <tr>
                            <td>{{ $data[$i]['kode_produk'] }}</td>
                            <td>{{ $data[$i]['nama'] }}</td>
                            <td>{{ $data[$i]['stok'] }}</td>
                        </tr>
                    @endfor
                </tbody>
            </table>
            <p>Terima kasih atas perhatian dan kerjasamanya.</p>
            <p>Salam,</p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} Toko Besi Maju Jaya.</p>
        </div>
    </div>
</body>

</html>
