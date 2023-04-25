<?php
    require '../../../database_connect.php';

    $id = mysqli_real_escape_string($con, $_POST['id']);

    $sql = mysqli_query($con, "SELECT * FROM users WHERE id='$id'");

    $cek = mysqli_num_rows($sql);

    if($cek > 0)
    {
        $data = mysqli_fetch_object($sql);
        $id_personal = $data->personal_id;
        $delete = mysqli_query($con, "DELETE FROM users WHERE id='$id'");
        $delete .= mysqli_query($con, "DELETE FROM personal_data WHERE id='$id_personal'");
        $delete .= mysqli_query($con, "ALTER TABLE personal_data AUTO_INCREMENT=1");
        $delete .= mysqli_query($con, "ALTER TABLE users AUTO_INCREMENT=1");
        
        if($delete)
        {
            echo "sukses";
        }
    }else{
        echo "notfound";
    }
?>