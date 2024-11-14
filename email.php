<?php
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\IOFactory;

// Function to send email
function send_email($to_email, $seat_info, $exam_date, $exam_time) {
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com'; 
    $mail->SMTPAuth = true;
    $mail->Username = '21gcs22@meaec.edu.in'; 
    $mail->Password = 'gbzobahglpexfykt'; 
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;  
    $mail->setFrom('21gcs22@meaec.edu.in', 'Exam cell');
    $mail->addAddress($to_email);  

    $mail->Subject = 'Exam Seating Arrangement';
    $mail->Body = "Dear Student,\n\nYour exam seating arrangement: $seat_info\nExam Date: $exam_date\nExam Time: $exam_time\nWish you all the best\nRegards,\n Examcell";

    if (!$mail->send()) {
        echo 'Email could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        echo 'Email has been sent to ' . $to_email . ' with seating information.';
    }
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if file was uploaded without errors
    if (isset($_FILES["file"]) && $_FILES["file"]["error"] == 0) {
        $target_dir = "uploads/"; 
        $target_file = $target_dir . basename($_FILES["file"]["name"]);

        // Check file extension
        $file_type = pathinfo($target_file, PATHINFO_EXTENSION);
        if ($file_type != "xlsx" && $file_type != "xls"){
            echo "Sorry, only Excel files are allowed.";
        } else {
            // Move uploaded file to the designated directory
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
                // Read Excel file
                $spreadsheet = IOFactory::load($target_file);
                $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

                // Connect to MySQL database
                $conn = new mysqli("localhost", "root", "", "examseating");

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Get exam date and time from form submission
                $exam_date = $_POST['exam_date'];
                $exam_time = $_POST['exam_time'];

                // Iterate through each row of Excel data
                foreach ($sheetData as $row) {
                    $seat_info = $row['A'];
                    $register_no = $row['C']; 

                    // Query database to check if register number exists and get seating arrangement
                    $query = "SELECT Email FROM studentdetails WHERE Registerno = '$register_no'";
                    $result = $conn->query($query);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $email = $row['Email'];
                            send_email($email, $seat_info, $exam_date, $exam_time);
                        }
                    } else {
                        echo "No student found with register number: $register_no";
                    }
                }

                $conn->close();
                echo "Emails sent successfully.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    } else {
        echo "Error: No file uploaded.";
    }
}
?>