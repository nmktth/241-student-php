<?php
session_start();

// Получаем данные из формы
$userData = [
    'first_name' => $_POST['first_name'],
    'last_name' => $_POST['last_name'],
    'password' => $_POST['password'],
    'email' => $_POST['email']
];

echo "Регистрация успешна!";
print_r($userData);

// Очищаем email из сессии
unset($_SESSION['user_email']);
?>