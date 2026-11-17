<?php
// check.php - reads name and age from the form and shows the right message

// Only accept form submissions; send anyone else back to the form
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: /");
    exit;
}

$name = trim($_POST['name'] ?? '');
$age  = $_POST['age'] ?? '';

$valid = $name !== '' && is_numeric($age) && $age >= 0;

if (!$valid) {
    $heading = 'Missing details';
    $message = 'Please enter your name and a valid age.';
    $class   = 'denied';
} elseif ((int)$age < 18) {
    $heading = 'Not authorized';
    // htmlspecialchars stops anything typed in the name box from running as HTML
    $message = 'Hello, ' . htmlspecialchars($name, ENT_QUOTES, 'UTF-8') . ', you are not authorized to visit the site';
    $class   = 'denied';
} else {
    $heading = 'Access granted';
    $message = 'Welcome to this site';
    $class   = 'granted';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $heading ?> | PHP</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Gochi+Hand&family=Patrick+Hand&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="/style.css">
</head>
<body>
  <main class="stage">
    <h1><?= $heading ?></h1>
    <p class="result <?= $class ?>"><?= $message ?></p>
    <p class="small"><a href="/">Try again</a></p>
  </main>
</body>
</html>
