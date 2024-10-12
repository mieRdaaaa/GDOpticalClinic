<?php
include('db.php');

session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Check if the certificate ID is provided
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['certificate_id'])) {
    $certificate_id = intval($_POST['certificate_id']);

    // Prepare SQL statement to delete the certificate
    $stmt = $conn->prepare("DELETE FROM certificate WHERE certificate_id = ?");
    $stmt->bind_param("i", $certificate_id);

    if ($stmt->execute()) {
        // Successfully deleted
        header("Location: secretary_certificate.php?patient_id=" . intval($_POST['patient_id']) . "&deleted=true");
        exit();
    } else {
        // Error deleting
        echo "Error deleting certificate: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Invalid request.";
}

$conn->close();
?>
