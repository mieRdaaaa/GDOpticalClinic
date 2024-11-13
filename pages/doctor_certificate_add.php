<?php
include('db.php');

// User info
$user_fullname = '';
$user_role = '';

session_start(); // Start the session
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    // Prepare SQL statement to get user info
    $stmt = $conn->prepare("SELECT accounts_id, fullname, account_type FROM accounts WHERE username = ?");
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

// Get the patient's ID from the query string
$patient_id = intval($_GET['id'] ?? 0);

// Validate the patient_id
if ($patient_id <= 0) {
    die("Invalid patient ID.");
}

// Check if the patient exists
$check_patient_sql = "SELECT * FROM patients WHERE patients_id = ?";
$stmt = $conn->prepare($check_patient_sql);
$stmt->bind_param("i", $patient_id);
$stmt->execute();
$patient_result = $stmt->get_result();

if ($patient_result->num_rows === 0) {
    die("Patient ID does not exist.");
}

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $eye_result_id = $_POST['eye_result_id'];
    $symptoms = $_POST['symptoms'];
    $examination = $_POST['examination'];
    $recommendation = $_POST['recommendation'];
    $osuva = $_POST['osuva'];
    $oduva = $_POST['oduva'];
    $osadd = $_POST['osadd'];
    $odadd = $_POST['odadd'];
    $odbcva = $_POST['odbcva'];
    $osbcva = $_POST['osbcva'];
    $created_by = null;

        // Ensure only doctors can create the certificate
    if ($user_role === 'doctor') {
        // Use the logged-in doctor's ID (assumed to be $row['accounts_id'])
        $created_by = $row['accounts_id'];

        // Prepare and execute an SQL statement to insert data
        $sql = "INSERT INTO certificate (symptoms, examination, recommendation, osuva, oduva, osadd, odadd, odbcva, osbcva, patients_id, eye_result_id, created_by)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        // Prepare the statement
        $stmt = $conn->prepare($sql);
        // Bind parameters, including the patient_id, eye_result_id, and created_by (doctor's ID)
        $stmt->bind_param('ssssssssiiii', $symptoms, $examination, $recommendation, $osuva, $oduva, $osadd, $odadd, $odbcva, $osbcva, $patient_id, $eye_result_id, $created_by);

        // Execute the query and check if the insertion was successful
        if ($stmt->execute()) {
            // Redirect to the desired page after submission
            header("Location: doctor_certificate.php");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "Unauthorized action. Only doctors can add certificates.";
    }
}

