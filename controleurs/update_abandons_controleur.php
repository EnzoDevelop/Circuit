<?php
require_once "../utils_inc/inc_pdo.php"; // Connexion à la base de données

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $abandon = $_POST['abandon'];

    // Validation de l'ID
    if (is_numeric($id)) {
        // Mise à jour du statut d'abandon
        $stmt = $pdo->prepare("UPDATE participant SET abandon = :abandon WHERE id_participant = :id");
        $stmt->execute([':abandon' => $abandon, ':id' => $id]);

        // Vérifier si la mise à jour a réussi
        if ($stmt->rowCount()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false]);
        }
    } else {
        echo json_encode(['success' => false]);
    }
} else {
    echo json_encode(['success' => false]);
}
?>
