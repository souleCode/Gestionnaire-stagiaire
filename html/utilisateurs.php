<?php
require_once('db.php');
include('fonctions.php');
// include('session.php');

$size=isset($_GET["size"])?$_GET["size"]:6;
$page= isset($_GET["page"])?$_GET["page"]:1;
$offset = ($page-1)*$size;

$identifiant= secure(isset($_GET["identifiant"])?$_GET["identifiant"]:'');

$size= secure($size);
$page = secure($page);
$identifiant = secure($identifiant);

    $queryUser = "SELECT * FROM eleve WHERE identifiantE LIKE '%$identifiant%'";
    $requeteCount ="SELECT COUNT(*) countU FROM eleve";

    
$resultuser = $pdo->query($queryUser);

$resultatCount=$pdo->query($requeteCount);

//code pour la pagination
$tabCount=$resultatCount->fetch();
    $nbrUser=$tabCount['countU'];
    $reste=$nbrUser % $size;   
    if($reste===0) 
        $nbrPage=$nbrUser/$size;   
    else
        $nbrPage=floor($nbrUser/$size)+1; 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <meta http-equiv="refresh" content="60"> -->
    <title>Les élèves de ma classe</title>
   
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
            <div class="panel-heading text-center">Recherche des élèves...</div>
            <div class="panel-body">
                <form method="GET" class="form-inline" action ="utilisateurs.php">
                    <div class="form-group">
                           <input type="text" name="identifiant" 
                            placeholder="Entrer l'identifiant" 
                            class="form-control"
                            value="<?php echo $identifiant?>"/>
                    </div>
                    
                    <button type="submit" class="btn btn-success">
                    <span class="glyphicon glyphicon-search"></span>
                    Chercher...
                    </button>
                </form>
            </div>
        </div>
        <div class="panel panel-primary">
            <div class="panel-heading text-center">Liste des élèves (<?php echo $nbrUser?> inscrits)</div>
                <div class="panel-body">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Nom&Prenom</th>
                                <th>Identifiant</th>
                                
                                    <th>Action</th>
                                
                            </tr>
                        </thead>

                        <tbody>
                           
                                <?php
                                while($user=$resultuser->fetch()) { ?>
                                        <!-- Pour changer la couleur de la ligne du tableau en fonction de l'etat de l'utilisateur -->
                                <tr class="<?php echo $user['etat']==1? 'success': 'danger' ?>">
                                    <td> <?php echo $user['nom'].' '. $user['prenom'] ?></td>
                                    <td> <?php echo $user['identifiantE'] ?></td>
                                    

                                
                                    <td>
                                       <a href="editerUser.php?idU=<?php echo $user['ide'] ?>">
                                            <span class="glyphicon glyphicon-edit"></span>
                                        </a> 
                                            &nbsp; 
                                        <a onclick="return confirm('Voulez-vous reellement supprimer cet utilisateur?')" 
                                            href="SupprimerUser.php?idU=<?php echo $user['ide'] ?>">
                                            <span class="glyphicon glyphicon-trash"></span>
                                        </a>
                                        &nbsp;
                                        <a href="activeUser.php?idU=<?php echo $user['ide'] ?>&etat=<?php echo $user['etat'] ?>">
                                                <?php  
                                                    if($user['etat'] ==0){
                                                        echo ' &nbsp; <span class="glyphicon glyphicon-remove"></span>';
                                                    }else{
                                                        echo ' &nbsp; <span class="glyphicon glyphicon-ok"></span>';
                                                    }
                                                ?>
                                        </a>
                                    </td> 
                                

   
                                </tr>
                                <?php } ?>
                               

                            
                        </tbody>
                    </table>
                    <div>
                     <ul class="pagination pagination-lg">
                        <!-- il ya aussi la class nav nav-pills pour les listes ul -->
                        <?php for($i=1;$i<=$nbrPage;$i++){ ?>
                            <li class="<?php if($i==$page) echo 'active' ?>"> 
                                    <a href="utilisateurs.php?page=<?php echo $i;?>&login=<?php echo $login ?>">
                                    <?php echo $i; ?>
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