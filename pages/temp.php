<?php
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
?>

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

    <?php include('doctor_homepage.php'); ?>
</main>
<!-- end: Main -->
