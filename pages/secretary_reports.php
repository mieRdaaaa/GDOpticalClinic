<?php
include('db.php');
session_start(); // Start the session

// Redirect to login if not authenticated
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// User info
$username = $_SESSION['username'];
$user_fullname = '';
$user_role = '';

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

// Set selected month
$selected_month = isset($_POST['month']) ? $_POST['month'] : date('Y-m');

// Prepare the SQL query to retrieve total purchases by month
$query = "SELECT product_name, price, date_added, services_id 
          FROM services 
          WHERE DATE_FORMAT(date_added, '%Y-%m') = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $selected_month);
$stmt->execute();
$result = $stmt->get_result();

// Calculate total sales per product
$total_income = 0;
$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
    $total_income += $row['price'];
}
$stmt->close();

// Handle delete request
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];

    // Prepare the SQL statement to delete the service
    $delete_stmt = $conn->prepare("DELETE FROM services WHERE services_id = ?");
    $delete_stmt->bind_param("i", $delete_id);
    if ($delete_stmt->execute()) {
        header("Location: doctor_reports.php?message=Service deleted successfully");
        exit();
    } else {
        header("Location: doctor_reports.php?error=Failed to delete service");
        exit();
    }
    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <link rel="shortcut icon" href="../images/ico.png" />
</head>
<body class="bg-gray-100">

<!-- Main Content -->
<main class="w-full md:w-[calc(100%-256px)] md:ml-64 bg-gray-50 min-h-screen transition-all main">
    <div class="py-2 px-6 bg-white flex items-center shadow-md sticky top-0 z-30">
        <button type="button" class="text-lg text-gray-600 sidebar-toggle">
            <i class="ri-menu-line"></i>
        </button>
        <ul class="flex items-center text-sm ml-4">
            <li class="mr-2">
                <a href="#" class="text-black-400 hover:text-gray-600 font-medium">Reports</a>
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

    <div class="container mx-auto my-6 p-6 bg-white rounded-md shadow-md">
        <h2 class="text-3xl font-semibold mb-4 text-left">Monthly Income Report</h2>

        <!-- Month Selection Form -->
        <form method="POST" class="mb-6 flex items-center justify-start">
            <label for="month" class="text-sm font-medium text-gray-700 mr-2">Select Month:</label>
            <input type="month" id="month" name="month" class="border border-gray-300 rounded-md p-2 w-64 mr-4" value="<?php echo htmlspecialchars($selected_month); ?>">
            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">View Report</button>
            <div class="ml-auto">
                <a href="reports_certificate.php?month=<?php echo htmlspecialchars($selected_month); ?>" 
                   class="px-4 py-2 bg-purple-500 text-white rounded hover:bg-purple-600" 
                   target="_blank">Generate Certificate</a>
            </div>
        </form>

        <!-- Display Report Table -->
        <table class="min-w-full bg-white rounded-lg shadow-lg">
            <thead class="bg-blue-100">
                <tr>
                    <th class="py-3 px-4 border-b text-left font-semibold text-gray-700">Product Name</th>
                    <th class="py-3 px-4 border-b text-left font-semibold text-gray-700">Price</th>
                    <th class="py-3 px-4 border-b text-left font-semibold text-gray-700">Date Purchased</th>
                    <th class="py-3 px-4 border-b text-left font-semibold text-gray-700">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <?php foreach ($data as $item): ?>
                    <tr class="hover:bg-gray-100">
                        <td class="py-3 px-4"><?php echo htmlspecialchars($item['product_name']); ?></td>
                        <td class="py-3 px-4">₱<?php echo number_format($item['price'], 2); ?></td>
                        <td class="py-3 px-4"><?php echo htmlspecialchars(date("F j, Y", strtotime($item['date_added']))); ?></td>
                        <td class="py-2 px-4">
                            <a href="?delete_id=<?php echo htmlspecialchars($item['services_id']); ?>" 
                               class="action-btn delete text-red-500 hover:text-red-700" 
                               onclick="return confirm('Are you sure you want to delete this record?')">
                                <i class="fa fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2" class="py-3 px-4 font-bold text-right">Total Income:</td>
                    <td class="py-3 px-4 font-bold">₱<?php echo number_format($total_income, 2); ?></td>
                </tr>
            </tfoot>
        </table>
    </div>
</main>

<?php include('secretary_homepage.php'); ?>
<script src="https://unpkg.com/@popperjs/core@2"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="../dist/js/script.js"></script>
</body>
</html>
