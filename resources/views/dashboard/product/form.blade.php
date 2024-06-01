<!-- Add Category Modal -->
<div class="modal fade" id="addForm" tabindex="-1" aria-labelledby="addForm" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="addForm"><b>Tambah Produk</b></h4>
            </div>
            <div class="modal-body">
                <form id="addProduct" action="{{ route('product.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label class="mb-1" for="kode_produk">Kode Produk</label>
                        <input type="text" class="form-control mb-2" id="kode_produk" name="kode_produk" required>
                    </div>
                    <div class="form-group">
                        <label class="mb-1" for="nama">Nama Produk</label>
                        <input type="text" class="form-control mb-2" id="nama" name="nama" required>
                    </div>
                    <div class="form-group">
                        <label class="mb-1" for="stok">Stok</label>
                        <input type="text" class="form-control mb-2" id="stok" name="stok" required>
                    </div>
                    <div class="form-group">
                        <label class="mb-1" for="harga_beli">Harga Beli</label>
                        <input type="text" class="form-control mb-2" id="harga_beli" name="harga_beli" required>
                    </div>
                    <div class="form-group">
                        <label class="mb-1" for="harga_jual">Harga Jual</label>
                        <input type="text" class="form-control mb-2" id="harga_jual" name="harga_jual" required>
                    </div>
                    <div class="form-group">
                        <label for="select" class="mb-1">Pilih Kategori</label>
                        @if ($categories->isEmpty())
                            <div class="alert alert-warning" role="alert">
                                Data Kategori tidak Ditemukan!
                                <a href="{{ route('category.index') }}" class="alert-link">Isi Kategori</a>
                            </div>
                        @else
                            <select class="form-select" aria-label="Default select example" name="category_id" required>
                                @foreach ($categories as $item)
                                    <option class="text-dark" value="{{ $item->id }}">{{ $item->nama }}</option>
                                @endforeach
                            </select>
                        @endif

                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary" form="addProduct">Simpan</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Category Modal -->
<div class="modal fade" id="editForm" tabindex="-1" aria-labelledby="editForm" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="editForm"><b>Edit Produk</b></h4>
            </div>
            <div class="modal-body">
                <form id="editProduct" action="" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label class="mb-1" for="kode_produk">Kode Produk</label>
                        <input type="text" class="form-control mb-2" id="edit_kode_produk" name="kode_produk"
                            required>
                    </div>
                    <div class="form-group">
                        <label class="mb-1" for="nama">Nama Produk</label>
                        <input type="text" class="form-control mb-2" id="edit_nama" name="nama" required>
                    </div>
                    <div class="form-group">
                        <label class="mb-1" for="stok">Stok</label>
                        <input type="text" class="form-control mb-2" id="edit_stok" name="stok" required>
                    </div>
                    <div class="form-group">
                        <label class="mb-1" for="harga_beli">Harga Beli</label>
                        <input type="text" class="form-control mb-2" id="edit_harga_beli" name="harga_beli"
                            required>
                    </div>
                    <div class="form-group">
                        <label class="mb-1" for="harga_jual">Harga Jual</label>
                        <input type="text" class="form-control mb-2" id="edit_harga_jual" name="harga_jual"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="select" class="mb-1">Pilih Kategori</label>
                        <select class="form-select" aria-label="Default select example" id="edit_category_id"
                            name="category_id" required>
                            @foreach ($categories as $item)
                                <option value="{{ $item->id }}">{{ $item->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary" form="editProduct">Simpan</button>
            </div>
        </div>
    </div>
</div>
