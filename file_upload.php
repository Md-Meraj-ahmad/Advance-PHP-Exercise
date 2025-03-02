<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['file'])) {
        $file = $_FILES['file'];
        $allowed_types = ['image/jpeg', 'image/png'];
        
        if (in_array($file['type'], $allowed_types)) {
            move_uploaded_file($file['tmp_name'], 'uploads/' . $file['name']);
            echo "File uploaded successfully!";
        } else {
            echo "Invalid file type!";
        }
    }    
?>