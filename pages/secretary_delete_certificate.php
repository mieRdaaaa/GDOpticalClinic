<?php
include('db.php');

if (isset($_GET['id'])) {
    $certificate_id = intval($_GET['id']);
    
    // Prepare SQL statement to fetch the patient_id associated with the certificate
    $stmt = $conn->prepare("SELECT patients_id FROM certificate WHERE certificate_id = ?");
    $stmt->bind_param("i", $certificate_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the certificate exists
    if ($result->num_rows === 1) {
        $certificate = $result->fetch_assoc();
        $patient_id = $certificate['patients_id']; // Get the associated patient_id

        // Prepare SQL statement to delete the certificate
        $stmt->close(); // Close previous statement
        $stmt = $conn->prepare("DELETE FROM certificate WHERE certificate_id = ?");
        $stmt->bind_param("i", $certificate_id);
        
        if ($stmt->execute()) {
            // Redirect back to the certificate view page with a success message using the patient_id
            header("Location: secretary_certificate_view.php?id=$patient_id&message=Certificate deleted successfully.");
            exit();
        } else {
            echo "Error deleting certificate: " . $stmt->error;
        }
    } else {
        echo "Certificate not found.<br>";
    }
    
    $stmt->close();
}

$conn->close();
?>
