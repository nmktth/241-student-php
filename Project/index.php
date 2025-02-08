<?php
    class Cat{
        public $name;
        public $weight;
        public $color;

        function __construct(string $name,int $weight,string $color){
            $this ->name = $name;
            $this ->weight = $weight;
            $this ->color = $color;
        }

        function setName(string $name){
            $this->name = $name;
        }

        function getName(){
            return $this->name;
        }
    }

    $cat1 = new Cat('Maikl', 100, 'gray');
    $cat2 = new Cat('Morivan', 10, 'blue');

    echo $cat2->getName(),'<BR>';
    echo $cat1->getName(),'<BR>';

    var_dump($cat1);