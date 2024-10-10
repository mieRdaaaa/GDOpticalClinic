<?php

require('../fpdf/fpdf.php');
include('db.php');


// Get the certificate_id and patient_id from the query string
$certificate_id = intval($_GET['id'] ?? 0);
$patients_id = intval($_GET['patient_id'] ?? 0);

// Debug output
if ($certificate_id <= 0) {
    die("Invalid certificate ID: " . htmlspecialchars($_GET['id'] ?? 'not set'));
}
if ($patients_id <= 0) {
    die("Invalid patient ID: " . htmlspecialchars($_GET['patient_id'] ?? 'not set'));
}

// Fetch the certificate details from the database
$certificate_sql = "SELECT *, eye_result_id FROM certificate WHERE certificate_id = ?";
$stmt = $conn->prepare($certificate_sql);
$stmt->bind_param("i", $certificate_id);
$stmt->execute();
$certificate_result = $stmt->get_result();

// Check if the certificate exists
if ($certificate_result->num_rows > 0) {
    $certificate_data = $certificate_result->fetch_assoc();

    // Fetch patient details
    $patient_sql = "SELECT first_name, middle_name, last_name FROM patients WHERE patients_id = ?";
    $patient_stmt = $conn->prepare($patient_sql);
    $patient_stmt->bind_param("i", $patients_id);
    $patient_stmt->execute();
    $patient_result = $patient_stmt->get_result();
    
    if ($patient_result->num_rows > 0) {
        $patients = $patient_result->fetch_assoc();
    } else {
        die("Patient not found.");
    }

     // Fetch eye result details based on eye_result_id from the certificate
     $eye_result_id = intval($certificate_data['eye_result_id']);
     $eye_result_sql = "SELECT *, date_added AS date2 FROM eye_result WHERE eye_result_id = ?";
     $eye_result_stmt = $conn->prepare($eye_result_sql);
     $eye_result_stmt->bind_param("i", $eye_result_id);
     $eye_result_stmt->execute();
     $eye_result_result = $eye_result_stmt->get_result();
 
     if ($eye_result_result->num_rows > 0) {
         $eye_result = $eye_result_result->fetch_assoc();
     } else {
         die("Eye result not found.");
     }
 
 } else {
     die("Certificate not found.");
 }


 
 


 



header('content-type:image/jpeg');
$font="Arial.ttf";
$image=imagecreatefromjpeg("Jules.jpg");
$color=imagecolorallocate($image, 19,20,21);



$name1 = htmlspecialchars($patients['first_name']. ' ' . $patients['middle_name']. ' ' . $patients['last_name']); // Adjust to the correct field
//$name1 = "dsadas";

$date1= htmlspecialchars($certificate_data['date_added']);
$formatted_date1 = date('F j, Y', strtotime($date1)); 

$date2 = htmlspecialchars($eye_result['date2']); // This is now your additional date
$formatted_date2 = date('F j, Y', strtotime($date2)); 

$symptoms=htmlspecialchars($certificate_data['symptoms']);
$examination=htmlspecialchars($certificate_data['examination']);
$diagnosis=htmlspecialchars($eye_result['diagnosis']);
$recommendation=htmlspecialchars($certificate_data['recommendation']);
//RX
//OD right
$oduva=htmlspecialchars($certificate_data['oduva']);
$odsphere=htmlspecialchars($eye_result['r_sphere']);
$odcylinder=htmlspecialchars($eye_result['r_cylinder']);
$odaxis=htmlspecialchars($eye_result['r_axis']);
$odadd=htmlspecialchars($certificate_data['odadd']);
$odpd=htmlspecialchars($eye_result['pd']);
$odbcva=htmlspecialchars($certificate_data['osbcva']);
//OS left
$osuva=htmlspecialchars($certificate_data['osuva']);
$ossphere=htmlspecialchars($eye_result['l_sphere']);
$oscylinder=htmlspecialchars($eye_result['l_cylinder']);
$osaxis=htmlspecialchars($eye_result['l_axis']);
$osadd=htmlspecialchars($certificate_data['osadd']);
$ospd=htmlspecialchars($eye_result['pd']);
$osbcva=htmlspecialchars($certificate_data['osbcva']);
$doctor='glen';
imagettftext($image, 27 , 0 ,295, 364, $color, $font, $formatted_date1);
                        ///size   angle   x   y

imagettftext($image, 28 , 0 ,613, 517, $color, $font, $name1);

imagettftext($image, 27 , 0 ,405, 558, $color, $font, $formatted_date2);

imagettftext($image, 27 , 0 ,1130, 558, $color, $font, $symptoms);





