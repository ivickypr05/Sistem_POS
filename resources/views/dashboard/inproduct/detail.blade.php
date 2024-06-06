@extends('layouts.app')
@section('title', 'TBMJ | Halaman Detail Produk Masuk')
@section('content')

    <div class="container">
        <div class="row">
            {{-- breadcrumbs --}}
            <div class="d-flex justify-content-end mb-1">
                <i class="fa-solid fa-arrows-up-down-left-right mt-1 ms-2 mb-1 me-2"></i>
                <a href="{{ route('home') }}" class="text-dark"> Dashboard</a>
                <i class="fa-solid fa-chevron-right mt-1 ms-2 mb-1 me-2"></i>
                <a href="{{ route('inproduct.index') }}" class="text-dark"> Produk Masuk</a>
                <i class="fa-solid fa-chevron-right mt-1 ms-2 mb-1 me-2"></i>
                <a href="{{ route('inproduct.create') }}" class="text-dark"> Tambah Produk Masuk</a>
            </div>
            <div class="card mt-2">
                <div class="card-body">
                    <h3><i class="fa fa-newspaper me-2"></i><b>Detail Produk Masuk</b></h3>
                    {{-- <p align="right">Tanggal Pesan : {{ $transaction->created_at }}</p> --}}
                    <div class="card mt-4 mb-4 cetak-area">
                        <div class="card-body">
                            <table class="col-4" class="table table-bordered table-striped mt-1">
                                <tr>
                                    <td>Tanggal </td>
                                    <td>: {{ $inproduct->created_at }}</td>
                                </tr>
                                <tr>
                                    <td>Nama Toko </td>
                                    <td>: {{ $inproduct->nama_toko }}</td>
                                </tr>
                                <tr>
                                    <td>Total Item</td>
                                    <td>: {{ $inproduct->total_item }}</td>
                                </tr>
                            </table>
                            <br>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <center>
                                                <th>No</th>
                                                <th>Kode Produk</th>
                                                <th>Nama Produk</th>
                                                <th>Jumlah</th>
                                            </center>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1; ?>
                                        @foreach ($inproduct_detail as $item)
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td><span
                                                        style="background-color: #6daaf0; color: #fff; padding: 5px; border-radius: 0.25rem;">{{ $item->kode_produk }}</span>
                                                </td>
                                                <td>{{ $item->nama }}</td>
                                                <td>{{ $item->jumlah }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        @endsection
