<div class="modal fade" id="tambah-pengeluaran" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Tambah Data Pengeluaran</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="form_pengeluaran" method="post" autocomplete="off">
        <div class="modal-body">
            <div class="mb-3">
                <label for="">Tanggal Pengeluaran</label>
                <input type="text" name="tgl_pengeluaran" class="form-control date">
            </div>
            <div class="mb-3">
                <label for="">Keterangan Pengeluaran</label>
                <input type="text" name="ket_pengeluaran" class="form-control">
            </div>
            <div class="mb-3">
                <label for="">Untuk Pengeluaran</label>
                <input type="text" name="utk_pengeluaran" class="form-control">
            </div>
            <div class="mb-3">
                <label for="">Jumlah Pengeluaran</label>
                <input type="text" name="jumlah_pengeluaran" class="form-control">
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-success add"><em class="icon"></em> Tambah</button>
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="update_pengeluaran" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Ubah Data Pengeluaran</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="form_update_pengeluaran" method="post" autocomplete="off">
        
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="delete_pengeluaran" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Konfirmasi Hapus Data Pengeluaran</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="form_delete_pengeluaran" method="post" autocomplete="off">
        
      </form>
    </div>
  </div>
</div>