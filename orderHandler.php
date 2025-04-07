<?php
// DB configuration
$host = "localhost";
$user = "root";
$password = "";
$database = "love_you_tummy";

// Connect to DB
$conn = new mysqli($host, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get POST data from order form
$customer_name = $_POST['name'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$food_item = $_POST['food_item'];
$quantity = $_POST['quantity'];

// Input validation (basic)
if (empty($customer_name) || empty($phone) || empty($address) || empty($food_item) || empty($quantity)) {
    echo "All fields are required!";
    exit;
}

// Prepare SQL query
$stmt = $conn->prepare("INSERT INTO orders (customer_name, phone, address, food_item, quantity) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("ssssi", $customer_name, $phone, $address, $food_item, $quantity);

// Execute and confirm
if ($stmt->execute()) {
    echo "<h2>Order Placed Successfully!</h2>";
    echo "<p>Thank you, $customer_name! Your $food_item will be delivered soon. 🍽️</p>";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
