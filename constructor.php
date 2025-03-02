<?php
    class Car {
        public $make;
        public $model;
    
        public function __construct($make, $model) {
            $this->make = $make;
            $this->model = $model;
        }
    
        public function displayDetails() {
            echo "Car: $this->make $this->model";
        }
    }
    
    $car = new Car("Toyota", "Corolla");
    $car->displayDetails();  // Output: Car: Toyota Corolla
    
?>