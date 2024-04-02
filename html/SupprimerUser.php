<?php
session_start();
require_once('db.php');
include('fonctions.php');
if ($_SESSION['user']){
    $idu = secure(isset($_GET['idU']) ? $_GET['idU'] : 0);
    $query= "DELETE FROM utilisateur WHERE iduser=?";
    $params = array($idu);
    $result = $pdo->prepare($query);
    $result->execute($params);
    header('Location: utilisateurs.php');
}else{
    header('Location: login.php');
}

?>