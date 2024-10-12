<?php
include('db.php');

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

// Get the patient's ID from the query string
$id = intval($_GET['id']);

// Fetch the patient's current details from the database
$sql = "SELECT * FROM patients WHERE patients_id = $id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $original_date_added = $row['date_added']; // Store the original date_added
} else {
    echo "No record found.";
    exit;
}

// Update the patient's details if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $last_name = $_POST['last_name'];
    $first_name = $_POST['first_name'];
    $middle_name = $_POST['middle_name'];
    $gender = $_POST['gender'];
    $date_of_birth = $_POST['date_of_birth'];
    $contact_no = $_POST['contact_no'];
    $address = $_POST['address'];
    $medication_history = $_POST['medication_history'];

    // Validate date of birth to be at least 6 months ago
    $current_date = new DateTime();
    $max_date = $current_date->modify('-6 months')->format('Y-m-d');

    if ($date_of_birth > $max_date) {
        $error_message = "Date of birth must be at least 6 months before today.";
    } else {
        // Corrected SQL UPDATE query excluding date_added
        $update_sql = "UPDATE patients SET 
                        last_name = '$last_name', 
                        first_name = '$first_name', 
                        middle_name = '$middle_name', 
                        gender = '$gender', 
                        date_of_birth = '$date_of_birth', 
                        contact_no = '$contact_no',
                        address = '$address',
                        medication_history = '$medication_history',
                        date_added = '$original_date_added'  -- Ensure the original date_added is preserved
                       WHERE patients_id = $id";

        if ($conn->query($update_sql) === TRUE) {
            // Set a session variable for notification
            $_SESSION['notification'] = 'Record updated successfully';
            header("Location: secretary_view.php?id=$id");
            exit;
        } else {
            echo "Error updating record: " . $conn->error;
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Patient</title>
    <link rel="stylesheet" href="css/secretary_edit.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">  
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <main class="w-full md:w-[calc(100%-256px)] md:ml-64 bg-gray-50 min-h-screen transition-all main">
        <div class="py-2 px-6 bg-white flex items-center shadow-md sticky top-0 z-30">
            <button type="button" class="text-lg text-gray-600 sidebar-toggle">
                <i class="ri-menu-line"></i>
            </button>
            <ul class="flex items-center text-sm ml-4">
                <li class="mr-2">
                <a href="secretary_table.php" class="text-gray-400 hover:text-gray-600 font-medium">Patients Table</a>
                </li>
                <li class="text-gray-600 mr-2 font-medium">/</li>
                <li class="text-black-600 mr-2 font-medium">Edit Patient</li>
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

        <div class="container mx-auto p-8 bg-white rounded-lg shadow-md mt-6">
            <h2 class="text-2xl font-bold mb-6">Edit Patient Details</h2>
            <?php if (isset($error_message)): ?>
                <div class="mb-4 p-2 bg-red-100 text-red-700 border border-red-300 rounded">
                    <?php echo $error_message; ?>
                </div>
            <?php endif; ?>
            <form method="POST" action="">
                <div class="mb-4">
                    <label for="last_name" class="block text-sm font-medium text-gray-700"><i class="fa fa-user"></i> Last Name:</label>
                    <input type="text" id="last_name" name="last_name" value="<?php echo htmlspecialchars($row['last_name']); ?>" required class="mt-1 p-2 border border-gray-300 rounded-md w-full">
                </div>
                <div class="mb-4">
                    <label for="first_name" class="block text-sm font-medium text-gray-700"><i class="fa fa-user"></i> First Name:</label>
                    <input type="text" id="first_name" name="first_name" value="<?php echo htmlspecialchars($row['first_name']); ?>" required class="mt-1 p-2 border border-gray-300 rounded-md w-full">
                </div>
                <div class="mb-4">
                    <label for="middle_name" class="block text-sm font-medium text-gray-700"><i class="fa fa-user"></i> Middle Name:</label>
                    <input type="text" id="middle_name" name="middle_name" value="<?php echo htmlspecialchars($row['middle_name']); ?>" class="mt-1 p-2 border border-gray-300 rounded-md w-full">
                </div>
                <div class="mb-4">
                    <label for="gender" class="block text-sm font-medium text-gray-700"><i class="fa fa-venus-mars"></i> Gender:</label>
                    <select id="gender" name="gender" required class="mt-1 p-2 border border-gray-300 rounded-md w-full">
                        <option value="Male" <?php echo ($row['gender'] == 'Male') ? 'selected' : ''; ?>>Male</option>
                        <option value="Female" <?php echo ($row['gender'] == 'Female') ? 'selected' : ''; ?>>Female</option>
                    </select>
                </div>
                <?php
                // Calculate the maximum date (6 months ago)
                $current_date = new DateTime();
                $max_date = $current_date->modify('-6 months')->format('Y-m-d');
                ?>
                <div class="mb-4">
                    <label for="date_of_birth" class="block text-sm font-medium text-gray-700"><i class="fa fa-calendar"></i> Date of Birth:</label>
                    <input type="date" id="date_of_birth" name="date_of_birth" 
                        value="<?php echo htmlspecialchars($row['date_of_birth']); ?>" 
                        readonly class="mt-1 p-2 border border-gray-300 rounded-md w-full" 
                        max="<?php echo $max_date; ?>"> <!-- Set max attribute here -->
                </div>
                <div class="mb-4">
                    <label for="contact_no" class="block text-sm font-medium text-gray-700"><i class="fa fa-phone"></i> Contact Number:</label>
                    <input type="text" id="contact_no" name="contact_no" value="<?php echo htmlspecialchars($row['contact_no']); ?>" 
                        pattern="\d{11}" maxlength="11" required title="Contact number must be exactly 11 digits" class="mt-1 p-2 border border-gray-300 rounded-md w-full">
                </div>
                <div class="mb-4">
            <label for="address" class="block text-sm font-medium text-gray-700"><i class="fa fa-home"></i> Address:</label>
            <input type="text" id="address" name="address" value="<?php echo htmlspecialchars($row['address']); ?>" required class="mt-1 p-2 border border-gray-300 rounded-md w-full">
        </div>
                <div class="mb-4">
                    <label for="medication_history" class="block text-sm font-medium text-gray-700"><i class="fa fa-notes-medical"></i> Medication History:</label>
                    <textarea id="medication_history" name="medication_history" rows="3" class="mt-1 p-2 border border-gray-300 rounded-md w-full"><?php echo htmlspecialchars($row['medication_history']); ?></textarea>
                </div>
                <button type="submit" class="bg-blue-500 text-white font-semibold py-2 px-4 rounded">Update Patient</button>
            </form>
        </div>
        <?php include('secretary_homepage.php'); ?>
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="../dist/js/script.js"></script>
    </main>
</body>
</html>
 