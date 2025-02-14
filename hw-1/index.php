<?php

date_default_timezone_set('Europe/Moscow');

$currentTime = date('H:i');
$hour = date('H');


$isNight = ($hour >= 23 || $hour < 6);


if ($isNight) {
    $icon = '🌙';
    $themeClass = 'dark-theme';
} else {
    $icon = '☀️';
    $themeClass = 'light-theme';
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Текущее время</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body class="<?php echo $themeClass; ?>">
    <header class="<?php echo $themeClass; ?>">
        <div class="logo">
            <img src="img/logo.png" alt="Логотип МосПолитеха">
        </div>
    </header>

    <main>
        <div class="<?php echo $themeClass; ?>">
            <h1>Текущее время:</h1>
            <p>Сейчас: <?php echo $currentTime; ?></p>
            <p class="icon"><?php echo $icon; ?></p>
        </div>
    </main>

    <footer>
        <p>Смена темы в зависимости от времени суток 🐈🐈‍⬛</p>
    </footer>
</body>
</html>