<?php
session_start();
include 'db.php';

$showWarning = false; 
$errorMessage = ""; // Initialize the error message variable

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM accounts WHERE username=? AND password=?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $_SESSION['username'] = $row['username'];
        $_SESSION['fullname'] = $row['fullname'];
        $_SESSION['role'] = $row['account_type'];

        if ($row['account_type'] == 'doctor') {
            header("Location: doctor_dashboard.php");
        } else if ($row['account_type'] == 'secretary') {
            header("Location: secretary_dashboard.php");
        }
        exit();
    } else {
        // Set the warning message if login fails
        $showWarning = true;
        $errorMessage = "Invalid username or password. Please try again.";
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login ┃ GD Optical Clinic</title>
    <link rel="shortcut icon" href="../images/ico.png" />
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="h-screen flex items-center justify-center bg-cover bg-fixed" 
      style="background-image: url('../images/blurbg.png');">

    <!-- Form Container -->
    <div class="w-full max-w-md p-8 bg-white rounded-lg shadow-lg z-10">
        <div class="mb-6 text-center">
            <img src="../images/mainlogo.png" alt="Logo" class="w-32 h-auto mx-auto mb-4">
            <h3 class="font-semibold text-2xl text-gray-800">Log In</h3>
            <p class="text-gray-600 mt-2">Welcome back! Please log in to your account.</p>
        </div>

        <!-- Show Warning Message if login fails -->
        <?php if ($showWarning): ?>
            <div class="mb-4 p-4 bg-red-200 text-red-800 border border-red-400 rounded">
                <?= htmlspecialchars($errorMessage) ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="mb-4">
                <input name="username" class="w-full px-4 py-3 text-sm text-gray-700 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" type="text" placeholder="Username" required>
            </div>

            <div class="mb-6">
                <input name="password" placeholder="Password" class="w-full px-4 py-3 text-sm text-gray-700 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" type="password" required>
            </div>

            <!-- Submit Button -->
            <div>
                <button type="submit" class="w-full bg-blue-800 hover:bg-blue-700 text-white font-semibold py-3 rounded-lg transition duration-200 ease-in-out">
                    Log In
                </button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.js"></script>
</body>
</html>
