<?php
    session_start();
    
    if(isset($_SESSION['token']))
    {
        $role = $_SESSION['role'];

        if($role == 1)
        {
            header('location: admin/');
        }
        else if($role == 2)
        {
            header('location: user/');
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

    <style>
        .error{
            color: red;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card">
                    <div class="card-header">
                        Login Data Keuangan
                    </div>
                    <div class="card-body">
                        <div id="message"></div>
                        <form method="post" id="form-login" autocomplete="off">
                            <div class="mb-3">
                                <label for="">
                                    Username
                                </label>
                                <input type="text" name="username" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="">
                                    Password
                                </label>
                                <input type="password" name="password" class="form-control">
                            </div>
                            <div class="mb-3">
                                <div class="d-grid gap-2 text-center">
                                    <button type="submit" class="btn btn-lock btn-success login">
                                        Login
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/jquery-3.6.4.min.js"></script>
    <script src="assets/jquery.validate.min.js"></script>
    <script>
        
        $('#form-login').on('click', '.login', function(){
            $('#form-login').validate({
                rules:{
                    username: {
                        required: true
                    },
                    password:{
                        required: true
                    }
                },
                messages:{
                    username: "masukan username",
                    password: "masukan password"
                },
                submitHandler: function(form)
                {
                    var data = $('#form-login').serialize();
                    $.ajax({
                        url: 'ajax/login/proses.php',
                        data: data,
                        type: 'post',
                        success:function(response)
                        {
                            if(response == "usernameinvalid")
                            {
                                $('#message').show();
                                $('#message').html("<div class='alert alert-danger bg-danger text-white'>Username Salah</div>");
                                $('#message').delay(3000).fadeOut('slow');
                            }
                            else if(response == "passwordinvalid")
                            {
                                $('#message').show();
                                $('#message').html("<div class='alert alert-danger bg-danger text-white'>Password Salah</div>");
                                $('#message').delay(3000).fadeOut('slow');
                            }
                            else if(response == "null")
                            {
                                $('#message').show();
                                $('#message').html("<div class='alert alert-danger bg-danger text-white'>Silahkan Lengkapi Data !</div>");
                                $('#message').delay(3000).fadeOut('slow');
                            }else if(response == "gotoadmin")
                            {
                                $('#message').show();
                                $('#message').html("<div class='alert alert-success bg-success text-white'>Berhasil Login !</div>");
                                $('#message').delay(3000).fadeOut('slow');
                                setTimeout(function(){
                                    window.location='admin/';
                                }, 5000);
                            }
                            else if(response == "gotouser")
                            {
                                $('#message').show();
                                $('#message').html("<div class='alert alert-success bg-success text-white'>Berhasil Login !</div>");
                                $('#message').delay(3000).fadeOut('slow');
                                setTimeout(function(){
                                    window.location='user/';
                                }, 5000);
                            }
                            else
                            {
                                $('#message').show();
                                $('#message').html("<div class='alert alert-danger bg-danger text-white'>Terjadi Kesalahan !</div>");
                                $('#message').delay(3000).fadeOut('slow');
                            }
                        }
                    })
                }
            })
        })
    </script>

</body>
</html>