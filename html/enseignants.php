<?php
require_once('db.php');
include('fonctions.php');


// if(issset($_GET["nomFiliere"]))
//     $nomf=$_GET["nomFiliere"];
// else
//     $nomFiliere='';
// $size=5;

// $offset= 4;
    // $page=1=====> offset=0;
    // $page=2=====> offset=5;
    // $page=3=====> offset=10;
    // $page=4=====> offset=15;
    // $page=6=====> offset=20;
    // $page=7=====> offset=25;
    // Donc la relation entre page,offset et size est offset=(page-1)*size.
// $page = 3;    
$size=isset($_GET["size"])?$_GET["size"]:6;
$page= isset($_GET["page"])?$_GET["page"]:1;
$offset = ($page-1)*$size;

$requeteFiliere = "SELECT * FROM filiere";

$nomPrenom= isset($_GET["nomPrenom"])?$_GET["nomPrenom"]:''; # equivaut a ligne de code mise en comment en haut.
$idfiliere=isset($_GET["idfiliere"])?$_GET["idfiliere"]:0;

$size= secure($size);
$page = secure($page);
$nomPrenom = secure($nomPrenom);
$idfiliere = secure($idfiliere);

if($idfiliere==0){
    $queryStagiaire = "SELECT idStagiaire,nom,prenom,nomFiliere,photo,civilite
    FROM filiere AS f, stagiaire AS s
    WHERE f.idFiliere= s.idFiliere AND (nom LIKE '%$nomPrenom%' OR prenom LIKE '%$nomPrenom%')
    LIMIT $size
    OFFSET $offset";

    $requeteCount ="SELECT COUNT(*) countS FROM stagiaire 
    WHERE nom LIKE '%$nomPrenom%' OR prenom LIKE '%$nomPrenom%'";
}else{
    $queryStagiaire = "SELECT idStagiaire,nom,prenom,nomFiliere,photo,civilite
    FROM filiere AS f, stagiaire AS s
    WHERE f.idFiliere= s.idFiliere AND (nom LIKE '%$nomPrenom%' OR prenom LIKE '%$nomPrenom%')
    AND f.idFiliere= $idfiliere
    LIMIT $size
    OFFSET $offset";

    $requeteCount ="SELECT COUNT(*) countS FROM stagiaire
    WHERE (nom LIKE '%$nomPrenom%' OR prenom LIKE '%$nomPrenom%')
    AND idFiliere= $idfiliere";
}


$resultFiliere = $pdo->query($requeteFiliere);
$resultStagiaire = $pdo->query($queryStagiaire);

$resultatCount=$pdo->query($requeteCount);

//code pour la pagination
$tabCount=$resultatCount->fetch();
    $nbrStagiaire=$tabCount['countS'];
    $reste=$nbrStagiaire % $size;   
    if($reste===0) 
        $nbrPage=$nbrStagiaire/$size;   
    else
        $nbrPage=floor($nbrStagiaire/$size)+1; 

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <meta http-equiv="refresh" content="60"> -->
    <title>Gestionnaire des Stagiaires</title>
   
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
            <div class="panel-heading text-center">Recherche des stagiaires...</div>
            <div class="panel-body">
                <form method="GET" class="form-inline" action ="stagiaires.php">
                    <div class="form-group">
                    <input type="text" name="nomPrenom" 
                                   placeholder="Nom&Prenom du stagiaire"
                                   class="form-control"
                                   value="<?php echo $nomPrenom?>"/>
                    </div>
                    <label for="idfiliere">  Filiere:</label>
                    <select name="idfiliere" class="form-control" id="idfiliere"
                            onchange="this.form.submit()">
                            <option value=0>Toutes les filieres</option>
                        <?php
                                    // Pour afficher les filieres renvoyer par la requeteFiliere.
                                    while($filiere=$resultFiliere->fetch()){?>
                                    <option value="<?php echo $filiere['idFiliere'] ?>"
                                        <?php if($filiere['idFiliere']==$idfiliere) echo "selected" ?>>
                                        
                                        <?php echo $filiere['nomFiliere'] ?> 
                                    </option>
                        <?php }?>
                        ?>
                    </select>
                    <button type="submit" class="btn btn-success">
                    <span class="glyphicon glyphicon-search"></span>
                    Chercher...
                    </button>
                    &nbsp;
                    <?php if($_SESSION['user']['role']=='ADMIN'){?>
                        <a href="AjouterStagiaire.php">
                            <span class="glyphicon glyphicon-plus ">Ajouter</span>
                        </a>
                    <?php  }?>
                </form>
            </div>
        </div>
        <div class="panel panel-primary">
            <div class="panel-heading text-center">Liste des Stagiaires (<?php echo $nbrStagiaire?> Stagiares)</div>
                <div class="panel-body">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th><th>Nom du Stagiaire</th>
                                <th>Prenom du Stagiaire</th>
                                <th>Filiere</th>
                                <th>Photo du Stagiaire</th>
                                <?php if($_SESSION['user']['role']=='ADMIN'){?>
                                    <th>Action</th>
                                <?php  }?>
                                
                            </tr>
                        </thead>

                        <tbody>
                           
                                <?php
                                while($stagiaire=$resultStagiaire->fetch()) { ?>
                                <tr>
                                    <td> <?php echo $stagiaire['idStagiaire'] ?></td>
                                    <td> <?php echo $stagiaire['nom'] ?></td>
                                    <td> <?php echo $stagiaire['prenom'] ?></td>
                                    <td> <?php echo $stagiaire['nomFiliere'] ?></td>
                                    <td> 
                                        <img src="../images/<?php echo $stagiaire['photo'] ?>"
                                            width = '50px' height='50px' class="img-circle"></td>
                                    
                                
                                    <?php if($_SESSION['user']['role']=='ADMIN'){?>
                                        <td>
                                            <a href="editerStagiaire.php?idS=<?php echo $stagiaire['idStagiaire'] ?>">
                                                <span class="glyphicon glyphicon-edit"></span>
                                            </a> 
                                                    &nbsp; 
                                            <a onclick="return confirm('Voulez-vous reellement supprimer ce stagiaire?')" 
                                                href="SupprimerStagiaire.php?idS=<?php echo $stagiaire['idStagiaire'] ?>">
                                                <span class="glyphicon glyphicon-trash"></span>
                                            </a>
                                        </td> 
                                    <?php  }?>
                                      
                                </tr>
                                <?php } ?>
                               

                            
                        </tbody>
                    </table>
                    <div>
                     <ul class="pagination pagination-lg">
                        <!-- il ya aussi la class nav nav-pills pour les listes ul -->
                        <?php for($i=1;$i<=$nbrPage;$i++){ ?>
                            <li class="<?php if($i==$page) echo 'active' ?>"> 
                                    <a href="stagiaires.php?page=<?php echo $i;?>&nomPrenom=<?php echo $nomPrenom ?>&idfiliere=<?php echo $idfiliere ?>">
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