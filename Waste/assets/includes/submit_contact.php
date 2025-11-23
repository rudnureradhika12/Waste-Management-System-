<?php
// Start session for feedback messages
session_start();

// Include necessary files for database connection or email configuration if needed
// include '../includes/db.php'; // Uncomment if using a database

// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize and validate input
    $name = htmlspecialchars(trim($_POST['name']));
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $message = htmlspecialchars(trim($_POST['message']));

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = "Invalid email format.";
        header('Location: contact.php?error=' . urlencode($_SESSION['error']));
        exit();
    }

    // Optional: You can save the message to the database
    // $sql = "INSERT INTO messages (name, email, message) VALUES (?, ?, ?)";
    // $stmt = $db->prepare($sql);
    // $stmt->bind_param("sss", $name, $email, $message);
    // $stmt->execute();
    // $stmt->close();

    // Send the email notification (you can adjust this as needed)
    $to = 'admin@example.com'; // Replace with your email
    $subject = "New Contact Form Submission from $name";
    $body = "You have received a new message from the contact form:\n\n" .
            "Name: $name\n" .
            "Email: $email\n" .
            "Message:\n$message";
    $headers = "From: $email\r\n" .
               "Reply-To: $email\r\n";

    // Use mail() function to send email
    if (mail($to, $subject, $body, $headers)) {
        $_SESSION['success'] = "Thank you for your message, $name! We will get back to you shortly.";
    } else {
        $_SESSION['error'] = "There was a problem sending your message. Please try again.";
    }

    // Redirect to contact page with feedback
    header('Location: contact.php?' . (isset($_SESSION['success']) ? 'success=' . urlencode($_SESSION['success']) : 'error=' . urlencode($_SESSION['error'])));
    exit();
}

// If the request method is not POST, redirect back to contact page
header('Location: contact.php');
exit();
?>
