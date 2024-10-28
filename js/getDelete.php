<?php
require_once "../pdo_inc.php";
header("content-type:application/json");

$textReq = "SELECT COUNT(contribution.id) as contribution_count ";
$textReq.= "FROM membre INNER JOIN contribution ON membre.id = contribution.membre_id ";
$textReq.= "WHERE membre.id = :id";

$req = $pdo->prepare($textReq);
$req->execute(['id' => $_GET['id']]);  // Assure-toi que l'ID est passé via $_GET

$tabRes = $req->fetch(PDO::FETCH_ASSOC);
echo json_encode($tabRes);
