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
                    <a href="{{ route('small-pdf', $transaction->id) }}" class="cetak-kecil btn btn-success me-2"><i
                            class="fa-solid fa-print"></i> Cetak Kecil</a>
                    <a href="{{ route('big-pdf', $transaction->id) }}" class="cetak-besar btn btn-primary"><i
                            class="fa-solid fa-print"></i> Cetak Besar</a>
                </div>
                <div class="card mt-4 mb-4">
                    <div class="card-body">
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
                                        <th><b>No</b></th>
                                        <th><b>Produk</b></th>
                                        <th><b>Harga</b></th>
                                        <th><b>Jumlah</b></th>
                                        <th><b>Subtotal</b></th>
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
            </div>
        </div>
    </div>
@endsection
