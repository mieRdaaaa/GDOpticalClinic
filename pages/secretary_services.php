<?php
include('db.php');

date_default_timezone_set('Asia/Manila');
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

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_name = $_POST['product_name'];
    $price = $_POST['price'];
    $date_added = date("Y-m-d H:i:s");

    // Prepare and bind the statement
    $stmt = $conn->prepare("INSERT INTO services (product_name, price, date_added) VALUES (?, ?, ?)");
    $stmt->bind_param("sds", $product_name, $price, $date_added); // s = string, d = double

    // Execute the statement and check if successful
    if ($stmt->execute()) {
        // Set success message in session
        $_SESSION['message'] = "Successfully added $product_name.";
    } else {
        // Set error message in session
        $_SESSION['message'] = "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();

    // Redirect to the same page to avoid resubmission
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

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
                <a href="#" class="text-black-400 hover:text-gray-600 font-medium">Services</a>
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



    <div class="container mx-auto my-6 p-6 bg-white rounded-md shadow-md">
    <h2 class="text-3xl font-semibold mb-4">Optical Accessories & Services</h2>
    
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <!-- Product Card for Nosepads -->
        <form action="" method="POST" class="bg-gray-100 p-4 rounded-lg shadow">
            <h3 class="text-lg font-bold">Nosepads</h3>
            <p class="text-sm text-gray-600">High-quality, soft, and comfortable nosepads.</p>
            <div class="flex items-center">
                <label class="text-sm font-semibold text-gray-900 mr-2">Price:</label>
                <input type="number" name="price" placeholder="₱20.00" class="border rounded-md p-1 w-24" required />
            </div>
            <input type="hidden" name="product_name" value="Nosepads">
            <button type="submit" class="mt-2 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Submit</button>
        </form>

        <!-- Product Card for Frame Adjustments -->
        <form action="" method="POST" class="bg-gray-100 p-4 rounded-lg shadow">
            <h3 class="text-lg font-bold">Frame Adjustments</h3>
            <p class="text-sm text-gray-600">Professional frame alignment and adjustments.</p>
            <div class="flex items-center">
                <label class="text-sm font-semibold text-gray-900 mr-2">Price:</label>
                <input type="number" name="price" placeholder="₱500.00" class="border rounded-md p-1 w-24" required />
            </div>
            <input type="hidden" name="product_name" value="Frame Adjustments">
            <button type="submit" class="mt-2 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Submit</button>
        </form>

        <!-- Product Card for Lens Color Change -->
        <form action="" method="POST" class="bg-gray-100 p-4 rounded-lg shadow">
            <h3 class="text-lg font-bold">Lens Color Change</h3>
            <p class="text-sm text-gray-600">Wide range of lens colors to suit your style.</p>
            <div class="flex items-center">
                <label class="text-sm font-semibold text-gray-900 mr-2">Price:</label>
                <input type="number" name="price" placeholder="₱500.00" class="border rounded-md p-1 w-24" required />
            </div>
            <input type="hidden" name="product_name" value="Lens Color Change">
            <button type="submit" class="mt-2 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Submit</button>
        </form>

        <!-- Product Card for Cords & Straps -->
        <form action="" method="POST" class="bg-gray-100 p-4 rounded-lg shadow">
            <h3 class="text-lg font-bold">Cords and Straps</h3>
            <p class="text-sm text-gray-600">Stylish and durable cords for your eyewear.</p>
            <div class="flex items-center">
                <label class="text-sm font-semibold text-gray-900 mr-2">Price:</label>
                <input type="number" name="price" placeholder="₱100.00" class="border rounded-md p-1 w-24" required />
            </div>
            <input type="hidden" name="product_name" value="Cords and Straps">
            <button type="submit" class="mt-2 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Submit</button>
        </form>

        <!-- Product Card for Cleaning Cloths -->
        <form action="" method="POST" class="bg-gray-100 p-4 rounded-lg shadow">
            <h3 class="text-lg font-bold">Cleaning Cloths</h3>
            <p class="text-sm text-gray-600">Soft and effective microfiber cleaning cloths.</p>
            <div class="flex items-center">
                <label class="text-sm font-semibold text-gray-900 mr-2">Price:</label>
                <input type="number" name="price" placeholder="₱10.00" class="border rounded-md p-1 w-24" required />
            </div>
            <input type="hidden" name="product_name" value="Cleaning Cloths">
            <button type="submit" class="mt-2 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Submit</button>
        </form>

        <!-- Product Card for Protective Casing -->
        <form action="" method="POST" class="bg-gray-100 p-4 rounded-lg shadow">
            <h3 class="text-lg font-bold">Protective Casing</h3>
            <p class="text-sm text-gray-600">Durable cases to keep your eyewear safe.</p>
            <div class="flex items-center">
                <label class="text-sm font-semibold text-gray-900 mr-2">Price:</label>
                <input type="number" name="price" placeholder="₱150.00" class="border rounded-md p-1 w-24" required />
            </div>
            <input type="hidden" name="product_name" value="Protective Casing">
            <button type="submit" class="mt-2 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Submit</button>
        </form>

        
        <h2 class="text-lg font-semibold mb-4">Other Options</h2>
        
        

    </div>
    <form action="" method="POST" class="bg-gray-100 p-4 rounded-lg shadow">
  
    
    <div class="flex items-center mb-4">
        <label class="text-sm font-semibold text-gray-900 mr-2" for="product_name">Product Name:</label>
        <input type="text" name="product_name" id="product_name" placeholder="Enter product name" class="border rounded-md p-1 w-64" required />
    </div>
    
    <div class="flex items-center mb-4">
        <label class="text-sm font-semibold text-gray-900 mr-2" for="price">Price:</label>
        <input type="number" name="price" id="price" placeholder="₱150.00" class="border rounded-md p-1 w-24" required />
    </div>
    
    <button type="submit" class="mt-2 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Submit</button>
</form>
</div>


    
      
    </form>
</div>
    </div>
</div>

    
<?php include('secretary_homepage.php'); ?>
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


