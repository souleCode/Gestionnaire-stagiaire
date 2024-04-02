<?php
session_start();
require_once('db.php');
include('fonctions.php');

if($_SESSION['user']){
    $idf = secure(isset($_GET['idF']) ? $_GET['idF'] : 0);
    // Il faut savoir que les tables filiere et stagiaire sont liés
    // dont il faut verifier si aucun stagiaire n'est associé a notre filiere 
    //avant de vouloir supprimer
    $requeteStage = "SELECT count(*) countStage FROM stagiaire WHERE idFiliere=$idf";
    $resultStage= $pdo->query($requeteStage);
    $tabstage= $resultStage->fetch();
    $nbrStage=$tabstage['countStage'];

    if($nbrStage==0){
            $idf =isset($_GET['idF']) ? $_GET['idF'] :'';
        $query= "DELETE FROM filiere WHERE idFiliere=?";
        $params = array($idf);
        $result = $pdo->prepare($query);
        $result->execute($params);
        header('Location: filieres.php');
    }else{
        $msg= "Suppression impossible: Des satgiaires sont associés à cette filières.";
        header("Location: alerte.php?message=$msg");
    }
}else{
    header("Location: login.php");
}




?>