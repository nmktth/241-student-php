<?php 

namespace src\View;

class View {
    private $templatesPath;

    public function __construct(string $templatesPath) 
    {
        // Конструктор класса, принимающий абсолютный путь к папке с шаблонами и сохраняющий его в свойство $templatesPath
        $this->templatesPath = $templatesPath;
    }

    public function renderHtml(string $templateName, $vars = [], $code = 200) 
    {
        // Устанавливаем HTTP-статус ответа
        http_response_code($code); 
        // Преобразуем массив $vars в отдельные переменные
        extract($vars); 
        // Подключаем файл шаблона, путь к которому формируется через $templatesPath и имя шаблона
        include $this->templatesPath.'/'.$templateName.'.php'; 
    }

    public function renderHtml2(string $templateName, $vars = []) 
    {
        // Преобразуем массив $vars в отдельные переменные
        extract($vars);
        // Подключаем шаблон, переданный в параметре $templateName
        include $this->templatesPath.'/'.$templateName;
    }

    public function renderHtml3(string $templateName, $vars = [], $code = 200) 
    {
        // Устанавливаем код ответа
        http_response_code($code);
        // Импортируем переменные из массива $vars
        extract($vars);
        // Подключаем шаблон, указанный в $templateName
        include $this->templatesPath.'/'.$templateName;
    }
}
