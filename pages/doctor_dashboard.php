<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gdoptical_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the number of patients added today
$result = $conn->query("SELECT COUNT(*) as count FROM patients WHERE DATE(date_added) = CURDATE()");
if ($result) {
    $patients_today = $result->fetch_assoc()['count'];
} else {
    die("Error retrieving patients today: " . $conn->error);
}

// Get the number of patients added yesterday
$result = $conn->query("SELECT COUNT(*) as count FROM patients WHERE DATE(date_added) = CURDATE() - INTERVAL 1 DAY");
if ($result) {
    $patients_yesterday = $result->fetch_assoc()['count'];
} else {
    die("Error retrieving patients yesterday: " . $conn->error);
}

// Get the total number of patients
$result = $conn->query("SELECT COUNT(*) as count FROM patients");
if ($result) {
    $total_patients = $result->fetch_assoc()['count'];
} else {
    die("Error retrieving total patients: " . $conn->error);
}

$conn->close();

// userinfo
session_start();
include 'db.php';

$user_fullname = '';
$user_role = '';
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $sql = "SELECT fullname, account_type FROM accounts WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $user_fullname = $row['fullname'];
        $user_role = $row['account_type'];
    }
} else {
    header("Location: login.php");
    exit();
}

?>
<head>
<link rel="shortcut icon" href="../images/ico.png" />
<head>
 <!-- start: Main -->
 <main class="w-full md:w-[calc(100%-256px)] md:ml-64 bg-gray-50 min-h-screen transition-all main">
    <div class="py-2 px-6 bg-white flex items-center shadow-md shadow-black/5 sticky top-0 left-0 z-30">
    <!-- Left side (menu button and breadcrumbs) -->
    <button type="button" class="text-lg text-gray-600 sidebar-toggle">
        <i class="ri-menu-line"></i>
    </button>
    <ul class="flex items-center text-sm ml-4">
        <li class="mr-2">
            <a href="#" class="text-gray-400 hover:text-gray-600 font-medium">Dashboard</a>
        </li>
        <li class="text-gray-600 mr-2 font-medium">/</li>
        <li class="text-gray-600 mr-2 font-medium">Analytics</li>
    </ul>

    <!-- Right side (profile image, name, and role) -->
    <div class="ml-auto flex items-center">
    <!-- Profile Image -->
<div class="dropdown ml-3">
    <button type="button" class="dropdown-toggle flex items-center">
         <img src="../images/profile.png" alt="Profile Image" class="w-8 h-8 rounded-full block object-cover">
    </button>
    <ul class="dropdown-menu shadow-md shadow-black/5 z-30 hidden py-1.5 rounded-md bg-white border border-gray-100 w-full max-w-[140px]">
        <li>
            <a href="../index.php" class="flex items-center text-[13px] py-1.5 px-4 text-gray-600 hover:text-blue-500 hover:bg-black-50">Logout</a>
        </li>
    </ul>
</div>


    <!-- User Details -->
    <div class="user-details ml-3">
    <span class="name text-sm font-semibold text-grey-900 block"><?php echo $user_fullname; ?></span>
    <span class="role text-xs text-grey-500"><?php echo ucwords($user_role); ?></span>
</div>

</div>
</div>
        <div class="p-6">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
        <div class="bg-white rounded-md border border-gray-100 p-6 shadow-md shadow-black/5">
            <div class="flex justify-between mb-6">
                <div>
                    <div class="text-2xl font-semibold mb-1"><?php echo $patients_today; ?></div>
                    <div class="text-sm font-medium text-black-400 flex items-center">
                        <i class="fas fa-user mr-2"></i> <!-- FontAwesome User Icon -->
                        Patients Today
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-md border border-gray-100 p-6 shadow-md shadow-black/5">
            <div class="flex justify-between mb-4">
                <div>
                    <div class="flex items-center mb-1">
                        <div class="text-2xl font-semibold"><?php echo $patients_yesterday; ?></div>
                    </div>
                    <div class="text-sm font-medium text-black-400 flex items-center">
                        <i class="fas fa-user mr-2"></i> <!-- FontAwesome User Icon -->
                        Patients Yesterday
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-md border border-gray-100 p-6 shadow-md shadow-black/5">
    <div class="flex justify-between mb-6">
        <div>
            <div class="text-2xl font-semibold mb-1">
                <span class="text-base font-normal text-gray-400 align-top"></span>
                <?php echo $total_patients; ?>
            </div>
            <div class="text-sm font-medium text-black-400 flex items-center">
                <i class="fas fa-user mr-2"></i> <!-- FontAwesome User Icon -->
                Total Patients
            </div>
        </div>
    </div>
</div>
    </main>
    <?php include('doctor_homepage.php'); ?>
    <!-- end: Main -->