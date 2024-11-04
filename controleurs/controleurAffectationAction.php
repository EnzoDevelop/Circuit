<?php
    require __DIR__.'../../utils_inc./inc_pdo.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id_equipe = $_POST['id_equipe'];
        $dossard = $_POST['dossard'];
        $rfid_data = $_POST['rfid'];

        // Affecte le dossard à l'équipe
        $stmt = $pdo->prepare("UPDATE equipe SET dossard = :dossard WHERE id_equipe = :id_equipe");
        $stmt->execute(['dossard' => $dossard, 'id_equipe' => $id_equipe]);

        // Affecte les puces RFID aux participants
        foreach ($rfid_data as $id_participant => $rfid) {
            $stmt = $pdo->prepare("UPDATE participant SET rfid = :rfid WHERE id_participant = :id_participant");
            $stmt->execute(['rfid' => $rfid, 'id_participant' => $id_participant]);
        }

        // Redirige vers  page d'affectation 
        header("Location: ../vues/affectation.php?success=1");
        exit;
    }

