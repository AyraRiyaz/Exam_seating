# Exam Seating Arrangement Management System

## 📋 Project Overview

The **Exam Seating Arrangement Management System** is a comprehensive web application designed to streamline the process of managing and communicating exam seating arrangements to students and invigilators. This system automates the distribution of exam information through personalized email notifications, making the examination process more efficient and organized.

## 👥 Development Team

This project has been developed by:

- **K P Ayra Riyaz**
- **Hanna P**
- **Hajira Shuhaila**

As part of an academic project from **MEA Engineering College**.

## 🎯 Project Objectives

- Automate the process of exam seating arrangement distribution
- Eliminate manual distribution of exam hall tickets
- Provide a centralized system for exam management
- Send personalized email notifications to students and invigilators
- Maintain digital records of exam arrangements
- Improve communication efficiency between administration and students

## ✨ Features

### 🔐 Authentication System

- Secure login system for administrators
- Role-based access control

### 📊 Data Management

- **Excel File Upload**: Support for uploading student and invigilator data via Excel files
- **Database Integration**: MySQL database for storing exam and seating information
- **Data Processing**: Automatic processing of uploaded spreadsheet data

### 📧 Email Automation

- **Automated Email Notifications**: Sends personalized emails to students with their seating arrangements
- **Invigilator Notifications**: Separate email system for invigilator duty assignments
- **Customizable Email Templates**: Professional email templates with exam details

### 🎨 User Interface

- **Responsive Design**: Mobile-friendly interface that works across devices
- **Intuitive Navigation**: Easy-to-use interface for administrators
- **Modern Styling**: Professional and clean UI design

### 📁 File Management

- **Secure File Upload**: Safe handling of Excel file uploads
- **File Validation**: Ensures uploaded files are in correct format
- **Upload History**: Maintains records of uploaded files

## 🛠️ Technology Stack

### Frontend

- **HTML5**: Structure and markup
- **CSS3**: Styling and responsive design
- **JavaScript**: Client-side functionality

### Backend

- **PHP**: Server-side scripting and logic
- **MySQL**: Database management system

### Libraries & Dependencies

- **PHPSpreadsheet (v1.29+)**: Excel file processing and manipulation
- **PHPMailer (v6.9+)**: Email sending functionality
- **Composer**: Dependency management

### Development Environment

- **WAMP/XAMPP**: Local development server
- **Apache**: Web server
- **MySQL**: Database server

## 📁 Project Structure

```
Exam_seating/
├── 📄 README.md                   # Project documentation
├── 🏠 home.html                   # Landing page
├── 🔐 login.html                  # Authentication page
├── 👥 student.html                # Student data upload interface
├── 👨‍💼 invigilator.html           # Invigilator data upload interface
├── ℹ️ about.html                   # About page
├── 🗃️ database.html               # Database management interface
├── 🎨 home.css                    # Main stylesheet
├── 🔧 composer.json               # PHP dependencies
├── 🔌 connection.php              # Database connection
├── 🗃️ database.php                # Database operations
├── 📧 email.php                   # Email functionality
├── 👥 studentdatabase.php         # Student data processing
├── 👨‍💼 invigilatordatabase.php    # Invigilator data processing
├── 📧 invigilatoremail.php        # Invigilator email system
├── 🔐 login.php                   # Login processing
├── 🗃️ examseating.sql             # Database schema
├── 📁 uploads/                    # File upload directory
│   ├── student.xlsx
│   ├── invigilator.xlsx
│   └── ...
└── 📦 vendor/                     # Composer dependencies
```

## 🚀 Installation & Setup

### Prerequisites

- PHP 7.4 or higher
- MySQL 5.7 or higher
- Apache/Nginx web server
- Composer (for dependency management)

### Step-by-Step Installation

1. **Clone the Repository**

   ```bash
   git clone https://github.com/AyraRiyaz/Exam_seating.git
   cd Exam_seating
   ```

2. **Install Dependencies**

   ```bash
   composer install
   ```

