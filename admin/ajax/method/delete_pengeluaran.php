<?php
    require '../../../database_connect.php';

    $id = mysqli_real_escape_string($con, $_POST['id']);
?>
<div class="modal-body">
    <p class="text-center">
        Apakah Anda Yakin Ingin Hapus Data Tersebut ?
        <input type="hidden" name="id" value="<?= $id; ?>">
        <br><br>
        <button type="button" class="btn btn-success delete">
           <em class="icon"></em> Ya
        </button>
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
            Tidak
        </button>
    </p>
</div>