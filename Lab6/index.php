<?php
session_start();

#1
if (!isset($_SESSION['test_text'])) {
    $_SESSION['test_text'] = 'test';
    echo "Текст 'test' был записан в сессию. Обновите страницу, чтобы увидеть его.";
} else {
    echo "Содержимое сессии: " . $_SESSION['test_text'];
}


#3
if (!isset($_SESSION['page_refresh_count'])) {
    $_SESSION['page_refresh_count'] = 0;
    $message = "Вы еще не обновляли эту страницу.";
} else {
    // Увеличиваем счетчик при каждом обновлении
    $_SESSION['page_refresh_count']++;
    $message = "Количество обновлений страницы: " . $_SESSION['page_refresh_count'];
}
// Выводим сообщение
echo "<p>$message</p>";


#5
if (!isset($_SESSION['first_visit_time'])) {
    // Если нет - записываем текущее время
    $_SESSION['first_visit_time'] = time();
    $message = "Вы только что зашли на сайт!";
} else {
    // Если время уже записано - вычисляем разницу
    $currentTime = time();
    $timeDiff = $currentTime - $_SESSION['first_visit_time'];
    $message = "С момента вашего захода на сайт прошло: " . $timeDiff . " секунд";
}

// Выводим результат
echo "<p>$message</p>";

#9
$count = isset($_COOKIE['visits']) ? $_COOKIE['visits'] : 0;

// Увеличиваем счетчик
$count++;

// Сохраняем новое значение
setcookie('visits', $count);

// Выводим сообщение
echo "Вы посетили наш сайт $count раз!";