<div class="modal fade" id="tambah_pemasukan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Tambah Data Pemasukan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="form_pemasukan" method="post" autocomplete="off">
        <div class="modal-body">
            <div class="mb-3">
                <label for="">Tanggal Pemasukan</label>
                <input type="text" name="tgl_pemasukan" class="form-control date">
            </div>
            <div class="mb-3">
                <label for="">Keterangan Pemasukan</label>
                <input type="text" name="ket_pemasukan" class="form-control">
            </div>
            <div class="mb-3">
                <label for="">Sumber Pemasukan</label>
                <input type="text" name="sum_pemasukan" class="form-control">
            </div>
            <div class="mb-3">
                <label for="">Jumlah Pemasukan</label>
                <input type="text" name="jumlah_pemasukan" class="form-control">
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-success add">Tambah</button>
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="ubah_pemasukan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Ubah Data Pemasukan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="form_edit_pemasukan" method="post">
        
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="hapus_pemasukan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Konfirmasi Hapus Data Pemasukan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="form_hapus_pemasukan" method="post">
        
      </form>
    </div>
  </div>
</div>