<?php
include('db.php'); // Make sure to include your database connection

// User info
$user_fullname = '';
$user_role = '';

// Check if the user is logged in
session_start(); // Make sure to start the session
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

// Fetching patient details
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "SELECT * FROM patients WHERE patients_id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        // Medical history variables
        $allergies = $row['allergies'] === 'Yes' ? 'Yes (Specify: ' . htmlspecialchars($row['allergy_specify']) . ')' : 'No';
        $eye_conditions = $row['eye_conditions'] === 'Yes' ? 'Yes (Specify: ' . htmlspecialchars($row['eye_conditions_specify']) . ')' : 'No';
        $additional_notes = htmlspecialchars($row['additional_notes']);
        
        // Define $allergy_specify variable
        $allergy_specify = $row['allergy_specify'] ?? ''; // Fallback to empty string if not set
        
        // Define $eye_conditions_specify variable
        $eye_conditions_specify = $row['eye_conditions_specify'] ?? ''; // Fallback to empty string if not set
    } else {
        echo "Record not found";
        exit;
    }
} else {
    echo "Invalid request";
    exit;
}


$conn->close(); // Close the database connection
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Patient Medical History</title>
    <link rel="shortcut icon" href="../images/ico.png" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://unpkg.com/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
    <!-- Start: Main -->
    <main class="w-full md:w-[calc(100%-256px)] md:ml-64 bg-gray-50 min-h-screen transition-all">
        <div class="py-2 px-6 bg-white flex items-center shadow-md sticky top-0 z-30">
            <button type="button" class="text-lg text-gray-600 sidebar-toggle">
                <i class="ri-menu-line"></i>
            </button>
            <ul class="flex items-center text-sm ml-4">
                <li class="mr-2">
                    <a href="secretary_table.php" class="text-gray-400 hover:text-gray-600 font-medium">Patients Table</a>
                </li>
                <li class="text-gray-600 mr-2 font-medium">/</li>
                <li class="text-black-600 mr-2 font-medium">View Patient Details</li>
            </ul>
            <div class="ml-auto flex items-center">
                <div class="dropdown ml-3">
                    <button type="button" class="dropdown-toggle flex items-center">
                        <img src="../images/profile.png" alt="Profile Image" class="w-8 h-8 rounded-full block object-cover">
                    </button>
                    <ul class="dropdown-menu shadow-md z-30 hidden py-1.5 rounded-md bg-white border border-gray-100">
                        <li>
                            <a href="../index.php" class="flex items-center text-[13px] py-1.5 px-4 text-gray-600 hover:text-blue-500 hover:bg-black-50">Logout</a>
                        </li>
                    </ul>
                </div>
                <div class="user-details ml-3">
                    <span class="name text-sm font-semibold text-gray-900 block"><?php echo htmlspecialchars($user_fullname); ?></span>
                    <span class="role text-xs text-gray-500"><?php echo ucfirst(htmlspecialchars($user_role)); ?></span>
                </div>
            </div>
        </div>

        <!-- Medical History Section -->
        <div class="px-6 py-4">
        <h3 class="text-2xl font-semibold mb-4 flex justify-between items-center">
    Edit Medical History for ID: <?php echo htmlspecialchars($row['patients_id']); ?>
</h3>
            <form action="secretary_update_patient_medical_history.php?id=<?php echo htmlspecialchars($id); ?>" method="POST">
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1">Do you have any known allergies?</label>
                    <div class="flex items-center mb-2">
                        <input type="radio" id="allergies_yes" name="allergies" value="Yes" class="mr-2" <?php echo ($allergies === 'Yes') ? 'checked' : ''; ?> required>
                        <label for="allergies_yes" class="text-sm">Yes (Please specify):</label>
                        <input type="text" id="allergy_specify" name="allergy_specify" class="border border-gray-300 rounded-md py-2 px-4 ml-2" placeholder="Specify allergies" value="<?php echo htmlspecialchars($allergy_specify); ?>">
                    </div>
                    <div class="flex items-center">
                        <input type="radio" id="allergies_no" name="allergies" value="No" class="mr-2" <?php echo ($allergies === 'No') ? 'checked' : ''; ?>>
                        <label for="allergies_no" class="text-sm">No</label>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1">Have you had any previous eye conditions or surgeries?</label>
                    <div class="flex items-center mb-2">
                        <input type="radio" id="eye_conditions_yes" name="eye_conditions" value="Yes" class="mr-2" <?php echo ($eye_conditions === 'Yes') ? 'checked' : ''; ?> required>
                        <label for="eye_conditions_yes" class="text-sm">Yes (Please specify):</label>
                        <input type="text" id="eye_conditions_specify" name="eye_conditions_specify" class="border border-gray-300 rounded-md py-2 px-4 ml-2" placeholder="Specify conditions" value="<?php echo htmlspecialchars($eye_conditions_specify); ?>">
                    </div>
                    <div class="flex items-center">
                        <input type="radio" id="eye_conditions_no" name="eye_conditions" value="No" class="mr-2" <?php echo ($eye_conditions === 'No') ? 'checked' : ''; ?>>
                        <label for="eye_conditions_no" class="text-sm">No</label>
                    </div>
                </div>

                <div class="mb-4">
                    <label for="additional_notes" class="block text-sm font-medium mb-1">Additional Notes:</label>
                    <textarea id="additional_notes" name="additional_notes" class="border border-gray-300 rounded-md py-2 px-4 w-full" placeholder="Enter any additional notes"><?php echo htmlspecialchars($additional_notes); ?></textarea>
                </div>

                <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 focus:outline-none transition-none">Update Medical History</button>

            </form>
        </div>
    </main>
    <?php include('secretary_homepage.php'); ?>
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="../dist/js/script.js"></script>
</body>
</html>
