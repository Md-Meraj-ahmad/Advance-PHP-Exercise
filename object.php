<?php 
    $car1 = new Car();
    $car1->make = "Honda";
    $car1->model = "Civic";
    $car1->year = 2021;
    
    $car2 = new Car();
    $car2->make = "Ford";
    $car2->model = "Focus";
    $car2->year = 2022;
    
    $car1->displayDetails();  // Output: Car: Honda Civic, Year: 2021
    $car2->displayDetails();  // Output: Car: Ford Focus, Year: 2022
    
?>