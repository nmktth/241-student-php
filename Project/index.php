<?php
    class Cat{
        public $name;
        public $weight;
        public $color;

        function __construct(){
            
        }

        function setName(string $name){
            $this->name = $name;
        }

        function getName(){
            return $this->name;
        }
    }

    $cat1 = new Cat();
    $cat2 = new Cat();
    $cat2->name = "Morivan";
    $cat1->name = "Maikl";
    $cat2->weight = 4;
    $cat1->weight = 100;
    $cat2->color = "blue";
    $cat1->color = "gray";

    echo $cat2->getName(),'<BR>';
    echo $cat1->getName(),'<BR>';

    var_dump($cat1);