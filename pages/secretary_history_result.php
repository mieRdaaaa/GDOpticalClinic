<?php
include('db.php');

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Fetch the patient record based on the ID
    $sql = "SELECT * FROM patients WHERE patients_id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $patient = $result->fetch_assoc();
    } else {
        echo "Record not found";
        exit;
    }

   // Fetch all eye results for the patient, including the diagnosis
$sql_eye_results = "SELECT * FROM eye_result WHERE patients_id = $id ORDER BY date_added DESC";
$eye_results_result = $conn->query($sql_eye_results);

if ($eye_results_result === false) {
    echo "Error fetching eye results";
    exit;
}

} else {
    echo "Invalid request";
    exit;
}

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

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Patient History</title>
    <link rel="shortcut icon" href="../images/ico.png" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
<main class="w-full md:w-[calc(100%-256px)] md:ml-64 bg-gray-50 min-h-screen transition-all">
    <div class="py-2 px-6 bg-white flex items-center shadow-md sticky top-0 z-30">
        <button type="button" class="text-lg text-gray-600 sidebar-toggle">
            <i class="ri-menu-line"></i>
        </button>
        <ul class="flex items-center text-sm ml-4">
            <li class="mr-2">
                <a href="secretary_history.php" class="text-gray-400 hover:text-gray-600 font-medium">History</a>
            </li>
            <li class="text-gray-600 mr-2 font-medium">/</li>
        <li class="text-gray-600 mr-2 font-medium">Results</li>
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
    <div class="container mx-auto px-4 py-8">
        <h2 class="text-2xl font-bold mb-4">Patient Details</h2>
        <table class="w-full border-collapse border border-blue-500 max-w-xl mt-4 mx-auto">
            <thead>
                <tr class="bg-blue-500 text-white">
                    <th class="py-2 px-4 text-left">ID</th>
                    <th class="py-2 px-4 text-left">Last Name</th>
                    <th class="py-2 px-4 text-left">First Name</th>
                    <th class="py-2 px-4 text-left">Middle Name</th>
                    <th class="py-2 px-4 text-left">Gender</th>
                    <th class="py-2 px-4 text-left">Date of Birth</th>
                    <th class="py-2 px-4 text-left">Contact Number</th>
                    <th class="py-2 px-4 text-left">Medication History</th>
                    <th class="py-2 px-4 text-left">Date Added</th>
                </tr>
            </thead>
            <tbody>
                <tr class="bg-white border-b border-blue-500">
                    <td class="py-2 px-4"><?php echo $patient['patients_id']; ?></td>
                    <td class="py-2 px-4"><?php echo $patient['last_name']; ?></td>
                    <td class="py-2 px-4"><?php echo $patient['first_name']; ?></td>
                    <td class="py-2 px-4"><?php echo $patient['middle_name']; ?></td>
                    <td class="py-2 px-4"><?php echo $patient['gender']; ?></td>
                    <td class="py-2 px-4"><?php echo $patient['date_of_birth']; ?></td>
                    <td class="py-2 px-4"><?php echo $patient['contact_no']; ?></td>
                    <td class="py-2 px-4"><?php echo $patient['medication_history']; ?></td>
                    <td class="py-2 px-4"><?php echo $patient['date_added']; ?></td>
                </tr>
            </tbody>
        </table>
        
        <h2 class="text-2xl font-bold mt-8">Previous Eye Results</h2>
<div class="eye-results-container mt-4">
    <?php if ($eye_results_result->num_rows > 0): ?>
        <?php while ($eye_row = $eye_results_result->fetch_assoc()): ?>
            <div class="eye-result-box border p-4 mb-4 bg-white shadow-md rounded">
                <h3 class="text-lg font-semibold">Date Added: <?php echo $eye_row['date_added']; ?></h3>
                <p><strong>Right Sphere:</strong> <?php echo $eye_row['r_sphere']; ?></p>
                <p><strong>Left Sphere:</strong> <?php echo $eye_row['l_sphere']; ?></p>
                <p><strong>Right Axis:</strong> <?php echo $eye_row['r_axis']; ?></p>
                <p><strong>Left Axis:</strong> <?php echo $eye_row['l_axis']; ?></p>
                <p><strong>Right Cylinder:</strong> <?php echo $eye_row['r_cylinder']; ?></p>
                <p><strong>Left Cylinder:</strong> <?php echo $eye_row['l_cylinder']; ?></p>
                <p><strong>Pupillary Distance:</strong> <?php echo $eye_row['pd']; ?></p>
                <p><strong>Diagnosis:</strong> <?php echo $eye_row['diagnosis']; ?></p>
                <p><strong>Eye Result ID:</strong> <?php echo $eye_row['eye_result_id']; ?></p>
            </div>
            <!-- Separator -->
            <div class="h-px bg-gray-200"></div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>No Previous Eye Results found for this patient.</p>
    <?php endif; ?>
</div>

    </div>
    <?php include('secretary_homepage.php'); ?>
</body>
</html>
