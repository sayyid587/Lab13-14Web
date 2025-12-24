<?php
session_start();
session_destroy();

// Redirect via index.php (router)
header("Location: /lab11_php_oop/index.php/user/login");
exit;
