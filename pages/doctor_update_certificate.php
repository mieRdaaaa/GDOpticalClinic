<?php
include('db.php');
session_start(); // Start the session

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Get the certificate ID from the query string
$certificate_id = intval($_GET['id'] ?? 0);

// Validate the certificate ID
if ($certificate_id <= 0) {
    die("Invalid certificate ID.");
}

// Prepare an SQL statement to fetch existing certificate details
$certificate_sql = "SELECT * FROM certificate WHERE certificate_id = ?";
$stmt = $conn->prepare($certificate_sql);
$stmt->bind_param("i", $certificate_id);
$stmt->execute();
$certificate_result = $stmt->get_result();

if ($certificate_result->num_rows === 0) {
    die("Certificate not found.");
}

// Fetch the existing certificate details
$certificate = $certificate_result->fetch_assoc();

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the updated values from the form
    $symptoms = $_POST['symptoms'] ?? '';
    $examination = $_POST['examination'] ?? '';
    $recommendation = $_POST['recommendation'] ?? '';
    $osuva = $_POST['osuva'] ?? '';
    $oduva = $_POST['oduva'] ?? '';
    $osadd = $_POST['osadd'] ?? '';
    $odadd = $_POST['odadd'] ?? '';
    $odbcva = $_POST['odbcva'] ?? '';
    $osbcva = $_POST['osbcva'] ?? '';

    // Prepare an SQL statement to update the certificate details
    $update_sql = "UPDATE certificate SET symptoms = ?, examination = ?, recommendation = ?, osuva = ?, oduva = ?, osadd = ?, odadd = ?, odbcva = ?, osbcva = ? WHERE certificate_id = ?";
    $stmt = $conn->prepare($update_sql);
    $stmt->bind_param("sssssssssi", $symptoms, $examination, $recommendation, $osuva, $oduva, $osadd, $odadd, $odbcva, $osbcva, $certificate_id);
    
    if ($stmt->execute()) {
        // Redirect to the certificate view page after successful update
        header("Location: doctor_certificate_view.php?id=" . htmlspecialchars($certificate['patients_id']));
        exit();
    } else {
        echo "Error updating record: " . $stmt->error;
    }

    $stmt->close();
}

// Close the MySQLi connection
$conn->close();
?>
