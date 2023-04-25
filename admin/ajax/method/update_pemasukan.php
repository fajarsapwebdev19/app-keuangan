<?php
    require '../../../database_connect.php';

    $id = mysqli_real_escape_string($con, $_POST['id']);

    $sql = mysqli_query($con, "SELECT * FROM pemasukan WHERE id='$id'");
    $data = mysqli_fetch_object($sql);
?>
<div class="modal-body">
    <div class="mb-3">
        <label for="">Tanggal Pemasukan</label>
        <input type="hidden" name="id" value="<?= $id; ?>">
        <input type="text" name="tgl_pemasukan" class="form-control date" value="<?= date('d-m-Y', strtotime($data->tanggal)) ?>">
    </div>
    <div class="mb-3">
        <label for="">Keterangan Pemasukan</label>
        <input type="text" name="ket_pemasukan" class="form-control" value="<?= $data->keterangan; ?>">
    </div>
    <div class="mb-3">
        <label for="">Sumber Pemasukan</label>
        <input type="text" name="sum_pemasukan" class="form-control" value="<?= $data->sumber; ?>">
    </div>
    <div class="mb-3">
        <label for="">Jumlah Pemasukan</label>
        <input type="text" name="jumlah_pemasukan" class="form-control" value="<?= $data->jumlah; ?>">
    </div>
    <div class="mb-3">
        <label for=""> Update Terakhir </label>
        <input type="text" class="form-control" value="<?= (empty($data->modified_date) ? 'NULL' : date('d-m-Y H:i:s', strtotime($data->modified_date))); ?>" disabled>
    </div>
</div>
<div class="modal-footer">
    <button type="submit" class="btn btn-success update"><em class="icon-load"></em> Ubah</button>
    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
</div>

<script>
    $('.date').datepicker({
        format: 'dd-mm-yyyy',
        autohighlight: true,
        todayHighlight: true
    });
</script>