<?php
/*
WebServices, API, Extensions
LAB EXERCISE
Note that these code snippets aim to guide you through implementing each functionality but may require additional setup (like API keys or service configurations) to work fully.
*/
    // 1. Payment Gateway Integration (Using Stripe)
    // Stripe PHP SDK
    require_once('vendor/autoload.php');
    
    // Set your Stripe secret key
    \Stripe\Stripe::setApiKey('sk_test_your_secret_key');
    
    // Payment form processing
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        try {
            $token = $_POST['stripeToken'];
            $charge = \Stripe\Charge::create([
                'amount' => 5000, // Amount in cents
                'currency' => 'usd',
                'description' => 'Sample Product',
                'source' => $token,
            ]);
            echo 'Payment successful!';
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    
    // 2. Create API with Header (PHP)
    // Simple API that accepts custom headers
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        $customHeader = $_SERVER['HTTP_X_CUSTOM_HEADER'] ?? 'Header not set';
        header('Content-Type: application/json');
        echo json_encode(['custom_header' => $customHeader]);
    }
    // To send the header from client:
    fetch('https://your-api.com/endpoint', {
        method: 'GET',
        headers: {
            'X-Custom-Header': 'CustomHeaderValue'
        }
    })
    .then(response => response.json())
    .then(data => console.log(data));
    
    
    // 3. API with Image Uploading (PHP)
    // Handle image upload securely
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['image'])) {
        $file = $_FILES['image'];
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
    
        if (in_array($file['type'], $allowedTypes) && $file['size'] <= 2000000) { // 2MB
            $uploadDir = 'uploads/';
            $filePath = $uploadDir . basename($file['name']);
            if (move_uploaded_file($file['tmp_name'], $filePath)) {
                echo 'File uploaded successfully!';
            } else {
                echo 'File upload failed!';
            }
        } else {
            echo 'Invalid file type or size.';
        }
    }
    HTML Form:
    <form action="" method="POST" enctype="multipart/form-data">
        <input type="file" name="image">
        <input type="submit" value="Upload">
    </form>
    
    // 4. SOAP and REST APIs (Simple REST API)
    // REST API (PHP):
    // Example of a simple REST API (Product catalog)
    $method = $_SERVER['REQUEST_METHOD'];
    $product = ['id' => 1, 'name' => 'Product 1', 'price' => 100];
    
    if ($method == 'GET') {
        header('Content-Type: application/json');
        echo json_encode($product);
    }
    
    // Questions:
    // 5. Product Catalog (Database Integration)
    // Simple Product Catalog with MySQL
    $pdo = new PDO('mysql:host=localhost;dbname=shop', 'username', 'password');
    
    $query = 'SELECT * FROM products';
    $stmt = $pdo->query($query);
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($products as $product) {
        echo "<div>{$product['name']} - {$product['price']}</div>";
    }
    
    // 6. Shopping Cart (PHP Session)
    // Start session to store cart
    session_start();
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $productId = $_POST['product_id'];
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
    
        $_SESSION['cart'][] = $productId;
        echo "Product added to cart!";
    }
    
    if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_SESSION['cart'])) {
        echo 'Cart contains: ' . implode(', ', $_SESSION['cart']);
    }
    
    // 7. Web Services (Simple RESTful Service)
    // Simple Web Service that returns product data
    $method = $_SERVER['REQUEST_METHOD'];
    if ($method == 'GET') {
        $product = ['id' => 1, 'name' => 'Sample Product', 'price' => 20.00];
        header('Content-Type: application/json');
        echo json_encode($product);
    }
    
    // 8. Create Web Services for MVC Project (Extending an MVC Project)
    // In an existing MVC project, you might add the following:
    // In ProductController.php
    public function getProductData($id) {
        $product = $this->model->getProductById($id);
        echo json_encode($product);
    }
    
    // In model
    public function getProductById($id) {
        $stmt = $this->db->prepare("SELECT * FROM products WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
    
    // 9. Integration of API in Project (Using OpenWeatherMap API)
    // Example to get weather from OpenWeatherMap API
    $apiKey = 'your_api_key';
    $city = 'London';
    $response = file_get_contents("https://api.openweathermap.org/data/2.5/weather?q=$city&appid=$apiKey");
    $data = json_decode($response, true);
    
    echo 'Weather in ' . $city . ': ' . $data['weather'][0]['description'];
    
    // 10. Implement RESTful Principles (PHP)
    // Example of a RESTful API for products (GET, POST, DELETE)
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        $productId = $_GET['id'];
        if ($productId) {
            // Fetch single product by ID
            $product = getProductById($productId); // Assume function is defined
            echo json_encode($product);
        } else {
            // Fetch all products
            echo json_encode(getAllProducts()); // Assume function is defined
        }
    }
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $data = json_decode(file_get_contents('php://input'), true);
        addProduct($data); // Assume function is defined
        echo 'Product added successfully!';
    }
    
    // 11. OpenWeatherMap API (Weather Dashboard)
    // Example to display weather data
    $apiKey = 'your_api_key';
    $city = 'London';
    $response = file_get_contents("https://api.openweathermap.org/data/2.5/weather?q=$city&appid=$apiKey");
    $data = json_decode($response, true);
    
    echo '<h1>Weather in ' . $city . '</h1>';
    echo 'Temperature: ' . $data['main']['temp'] . '°C';
    echo 'Condition: ' . $data['weather'][0]['description'];
    
    // 12. Google Maps Geocoding API (Location Application)
    // Example to get coordinates using Google Maps Geocoding API
    $address = '1600+Amphitheatre+Parkway,+Mountain+View,+CA';
    $apiKey = 'your_api_key';
    $response = file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?address=$address&key=$apiKey");
    $data = json_decode($response, true);
    
    $latitude = $data['results'][0]['geometry']['location']['lat'];
    $longitude = $data['results'][0]['geometry']['location']['lng'];
    
    echo "Coordinates: $latitude, $longitude";
    
?>