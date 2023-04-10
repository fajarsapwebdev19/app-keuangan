<?php
session_start();
require '../database_connect.php';

if (empty($_SESSION['token'])) {
    header('location: ../');
} else {
    $sql = mysqli_query($con, "SELECT u.id, u.personal_id, u.role_id, u.username, u.token, pd.nama, pd.jenis_kelamin, pd.tempat_lahir, pd.tanggal_lahir, r.role_name AS role FROM users u 
        INNER JOIN personal_data pd ON u.personal_id = pd.id
        INNER JOIN roles r ON u.role_id = r.role_id");
    $data_user = mysqli_fetch_object($sql);

    if ($_SESSION['token'] !== $data_user->token) {
        header('location: ../');
    }
}

$page = isset($_GET['page']) ? $_GET['page'] : "";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>App Keuangan</title>

    <!-- css bootstrap -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/bs-show-password/css/show-password-toggle.min.css">
    <!-- css datatables -->
    <link rel="stylesheet" href="../assets/datatables/css/dataTables.bootstrap5.min.css">
    <!-- css datepicker -->
    <link rel="stylesheet" href="../assets/datepicker/css/datepicker.css">
    <!-- fw -->
    <link rel="stylesheet" href="../assets/fontawesome/css/all.min.css">

    <style>
        input.error{
            border: 1px solid #dc3545;
        }
        input.error:focus{
            border: 1px solid #dc3545;
        }
        input.error:checked{
            background-color: #dc3545;
        }
        .error{
            color: #dc3545;
        }

        input.valid{
            border: 1px solid #198754;
        }

        input.valid:checked{
            background-color: #198754;
        }

        input.valid:focus{
           border: 1px solid #198754;
        }

        .icon:hover{
            cursor: pointer;
        }
    </style>
</head>

<body>
    <nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Keuangan</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link <?= ($page == "" ? 'active' : "")?>" aria-current="page" href="./">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= ($page == "account" ? 'active' : "")?>" href="?page=account">Account</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= ($page == "invite" ? 'active' : "")?>"  href="?page=invite">Undangan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= ($page == "friends" ? 'active' : "")?>" href="?page=friends">Teman</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= ($page == "pemasukan" ? 'active' : "")?>" href="?page=pemasukan">Pemasukan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= ($page == "pengeluaran" ? 'active' : "")?>" href="?page=pengeluaran">Pengeluaran</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= ($page == "profile" ? 'active' : "")?>" href="?page=profile">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= ($page == "up_pass" ? 'active' : "")?>" href="?page=up_pass">Update Password</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="mt-4">
        <div class="container">
            <?php
                require 'page.php';
            ?>
        </div>
    </div>
    <!-- js -->
    <script src="../assets/jquery-3.6.4.min.js"></script>
    <script src="../assets/jquery.validate.min.js"></script>
    <script src="../assets/additional-methods.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/datatables/js/jquery.dataTables.min.js"></script>
    <script src="../assets/datatables/js/dataTables.bootstrap5.min.js"></script>
    <script src="../assets/datepicker/js/bootstrap-datepicker.js"></script>
    <script src="../assets/bs-show-password/js/show-password-toggle.min.js"></script>

    <script>
        if ( window.history.replaceState ) {
            window.history.replaceState( null, null, window.location.href );
        }

        function frm_profile(){
            $('#form-profile').load("ajax/method/profile_form.php");
            $('#detail-profile').load("ajax/method/detail_profile.php");
        }

        frm_profile();

        $('.date').datepicker({
            format: 'dd-mm-yyyy',
            autohighlight: true,
            todayHighlight: true
        });
        
        $('#form-profile').on('click', '.update', function(){
            $.validator.addMethod(
                "date",
                function(value, element) {
                    // yyyy-mm-dd
                    var re = /^([0]?[1-9]|[1|2][0-9]|[3][0|1])[./-]([0]?[1-9]|[1][0-2])[./-]([0-9]{4}|[0-9]{2})$/;

                    // valid if optional and empty OR if it passes the regex test
                    return (this.optional(element) && value=="") || re.test(value);
                }
            );

            $("#form-profile").validate({
                rules: {
                    nama: {
                        required: true
                    },
                    jenis_kelamin:{
                        required: true
                    },
                    tanggal_lahir: {
                        required: true, 
                        date: true
                    },
                    tempat_lahir: {
                        required: true
                    }
                    
                },
                messages: {
                    jenis_kelamin : {
                        required:"Pilih Salah Satu <br/>"
                    },
                    tanggal_lahir: {
                        required: 'Tanggal Lahir Kosong',
                        date: "Masukan Tanggal Dengan Format dd-mm-yyyy"
                    },
                    nama: "Nama Kosong",
                    tempat_lahir: "Tempat Lahir Kosong"
                },
                errorPlacement: function(error, element) 
                {
                    if ( element.is(":radio") ) 
                    {
                        error.appendTo( element.parents('.radio') );
                    }
                    else 
                    { // This is the default behavior 
                        error.insertAfter( element );
                    }
                },
                submitHandler: function(form)
                {
                    var data = $('#form-profile').serialize();

                    $.ajax({
                        url: "ajax/update/profile.php",
                        data: data,
                        type: "post",
                        success:function(response)
                        {
                            if(response == "null")
                            {
                                $('#message').show();
                                $('#message').html('<div class="alert alert-danger bg-danger text-white"><em class="fas fa-times"></em> Lengkapi Data</div>');
                                $('#message').delay(5000).fadeOut('slow');
                            }
                            else if(response == "sukses")
                            {
                                $('#message').show();
                                $('#message').html('<div class="alert alert-success bg-success text-white"><em class="fas fa-check"></em> Berhasil Ubah Data</div>');
                                $('#message').delay(5000).fadeOut('slow').slideUp(500);
                                frm_profile();
                            }
                            else{
                                $('#message').show();
                                $('#message').html('<div class="alert alert-danger bg-danger text-white"><em class="fas fa-times"></em> Terjadi Kesalahan !</div>');
                                $('#message').delay(5000).fadeOut('slow');
                            }
                        }
                    })
                }
            })
        })

        // show pass and hide pass
        $('#form-pass').on('click', '.pw-lm', function(){
            var pwl = $('.shw-pwl').attr("type");

            if(pwl == "password")
            {
                $('.shw-pwl').attr("type", "text");
                $('.icn-pwl').removeClass("fa-eye");
                $('.icn-pwl').addClass("fa-eye-slash");
            }else{
                $('.shw-pwl').attr("type", "password");
                $('.icn-pwl').removeClass("fa-eye-slash");
                $('.icn-pwl').addClass("fa-eye");
            }
        });

        $('#form-pass').on('click', '.pwb', function(){
            var pwl = $('.shw-pwb').attr("type");

            if(pwl == "password")
            {
                $('.shw-pwb').attr("type", "text");
                $('.icn-pwb').removeClass("fa-eye");
                $('.icn-pwb').addClass("fa-eye-slash");
            }else{
                $('.shw-pwb').attr("type", "password");
                $('.icn-pwb').removeClass("fa-eye-slash");
                $('.icn-pwb').addClass("fa-eye");
            }
        });

        $('#form-pass').on('click', '.kpwb', function(){
            var pwl = $('.shw-kpwb').attr("type");

            if(pwl == "password")
            {
                $('.shw-kpwb').attr("type", "text");
                $('.icn-kpwb').removeClass("fa-eye");
                $('.icn-kpwb').addClass("fa-eye-slash");
            }else{
                $('.shw-kpwb').attr("type", "password");
                $('.icn-kpwb').removeClass("fa-eye-slash");
                $('.icn-kpwb').addClass("fa-eye");
            }
        });

        // eksekusi klik tombol ubah password
        $('#form-pass').on('click', '.update', function(){
            $('#form-pass').validate({
                errorClass: "error",
                errorElement: "span",
                rules: {
                    pass_lama:{
                        required: true
                    }
                },
                messages:{
                    pass_lama : "Password Lama Kosong"
                },

                errorPlacement: function ( error, element ) {
                    if(element.parent().hasClass('input-group')){
                    error.insertAfter( element.parent() );
                    }else{
                        error.insertAfter( element );
                    }

                },
            })
        })

        $('.data').DataTable();
    </script>
</body>

</html>