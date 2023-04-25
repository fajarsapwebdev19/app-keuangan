<?php
    require '../../../database_connect.php';

    $id = mysqli_real_escape_string($con, $_POST['id']);
    $tgl_pengeluaran = mysqli_real_escape_string($con, date('Y-m-d', strtotime($_POST['tgl_pengeluaran'])));
    $ket_pengeluaran = mysqli_real_escape_string($con, $_POST['ket_pengeluaran']);
    $utk_pengeluaran = mysqli_real_escape_string($con, $_POST['utk_pengeluaran']);
    $jumlah_pengeluaran = mysqli_real_escape_string($con, $_POST['jumlah_pengeluaran']);
    $date = date("Y-m-d H:i:s");

    if(empty($tgl_pengeluaran&&$ket_pengeluaran&&$utk_pengeluaran&&$jumlah_pengeluaran))
    {
        echo "null";
    }else{
        $update = mysqli_query($con, "UPDATE pengeluaran SET keterangan='$ket_pengeluaran', keperluan_untuk='$utk_pengeluaran', jumlah='$jumlah_pengeluaran', tanggal='$tgl_pengeluaran', modified_date='$date' WHERE id='$id'");

        if($update)
        {
            echo "sukses";
        }
    }
?>