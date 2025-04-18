<?php

namespace src\Models\Comments;

use src\Models\ActiveRecordEntity;
use src\Models\Users\User;
use src\Services\Db;
use DateTime;

class Comment extends ActiveRecordEntity
{
    protected $text; // Текст комментария
    protected $authorId; // ID автора комментария
    protected $articleId; // ID статьи, к которой относится комментарий
    protected $createdAt; // Дата и время создания комментария

    // Получаем текст комментария с экранированием специальных символов
    public function getText(): string
    {
        return htmlspecialchars($this->text);
    }

    // Получаем объект пользователя, оставившего комментарий, по ID
    public function getAuthor(): User
    {
        return User::getById($this->authorId); // Возвращаем объект User через метод getById()
    }

    // Получаем ID статьи, к которой привязан комментарий
    public function getArticleId(): int
    {
        return $this->articleId;
    }

    // Получаем дату и время создания комментария в нужном формате
    public function getCreatedAt(): string
    {
        $date = new DateTime($this->createdAt); // Создаём объект DateTime на основе значения createdAt
        return $date->format('d.m.Y H:i'); // Форматируем дату в 'дд.мм.гггг чч:мм'
    }

    // Устанавливаем текст комментария, обрезая пробелы в начале и конце
    public function setText(string $text): void
    {
        $this->text = trim($text); // Убираем лишние пробелы с концов строки
    }

    // Устанавливаем ID автора комментария
    public function setAuthorId(int $authorId): void
    {
        $this->authorId = $authorId;
    }

    // Устанавливаем ID статьи, к которой привязан комментарий
    public function setArticleId(int $articleId): void
    {
        $this->articleId = $articleId;
    }

    // Получаем все комментарии по ID статьи, отсортированные по дате создания
    public static function findAllByArticleId(int $articleId): array
    {
        return static::findByColumnOrdered('article_id', $articleId, 'created_at', 'DESC'); // Получаем комментарии по колонке article_id, отсортированные по created_at в убывающем порядке
    }    

    // Указываем таблицу, с которой работает модель (используется в ActiveRecord)
    protected static function getTableName(): string
    {
        return 'comments'; // Модель работает с таблицей 'comments'
    }
}
?>
