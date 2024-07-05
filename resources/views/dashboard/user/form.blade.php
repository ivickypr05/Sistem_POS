<!-- Add User Modal -->
<div class="modal fade" id="addForm" tabindex="-1" aria-labelledby="addForm" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="addForm"><b>Tambah User</b></h4>
            </div>
            <div class="modal-body">
                <form id="addUser" action="{{ route('user.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label class="mb-1" for="name">Nama User</label>
                        <input type="text" class="form-control mb-2" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label class="mb-1" for="email">Alamat Email</label>
                        <input type="text" class="form-control mb-2" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label class="mb-1" for="password">Password</label>
                        <input type="text" class="form-control mb-2" id="password" name="password" required>
                    </div>
                    <div class="form-group">
                        <label class="mb-1" for="role">Role</label>
                        <input type="text" class="form-control mb-2" id="role" name="role" value="kasir"
                            readonly>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary" form="addUser">Simpan</button>
            </div>
        </div>
    </div>
</div>


<!-- Edit User Modal -->
<div class="modal fade" id="editForm" tabindex="-1" aria-labelledby="editFormLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="editFormLabel"><b>Perbarui User</b></h4>
            </div>
            <div class="modal-body">
                <form id="editUser" action="" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label class="mb-1" for="edit_name">Nama User</label>
                        <input type="text" class="form-control mb-2" id="edit_name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label class="mb-1" for="edit_email">Alamat Email</label>
                        <input type="email" class="form-control mb-2" id="edit_email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label class="mb-1" for="edit_password">Password Baru</label>
                        <input type="password" class="form-control mb-2" id="edit_password" name="password">
                    </div>
                    <div class="form-group">
                        <label class="mb-1" for="edit_role">Role</label>
                        <input type="text" class="form-control mb-2" id="edit_role" name="role" readonly>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary" form="editUser">Simpan</button>
            </div>
        </div>
    </div>
</div>
