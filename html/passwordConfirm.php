<?php
include('session.php');
include('db.php');
require_once('fonctions.php');
$iduser=$_SESSION['user']['iduser'];
$old_pwd = secure(isset($_POST['pwd1'])?$_POST['pwd1']:'');
$new_pwd = secure(isset($_POST['pwd2'])?$_POST['pwd2']:'');


if(!empty($old_pwd)&&!empty($new_pwd)){
    $query = "SELECT * FROM utilisateur WHERE iduser=$iduser AND pwd=MD5('$old_pwd')";
    $result=$pdo->prepare($query);
    $result->execute();
   
    if($result->fetch()){
        $requete ="UPDATE utilisateur SET pwd=MD5(?) WHERE iduser=?";
        $params = array($new_pwd,$iduser);
        $result =$pdo->prepare($requete);
        $result->execute($params);
        $_SESSION['felicitation']="Félicitation!!! Votre mot de passe a été changé avec succès";
        header("Location:login.php");
    }else{
        $msg= "Erreur: Données incorrectes.";
        header("Location: alerte.php?message=$msg");
    }
}

?>