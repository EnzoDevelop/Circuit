<?php
require __DIR__.'/../utils_inc./inc_pdo.php';

function handleChronometrageRequest($pdo) {
    $participantInfo = null; 
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id_participant = $_POST['id_participant'];
        $id_etape = $_POST['id_etape'];
        $mode = $_POST['mode'];
        $current_time = date("Y-m-d H:i:s");

        if ($mode === "auto") {
            // Sauvegarde du temps en mode automatique
            $stmt = $pdo->prepare("INSERT INTO chronometre (id_participant, id_etape, debut_passage) VALUES (?, ?, ?) ON DUPLICATE KEY UPDATE fin_passage = ?");
            $stmt->execute([$id_participant, $id_etape, $current_time, $current_time]);
        } elseif ($mode === "manual") {
            // Saisie manuelle du temps
            $manual_time = $_POST['manual_time'];
            $stmt = $pdo->prepare("UPDATE chronometre SET fin_passage = ? WHERE id_participant = ? AND id_etape = ?");
            $stmt->execute([$manual_time, $id_participant, $id_etape]);
        }

        // Récupérer les infos du participant
        $participantInfo = fetchParticipantInfo($pdo, $id_participant, $id_etape);
    }
    return $participantInfo; 
}

function fetchParticipantInfo($pdo, $id_participant, $id_etape) {
    $stmt = $pdo->prepare("
        SELECT p.nom, p.prenom, c.fin_passage 
        FROM chronometre c 
        JOIN participant p ON c.id_participant = p.id_participant 
        WHERE c.id_participant = ? AND c.id_etape = ?
    ");
    $stmt->execute([$id_participant, $id_etape]);
    return $stmt->fetch(PDO::FETCH_ASSOC); 
}

function fetchEtapes($pdo) {
    $stmt = $pdo->query("SELECT id_etape, nom FROM etape ORDER BY rang");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
