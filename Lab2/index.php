<?php

#Номер 3
$arr = [1,2,3,4,5];
print_r(array_reverse($arr));
echo '</br>'.'</br>';
#Номер 6
$arr2 = ['a', 'b', 'c', 'd', 'e'];

$uppercaseArray = array_map('strtoupper', $arr2);

print_r($uppercaseArray);
echo '</br>'.'</br>';
#Номер 9
$arr3 = ['a' => 1, 'b' => 2, 'c' => 3];

$randomKey = array_rand($arr3);

echo $randomKey;
echo '</br>'.'</br>';
#Номер 13
$arr4 = ['a', '-', 'b', '-', 'c', '-', 'd'];

$position = array_search('-', $arr4);

if ($position !== false) {
    array_splice($arr4, $position, 1);
}

print_r($arr4);
echo '</br>'.'</br>';

#Номер 16

$arr5 = [1, 2, 3, 4, 5, 6, 7, 8];

while (!empty($arr5)) {

    echo array_shift($arr5);

    if (!empty($arr5)) {
        echo array_pop($arr5);
    }
}