<?php
// Include your database connection file
include('db.php');

<<<<<<< HEAD
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Fetch the patient record based on the ID
    $sql = "SELECT * FROM patients WHERE patients_id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $patient = $result->fetch_assoc();
    } else {
        echo "Record not found";
        exit;
    }

    // Fetch all eye results for the patient, including the diagnosis
    $sql_eye_results = "SELECT * FROM eye_result WHERE patients_id = $id ORDER BY date_added DESC";
    $eye_results_result = $conn->query($sql_eye_results);

    if ($eye_results_result === false) {
        echo "Error fetching eye results";
        exit;
    }
} else {
    echo "Invalid request";
    exit;
}

=======
>>>>>>> d79df6df0a6e12abde2dc54bafd0f13dd8f0045e
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

<<<<<<< HEAD
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Patient History</title>
    <link rel="shortcut icon" href="../images/ico.png" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
<main class="w-full md:w-[calc(100%-256px)] md:ml-64 bg-gray-50 min-h-screen transition-all">
=======
<!-- Start: Main -->
<link rel="shortcut icon" href="../images/ico.png" />
<main class="w-full md:w-[calc(100%-256px)] md:ml-64 bg-gray-50 min-h-screen transition-all main">
>>>>>>> d79df6df0a6e12abde2dc54bafd0f13dd8f0045e
    <div class="py-2 px-6 bg-white flex items-center shadow-md sticky top-0 z-30">
        <button type="button" class="text-lg text-gray-600 sidebar-toggle">
            <i class="ri-menu-line"></i>
        </button>
        <ul class="flex items-center text-sm ml-4">
            <li class="mr-2">
                <a href="secretary_view.php" class="text-gray-400 hover:text-gray-600 font-medium">Eye Test Results</a>
            </li>
            <li class="text-gray-600 mr-2 font-medium">/</li>
<<<<<<< HEAD
            <li class="text-gray-600 mr-2 font-medium">Results</li>
=======
            <li class="text-black-600 mr-2 font-medium">View Patient Details</li>
>>>>>>> d79df6df0a6e12abde2dc54bafd0f13dd8f0045e
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
<<<<<<< HEAD
    <div class="container mx-auto px-4 py-8">
        <h2 class="text-2xl font-bold mb-4">Patient Details</h2>
        <table class="w-full border-collapse border border-blue-500 mt-4 mx-auto">
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
                    <td class="py-2 px-4"><?php echo $patient['patients_id']; ?></td>
                    <td class="py-2 px-4"><?php echo $patient['last_name']; ?></td>
                    <td class="py-2 px-4"><?php echo $patient['first_name']; ?></td>
                    <td class="py-2 px-4"><?php echo $patient['middle_name']; ?></td>
                    <td class="py-2 px-4"><?php echo $patient['gender']; ?></td>
                    <td class="py-2 px-4"><?php $date = new DateTime($patient['date_of_birth']); echo $date->format('F j, Y'); ?> </td>
                    <td class="py-2 px-4"><?php echo $patient['contact_no']; ?></td>
                    <td class="py-2 px-4"><?php echo $patient['medication_history']; ?></td>
                    <td class="py-2 px-4"><?php echo date("F j, Y", strtotime($patient['date_added'])); ?></td>
                </tr>
            </tbody>
        </table>
        
        <h2 class="text-2xl font-bold mt-8">Previous Eye Results</h2>
<div class="mt-4">
    <label for="date-selector" class="block mb-2 text-lg font-semibold">Select Date</label>
    <select id="date-selector" class="form-select block w-full bg-white border border-gray-300 p-2 rounded-md">
        <option value="none" selected>Select a Date</option>
        <?php while ($eye_row = $eye_results_result->fetch_assoc()): ?>
            <option value="<?php echo $eye_row['date_added']; ?>"><?php echo date("F j, Y", strtotime($eye_row['date_added'])); ?></option>
        <?php endwhile; ?>
    </select>
</div>


