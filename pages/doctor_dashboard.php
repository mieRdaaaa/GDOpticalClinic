<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gdoptical_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the number of patients added today
$result = $conn->query("SELECT COUNT(*) as count FROM patients WHERE DATE(date_added) = CURDATE()");
if ($result) {
    $patients_today = $result->fetch_assoc()['count'];
} else {
    die("Error retrieving patients today: " . $conn->error);
}

// Get the number of patients added yesterday
$result = $conn->query("SELECT COUNT(*) as count FROM patients WHERE DATE(date_added) = CURDATE() - INTERVAL 1 DAY");
if ($result) {
    $patients_yesterday = $result->fetch_assoc()['count'];
} else {
    die("Error retrieving patients yesterday: " . $conn->error);
}

// Get the total number of patients
$result = $conn->query("SELECT COUNT(*) as count FROM patients");
if ($result) {
    $total_patients = $result->fetch_assoc()['count'];
} else {
    die("Error retrieving total patients: " . $conn->error);
}

$conn->close();

// userinfo
session_start();
include 'db.php';

$user_fullname = '';
$user_role = '';
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $sql = "SELECT fullname, account_type FROM accounts WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $user_fullname = $row['fullname'];
        $user_role = $row['account_type'];
    }
} else {
    header("Location: login.php");
    exit();
}
// Retrieve the latest 5 patients for the "Newly Added Patients" list
$sql = "SELECT first_name, middle_name, last_name, gender, date_added FROM patients ORDER BY date_added DESC LIMIT 10";
$result = $conn->query($sql);

$newly_added_patients = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $newly_added_patients[] = [
            'name' => $row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name'],
            'gender' => $row['gender'],
            'date_added' => $row['date_added']
        ];
    }
} else {
    echo "Error retrieving recent patients: " . $conn->error;
}

?>
<head>
    <link rel="shortcut icon" href="../images/ico.png" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
    <link href="https://unpkg.com/tailwindcss/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://unpkg.com/remixicon/fonts/remixicon.css"></script>
    <link href="https://afeld.github.io/emoji-css/emoji.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js" integrity="sha256-xKeoJ50pzbUGkpQxDYHD7o7hxe0LaOGeguUidbq6vis=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://unpkg.com/tailwindcss@2.2.19/dist/tailwind.min.css"/>
