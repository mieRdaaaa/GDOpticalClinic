<?php
session_start();
include('db.php');

// Enable error reporting
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// User authentication
$user_fullname = '';
$user_role = '';
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $sql = "SELECT fullname, account_type FROM accounts WHERE username=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $user_fullname = $row['fullname'];
        $user_role = $row['account_type'];
    }
} else {
    header("Location: login.php");
    exit();
}

$search = "";
if (isset($_GET['search'])) {
    $search = $_GET['search'];
}

// Use prepared statements to prevent SQL injection
$sql = "SELECT patients_id, last_name, first_name, middle_name, gender, date_of_birth, contact_no, address, date_added FROM patients 
        WHERE last_name LIKE ? 
        OR first_name LIKE ? 
        OR middle_name LIKE ?       
        OR contact_no LIKE ?
        OR address LIKE ?
        OR date_added LIKE ?";

$stmt = $conn->prepare($sql);
$searchTerm = "%$search%";
$stmt->bind_param('ssssss', $searchTerm, $searchTerm, $searchTerm, $searchTerm, $searchTerm, $searchTerm);
$stmt->execute();
$result = $stmt->get_result();

if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);
    $conn->begin_transaction();
    
    try {
        $delete_eye_result_sql = "DELETE FROM eye_result WHERE patients_id = ?";
        $delete_stmt = $conn->prepare($delete_eye_result_sql);
        $delete_stmt->bind_param('i', $delete_id);
        $delete_stmt->execute();
        
        $delete_patient_sql = "DELETE FROM patients WHERE patients_id = ?";
        $delete_stmt = $conn->prepare($delete_patient_sql);
        $delete_stmt->bind_param('i', $delete_id);
        $delete_stmt->execute();
        
        $conn->commit();
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    } catch (Exception $e) {
        $conn->rollback();
        echo $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="shortcut icon" href="../images/ico.png" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="h-screen bg-gray-100 flex items-center justify-center">
<!-- start: Main -->
<main class="w-full md:w-[calc(100%-256px)] md:ml-64 bg-gray-50 min-h-screen transition-all main">
    <div class="py-2 px-6 bg-white flex items-center shadow-md shadow-black/5 sticky top-0 left-0 z-30">
        <!-- Left side (menu button and breadcrumbs) -->
        <button type="button" class="text-lg text-gray-600 sidebar-toggle">
            <i class="ri-menu-line"></i>
        </button>
        <ul class="flex items-center text-sm ml-4">
            <li class="mr-2">
                <a href="#" class="text-black-400 hover:text-gray-600 font-medium">Patients Table</a>
            </li>
        </ul>

        <!-- Right side (profile image, name, and role) -->
        <div class="ml-auto flex items-center">
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
<div class="user-details">
        <span class="name text-sm font-semibold text-gray-900 block"><?php echo $user_fullname; ?></span>
        <span class="role text-xs text-gray-500"><?php echo ucfirst($user_role); ?></span>
    </div>
        </div>
    </div>

    <div class="max-w-6xl w-full mx-auto bg-white p-6 shadow-lg rounded-lg flex flex-col items-center">
        <h2 class="text-2xl font-semibold mb-4">PATIENTS TABLE</h2>
        <!-- Search Form -->
        <form method="GET" action="" class="mb-6 flex items-center justify-center">
            <input 
                type="text" 
                name="search" 
                placeholder="Search patients..." 
                value="<?php echo htmlspecialchars($search); ?>" 
                class="w-full p-2 border border-black-300 rounded-md shadow-sm focus:outline-none focus:ring focus:border-black-500"
            />
            <button type="submit" class="ml-2 px-4 py-2 bg-blue-600 text-black rounded-md shadow hover:bg-blue-500 transition">
                <i class="fas fa-search"></i> Search
            </button>
        </form>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full table-auto">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="p-3 text-left text-gray-500">Last Name</th>
                        <th class="p-3 text-left text-gray-500">First Name</th>
                        <th class="p-3 text-left text-gray-500">Middle Name</th>
                        <th class="p-3 text-left text-gray-500">Gender</th>
                        <th class="p-3 text-left text-gray-500">Date of Birth</th>
                        <th class="p-3 text-left text-gray-500">Contact No</th>
                        <th class="p-3 text-left text-gray-500">Address</th>
                        <th class="p-3 text-left text-gray-500">Date Added</th>
                        <th class="p-3 text-left text-gray-500">Action</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr class='border-b hover:bg-gray-50'>
                                    <td class='p-3'>{$row['last_name']}</td>
                                    <td class='p-3'>{$row['first_name']}</td>
                                    <td class='p-3'>{$row['middle_name']}</td>
                                    <td class='p-3'>{$row['gender']}</td>
                                    <td class='p-3'>{$row['date_of_birth']}</td>
                                    <td class='p-3'>{$row['contact_no']}</td>
                                    <td class='p-3'>{$row['address']}</td>
                                    <td class='p-3'>{$row['date_added']}</td>
                                    <td class='p-3 flex space-x-2'>
                                        <a href='doctor_view.php?id={$row['patients_id']}' class='text-blue-500 hover:text-blue-700'><i class='fas fa-eye'></i></a>
                                        <a href='?delete_id={$row['patients_id']}' class='text-red-500 hover:text-red-700' onclick='return confirm(\"Are you sure you want to delete this record?\")'><i class='fas fa-trash'></i></a>
                                        <a href='doctor_eyeresult.php?id={$row['patients_id']}' class='text-green-500 hover:text-green-700'><i class='fas fa-plus'></i></a>
                                    </td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='9' class='p-3 text-center text-gray-500'>No records found</td></tr>";
                    }
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</main>
<?php include('doctor_homepage.php'); ?>
<script src="https://unpkg.com/@popperjs/core@2"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="../dist/js/script.js"></script>
</body>
</html>
