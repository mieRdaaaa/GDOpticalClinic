<?php
// userinfo
session_start();
include 'db.php';

$user_fullname = '';
$user_role = '';
$success_message = '';

// Check if the user is logged in
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    // Prepare SQL statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT fullname, account_type FROM accounts WHERE username = ?");
    if ($stmt) {
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();
            $user_fullname = htmlspecialchars($row['fullname'], ENT_QUOTES, 'UTF-8');
            $user_role = ucfirst(htmlspecialchars($row['account_type'], ENT_QUOTES, 'UTF-8'));
        } else {
            // Handle user not found
            $user_fullname = "Unknown User";
            $user_role = "Guest";
        }

        $stmt->close();
    } else {
        // Log the SQL error
        error_log("SQL Error: " . $conn->error);
    }
} else {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://unpkg.com/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="../images/ico.png" />
    <style>
        .success-message {
            display: none;
            background-color: #38a169; /* Green color */
            color: white;
            padding: 10px;
            text-align: center;
            position: fixed;
            top: 10px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 1000;
            border-radius: 5px;
            transition: opacity 0.5s ease-in-out;
        }
    </style>
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
                <a href="#" class="text-black-400 hover:text-gray-600 font-medium">Registration</a>
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

    <div id="success-message" class="success-message">
        User created successfully!
    </div>

    <section class="container mx-auto p-6 bg-white rounded-md shadow-md">
        <header class="text-3xl font-semibold mb-4">Registration</header>

        <form action="register.php" method="post" class="space-y-4" onsubmit="showSuccessMessage(event)">
            <div class="input-box">
                <label class="block text-sm font-semibold mb-1">Full Name</label>
                <input type="text" name="fullname" placeholder="Enter full name" required class="block w-full border border-gray-300 rounded-md py-2 px-4">
            </div>

            <div class="input-box">
                <label class="block text-sm font-semibold mb-1">Username</label>
                <input type="text" name="username" placeholder="Enter username" required class="block w-full border border-gray-300 rounded-md py-2 px-4">
            </div>

            <div class="input-box">
                <label class="block text-sm font-semibold mb-1">Password</label>
                <input type="password" name="password" placeholder="Enter password" required class="block w-full border border-gray-300 rounded-md py-2 px-4">
            </div>

            <div class="input-box">
                <label class="block text-sm font-semibold mb-1">Region</label>
                <select id="region" name="region" onchange="loadProvinces()" required class="block w-full border border-gray-300 rounded-md py-2 px-4">
                    <option value="">Select Region</option>
                </select>
            </div>

            <div class="input-box">
                <label class="block text-sm font-semibold mb-1">Province</label>
                <select id="province" name="province" onchange="loadCities()" required class="block w-full border border-gray-300 rounded-md py-2 px-4">
                    <option value="">Select Province</option>
                </select>
            </div>

            <div class="input-box">
                <label class="block text-sm font-semibold mb-1">City / Municipality</label>
                <select id="city" name="city" onchange="loadBarangays()" required class="block w-full border border-gray-300 rounded-md py-2 px-4">
                    <option value="">Select City / Municipality</option>
                </select>
            </div>

            <div class="input-box">
                <label class="block text-sm font-semibold mb-1">Barangay</label>
                <select id="barangay" name="barangay" required class="block w-full border border-gray-300 rounded-md py-2 px-4">
                    <option value="">Select Barangay</option>
                </select>
            </div>

            <div class="flex space-x-4">
                <div class="input-box w-1/2">
                    <label class="block text-sm font-semibold mb-1">Contact Number</label>
                    <input type="number" name="contact_number" id="contact_number" placeholder="Enter phone number" required oninput="validateNumber(this)" class="block w-full border border-gray-300 rounded-md py-2 px-4">
                </div>
                <div class="input-box w-1/2">
                    <label class="block text-sm font-semibold mb-1">Date of Birth</label>
                    <input type="date" name="birthdate" id="birthdate" placeholder="Enter birth date" required class="block w-full border border-gray-300 rounded-md py-2 px-4">
                </div>
            </div>

            <div class="gender-box mb-2">
                <h3 class="text-sm font-semibold mb-1">Gender</h3>
                <div class="flex space-x-6">
                    <div class="gender">
                        <input type="radio" id="check-male" name="gender" value="male" checked>
                        <label for="check-male" class="text-sm">Male</label>
                    </div>
                    <div class="gender">
                        <input type="radio" id="check-female" name="gender" value="female">
                        <label for="check-female" class="text-sm">Female</label>
                    </div>
                    <div class="gender">
                        <input type="radio" id="check-other" name="gender" value="prefer_not_to_say">
                        <label for="check-other" class="text-sm">Prefer not to say</label>
                    </div>
                </div>
            </div>

            <div class="role-box mb-4">
                <h3 class="text-sm font-semibold mb-1">Select Role</h3>
                <div class="flex space-x-4">
                    <div class="role">
                        <input type="radio" id="check-doctor" name="role" value="doctor" checked>
                        <label for="check-doctor" class="text-sm">Doctor</label>
                    </div>
                    <div class="role">
                        <input type="radio" id="check-secretary" name="role" value="secretary">
                        <label for="check-secretary" class="text-sm">Secretary</label>
                    </div>
                </div>
            </div>
            
            <p class="text-green-500 text-sm font-semibold mb-2">For Doctors Only</p> 
            <div class="flex space-x-4">
                <div class="input-box w-1/2">
                    <label class="block text-sm font-semibold mb-1">License Number</label>
                    <input type="text" name="license_no" id="license_no" placeholder="Enter license number" required class="block w-full border border-gray-300 rounded-md py-2 px-4">
                </div>
                <div class="input-box w-1/2">
                    <label class="block text-sm font-semibold mb-1">PTR Number</label>
                    <input type="text" name="ptr_no" id="ptr_no" placeholder="Enter PTR number" required class="block w-full border border-gray-300 rounded-md py-2 px-4">
                </div>
            </div>

            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Submit</button>
        </form>
    </section>

    <?php include('doctor_homepage.php'); ?>
    <script src="https://unpkg.com/@popperjs/core@2"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="../dist/js/script.js"></script>
</main>

<!-- end: Main -->
<script src="../dist/js/address_selector.js"></script>
<script>
    function validateNumber(input) {
        // Remove any non-digit characters
        input.value = input.value.replace(/[^0-9]/g, '');
    }

    // Show success message
    function showSuccessMessage(event) {
        event.preventDefault(); // Prevent default form submission
        const successMessage = document.getElementById('success-message');
        successMessage.style.display = 'block';
        successMessage.style.opacity = '1';

        setTimeout(() => {
            successMessage.style.opacity = '0';
            setTimeout(() => {
                successMessage.style.display = 'none';
            }, 500);
        }, 10000); // Message displayed for 10 seconds

        // Simulate form submission
        setTimeout(() => {
            event.target.submit(); // Submit the form after showing the message
        }, 1000); // Wait 1 second before submitting
    }

    // Get the current date for date validation
    const today = new Date();
    const eighteenYearsAgo = new Date(today.setFullYear(today.getFullYear() - 18));
    const maxDate = eighteenYearsAgo.toISOString().split("T")[0];
    document.getElementById('birthdate').setAttribute('max', maxDate);
</script>
</body>

</html>
