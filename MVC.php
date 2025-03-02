<?php
/*
    1.	Implementing a Basic CRUD Application with MVC Architecture:
        o	Model: Handles data-related logic (e.g., interacting with the database).
        o	View: Displays data to the user.
        o	Controller: Processes user input and updates the model and view accordingly.
    Example:
        o	Model: UserModel.php
        o	View: userView.php
        o	Controller: UserController.php
*/


class Product {
    private $name;
    private $price;

    public function __construct($name, $price) {
        $this->name = $name;
        $this->price = $price;
    }

    public function getDetails() {
        return "Product: " . $this->name . ", Price: $" . $this->price;
    }
}

class Category {
    private $name;

    public function __construct($name) {
        $this->name = $name;
    }

    public function getCategory() {
        return $this->name;
    }
}

class Order {
    private $products = [];
    private $totalPrice = 0;

    public function addProduct(Product $product) {
        $this->products[] = $product;
        $this->totalPrice += $product->getPrice();
    }

    public function getOrderDetails() {
        return "Order Total: $" . $this->totalPrice;
    }
}
________________________________________
// 2. Class for Book with Discount
class Book {
    private $title;
    private $author;
    private $price;

    public function __construct($title, $author, $price) {
        $this->title = $title;
        $this->author = $author;
        $this->price = $price;
    }

    public function applyDiscount($percentage) {
        $this->price -= ($this->price * $percentage / 100);
        return $this->price;
    }

    public function getDetails() {
        return "Book: $this->title by $this->author, Price: $" . $this->price;
    }
}


// Implementation of all the OOPs Concepts
/*
Develop a Project That Simulates a Library System with Classes for User, Book, and Transaction, Applying All OOP Principles
*/

// User Class:
class User {
    private $userId;
    private $name;

    public function __construct($userId, $name) {
        $this->userId = $userId;
        $this->name = $name;
    }

    public function getName() {
        return $this->name;
    }
}

// Book Class:
class Book {
    private $bookId;
    private $title;
    private $author;

    public function __construct($bookId, $title, $author) {
        $this->bookId = $bookId;
        $this->title = $title;
        $this->author = $author;
    }

    public function getBookDetails() {
        return "Title: $this->title, Author: $this->author";
    }
}

// Transaction Class:
class Transaction {
    private $user;
    private $book;
    private $transactionDate;

    public function __construct(User $user, Book $book) {
        $this->user = $user;
        $this->book = $book;
        $this->transactionDate = date("Y-m-d");
    }

    public function getTransactionDetails() {
        return "User: {$this->user->getName()}, Book: {$this->book->getBookDetails()}, Date: $this->transactionDate";
    }
}

// Example Usage:
$user = new User(1, 'John Doe');
$book = new Book(101, 'PHP for Beginners', 'Jane Smith');
$transaction = new Transaction($user, $book);

echo $transaction->getTransactionDetails();


?>