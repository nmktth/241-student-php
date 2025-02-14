<?php

#Номер 1
print("Номер 1"."</br>");
// Заданные значения катетов
$a = 27;
$b = 12;

// Вычисление гипотенузы
$hypotenuse = sqrt($a ** 2 + $b ** 2);

// Округление результата до двух знаков после запятой
$hypotenuse_rounded = round($hypotenuse, 2);
echo "Гипотенуза: " . $hypotenuse_rounded.'</br>';

echo '</br>';

#Номер 6
print("Номер 6"."</br>");

$a = 2;       // int
$b = 2.0;     // float
$c = '2';     // string
$d = 'two';   // string
$g = true;    // bool
$f = false;   // bool

// Сравнение на равенство (==)
echo "a == b: " . ($a == $b ? 'true' : 'false') . "</br>"; // true
echo "a == c: " . ($a == $c ? 'true' : 'false') . "</br>"; // true
echo "a == d: " . ($a == $d ? 'true' : 'false') . "</br>"; // false
echo "a == g: " . ($a == $g ? 'true' : 'false') . "</br>"; // true
echo "a == f: " . ($a == $f ? 'true' : 'false') . "</br>"; // false

// Сравнение на идентичность (===)
echo "a === b: " . ($a === $b ? 'true' : 'false') . "</br>"; // false
echo "a === c: " . ($a === $c ? 'true' : 'false') . "</br>"; // false
echo "a === g: " . ($a === $g ? 'true' : 'false') . "</br>"; // false

// Сравнение на неравенство (!=)
echo "a != b: " . ($a != $b ? 'true' : 'false') . "</br>"; // false
echo "a != c: " . ($a != $c ? 'true' : 'false') . "</br>"; // false
echo "a != d: " . ($a != $d ? 'true' : 'false') . "</br>"; // true

// Сравнение на неидентичность (!==)
echo "a !== b: " . ($a !== $b ? 'true' : 'false') . "</br>"; // true
echo "a !== c: " . ($a !== $c ? 'true' : 'false') . "</br>"; // true
echo "a !== g: " . ($a !== $g ? 'true' : 'false') . "</br>"; // true

// Больше (>), меньше (<), больше или равно (>=), меньше или равно (<=)
echo "a > b: " . ($a > $b ? 'true' : 'false') . "</br>"; // false
echo "a < b: " . ($a < $b ? 'true' : 'false') . "</br>"; // false
echo "a >= b: " . ($a >= $b ? 'true' : 'false') . "</br>"; // true
echo "a <= b: " . ($a <= $b ? 'true' : 'false') . "</br>"; // true

// Логические операции с булевыми значениями
echo "g && f: " . ($g && $f ? 'true' : 'false') . "</br>"; // false
echo "g || f: " . ($g || $f ? 'true' : 'false') . "</br>"; // true
echo "!g: " . (!$g ? 'true' : 'false') . "</br>"; // false
echo "!f: " . (!$f ? 'true' : 'false') . "</br>"; // true

#Номер 13
print("</br>"."Номер 13"."</br>");
$give = 'Дают';
$take = 'бери';
$beat = 'бьют';
$run = 'беги';

// Сборка пословицы с использованием интерполяции
$proverb = "{$give} - {$take}, {$beat} - {$run}."."</br>";

// Вывод результата
echo $proverb;

#Номер 22
print('</br>'.'Номер 22'.'</br>');
$a = 4;
$b = 3;
$c = ' мандаринок';

// Умножаем $a на $b и преобразуем результат в строку
$result = $a * $b;

// Конкатенируем результат с переменной $c
$result .= $c;

// Выводим результат
echo $result.'</br>'; // "12 мандаринок"

#Номер 8
print('</br>'.'Номер 8'.'</br>');

$a = true;
$b = false;

echo var_dump($a);
echo '</br>';
echo var_dump($b);
echo '</br>';
?>