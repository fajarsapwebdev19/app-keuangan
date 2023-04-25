<?php
    session_start();
    require '../../../database_connect.php';

    $user_id = $_SESSION['user_id'];

    $sql = mysqli_query($con, "SELECT u.id, u.personal_id, u.role_id, u.username, u.token, pd.nama, pd.jenis_kelamin, pd.tempat_lahir, pd.tanggal_lahir, r.role_name AS role FROM users u 
        INNER JOIN personal_data pd ON u.personal_id = pd.id
        INNER JOIN roles r ON u.role_id = r.role_id WHERE u.id='$user_id'");
    $data_user = mysqli_fetch_object($sql);
?>
<div class="ratio ratio-1x1 rounded-circle overflow-hidden">
    <?php
        if($data_user->jenis_kelamin == "L")
        {
            ?>
                <img src="../assets/img/male.jpg" alt="">
            <?php
        }else if($data_user->jenis_kelamin == "P"){
            ?>
                <img src="../assets/img/female.jpg" alt="">
            <?php
        }
    ?>
</div>
<b><?= $data_user->nama; ?></b>
<br>
<b><?= $data_user->tempat_lahir . ',' . date('d-m-Y', strtotime($data_user->tanggal_lahir)); ?></b>
<br>
<b><?= $data_user->role; ?></b>