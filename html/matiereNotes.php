<?php
require_once('db.php');
include('fonctions.php');
include('session.php');

$size=isset($_GET["size"])?$_GET["size"]:5;
$page= isset($_GET["page"])?$_GET["page"]:1;
$offset = ($page-1)*$size;
$nomf= isset($_GET["nomF"])?$_GET["nomF"]:''; # equivaut a ligne de code mise en comment en haut.
$niveau=isset($_GET["niveau"])?$_GET["niveau"]:'all';

$eleve=$_SESSION['user'];

$idel = $eleve['eleve_id'];
$queryM = "SELECT matiere_id FROM inscriptions WHERE eleve_id='$idel'";
$result = $pdo->query($queryM);

$matiere_ids = array(); // Tableau pour stocker tous les matiere_id

while ($row = $result->fetch()) {
    $matiere_ids[] = $row['matiere_id']; // Ajouter chaque matiere_id au tableau
   
};


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <meta http-equiv="refresh" content="60"> -->
    <title>Toutes mes filières</title>
   
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/monstyle.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/font-awesome.min.css">
    
</head>
<body>
    <?php
    include ('menu.php');
    ?>
    <div class="container">
        <div class="panel panel-success margetop60">
            <div class="panel-heading text-center"><h2>Reserver aux notes</h2></div>
            
        </div>
        <div class="panel panel-primary">
            <div class="panel-heading text-center">Mes matières</div>
                <div class="panel-body">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Code de la matière</th><th>Nom matière</th><th>Voir la note</th>
                                
                                    
                               
                            </tr>
                        </thead>

                        <tbody>

                        
                           
                                <?php

                                        $annee = date('Y'); 
                                         
                                        // Formater le numéro séquentiel avec des zéros à gauche pour qu'il fasse toujours 3 caractères
                                        $numero_sequence_formate = sprintf("%01d", 0);
                                        $identifiant = $annee . '-M' . $numero_sequence_formate;

                                        

                                        for($i=0;$i<count($matiere_ids);$i++){?>
                                                <?php
                                                 $idM=$matiere_ids[$i];
                                                        $queryM = "SELECT matiere_id,nom_matiere FROM matieres WHERE matiere_id='$idM'";
                                                        $result = $pdo->query($queryM);
                                                        $Matieres = $result->fetch();       
                                                ?>
                                        
                                        <tr>
                                            <td> <?php echo $identifiant. $Matieres['matiere_id'] ?></td>
                                            <td> <?php echo $Matieres['nom_matiere'] ?></td>
                                    
                                    
                                            <td>
                                            <a href="notes.php?idM=<?php echo $Matieres['matiere_id']?>">
                                                <span class="glyphicon glyphicon-eye-close"></span>
                                            </a> 
                                         
                                            </td>    
                                    
                                        </tr>
                                <?php } ?>
                               

                            
                        </tbody>
                    </table>
                    <div>
                     <ul class="pagination pagination-lg">
                        <!-- ilya aussi la class nav nav-pills pour les listes ul -->
                        
                       
                    </ul>
                    </div>
            </div>
        </div>
    </div>
    <script src="../assets/js/bootstrap.min (1).js" ></script>
</body>
</html>