<div class="grid sm:grid-cols-1 gap-8 mt-4">
    <?php
    // Re-fetch the eye results and display them
    $eye_results_result->data_seek(0); // Reset the pointer to the beginning of the result set
    if ($eye_results_result->num_rows > 0): 
        while ($eye_row = $eye_results_result->fetch_assoc()):
    ?>
            <div class="eye-result-box border p-6 mb-4 bg-white shadow-md rounded" data-date="<?php echo $eye_row['date_added']; ?>" style="display: none;">
                <h3 class="text-lg font-semibold text-gray-800">Displaying Eye Results from: <?php echo date("F j, Y", strtotime($eye_row['date_added'])); ?></h3>
                
                <div class="border p-6 bg-gray-50 rounded-lg mt-4">
                    <div class="grid sm:grid-cols-2 gap-8 mt-4">
                        <div>
                            <!-- Right Sphere Box -->
                            <div class="border p-4 mb-4 bg-white rounded shadow-sm">
                                <p class="text-lg text-gray-700"><strong>Left Sphere:</strong> <?php echo $eye_row['l_sphere']; ?></p>
                            </div>
                            
                            <!-- Left Sphere Box -->
                            <div class="border p-4 mb-4 bg-white rounded shadow-sm">
                                <p class="text-lg text-gray-700"><strong>Left Cylinder:</strong> <?php echo $eye_row['l_cylinder']; ?></p>
                            </div>

                            <div class="border p-4 mb-4 bg-white rounded shadow-sm">
                                <p class="text-lg text-gray-700"><strong>Left Axis:</strong> <?php echo $eye_row['l_axis']; ?></p>
                            </div>

                            <div class="border p-4 mb-4 bg-white rounded shadow-sm">
                                <p class="text-lg text-gray-700"><strong>Pupillary Distance:</strong> <?php echo $eye_row['pd']; ?></p>
                            </div>

                            <div class="border p-4 mb-4 bg-white rounded shadow-sm">
                                <p class="text-lg text-gray-700"><strong>Other Conditions:</strong> <?php echo $eye_row['other_conditions']; ?></p>
                            </div>
                        </div>
                        
                        <!-- Additional Result Information -->
                        <div>
                            <div class="border p-4 mb-4 bg-white rounded shadow-sm">
                                <p class="text-lg text-gray-700"><strong>Right Sphere:</strong> <?php echo $eye_row['r_sphere']; ?></p>
                            </div>
                            
                            <div class="border p-4 mb-4 bg-white rounded shadow-sm">
                                <p class="text-lg text-gray-700"><strong>Right Cylinder:</strong> <?php echo $eye_row['r_cylinder']; ?></p>
                            </div>

                            <div class="border p-4 mb-4 bg-white rounded shadow-sm">
                                <p class="text-lg text-gray-700"><strong>Right Axis:</strong> <?php echo $eye_row['r_axis']; ?></p>
                            </div>
                            
                            <div class="border p-4 mb-4 bg-white rounded shadow-sm">
                                <p class="text-lg text-gray-700"><strong>Diagnosis:</strong> <?php echo $eye_row['diagnosis']; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    <?php 
        endwhile;
    else:
    ?>
        <div class="text-center text-xl text-gray-600">
            <p>No previous eye results found</p>
        </div>
    <?php endif; ?>
</div>

    
</div>
</main>
<?php include('secretary_homepage.php'); ?>
<script>
    document.getElementById('date-selector').addEventListener('change', function() {
        const selectedDate = this.value;
        const results = document.querySelectorAll('.eye-result-box');
        results.forEach(function(result) {
            if (result.dataset.date === selectedDate) {
                result.style.display = 'block';
            } else {
                result.style.display = 'none';
            }
        });
    });
</script>


