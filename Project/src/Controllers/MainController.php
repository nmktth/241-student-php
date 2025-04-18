<?php

namespace src\Controllers;
use src\View\View;

class MainController {
    private $view;
    
    // Конструктор создаёт экземпляр класса View для рендеринга шаблонов
    public function __construct(){
        $this->view = new View(dirname(dirname(__DIR__)).'/templates'); // Устанавливаем путь к шаблонам для рендеринга
    }
    
    // Метод для отображения приветственного сообщения
    public function sayHello(string $name){
        $this->view->renderHtml('main/hello', ['name' => $name]); // Рендерим шаблон hello, передавая имя пользователя
    }

    // Метод для отображения прощального сообщения
    public function sayBye(string $name){
        $this->view->renderHtml('main/bye', ['name' => $name]); // Рендерим шаблон bye, передавая имя пользователя
    }
}
