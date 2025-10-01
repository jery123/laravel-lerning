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

class Employee extends Person{

    public function __construct(
        public string $name,
        public int $age,
        public string $position,
    ){}

    public function introduce(): string{
        return parent::introduce() . " - I work as a/an {$this->position}";
    }

}

$person1 = new Person("Alice", 30);
$person2 = new Person("Jery", 22);

echo $person1->introduce();
echo "\n";
echo $person2->introduce();
echo "\n";

$emp1 = new Employee("John", 24, "IOS developer");

echo $emp1->introduce();
echo "\n";

$people = [
    $emp1,
    $person1
];

function introduce(Person $person){
    echo $person->introduce() . "\n";
}

foreach($people as $pers){
    introduce($pers);
}