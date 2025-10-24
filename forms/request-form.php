<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/../PHPMailer/src/Exception.php';
require __DIR__ . '/../PHPMailer/src/PHPMailer.php';
require __DIR__ . '/../PHPMailer/src/SMTP.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name    = trim($_POST['full_name'] ?? '');
    $email   = trim($_POST['email'] ?? '');
    $phone   = trim($_POST['phone'] ?? '');
    $service = trim($_POST['service'] ?? '');

    if (!$name || !$email || !$phone || !$service) {
        header("Location: https://aquapropc.com/aquapro-lp/form-error.html");
        exit;
    }

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        // $mail->Username   = 'aquapropc@gmail.com';
        // $mail->Password   = 'vmxgpykbazkwakhg';
        
        $mail->Username   = 'aquaprolpleads@gmail.com';
        $mail->Password   = 'iubemfjobpwhwhua--';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;

        // From & To
        $mail->setFrom('aquaprolpleads@gmail.com', 'Aqua Pro');
        $mail->addAddress('aquaprolpleads@gmail.com');

        // Add CC recipients
        // $mail->addCC('harry@astraresults.com');
        // $mail->addCC('development@astraresults.com');
        // $mail->addCC('joseph@astraresults.com');

        // Content
        $mail->isHTML(true);
        $mail->Subject = "New Request from $name";
        $mail->Body    = "
            <h3>New Request Form Submission</h3>
            <p><strong>Full Name:</strong> $name</p>
            <p><strong>Email:</strong> $email</p>
            <p><strong>Phone:</strong> $phone</p>
            <p><strong>Service:</strong> $service</p>
        ";

        $mail->send();

        header("Location: https://aquapropc.com/aquapro-lp/thank-you.html");
        exit;

    } catch (Exception $e) {
        header("Location: https://aquapropc.com/aquapro-lp/form-error.html");
        exit;
    }

} else {
    header("Location: https://aquapropc.com/aquapro-lp/form-error.html");
    exit;
}
