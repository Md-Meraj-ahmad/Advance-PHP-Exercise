<?php
    interface VehicleInterface {
        public function start();
        public function stop();
    }
    
    class Car implements VehicleInterface {
        public function start() {
            echo "Car started";
        }
    
        public function stop() {
            echo "Car stopped";
        }
    }
    
    $car = new Car();
    $car->start();  // Output: Car started
    $car->stop();   // Output: Car stopped
    
?>