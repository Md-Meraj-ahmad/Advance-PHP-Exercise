<?php
    class MyClass {
        public $publicVar = "I am public";
        protected $protectedVar = "I am protected";
        private $privateVar = "I am private";
        
        public function showVars() {
            echo $this->publicVar . "\n";
            echo $this->protectedVar . "\n";
            echo $this->privateVar . "\n";
        }
    }
    
    $obj = new MyClass();
    $obj->showVars();  // Output: I am public I am protected I am private
    
?>