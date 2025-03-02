<?php
    class Person {
        private $name;
        private $age;
    
        public function setName($name) {
            $this->name = $name;
        }
    
        public function setAge($age) {
            $this->age = $age;
        }
    
        public function getName() {
            return $this->name;
        }
    
        public function getAge() {
            return $this->age;
        }
    }
    
    $person = new Person();
    $person->setName("John");
    $person->setAge(30);
    echo $person->getName() . " is " . $person->getAge() . " years old.";
    
?>