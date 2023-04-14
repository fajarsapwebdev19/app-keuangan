<?php

require '../../../database_connect.php';

$nama = mysqli_real_escape_string($con, $_POST['nama']);
$jenis_kelamin = mysqli_real_escape_string($con, $_POST['jenis_kelamin']);
$tempat_lahir = mysqli_real_escape_string($con, $_POST['tempat_lahir']);
$tanggal_lahir = mysqli_real_escape_string($con, date("Y-m-d", strtotime($_POST['tanggal_lahir'])));
$username = mysqli_real_escape_string($con, $_POST['username']);
$password = mysqli_real_escape_string($con, $_POST['password']);
$role = mysqli_real_escape_string($con, $_POST['role']);

if($nama == "" && $jenis_kelamin == "" && $tempat_lahir == "" && $tanggal_lahir == "" && $username == "" && $password == "" && $role == "")
{
    echo "null";
}else{
    $sql = mysqli_query($con, "SELECT max(id) AS id_personal FROM personal_data");
    $ip = mysqli_fetch_object($sql);
    $idp = $ip->id_personal + 1;
    $date = date('Y-m-d H:i:s');

    $add = mysqli_query($con, "INSERT INTO personal_data (id, nama, jenis_kelamin, tempat_lahir, tanggal_lahir, create_date, modified_date) VALUES ('$idp', '$nama','$jenis_kelamin','$tempat_lahir','$tanggal_lahir','$date',NULL)");

    $q2 = mysqli_query($con, "SELECT max(id) AS id_user FROM users");
    $uid = mysqli_fetch_object($q2);
    $user_id = $uid->id_user + 1;

    $add .= mysqli_query($con, "INSERT INTO users (id, personal_id, role_id, username, pass, status_account, token, create_date, modified_date) VALUES ('$user_id', '$idp', '$role', '$username', '$password','y',NULL, '$date', NULL)");

    if($add)
    {
        echo "success";
    }
}

?>