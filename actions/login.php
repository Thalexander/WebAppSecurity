<?php
require '../controllers/accountsController.php';

$controller = new AccountController();

$login = $controller->login($_POST["username"], $_POST["password"]);

if ($login != -1) {
    header("Location: /index.php?success=login");
}
else {
    header("Location: /login.php?error=true");
}
