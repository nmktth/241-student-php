<?php

#1
echo '<BR>'.'Задание 1';
echo '<BR>'.preg_replace('/(\d)/', '$1$1', 'a1b2c3');

#4
echo '<BR>'.'Задание 4';
function isThirdLevelDomain($domain) {
    $pattern = '/^[a-z0-9](?:[a-z0-9-]{0,61}[a-z0-9])?\.[a-z0-9](?:[a-z0-9-]{0,61}[a-z0-9])?\.[a-z]{2,}$/i';
    if (preg_match($pattern, $domain) === 1) {
        return "Yes it's domain";
    }
}

echo '<BR>'.isThirdLevelDomain('hello.world.su');

#11
echo '<BR>'.'Задание 11';
echo '<BR>'.preg_replace('/([a-zA-Z0-9]+)@([a-zA-Z0-9]+)/', '$2@$1', 'aaa@bbb eee7@kkk');

#15
echo '<BR>'.'Задание 15';
echo '<BR>'.preg_replace('/a\\\\a/', '!', 'a\a abc');

#32
$str = 'abc 123 def 45 ghi 6 jkl 789';
preg_match_all('/\d+/', $str, $matches);
$sum = array_sum($matches[0]);
echo $sum; # Выведет: 963 (123 + 45 + 6 + 789)
