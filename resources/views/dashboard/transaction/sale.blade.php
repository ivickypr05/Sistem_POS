@extends('layouts.app')
@section('title', 'TBMJ | Halaman Penjualan')
@section('content')
    <style>
        .readonly-input {
            background-color: #e9ecef;
            color: #6c757d;
        }
    </style>

    <div class="container">
        <div class="row">
            {{-- breadcrumbs --}}
            <div class="d-flex justify-content-end mb-1">
                <i class="fa-solid fa-arrows-up-down-left-right mt-1 ms-2 mb-1 me-2"></i>
                <a href="{{ route('home') }}" class="text-dark"> Dashboard</a>
                <i class="fa-solid fa-chevron-right mt-1 ms-2 mb-1 me-2"></i>
                <a href="{{ route('cart.index') }}" class="text-dark"> Penjualan</a>
            </div>
            <div class="card mt-1">
                <div class="card-header mt-2">
                    <h3>
                        <b>Penjualan</b>
                    </h3>
                </div>
                <br>
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <div class="form-group row mb-3">
                                <span>
                                    <button class="btn btn-info btn-flat" type="button" data-toggle="modal"
                                        data-target="#product_form">
                                        <i class="fa fa-eye me-2"></i> Daftar Produk
                                    </button>
                                </span>
                            </div>
                            <table id="datatablesSimple" class="table mt-1">
                                <thead>
                                    <tr>
                                        <th>
                                            <center>No</center>
                                        </th>
                                        <th>
                                            <center>Kode Produk</center>
                                        </th>
                                        <th>
                                            <center>Nama Produk</center>
                                        </th>
                                        <th>
                                            <center>Kategori</center>
                                        </th>
                                        <th>
                                            <center>Jumlah</center>
                                        </th>
                                        <th>
                                            <center>Harga</center>
                                        </th>
                                        <th>
                                            <center>Sub Total</center>
                                        </th>
                                        <th>
                                            <center>Aksi</center>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    @foreach ($carts as $item)
                                        <tr>

                                            <th>
                                                <center>{{ $no++ }}.</center>
                                            </th>
                                            <td><span
                                                    style="background-color: #6daaf0; color: #fff; padding: 5px; border-radius: 0.25rem;">{{ $item->product->kode_produk }}</span>
                                            </td>
                                            <td>{{ $item->product->nama }}</td>
                                            <td>{{ $item->product->category->nama }}</td>
                                            <td>
                                                <form action="{{ route('cart.update', $item->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="d-flex">
                                                        <input type="number" style="width:100px !important"
                                                            value="{{ $item->jumlah }}" class="form-control w-10"
                                                            size="20" name="jumlah" min="1" required>
                                                        <button type="submit" class="ms-1 btn btn-sm btn-warning"><i
                                                                class="fa fa-edit"></i> Update</button>
                                                    </div>
                                                </form>
                                            </td>
                                            <td>Rp{{ number_format($item->product->harga_jual) }}</td>
                                            <td>Rp{{ number_format($item->product->harga_jual * $item->jumlah) }}</td>
                                            <td>
                                                <center>
                                                    <form id="deleteForm{{ $item->id }}"
                                                        action="{{ route('cart.destroy', $item->id) }}" method="POST"
                                                        style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm"
                                                            onclick="event.preventDefault(); deleteConfirmation('{{ $item->id }}');"><i
                                                                class="fas fa-trash"></i></button>
                                                    </form>
                                                </center>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="row mt-5">
                            <div class="col-lg-12">
                                <div class="row mb-3">
                                    <div class="col-lg-6">
                                        <div class="card bg-muted">
                                            <div class="card-body">
                                                <center>
                                                    <h2 class="text-light" id="total_harga"><b>Total Harga =
                                                            Rp{{ number_format($total_harga) }}</b></h2>
                                                </center>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <form action="{{ route('transaction.store') }}" method="POST">
                                            @csrf
                                            <div class="form-group row mb-3 d-flex justify-content-end">
                                                <label for="total_harga_input"
                                                    class="col-lg-3 col-form-label text-lg-right"><b>Total Harga</b></label>
                                                <div class="col-lg-7">
                                                    <input type="text" class="form-control readonly-input"
                                                        id="total_harga_input" name="total_harga"
                                                        value="Rp{{ number_format($total_harga) }}" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group row mb-3 d-flex justify-content-end">
                                                <label for="jumlah_bayar"
                                                    class="col-lg-3 col-form-label text-lg-right"><b>Total
                                                        Bayar</b></label>
                                                <div class="col-lg-7">
                                                    <input type="number" class="form-control" id="jumlah_bayar"
                                                        name="jumlah_bayar" min="0" required>
                                                </div>
                                            </div>
                                            <div class="form-group row mb-3 d-flex justify-content-end">
                                                <label for="kembalian_input"
                                                    class="col-lg-3 col-form-label text-lg-right"><b>Kembalian</b></label>
                                                <div class="col-lg-7">
                                                    <input type="text" class="form-control readonly-input"
                                                        id="kembalian_input" name="kembalian" value="Rp0" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group row mb-3 d-flex justify-content-end">
                                                <div class="col-lg-7">
                                                    <button type="submit" class="btn btn-success w-100"><i
                                                            class="fa fa-save me-2"></i> Simpan Data</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('dashboard.transaction.form')
@endsection

@section('scripts')
    {{-- Create --}}

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    {{-- Delete Confirmation --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function deleteConfirmation(itemId) {
            Swal.fire({
                title: 'Apakah yakin ingin menghapus Produk?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Hapus',
                cancelButtonText: 'Batal',
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Lakukan tindakan penghapusan
                    document.getElementById('deleteForm' + itemId).submit();
                }
            });
        }
    </script>

    {{-- Calculate Change --}}
    <script>
        $(document).ready(function() {
            $('#jumlah_bayar').on('input', function() {
                var totalHarga = {{ $total_harga }};
                var totalBayar = parseFloat($(this).val());
                var kembalian = totalBayar - totalHarga;
                if (isNaN(kembalian) || kembalian < 0) {
                    kembalian = 0;
                }
                $('#kembalian_input').val('Rp' + kembalian.toLocaleString('id-ID'));
            });
        });
    </script>

@endsection
