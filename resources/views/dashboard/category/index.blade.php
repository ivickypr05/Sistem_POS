@extends('layouts.app')
@section('title', 'TBMJ | Halaman Kategori')
@section('content')
    <main>
        <div class="row">
            {{-- breadcrumbs --}}
            <div class="d-flex justify-content-end mb-1">
                <i class="fa-solid fa-arrows-up-down-left-right mt-1 ms-2 mb-1 me-2"></i>
                <a href="{{ route('home') }}" class="text-dark"> Dashboard</a>
                <i class="fa-solid fa-chevron-right mt-1 ms-2 mb-1 me-2"></i>
                <a href="{{ route('category.index') }}" class="text-dark"> Kategori</a>
            </div>
            <div class="card mt-1">
                <div class="card-header mt-2">
                    <h3 class="card-tittle">
                        <b>Daftar Kategori</b>
                    </h3>
                </div>
                <br>
                <nav>
                    <div class='d-flex justify-content-start ms-2'>
                        <button class="btn btn-success btn-md" data-toggle="modal" data-target="#addForm"><i
                                class="fa fa-plus"></i>
                            Tambah</button>
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
                                            <center> Nama Kategori</center>
                                        </th>
                                        <th>
                                            <center>Aksi</center>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    @foreach ($categories as $item)
                                        <tr>
                                            <th>
                                                <center>{{ $no++ }}.</center>
                                            </th>
                                            <td>{{ $item->nama }}</td>
                                            <td>
                                                <center>
                                                    <button class="btn btn-warning btn-sm" data-toggle="modal"
                                                        data-target="#editForm" data-id="{{ $item->id }}"
                                                        data-name="{{ $item->nama }}"><i class="fas fa-edit"></i></button>

                                                    <form id="deleteForm{{ $item->id }}"
                                                        action="{{ route('category.destroy', $item->id) }}" method="POST"
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
    @includeIf('dashboard.category.form')
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
                var button = $(event.relatedTarget);
                var id = button.data('id');
                var nama = button.data('name');
                var modal = $(this);
                modal.find('#editCategory').attr('action', '/category/' + id);
                modal.find('#edit_nama').val(nama);
            });
        });
    </script>

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
