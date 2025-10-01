<?php


class Person{

    public function __construct(
        public string $name,
        public int $age,
    ){}

    public function introduce():string{
        return "Hi, i'm {$this->name} and i'm {$this->age} years old.";
    }
}

$person1 = new Person("Alice", 30);
$person2 = new Person("Jery", 22);

echo $person1->introduce();
echo "\n";
echo $person2->introduce();