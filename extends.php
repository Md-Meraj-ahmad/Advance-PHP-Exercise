<?php
    class Vehicle {
        public $make;
        public $model;
        
        public function displayDetails() {
            echo "Vehicle: $this->make $this->model";
        }
    }
    
    class Car extends Vehicle {
        public $year;
        
        public function displayCarDetails() {
            echo "Car: $this->make $this->model, Year: $this->year";
        }
    }
    
    $car = new Car();
    $car->make = "Toyota";
    $car->model = "Camry";
    $car->year = 2021;
    $car->displayCarDetails();  // Output: Car: Toyota Camry, Year: 2021
    
?>