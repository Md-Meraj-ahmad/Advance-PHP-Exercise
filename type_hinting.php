<?php
    class Math {
        public function add(int $a, int $b): int {
            return $a + $b;
        }
    }
    
    $math = new Math();
    echo $math->add(2, 3);  // Output: 5
    
?>