</body>
</html>
=======

    <!-- Patient Details Section -->
    <div class="container mx-auto px-4 sm:px-8 mt-4">
        
        <?php
        if (isset($_GET['id'])) {
            $patients_id = $_GET['id'];

            // Retrieve patient details first
            $patient_query = "SELECT * FROM patients WHERE patients_id = ?";
            if ($patient_stmt = $conn->prepare($patient_query)) {
                $patient_stmt->bind_param('i', $patients_id);
                $patient_stmt->execute();
                $patient_result = $patient_stmt->get_result();
                
                if ($patient_row = $patient_result->fetch_assoc()) {
                    echo '<div class="results-container px-6 py-4">';
                    echo '<h3 class="text-xl font-semibold mb-4">Patient Details ID: ' . htmlspecialchars($patient_row['patients_id']) . '</h3>';
                    echo '<table class="w-full border-collapse border border-blue-500 mt-4">';
                    echo '<thead>';
                    echo '<tr class="bg-blue-500 text-white">';
                    echo '<th class="py-2 px-4 text-left">ID</th>';
                    echo '<th class="py-2 px-4 text-left">Last Name</th>';
                    echo '<th class="py-2 px-4 text-left">First Name</th>';
                    echo '<th class="py-2 px-4 text-left">Middle Name</th>';
                    echo '<th class="py-2 px-4 text-left">Gender</th>';
                    echo '<th class="py-2 px-4 text-left">Date of Birth</th>';
                    echo '<th class="py-2 px-4 text-left">Contact Number</th>';
                    echo '<th class="py-2 px-4 text-left">Medication History</th>';
                    echo '<th class="py-2 px-4 text-left">Date Added</th>';
                    echo '</tr>';
                    echo '</thead>';
                    echo '<tbody>';
                    echo '<tr class="bg-white border-b border-blue-500">';
                    echo '<td class="py-2 px-4">' . htmlspecialchars($patient_row['patients_id']) . '</td>';
                    echo '<td class="py-2 px-4">' . htmlspecialchars($patient_row['last_name']) . '</td>';
                    echo '<td class="py-2 px-4">' . htmlspecialchars($patient_row['first_name']) . '</td>';
                    echo '<td class="py-2 px-4">' . htmlspecialchars($patient_row['middle_name']) . '</td>';
                    echo '<td class="py-2 px-4">' . htmlspecialchars($patient_row['gender']) . '</td>';
                    echo '<td class="py-2 px-4">' . htmlspecialchars($patient_row['date_of_birth']) . '</td>';
                    echo '<td class="py-2 px-4">' . htmlspecialchars($patient_row['contact_no']) . '</td>';
                    echo '<td class="py-2 px-4">' . htmlspecialchars($patient_row['medication_history']) . '</td>';
                    echo '<td class="py-2 px-4">' . htmlspecialchars($patient_row['date_added']) . '</td>';
                    echo '</tr>';
                    echo '</tbody>';
                    echo '</table>';
                    echo '</div>';
                } else {
                    echo '<div class="container mx-auto px-4 sm:px-8 mt-4">';
                    echo '<div class="py-8">';
                    echo '<h2 class="text-2xl font-semibold leading-tight">Patient not found.</h2>';
                    echo '</div>';
                    echo '</div>';
                }

                $patient_stmt->close();
            }

            // Now retrieve the eye test results
            $query = "SELECT * FROM eye_result WHERE patients_id = ? ORDER BY date_added DESC LIMIT 1";

            if ($stmt = $conn->prepare($query)) {
                $stmt->bind_param('i', $patients_id); 
                $stmt->execute();
                $result = $stmt->get_result();

// Eye Test Results Section
echo '<div class="mx-4 md:mx-10 mt-4">';  // Add some space for title
echo '<h2 class="text-2xl font-semibold text-gray-800 mb-4">Eye Test Results</h2>'; // Title above the section
echo '<div class="shadow-lg rounded-lg overflow-hidden bg-white p-4 grid grid-cols-1 md:grid-cols-2 gap-4">';



if ($row = $result->fetch_assoc()) {
    // Left side: Right Sphere, Left Sphere, Right Axis, Left Axis, Right Cylinder
    echo '<div class="space-y-4">';  // Start left column

    // Right Sphere
    echo '<div class="mb-4">';
    echo '<p class="text-lg text-gray-700"><strong>Right Sphere:</strong></p>';
    echo '<div class="border p-4 bg-white rounded shadow-sm">';
    echo '<p class="text-lg text-gray-700">' . htmlspecialchars($row['r_sphere']) . '</p>';
    echo '</div>';
    echo '</div>';

    // Left Sphere
    echo '<div class="mb-4">';
    echo '<p class="text-lg text-gray-700"><strong>Left Sphere:</strong></p>';
    echo '<div class="border p-4 bg-white rounded shadow-sm">';
    echo '<p class="text-lg text-gray-700">' . htmlspecialchars($row['l_sphere']) . '</p>';
    echo '</div>';
    echo '</div>';

    // Right Axis
    echo '<div class="mb-4">';
    echo '<p class="text-lg text-gray-700"><strong>Right Axis:</strong></p>';
    echo '<div class="border p-4 bg-white rounded shadow-sm">';
    echo '<p class="text-lg text-gray-700">' . htmlspecialchars($row['r_axis']) . '</p>';
    echo '</div>';
    echo '</div>';

    // Left Axis
    echo '<div class="mb-4">';
    echo '<p class="text-lg text-gray-700"><strong>Left Axis:</strong></p>';
    echo '<div class="border p-4 bg-white rounded shadow-sm">';
    echo '<p class="text-lg text-gray-700">' . htmlspecialchars($row['l_axis']) . '</p>';
    echo '</div>';
    echo '</div>';

    // Right Cylinder
    echo '<div class="mb-4">';
    echo '<p class="text-lg text-gray-700"><strong>Right Cylinder:</strong></p>';
    echo '<div class="border p-4 bg-white rounded shadow-sm">';
    echo '<p class="text-lg text-gray-700">' . htmlspecialchars($row['r_cylinder']) . '</p>';
    echo '</div>';
    echo '</div>';

    echo '</div>'; // End left column

    // Right side: Left Cylinder, Pupillary Distance, Diagnosis, Other Conditions
    echo '<div class="space-y-4">';  // Start right column

    // Left Cylinder
    echo '<div class="mb-4">';
    echo '<p class="text-lg text-gray-700"><strong>Left Cylinder:</strong></p>';
    echo '<div class="border p-4 bg-white rounded shadow-sm">';
    echo '<p class="text-lg text-gray-700">' . htmlspecialchars($row['l_cylinder']) . '</p>';
    echo '</div>';
    echo '</div>';

    // Pupillary Distance
    echo '<div class="mb-4">';
    echo '<p class="text-lg text-gray-700"><strong>Pupillary Distance:</strong></p>';
    echo '<div class="border p-4 bg-white rounded shadow-sm">';
    echo '<p class="text-lg text-gray-700">' . htmlspecialchars($row['pd']) . '</p>';
    echo '</div>';
    echo '</div>';

    // Diagnosis
    echo '<div class="mb-4">';
    echo '<p class="text-lg text-gray-700"><strong>Diagnosis:</strong></p>';
    echo '<div class="border p-4 bg-white rounded shadow-sm">';
    echo '<p class="text-lg text-gray-700">' . htmlspecialchars($row['diagnosis']) . '</p>';
    echo '</div>';
    echo '</div>';

    // Other Conditions
    echo '<div class="mb-4">';
    echo '<p class="text-lg text-gray-700"><strong>Other Conditions:</strong></p>';
    echo '<div class="border p-4 bg-white rounded shadow-sm">';
    echo '<p class="text-lg text-gray-700">' . htmlspecialchars($row['other_conditions']) . '</p>';
    echo '</div>';
    echo '</div>';

    echo '</div>'; // End right column



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

        <a href="secretary_table.php" class="inline-block bg-blue-500 text-white px-4 py-2 rounded-md shadow hover:bg-blue-600 transition duration-200 mb-4">
            Back to Patients List
        </a>
    </div>
    <?php include('secretary_homepage.php'); ?>
</main>
<!-- end: Main -->
>>>>>>> d79df6df0a6e12abde2dc54bafd0f13dd8f0045e
