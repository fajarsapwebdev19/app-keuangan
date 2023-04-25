<?php
    $page = "home";

    if(array_key_exists('page', $_GET))
    {
        $page = $_GET['page'];
    }

    switch($page)
    {
        case 'home';
        require 'page/home.php';
        break;

        case 'invite';
        require 'page/invite.php';
        break;

        case 'friends';
        require 'page/friends.php';
        break;

        case 'pemasukan';
        require 'page/pemasukan.php';
        break;

        case 'pengeluaran';
        require 'page/pengeluaran.php';
        break;

        case 'profile';
        require 'page/profile.php';
        break;

        case 'up_pass';
        require 'page/up_pass.php';
        break;
    }
?>