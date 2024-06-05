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
                    <h3 class="card-tittle">
                        <b>Tambah Produk Masuk</b>
                    </h3>
                </div>
                <br>
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <div class="form-group row mb-3">
                                <label for="kode_produk" class="col-lg-2 mt-2"><b>Tambah Produk</b></label>
                                <div class="col-lg-5">
                                    <div class="input-group">
                                        <span>
                                            <button class="btn btn-info btn-flat" type="button" data-toggle="modal"
                                                data-target="#product_form"><i class="fa fa-plus"></i></button>
                                        </span>
                                    </div>
                                </div>
                            </div>
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
                                            <td>{{ $item->product->kode_produk }}</td>
                                            <td>{{ $item->product->nama }}</td>
                                            <td>{{ $item->product->category->nama }}</td>
                                            <td>
                                                <input type="number" style="width:100px !important"
                                                    value="{{ $item->jumlah }}" class="form-control w-10" size="20"
                                                    name="jumlah", min="1" required>
                                            </td>
                                            <td>
                                                <center>
                                                    <form id="deleteForm{{ $item->id }}"
                                                        action="{{ route('incart.destroy', $item->id) }}" method="POST"
                                                        style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm"
                                                            onclick="event.preventDefault(); deleteConfirmation('{{ $item->id }}');">
                                                            <i class="fas fa-trash"></i></button>
                                                    </form>
                                                </center>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <form action="{{ route('inproduct.store') }}" method="POST" class="mt-3">
                            @csrf
                            <div class="row">
                                <div class="col-lg-7 offset-lg-5">
                                    <div class="form-group row mb-3">
                                        <label for="nama_toko" class="col-lg-4 col-form-label text-lg-right"><b>Masukan Nama
                                                Toko</b></label>
                                        <div class="col-lg-7">
                                            <input type="text" class="form-control" id="nama_toko" name="nama_toko"
                                                required>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-3 ms-5">
                                        <div class="col-lg-8"></div>
                                        <div class="col-lg-3">
                                            <button type="submit" class="btn btn-success"><i class="fa fa-save"></i>
                                                Simpan</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
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

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- Delete Confirmation --}}
    <script>
        function deleteConfirmation(itemId) {
            Swal.fire({
                title: 'Apakah yakin ingin menghapus?',
                text: "Produk yang terhapus tidak bisa dikembalikan lagi!",
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
@endsection
