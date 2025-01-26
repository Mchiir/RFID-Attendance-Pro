<?php
include_once("RFIDManager.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve POST data
    $name = $_POST['employee'] ?? '';
    $clock_in = $_POST['clock_in'] ?? '';
    $clock_out = $_POST['clock_out'] ?? '';

    // Validate the inputs
    if (empty($name) || empty($clock_in) || empty($clock_out)) {
        echo "All fields are required.";
        exit;
    }

    // Check if the datetime format is valid (YYYY-MM-DD HH:MM:SS)
    if (!validateDate($clock_in) || !validateDate($clock_out)) {
        echo "Invalid datetime format. Please use YYYY-MM-DD HH:MM:SS.";
        exit;
    }

    // Initialize RFIDManager
    $rfidManager = new RFIDManager();

    try {
        // Save the transaction
        $rfidManager->saveTransaction($name, $clock_in, $clock_out);
        echo "Attendance uploaded successfully!";
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }

} else {
    echo "Invalid request method. Please use POST.";
}

// Function to validate date format
function validateDate($date, $format = 'Y-m-d H:i:s') {
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) === $date;
}
?>
