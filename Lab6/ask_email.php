<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['user_email'] = $_POST['email'];
    header('Location: register.php');
    exit;
}
?>

<form method="POST">
    <label>Введите ваш email:</label>
    <input type="email" name="email" required>
    <button type="submit">Далее</button>
</form>