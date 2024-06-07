@extends('layouts.app')
@section('title', 'TBMJ | Halaman Tambah Produk Masuk')
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
            <div class="card mt-1">
                <div class="card-header mt-2">
                    <h3>
                        <b>Tambah Produk Masuk</b>
                    </h3>
                </div>
                <br>
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <div class="form-group row mb-3">
                                <span>
                                    <button class="btn btn-info btn-flat" type="button" data-toggle="modal"
                                        data-target="#product_form"><i class="fa fa-eye me-2"></i> Daftar Produk</button>
                                </span>
                            </div>
                            <form action="{{ route('inproduct.store') }}" method="POST" class="mt-3">
                                @csrf
                                <table id="datatablesSimple" class="table mt-1">
                                    <thead>
                                        <tr>
                                            <th>
                                                <center>No</center>
                                            </th>
                                            <th>
                                                <center> Kode Produk</center>
                                            </th>
                                            <th>
                                                <center> Nama Produk</center>
                                            </th>
                                            <th>
                                                <center> Kategori</center>
                                            </th>
                                            <th>
                                                <center> Jumlah</center>
                                            </th>
                                            <th>
                                                <center>Aksi</center>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1; ?>
                                        @foreach ($incarts as $item)
                                            <tr>
                                                <th>
                                                    <center>{{ $no++ }}.</center>
                                                </th>
                                                <td><span
                                                        style="background-color: #6daaf0;; color: #fff; padding: 5px; border-radius: 0.25rem;">{{ $item->product->kode_produk }}</span>
                                                </td>
                                                <td>{{ $item->product->nama }}</td>
                                                <td>{{ $item->product->category->nama }}</td>
                                                <td>
                                                    <input type="number" style="width:100px !important"
                                                        value="{{ $item->jumlah }}" class="form-control w-10" size="20"
                                                        name="jumlah[{{ $item->id }}]" min="1" required>
                                                </td>
                                                <td>
                                                    <center>
                                                        <button type="button" class="btn btn-danger btn-sm"
                                                            onclick="deleteConfirmation('{{ $item->id }}')">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </center>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                        </div>
                        <div class="row mt-4">
                            <div class="col-lg-7 offset-lg-5">
                                <div class="form-group row mb-3">
                                    <label for="nama_toko" class="col-lg-4 col-form-label text-lg-right"><b>Masukan
                                            Nama Toko</b></label>
                                    <div class="col-lg-7">
                                        <input type="text" class="form-control" id="nama_toko" name="nama_toko" required>
                                    </div>
                                </div>
                                <div class="form-group row mb-3">
                                    <div class="col-lg-4"></div>
                                    <div class="col-lg-5">
                                        <button type="submit" class="btn btn-success w-100"><i class="fa fa-save me-2"></i>
                                            Simpan Data</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </form>
                        <form id="deleteForm" method="POST" style="display:none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('dashboard.inproduct.form')
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
                    deleteItem(itemId);
                }
            });
        }

        function deleteItem(itemId) {
            let deleteForm = document.getElementById('deleteForm');
            deleteForm.action = '/incart/' + itemId;
            deleteForm.submit();
        }
    </script>
@endsection
