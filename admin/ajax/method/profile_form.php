<?php
    session_start();
    require '../../../database_connect.php';

    $user_id = $_SESSION['user_id'];

    $sql = mysqli_query($con, "SELECT u.id, u.personal_id, u.role_id, u.username, u.token, pd.nama, pd.jenis_kelamin, pd.tempat_lahir, pd.tanggal_lahir, r.role_name AS role FROM users u 
        INNER JOIN personal_data pd ON u.personal_id = pd.id
        INNER JOIN roles r ON u.role_id = r.role_id");
    $data_user = mysqli_fetch_object($sql);
?>
<div class="mb-3">
    <label for="">Nama</label>
    <input type="hidden" name="personal_id" value="<?= $data_user->personal_id; ?>">
    <input type="text" name="nama" class="form-control" value="<?= $data_user->nama; ?>">
</div>
<div class="mb-3">
    <label for="">Jenis Kelamin</label>
    <br>
    <div class="radio">
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="jenis_kelamin" id="inlineRadio1" value="L" <?= ($data_user->jenis_kelamin == "L" ? 'checked' : '') ?>>
            <label class="form-check-label" for="inlineRadio1">Laki Laki</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="jenis_kelamin" id="inlineRadio2" value="P" <?= ($data_user->jenis_kelamin == "P" ? 'checked' : '') ?>>
            <label class="form-check-label" for="inlineRadio2">Perempuan</label>
        </div>
    </div>
</div>
<div class="mb-3">
    <label for="">Tempat Lahir</label>
    <input type="text" name="tempat_lahir" class="form-control" value="<?= $data_user->tempat_lahir; ?>">
</div>
<div class="mb-3">
    <label for="">Tanggal Lahir</label>
    <input type="text" name="tanggal_lahir" class="form-control date" value="<?= date('d-m-Y', strtotime($data_user->tanggal_lahir)); ?>">
</div>
<div class="d-grid gap-2">
    <button type="submit" class="btn btn-success update">
        <em class="fas fa-edit"></em> Ubah Data
    </button>
</div>

<script>
    $('.date').datepicker({
            format: 'dd-mm-yyyy',
            autohighlight: true,
            todayHighlight: true
    });
</script>