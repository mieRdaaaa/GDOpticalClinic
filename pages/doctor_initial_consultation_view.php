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
        $allergies = $row['allergies'] === 'Yes' ? htmlspecialchars($row['allergy_specify']) : 'No';
        $eye_conditions = $row['eye_conditions'] === 'Yes' ? htmlspecialchars($row['eye_conditions_specify']) : 'No';
        $additional_notes = htmlspecialchars($row['additional_notes']);
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
    <title>Patient Medical History</title>
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
                    <a href="doctor_table.php" class="text-gray-400 hover:text-gray-600 font-medium">Patients List</a>
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

        <!-- Patient Details Section -->
        <div class="px-6 py-4">
            <div class="flex items-center mb-6">
                <h2 class="text-4xl font-semibold">Patient Medical History</h2> 
                <a href="doctor_patient_medical_edit.php?id=<?php echo htmlspecialchars($row['patients_id']); ?>" class="ml-4 bg-green-500 text-white py-2 px-4 rounded hover:bg-blue-600 text-lg inline-block">
                    <i class="fa fa-edit"></i> Edit
                </a>
                <a href="doctor_view.php?id=<?php echo htmlspecialchars($row['patients_id']); ?>" class="ml-4 action-btn back-btn bg-gray-500 text-white py-2 px-4 rounded hover:bg-gray-600 text-lg">
                    <i class="fa fa-undo"></i> Back to List
                </a>
            </div>
            
            <div class="details-table bg-white p-4 rounded-md shadow-md">
                <div class="detail-row mb-4 border-b border-gray-300 pb-2">
                    <span class="detail-title font-bold text-xl">Known Allergies:</span> 
                    <div class="detail-value text-xl"><?php echo $allergies; ?></div> 
                </div>
                <div class="detail-row mb-4 border-b border-gray-300 pb-2">
                    <span class="detail-title font-bold text-xl">Previous Eye Conditions or Surgeries:</span> 
                    <div class="detail-value text-xl"><?php echo $eye_conditions; ?></div> 
                </div>
                <div class="detail-row mb-4">
                    <span class="detail-title font-bold text-xl">Additional Notes:</span> 
                    <div class="detail-value text-xl"><?php echo $additional_notes; ?></div> 
                </div>
            </div>
        </div>

    </main>
    <?php include('doctor_homepage.php'); ?>
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="../dist/js/script.js"></script>
</body>
</html>
