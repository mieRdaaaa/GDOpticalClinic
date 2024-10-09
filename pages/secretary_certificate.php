<?php
include('db.php');

// User info
$user_fullname = '';
$user_role = '';

session_start(); // Start the session
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

// Pagination and search
$search = isset($_GET['search']) ? $_GET['search'] : '';
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 15; // Set limit to 15 records per page
$offset = ($page - 1) * $limit;

// Count total records for pagination
$total_sql = "SELECT COUNT(*) FROM patients 
              WHERE last_name LIKE ? 
              OR first_name LIKE ? 
              OR middle_name LIKE ? 
              OR contact_no LIKE ? 
              OR date_added LIKE ?";

$like_search = "%$search%";
$total_stmt = $conn->prepare($total_sql);
if ($total_stmt === false) {
    die("Error preparing total count statement: " . $conn->error);
}
$total_stmt->bind_param("sssss", $like_search, $like_search, $like_search, $like_search, $like_search);
$total_stmt->execute();
$total_stmt->bind_result($total_records);
$total_stmt->fetch();
$total_stmt->close();

// Calculate total pages
$total_pages = ceil($total_records / $limit);

// Fetch data with search filter and pagination
$sql = "SELECT patients_id, last_name, first_name, middle_name, gender, date_of_birth, contact_no, date_added FROM patients 
        WHERE last_name LIKE ? 
        OR first_name LIKE ? 
        OR middle_name LIKE ?       
        OR contact_no LIKE ? 
        OR date_added LIKE ?
        LIMIT ?, ?";

$stmt = $conn->prepare($sql);
if ($stmt === false) {
    die("Error preparing select statement: " . $conn->error);
}
$stmt->bind_param("ssssssi", $like_search, $like_search, $like_search, $like_search, $like_search, $offset, $limit);
$stmt->execute();
$result = $stmt->get_result();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://unpkg.com/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="../images/ico.png" />
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
                <a href="#" class="text-black-400 hover:text-gray-600 font-medium">Certificate</a>
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
    <form method="GET" action="" class="px-6 py-4">
        <div class="flex">
            <input type="text" name="search" placeholder="Search..." value="<?php echo htmlspecialchars($search); ?>" class="border-2 border-gray-300 p-2 rounded-lg w-80 focus:outline-none focus:ring-2 focus:ring-blue-500">
            <button type="submit" class="bg-blue-500 text-white p-2 rounded-lg ml-2 hover:bg-blue-600 transition"><i class="fa fa-search"></i> Search</button>
        </div>
    </form>

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
                            echo "<tr class='border-b border-gray-200 hover:bg-gray-100 text-lg'>
                                    <td class='py-2 px-4'>{$row['last_name']}</td>
                                    <td class='py-2 px-4'>{$row['first_name']}</td>
                                    <td class='py-2 px-4'>{$row['middle_name']}</td>
                                    <td class='py-2 px-4'>{$row['gender']}</td>
                                    <td class='py-2 px-4'>{$row['date_of_birth']}</td>
                                    <td class='py-2 px-4'>{$row['contact_no']}</td>
                                    <td class='py-2 px-4'>{$row['date_added']}</td>
                                    <td class='py-2 px-4'>
                                        <a href='secretary_certificate_view.php?id={$row['patients_id']}' class='action-btn add text-blue-500 hover:text-green-700'><i class='fa fa-eye'></i></a>
                                        <a href='secretary_certificate_add.php?id={$row['patients_id']}' class='action-btn view text-green-500 hover:text-blue-700'><i class='fa fa-plus'></i></a>
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
<?php include('secretary_homepage.php'); ?>
<script src="https://unpkg.com/@popperjs/core@2"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="../dist/js/script.js"></script>
</body>
</html>
