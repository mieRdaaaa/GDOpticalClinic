<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    include_once "db.php";

    // Sanitize input
    $fullname = filter_var($_POST["fullname"], FILTER_SANITIZE_STRING);
    $username = filter_var($_POST["username"], FILTER_SANITIZE_STRING);
    $password = $_POST["password"]; // Ideally, hash this
    $contact_number = filter_var($_POST["contact_number"], FILTER_SANITIZE_STRING);
    $birthdate = filter_var($_POST["birthdate"], FILTER_SANITIZE_STRING);
    $gender = filter_var($_POST["gender"], FILTER_SANITIZE_STRING);
    $account_type = filter_var($_POST["role"], FILTER_SANITIZE_STRING);

    // Capture address fields
    $region = filter_var($_POST["region"], FILTER_SANITIZE_STRING);
    $province = filter_var($_POST["province"], FILTER_SANITIZE_STRING);
    $city = filter_var($_POST["city"], FILTER_SANITIZE_STRING);
    $barangay = filter_var($_POST["barangay"], FILTER_SANITIZE_STRING);

    // Combine address into a single string
    $address = "$barangay, $city, $province, $region";

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO accounts (username, password, fullname, gender, birthdate, address, contact_number, account_type) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

    // If you decide to hash the password, uncomment the next line
    // $password = password_hash($password, PASSWORD_DEFAULT);

    // Bind parameters
    $stmt->bind_param("ssssssss", $username, $password, $fullname, $gender, $birthdate, $address, $contact_number, $account_type);

    // Execute the statement
    if ($stmt->execute()) {
        $success_message = "User added successfully.";
        header("Location: add_user.php?success_message=" . urlencode($success_message));
    } else {
        $error_message = "An error occurred. Please try again.";
        header("Location: add_user.php?error_message=" . urlencode($error_message));
    }

    // Close statement and connection
    $stmt->close();
    mysqli_close($conn);
    exit();
}
?>
