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

// Get the user's ID from the query string
$id = intval($_GET['id']);

// Fetch the user's current details from the database
$sql = "SELECT * FROM accounts WHERE accounts_id = $id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    echo "No records found";
    exit;
}

// Update the user's details if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $birthdate = $_POST['birthdate'];
    $contact_number = $_POST['contact_number'];
    $account_type = $_POST['account_type'];

    // Corrected SQL UPDATE query
    $update_sql = "UPDATE accounts SET 
                    fullname = '$fullname', 
                    username = '$username', 
                    password = '$password', 
                    gender = '$gender', 
                    address = '$address', 
                    birthdate = '$birthdate',
                    contact_number = '$contact_number',
                    account_type = '$account_type'
                   WHERE accounts_id = $id";

    if ($conn->query($update_sql) === TRUE) {
        // Set a session variable for notification
        $_SESSION['notification'] = 'Record updated successfully';
        header("Location: view_user.php?id=$id");
        exit;
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <script src="https://cdn.tailwindcss.com"></script>
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
                    <a href="#" class="text-black-400 hover:text-gray-600 font-medium">Edit User Details</a>
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
                    <span class="name text-lg font-semibold text-gray-900 block"><?php echo htmlspecialchars($user_fullname); ?></span>
                    <span class="role text-sm text-gray-500"><?php echo ucfirst(htmlspecialchars($user_role)); ?></span>
                </div>
            </div>
        </div>

        <!-- User Edit Form -->
        <div class="container mx-auto p-6 bg-white shadow-lg rounded-lg mt-6">
            <h2 class="text-3xl font-semibold mb-6">Edit User Details</h2>
            <form method="POST" action="">
                <div class="mb-4">
                    <label for="fullname" class="block text-lg font-medium text-gray-700">Full Name:</label>
                    <input type="text" id="fullname" name="fullname" value="<?php echo htmlspecialchars($row['fullname']); ?>" required class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
                <div class="mb-4">
                    <label for="username" class="block text-lg font-medium text-gray-700">Username:</label>
                    <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($row['username']); ?>" required class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-lg font-medium text-gray-700">Password:</label>
                    <input type="text" id="password" name="password" value="<?php echo htmlspecialchars($row['password']); ?>" required class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
                <div class="mb-4">
                    <label for="gender" class="block text-lg font-medium text-gray-700">Gender:</label>
                    <select id="gender" name="gender" required class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="Male" <?php echo ($row['gender'] == 'Male') ? 'selected' : ''; ?>>Male</option>
                        <option value="Female" <?php echo ($row['gender'] == 'Female') ? 'selected' : ''; ?>>Female</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="birthdate" class="block text-lg font-medium text-gray-700">Date of Birth:</label>
                    <input type="date" id="birthdate" name="birthdate" value="<?php echo htmlspecialchars($row['birthdate']); ?>" readonly class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
                <div class="mb-4">
                    <label for="contact_number" class="block text-lg font-medium text-gray-700">Contact Number:</label>
                    <input type="text" id="contact_number" name="contact_number" value="<?php echo htmlspecialchars($row['contact_number']); ?>" required class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
                <div class="mb-4">
                    <label for="address" class="block text-lg font-medium text-gray-700">Address:</label>
                    <input type="text" id="address" name="address" value="<?php echo htmlspecialchars($row['address']); ?>" required class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
                <div class="mb-4">
                    <label for="account_type" class="block text-lg font-medium text-gray-700">Account Type:</label>
                    <input type="text" id="account_type" name="account_type" value="<?php echo htmlspecialchars($row['account_type']); ?>" readonly class="mt-1 block w-full px-3 py-2 bg-gray-100 border border-gray-300 rounded-md shadow-sm focus:outline-none sm:text-sm">
                </div>
                <div class="flex justify-end space-x-2">
                    <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 focus:outline-none">Save</button>
                    <a href="view_user.php?id=<?php echo $row['accounts_id']; ?>" class="bg-gray-300 text-gray-700 py-2 px-4 rounded-md hover:bg-gray-400 focus:outline-none">Cancel</a>
                </div>
            </form>
        </div>
    </main>
</body>
<?php include('doctor_homepage.php'); ?> 
<script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="../dist/js/script.js"></script>
</html>
