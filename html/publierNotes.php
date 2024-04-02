<?php
include('db.php');
require_once('fonctions.php');

$nomM = secure(isset($_POST['nomM'])?$_POST['nomM'] :'');
$niveau =isset($_POST['niveau'])?$_POST['niveau'] :'';

if(!empty($nomM) &&!empty($niveau)){
    $query="SELECT * FROM matieres WHERE nom_matiere ='$nomM'";
    $resultM= $pdo->query($query);
   $matiere = $resultM->fetch();
    $idm= $matiere['matiere _id'];
    $nom= $matiere['nom_matiere'];

    $queryN="SELECT * FROM niveaux WHERE nom_niveau='$niveau'";
    $resultN =$pdo->query($queryN);
    $niveauN = $resultN->fetch();
    $params=array($nom,$niveauN);
    $_SESSION['params'] = $params;
    header('Location:index.php');
}


?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Publier note</title>
   
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/monstyle.css">
    
</head>
<body>
    <?php
    include ('menu.php');
    ?>

<div class="container">
        <div class="panel panel-primary margetop60">
            <div class="panel-heading text-center">Veuillez saisir sur la matière...</div>
            <div class="panel-body">

            <form method="POST" class="form">
                    <div class="form-group">
                        <label for="nomM">Nom de la matiere</label>
                    <input type="text" name="nomM" 
                                   placeholder="Nom de la matière"
                                   class="form-control"/>
                    </div>

                    <div class="form-group">
                        <label for="niveau">Classe:</label>
                            <select name="niveau" class="form-control " id="niveau">
                                <option value="tleA" >TleA</option>
                                <option value="tleD"  >TleD</option>
                                <option value="1A"  >1ereA</option>
                                <option value="1D"  >1ereD</option>
                                <option value="2C" selected  >2ndC</option>
                                <option value="2A" selected  >2ndA</option>
                                <option value="3e" selected  >3eme</option>
                                <option value="4e" selected  >4eme</option>
                                <option value="5e" selected  >5eme</option>
                                <option value="6e" selected  >6eme</option>
                            </select>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-success" name="submit">
                        <span class="glyphicon glyphicon-ok"></span>
                        Ok
                        </button> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <!-- <span> <a href="upload.php">Uploader un ficher csv</a></span> -->
                    </div>
                </form>

            </div>
        </div>
    </div>
</body>
</html>