3. **Database Setup**

   - Create a MySQL database named `examseating`
   - Import the provided SQL file:

   ```sql
   mysql -u your_username -p examseating < examseating.sql
   ```

4. **Configuration**

   - Update database credentials in `connection.php`:

   ```php
   $servername = "localhost";
   $username = "your_username";
   $password = "your_password";
   $dbname = "examseating";
   ```

5. **Email Configuration**

   - Configure SMTP settings in `email.php`:

   ```php
   $mail->Username = 'your_email@domain.com';
   $mail->Password = 'your_app_password';
   ```

6. **File Permissions**

   - Ensure the `uploads/` directory has write permissions:

   ```bash
   chmod 755 uploads/
   ```

7. **Start the Server**
   - Place the project in your web server directory (htdocs for XAMPP, www for WAMP)
   - Access the application at `http://localhost/Exam_seating/`

## 📋 Usage Guide

### For Administrators

1. **Login**: Access the system through the login page
2. **Upload Student Data**:
   - Navigate to the student section
   - Upload Excel file with student information (Name, Email, Roll Number, etc.)
   - Specify exam date and time
3. **Upload Invigilator Data**:
   - Navigate to the invigilator section
   - Upload Excel file with invigilator information
4. **Send Notifications**:
   - System automatically processes data and sends emails
   - Monitor email delivery status

### Excel File Format

#### Student Data Format:

| Name     | Email            | Roll Number | Seat Number | Hall      |
| -------- | ---------------- | ----------- | ----------- | --------- |
| John Doe | john@example.com | CS001       | A-15        | Main Hall |

#### Invigilator Data Format:

| Name        | Email                  | Hall Assignment | Duty Time          |
| ----------- | ---------------------- | --------------- | ------------------ |
| Prof. Smith | prof.smith@college.edu | Hall A          | 9:00 AM - 12:00 PM |

## 🔧 Configuration

### Email Settings

The system uses Gmail SMTP for sending emails. Configure your email settings in `email.php`:

```php
$mail->Host = 'smtp.gmail.com';
$mail->Username = 'your_email@gmail.com';
$mail->Password = 'your_app_password'; // Use App Password for Gmail
$mail->SMTPSecure = 'tls';
$mail->Port = 587;
```

### Database Configuration

Update database connection settings in `connection.php` and related files.

## 🔒 Security Features

- Input validation and sanitization
- Secure file upload handling
- SQL injection prevention
- XSS protection
- Password-protected admin access

## 🐛 Troubleshooting

### Common Issues:

1. **Email Not Sending**:

   - Check SMTP credentials
   - Ensure "Less secure app access" is enabled (Gmail)
   - Verify internet connectivity

2. **File Upload Errors**:

   - Check file permissions on uploads folder
   - Verify file size limits in PHP configuration
   - Ensure correct Excel file format

3. **Database Connection Issues**:
   - Verify database credentials
   - Check if MySQL service is running
   - Ensure database exists

## 🔮 Future Enhancements

- [ ] Real-time notifications
- [ ] Mobile application development
- [ ] Advanced reporting and analytics
- [ ] Integration with academic management systems
- [ ] Bulk SMS functionality
- [ ] QR code generation for seat tickets
- [ ] Multi-language support
- [ ] Advanced user role management

## 🤝 Contributing

This is an academic project from MEA Engineering College. For contributions or suggestions, please contact the development team.

## 📄 License

This project is developed as part of academic coursework at MEA Engineering College. All rights reserved.

## 📞 Contact

For any queries or support, please contact:

- **Institution**: MEA Engineering College
- **Development Team**: K P Ayra Riyaz, Hanna P, Hajira Shuhaila

## 🙏 Acknowledgments

- MEA Engineering College for providing the platform and resources
- Faculty members for guidance and support
- PHP community for excellent libraries (PHPSpreadsheet, PHPMailer)

---

**Note**: This system is designed to improve efficiency in exam management and reduce manual workload for educational institutions. It demonstrates practical application of web development technologies in solving real-world problems in academic environments.
