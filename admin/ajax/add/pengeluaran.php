<?php
    session_start();

    require '../../../database_connect.php';
    $id_user = $_SESSION['user_id'];
    $tgl_pengeluaran = mysqli_real_escape_string($con, date('Y-m-d', strtotime($_POST['tgl_pengeluaran'])));
    $ket_pengeluaran = mysqli_real_escape_string($con, $_POST['ket_pengeluaran']);
    $utk_pengeluaran = mysqli_real_escape_string($con, $_POST['utk_pengeluaran']);
    $jumlah_pengeluaran = mysqli_real_escape_string($con, $_POST['jumlah_pengeluaran']);
    $date = date("Y-m-d H:i:s");

    if(empty($tgl_pengeluaran&&$ket_pengeluaran&&$utk_pengeluaran&&$jumlah_pengeluaran))
    {
        echo "null";
    }else{
        $add = mysqli_query($con, "INSERT INTO pengeluaran (id, id_user, keterangan, keperluan_untuk, jumlah, tanggal, create_date, modified_date) VALUES (NULL, '$id_user', '$ket_pengeluaran', '$utk_pengeluaran', '$jumlah_pengeluaran', '$tgl_pengeluaran', '$date', NULL)");

        if($add)
        {
            echo "sukses";
        }
    }
?>