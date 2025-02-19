<?php
// Collect form data
$fullName = $_POST['fullName'];
$email = $_POST['email'];
$attendance = $_POST['attendance'];
$community = $_POST['community'];
$github = $_POST['github'];
$agreement = $_POST['agreement'];

// Handle file uploads (if needed)
$files = [];
if (!empty($_FILES['files'])) {
    foreach ($_FILES['files']['tmp_name'] as $index => $tmpName) {
        $fileName = $_FILES['files']['name'][$index];
        move_uploaded_file($tmpName, 'uploads/' . $fileName); // Save files to the "uploads" folder
        $files[] = $fileName;
    }
}

// Prepare email content
$to = "iradsham@gmail.com"; // Replace with your email address
$subject = "New Application Form Submission";
$message = "
    <h1>New Application Form Submission</h1>
    <p><strong>Full Name:</strong> $fullName</p>
    <p><strong>Email:</strong> $email</p>
    <p><strong>Attendance:</strong> $attendance</p>
    <p><strong>Community:</strong> $community</p>
    <p><strong>GitHub Link:</strong> $github</p>
    <p><strong>Agreement:</strong> " . ($agreement ? 'Yes' : 'No') . "</p>
    <p><strong>Files:</strong> " . implode(', ', $files) . "</p>
";

// Set headers for HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= "From: no-reply@gmail.com" . "\r\n"; // Replace with a valid sender email

// Send the email
if (mail($to, $subject, $message, $headers)) {
    echo "Email sent successfully!";
} else {
    echo "Failed to send email.";
}
?>