<?php
    require '../../../database_connect.php';

    $id = mysqli_real_escape_string($con, $_POST['id']);

    $sql = mysqli_query($con, "SELECT * FROM pengeluaran WHERE id='$id'");
    $data = mysqli_fetch_object($sql);
?>
<div class="modal-body">
    <div class="mb-3">
        <label for="">Tanggal Pengeluaran</label>
        <input type="hidden" name="id" value="<?= $id; ?>">
        <input type="text" name="tgl_pengeluaran" class="form-control date" value="<?= date('d-m-Y', strtotime($data->tanggal)); ?>">
    </div>
    <div class="mb-3">
        <label for="">Keterangan Pengeluaran</label>
        <input type="text" name="ket_pengeluaran" class="form-control" value="<?= $data->keterangan; ?>">
    </div>
    <div class="mb-3">
        <label for="">Untuk Pengeluaran</label>
        <input type="text" name="utk_pengeluaran" class="form-control" value="<?= $data->keperluan_untuk; ?>">
    </div>
    <div class="mb-3">
        <label for="">Jumlah Pengeluaran</label>
        <input type="text" name="jumlah_pengeluaran" class="form-control" value="<?= $data->jumlah; ?>">
    </div>
</div>
<div class="modal-footer">
    <button type="submit" class="btn btn-success update"><em class="icon"></em> Ubah</button>
    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
</div>

<script>
    $('.date').datepicker({
        format: 'dd-mm-yyyy',
        autohighlight: true,
        todayHighlight: true,
        autoclose: true
    });
</script>