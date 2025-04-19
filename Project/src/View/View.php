<?php 

namespace src\View;

class View {
    private $templatesPath;

    public function __construct(string $templatesPath) 
    {
        // Нормализуем путь, убирая конечные слеши
        $this->templatesPath = rtrim($templatesPath, '/\\');
    }

    public function renderHtml(string $templateName, $vars = [], $code = 200) 
    {
        // Устанавливаем код ответа HTTP
        http_response_code($code); 
        
        // Импортируем переменные в текущую область видимости
        extract($vars); 
        
        // Удаляем .php из имени шаблона, если он уже есть
        $templateName = str_replace('.php', '', $templateName);
        
        // Формируем полный путь к файлу
        $templatePath = $this->templatesPath . DIRECTORY_SEPARATOR . $templateName . '.php';
        
        // Проверяем существование файла
        if (!file_exists($templatePath)) {
            throw new \RuntimeException("Шаблон не найден: " . $templatePath);
        }
        
        // Подключаем файл шаблона
        include $templatePath;
    }
}