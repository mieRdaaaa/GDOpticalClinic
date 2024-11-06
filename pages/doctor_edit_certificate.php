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

// Close the MySQLi connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Certificate</title>
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
            <li class="text-gray-600 mr-2 font-medium">Edit Certificate</li>
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
        <h2 class="text-3xl font-semibold mb-4">Edit Certificate ID: <?php echo htmlspecialchars($certificate['certificate_id']); ?></h2>
        <div class="bg-white rounded-lg shadow p-4 border border-black-300">
            <form action="doctor_update_certificate.php?id=<?php echo $certificate['certificate_id']; ?>" method="POST">
                <div class="mb-4">
                    <label for="symptoms" class="block text-lg font-medium text-gray-700">Symptoms:</label>
                    <textarea id="symptoms" name="symptoms" class="border border-black-300 rounded-md p-2 w-full text-lg" ><?php echo htmlspecialchars($certificate['symptoms']); ?></textarea>
                </div>
                <div class="mb-4">
                    <label for="examination" class="block text-lg font-medium text-gray-700">Examination:</label>
                    <textarea id="examination" name="examination" class="border border-black-300 rounded-md p-2 w-full text-lg" ><?php echo htmlspecialchars($certificate['examination']); ?></textarea>
                </div>
                <div class="mb-4">
                    <label for="recommendation" class="block text-lg font-medium text-gray-700">Recommendation:</label>
                    <textarea id="recommendation" name="recommendation" class="border border-black-300 rounded-md p-2 w-full text-lg" ><?php echo htmlspecialchars($certificate['recommendation']); ?></textarea>
                </div>
                <div class="mb-4">
                    <label for="osuva" class="block text-lg font-medium text-gray-700">Right/OD UVA:</label>
                    <input type="text" id="oduva" name="oduva" class="border border-black-300 rounded-md p-2 w-full text-lg" value="<?php echo htmlspecialchars($certificate['osuva']); ?>" >
                </div>
                <div class="mb-4">
                    <label for="oduva" class="block text-lg font-medium text-gray-700">Left/OD UVA:</label>
                    <input type="text" id="osuva" name="osuva" class="border border-black-300 rounded-md p-2 w-full text-lg" value="<?php echo htmlspecialchars($certificate['oduva']); ?>" >
                </div>
                <div class="mb-4">
                    <label for="osadd" class="block text-lg font-medium text-gray-700">Right/OD Reading Add:</label>
                    <input type="text" id="odadd" name="odadd" class="border border-black-300 rounded-md p-2 w-full text-lg" value="<?php echo htmlspecialchars($certificate['osadd']); ?>" >
                </div>
                <div class="mb-4">
                    <label for="odadd" class="block text-lg font-medium text-gray-700">Left/OS Reading Add:</label>
                    <input type="text" id="osadd" name="osadd" class="border border-black-300 rounded-md p-2 w-full text-lg" value="<?php echo htmlspecialchars($certificate['odadd']); ?>" >
                </div>
                <div class="mb-4">
                    <label for="odbcva" class="block text-lg font-medium text-gray-700">Right/OD Best Corrected Visual Activity:</label>
                    <input type="text" id="odbcva" name="odbcva" class="border border-black-300 rounded-md p-2 w-full text-lg" value="<?php echo htmlspecialchars($certificate['odbcva']); ?>" >
                </div>
                <div class="mb-4">
                    <label for="osbcva" class="block text-lg font-medium text-gray-700">Left/OS Best Corrected Visual Activity:</label>
                    <input type="text" id="osbcva" name="osbcva" class="border border-black-300 rounded-md p-2 w-full text-lg" value="<?php echo htmlspecialchars($certificate['osbcva']); ?>" >
                </div>
                <div class="action-buttons mt-6">
                    <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 text-lg">Update Certificate</button>
                </div>
            </form>
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
