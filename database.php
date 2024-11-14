<?php
// Include PHPSpreadsheet
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;

// Database connection settings
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "examseating";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if file has been uploaded
if(isset($_FILES['excel_file']) && $_FILES['excel_file']['error'] === UPLOAD_ERR_OK) {
    $inputFileName = $_FILES['excel_file']['tmp_name'];

    // Load Excel file
    $spreadsheet = IOFactory::load($inputFileName);

    // Get the first worksheet in the Excel file
    $worksheet = $spreadsheet->getActiveSheet();

    // Get the highest row and column indices
    $highestRow = $worksheet->getHighestRow();
    $highestColumn = $worksheet->getHighestColumn();

    // Loop through each row in the worksheet
    for ($row = 1; $row <= $highestRow; $row++) {
        // Read data from cells
        $col1 = $worksheet->getCellByColumnAndRow(1, $row)->getValue(); // Change the column index as needed
        $col2 = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
        $col3 = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
        $col4 = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
         // Change the column index as needed
        // Add more columns as needed

        // Prepare SQL statement
        $sql = "INSERT INTO studentdetails (Name,Registerno,Class,Email) VALUES ('$col1', '$col2','$col1','$col4')"; // Change column names as needed

        // Execute SQL statement
        if ($conn->query($sql) === TRUE) {
            echo "Record inserted successfully<br>";
        } else {
            echo "Error inserting record: " . $conn->error . "<br>";
        }
    }
} else {
    echo "Error uploading file.";
}

// Close connection
$conn->close();
?>