// Fetch available eye results for the patient
$eye_result_options_sql = "SELECT eye_result_id, date_added FROM eye_result WHERE patients_id = ? ORDER BY date_added DESC";
$options_stmt = $conn->prepare($eye_result_options_sql);
$options_stmt->bind_param("i", $patient_id);
$options_stmt->execute();
$options_result = $options_stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate Add Form</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="../images/ico.png" />
</head>
<body>
    <!-- Start: Main -->
    <main class="w-full md:w-[calc(100%-256px)] md:ml-64 bg-gray-50 min-h-screen transition-all main">
        <div class="py-2 px-6 bg-white flex items-center shadow-md sticky top-0 z-30">
            <button type="button" class="text-lg text-gray-600 sidebar-toggle">
                <i class="ri-menu-line"></i>
            </button>
            <ul class="flex items-center text-sm ml-4">
                <li class="mr-2">
                    <a href="doctor_certificate.php" class="text-gray-400 hover:text-gray-600 font-medium">Medical Certificate</a>
                </li>
                <li class="text-black-600 mr-2 font-medium">/</li>
                <li class="text-black-600 mr-2 font-medium">Create Medical Report</li>
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

        <div class="max-w-full mx-auto mt-10 p-6 bg-white shadow-lg rounded-lg">
            <h2 class="text-2xl font-bold mb-4">Create Medical Report</h2>

            <form action="" method="POST">
                <div class="flex space-x-4 mb-4">
                    <div class="input-box w-full">
                        <label class="block text-sm font-semibold mb-1" for="eye_result_id">Select Eye Result:</label>
                        <select id="eye_result_id" name="eye_result_id" required class="block w-full border border-gray-300 bg-white rounded-md py-3 px-4 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            <option value="">--Select an eye result--</option>
                            <?php
                            if ($options_result->num_rows > 0) {
                                while ($row = $options_result->fetch_assoc()) {
                                    echo "<option value=\"" . htmlspecialchars($row['eye_result_id']) . "\" data-date=\"" . htmlspecialchars(date('Y-m-d', strtotime($row['date_added']))) . "\">" . htmlspecialchars(date('Y-m-d', strtotime($row['date_added']))) . "</option>";
                                }
                            } else {
                                echo "<option value=\"\">No eye results found</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="flex space-x-4 mb-4">
                    <div class="input-box w-1/2">
                        <label class="block text-sm font-semibold mb-1" for="symptoms">Symptoms:</label>
                        <input type="text" id="symptoms" name="symptoms" placeholder="Enter symptoms" class="block w-full border border-gray-300 bg-white rounded-md py-3 px-4 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    </div>

                    <div class="input-box w-1/2">
                        <label class="block text-sm font-semibold mb-1" for="examination">Examination:</label>
                        <input type="text" id="examination" name="examination" required placeholder="Enter examination results" class="block w-full border border-gray-300 bg-white rounded-md py-3 px-4 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    </div>
                </div>

                <div class="flex space-x-4 mb-4">
                    <div class="input-box w-full">
                        <label class="block text-sm font-semibold mb-1" for="recommendation">Recommendation:</label>
                        <textarea id="recommendation" name="recommendation" rows="6" required placeholder="Enter recommendations" class="block w-full border border-gray-300 bg-white rounded-md py-3 px-4 focus:outline-none focus:ring-2 focus:ring-indigo-500"></textarea>
                    </div>
                </div>

                <div class="flex space-x-4 mb-4">
                    <div class="input-box w-1/2">
                        <label class="block text-sm font-semibold mb-1" for="osuva">Right/OD UVA:</label>
                        <input type="text" id="oduva" name="oduva" placeholder="Enter Oduva" class="block w-full border border-gray-300 bg-white rounded-md py-3 px-4 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    </div>

                    <div class="input-box w-1/2">
                        <label class="block text-sm font-semibold mb-1" for="oduva">Left/OS UVA:</label>
                        <input type="text" id="osuva" name="osuva" placeholder="Enter Osuva" class="block w-full border border-gray-300 bg-white rounded-md py-3 px-4 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    </div>
                </div>

                <div class="flex space-x-4 mb-4">
                    <div class="input-box w-1/2">
                        <label class="block text-sm font-semibold mb-1" for="osadd">Right/OD Reading Add:</label>
                        <input type="text" id="odadd" name="odadd" placeholder="Enter Odadd" class="block w-full border border-gray-300 bg-white rounded-md py-3 px-4 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    </div>

                    <div class="input-box w-1/2">
                        <label class="block text-sm font-semibold mb-1" for="odadd">Left/OS Reading Add:</label>
                        <input type="text" id="osadd" name="osadd" placeholder="Enter Osadd" class="block w-full border border-gray-300 bg-white rounded-md py-3 px-4 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    </div>
                </div>

                <div class="flex space-x-4 mb-4">
                    <div class="input-box w-1/2">
                        <label class="block text-sm font-semibold mb-1" for="odbcva">Right/OD Best Corrected Visual Activity:</label>
                        <input type="text" id="odbcva" name="odbcva" placeholder="Enter Odbcva" class="block w-full border border-gray-300 bg-white rounded-md py-3 px-4 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    </div>

                    <div class="input-box w-1/2">
                        <label class="block text-sm font-semibold mb-1" for="osbcva">Left/OS Best Corrected Visual Activity:</label>
                        <input type="text" id="osbcva" name="osbcva" placeholder="Enter Osbcva" class="block w-full border border-gray-300 bg-white rounded-md py-3 px-4 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    </div>
                </div>

                <div class="flex justify-end mt-4">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">Submit</button>
                </div>
            </form>
        </div>
    </main>
    <!-- End: Main -->

    <script>
        // Optionally, you can add any JavaScript functionalities here
    </script>
</body>
</html>
<?php include('doctor_homepage.php'); ?>
<script src="https://unpkg.com/@popperjs/core@2"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="../dist/js/script.js"></script>
<?php
// Close the MySQLi connection
$conn->close();
?>
