php
<?php
// Connexion à PlanetScale via PDO
$host = getenv('DB_HOST');
$db   = getenv('DB_NAME');
$user = getenv('DB_USER');
$pass = getenv('DB_PASS');

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);
} catch (PDOException $e) {
    die("Erreur de connexion: ". $e->getMessage());
}

// Traitement du formulaire
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nom = $_POST["nom"]?? '';
    $email = $_POST["email"]?? '';

    if ($nom && $email) {
        $stmt = $pdo->prepare("INSERT INTO utilisateurs (nom, email) VALUES (?,?)");
        $stmt->execute([$nom, $email]);
        echo "<p>✅ Inscription réussie!</p>";
} else {
        echo "<p style='color:red;'>❌ Tous les champs sont obligatoires.</p>";
}
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription Guillaume Boost</title>
</head>
<body>
    <h1>Formulaire d'inscription</h1>
    <form method="POST">
        <label>Nom:</label><br>
        <input type="text" name="nom"><br><br>
        <label>Email:</label><br>
        <input type="email" name="email"><br><br>
        <button type="submit">S'inscrire</button>
    </form>
</body>
</html>
