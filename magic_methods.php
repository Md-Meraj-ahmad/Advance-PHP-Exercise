<?php
    class Magic {
        private $data = [];
    
        public function __get($name) {
            return isset($this->data[$name]) ? $this->data[$name] : null;
        }
    
        public function __set($name, $value) {
            $this->data[$name] = $value;
        }
    }
    
    $obj = new Magic();
    $obj->name = "John";
    echo $obj->name;  // Output: John
    
?>