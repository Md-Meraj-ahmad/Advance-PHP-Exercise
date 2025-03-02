<?php
    class MyClass {
        public static $count = 0;
    
        public static function incrementCount() {
            self::$count++;
        }
    }
    
    MyClass::incrementCount();
    echo MyClass::$count;  // Output: 1
    
?>