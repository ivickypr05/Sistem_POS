<!-- Product Modal -->
<div class="modal fade" id="product_form" tabindex="-1" aria-labelledby="product_form" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="product_form"><b>Data Produk Penjualan</b></h4>
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
                                    Kode Produk
                                </th>
                                <th>
                                    Nama Produk
                                </th>
                                <th>
                                    Stok
                                </th>
                                <th>
                                    Harga Jual
                                </th>
                                <th>
                                    Kategori
                                </th>
                                <th>
                                    Aksi
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
                                    <td>Rp{{ number_format($item->harga_jual) }}</td>
                                    <td>{{ $item->category->nama }}</td>
                                    <td>
                                        @if ($item->stok < 1)
                                            <p><b>Habis</b></p>
                                        @else
                                            <center>
                                                <form action="{{ route('cart.store') }}" method="POST"
                                                    style="display:inline;">
                                                    @csrf
                                                    <input type="hidden" name="product_id" value="{{ $item->id }}">
                                                    <button type="submit" class="btn btn-success btn-sm">
                                                        <i class="fas fa-plus"></i>
                                                    </button>
                                                </form>
                                            </center>
                                        @endif
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
