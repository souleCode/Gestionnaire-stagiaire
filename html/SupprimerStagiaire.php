<?php
session_start();
if ($_SESSION['user']){
    require_once('db.php');
    include('fonctions.php');

    $ids = secure(isset($_GET['idS']) ? $_GET['idS'] : 0);

    $query= "DELETE FROM stagiaire WHERE idStagiaire=?";
    $params = array($ids);
    $result = $pdo->prepare($query);
    $result->execute($params);
    header('Location: stagiaires.php');
}else{
    header('Location: login.php');
}

?>