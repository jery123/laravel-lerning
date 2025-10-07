<?php


class Testing {

    public function __construct(
        public string $name = "John Doe",
        public string $job = "Tester",
    ){}
}


$testing1  = new Testing();
$testing1->name = "Jane Doe";
