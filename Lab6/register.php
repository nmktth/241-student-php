<?php
session_start();

// Получаем email из сессии или оставляем пустым
$email = $_SESSION['user_email'] ?? '';
?>

<form method="POST" action="process.php">
    <label>Имя:</label>
    <input type="text" name="first_name" required>
    
    <label>Фамилия:</label>
    <input type="text" name="last_name" required>
    
    <label>Пароль:</label>
    <input type="password" name="password" required>
    
    <label>Email:</label>
    <input type="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
    
    <button type="submit">Зарегистрироваться</button>
</form>