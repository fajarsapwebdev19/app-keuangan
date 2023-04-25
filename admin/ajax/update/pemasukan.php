<?php
    require '../../../database_connect.php';

    $id = mysqli_real_escape_string($con, $_POST['id']);
    $tgl_pemasukan = mysqli_real_escape_string($con, date('Y-m-d', strtotime($_POST['tgl_pemasukan'])));
    $ket_pemasukan = mysqli_real_escape_string($con, $_POST['ket_pemasukan']);
    $sum_pemasukan = mysqli_real_escape_string($con, $_POST['sum_pemasukan']);
    $jumlah_pemasukan = mysqli_real_escape_string($con, $_POST['jumlah_pemasukan']);

    if(empty($tgl_pemasukan && $ket_pemasukan && $sum_pemasukan && $jumlah_pemasukan))
    {
        echo "null";
    }
    else{
        $update = mysqli_query($con, "UPDATE pemasukan SET tanggal='$tgl_pemasukan', keterangan='$ket_pemasukan', sumber='$sum_pemasukan', jumlah='$jumlah_pemasukan' WHERE id='$id'");

        if($update)
        {
            echo "sukses";
        }
    }
?>