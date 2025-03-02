<?php
    final class MyClass {
        public function sayHello() {
            echo "Hello";
        }
    }
    
    class NewClass extends MyClass {  // Error: Cannot extend final class
    }    
?>