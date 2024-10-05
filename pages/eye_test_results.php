<?php
// Include your database connection file
include('db.php');

// User info
$user_fullname = '';
$user_role = '';

// Check if the user is logged in
session_start(); 
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    
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
                <a href="doctor_view.php" class="text-black-400 hover:text-gray-600 font-medium">Eye Test Results</a>
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

    <!-- Eye Test Results Section -->
    <div class="container mx-auto px-4 sm:px-8 mt-4">
        
        <?php
        if (isset($_GET['id'])) {
            $patients_id = $_GET['id'];

            $query = "SELECT * FROM eye_result WHERE patients_id = ? ORDER BY date_added DESC LIMIT 1";

            if ($stmt = $conn->prepare($query)) {
                $stmt->bind_param('i', $patients_id); 

                $stmt->execute();
                
                $result = $stmt->get_result();

                echo '<div class="shadow-lg rounded-lg overflow-hidden mx-4 md:mx-10 mt-4 bg-white p-4 grid grid-cols-1 sm:grid-cols-2 gap-4">'; // Use grid layout
                echo '<h2 class="text-xl font-semibold col-span-2 mb-4">Eye Test Results</h2>'; // Title of the section
                
                if ($row = $result->fetch_assoc()) {
                    // Display each parameter in a card style
                    foreach ([
                        'r_sphere' => 'Right Sphere',
                        'l_sphere' => 'Left Sphere',
                        'r_cylinder' => 'Right Cylinder',
                        'l_cylinder' => 'Left Cylinder',
                        'r_axis' => 'Right Axis',
                        'l_axis' => 'Left Axis',
                        'pd' => 'PD',
                        'diagnosis' => 'Diagnosis',
                        'date_added' => 'Date Added'
                    ] as $key => $label) {
                        echo '<div class="bg-gray-100 p-4 rounded-lg shadow">';
                        echo '<h3 class="text-gray-600 font-bold uppercase">' . $label . '</h3>';
                        echo '<p class="text-lg">' . htmlspecialchars($row[$key]) . '</p>';
                        echo '</div>';
                    }
                } else {
                    echo '<div class="col-span-2 py-4 px-6 border-b border-gray-200 text-center text-gray-600">No eye test results found for this patient.</div>';
                }

                echo '</div>';
                $stmt->close();
            }
        } else {
            echo '<div class="container mx-auto px-4 sm:px-8 mt-4">';
            echo '<div class="py-8">';
            echo '<h2 class="text-2xl font-semibold leading-tight">No patient selected.</h2>';
            echo '</div>';
            echo '</div>';
        }
        ?>
        <a href="doctor_table.php" class="inline-block bg-blue-500 text-white px-4 py-2 rounded-md shadow hover:bg-blue-600 transition duration-200 mb-4">
        Back to Patients Table
    </a>
    </div>
    <?php include('doctor_homepage.php'); ?>
</main>
<!-- end: Main -->
