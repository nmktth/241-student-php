
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lab3#1</title>
</head>
<body>
    <form method="post" action="">
        <label for="text">Введите текст:</label><br>
        <textarea id="text" name="text" rows="4" cols="50"></textarea><br>
        <input type="submit" value="Преобразовать">
    </form>
    <form method="post" action="">
        <label for="century">Введите текст 21:</label><br>
        <textarea id="century" name="century" rows="4" cols="50"></textarea><br>
        <input type="submit" value="Преобразовать">
    </form>
</body>
</html>

<?php
function upEverySecondWord(&$words) {
    foreach ($words as $key => &$word) {
        if ($key % 2 == 1) {
            $word = mb_strtoupper($word);
        }
    }
}

$text = $_REQUEST['text'];
$words = explode(' ', $text);

upEverySecondWord($words);

$resultText = implode(' ', $words);
echo "Результат: " . htmlspecialchars($resultText);
?>

<?php
$XVI = "Иван Васильевич";
$XVIII = "Пётр Алексеевич";
$XIX = "Николай Павлович";

$century = $_REQUEST['century'];

if (isset($$century)) {
    $ruler = $$century;
    echo "В $century веке царствовал $ruler.";
} else {
    echo "Введённый век не найден.";
}
?>