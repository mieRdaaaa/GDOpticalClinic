<?php
session_start();
include('db.php');

// Check if a delete request has been made
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    
    // SQL query to delete the record
    $delete_sql = "DELETE FROM accounts WHERE accounts_id = ?";
    
    // Prepare the statement
    if ($stmt = $conn->prepare($delete_sql)) {
        // Bind the parameters
        $stmt->bind_param("i", $delete_id);
        
        // Execute the statement
        if (!$stmt->execute()) {
            echo "Error deleting record: " . $stmt->error;
        }
        
        // Close the statement
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }
}

// User info
$user_fullname = '';
$user_role = '';

// Check if the user is logged in
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    
    // Prepare SQL statement to prevent SQL injection
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

// Pagination and search
$search = isset($_GET['search']) ? $_GET['search'] : '';
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 14; // Set limit to 5
$offset = ($page - 1) * $limit;

// Fetch data with search filter
$sql = "SELECT accounts_id, fullname, username, password, gender, birthdate, contact_number, address, account_type FROM accounts 
        WHERE fullname LIKE ? 
        OR contact_number LIKE ? 
        OR address LIKE ?       
        OR account_type LIKE ?
        LIMIT ? OFFSET ?";

$stmt = $conn->prepare($sql);
$search_param = "%$search%";
$stmt->bind_param("ssiiii", $search_param, $search_param, $search_param, $search_param, $limit, $offset);
$stmt->execute();
$result = $stmt->get_result();

// Count total records for pagination
$total_sql = "SELECT COUNT(*) FROM accounts WHERE fullname LIKE ? OR contact_number LIKE ? OR address LIKE ? OR account_type LIKE ?";
$total_stmt = $conn->prepare($total_sql);
$total_stmt->bind_param("ssss", $search_param, $search_param, $search_param, $search_param);
$total_stmt->execute();
$total_result = $total_stmt->get_result();
$total_count = $total_result->fetch_row()[0];
$total_pages = ceil($total_count / $limit);

$stmt->close();
$total_stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View User</title>
    <link rel="stylesheet" href="css/doctor_users.css">
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
                    <a href="#" class="text-black-400 hover:text-gray-600 font-medium">View User</a>
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
    <h2 class="text-3xl font-semibold text-gray-800">View User</h2>
    <form method="GET" action="" class="flex">
        <input type="text" name="search" placeholder="Search..." value="<?php echo htmlspecialchars($search); ?>" class="border-2 border-gray-300 p-2 rounded-lg w-80 focus:outline-none focus:ring-2 focus:ring-blue-500">
        <button type="submit" class="bg-blue-500 text-white p-2 rounded-lg ml-2 hover:bg-blue-600 transition"><i class="fa fa-search"></i> Search</button>
    </form>
</div>


        <!-- Table container -->
        <div class="table-container px-6 py-4">
            <div class="overflow-x-auto bg-white rounded-lg shadow">
                <table class="min-w-full bg-white border border-gray-300">
                    <thead>
                        <tr class="bg-gray-200 text-gray-600 text-left text-sm uppercase font-semibold">
                            <th class="py-2 px-4">Full Name</th>
                            <th class="py-2 px-4">Username</th>
                            <th class="py-2 px-4">Password</th>
                            <th class="py-2 px-4">Gender</th>
                            <th class="py-2 px-4">Date of Birth</th>
                            <th class="py-2 px-4">Contact Number</th>
                            <th class="py-2 px-4">Address</th>
                            <th class="py-2 px-4">Role</th>
                            <th class="py-2 px-4">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo "<tr class='border-b border-gray-200 hover:bg-gray-100'>
                                        <td class='py-2 px-4'>{$row['fullname']}</td>
                                        <td class='py-2 px-4'>{$row['username']}</td>
                                        <td class='py-2 px-4'>{$row['password']}</td>
                                        <td class='py-2 px-4'>{$row['gender']}</td>
                                        <td class='py-2 px-4'>{$row['birthdate']}</td>
                                        <td class='py-2 px-4'>{$row['contact_number']}</td>
                                        <td class='py-2 px-4'>{$row['address']}</td>
                                        <td class='py-2 px-4'>{$row['account_type']}</td>
                                        <td class='py-2 px-4'>
                                            <a href='doctor_usersedit.php?id={$row['accounts_id']}' class='text-blue-500 hover:text-blue-700'><i class='fa fa-edit'></i></a>
                                            <a href='?delete_id={$row['accounts_id']}' class='text-red-500 hover:text-red-700' onclick='return confirm(\"Are you sure you want to delete this record?\")'><i class='fa fa-trash'></i></a>
                                        </td>
                                      </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='9' class='py-4 text-center text-gray-500'>No records found</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        <div class="px-6 py-4 flex justify-between items-center">
            <div>
                <span class="text-sm text-gray-700">Showing <?php echo ($offset + 1) . " to " . min($offset + $limit, $total_count) . " of " . $total_count . " entries"; ?></span>
            </div>
            <div>
                <nav aria-label="Page navigation">
                    <ul class="flex space-x-2">
                        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                            <li>
                                <a href="?page=<?php echo $i; ?>&search=<?php echo urlencode($search); ?>" class="py-2 px-4 border border-gray-300 rounded-lg <?php echo $i === $page ? 'bg-blue-500 text-white' : 'bg-white text-blue-500 hover:bg-blue-100'; ?>">
                                    <?php echo $i; ?>
                                </a>
                            </li>
                        <?php endfor; ?>
                    </ul>
                </nav>
            </div>
        </div>

        <!-- Include doctor homepage -->
        <?php include('doctor_homepage.php'); ?>
    </main>
</body>
</html>
