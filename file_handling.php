<?php
    $file = fopen("example.txt", "r");
    while (($line = fgets($file)) !== false) {
        echo $line;
    }
    fclose($file);    
?>