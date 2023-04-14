<?php
    require '../../../database_connect.php';

    $id = mysqli_real_escape_string($con, $_POST['id']);
    $id_personal = mysqli_real_escape_string($con, $_POST['id_personal']);
    $nama = mysqli_real_escape_string($con, $_POST['nama']);
    $jenis_kelamin = mysqli_real_escape_string($con, @$_POST['jenis_kelamin']);
    $tempat_lahir = mysqli_real_escape_string($con, $_POST['tempat_lahir']);
    $tanggal_lahir = mysqli_real_escape_string($con, date('Y-m-d', strtotime($_POST['tanggal_lahir'])));
    $status_akun = mysqli_real_escape_string($con, $_POST['status_akun']);

    if($id == "" && $id_personal == "" && $nama == "" && $jenis_kelamin == "" && $tempat_lahir == "" && $tanggal_lahir == "" && $status_akun == "")
    {
        echo "null";
    }else{
        $date = date('Y-m-d H:i:s');
        $update = mysqli_query($con, "UPDATE users SET status_account='$status_akun', modified_date='$date' WHERE id='$id'");
        $update .= mysqli_query($con, "UPDATE personal_data SET nama='$nama', jenis_kelamin='$jenis_kelamin', tempat_lahir='$tempat_lahir', tanggal_lahir='$tanggal_lahir', modified_date='$date' WHERE id='$id_personal'");

        if($update)
        {
            echo "sukses";
        }
    }
?>