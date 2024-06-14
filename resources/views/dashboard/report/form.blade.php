<!-- Periode Modal -->
<div class="modal fade" id="periodeForm" tabindex="-1" aria-labelledby="periodeForm" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="periodeForm"><b>Pilih Periode</b></h4>
            </div>
            <div class="modal-body">
                <form id="addPeriode" action="{{ route('report.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label class="mb-1" for="awal">Periode Awal</label>
                        <input type="date" class="form-control mb-2" id="awal" name="awal" required>
                    </div>
                    <div class="form-group">
                        <label class="mb-1" for="akhir">Periode Akhir</label>
                        <input type="date" class="form-control" id="akhir" name="akhir" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary" form="addPeriode">Simpan</button>
            </div>
        </div>
    </div>
</div>
