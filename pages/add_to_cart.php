<?php
include('db.php');

session_start();
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    // Get user ID
    $stmt = $conn->prepare("SELECT accounts_id FROM accounts WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $user_id = $row['accounts_id'];

        // Get product details from POST request
        $product_name = $_POST['product_name'];
        $product_price = $_POST['product_price'];

        // Prepare SQL statement to insert into cart
        $stmt = $conn->prepare("INSERT INTO cart (user_id, product_name, product_price) VALUES (?, ?, ?)");
        $stmt->bind_param("isd", $user_id, $product_name, $product_price);

        if ($stmt->execute()) {
            echo "Item added to cart successfully!";
        } else {
            echo "Error adding item to cart.";
        }

        $stmt->close();
    } else {
        echo "User not found.";
    }
} else {
    echo "User session not found.";
}

$conn->close();
?>
