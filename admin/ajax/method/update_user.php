<?php
    require '../../../database_connect.php';

    $id = mysqli_real_escape_string($con, $_POST['id']);

    $sql = mysqli_query($con, "SELECT u.id, pd.id AS id_personal, u.status_account, u.modified_date,  pd.nama, pd.jenis_kelamin, pd.tempat_lahir, pd.tanggal_lahir FROM users u JOIN personal_data pd ON u.personal_id = pd.id WHERE u.id='$id'");
    $data = mysqli_fetch_object($sql);
?>
<div class="modal-body">
    <div class="mb-3">
        <label>Nama</label>
        <input type="hidden" name="id" value="<?= $data->id; ?>">
        <input type="hidden" name="id_personal" value="<?= $data->id_personal; ?>">
        <input type="text" name="nama" class="form-control" value="<?= $data->nama; ?>">
    </div>
    <div class="mb-3">
        <label for="">Jenis Kelamin</label>
        <br>
        <div class="radio">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="jenis_kelamin" id="inlineRadio3" value="L" <?= ($data->jenis_kelamin == "L" ? 'checked' : '') ?>>
                <label class="form-check-label" for="inlineRadio3">Laki Laki</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="jenis_kelamin" id="inlineRadio4" value="P" <?= ($data->jenis_kelamin == "P" ? 'checked' : '') ?>>
                <label class="form-check-label" for="inlineRadio4">Perempuan</label>
            </div>
        </div>
    </div>
    <div class="mb-3">
        <label>Tempat Lahir</label>
        <input type="text" name="tempat_lahir" class="form-control" value="<?= $data->tempat_lahir; ?>">
    </div>
    <div class="mb-3">
        <label>Tanggal Lahir</label>
        <input type="text" name="tanggal_lahir" class="form-control date" value="<?= date('d-m-Y', strtotime($data->tanggal_lahir)); ?>">
    </div>
    <div class="mb-3">
        <label>Status Akun</label>
        <select name="status_akun" class="form-control">
            <option value="">Pilih</option>
            <option value="y" <?= ($data->status_account == "y" ? 'selected' : "")?>>Aktif</option>
            <option value="n" <?= ($data->status_account == "n" ? 'selected' : "")?>>Tidak Aktif</option>
        </select>
    </div>
    <div class="mb-3">
        <label>Update Terakhir</label>
        <input type="text" class="form-control" value="<?= (empty($data->modified_date) ? "NULL" : date('d-m-Y H:i:s', strtotime($data->modified_date))); ?>" disabled>
    </div>
</div>
<div class="modal-footer">
    <button type="submit" class="btn btn-success update">Ubah</button>
    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
</div>


<script>
    $('.date').datepicker({
        format: 'dd-mm-yyyy',
        autohighlight: true,
        todayHighlight: true
    });
</script>