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

    var namePattern = /^[a-zA-Z\s]+$/;  // Allow letters and spaces
    var numberPattern = /^[0-9]+$/;  // Only numbers

    function validateName(input) {
        // If the field is empty, allow it (no custom validity message)
        if (input.value.trim() === '') {
            input.setCustomValidity(''); 
        } 
        // If it’s not empty, ensure it only contains letters
        else if (!namePattern.test(input.value)) {
            input.setCustomValidity('This field should contain only letters');
        } else {
            input.setCustomValidity('');
        }
    }

    function validateContact(input) {
        // Remove non-digit characters
        input.value = input.value.replace(/\D/g, ''); 
        if (!numberPattern.test(input.value)) {
            input.setCustomValidity('This field should contain only numbers');
        } else {
            input.setCustomValidity('');
        }
    }

    // Add input event listeners to trigger validation
    firstName.oninput = function() { validateName(firstName); };
    lastName.oninput = function() { validateName(lastName); };
    middleName.oninput = function() { validateName(middleName); };  // Middle name can be blank
    contactNo.oninput = function() { validateContact(contactNo); };

    // Date validation
    const today = new Date();
    const maxDate = new Date(today.getFullYear(), today.getMonth() - 6, today.getDate()); // 6 months ago
    dateOfBirthInput.setAttribute('max', maxDate.toISOString().split("T")[0]);

    dateOfBirthInput.addEventListener('change', function() {
        const selectedDate = new Date(this.value);
        if (selectedDate > today) {
            alert('Date of Birth cannot be in the future.');
            this.value = '';  // Clear the input
        }
    });

    // Form submission
    form.addEventListener('submit', function(e) {
        e.preventDefault(); 

        // Validate all form fields
        validateName(firstName);
        validateName(lastName);
        validateName(middleName);
        validateContact(contactNo);

        if (!form.checkValidity()) {
            alert('Please correct the errors in the form.');
            return;
        }

        // Proceed with AJAX form submission
        var formData = new FormData(form);
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'submit_patient.php');  // Ensure this path is correct
        xhr.onload = function() {
            if (xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);
                if (response.status === 'success') {
                    alert(response.message);
                    form.reset();  // Reset the form on successful submission
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
<body class="bg-gray-100">

<!-- Start: Main -->
<main class="w-full md:w-[calc(100%-256px)] md:ml-64 bg-gray-50 min-h-screen transition-all main">
    <div class="py-2 px-6 bg-white flex items-center shadow-md sticky top-0 z-30">
        <button type="button" class="text-lg text-gray-600 sidebar-toggle">
            <i class="ri-menu-line"></i>
        </button>
        <ul class="flex items-center text-sm ml-4">
            <li class="mr-2">
                <a href="#" class="text-black-400 hover:text-gray-600 font-medium">Patient Registration </a>
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
    <div class="p-6">
    <!-- Dashboard Header with Flexbox Alignment -->
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-3xl font-semibold text-gray-800">Patient Registration</h1>
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

            <!-- Medical History Section -->
<h2 class="text-xl font-semibold mb-4 mt-6">Medical History</h2>

<div class="mb-4">
    <label class="block text-sm font-medium mb-1">Do you have any known allergies?</label>
    <div class="flex items-center mb-2">
        <input type="radio" id="allergies_yes" name="allergies" value="Yes" class="mr-2" required>
        <label for="allergies_yes" class="text-sm">Yes (Please specify):</label>
        <input type="text" id="allergy_specify" name="allergy_specify" class="border border-gray-300 rounded-md py-2 px-4 ml-2" placeholder="Specify allergies">
    </div>
    <div class="flex items-center">
        <input type="radio" id="allergies_no" name="allergies" value="No" class="mr-2">
        <label for="allergies_no" class="text-sm">No</label>
    </div>
</div>

<div class="mb-4">
    <label class="block text-sm font-medium mb-1">Have you had any previous eye conditions or surgeries?</label>
    <div class="flex items-center mb-2">
        <input type="radio" id="eye_conditions_yes" name="eye_conditions" value="Yes" class="mr-2" required>
        <label for="eye_conditions_yes" class="text-sm">Yes (Please specify):</label>
        <input type="text" id="eye_conditions_specify" name="eye_conditions_specify" class="border border-gray-300 rounded-md py-2 px-4 ml-2" placeholder="Specify conditions">
    </div>
    <div class="flex items-center">
        <input type="radio" id="eye_conditions_no" name="eye_conditions" value="No" class="mr-2">
        <label for="eye_conditions_no" class="text-sm">No</label>
    </div>
</div>

<div class="mb-4">
    <label for="additional_notes" class="block text-sm font-medium mb-1">Additional Notes:</label>
    <textarea id="additional_notes" name="additional_notes" class="border border-gray-300 rounded-md py-2 px-4 w-full" placeholder="Enter any additional notes"></textarea>
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
    <input type="text" id="contact_no" name="contact_no" class="border border-gray-300 rounded-md py-2 px-4 w-full" 
           pattern="\d{11}" maxlength="11" required title="Contact number must be exactly 11 digits" 
           placeholder="Enter contact number">
</div>
            <div class="mb-4">
                <button type="submit" class="bg-blue-500 text-white rounded-md py-2 px-4">Register Patient</button>
            </div>
        </form>
    </div>
</main>
<script src="../dist/js/address_selector.js"></script>

<?php include('secretary_homepage.php'); ?>
<script src="https://unpkg.com/@popperjs/core@2"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="../dist/js/script.js"></script>

<!-- End: Main -->
</body>
</html>
