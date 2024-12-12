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

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Fetch the record based on the ID
    $sql = "SELECT * FROM patients WHERE patients_id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Record not found";
        exit;
    }
} else {
    echo "Invalid request";
    exit;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Patient Information</title>
    <link rel="shortcut icon" href="../images/ico.png" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
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
                <li class="text-black-600 mr-2 font-medium">View Patient Information</li>
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

        <div class="container mx-auto my-8 p-4 bg-white rounded-lg shadow-lg">
            <h2 class="text-3xl font-semibold mb-6">Patient Information</h2>
            <div class="details-table">
                <div class="detail-row mb-4 border-b border-gray-300 pb-2">
                    <span class="detail-title font-bold text-lg">ID:</span>
                    <span class="detail-value text-lg"><?php echo $row['patients_id']; ?></span>
                </div>
                <div class="detail-row mb-4 border-b border-gray-300 pb-2">
                    <span class="detail-title font-bold text-lg">Last Name:</span>
                    <span class="detail-value text-lg"><?php echo $row['last_name']; ?></span>
                </div>
                <div class="detail-row mb-4 border-b border-gray-300 pb-2">
                    <span class="detail-title font-bold text-lg">First Name:</span>
                    <span class="detail-value text-lg"><?php echo $row['first_name']; ?></span>
                </div>
                <div class="detail-row mb-4 border-b border-gray-300 pb-2">
                    <span class="detail-title font-bold text-lg">Middle Name:</span>
                    <span class="detail-value text-lg"><?php echo $row['middle_name']; ?></span>
                </div>
                <div class="detail-row mb-4 border-b border-gray-300 pb-2">
                    <span class="detail-title font-bold text-lg">Gender:</span>
                    <span class="detail-value text-lg"><?php echo $row['gender']; ?></span>
                </div>
                <div class="detail-row mb-4 border-b border-gray-300 pb-2">
                    <span class="detail-title font-bold text-lg">Date of Birth:</span>
                    <span class="detail-value text-lg"><?php echo $row['date_of_birth']; ?></span>
                </div>
                <div class="detail-row mb-4 border-b border-gray-300 pb-2">
                    <span class="detail-title font-bold text-lg">Contact Number:</span>
                    <span class="detail-value text-lg"><?php echo $row['contact_no']; ?></span>
                </div>
                <div class="detail-row mb-4 border-b border-gray-300 pb-2">
                    <span class="detail-title font-bold text-lg">Address:</span>
                    <span class="detail-value text-lg"><?php echo $row['address']; ?></span>
                </div>

                <div class="detail-row mb-4">
                <span class="detail-title font-bold text-lg">Date Added:</span>
                 <span class="detail-value text-lg">
                <?php $date_added = new DateTime($row['date_added']); echo $date_added->format('F j, Y'); ?> </span>
            </div>
            </div>
            <div class="action-buttons mt-6 flex space-x-4"> <!-- Use flex and space-x-4 for spacing -->
    <a href="doctor_edit.php?id=<?php echo $row['patients_id']; ?>" class="action-btn edit-btn bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 text-lg">
        <i class="fa fa-edit"></i> Edit
    </a>
    <a href="doctor_eye_test_results.php?id=<?php echo $row['patients_id']; ?>" class="bg-green-500 text-white py-2 px-4 rounded hover:bg-green-600 transition duration-200">
        <i class="fa fa-eye"></i> Eye Test Results
    </a>
    <a href="doctor_initial_consultation_view.php?id=<?php echo $row['patients_id']; ?>" class="action-btn back-btn bg-yellow-500 text-white py-2 px-4 rounded hover:bg-gray-600 text-lg">
        <i class="fas fa-handshake"></i> Initial Consultation
    </a>
    <a href="doctor_eyeresult.php?id=<?php echo $row['patients_id']; ?>" class="action-btn bg-purple-500 text-white py-2 px-4 rounded hover:bg-purple-600 transition duration-200">
        <i class="fa fa-plus"></i> Add Eye Result
    </a>
    <a href="doctor_table.php" class="action-btn back-btn bg-gray-500 text-white py-2 px-4 rounded hover:bg-gray-600 text-lg">
        <i class="fa fa-undo"></i> Back to Patient List
    </a>
</div>


        </div>
    </main>
</body>
<?php include('doctor_homepage.php'); ?>
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="../dist/js/script.js"></script>
</html>
