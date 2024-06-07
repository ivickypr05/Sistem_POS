@extends('layouts.app')
@section('title', 'TBMJ | Halaman Produk')
@section('content')
    <main>
        <div class="row">
            {{-- breadcrumbs --}}
            <div class="d-flex justify-content-end mb-1">
                <i class="fa-solid fa-arrows-up-down-left-right mt-1 ms-2 mb-1 me-2"></i>
                <a href="{{ route('home') }}" class="text-dark"> Dashboard</a>
                <i class="fa-solid fa-chevron-right mt-1 ms-2 mb-1 me-2"></i>
                <a href="{{ route('product.index') }}" class="text-dark"> Produk</a>
            </div>
            <div class="card mt-1">
                <div class="card-header mt-2">
                    <h3 class="card-tittle">
                        <b>Daftar Produk</b>
                    </h3>
                </div>
                <br>
                <nav>
                    <div class='d-flex justify-content-start ms-2'>
                        <a class="btn btn-success btn-md" data-toggle="modal" data-target="#addForm"><i
                                class="fa fa-plus"></i> Tambah</a>
                    </div>
                </nav>
                <br>
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped mt-1" id="datatablesSimple">
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
                                            <center>Stok</center>
                                        </th>
                                        <th>
                                            <center>Harga Jual</center>
                                        </th>
                                        <th>
                                            <center>Harga Beli</center>
                                        </th>
                                        <th>
                                            <center>Kategori</center>
                                        </th>
                                        <th>
                                            <center>Aksi</center>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    @foreach ($products as $item)
                                        <tr>
                                            <th>
                                                <center>{{ $no++ }}.</center>
                                            </th>
                                            <td><span
                                                    style="background-color: #6daaf0;; color: #fff; padding: 5px; border-radius: 0.25rem;">{{ $item->kode_produk }}</span>
                                            </td>
                                            <td>{{ $item->nama }}</td>
                                            <td>{{ $item->stok }}</td>
                                            <td>Rp{{ number_format($item->harga_beli) }}</td>
                                            <td>Rp{{ number_format($item->harga_jual) }}</td>
                                            <td>{{ $item->category->nama }}</td>
                                            <td>
                                                <center>
                                                    <button class="btn btn-warning btn-sm" data-id="{{ $item->id }}"
                                                        data-kode_produk="{{ $item->kode_produk }}"
                                                        data-nama="{{ $item->nama }}" data-stok="{{ $item->stok }}"
                                                        data-harga_beli="{{ $item->harga_beli }}"
                                                        data-harga_jual="{{ $item->harga_jual }}"
                                                        data-category_id="{{ $item->category_id }}" data-toggle="modal"
                                                        data-target="#editForm"><i class="fas fa-edit"></i></button>

                                                    <form id="deleteForm{{ $item->id }}"
                                                        action="{{ route('product.destroy', $item->id) }}" method="POST"
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
                    </div>
                </div>
            </div>
    </main>
    @includeIf('dashboard.product.form')
@endsection

@section('scripts')
    {{-- Create --}}
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    {{-- Update --}}
    <script>
        $(document).ready(function() {
            $('#editForm').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget); // Tombol yang memicu modal

                // Ambil data dari atribut data-*
                var id = button.data('id');
                var kodeProduk = button.data('kode_produk');
                var nama = button.data('nama');
                var stok = button.data('stok');
                var hargaBeli = button.data('harga_beli');
                var hargaJual = button.data('harga_jual');
                var categoryId = button.data('category_id');

                // Temukan modal dan isi field
                var modal = $(this);
                modal.find('#editProduct').attr('action', '/product/' + id);
                modal.find('#edit_kode_produk').val(kodeProduk);
                modal.find('#edit_nama').val(nama);
                modal.find('#edit_stok').val(stok);
                modal.find('#edit_harga_beli').val(hargaBeli);
                modal.find('#edit_harga_jual').val(hargaJual);
                modal.find('#edit_category_id').val(categoryId);

                // Pilih option yang sesuai dengan category_id
                modal.find('#edit_category_id option').each(function() {
                    if ($(this).val() == categoryId) {
                        $(this).prop('selected', true);
                    } else {
                        $(this).prop('selected', false);
                    }
                });
            });
        });
    </script>


    {{-- Delete Confirmation --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
