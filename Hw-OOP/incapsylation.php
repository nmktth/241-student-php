<?php

class Cat
{
    private $name;
    private $color;

    public function __construct(string $name, string $color)
    {
        $this->name = $name;
        $this->color = $color;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getColor(): string
    {
        return $this->color;
    }

    public function sayHello(): string
    {
        return "Меня зовут " . $this->getName() . ". Я " . $this->getColor() . " цвета.";
    }
}

$cat = new Cat("Мурка", "рыжего");

echo $cat->sayHello();

?>