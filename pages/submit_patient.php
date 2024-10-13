<?php
header('Content-Type: application/json');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gdoptical_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die(json_encode(array(
        'status' => 'error',
        'message' => 'Connection failed: ' . $conn->connect_error
    )));
}

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO patients (first_name, last_name, middle_name, address, medication_history, date_of_birth, gender, contact_no, medical_history, previous_eye_conditions, additional_notes, allergies, allergy_specify, eye_conditions, eye_conditions_specify) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

if ($stmt === false) {
    die(json_encode(array(
        'status' => 'error',
        'message' => 'Prepare failed: ' . $conn->error
    )));
}

$stmt->bind_param("sssssssssssssss", $first_name, $last_name, $middle_name, $address, $medication_history, $date_of_birth, $gender, $contact_no, $medical_history, $previous_eye_conditions, $additional_notes, $allergies, $allergy_specify, $eye_conditions, $eye_conditions_specify);

// Set parameters with sanitization
$first_name = isset($_POST['first_name']) ? trim($_POST['first_name']) : '';
$last_name = isset($_POST['last_name']) ? trim($_POST['last_name']) : '';
$middle_name = isset($_POST['middle_name']) ? trim($_POST['middle_name']) : '';
$address = isset($_POST['barangay']) ? trim($_POST['barangay']) . ', ' . trim($_POST['city']) . ', ' . trim($_POST['province']) . ', ' . trim($_POST['region']) : '';
$medication_history = isset($_POST['medication_history']) ? trim($_POST['medication_history']) : '';
$date_of_birth = isset($_POST['date_of_birth']) ? trim($_POST['date_of_birth']) : '';
$gender = isset($_POST['gender']) ? trim($_POST['gender']) : '';
$contact_no = isset($_POST['contact_no']) ? trim($_POST['contact_no']) : '';
$medical_history = isset($_POST['medical_history']) ? trim($_POST['medical_history']) : '';
$previous_eye_conditions = isset($_POST['previous_eye_conditions']) ? trim($_POST['previous_eye_conditions']) : '';
$additional_notes = isset($_POST['additional_notes']) ? trim($_POST['additional_notes']) : '';
$allergies = isset($_POST['allergies']) ? trim($_POST['allergies']) : '';
$allergy_specify = isset($_POST['allergy_specify']) ? trim($_POST['allergy_specify']) : '';
$eye_conditions = isset($_POST['eye_conditions']) ? trim($_POST['eye_conditions']) : '';
$eye_conditions_specify = isset($_POST['eye_conditions_specify']) ? trim($_POST['eye_conditions_specify']) : '';

// Basic validation
$errors = [];
if (empty($first_name) || empty($last_name) || empty($date_of_birth) || empty($gender) || empty($contact_no)) {
    $errors[] = 'Required fields cannot be empty.';
}

if (!preg_match('/^[0-9]+$/', $contact_no)) {
    $errors[] = 'Contact number must contain only numbers.';
}

if (!empty($errors)) {
    echo json_encode(array(
        'status' => 'error',
        'message' => implode(' ', $errors)
    ));
    exit();
}

if ($stmt->execute()) {
    $response = array(
        'status' => 'success',
        'message' => 'Patient added successfully'
    );
} else {
    $response = array(
        'status' => 'error',
        'message' => 'Error inserting patient: ' . $stmt->error
    );
}

echo json_encode($response);

$stmt->close();
$conn->close();
?>
