<?php
namespace src\Services;

class Db
{
    private $pdo;
    private static $instance; // Переменная для хранения экземпляра класса. Сделано private, чтобы создать объект можно было только через метод getInstance()

    private function __construct()
    {
        $dbOptions = require('settings.php');  // Загружаем настройки подключения к базе данных из конфигурационного файла
        $this->pdo = new \PDO( // Создаем объект PDO для взаимодействия с базой данных
            'mysql:host='.$dbOptions['host'].';dbname='.$dbOptions['dbname'],
            $dbOptions['user'],
            $dbOptions['password']
        );
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION); // Устанавливаем обработку ошибок: при возникновении ошибок PDO будет генерировать исключения
    }

    public function query(string $sql, array $params = [], string $className = 'stdClass'): array 
    {
        $stmt = $this->pdo->prepare($sql); // Подготавливаем SQL-запрос
        $stmt->execute($params); // Выполняем запрос, передавая параметры
        $stmt->setFetchMode(\PDO::FETCH_CLASS, $className); // Устанавливаем способ выборки данных: каждая строка будет преобразована в объект указанного класса
        return $stmt->fetchAll(); // Возвращаем массив объектов с результатами запроса
    }

    public function getLastInsertId(): int 
    {
        return (int)$this->pdo->lastInsertId(); // Возвращаем ID последней вставленной записи
    }

    public static function getInstance(): self 
    {
        if (self::$instance === null) { // Если объект еще не был создан, создаем новый
            self::$instance = new self(); // Создаем и сохраняем объект в переменной $instance
        }
        return self::$instance; // Возвращаем единственный экземпляр объекта для дальнейшего использования
    }
}
