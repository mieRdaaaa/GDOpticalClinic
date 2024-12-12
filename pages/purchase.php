<?php
include('db.php'); // Include database connection

date_default_timezone_set('Asia/Manila');
session_start(); // Start the session

// User info
$user_fullname = '';
$user_role = '';

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

$patient = null; // Initialize the patient variable as null

// Check if the 'id' parameter exists in the URL
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    if ($id <= 0) {
        echo "Invalid ID provided.";
        exit();
    }

    // Fetch the patient record based on the ID
    $sql = "SELECT * FROM patients WHERE patients_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id); // Use "i" for integer binding
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $patient = $result->fetch_assoc(); // Store the patient data
    } else {
        echo "Record not found.";
        exit();
    }
    $stmt->close();
} else {
    echo "No patient ID provided.";
    exit();
}

// Get the patient ID from the fetched data
$patients_id = $patient['patients_id']; 

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate input values
    $product_name = trim($_POST['product_name']);
    $price = floatval($_POST['price']);
    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $middle_name = trim($_POST['middle_name']);
    $date_added = date("Y-m-d H:i:s");

    // Prepare and bind the statement to insert service record
    $stmt = $conn->prepare("INSERT INTO services (product_name, price, patients_id, first_name, last_name, middle_name, date_added) 
                            VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sdsssss", $product_name, $price, $patients_id, $first_name, $last_name, $middle_name, $date_added); // Bind patient details

    // Execute the statement and check if successful
    if ($stmt->execute()) {
        $_SESSION['message'] = "Successfully added $product_name for $first_name $last_name.";
    } else {
        $_SESSION['message'] = "Error: " . $stmt->error;
    }

    $stmt->close();
    header("Location: " . $_SERVER['PHP_SELF'] . "?id=" . $patients_id); // Redirect to the same page with patient ID
    exit();
}

// Set the time zone for the MySQL session
$conn->query("SET time_zone = '+08:00';");

// Close the connection
$conn->close();

// Check if there is a message to display
$message = isset($_SESSION['message']) ? $_SESSION['message'] : '';
unset($_SESSION['message']); // Clear the message after displaying it
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Services</title>
    <link rel="shortcut icon" href="../images/ico.png" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
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
                <a href="#" class="text-gray-600 hover:text-gray-600 font-medium">Services</a>
            </li>
            <li class="text-gray-600 mr-2 font-medium">/</li>
            <li class="text-gray-600 mr-2 font-medium">View Patient Details</li>
            <li class="text-gray-600 mr-2 font-medium">/</li>
            <li class="text-black-600 mr-2 font-medium">Services</li>
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
        <td class="py-2 px-4"><?php echo htmlspecialchars($patient['patients_id']); ?></td>
        <td class="py-2 px-4"><?php echo htmlspecialchars($patient['last_name']); ?></td>
        <td class="py-2 px-4"><?php echo htmlspecialchars($patient['first_name']); ?></td>
        <td class="py-2 px-4"><?php echo htmlspecialchars($patient['middle_name']); ?></td>
        <td class="py-2 px-4"><?php echo htmlspecialchars($patient['gender']); ?></td>
        <td class="py-2 px-4">
            <?php
            // Format date_of_birth properly
            $date = new DateTime($patient['date_of_birth']);
            echo $date->format('F j, Y');
            ?>
        </td>
        <td class="py-2 px-4"><?php echo htmlspecialchars($patient['contact_no']); ?></td>
        <td class="py-2 px-4"><?php echo htmlspecialchars($patient['medication_history']); ?></td>
        <td class="py-2 px-4"><?php echo date("F j, Y", strtotime($patient['date_added'])); ?></td>
    </tr>
</tbody>

        </table>

    <div class="container mx-auto my-6 p-6 bg-white rounded-md shadow-md">
    <h2 class="text-3xl font-semibold mb-4">Optical Accessories & Services</h2>
    
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <!-- Product Card for Nosepads -->
<form action="" method="POST" class="bg-gray-100 p-4 rounded-lg shadow mb-4">
    <h3 class="text-lg font-bold">Nosepads</h3>
    <p class="text-sm text-gray-600">High-quality, soft, and comfortable nosepads.</p>
    <div class="flex items-center mb-4">
        <label class="text-sm font-semibold text-gray-900 mr-2">Price:</label>
        <input type="number" name="price" placeholder="₱20.00" class="border rounded-md p-1 w-24" required />
    </div>
    <input type="hidden" name="product_name" value="Nosepads">
    <input type="hidden" name="patients_id" value="<?php echo htmlspecialchars($patient['patients_id']); ?>">
    <button type="submit" class="mt-2 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Submit</button>
</form>

<!-- Product Card for Frame Adjustments -->
<form action="" method="POST" class="bg-gray-100 p-4 rounded-lg shadow mb-4">
    <h3 class="text-lg font-bold">Frame Adjustments</h3>
    <p class="text-sm text-gray-600">Professional frame alignment and adjustments.</p>
    <div class="flex items-center mb-4">
        <label class="text-sm font-semibold text-gray-900 mr-2">Price:</label>
        <input type="number" name="price" placeholder="₱500.00" class="border rounded-md p-1 w-24" required />
    </div>
    <input type="hidden" name="product_name" value="Frame Adjustments">
    <input type="hidden" name="patients_id" value="<?php echo htmlspecialchars($patient['patients_id']); ?>">
    <button type="submit" class="mt-2 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Submit</button>
