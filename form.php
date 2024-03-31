<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate form fields (you can add more validation)
    if (empty($_POST['widget-contact-form-name']) || empty($_POST['widget-contact-form-email']) ||
        empty($_POST['widget-contact-form-subject']) || empty($_POST['widget-contact-form-message'])) {
        header("Location: /form.php?error=empty_fields");
        exit();
    }

    // Sanitize form field values
    $name = htmlspecialchars($_POST['widget-contact-form-name']);
    $email = htmlspecialchars($_POST['widget-contact-form-email']);
    $subject = htmlspecialchars($_POST['widget-contact-form-subject']);
    $message = htmlspecialchars($_POST['widget-contact-form-message']);

    // Compose email message
    $to = "design@infinitechcircle.com"; // Change this to your email address
    $email_subject = "Contact Form Submission: $subject";
    $email_body = "You have received a new message from your website contact form.\n\n".
                  "Here are the details:\n\nName: $name\n\nEmail: $email\n\nMessage:\n$message";

    // Send email
    $headers = "From: $email\r\nReply-To: $email";
    $success = mail($to, $email_subject, $email_body, $headers);

    if ($success) {
        header("Location: /contact.php?success=true");
        exit();
    } else {
        header("Location: /contact.php?error=email_not_sent");
        exit();
    }
} else {
    header("Location: /contact.php?error=invalid_request");
    exit();
}
?>
