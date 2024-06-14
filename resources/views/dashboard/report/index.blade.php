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
                        <b>Laporan</b>
                    </h3>
                </div>
                <br>
                <nav>
                    <div class='d-flex justify-content-start ms-2'>
                        <button class="btn btn-success btn-md me-2" data-toggle="modal" data-target="#periodeForm"><i
                                class="fa fa-calendar-days"></i>
                            Pilih Periode</button>

                        <button class="btn btn-danger btn-md"><i class="fa fa-print"></i>
                            Export PDF</button>
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
                                        <th>
                                            <center> Penjualan</center>
                                        </th>
                                        <th>
                                            <center> Laba Kotor</center>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($reports as $item)
                                        <tr>
                                            <th>
                                                {{-- <center>{{ date('d M Y', strtotime($item->created_at)) }}</center> --}}
                                            </th>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="5" class="text-end"><strong>Total Laba Kotor :</strong></td>
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
@endsection
