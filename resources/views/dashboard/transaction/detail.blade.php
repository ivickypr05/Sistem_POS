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
                {{-- <p align="right">Tanggal Pesan : {{ $transaction->created_at }}</p> --}}
                <div class="mt-3 d-flex justify-content-start">
                    <button class="cetak btn btn-success"><i class="fa-solid fa-print"></i> Cetak</button>
                </div>
                <div class="card mt-4 mb-4 cetak-area">
                    <div class="card-body">
                        <h2><b>Toko Besi Maju Jaya</b></h2>
                        <p>Jl. Pramuka, Kel. Argasunya, Kec. Harjamukti, kota Cirebon.</p>
                        <table class="col-5" class="table table-bordered table-striped mt-1">
                            <tr>
                                <td colspan="2">#{{ $transaction->invoice_nomor }}</td>
                            </tr>
                            <tr>
                                <td>Nama Kasir </td>
                                <td>: {{ $transaction->user->name }}</td>
                            </tr>
                            <tr>
                                <td>Tanggal Transaksi </td>
                                <td>: {{ $transaction->created_at }}</td>
                            </tr>
                        </table>
                        <br>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <center>
                                            <th>No</th>
                                            <th>Kode Produk</th>
                                            <th>Nama Produk</th>
                                            <th>Harga</th>
                                            <th>Jumlah</th>
                                            <th>Sub Total</th>
                                        </center>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    @foreach ($transaction_detail as $item)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td><span
                                                    style="background-color: #6daaf0; color: #fff; padding: 5px; border-radius: 0.25rem;">{{ $item->kode_produk }}</span>
                                            </td>
                                            <td>{{ $item->nama }}</td>
                                            <td>Rp{{ number_format($item->harga_jual) }}</td>
                                            <td>{{ $item->jumlah }}</td>
                                            <td> Rp{{ number_format($item->subtotal) }}</td>
                                        </tr>
                                    @endforeach


                                    <tr>
                                        <td colspan="5" align="right"><strong>Pajak : </strong></td>
                                        <td align="right">
                                            <strong>Rp0</strong>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td colspan="5" align="right"><strong>Total Harga : </strong></td>
                                        <td align="right">
                                            <strong>Rp{{ number_format($transaction->total_harga) }}</strong>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td colspan="5" align="right"><strong>Total Pembayaran :</strong></td>
                                        <td align="right">
                                            <strong>Rp{{ number_format($transaction->jumlah_bayar) }}</strong>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td colspan="5" align="right"><strong>Kembalian :</strong></td>
                                        <td align="right">
                                            <strong>Rp{{ number_format($transaction->jumlah_bayar - $transaction->total_harga) }}</strong>
                                        </td>

                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Fungsi untuk mencetak area dengan class 'cetak-area'
            function printArea() {
                console.log("Hello world!");
                var printContents = document.querySelector('.cetak-area').innerHTML;
                var originalContents = document.body.innerHTML;

                document.body.innerHTML = printContents;
                window.print();
                document.body.innerHTML = originalContents;
            }

            // Menambahkan event listener pada tombol dengan class 'cetak'
            $('.cetak').on('click', function() {
                printArea();
            });
        });
    </script>
@endpush()
