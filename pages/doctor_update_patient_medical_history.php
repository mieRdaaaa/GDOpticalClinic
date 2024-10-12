<?php
include('db.php'); // Include your database connection

// User info
$user_fullname = '';
$user_role = '';

// Check if the user is logged in
session_start();
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    // Prepare SQL statement to get user info
    $stmt = $conn->prepare("SELECT fullname, account_type FROM accounts WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $user_fullname = $row['fullname'];
        $user_role = $row['account_type'];
    }

    $stmt->close();
} else {
    header("Location: login.php");
    exit();
}

// Fetching patient details for the given ID
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "SELECT * FROM patients WHERE patients_id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $allergies = $row['allergies'];
        $allergy_specify = htmlspecialchars($row['allergy_specify']);
        $eye_conditions = $row['eye_conditions'];
        $eye_conditions_specify = htmlspecialchars($row['eye_conditions_specify']);
        $additional_notes = htmlspecialchars($row['additional_notes']);
    } else {
        echo "Record not found";
        exit;
    }
} else {
    echo "Invalid request";
    exit;
}

// Handling the form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $allergies = $_POST['allergies'];
    $allergy_specify = $_POST['allergy_specify'];
    $eye_conditions = $_POST['eye_conditions'];
    $eye_conditions_specify = $_POST['eye_conditions_specify'];
    $additional_notes = $_POST['additional_notes'];

    // Update the patient medical history
    $stmt = $conn->prepare("UPDATE patients SET allergies = ?, allergy_specify = ?, eye_conditions = ?, eye_conditions_specify = ?, additional_notes = ? WHERE patients_id = ?");
    $stmt->bind_param("sssssi", $allergies, $allergy_specify, $eye_conditions, $eye_conditions_specify, $additional_notes, $id);
    
    if ($stmt->execute()) {
        echo "<script>alert('Medical history updated successfully!'); window.location.href='doctor_initial_consultation_view.php?id=$id';</script>";
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $stmt->close();
}

$conn->close(); // Close the database connection
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Patient Medical History</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://unpkg.com/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
    <main class="w-full md:w-[calc(100%-256px)] md:ml-64 bg-gray-50 min-h-screen">
        <div class="py-6 px-6 bg-white shadow-md rounded-md">
            <h2 class="text-xl font-semibold mb-4">Update Medical History for ID: <?php echo htmlspecialchars($row['patients_id']); ?></h2>

            <form method="POST">
                <!-- Known Allergies Section -->
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1">Do you have any known allergies?</label>
                    <div class="flex items-center mb-2">
                        <input type="radio" id="allergies_yes" name="allergies" value="Yes" class="mr-2" <?php echo ($allergies === 'Yes') ? 'checked' : ''; ?> required>
                        <label for="allergies_yes" class="text-sm">Yes (Please specify):</label>
                        <input type="text" id="allergy_specify" name="allergy_specify" class="border border-gray-300 rounded-md py-2 px-4 ml-2" placeholder="Specify allergies" value="<?php echo $allergy_specify; ?>">
                    </div>
                    <div class="flex items-center">
                        <input type="radio" id="allergies_no" name="allergies" value="No" class="mr-2" <?php echo ($allergies === 'No') ? 'checked' : ''; ?>>
                        <label for="allergies_no" class="text-sm">No</label>
                    </div>
                </div>

                <!-- Previous Eye Conditions Section -->
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1">Have you had any previous eye conditions or surgeries?</label>
                    <div class="flex items-center mb-2">
                        <input type="radio" id="eye_conditions_yes" name="eye_conditions" value="Yes" class="mr-2" <?php echo ($eye_conditions === 'Yes') ? 'checked' : ''; ?> required>
                        <label for="eye_conditions_yes" class="text-sm">Yes (Please specify):</label>
                        <input type="text" id="eye_conditions_specify" name="eye_conditions_specify" class="border border-gray-300 rounded-md py-2 px-4 ml-2" placeholder="Specify conditions" value="<?php echo $eye_conditions_specify; ?>">
                    </div>
                    <div class="flex items-center">
                        <input type="radio" id="eye_conditions_no" name="eye_conditions" value="No" class="mr-2" <?php echo ($eye_conditions === 'No') ? 'checked' : ''; ?>>
                        <label for="eye_conditions_no" class="text-sm">No</label>
                    </div>
                </div>

                <!-- Additional Notes Section -->
                <div class="mb-4">
                    <label for="additional_notes" class="block text-sm font-medium mb-1">Additional Notes:</label>
                    <textarea id="additional_notes" name="additional_notes" class="border border-gray-300 rounded-md py-2 px-4 w-full" placeholder="Enter any additional notes"><?php echo $additional_notes; ?></textarea>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Update Medical History</button>
            </form>
        </div>
    </main>
</body>
</html>
