<?php
session_start();
require '../database_connect.php';

if (empty($_SESSION['token'])) {
    header('location: ../');
} else {
    $id_user = $_SESSION['user_id'];
    $sql = mysqli_query($con, "SELECT u.id, u.personal_id, u.role_id, u.username, u.token, pd.nama, pd.jenis_kelamin, pd.tempat_lahir, pd.tanggal_lahir, r.role_name AS role FROM users u 
        INNER JOIN personal_data pd ON u.personal_id = pd.id
        INNER JOIN roles r ON u.role_id = r.role_id WHERE u.id='$id_user'");
    $data_user = mysqli_fetch_object($sql);

    // pemasukan
        $q1 = mysqli_query($con, "SELECT sum(jumlah) AS jumlah FROM pemasukan WHERE id_user='$id_user'");
        $pem = mysqli_fetch_object($q1);
    // pengeluaran
        $q2 = mysqli_query($con, "SELECT sum(jumlah) AS jumlah FROM pengeluaran WHERE id_user='$id_user'");
        $pgl = mysqli_fetch_object($q2);
    // total saldo
        $tot = $pem->jumlah - $pgl->jumlah;
    if ($_SESSION['token'] !== $data_user->token) {
        header('location: ../');
    }

    if($data_user->role_id != 2)
    {
        ?>
            <script>
                alert("Anda Bukan Admin !");
                document.location.href='../';
            </script>
        <?php
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

        th.text-center, td.text-center{
            text-align: center;
        }

        select.error{
            color: #dc3545;
            border: 1px solid #dc3545;
        }

        select.valid{
            border: 1px solid #198754;
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

        .input-group-text {
            background-color: #fff;
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
                        <a class="nav-link" href="#" data-bs-target="#logout" data-bs-toggle="modal">Logout</a>
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

        <!-- modal logout -->
        <div class="modal fade" id="logout" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Konfirmasi Keluar Aplikasi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p class="text-center">
                            Apakah Anda Yakin Ingin Keluar Dari Aplikasi ?
                            <br><br>
                            <a href="../logout.php" class="btn btn-success">Ya</a>
                            <a href="#" data-bs-dismiss="modal" class="btn btn-danger">Tidak</a>
                        </p>
                    </div>
                </div>
            </div>
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
    <script src="../assets/main.js"></script>
</body>

</html>