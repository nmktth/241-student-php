<?php

namespace src\Models\Users;

use src\Models\ActiveRecordEntity;

class User extends ActiveRecordEntity // Класс User наследует функциональность от ActiveRecordEntity
{
    protected $nickname; // Никнейм пользователя
    protected $email; // Электронная почта пользователя
    protected $isConfirmed; // Статус подтверждения аккаунта (например, подтверждён ли email)
    protected $role; // Роль пользователя (например, администратор или обычный пользователь)
    protected $passwordHash; // Хэш пароля пользователя
    protected $authToken; // Токен для авторизации пользователя
    protected $createdAt; // Дата и время создания аккаунта пользователя

    // Устанавливаем значение для свойства nickname (псевдоним пользователя)
    public function setName(string $name): void 
    {
        $this->nickname = $name; // Присваиваем значение переменной $name свойству $nickname
    }

    // Получаем значение псевдонима (никнейма) пользователя
    public function getNickname(): string 
    {
        return $this->nickname; // Возвращаем текущий никнейм пользователя
    }

    // Метод getName также возвращает никнейм, чтобы обеспечить совместимость с интерфейсами
    public function getName(): string // Метод должен вернуть строковое значение (псевдоним)
    {
        return $this->nickname; // Возвращаем значение свойства nickname
    }

    // Указываем, с какой таблицей работает модель
    protected static function getTableName(): string 
    {
        return 'users'; // Модель работает с таблицей 'users'
    }
}
?>
