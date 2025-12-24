<?php
// ===== LOGIC HARUS DI ATAS (SEBELUM HTML) =====
if (!isset($_SESSION['is_login'])) {
    header("Location: /lab11_php_oop/index.php/user/login");
    exit;
}

$db = new Database();
$message = "";

if ($_POST) {
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $username = $_SESSION['username'];

    $db->query("UPDATE users SET password='$password' WHERE username='$username'");
    $message = "Password berhasil diubah!";
}
?>

<!-- ===== BARU BOLEH HTML ===== -->
<h2>Profil User</h2>

<p><b>Nama:</b> <?= $_SESSION['nama']; ?></p>
<p><b>Username:</b> <?= $_SESSION['username']; ?></p>

<?php if ($message): ?>
    <p style="color:green"><?= $message ?></p>
<?php endif; ?>

<form method="post">
    <label>Password Baru</label><br>
    <input type="password" name="password" required><br><br>
    <input type="submit" value="Ubah Password">
</form>
