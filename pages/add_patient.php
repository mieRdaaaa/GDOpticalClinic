<?php 
include('db.php'); // Ensure this file connects to your database
session_start(); 

// User info
$user_fullname = '';
$user_role = '';

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
            $user_fullname = htmlspecialchars($row['fullname']);
            $user_role = ucfirst(htmlspecialchars($row['account_type']));
        }

        $stmt->close();
    }
} else {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Patients</title>
    <link rel="shortcut icon" href="../images/ico.png" />
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://unpkg.com/@iconify/iconify@1.0.7/dist/iconify.min.js"></script>
    <script src="https://unpkg.com/remixicon/fonts/remixicon.css"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var form = document.querySelector('form');
        
        var firstName = document.getElementById('first_name');
        var lastName = document.getElementById('last_name');
        var middleName = document.getElementById('middle_name');
        var contactNo = document.getElementById('contact_no');
        var dateOfBirthInput = document.getElementById('date_of_birth');

        var namePattern = /^[a-zA-Z\s]+$/;
        var numberPattern = /^[0-9]+$/;

        function validateName(input) {
            if (!namePattern.test(input.value)) {
                input.setCustomValidity('This field should contain only letters');
            } else {
                input.setCustomValidity('');
            }
        }

        function validateContact(input) {
            input.value = input.value.replace(/\D/g, ''); // Remove non-digit characters
            if (!numberPattern.test(input.value)) {
                input.setCustomValidity('This field should contain only numbers');
            } else {
                input.setCustomValidity('');
            }
        }

        // Validate names and contact numbers
        firstName.oninput = function() { validateName(firstName); };
        lastName.oninput = function() { validateName(lastName); };
        middleName.oninput = function() { validateName(middleName); };
        contactNo.oninput = function() { validateContact(contactNo); };

        // Date validation
        const today = new Date();
        const maxDate = new Date(today.getFullYear(), today.getMonth() - 6, today.getDate()); // 6 months ago
        dateOfBirthInput.setAttribute('max', maxDate.toISOString().split("T")[0]);

        dateOfBirthInput.addEventListener('change', function() {
            const selectedDate = new Date(this.value);
            if (selectedDate > today) {
                alert('Date of Birth cannot be in the future.');
                this.value = ''; // Clear the input
            }
        });

        // Form submission
        form.addEventListener('submit', function(e) {
            e.preventDefault(); 

            validateName(firstName);
            validateName(lastName);
            validateName(middleName);
            validateContact(contactNo);

            if (!form.checkValidity()) {
                alert('Please correct the errors in the form.');
                return;
            }

            var formData = new FormData(form);
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'submit_patient.php'); // Ensure this path is correct
            xhr.onload = function() {
                if (xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    if (response.status === 'success') {
                        alert(response.message);
                        form.reset(); 
                    } else {
                        alert('Failed to add patient: ' + response.message); 
                    }
                } else {
                    alert('Error: ' + xhr.status); 
                }
            };
            xhr.send(formData);
        });
    });
    </script>
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
                <a href="#" class="text-black-400 hover:text-gray-600 font-medium">Add Patients</a>
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

    <div class="form-container bg-white p-8 rounded shadow-md m-4">
        <h2 class="text-2xl font-semibold mb-4">Patient Information</h2>

        <form class="mb-4" method="POST">
            <div class="mb-4">
                <label for="first_name" class="block text-sm font-medium mb-1">First Name:</label>
                <input type="text" id="first_name" name="first_name" class="border border-gray-300 rounded-md py-2 px-4 w-full" placeholder="Enter first name" required>
            </div>
            <div class="mb-4">
                <label for="last_name" class="block text-sm font-medium mb-1">Last Name:</label>
                <input type="text" id="last_name" name="last_name" class="border border-gray-300 rounded-md py-2 px-4 w-full" placeholder="Enter last name" required>
            </div>
            <div class="mb-4">
                <label for="middle_name" class="block text-sm font-medium mb-1">Middle Name:</label>
                <input type="text" id="middle_name" name="middle_name" class="border border-gray-300 rounded-md py-2 px-4 w-full" placeholder="Enter middle name">
            </div>

            <div class="mb-4">
                <label for="medication_history" class="block text-sm font-medium mb-1">Medication History:</label>
                <textarea id="medication_history" name="medication_history" class="border border-gray-300 rounded-md py-2 px-4 w-full" placeholder="Enter medication history"></textarea>
            </div>
            <div class="mb-4">
                <label for="date_of_birth" class="block text-sm font-medium mb-1">Date of Birth:</label>
                <input type="date" id="date_of_birth" name="date_of_birth" class="border border-gray-300 rounded-md py-2 px-4 w-full" required>
            </div>
            <div class="mb-4">
                <label for="gender" class="block text-sm font-medium mb-1">Gender:</label>
                <select id="gender" name="gender" class="border border-gray-300 rounded-md py-2 px-4 w-full" required>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </div>

            <!-- Address Fields -->
            <div class="mb-4">
                <label class="block text-sm font-semibold mb-1">Region</label>
                <select id="region" name="region" onchange="loadProvinces()" required class="block w-full border border-gray-300 rounded-md py-2 px-4">
                    <option value="">Select Region</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-semibold mb-1">Province</label>
                <select id="province" name="province" onchange="loadCities()" required class="block w-full border border-gray-300 rounded-md py-2 px-4">
                    <option value="">Select Province</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-semibold mb-1">City / Municipality</label>
                <select id="city" name="city" onchange="loadBarangays()" required class="block w-full border border-gray-300 rounded-md py-2 px-4">
                    <option value="">Select City / Municipality</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-semibold mb-1">Barangay</label>
                <select id="barangay" name="barangay" required class="block w-full border border-gray-300 rounded-md py-2 px-4">
                    <option value="">Select Barangay</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="contact_no" class="block text-sm font-medium mb-1">Contact No:</label>
                <input type="text" id="contact_no" name="contact_no" class="border border-gray-300 rounded-md py-2 px-4 w-full" placeholder="Enter contact number" required>
            </div>
            <div class="mb-4">
                <button type="submit" class="bg-blue-500 text-white rounded-md py-2 px-4">Add Patient</button>
            </div>
        </form>
    </div>
</main>
<script src="../dist/js/address_selector.js"></script>
<?php include('secretary_homepage.php'); ?>
<!-- End: Main -->
</body>
</html>
