<?php

class Lesson
{
    private $title;
    private $text;
    private $homework;

    public function __construct(string $title, string $text, string $homework)
    {
        $this->title = $title;
        $this->text = $text;
        $this->homework = $homework;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function getHomework(): string
    {
        return $this->homework;
    }
}

class PaidLesson extends Lesson
{
    private $price;

    public function __construct(string $title, string $text, string $homework, float $price)
    {
        parent::__construct($title, $text, $homework);
        $this->price = $price;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): void
    {
        $this->price = $price;
    }
}

$paidLesson = new PaidLesson(
    "Урок о наследовании в PHP",
    "Лол, кек, чебурек",
    "Ложитесь спать, утро вечера мудренее",
    99.90
);

var_dump($paidLesson);

?>