<?php
    require 'dataBaseConn.php';

    $equipes = $pdo->query("SELECT id_equipe FROM equipe");
    $num_dossard = 1;

    while ($equipe = $equipes->fetch(PDO::FETCH_ASSOC)) {
        $pdo->prepare("UPDATE equipe SET dossard = :dossard WHERE id_equipe = :id_equipe")
            ->execute(['dossard' => str_pad($num_dossard, 4, '0', STR_PAD_LEFT), 'id_equipe' => $equipe['id_equipe']]);
        $num_dossard++;
    }

    $participants = $pdo->query("SELECT id_participant FROM participant WHERE rfid IS NULL");
    foreach ($participants as $participant) {
        $rfid = 'RFID' . str_pad(rand(1000, 9999), 4, '0', STR_PAD_LEFT);
        $pdo->prepare("UPDATE participant SET rfid = :rfid WHERE id_participant = :id_participant")
            ->execute(['rfid' => $rfid, 'id_participant' => $participant['id_participant']]);
    }

    echo "Génération de dossards et de puces RFID terminée.";
?>