//examination done
{
    // Define a maximum width for the text block
    $maxWidth = 700; // Adjust this to your image width constraints
    $fontSize = 28;
    $xPosition1 = 710;
    $yPosition1 = 712;
    $lineHeight = 77; // Vertical space between lines
    
    // Split the examination text into lines
    $words = explode(' ', $examination);
    $currentLine = '';
    foreach ($words as $word) {
        $testLine = $currentLine . ' ' . $word;
        $bbox = imagettfbbox($fontSize, 0, $font, $testLine);
        $lineWidth = $bbox[2] - $bbox[0]; // Width of the text
    
        if ($lineWidth > $maxWidth && !empty($currentLine)) {
            // Print the current line
            imagettftext($image, $fontSize, 0, $xPosition1, $yPosition1, $color, $font, trim($currentLine));
    
            // Move to the next line
            $currentLine = $word;
            $yPosition1 += $lineHeight;
        } else {
            $currentLine = $testLine;
        }
    }
    
    // Print the last line
    if (!empty($currentLine)) {
        imagettftext($image, $fontSize, 0, $xPosition1, $yPosition1, $color, $font, trim($currentLine));
    }
    }
    
    
    //diagnosis
    {
    
    $maxWidth = 700; // Adjust this to your image width constraints
    $fontSize = 28;
    $xPosition2 = 710;
    $yPosition2 = 942;
    $lineHeight = 77; // Vertical space between lines
    
    // Split the diagnosis text into lines
    $words = explode(' ', $diagnosis);
    $currentLine = '';
    foreach ($words as $word) {
        $testLine = $currentLine . ' ' . $word;
        $bbox = imagettfbbox($fontSize, 0, $font, $testLine);
        $lineWidth = $bbox[2] - $bbox[0]; // Width of the text
    
        if ($lineWidth > $maxWidth && !empty($currentLine)) {
            // Print the current line
            imagettftext($image, $fontSize, 0, $xPosition2, $yPosition2, $color, $font, trim($currentLine));
    
            // Move to the next line
            $currentLine = $word;
            $yPosition2 += $lineHeight;
        } else {
            $currentLine = $testLine;
        }
    }
    
    // Print the last line
    if (!empty($currentLine)) {
        imagettftext($image, $fontSize, 0, $xPosition2, $yPosition2, $color, $font, trim($currentLine));
    }
    }

//recommendation
{
    $maxWidth = 700; // Adjust this to your image width constraints
    $fontSize = 28;
    $xPosition = 710;
    $yPosition = 1175;
    $lineHeight = 77; // Vertical space between lines
    
    // Split the recommendation text into lines
    $words = explode(' ', $recommendation);
    $currentLine = '';
    foreach ($words as $word) {
        $testLine = $currentLine . ' ' . $word;
        $bbox = imagettfbbox($fontSize, 0, $font, $testLine);
        $lineWidth = $bbox[2] - $bbox[0]; // Width of the text
    
        if ($lineWidth > $maxWidth && !empty($currentLine)) {
            // Print the current line
            imagettftext($image, $fontSize, 0, $xPosition, $yPosition, $color, $font, trim($currentLine));
    
            // Move to the next line
            $currentLine = $word;
            $yPosition += $lineHeight;
        } else {
            $currentLine = $testLine;
        }
    }
    
    // Print the last line
    if (!empty($currentLine)) {
        imagettftext($image, $fontSize, 0, $xPosition, $yPosition, $color, $font, trim($currentLine));
    }
    }
    
///spectacle rx
//od

imagettftext($image, 28 , 0 ,394, 1567, $color, $font, $oduva);
imagettftext($image, 28 , 0 ,553, 1567, $color, $font, $odsphere);
imagettftext($image, 28 , 0 ,730, 1567, $color, $font, $odcylinder);
imagettftext($image, 28 , 0 ,915, 1567, $color, $font, $odaxis);
imagettftext($image, 28 , 0 ,1071, 1567, $color, $font, $odadd);
imagettftext($image, 28 , 0 ,1225, 1567, $color, $font, $odpd);
imagettftext($image, 28 , 0 ,1379, 1567, $color, $font, $odbcva);

//os

imagettftext($image, 28 , 0 ,394, 1607, $color, $font, $osuva);
imagettftext($image, 28 , 0 ,553, 1607, $color, $font, $ossphere);
imagettftext($image, 28 , 0 ,730, 1607, $color, $font, $oscylinder);
imagettftext($image, 28 , 0 ,915, 1607, $color, $font, $osaxis);
imagettftext($image, 28 , 0 ,1071, 1607, $color, $font, $osadd);
imagettftext($image, 28 , 0 ,1225, 1607, $color, $font, $ospd);
imagettftext($image, 28 , 0 ,1379, 1607, $color, $font, $osbcva);


//DOCTOR
imagettftext($image, 28, 0, 278, 2030, $color, $font, strtoupper($doctor));




// Save the generated image
imagejpeg($image, );
imagedestroy($image);         





/*
// Save the generated image
imagejpeg($image, 'output_image.jpg');
imagedestroy($image);

// Create a new PDF document
$pdf = new FPDF('P', 'mm', 'Legal' );
$pdf->AddPage();
$pdf->Image('output_image.jpg', 0, 0, 216, 356); // Adjust dimensions as needed
$pdf->Output('D', 'output.pdf'); // Download the PDF file */
?>