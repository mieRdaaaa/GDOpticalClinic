<?php
header('Content-Type: text/html; charset=utf-8');

include('db.php');
require('../fpdf/fpdf.php');

session_start(); // Start the session
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Get the month from the URL parameters
$selected_month = isset($_GET['month']) ? $_GET['month'] : date('Y-m');

// Debugging output for received month
error_log("Received Month for Certificate: " . htmlspecialchars($selected_month));

$pdf = new FPDF('P', 'mm', 'Letter');

// Add a page
$pdf->AddPage();

// Add title
$pdf->SetFont('Arial', 'B', 20);
$pdf->Cell(71, 10, '', 0, 0);
$pdf->Cell(69, 5, 'Invoice', 0, 0);
$pdf->Cell(59, 10, '', 0, 1);

// Clinic details
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(71, 5, 'GD Optical Clinic', 0, 0);
$pdf->Cell(59, 5, '', 0, 0);
$pdf->Cell(59, 5, 'Details', 0, 1);

// Date and city information
$pdf->SetFont('Arial', '', 13);
$pdf->Cell(130, 5, 'J.P. Laurel Street', 0, 0);
$pdf->Cell(14, 5, 'Date: ', 0, 0);
$pdf->Cell(34, 5, date('F j, Y'), 0, 1); // Current date
$pdf->Cell(130, 5, 'Surallah, South Cotabato, 9512', 0, 1);

// Add Month of: line
$pdf->SetFont('Arial', 'B', '20');
$pdf->SetXY(68, 41);
$pdf->Cell(71, 5, 'Month of ' . date('F', strtotime($selected_month)), 0, 1); // Month name from selected_month

// Fetch services data for the report
$query = "SELECT product_name, price FROM services WHERE DATE_FORMAT(date_added, '%Y-%m') = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $selected_month);
$stmt->execute();
$result = $stmt->get_result();

// Prepare an array to store products with varying prices
$products = [];

// Collect product names, prices, and quantities
while ($row = $result->fetch_assoc()) {
    $product_name = htmlspecialchars($row['product_name']);
    $price = $row['price'];

    // Get the quantity from POST data
    $quantity = isset($_POST['quantity'][$product_name]) ? (int)$_POST['quantity'][$product_name] : 1; // Default to 1 if not set

    // Initialize product entry if not set
    if (!isset($products[$product_name])) {
        $products[$product_name] = [];
    }

    // Store quantities for each unique price
    if (!isset($products[$product_name][$price])) {
        $products[$product_name][$price] = 0; // Initialize quantity for this price
    }
    $products[$product_name][$price] += $quantity; // Increment the quantity for this price
}

// Table header
$pdf->Cell(0, 10, '', 0, 1); // Add a line break
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(80, 10, 'Product Name', 1);
$pdf->Cell(40, 10, 'Quantity', 1);
$pdf->Cell(40, 10, 'Price', 1);
$pdf->Cell(40, 10, 'Total Price', 1);
$pdf->Cell(0, 10, '', 0, 1); // Add a line break

// Table data
$pdf->SetFont('Arial', '', 12);
$total_income = 0; // To calculate total income

foreach ($products as $product_name => $prices) {
    foreach ($prices as $price => $quantity) {
        $total_price = $quantity * $price; // Calculate total price for this product at this price

        // Add a row for this product with the specific price
        $pdf->Cell(80, 10, $product_name, 1);
        $pdf->Cell(40, 10, $quantity, 1);
        $pdf->Cell(40, 10, '' . number_format($price, 2), 1);
        $pdf->Cell(40, 10, '' . number_format($total_price, 2), 1); // Using peso symbol directly
        $pdf->Cell(0, 10, '', 0, 1); // Add a line break

        $total_income += $total_price; // Accumulate total income
    }
}

// Total income
$pdf->Cell(80, 10, 'Total Income:', 1);
$pdf->Cell(40, 10, '', 1); // Empty cell for quantity
$pdf->Cell(40, 10, '', 1); // Empty cell for price
$pdf->Cell(40, 10, 'PHP ' . number_format($total_income, 2), 1);
$pdf->Output();
?>


