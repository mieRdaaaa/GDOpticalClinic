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

// Get the certificate ID from the query string
$certificate_id = intval($_GET['id'] ?? 0);

// Validate the certificate ID
if ($certificate_id <= 0) {
    die("Invalid certificate ID.");
}

// Fetch the certificate details
$certificate_sql = "SELECT * FROM certificate WHERE certificate_id = ?";
$stmt = $conn->prepare($certificate_sql);
$stmt->bind_param("i", $certificate_id);
$stmt->execute();
$certificate_result = $stmt->get_result();

if ($certificate_result->num_rows === 0) {
    die("Certificate not found.");
}

$certificate = $certificate_result->fetch_assoc();

// Fetch patient details based on the associated patient ID from the certificate
$patient_id = $certificate['patients_id']; // Assuming you have a patients_id in the certificate table
$patient_sql = "SELECT * FROM patients WHERE patients_id = ?";
$stmt = $conn->prepare($patient_sql);
$stmt->bind_param("i", $patient_id);
$stmt->execute();
$patient_result = $stmt->get_result();

if ($patient_result->num_rows > 0) {
    $patient = $patient_result->fetch_assoc();
} else {
    die("Patient not found.");
}

// Close the MySQLi connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate Details</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://unpkg.com/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="../images/ico.png" />
</head>

<body class="bg-gray-100">
<main class="w-full md:w-[calc(100%-256px)] md:ml-64 bg-gray-50 min-h-screen transition-all">
    <div class="py-2 px-6 bg-white flex items-center shadow-md sticky top-0 z-30">
        <button type="button" class="text-lg text-gray-600 sidebar-toggle">
            <i class="ri-menu-line"></i>
        </button>
        <ul class="flex items-center text-sm ml-4">
            <li class="mr-2">
                <a href="doctor_certificate.php" class="text-gray-400 hover:text-gray-600 font-medium">Certificate Details</a>
            </li>
            <li class="text-black-600 mr-2 font-medium">/</li>
            <li class="text-gray-600 mr-2 font-medium">View Existing Certificates</li>
            <li class="text-gray-600 mr-2 font-medium">/</li>
            <li class="text-black-600 mr-2 font-medium">View Details</li>
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

    <div class="results-container px-6 py-4">
        <h2 class="text-3xl font-semibold mb-4">View Certificate Details</h2>
        <div class="bg-white rounded-lg shadow p-4">
            <h3 class="text-xl font-semibold mb-4">Patient Details ID: <?php echo htmlspecialchars($certificate['certificate_id']); ?></h3>
            <table class="w-full border-collapse border border-blue-500 mt-4">
                <thead>
                    <tr class="bg-blue-500 text-white">
                        <th class="py-2 px-4 text-left">ID</th>
                        <th class="py-2 px-4 text-left">Last Name</th>
                        <th class="py-2 px-4 text-left">First Name</th>
                        <th class="py-2 px-4 text-left">Middle Name</th>
                        <th class="py-2 px-4 text-left">Gender</th>
                        <th class="py-2 px-4 text-left">Date of Birth</th>
                        <th class="py-2 px-4 text-left">Contact Number</th>
                        <th class="py-2 px-4 text-left">Medication History</th>
                        <th class="py-2 px-4 text-left">Date Added</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="bg-white border-b border-blue-500">
                        <td class="py-2 px-4"><?php echo htmlspecialchars($patient['patients_id']); ?></td>
                        <td class="py-2 px-4"><?php echo htmlspecialchars($patient['last_name']); ?></td>
                        <td class="py-2 px-4"><?php echo htmlspecialchars($patient['first_name']); ?></td>
                        <td class="py-2 px-4"><?php echo htmlspecialchars($patient['middle_name']); ?></td>
                        <td class="py-2 px-4"><?php echo htmlspecialchars($patient['gender']); ?></td>
                        <td class="py-2 px-4"><?php echo htmlspecialchars($patient['date_of_birth']); ?></td>
                        <td class="py-2 px-4"><?php echo htmlspecialchars($patient['contact_no']); ?></td>
                        <td class="py-2 px-4"><?php echo htmlspecialchars($patient['medication_history']); ?></td>
                        <td class="py-2 px-4"><?php echo htmlspecialchars($patient['date_added']); ?></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <h2 class="text-2xl font-semibold mb-4 mt-8"></h2>
        <div class="bg-white rounded-lg shadow p-4 border border-black-300">
    <h3 class="text-2xl font-semibold mb-4 flex justify-between items-center">
        Certificate Details ID: <?php echo htmlspecialchars($certificate['certificate_id']); ?>
        <div class="flex space-x-2">
            <a href="certificate.php?id=<?php echo htmlspecialchars($certificate['certificate_id']); ?>&patient_id=<?php echo htmlspecialchars($patient_id); ?>" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 text-lg">
                <i class="fas fa-file-download"></i> Generate
            </a>
            <a href="doctor_edit_certificate.php?id=<?php echo htmlspecialchars($certificate['certificate_id']); ?>" class="bg-green-500 text-white py-2 px-4 rounded hover:bg-blue-600 text-lg">
                <i class="fa fa-edit"></i> Edit
            </a>
        </div>
    </h3>
            <p><strong>Symptoms:</strong> <?php echo htmlspecialchars($certificate['symptoms']); ?></p>
            <p><strong>Examination:</strong> <?php echo htmlspecialchars($certificate['examination']); ?></p>
            <p><strong>Recommendation:</strong> <?php echo htmlspecialchars($certificate['recommendation']); ?></p>
            <p><strong>Osuva:</strong> <?php echo htmlspecialchars($certificate['osuva']); ?></p>
            <p><strong>Oduva:</strong> <?php echo htmlspecialchars($certificate['oduva']); ?></p>
            <p><strong>Osadd:</strong> <?php echo htmlspecialchars($certificate['osadd']); ?></p>
            <p><strong>Odadd:</strong> <?php echo htmlspecialchars($certificate['odadd']); ?></p>
            <p><strong>Odbcva:</strong> <?php echo htmlspecialchars($certificate['odbcva']); ?></p>
            <p><strong>Osbcva:</strong> <?php echo htmlspecialchars($certificate['osbcva']); ?></p>
            <p><strong>Eye Result ID:</strong> <?php echo htmlspecialchars($certificate['eye_result_id']); ?></p>
            <p><strong>Date Added:</strong> <?php echo htmlspecialchars($certificate['date_added']); ?></p>
        </div>

        <div class="action-buttons mt-6">
        </div>
        <a href="doctor_certificate_view.php?id=<?php echo $certificate['patients_id']; ?>" class="text-blue-500 hover:text-green-700 mt-4 inline-block">
            <i class="fas fa-arrow-left"></i> Back to Existing Certificates
        </a>
    </div>
</main>
<?php include('doctor_homepage.php'); ?>
<script src="https://unpkg.com/@popperjs/core@2"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="../dist/js/script.js"></script>
</body>
</html>
