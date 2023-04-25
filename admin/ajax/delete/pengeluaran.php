<?php
    require '../../../database_connect.php';

    $id = mysqli_real_escape_string($con, $_POST['id']);

    if(empty($id))
    {
        echo "invalid";
    }
    else{
        $sql = mysqli_query($con, "DELETE FROM pengeluaran WHERE id='$id'");

        if($sql)
        {
            echo "sukses";
        }
    }
?>