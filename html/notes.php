<?php
session_start();
require_once('db.php');
include('fonctions.php');

$idM =secure($_GET['idM']);
$eleve =$_SESSION['user'];
$id =$eleve['eleve_id'];

//requete matiere
$queryMatiere ="SELECT nom_matiere FROM matieres WHERE matiere_id = $idM";
$stat =$pdo->query($queryMatiere);
$matiere = $stat->fetch();
$matiere=$matiere['nom_matiere'];

//requete note de la matiere
$queryNotes ="SELECT * FROM notes WHERE matiere_id = $idM 
        AND inscription_id = (SELECT eleve_id FROM inscriptions WHERE inscription_id=$id)";
$reslt = $pdo->query($queryNotes);
$notesInfos = $reslt->fetchAll();

echo $id;
echo '<pre>';print_r($notesInfos);echo '</pre>';








?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Note</title>
   
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/monstyle.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/maicons.css">
    
</head>
<body>

<div class="container col-lg-4 col-lg-offset-4 col-md-6 col-md-offset-3">
        <div class="panel panel-danger margetop60">
            <div class="panel-heading text-center"></div>
            <div class="panel-body">
               
            <table class="table table-striped table-bordered">
            <thead>
            <thead>
        <tr>
            <th>Matière</th>
            <th>Note CC</th>
            <th>Note Exam</th>
            <th>Decision</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <?php
              if(noteVide($notesInfos)){?>
                    <td><?php echo $matiere ?></td>
                    <?php if(noteType($notesInfos['type_note'])=='CC'){?>
                        <td><?php echo $notesInfos['valeur_note'] ?></td>
                        <td>--</td>
                    <?php } else if (noteType($notesInfos['type_note'])=='EXAM') {?>
                        <td>--</td>
                        <td><?php echo $notesInfos['valeur_note'] ?></td>
                    <?php } ?>
                    <td><?php echo decision($notesInfos['valeur_note']) ?></td>
            <?php }else{?>
                <td><?php echo $matiere?> </td>
                <td><?php echo '--'  ?></td>
                <td><?php echo '--'  ?></td>
                <td><?php echo '--'  ?></td>

            <?php } ?>
        </tr>
    </tbody>

</table>            
                    


                    
            </div>
        </div>
</div>
</body>

<script src="../assets/js/jquery-3.3.1.js"></script>
<script src="../assets/js/monjs.js"></script>
</html>