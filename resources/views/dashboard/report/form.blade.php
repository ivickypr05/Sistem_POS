<!-- Periode Modal -->
<div class="modal fade" id="periodeForm" tabindex="-1" aria-labelledby="periodeForm" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="periodeForm"><b>Pilih Periode</b></h4>
            </div>
            <div class="modal-body">
                <form id="addPeriode" action="{{ route('report.index') }}" method="POST">
                    @csrf
                    @method('POST')
                    <div class="form-group">
                        <label class="mb-1" for="tanggal_awal">Periode Awal</label>
                        <input type="date" class="form-control mb-2" id="tanggal_awal" name="tanggal_awal" required>
                    </div>
                    <div class="form-group">
                        <label class="mb-1" for="tanggal_akhir">Periode Akhir</label>
                        <input type="date" class="form-control" id="tanggal_akhir" name="tanggal_akhir" required>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary" form="addPeriode">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>
