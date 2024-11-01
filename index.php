<?php
session_start();

// Stel de toegangscodes voor elke afbeelding in
$codes = [
    "Youssef" => "YSF2024PXQD",
    "Sasha"   => "SSH2024KT9L",
    "Joseph"  => "JPH2024BG4Z",
    "Hiba"    => "HBA2024NC8Y"
];

// Controleer of het formulier is ingediend
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $entered_code = $_POST["access_code"];
    
    // Controleer of de ingevoerde code overeenkomt met een van de toegangscodes
    foreach ($codes as $name => $code) {
        if ($entered_code === $code) {
            $_SESSION["authenticated"][$name] = true; // Voeg de afbeelding toe aan de sessie
            break; // Stop de loop als een code is geverifieerd
        }
    }
}

// Controleer welke afbeeldingen zijn geverifieerd
$authenticated_images = isset($_SESSION["authenticated"]) ? $_SESSION["authenticated"] : [];
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beveiligde Pagina</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            padding: 50px;
            background-color: #f4f4f4;
        }
        .input-container input {
            padding: 10px;
            font-size: 16px;
            width: 200px;
            margin-right: 10px;
        }
        .input-container button {
            padding: 10px;
            font-size: 16px;
        }
        #errorMessage {
            color: red;
            margin-top: 20px;
        }
        img {
            margin-top: 20px;
            max-width: 300px; /* Zorg ervoor dat de afbeeldingen niet te groot zijn */
        }
    </style>
</head>
<body>

<h1>Voer de toegangscode in</h1>
<form method="post">
    <div class="input-container">
        <input type="password" name="access_code" placeholder="Toegangscode" required>
        <button type="submit">Inloggen</button>
    </div>
</form>

<?php if (!empty($authenticated_images)): ?>
    <h2>Beveiligde Afbeeldingen</h2>
    <?php foreach ($authenticated_images as $name => $value): ?>
        <h3><?php echo $name; ?></h3>
        <img src="<?php echo strtolower($name); ?>.png" alt="<?php echo $name; ?>" />
    <?php endforeach; ?>
<?php endif; ?>

<?php if (isset($error_message)): ?>
    <p id="errorMessage"><?php echo $error_message; ?></p>
<?php endif; ?>

</body>
</html>
