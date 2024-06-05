<!-- Product Modal -->
<div class="modal fade" id="product_form" tabindex="-1" aria-labelledby="product_form" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="product_form"><b>Data Produk</b></h4>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table id="datatablesModal" class="table table-striped mt-1">
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
                                    <td>{{ $item->kode_produk }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->stok }}</td>
                                    <td>{{ $item->category->nama }}</td>
                                    <td>
                                        <center>
                                            <form action="{{ route('incart.store') }}" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                <input type="hidden" name="inproduct_id" value="{{ $item->id }}">
                                                <input type="hidden" name="product_id" value="{{ $item->id }}">
                                                <button type="submit" class="btn btn-primary btn-sm">
                                                    <i class="fas fa-plus"></i>
                                                </button>
                                            </form>
                                        </center>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
