@extends('layouts.app')
@section('title', 'TBMJ | Halaman Laporan')
@section('content')
    <main>
        <div class="row">
            {{-- breadcrumbs --}}
            <div class="d-flex justify-content-end mb-1">
                <i class="fa-solid fa-arrows-up-down-left-right mt-1 ms-2 mb-1 me-2"></i>
                <a href="{{ route('home') }}" class="text-dark"> Dashboard</a>
                <i class="fa-solid fa-chevron-right mt-1 ms-2 mb-1 me-2"></i>
                <a href="{{ route('report.index') }}" class="text-dark"> Laporan</a>
            </div>
            <div class="card mt-1">
                <div class="card-header mt-2">
                    <h3 class="card-tittle">
                        <b>Laporan Penjualan dan Laba Kotor</b>
                    </h3>
                </div>
                <br>
                <nav>
                    <div class='d-flex justify-content-start ms-2'>
                        <button class="btn btn-success btn-md me-2" data-toggle="modal" data-target="#periodeForm"><i
                                class="fa fa-calendar-days"></i>
                            Pilih Periode</button>

                        <button class="btn btn-danger btn-md" data-toggle="modal" data-target="#cetakForm"><i
                                class="fa fa-print"></i> Export
                            PDF</button>

                    </div>
                </nav>
                <br>
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="datatablesSimple" class="table table-striped mt-1">
                                <thead>
                                    <tr>
                                        <th>
                                            <center> Tanggal</center>
                                        </th>
                                        <th style="width: 300px;"><b>
                                                Penjualan</b>
                                        </th>
                                        <th style="width: 300px;"><b>
                                                Laba Kotor</b>
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
                                            <th>
                                                <center>{{ date('d M Y', strtotime($item->tanggal)) }}</>
                                                </center>
                                            </th>
                                            <td>
                                                Rp{{ number_format($item->total_harga_harian) }}</Rp>
                                            </td>
                                            <td>
                                                Rp{{ number_format($item->total_laba_harian) }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="2" class="text-end"><strong>Total Laba Kotor :</strong></td>
                                        <td colspan="3" class="text-start">
                                            <strong>Rp{{ number_format($total_laba_kotor) }}</strong>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
    </main>
    @includeIf('dashboard.report.form')
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endsection
