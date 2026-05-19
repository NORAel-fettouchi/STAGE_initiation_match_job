<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Connexion à la base de données
$host = 'localhost';
$dbname = 'nom_de_ta_base'; // 🔁 À modifier avec le vrai nom de ta base
$user = 'root';
$pass = ''; // 🔐 Attention : ne jamais exposer ce genre d’info en production

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

// Vérifie si les champs du formulaire existent
if (
    isset($_POST['nom'], $_POST['prenom'], $_POST['email'], $_POST['motdepasse'], $_POST['confirmer'])
) {
    // Récupérer les données et les nettoyer
    $nom = htmlspecialchars(trim($_POST['nom']));
    $prenom = htmlspecialchars(trim($_POST['prenom']));
    $email = htmlspecialchars(trim($_POST['email']));
    $motdepasse = $_POST['motdepasse'];
    $confirmer = $_POST['confirmer'];

    // Vérification basique
    if ($motdepasse !== $confirmer) {
        die("❌ Les mots de passe ne correspondent pas.");
    }

    // Vérification que l'e-mail n'existe pas déjà
    $check = $pdo->prepare("SELECT id FROM utilisateurs WHERE email = ?");
    $check->execute([$email]);
    if ($check->rowCount() > 0) {
        die("⚠️ Cet email est déjà utilisé.");
    }

    // Hachage du mot de passe
    $motdepasse_hash = password_hash($motdepasse, PASSWORD_DEFAULT);

    // Insertion dans la base
    try {
        $sql = "INSERT INTO utilisateurs (nom, prenom, email, motdepasse) VALUES (?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$nom, $prenom, $email, $motdepasse_hash]);

        // Redirection vers la page de connexion
        header("Location: login.html");
        exit();
    } catch (PDOException $e) {
        die("Erreur lors de l'enregistrement : " . $e->getMessage());
    }
} else {
    die("⛔ Tous les champs sont obligatoires.");
}
?>
