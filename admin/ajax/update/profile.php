<?php
    require '../../../database_connect.php';

    $personal_id = mysqli_real_escape_string($con, $_POST['personal_id']);
    $nama = mysqli_real_escape_string($con, $_POST['nama']);
    $jenis_kelamin = mysqli_real_escape_string($con, @$_POST['jenis_kelamin']);
    $tempat_lahir = mysqli_real_escape_string($con, $_POST['tempat_lahir']);
    $tanggal_lahir = mysqli_real_escape_string($con, date('Y-m-d', strtotime($_POST['tanggal_lahir'])));

    if($nama == "" && $jenis_kelamin == "" && $tempat_lahir == "" && $tanggal_lahir == "")
    {
        echo "null";
    }else{
        $date = date('Y-m-d H:i:s');
        $update = mysqli_query($con, "UPDATE personal_data SET nama='$nama', jenis_kelamin='$jenis_kelamin', tempat_lahir='$tempat_lahir', tanggal_lahir='$tanggal_lahir', modified_date='$date' WHERE id='$personal_id'");

        if($update)
        {echo "sukses";}
    }
?>