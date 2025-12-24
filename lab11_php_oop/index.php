<?php
session_start();

include "config.php";
include "class/Database.php";
include "class/Form.php";

$path = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '/home/index';
$segments = explode('/', trim($path, '/'));

$mod  = $segments[0] ?? 'home';
$page = $segments[1] ?? 'index';

/* =========================
   PROTEKSI HALAMAN
========================= */
$public_pages = ['home', 'user'];

if (!in_array($mod, $public_pages)) {
    if (!isset($_SESSION['is_login'])) {
        header("Location: /lab11_php_oop/index.php/user/login");
        exit;
    }
}

$file = "module/$mod/$page.php";

if (file_exists($file)) {

if ($mod == 'user' && ($page == 'login' || $page == 'logout')) {
    include $file;
} else {
    include "template/header.php";
    include $file;
    include "template/footer.php";
}


} else {
    echo "<h3>Halaman tidak ditemukan</h3>";
}
