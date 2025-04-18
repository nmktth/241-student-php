<?php
namespace src\Models\Articles;

use src\Models\ActiveRecordEntity;
use src\Models\Users\User;

class Article extends ActiveRecordEntity
{
    protected $name; // Название статьи
    protected $text; // Текст статьи
    protected $author_id; // ID автора статьи

    // Получаем название статьи
    public function getName(): string 
    {
        return $this->name;
    }

    // Получаем текст статьи
    public function getText(): string 
    {
        return $this->text;
    }

    // Получаем ID автора статьи
    public function getAuthorId(): int 
    {
        return $this->author_id;
    }
    
    // Получаем объект автора статьи по ID
    public function getAuthor(): ?User 
    {
        if (!$this->author_id) {
            return null; // Если нет ID автора, возвращаем null
        }
        return User::getById($this->author_id); // Загружаем объект User через метод User::getById()
    }
    
    // Устанавливаем название статьи
    public function setName(string $name): void 
    {
        $this->name = $name;
    }

    // Устанавливаем текст статьи
    public function setText(string $text): void 
    {
        $this->text = $text;
    }

    // Устанавливаем ID автора статьи
    public function setAuthorId(int $authorId): void 
    {
        $this->author_id = $authorId;
    }

    // Возвращаем название таблицы для модели (используется в ActiveRecord)
    public static function getTableName(): string 
    {
        return 'articles'; // Указываем, что эта модель работает с таблицей 'articles'
    }
}
