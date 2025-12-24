<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Lab11 PHP OOP</title>
    <style>
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background: #eef2f7;
            margin: 0;
        }

        .container {
            width: 1050px;
            margin: 30px auto;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
            overflow: hidden;
        }

        header {
            padding: 22px;
            background: linear-gradient(135deg, #111827, #1f2937);
            color: #fff;
        }

        header h2 {
            margin: 0;
            font-size: 22px;
        }

        /* ===== NAVBAR ATAS ===== */
        .top-nav {
            display: flex;
            gap: 10px;
            padding: 12px 20px;
            background: #f9fafb;
            border-bottom: 1px solid #e5e7eb;
        }

        .top-nav a {
            padding: 8px 14px;
            border-radius: 6px;
            color: #1f2937;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.2s;
        }

        .top-nav a:hover {
            background: #2563eb;
            color: #fff;
        }

        /* ===== LAYOUT ===== */
        .layout {
            display: flex;
            min-height: 420px;
        }

        main {
            flex: 1;
            padding: 25px;
        }

        /* ===== SIDEBAR ===== */
        aside {
            width: 230px;
            background: #f3f4f6;
            border-left: 1px solid #e5e7eb;
            padding: 20px;
        }

        aside h4 {
            margin-top: 0;
            margin-bottom: 15px;
            font-size: 16px;
            color: #111827;
        }

        .side-menu {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .side-menu li {
            margin-bottom: 10px;
        }

        .side-menu a {
            display: block;
            padding: 10px 12px;
            border-radius: 6px;
            color: #1f2937;
            text-decoration: none;
            background: #fff;
            transition: all 0.2s;
            font-weight: 500;
        }

        .side-menu a:hover {
            background: #2563eb;
            color: #fff;
        }

        /* ===== TABEL ===== */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th {
            background: #2563eb;
            color: white;
        }

        table th, table td {
            padding: 10px;
            border-bottom: 1px solid #e5e7eb;
        }

        /* ===== FORM ===== */
        input, textarea, select {
            width: 100%;
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #d1d5db;
            box-sizing: border-box;
        }

        input[type=submit] {
            background: #2563eb;
            color: white;
            border: none;
            padding: 10px 16px;
            cursor: pointer;
            border-radius: 6px;
            margin-top: 10px;
        }

        input[type=submit]:hover {
            background: #1e40af;
        }

        footer {
            background: #111827;
            color: #fff;
            text-align: center;
            padding: 12px;
            font-size: 14px;
        }

        /* ===== BUTTON ===== */
        .btn-primary {
            display: inline-block;
            background: linear-gradient(135deg, #2563eb, #1e40af);
            color: #fff;
            padding: 10px 16px;
            border-radius: 8px;
            font-weight: 600;
            text-decoration: none;
            margin-bottom: 15px;
        }

        .btn-primary:hover {
            opacity: 0.9;
        }

        /* ===== TABEL MODERN ===== */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            border-radius: 8px;
            overflow: hidden;
        }

        table th {
            background: #2563eb;
            color: #fff;
            text-align: left;
            padding: 12px;
            font-size: 14px;
        }

        table td {
            padding: 12px;
            background: #fff;
            border-bottom: 1px solid #e5e7eb;
            vertical-align: top;
        }

        table tr:hover td {
            background: #f9fafb;
        }

        /* isi artikel */
        .artikel-isi {
            color: #374151;
            font-size: 14px;
            line-height: 1.5;
        }

        /* ===== AKSI ===== */
        .aksi a {
            text-decoration: none;
            font-weight: 500;
            margin-right: 10px;
        }

        .aksi a.edit {
            color: #2563eb;
        }

        .aksi a.delete {
            color: #dc2626;
        }

    </style>
</head>
<body>
<div class="container">
<header>
    <h2>Praktikum 11 - PHP OOP</h2>
</header>
<nav class="top-nav">
    <a href="/lab11_php_oop/index.php">🏠 Home</a>

    <?php if (isset($_SESSION['is_login'])): ?>
        <a href="/lab11_php_oop/index.php/artikel/index">📄 Artikel</a>
        <a href="/lab11_php_oop/index.php/user/profile">👤 Profil</a>
        <a href="/lab11_php_oop/index.php/user/logout">🚪 Logout (<?= $_SESSION['nama'] ?>)</a>
    <?php else: ?>
        <a href="/lab11_php_oop/index.php/user/login">🔐 Login</a>
    <?php endif; ?>
</nav>

<div class="layout">
<main style="flex:1;">
