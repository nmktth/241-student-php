<?php

namespace src\Controllers;

use src\Models\Comments\Comment;
use src\View\View;
use src\Services\Db;
use src\Models\Articles\Article;
use src\Models\Users\User;
use Exception;
use Exceptions\NotFoundException;
use Exceptions\DbException;

class ArticleController {
    private $view;
    private $db;

    // Конструктор инициализирует объект для рендеринга и подключение к базе данных
    public function __construct()
    {
        $this->view = new View(dirname(dirname(__DIR__)).'/templates'); // Задаём путь к шаблонам для рендеринга
        $this->db = Db::getInstance(); // Получаем экземпляр подключения к базе данных
    }

    // Метод для отображения списка всех статей
    public function index() {
        $articles = Article::findAll(); // Получаем все статьи через метод findAll, определённый в модели Article
        $this->view->renderHtml('main/main', ['articles' => $articles]); // Рендерим шаблон главной страницы с переданными статьями
    }

    // Метод для отображения одной статьи по её ID
    public function show(int $id) 
    {
        $article = Article::getById($id); // Получаем статью по её ID
        if (!$article) {
            throw new NotFoundException(); // Если статья не найдена, выбрасываем исключение
        }

        $comments = Comment::findAllByArticleId($id) ?? []; // Получаем все комментарии к статье
        $this->view->renderHtml('article/show', [ // Рендерим шаблон страницы статьи, передавая статью, автора и комментарии
            'article' => $article,
            'author' => $article->getAuthor(),
            'comments' => $comments
        ]);
    }

    // Метод для удаления статьи по её ID
    public function delete(int $id) 
    {
        $article = Article::getById($id); // Получаем статью по её ID
        if (!$article) {
            throw new NotFoundException(); // Если статья не найдена, выбрасываем исключение
        }
        $article->delete(); // Удаляем статью через метод delete() из класса ActiveRecordEntity
        header("Location: http://localhost/student/php/241-student-php/Project/www"); // Перенаправляем на главную страницу после удаления
    }

    // Метод для отображения формы создания новой статьи
    public function create(){
        return $this->view->renderHtml('article/create');  // Рендерим шаблон формы для создания статьи
    }

    // Метод для отображения формы редактирования статьи
    public function edit(int $id){
        $article = Article::getById($id); // Получаем статью по её ID
        return $this->view->renderHtml('/article/edit', ['article'=>$article]); // Рендерим форму редактирования статьи с данными о статье
    }

    // Метод для обновления данных статьи в базе данных
    public function update(int $id)
    {
        $article = Article::getById($id); // Получаем статью по её ID
        if (!$article) {
            throw new NotFoundException(); // Если статья не найдена, выбрасываем исключение
        }
        $article->setName($_POST['name']); // Обновляем название статьи
        $article->setText($_POST['text']); // Обновляем текст статьи
        $article->save(); // Сохраняем изменения в базе данных с помощью метода save() из ActiveRecord
        header("Location: http://localhost/student/php/241-student-php/Project/www"); // Перенаправляем на главную страницу после обновления
    }

    // Метод для сохранения новой статьи в базе данных
    public function store() 
    {
        $article = new Article(); // Создаём новый объект статьи
        $article->setName($_POST['name']); // Устанавливаем название статьи
        $article->setText($_POST['text'] ?? ''); // Устанавливаем текст статьи, если он задан
        $article->setAuthorId(1); // Устанавливаем ID автора статьи
        $article->save(); // Сохраняем статью в базе данных с помощью метода save()
        header("Location: http://localhost/student/php/241-student-php/Project/www"); // Перенаправляем на главную страницу после сохранения
    }
}
