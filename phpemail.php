<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: index.html?status=invalid");
    exit;
}

// Sanitize and retrieve POST data
$name = htmlspecialchars(strip_tags(trim($_POST['name'] ?? '')));
$email = filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL);
$messageText = htmlspecialchars(strip_tags(trim($_POST['message'] ?? '')));

if (empty($name) || empty($email) || empty($messageText)) {
    header("Location: index.html?status=empty");
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("Location: index.html?status=invalid_email");
    exit;
}

$to = "email@addressgoeshere.net";
$subject = "New Contact Request from $name";

$message = "
<html>
<head><title>Contact Request</title></head>
<body>
  <table style='width: 100%; max-width: 600px; border-collapse: collapse;'>
    <tr><td style='text-align: center; background-color: #f2f2f2; padding: 20px;'>
      <h3>Contact Request Email</h3>
    </td></tr>
    <tr><td style='padding: 20px;'>
      <p><strong>Name:</strong> {$name}</p>
      <p><strong>Email:</strong> {$email}</p>
      <p><strong>Message:</strong><br>" . nl2br($messageText) . "</p>
    </td></tr>
  </table>
</body>
</html>
";

$headers = "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=UTF-8\r\n";
$headers .= "From: {$name} <{$email}>\r\n";
$headers .= "Reply-To: {$email}\r\n";

if (mail($to, $subject, $message, $headers)) {
    header("Location: index.html?status=success");
} else {
    header("Location: index.html?status=fail");
}
exit;
?>
