<?php
    session_start();
    require '../../database_connect.php';

    $username = mysqli_real_escape_string($con, $_POST['username']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    if($username == "" && $password == "")
    {
        echo "null";
    }else{
        $sql = mysqli_query($con, "SELECT * FROM users WHERE username='$username'");
        $cek = mysqli_num_rows($sql);

        if($cek > 0)
        {
            $data = mysqli_fetch_object($sql);
            if(password_verify($password, password_hash($data->pass, PASSWORD_DEFAULT)))
            {
                $token = rand().mt_rand().date('dmYhis');
                if($data->role_id == 1)
                {
                    $user_id = $data->id;
                    $_SESSION['role'] = $data->role_id;
                    $_SESSION['user_id'] = $data->id;
                    $_SESSION['token'] = $token;
                    $user = mysqli_query($con, "UPDATE users SET token='$token' WHERE id='$user_id'");
                    echo "gotoadmin";
                }else if($data->role_id == 2)
                {
                    $user_id = $data->id;
                    $_SESSION['role'] = $data->role_id;
                    $_SESSION['user_id'] = $data->id;
                    $_SESSION['token'] = $token;
                    $user = mysqli_query($con, "UPDATE users SET token='$token' WHERE id='$user_id'");
                    echo "gotouser";
                }
            }else{
                echo "passwordinvalid";
            }
        }else{
            echo "usernameinvalid";
        }
    }
?>