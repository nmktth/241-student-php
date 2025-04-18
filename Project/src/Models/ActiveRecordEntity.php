<?php

namespace src\Models;

use src\Models\Articles\Article;
use src\Services\Db;
use ReflectionObject;

abstract class ActiveRecordEntity
{
    protected $id; // ID объекта, например, статьи или комментария
    
    // Метод для получения ID объекта
    public function getId()
    {
        return $this->id;
    }

    // Магический метод __set для установки значений свойств объекта
    public function __set($name, $value)
    {
        // Преобразование имени свойства из snake_case в camelCase
        $camelCaseName = $this->underscoreToCamelcase($name);
        // Устанавливаем значение свойству в нужном формате
        $this->$camelCaseName = $value;
    }

    // Преобразует строку из snake_case в camelCase
    private function underscoreToCamelcase(string $name): string
    {
        return lcfirst(str_replace('_', '', ucwords($name, '_'))); // Преобразуем в camelCase
    }

    // Преобразует строку из camelCase в snake_case
    private function camelCaseToUnderscore(string $source): string
    {
        return strtolower(preg_replace('/([A-Z])/', '_$1', $source)); // Преобразуем в snake_case
    }

    // Отображаем свойства объекта в формат, подходящий для записи в базу данных
    private function mapPropertiesToDb(): array
    {
        $reflector = new ReflectionObject($this); // Создаём объект ReflectionObject для текущего объекта
        $properties = $reflector->getProperties(); // Получаем все свойства объекта
        $mappedProperties = []; // Массив для хранения данных в формате БД

        foreach ($properties as $property) {
            $propertyName = $property->getName(); // Получаем имя свойства
            $propertyDbName = $this->camelCaseToUnderscore($propertyName); // Преобразуем имя в snake_case
            $mappedProperties[$propertyDbName] = $this->$propertyName; // Добавляем в массив для SQL-запроса
        }

        return $mappedProperties; // Возвращаем массив с подготовленными данными для запроса
    }

    // Метод для получения всех записей из таблицы
    public static function findAll(): ?array
    {
        $db = Db::getInstance(); // Получаем экземпляр подключения к базе данных
        $sql = 'SELECT * FROM `' . static::getTableName() . '`'; // Формируем SQL-запрос
        return $db->query($sql, [], static::class); // Выполняем запрос и получаем объекты соответствующего класса
    }

    // Метод для получения записи по ID
    public static function getById(int $id): ?static
    {
        if ($id <= 0) {
            return null; // Если ID невалиден, возвращаем null
        }

        $db = Db::getInstance(); // Получаем экземпляр подключения к базе данных
        $entities = $db->query(
            'SELECT * FROM ' . static::getTableName() . ' WHERE id = :id', // Формируем SQL-запрос
            [':id' => $id], // Передаём ID как параметр
            static::class // Указываем класс для возвращаемого объекта
        );
        return $entities[0] ?? null; // Возвращаем первый объект или null, если запись не найдена
    }

    // Метод для поиска записей по конкретной колонке и сортировки
    public static function findByColumnOrdered(string $column, $value, string $orderBy = 'id', string $direction = 'ASC'): array
    {
        $db = Db::getInstance(); // Получаем экземпляр подключения к базе данных
        $tableName = static::getTableName(); // Получаем имя таблицы из дочернего класса

        // Формируем SQL-запрос с параметрами сортировки
        $sql = "SELECT * FROM `$tableName` 
            WHERE `$column` = :value 
            ORDER BY `$orderBy` $direction";

        return $db->query($sql, [':value' => $value], static::class) ?: []; // Выполняем запрос и возвращаем результаты
    }

    // Метод для сохранения записи (вставка или обновление)
    public function save()
    {
        if ($this->getId()) {
            $this->update(); // Если есть ID, выполняем обновление
        } else {
            $this->insert(); // Если ID нет, выполняем вставку
        }
    }

    // Метод для обновления записи
    private function update()
    {
        $properties = $this->mapPropertiesToDb(); // Преобразуем свойства объекта в массив для БД
        $column2Params = []; // Для хранения столбцов и параметров
        $param2Value = []; // Для хранения значений параметров

        foreach ($properties as $key => $value) {
            $column = '`' . $key . '`'; // Столбец в формате SQL
            $param = ':' . $key; // Параметр в формате :param
            $column2Params[] = $column . '=' . $param; // Формируем часть для SET в запросе
            $param2Value[$param] = $value; // Добавляем значение параметра
        }

        // Формируем SQL-запрос для обновления
        $sql = 'UPDATE `' . static::getTableName() . '` SET ' . implode(',', $column2Params) . ' WHERE `id`=:id';
        $db = Db::getInstance(); // Получаем экземпляр подключения к базе данных
        $db->query($sql, $param2Value, static::class); // Выполняем запрос
    }

    // Метод для вставки новой записи
    private function insert()
    {
        $properties = array_filter($this->mapPropertiesToDb()); // Преобразуем свойства объекта в массив и убираем пустые значения
        $columns = []; // Для хранения столбцов
        $params = []; // Для хранения параметров
        $param2Value = []; // Для хранения значений параметров

        foreach ($properties as $key => $val) {
            $columns[] = '`' . $key . '`'; // Столбец в формате SQL
            $param = ':' . $key; // Параметр в формате :param
            $params[] = $param; // Добавляем параметр в список
            $param2Value[$param] = $val; // Связываем параметр с его значением
        }

        // Формируем SQL-запрос для вставки
        $sql = 'INSERT INTO `' . static::getTableName() . '`(' . implode(',', $columns) . ') VALUES (' . implode(',', $params) . ')';
        $db = Db::getInstance(); // Получаем экземпляр подключения к базе данных
        $db->query($sql, $param2Value, static::class); // Выполняем запрос
    }

    // Метод для удаления записи
    public function delete()
    {
        // Формируем SQL-запрос для удаления
        $sql = 'DELETE FROM `' . static::getTableName() . '` WHERE `id`=:id';
        $db = Db::getInstance(); // Получаем экземпляр подключения к базе данных
        $db->query($sql, [':id' => $this->id], static::class); // Выполняем запрос
    }

    // Абстрактный метод для получения имени таблицы
    abstract protected static function getTableName(): string;
}
?>
