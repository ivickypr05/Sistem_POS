@extends('layouts.app')
@section('title', 'TBMJ | Halaman Detail Riwayat Transaksi')
@section('content')
    <div class="row">
        {{-- breadcrumbs --}}
        <div class="d-flex justify-content-end mb-1">
            <i class="fa-solid fa-arrows-up-down-left-right mt-1 ms-2 mb-1 me-2"></i>
            <a href="{{ route('home') }}" class="text-dark"> Dashboard</a>
            <i class="fa-solid fa-chevron-right mt-1 ms-2 mb-1 me-2"></i>
            <a href="{{ route('transaction.index') }}" class="text-dark"> Riwayat Transaksi</a>
            <i class="fa-solid fa-chevron-right mt-1 ms-2 mb-1 me-2"></i>
            <a href="{{ route('transaction.show', $transaction->id) }}" class="text-dark"> Detail Riwayat Transaksi</a>
        </div>
        <div class="card mt-2">
            <div class="card-body">
                <h3><i class="fa fa-shopping-cart me-2"></i><b>Detail Transaksi</b></h3>
                <div class="mt-3 d-flex justify-content-start">
                    <button class="cetak-kecil btn btn-success me-2"><i class="fa-solid fa-print"></i> Cetak Kecil</button>
                    <button class="cetak-besar btn btn-primary"><i class="fa-solid fa-print"></i> Cetak Besar</button>
                </div>
                <div class="card mt-4 mb-4 cetak-area">
                    <div class="card-body">
                        <h2 class="mt-3 text-center"><b>Toko Besi Maju Jaya</b></h2>
                        <p class="text-center">Jl.Pramuka, Kel.Argasunya, Kec.Harjamukti, Cirebon.</p>
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
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Produk</th>
                                        <th>Harga</th>
                                        <th>Jumlah</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($transaction_detail as $index => $item)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td style="width: 100%; white-space: normal;">{{ $item->nama }}</td>
                                            <td>Rp{{ number_format($item->harga_jual, 0, ',', '.') }}</td>
                                            <td>{{ $item->jumlah }}</td>
                                            <td>Rp{{ number_format($item->subtotal, 0, ',', '.') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="4" class="text-end"><strong>Pajak:</strong></td>
                                        <td class="text-end"><strong>Rp0</strong></td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" class="text-end"><strong>Total Harga:</strong></td>
                                        <td class="text-end">
                                            <strong>Rp{{ number_format($transaction->total_harga, 0, ',', '.') }}</strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" class="text-end"><strong>Total Pembayaran:</strong></td>
                                        <td class="text-end">
                                            <strong>Rp{{ number_format($transaction->jumlah_bayar, 0, ',', '.') }}</strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" class="text-end"><strong>Kembalian:</strong></td>
                                        <td class="text-end">
                                            <strong>Rp{{ number_format($transaction->jumlah_bayar - $transaction->total_harga, 0, ',', '.') }}</strong>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                <iframe id="print-frame" style="display:none;"></iframe>
            </div>
        </div>
    </div>
@endsection

@push('style')
    <style>
        @media print {
            body {
                width: 58mm;
                margin: 0;
                padding: 0;
                font-size: 10px;
            }

            .cetak-area {
                width: 100%;
                margin: 0;
                padding: 0;
            }

            table,
            th,
            td {
                border: none;
                font-size: 10px;
            }

            .table-responsive {
                overflow: hidden;
            }

            .card,
            .card-body {
                border: none;
                margin: 0;
                padding: 0;
            }

            .table {
                width: 100%;
                margin: 0;
                padding: 0;
            }

            .btn,
            .no-print {
                display: none;
            }

            h2,
            p {
                text-align: center;
                margin: 0;
                padding: 0;
            }

            tfoot tr td {
                border-top: 1px dashed #000;
            }

            /* Menyesuaikan lebar kolom "Produk" untuk cetak kecil */
            .table tbody td:nth-child(2) {
                width: 100%;
                /* Sesuaikan lebarnya sesuai kebutuhan */
                white-space: normal;
                /* Memastikan teks dapat mengalir sesuai kebutuhan */
            }

            /* Penyesuaian pada cetak besar */
            @media print and (orientation: landscape) {
                body {
                    width: 210mm;
                    height: 297mm;
                    font-size: 14px;
                    /* Memperbesar font pada cetak besar */
                }

                .table,
                th,
                td {
                    border: 1px solid #ddd;
                    font-size: 14px;
                    /* Memperbesar font pada tabel */
                }
            }
        }
    </style>
@endpush

@push('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            function printArea(printSize) {
                var printContents = document.querySelector('.cetak-area').innerHTML;
                var printFrame = document.getElementById('print-frame').contentWindow;

                printFrame.document.open();
                printFrame.document.write(`
                    <html>
                    <head>
                        <style>
                            body {
                                ${printSize === 'kecil' ? 'width: 58mm;' : 'width: 210mm; height: 297mm;'}
                                margin: 0;
                                padding: 0;
                                font-size: ${printSize === 'kecil' ? '10px;' : '14px;'} /* Memperbesar font pada cetak besar */
                            }
                            table, th, td {
                                border: ${printSize === 'kecil' ? 'none;' : '1px solid #ddd;'}
                                font-size: ${printSize === 'kecil' ? '10px;' : '14px;'} /* Memperbesar font pada tabel */
                            }
                            .table {
                                width: 100%;
                                margin: 0;
                                padding: 0;
                            }
                            h2, p {
                                text-align: center;
                                margin: 0;
                                padding: 0;
                            }
                            tfoot tr td {
                                border-top: 1px dashed #000;
                            }
                        </style>
                    </head>
                    <body>
                        ${printContents}
                    </body>
                    </html>
                `);
                printFrame.document.close();
                printFrame.focus();
                printFrame.print();
            }

            $('.cetak-kecil').on('click', function() {
                printArea('kecil');
            });

            $('.cetak-besar').on('click', function() {
                printArea('besar');
            });
        });
    </script>
@endpush
