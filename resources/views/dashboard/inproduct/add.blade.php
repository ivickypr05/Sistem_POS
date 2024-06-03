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
                                <label for="kode_produk" class="col-lg-2 mt-2"><b>Kode Produk</b></label>
                                <div class="col-lg-5">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="kode_produk" id="kode_produk">
                                        <span>
                                            <button class="btn btn-info btn-flat" type="button"><i
                                                    class="fa fa-arrow-right"></i></button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <table id="datatablesSimple" class="table table-striped mt-1">
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
                                    @foreach ($inproducts as $item)
                                        <tr>
                                            <th>
                                                <center>{{ $no++ }}.</center>
                                            </th>
                                            <td>{{ $item->product->kode_product }}</td>
                                            <td>{{ $item->product->nama }}</td>
                                            <td>{{ $item->product->category->nama }}</td>
                                            <td>
                                                <input type="number" style="width:100px !important"
                                                    value="{{ $item->jumlah }}" class="form-control w-10" size="20"
                                                    name="amount", min="1" required>
                                            </td>
                                            <td>
                                                <center>
                                                    <a href="{{ route('inproduct.show') }}"
                                                        class="btn btn-warning btn-sm"></a><i
                                                        class="fas fa-eye"></i></button>

                                                    <form action="{{ route('inproduct.destroy', $item->id) }}"
                                                        method="POST" style="display:inline;">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    {{-- Delete Confirmation --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function deleteConfirmation(itemId) {
            Swal.fire({
                title: 'Apakah yakin ingin menghapus?',
                text: "Item yang terhapus tidak bisa dikembalikan lagi!",
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
