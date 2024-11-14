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
    $mail->Host = 'smtp.gmail.com';  // Update with your SMTP server
    $mail->SMTPAuth = true;
    $mail->Username = '21gcs22@meaec.edu.in'; // Update with your email
    $mail->Password = 'gbzobahglpexfykt'; // Update with your email password
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;  // Update with your SMTP port

    $mail->setFrom('21gcs22@meaec.edu.in', 'Exam cell'); // Update with your email and name
    $mail->addAddress($to_email);  // Add recipient

    $mail->Subject = 'Exam Seating Arrangement';
    $mail->Body = "Dear sir/madam,\n\nThe hall allocated for you for invigilation is: $seat_info\nExam Date: $exam_date\nExam Time: $exam_time\n\nRegards,\nExamcell";

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
        $target_dir = "uploads/"; // Directory where you want to store uploaded files
        $target_file = $target_dir . basename($_FILES["file"]["name"]);

        // Check file extension
        $file_type = pathinfo($target_file, PATHINFO_EXTENSION);
        if ($file_type != "xlsx" && $file_type != "xls" && $file_type != "pdf") {
            echo "Sorry, only Excel and PDF files are allowed.";
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
                    $id = $row['C']; // Assuming register number is in column A

                    // Query database to check if register number exists and get seating arrangement
                    $query = "SELECT Email FROM invigilatordetails WHERE id = '$id'";
                    $result = $conn->query($query);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $email = $row['Email'];
                            send_email($email, $seat_info, $exam_date, $exam_time);
                        }
                    } else {
                        echo "No invigilator found with id: $id";
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