</head>
<!-- start: Main -->
<main class="w-full md:w-[calc(100%-256px)] md:ml-64 bg-gray-50 min-h-screen transition-all main">
    <div class="py-2 px-6 bg-white flex items-center shadow-md shadow-black/5 sticky top-0 left-0 z-30">
        <!-- Left side (menu button and breadcrumbs) -->
        <button type="button" class="text-lg text-gray-600 sidebar-toggle">
            <i class="ri-menu-line"></i>
        </button>
        <ul class="flex items-center text-sm ml-4">
            <li class="mr-2">
                <a href="#" class="text-gray-400 hover:text-gray-600 font-medium">Dashboard</a>
            </li>
            <li class="text-gray-600 mr-2 font-medium">/</li>
            <li class="text-gray-600 mr-2 font-medium">Analytics</li>
        </ul>

        <!-- Right side (profile image, name, and role) -->
        <div class="ml-auto flex items-center">
            <!-- Profile Image -->
            <div class="dropdown ml-3">
                <button type="button" class="dropdown-toggle flex items-center">
                    <img src="../images/profile.png" alt="Profile Image" class="w-8 h-8 rounded-full block object-cover">
                </button>
                <ul class="dropdown-menu shadow-md shadow-black/5 z-30 hidden py-1.5 rounded-md bg-white border border-gray-100 w-full max-w-[140px]">
                    <li>
                        <a href="../index.php" class="flex items-center text-[13px] py-1.5 px-4 text-gray-600 hover:text-blue-500 hover:bg-black-50">Logout</a>
                    </li>
                </ul>
            </div>

            <!-- User Details -->
            <div class="user-details ml-3">
                <span class="name text-sm font-semibold text-grey-900 block"><?php echo $user_fullname; ?></span>
                <span class="role text-xs text-grey-500"><?php echo ucwords($user_role); ?></span>
            </div>

        </div>
    </div>

    <div class="p-6">
    <!-- Dashboard Header with Flexbox Alignment -->
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-3xl font-semibold text-gray-800">Dashboard</h1>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
        <!-- Metric Card for Patients Today -->
        <div class="bg-gradient-to-b from-blue-200 to-blue-100 border-b-4 border-blue-600 rounded-lg shadow-xl p-5 flex flex-col justify-between">
            <div class="flex flex-row items-center">
                <div class="flex-shrink pr-4">
                    <div class="rounded-full p-5 bg-blue-600"><i class="fas fa-user fa-2x fa-inverse"></i></div>
                </div>
                <div class="flex-1 text-right md:text-center">
                    <h5 class="font-bold uppercase text-gray-600">Patients Today</h5>
                    <h3 class="font-bold text-3xl">
                        <?php echo $patients_today; ?> 
                        <span class="text-sm text-green-500 font-bold">
                            <?php 
                            $patients_today_percentage = $total_patients > 0 ? ($patients_today / $total_patients) * 100 : 0; 
                            echo round($patients_today_percentage, 2) . '% +'; 
                            ?>
                        </span>
                    </h3>
                </div>
            </div>
        </div>

        <!-- Metric Card for Patients Yesterday with Indigo Colors -->
        <div class="bg-gradient-to-b from-indigo-200 to-indigo-100 border-b-4 border-indigo-600 rounded-lg shadow-xl p-5 flex flex-col justify-between">
            <div class="flex flex-row items-center">
                <div class="flex-shrink pr-4">
                    <div class="rounded-full p-5 bg-indigo-600"><i class="fas fa-user fa-2x fa-inverse"></i></div>
                </div>
                <div class="flex-1 text-right md:text-center">
                    <h5 class="font-bold uppercase text-gray-600">Patients Yesterday</h5>
                    <h3 class="font-bold text-3xl">
                        <?php echo $patients_yesterday; ?> 
                        <span class="text-sm text-green-500 font-bold">
                            <?php 
                            $patients_yesterday_percentage = $total_patients > 0 ? ($patients_yesterday / $total_patients) * 100 : 0; 
                            echo round($patients_yesterday_percentage, 2) . '% +'; 
                            ?>
                        </span>
                    </h3>
                </div>
            </div>
        </div>

        <!-- Metric Card for Total Patients -->
        <div class="bg-gradient-to-b from-green-200 to-green-100 border-b-4 border-green-600 rounded-lg shadow-xl p-5 flex flex-col justify-between">
            <div class="flex flex-row items-center">
                <div class="flex-shrink pr-4">
                    <div class="rounded-full p-5 bg-green-600"><i class="fas fa-user fa-2x fa-inverse"></i></div>
                </div>
                <div class="flex-1 text-right md:text-center">
                    <h5 class="font-bold uppercase text-gray-600">Total Patients</h5>
                    <h3 class="font-bold text-3xl">
                        <?php echo $total_patients; ?> 
                        <span class="text-sm text-green-500"></span>
                    </h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Patient Comparison (Today vs. Yesterday) and Newly Added Patients -->
    <div class="flex gap-x-4 mt-6 w-full">
        <!-- Patient Comparison with Reduced Height -->
        <div class="bg-white p-6 rounded-lg shadow-md w-2/3" style="height: 38rem;">  <!-- Set height to 64 units -->
            <h2 class="text-lg font-semibold mb-4">
                <i class="ri-line-chart-fill text-2xl mr-2"></i>
                Patient Insights: Comparing Today and Yesterday
            </h2>
            <canvas id="patientChart" style="max-width: 100%; height: 100%;"></canvas>
        </div>

        <!-- Newly Added Patients List -->
        <div class="bg-white p-6 rounded-lg shadow-md w-1/3 h-2/3">
            <h2 class="text-lg font-semibold mb-4">
                <i class="ri-user-add-fill mr-2"></i> Newly Added Patients
            </h2>
            <ul>
                <?php foreach ($newly_added_patients as $patient): ?>
                    <li class="flex items-center mb-2 border-b border-gray-200 pb-2">
                        <img src="../images/<?php echo (strtolower($patient['gender']) === 'male' ? 'male_patient.png' : 'female_patient.png'); ?>" 
                             alt="Patient Photo" 
                             class="w-8 h-8 rounded-full mr-3">
                        <div class="flex items-center justify-between flex-grow">
                            <div class="flex items-center">
                                <p class="font-semibold"><?php echo htmlspecialchars($patient['name']); ?></p>
                                <span class="bg-red-500 text-white text-xs font-semibold rounded-full px-1 py-0.5 ml-2">NEW</span>
                            </div>
                            <p class="text-xs text-gray-500"><?php echo htmlspecialchars($patient['date_added']); ?></p>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>




<!-- Add this script at the bottom before closing the body -->
<script>
    const ctx = document.getElementById('patientChart').getContext('2d');
    const patientChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Yesterday', 'Today'],
            datasets: [{
                label: 'Number of Patients',
                data: [<?php echo $patients_yesterday; ?>, <?php echo $patients_today; ?>],
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 2,
                fill: true
            }]
        },
        options: {
    responsive: true,
    maintainAspectRatio: true,
    scales: {
        y: {
            beginAtZero: true,
            title: {
                display: true,
                text: 'Number of Patients'
            },
            ticks: {
                stepSize: 1, // Set step size to 1 for Y-axis
                min: 0, // Set minimum value
                max: 50, // Set maximum value
            },
            afterBuildTicks: function(scale) {
                // Generate ticks from 0 to 50 in steps of 1
                scale.ticks = Array.from({ length: 51 }, (_, i) => i);
            }
        },
        x: {
            title: {
                display: true,
                text: 'Days'
            }
        }
    }
}

    });
</script>

    </main>
    <?php include('doctor_homepage.php'); ?>
    <!-- end: Main -->