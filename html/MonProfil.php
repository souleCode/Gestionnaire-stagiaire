<?php
    require_once('db.php');
    include('fonctions.php');
    

    $ids =isset($_GET['id']) ? $_GET['id']:0;
    $ids= secure($ids);
    $queryS= "SELECT * FROM stagiaire WHERE idStagiaire='$ids'";
    $resultS= $pdo->query($queryS);
    $stagiaire = $resultS->fetch();
    echo $queryS;
    die();

    // $nom =  $eleve['nom'];
    // $prenom =  $eleve['prenom'];
    // $genre =  $eleve['civilite'];
    // $photo =  $eleve['photo'];
    // $birthday =  $eleve['birthday'];
    // $phone =  $eleve['phone'];
    // $groupe =  $eleve['groupe'];
    // $idF =  $eleve['idFiliere'];

    $queryF= "SELECT * FROM filiere WHERE idFiliere=$idF";
    $resultF= $pdo->query($queryF);
    $matiere = $resultF->fetch();
    $nomMatiere= $matiere['nomFiliere'];
    $niveau = $matiere['niveau'];


    $identifiant = code_generetor();
    
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modification du profil</title>
   
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/monstyle.css">
    
</head>
<body>
    <?php
    include ('menu.php');
    ?>

<div class="container col-lg-4 col-lg-offset-4 col-md-6 col-md-offset-3 margetop60">
        <div class="panel panel-primary margetop60">
            <div class="panel-heading text-center"></div>
            <div class="panel-body">




            <table class="table table-striped table-bordered">

                        <tbody>
                           
                            
                                
                                 <tr>
                                    
                                    <td> code:</td>
                                    <td> <?php echo $identifiant  ?></td>
                                </tr>

                                <tr>
                                    
                                    <td> Filiere:</td>
                                    <td> <?php echo $nomMatiere ?></td>
                                </tr>

                                <tr>
                                    
                                    <td> Niveau:</td>
                                    <td> <?php echo $niveau ?></td>
                                </tr>

                                <tr>
                                    
                                    <td> Groupe:</td>
                                    <td> <?php echo $groupe ?></td>
                                </tr>

                                <tr>
                                    
                                    <td> Nom:</td>
                                    <td> <?php echo $nom ?> </td>
                                </tr>

                                <tr>
                                    
                                    <td> Prenom:</td>
                                    <td> <?php echo $prenom ?></td>
                                </tr>
                                <tr>
                                    
                                    <td> Sexe:</td>
                                    <td> <?php echo $civilite ?></td>
                                </tr>
                                <tr>
                                    
                                    <td> Telephone:</td>
                                    <td> <?php echo $phone ?></td>
                                </tr>
                                <tr>
                                    
                                    <td> Date de naissance:</td>
                                    <td> <?php echo $birthday ?></td>
                                </tr>
                        </tbody>
                    </table>



                    <div class="form-group margeR60">
                                    <button type="submit" class="btn btn">
                                    <span class="glyphicon glyphicon-download"></span>
                                    <a href="attest.php">Telecharger l'attestion d'inscription</a>
                                    </button>
                    </div>

            <div class="form-group margeR60">
                        <button type="submit" class="btn btn">
                        <span class="glyphicon glyphicon-edit"></span>
                        <a href="profil.php?id= <?php echo $id?>">Modifier votre profil</a>
                        </button>
            </div>

                   
                    &nbsp;&nbsp;
                        
                </form>

            </div>
        </div>
    </div>
</body>
</html>