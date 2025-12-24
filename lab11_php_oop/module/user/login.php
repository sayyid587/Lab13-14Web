<?php
// ===== LOGIC LOGIN (HARUS DI ATAS) =====
if (isset($_SESSION['is_login'])) {
    header("Location: ../artikel/index");
    exit;
}

$message = "";

if ($_POST) {
    $db = new Database();

    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$username' LIMIT 1";
    $result = $db->query($sql);
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['is_login'] = true;
        $_SESSION['username'] = $user['username'];
        $_SESSION['nama'] = $user['nama'];

        header("Location: ../artikel/index");
        exit;
    } else {
        $message = "Username atau Password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Login Admin</title>

<style>
body {
    background: linear-gradient(135deg, #e5edff, #f1f5ff);
    font-family: 'Segoe UI', Arial, sans-serif;
}

.login-wrapper {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.login-card {
    width: 380px;
    background: #fff;
    border-radius: 14px;
    padding: 30px;
    box-shadow: 0 15px 40px rgba(0,0,0,0.12);
}

.login-card h2 {
    text-align: center;
    margin-bottom: 25px;
    color: #1f2937;
}

.form-group {
    margin-bottom: 18px;
}

.form-group label {
    font-size: 14px;
    color: #374151;
    margin-bottom: 6px;
    display: block;
}

.form-group input {
    width: 100%;
    padding: 12px;
    border-radius: 8px;
    border: 1px solid #d1d5db;
    font-size: 14px;
    outline: none;
}

.form-group input:focus {
    border-color: #2563eb;
}

.password-wrapper {
    position: relative;
}

.toggle-password {
    position: absolute;
    right: 12px;
    top: 50%;
    transform: translateY(-50%);
    cursor: pointer;
    font-size: 13px;
    color: #2563eb;
    user-select: none;
}

.btn-login {
    width: 100%;
    padding: 12px;
    background: linear-gradient(135deg, #2563eb, #1e40af);
    color: #fff;
    border: none;
    border-radius: 10px;
    font-size: 15px;
    font-weight: 600;
    cursor: pointer;
    margin-top: 10px;
}

.btn-login:hover {
    opacity: 0.95;
}

.alert {
    background: #fee2e2;
    color: #b91c1c;
    padding: 10px;
    border-radius: 8px;
    margin-bottom: 15px;
    font-size: 14px;
}
</style>

<script>
function togglePassword() {
    const pwd = document.getElementById("password");
    const btn = document.getElementById("toggleBtn");

    if (pwd.type === "password") {
        pwd.type = "text";
        btn.innerText = "Hide";
    } else {
        pwd.type = "password";
        btn.innerText = "Show";
    }
}
</script>
</head>

<body>
<div class="login-wrapper">
    <div class="login-card">
        <h2>Login Admin</h2>

        <?php if ($message): ?>
            <div class="alert"><?= $message ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" placeholder="Masukkan username" required>
            </div>

            <div class="form-group">
                <label>Password</label>
                <div class="password-wrapper">
                    <input type="password" name="password" id="password" placeholder="Masukkan password" required>
                    <span class="toggle-password" id="toggleBtn" onclick="togglePassword()">Show</span>
                </div>
            </div>

            <button type="submit" class="btn-login">Login</button>
        </form>
    </div>
</div>
</body>
</html>
