<?php
require_once('db.php');
include('fonctions.php');
include('session.php');

// $offset= 4;
    // $page=1=====> offset=0;
    // $page=2=====> offset=5;
    // $page=3=====> offset=10;
    // $page=4=====> offset=15;
    // $page=6=====> offset=20;
    // $page=7=====> offset=25;
    // Donc la relation entre page,offset et size est offset=(page-1)*size.
// $page = 3;    
$size=isset($_GET["size"])?$_GET["size"]:5;
$page= isset($_GET["page"])?$_GET["page"]:1;
$offset = ($page-1)*$size;
$nomf= isset($_GET["nomF"])?$_GET["nomF"]:''; # equivaut a ligne de code mise en comment en haut.
$niveau=isset($_GET["niveau"])?$_GET["niveau"]:'all';

$size= Secure($size);
$page = Secure($page);
$nomf = Secure($nomf);
$niveau = Secure($niveau);

if($niveau=='all'){
    $query = "SELECT * FROM matieres 
    WHERE nom_matiere like '%$nomf%' 
    LIMIT $size OFFSET $offset";

    $requeteCount ="SELECT COUNT(*) countF FROM matieres  WHERE nom_matiere like '%$nomf%'";
}else{
    $query = "SELECT * FROM matieres
    WHERE nom_matiere like '%$nomf%'  
    LIMIT $size OFFSET $offset";

    $requeteCount ="SELECT COUNT(*) countF FROM matieres WHERE nom_matiere like '%$nomf%'";
}
$resultF = $pdo->query($query);
$resultatCount=$pdo->query($requeteCount);
$tableCount= $resultatCount->fetch();
$nbrF = $tableCount['countF'];

// code pour la pagination
$reste= $nbrF % $size;
if($reste===0){
    $nbrP= $nbrF/$size;
}else{
    $nbrP= floor($nbrF/$size)+1;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <meta http-equiv="refresh" content="60"> -->
    <title>Gestionnaire des matières</title>
   
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
            <div class="panel-heading text-center">Recherche des matieèes...</div>
            <div class="panel-body">
                <form method="GET" class="form-inline" action ="filieres.php">
                    <div class="form-group">
                    <input type="text" name="nomF" 
                                   placeholder="Nom de la matière"
                                   class="form-control"
                                   value="<?php echo $nomf ?>"/>
                    </div>
                    
                    
                    <button type="submit" class="btn btn-success">
                    <span class="glyphicon glyphicon-search"></span>
                    Chercher...
                    </button>
                    &nbsp;
                    <?php
                        // if($_SESSION['user']['role'] =='ADMIN'){?>
                        <!-- //     <a href="AjouterFiliere.php"> -->
                        <!-- //         <span class="glyphicon glyphicon-plus ">Ajouter</span> -->
                        <!-- //     </a> -->
                         <?php  ?>
                </form>
            </div>
        </div>
        <div class="panel panel-primary">
            <div class="panel-heading text-center">Liste des matières (<?php echo $nbrF?> cours)</div>
                <div class="panel-body">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Code de la matière</th><th>Nom matière</th>
                                
                                    <th>Action</th>
                               
                            </tr>
                        </thead>

                        <tbody>

                        
                           
                                <?php

                                        $annee = date('Y'); 
                                         
                                        // Formater le numéro séquentiel avec des zéros à gauche pour qu'il fasse toujours 3 caractères
                                        $numero_sequence_formate = sprintf("%01d", 0);
                                        $identifiant = $annee . '-M' . $numero_sequence_formate;

                                        

                                while($filiere=$resultF->fetch()) { ?>
                                 <tr>
                                    <td> <?php echo $identifiant. $filiere['matiere_id'] ?></td>
                                    <td> <?php echo $filiere['nom_matiere'] ?></td>
                                    
                                    
                                        <td>
                                       <a onclick="return confirm('Voulez-vous apporter une modification à cette filiere?')" href="editerFiliere.php?idF=<?php echo $filiere['matiere_id'] ?>">
                                            <span class="glyphicon glyphicon-edit"></span>
                                        </a> 
                                            &nbsp; 
                                        <a onclick="return confirm('Voulez-vous reellement supprimer cette filiere?')" href="SupprimerFiliere.php?idF=<?php echo $filiere['matiere_id'] ?>">
                                            <span class="glyphicon glyphicon-trash"></span>
                                        </a>
                                    </td>    
                                    
                                    </tr>
                                <?php } ?>
                               

                            
                        </tbody>
                    </table>
                    <div>
                     <ul class="pagination pagination-lg">
                        <!-- ilya aussi la class nav nav-pills pour les listes ul -->
                        <?php
                        for ( $i = 1; $i <= $nbrP; $i++) { ?>

                           <li class="<?php if($i==$page) echo 'active' ?>"> 
                              <a href="filieres.php?page=<?php echo $i;?>
                                 &nomf=<?php echo $nomf?>
                                 &niveau=<?php echo $niveau ?>">
                                 <?php echo $i;?>
                              </a> 
                          </li> 

                       <?php } ?>
                    </ul>
                    </div>
            </div>
        </div>
    </div>
    <script src="../assets/js/bootstrap.min (1).js" ></script>
</body>
</html>