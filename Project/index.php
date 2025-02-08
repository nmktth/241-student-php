<?php
    class Cat{
        public $name;
        public $weight;
        public $color;

        function setName(string $name){
            $this->name = $name;
        }
    }

    $cat1 = new Cat();
    $cat1->name = "Maikl";
    $cat1->weight = 100;
    $cat1->color = "gray";

    var_dump($cat1);