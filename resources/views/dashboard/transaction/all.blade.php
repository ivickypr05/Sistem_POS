@extends('layouts.app')
@section('title', 'TBMJ | Halaman Riwayat Transaksi')
@section('content')
    <main>
        <div class="row">
            {{-- breadcrumbs --}}
            <div class="d-flex justify-content-end mb-1">
                <i class="fa-solid fa-arrows-up-down-left-right mt-1 ms-2 mb-1 me-2"></i>
                <a href="{{ route('home') }}" class="text-dark"> Dashboard</a>
                <i class="fa-solid fa-chevron-right mt-1 ms-2 mb-1 me-2"></i>
                <a href="{{ route('transaction.all') }}" class="text-dark"> Riwayat Transaksi</a>
            </div>
            <div class="card mt-1">
                <div class="card-header mt-2">
                    <h3 class="card-tittle">
                        <b>Daftar Riwayat Transaksi</b>
                    </h3>
                </div>
                <br>
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="datatablesSimple" class="table table-striped mt-1">
                                <thead>
                                    <tr>
                                        <th>
                                            <center>No</center>
                                        </th>
                                        <th>
                                            <center> Tanggal</center>
                                        </th>
                                        <th>
                                            <center> Nomor Invoice</center>
                                        </th>
                                        <th>
                                            <center> Nama User</center>
                                        </th>
                                        <th>
                                            <center> Total Harga</center>
                                        </th>
                                        <th>
                                            <center> Total Pembayaran</center>
                                        </th>
                                        <th>
                                            <center> Kembalian</center>
                                        </th>
                                        <th>
                                            <center>Aksi</center>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    @foreach ($transactions as $item)
                                        <tr>
                                            <th>
                                                <center>{{ $no++ }}.</center>
                                            </th>
                                            <td>{{ date('d M Y', strtotime($item->created_at)) }}</td>
                                            <td>{{ $item->invoice_nomor }}</td>
                                            <td>{{ $item->user->name }}</td>
                                            <td>Rp{{ number_format($item->total_harga) }}</td>
                                            <td>Rp{{ number_format($item->jumlah_bayar) }}</td>
                                            <td>Rp{{ number_format($item->jumlah_bayar - $item->total_harga) }}</td>
                                            <td>
                                                <center>
                                                    <a href="{{ route('transaction.show', $item->id) }}"
                                                        class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a></button>
                                                </center>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
    </main>
@endsection
