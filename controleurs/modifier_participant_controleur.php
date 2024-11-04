<?php
global $pdo; //Connexion à la base de données

// Vérifier si l'ID du participant est passé en paramètre
// Vérifier si l'ID du participant est passé en paramètre
if (!isset($_GET['id'])) {
    echo "ID du participant non fourni.";
    exit;
}

$id = (int)$_GET['id'];

// Récupérer les informations du participant
$query = $pdo->prepare("SELECT * FROM participant WHERE id_participant = :id");
$query->execute(['id' => $id]);
$participant = $query->fetch(PDO::FETCH_ASSOC);

if (!$participant) {
    echo "Participant introuvable.";
    exit;
}

// Si le formulaire est soumis, mettre à jour la colonne "abandon"
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $abandon = isset($_POST['abandon']) ? (int)$_POST['abandon'] : 0;

    $updateQuery = $pdo->prepare("UPDATE participant SET abandon = :abandon WHERE id_participant = :id");
    $updateQuery->execute(['abandon' => $abandon, 'id' => $id]);

    // Redirection vers la liste des participants après la mise à jour
    header("Location: ../vues/import_vue.php");
    exit;
}

// Passer $participant comme variable dans la vue
require "../vues/modifier_participant_vue.php";