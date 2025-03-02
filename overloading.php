<?php
    class Calculator {
        public function __call($name, $arguments) {
            if ($name == 'add') {
                return array_sum($arguments);
            }
        }
    }
    
    $calc = new Calculator();
    echo $calc->add(2, 3);  // Output: 5
    echo $calc->add(1, 2, 3, 4);  // Output: 10
    
?>