</form>

<!-- Product Card for Lens Color Change -->
<form action="" method="POST" class="bg-gray-100 p-4 rounded-lg shadow mb-4">
    <h3 class="text-lg font-bold">Lens Color Change</h3>
    <p class="text-sm text-gray-600">Wide range of lens colors to suit your style.</p>
    <div class="flex items-center mb-4">
        <label class="text-sm font-semibold text-gray-900 mr-2">Price:</label>
        <input type="number" name="price" placeholder="₱500.00" class="border rounded-md p-1 w-24" required />
    </div>
    <input type="hidden" name="product_name" value="Lens Color Change">
    <input type="hidden" name="patients_id" value="<?php echo htmlspecialchars($patient['patients_id']); ?>">
    <button type="submit" class="mt-2 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Submit</button>
</form>

<!-- Product Card for Cords & Straps -->
<form action="" method="POST" class="bg-gray-100 p-4 rounded-lg shadow mb-4">
    <h3 class="text-lg font-bold">Cords and Straps</h3>
    <p class="text-sm text-gray-600">Stylish and durable cords for your eyewear.</p>
    <div class="flex items-center mb-4">
        <label class="text-sm font-semibold text-gray-900 mr-2">Price:</label>
        <input type="number" name="price" placeholder="₱100.00" class="border rounded-md p-1 w-24" required />
    </div>
    <input type="hidden" name="product_name" value="Cords and Straps">
    <input type="hidden" name="patients_id" value="<?php echo htmlspecialchars($patient['patients_id']); ?>">
    <button type="submit" class="mt-2 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Submit</button>
</form>

<!-- Product Card for Cleaning Cloths -->
<form action="" method="POST" class="bg-gray-100 p-4 rounded-lg shadow mb-4">
    <h3 class="text-lg font-bold">Cleaning Cloths</h3>
    <p class="text-sm text-gray-600">Soft and effective microfiber cleaning cloths.</p>
    <div class="flex items-center mb-4">
        <label class="text-sm font-semibold text-gray-900 mr-2">Price:</label>
        <input type="number" name="price" placeholder="₱10.00" class="border rounded-md p-1 w-24" required />
    </div>
    <input type="hidden" name="product_name" value="Cleaning Cloths">
    <input type="hidden" name="patients_id" value="<?php echo htmlspecialchars($patient['patients_id']); ?>">
    <button type="submit" class="mt-2 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Submit</button>
</form>

<!-- Product Card for Protective Casing -->
<form action="" method="POST" class="bg-gray-100 p-4 rounded-lg shadow mb-4">
    <h3 class="text-lg font-bold">Protective Casing</h3>
    <p class="text-sm text-gray-600">Durable cases to keep your eyewear safe.</p>
    <div class="flex items-center mb-4">
        <label class="text-sm font-semibold text-gray-900 mr-2">Price:</label>
        <input type="number" name="price" placeholder="₱150.00" class="border rounded-md p-1 w-24" required />
    </div>
    <input type="hidden" name="product_name" value="Protective Casing">
    <input type="hidden" name="patients_id" value="<?php echo htmlspecialchars($patient['patients_id']); ?>">
    <button type="submit" class="mt-2 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Submit</button>
</form>

<h2 class="text-lg font-semibold mb-4">Other Options</h2>

<!-- Additional Product Card for Other Product -->
<form action="" method="POST" class="bg-gray-100 p-4 rounded-lg shadow mb-4">
    <div class="flex items-center mb-4">
        <label class="text-sm font-semibold text-gray-900 mr-2" for="product_name">Product Name:</label>
        <input type="text" name="product_name" id="product_name" placeholder="Enter product name" class="border rounded-md p-1 w-64" required />
    </div>

    <div class="flex items-center mb-4">
        <label class="text-sm font-semibold text-gray-900 mr-2" for="price">Price:</label>
        <input type="number" name="price" id="price" placeholder="₱150.00" class="border rounded-md p-1 w-24" required />
    </div>

    <input type="hidden" name="patients_id" value="<?php echo htmlspecialchars($patient['patients_id']); ?>">

    <button type="submit" class="mt-2 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Submit</button>
</form>

</div>


<div class="w-full text-center">
    <a href="doctor_eye_test_results.php?id=<?php echo htmlspecialchars($patients_id); ?>" 
       class="mt-4 inline-block px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 text-center">
       Back to Eye Test Results
    </a>
</div>


      
    </form>
</div>
    </div>
</div>



    
<?php include('doctor_homepage.php'); ?>
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="../dist/js/script.js"></script>
    <script>
        // Show success or error message as an alert
        window.onload = function() {
            <?php if ($message): ?>
                alert('<?php echo $message; ?>');
            <?php endif; ?>
        };
    </script>
    
</body>
</html>
