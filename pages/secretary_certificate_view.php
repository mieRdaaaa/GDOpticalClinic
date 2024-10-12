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

// Get the patient's ID from the query string
$patient_id = intval($_GET['id'] ?? 0);

// Validate the patient_id
if ($patient_id <= 0) {
    die("Invalid patient ID.");
}

// Fetch existing certificates for the patient
$certificate_sql = "
    SELECT c.*, e.eye_result_id 
    FROM certificate c 
    LEFT JOIN eye_result e ON c.eye_result_id = e.eye_result_id 
    WHERE c.patients_id = ?
";
$stmt = $conn->prepare($certificate_sql);
$stmt->bind_param("i", $patient_id);
$stmt->execute();
$certificate_result = $stmt->get_result();

// Close the MySQLi connection
$conn->close();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Patient Details</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://unpkg.com/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="../images/ico.png" />
</head>
<body class="bg-gray-100">
<main class="w-full md:w-[calc(100%-256px)] md:ml-64 bg-gray-50 min-h-screen transition-all main">
    <div class="py-2 px-6 bg-white flex items-center shadow-md sticky top-0 z-30">
        <button type="button" class="text-lg text-gray-600 sidebar-toggle">
            <i class="ri-menu-line"></i>
        </button>
        <ul class="flex items-center text-sm ml-4">
            <li class="mr-2">
                <a href="secretary_certificate.php" class="text-gray-400 hover:text-gray-600 font-medium">Certificate</a>
            </li>
            <li class="text-black-600 mr-2 font-medium">/</li>
            <li class="text-black-600 mr-2 font-medium">View Existing Certificates</li>
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
        <h2 class="text-3xl font-semibold mb-4">Existing Certificates</h2>
        <?php if ($certificate_result->num_rows > 0): ?>
            <div class="overflow-x-auto bg-white rounded-lg shadow">
                <table class="min-w-full bg-white border border-gray-300">
                    <thead>
                        <tr class="bg-gray-200 text-gray-600 text-left text-lg uppercase font-semibold">
                            <th class="py-2 px-4">ID</th>
                            <th class="py-2 px-4">Symptoms</th>
                            <th class="py-2 px-4">Examination</th>
                            <th class="py-2 px-4">Recommendation</th>
                            <th class="py-2 px-4">Osuva</th>
                            <th class="py-2 px-4">Oduva</th>
                            <th class="py-2 px-4">Osadd</th>
                            <th class="py-2 px-4">Odadd</th>
                            <th class="py-2 px-4">Odbcva</th>
                            <th class="py-2 px-4">Osbcva</th>
                            <th class="py-2 px-4">Eye Result ID</th>
                            <th class="py-2 px-4">Date Added</th>
                            <th class="py-2 px-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $certificate_result->fetch_assoc()): ?>
                            <tr class="border-b border-gray-200 hover:bg-gray-100 text-xl">
                                <td class="py-2 px-4"><?php echo htmlspecialchars($row['certificate_id']); ?></td>
                                <td class="py-2 px-4"><?php echo htmlspecialchars($row['symptoms']); ?></td>
                                <td class="py-2 px-4"><?php echo htmlspecialchars($row['examination']); ?></td>
                                <td class="py-2 px-4"><?php echo htmlspecialchars($row['recommendation']); ?></td>
                                <td class="py-2 px-4"><?php echo htmlspecialchars($row['osuva']); ?></td>
                                <td class="py-2 px-4"><?php echo htmlspecialchars($row['oduva']); ?></td>
                                <td class="py-2 px-4"><?php echo htmlspecialchars($row['osadd']); ?></td>
                                <td class="py-2 px-4"><?php echo htmlspecialchars($row['odadd']); ?></td>
                                <td class="py-2 px-4"><?php echo htmlspecialchars($row['odbcva']); ?></td>
                                <td class="py-2 px-4"><?php echo htmlspecialchars($row['osbcva']); ?></td>
                                <td class="py-2 px-4"><?php echo htmlspecialchars($row['eye_result_id']); ?></td>
                                <td><?php echo htmlspecialchars($row['date_added']); ?></td>
                                <td class="py-2 px-4">
                                    
                                    <a href="secretary_certificate_details.php?id=<?php echo $row['certificate_id']; ?>" class="text-green-500 hover:text-green-700 ml-2">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <p class="text-gray-500">No existing certificates found for this patient.</p>
        <?php endif; ?>
    </div>
</main>
<?php include('secretary_homepage.php'); ?>
<script src="https://unpkg.com/@popperjs/core@2"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="../dist/js/script.js"></script>
</body>
</html>
