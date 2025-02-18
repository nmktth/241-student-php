<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body class="theme">
    <header class="theme">
        <div class="logo">
            <img src="img/logo.png" alt="Логотип МосПолитеха">
        </div>
    </header>

    <main>
        <form class="form" id="feedbackForm" action="https://httpbin.org/post" method="POST">
            <label for="username">Имя пользователя:</label>
            <input type="text" id="username" name="username" required>

            <label for="email">E-mail пользователя:</label>
            <input type="email" id="email" name="email" required>

            <label for="type">Тип обращения:</label>
            <select id="type" name="type" required>
                <option value="жалоба">Жалоба</option>
                <option value="предложение">Предложение</option>
                <option value="благодарность">Благодарность</option>
            </select>

            <label for="message">Текст обращения:</label>
            <textarea id="message" name="message" required></textarea>

            <label>
                <input type="checkbox" name="response_type" value="sms"> СМС
            </label>
            <label>
                <input type="checkbox" name="response_type" value="email"> E-mail
            </label>

            <button type="submit">Отправить</button>
            <a class = 'button' href = 'res.php'>следующая страница</a>
        </form>
    </main>

    <footer>
        <p>Собрать сайт из двух страниц.

1 страница: Сверстать форму обратной связи. Отправку формы осуществить на URL: https://httpbin.org/post. Добавить кнопку для перехода на 2 страницу.

2 страница: вывести на страницу результат работы функции get_headers. Загрузить код в удаленный репозиторий. Залить на хостинг.</p>
    </footer>
</body>
</html>