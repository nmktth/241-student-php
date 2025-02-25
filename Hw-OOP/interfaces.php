<?php

interface CalculateSquare
{
    public function calculateSquare(): float;
}

class Circle implements CalculateSquare
{
    private $radius;

    public function __construct(float $radius)
    {
        $this->radius = $radius;
    }

    public function calculateSquare(): float
    {
        return pi() * pow($this->radius, 2);
    }
}

class Rectangle
{
    private $width;
    private $height;

    public function __construct(float $width, float $height)
    {
        $this->width = $width;
        $this->height = $height;
    }
}

function printSquare($object)
{
    if ($object instanceof CalculateSquare) {
        echo "Объект класса " . get_class($object) . " имеет площадь: " . $object->calculateSquare() . ".\n";
    } else {
        echo "Объект класса " . get_class($object) . " не реализует интерфейс CalculateSquare.\n";
    }
}

$circle = new Circle(5);
$rectangle = new Rectangle(4, 6);


printSquare($circle);
printSquare($rectangle); #Не реализует
?>