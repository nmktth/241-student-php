<?php
namespace src\Controllers;

use src\View\View;
use src\Models\Comments\Comment;
use src\Models\Articles\Article;

class CommentController
{
    private $view;

    // Конструктор создаёт экземпляр класса View для рендеринга шаблонов
    public function __construct() 
    {
        $this->view = new View(dirname(dirname(__DIR__)).'/templates'); // Устанавливаем путь к шаблонам
    }

    // Метод для сохранения нового комментария
    public function store(int $articleId)
    {
        $comment = new Comment(); // Создаём новый объект модели Comment
        $comment->setText($_POST['text']); // Устанавливаем текст комментария из POST-запроса
        $comment->setAuthorId(2); // Устанавливаем ID автора комментария (пока что фиксированное значение)
        $comment->setArticleId($articleId); // Привязываем комментарий к статье по её ID
        $comment->save(); // Сохраняем комментарий в базе данных, вызывая метод save() из ActiveRecord
        $bUrl = dirname($_SERVER['SCRIPT_NAME']); 
        header("Location: {$bUrl}/article/{$articleId}#comment{$comment->getId()}"); // Перенаправляем на страницу статьи с комментариями
    }

    // Метод для отображения формы редактирования комментария
    public function edit(int $id)
    {
        $comment = Comment::getById($id); // Получаем комментарий по его ID
        if (!$comment) {
            throw new \Exception(); // Если комментарий не найден, выбрасываем исключение
        }
        $this->view->renderHtml('comment/edit.php', [ // Рендерим шаблон для редактирования комментария
            'comment' => $comment,
            'error' => null // Ошибка отсутствует, так как комментарий найден
        ]);
    }

    // Метод для обновления существующего комментария
    public function update(int $id)
    {
        $comment = Comment::getById($id); // Получаем комментарий по его ID
        $comment->setText($_POST['text']); // Обновляем текст комментария
        $comment->save(); // Сохраняем изменения комментария в базе данных
        $rUrl = dirname($_SERVER['SCRIPT_NAME']).'/article/'.$comment->getArticleId().'#comment'.$comment->getId(); // Формируем URL для редиректа
        header("Location: $rUrl"); // Перенаправляем пользователя на страницу статьи с обновлённым комментарием
    }
}
