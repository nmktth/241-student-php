<?php
$file = 'count.txt';

if (!file_exists($file)) {
    file_put_contents($file, '0');
}

$currentCount = (int)file_get_contents($file);

$currentCount++;

file_put_contents($file, $currentCount);

echo "Количество обновлений страницы: " . $currentCount;
?>