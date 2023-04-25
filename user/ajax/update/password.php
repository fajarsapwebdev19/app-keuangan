<?php
    error_reporting(0);
    session_start();
    require '../../../database_connect.php';
    
    $user_id = $_SESSION['user_id'];
    $password_lama = mysqli_real_escape_string($con, $_POST['pass_lama']);
    $password_baru = mysqli_real_escape_string($con, $_POST['pass_baru']);
    $konfirmasi_password_baru = mysqli_real_escape_string($con, $_POST['kon_pass_baru']);

    if($password_lama == "" && $password_baru == "" && $konfirmasi_password_baru == "")
    {
        echo "null";
    }else{
        $sql = mysqli_query($con, "SELECT * FROM users WHERE id='$user_id'");

        $cek = mysqli_num_rows($sql);

        if($cek > 0)
        {
            $data = mysqli_fetch_object($sql);

            $pwd = $data->pass;

            if(password_verify($password_lama, password_hash($pwd, PASSWORD_DEFAULT)))
            {
                if($password_baru !== $konfirmasi_password_baru)
                {
                    echo "notsame";
                }else{
                    $update = mysqli_query($con, "UPDATE users SET pass='$konfirmasi_password_baru' WHERE id='$user_id'");

                    if($update)
                    {
                        echo "update";
                    }
                }
            }else{
                echo "passoldnotfound";
            }
        }else{
            echo "usernotfound";
        }
    }
?>