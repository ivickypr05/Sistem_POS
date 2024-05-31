<!-- Add Category Modal -->
<div class="modal fade" id="addForm" tabindex="-1" aria-labelledby="addForm" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="addForm"><b>Tambah Kategori</b></h4>
            </div>
            <div class="modal-body">
                <form id="addCategory" action="{{ route('category.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label class="mb-1" for="nama">Nama Kategori</label>
                        <input type="text" class="form-control" id="nama" name="nama" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary" form="addCategory">Simpan</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Category Modal -->
<div class="modal fade" id="editForm" tabindex="-1" aria-labelledby="editForm" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="editForm"><b>Perbarui Kategori</b></h4>
            </div>
            <div class="modal-body">
                <form id="editCategory" action="" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label class="mb-1" for="edit_nama">Nama Kategori</label>
                        <input type="text" class="form-control" id="edit_nama" name="nama" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary" form="editCategory">Simpan</button>
            </div>
        </div>
    </div>
</div>
