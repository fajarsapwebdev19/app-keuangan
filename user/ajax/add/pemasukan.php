<?php
    session_start();
    require '../../../database_connect.php';

    $id_user = $_SESSION['user_id'];
    $tgl_pemasukan = mysqli_real_escape_string($con, date("Y-m-d", strtotime($_POST['tgl_pemasukan'])));
    $ket_pemasukan = mysqli_real_escape_string($con, $_POST['ket_pemasukan']);
    $sum_pemasukan = mysqli_real_escape_string($con, $_POST['sum_pemasukan']);
    $jumlah_pemasukan = mysqli_real_escape_string($con, $_POST['jumlah_pemasukan']);
    $date = date("Y-m-d H:i:s");

    if($tgl_pemasukan == "" && $ket_pemasukan == "" && $sum_pemasukan == "" && $jumlah_pemasukan == "")
    {
        echo "null";
    }else{
        $add = mysqli_query($con, "INSERT INTO pemasukan (id,id_user, keterangan, sumber, jumlah, tanggal, create_date, modified_date) VALUES (NULL,'$id_user', '$ket_pemasukan', '$sum_pemasukan', '$jumlah_pemasukan', '$tgl_pemasukan', '$date', NULL)");

        if($add)
        {
            echo "sukses";
        }
    }

   
?>