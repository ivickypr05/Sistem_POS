@extends('layouts.app')
@section('title', 'TBMJ | Halaman Produk Masuk')
@section('content')
    <main>
        <div class="row">
            {{-- breadcrumbs --}}
            <div class="d-flex justify-content-end mb-1">
                <i class="fa-solid fa-arrows-up-down-left-right mt-1 ms-2 mb-1 me-2"></i>
                <a href="{{ route('home') }}" class="text-dark"> Dashboard</a>
                <i class="fa-solid fa-chevron-right mt-1 ms-2 mb-1 me-2"></i>
                <a href="{{ route('inproduct.index') }}" class="text-dark"> Produk Masuk</a>
            </div>
            <div class="card mt-1">
                <div class="card-header mt-2">
                    <h3 class="card-tittle">
                        <b>Daftar Produk Masuk</b>
                    </h3>
                </div>
                <br>
                <nav>
                    <div class='d-flex justify-content-start ms-2'>
                        <a href="{{ route('incart.index') }}" class="btn btn-success btn-md"><i class="fa fa-plus"></i>
                            Tambah</a>
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
                                            <center>No</center>
                                        </th>
                                        <th>
                                            <center> Tanggal</center>
                                        </th>
                                        <th>
                                            <center> Nama Toko</center>
                                        </th>
                                        <th>
                                            <center> Total Item</center>
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
                                            <td>{{ $item->created_at }}</td>
                                            <td>{{ $item->nama_toko }}</td>
                                            <td>{{ $item->total_item }}</td>
                                            <td>
                                                <center>
                                                    <a href="{{ route('inproduct.show', $item->id) }}"
                                                        class="btn btn-warning btn-sm"><i
                                                            class="fas fa-eye"></i></a></button>

                                                    <form id="deleteForm{{ $item->id }}"
                                                        action="{{ route('inproduct.destroy', $item->id) }}" method="POST"
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
