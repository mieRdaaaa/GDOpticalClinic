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

$search = "";
if (isset($_GET['search'])) {
    $search = $_GET['search'];
}

// Pagination setup
$limit = 15; // Number of entries to show per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Current page
$offset = ($page - 1) * $limit; // Calculate offset

// Fetch data with search filter and pagination
$sql = "SELECT patients_id, last_name, first_name, middle_name, gender, date_of_birth, contact_no, date_added FROM patients 
        WHERE last_name LIKE '%$search%' 
        OR first_name LIKE '%$search%' 
        OR middle_name LIKE '%$search%'       
        OR contact_no LIKE '%$search%'
        OR date_added LIKE '%$search%'
        ORDER BY date_added DESC
        LIMIT ?, ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $offset, $limit);
$stmt->execute();
$result = $stmt->get_result();

// Count total records for pagination
$total_result_sql = "SELECT COUNT(*) FROM patients 
                     WHERE last_name LIKE '%$search%' 
                     OR first_name LIKE '%$search%' 
                     OR middle_name LIKE '%$search%'       
                     OR contact_no LIKE '%$search%'
                     OR date_added LIKE '%$search%'";
$total_result = $conn->query($total_result_sql);
$total_rows = $total_result->fetch_row()[0];
$total_pages = ceil($total_rows / $limit);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>History</title>
    <link rel="shortcut icon" href="../images/ico.png" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://unpkg.com/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <!-- Start: Main -->
    <main class="w-full md:w-[calc(100%-256px)] md:ml-64 bg-gray-50 min-h-screen transition-all main">
        <div class="py-2 px-6 bg-white flex items-center shadow-md sticky top-0 z-30">
            <button type="button" class="text-lg text-gray-600 sidebar-toggle">
                <i class="ri-menu-line"></i>
            </button>
            <ul class="flex items-center text-sm ml-4">
                <li class="mr-2">
                    <a href="#" class="text-black-400 hover:text-gray-600 font-medium">History</a>
                </li>
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

        <!-- Search form -->
        <div class="flex items-center justify-between px-6 py-4">
        <h2 class="text-3xl font-semibold text-gray-800">Patients History</h2>
        <form method="GET" action="" class="px-6 py-4">
            <div class="flex">
                <input type="text" name="search" placeholder="Search..." value="<?php echo htmlspecialchars($search); ?>" class="border-2 border-gray-300 p-2 rounded-lg w-80 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <button type="submit" class="bg-blue-500 text-white p-2 rounded-lg ml-2 hover:bg-blue-600 transition"><i class="fa fa-search"></i> Search</button>
            </div>
        </form>
        </div>


        <!-- Table container -->
        <div class="table-container px-6 py-4">
            <div class="overflow-x-auto bg-white rounded-lg shadow">
                <table class="min-w-full bg-white border border-gray-300">
                    <thead>
                        <tr class="bg-gray-200 text-gray-600 text-left text-lg uppercase font-semibold">
                            <th class="py-2 px-4">Last Name</th>
                            <th class="py-2 px-4">First Name</th>
                            <th class="py-2 px-4">Middle Name</th>
                            <th class="py-2 px-4">Gender</th>
                            <th class="py-2 px-4">Date of Birth</th>
                            <th class="py-2 px-4">Contact Number</th>
                            <th class="py-2 px-4">Date Added</th>
                            <th class="py-2 px-4">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                // Format the date of birth
                                $dob = new DateTime($row['date_of_birth']);
                                $formatted_dob = $dob->format('F j, Y'); // e.g., December 4, 2021
                    
                                // Format the date added
                                $date_added = new DateTime($row['date_added']);
                                $formatted_date_added = $date_added->format('F j, Y'); // e.g., December 4, 2021
                    
                                echo "<tr class='border-b border-gray-200 hover:bg-gray-100 text-lg'>
                                        <td class='py-2 px-4'>{$row['last_name']}</td>
                                        <td class='py-2 px-4'>{$row['first_name']}</td>
                                        <td class='py-2 px-4'>{$row['middle_name']}</td>
                                        <td class='py-2 px-4'>{$row['gender']}</td>
                                        <td class='py-2 px-4'>{$formatted_dob}</td>
                                        <td class='py-2 px-4'>{$row['contact_no']}</td>
                                        <td class='py-2 px-4'>{$formatted_date_added}</td>
                                        <td class='py-2 px-4'>
                                            <a href='doctor_history_result.php?id={$row['patients_id']}' class='action-btn view text-blue-500 hover:text-blue-700'><i class='fa fa-eye'></i></a>
                                        </td>
                                      </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='8' class='py-2 px-4 text-center text-gray-500'>No records found</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

   <!-- Pagination -->
   <div class="flex justify-center mt-4">
            <?php if ($page > 1): ?>
                <a href="?page=<?php echo $page - 1; ?>&search=<?php echo htmlspecialchars($search); ?>" class="px-4 py-2 bg-blue-500 text-white rounded-l hover:bg-blue-600">Previous</a>
            <?php endif; ?>
            <span class="px-4 py-2 bg-gray-200 text-gray-600"><?php echo $page; ?> / <?php echo $total_pages; ?></span>
            <?php if ($page < $total_pages): ?>
                <a href="?page=<?php echo $page + 1; ?>&search=<?php echo htmlspecialchars($search); ?>" class="px-4 py-2 bg-blue-500 text-white rounded-r hover:bg-blue-600">Next</a>
            <?php endif; ?>
        </div>

    </main>
    <?php include('doctor_homepage.php'); ?>
</body>
</html>

