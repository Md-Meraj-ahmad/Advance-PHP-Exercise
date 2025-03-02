<?php
    class Person {
        public function __construct() {
            echo "Object created\n";
        }
    
        public function __destruct() {
            echo "Object destroyed\n";
        }
    }
    
    $person = new Person();
    unset($person);  // Output: Object created
                     // Output: Object destroyed
    
?>