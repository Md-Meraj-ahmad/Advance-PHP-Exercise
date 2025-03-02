<?php
    class Car {
        public $make;
        public $model;
        public $year;
    
        public function displayDetails() {
            echo "Car: $this->make $this->model, Year: $this->year";
        }
    }
    
    $car = new Car();
    $car->make = "Toyota";
    $car->model = "Corolla";
    $car->year = 2020;
    $car->displayDetails();  // Output: Car: Toyota Corolla, Year: 2020
    
?>