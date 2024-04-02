<?php
    include('session.php');
?>
 <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/monstyle.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/font-awesome.min.css">

<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <a href="../index.php " class="navbar-brand">E-School</a>
        </div>
        <ul class="nav navbar-nav" >
            
            <li><a href="filieres.php"> Filieres</a></li>
            <li><a href="matiereNotes.php"> Mes notes</a></li>
            
                    <li> <a href="allStudent.php"> Eleves</a></li>
                    <li> <a href="publierNotes.php"> Publier des notes</a></li>
                    <li> <a href="utilisateurs.php">Utilisateurs</a> </li>
                    
        </ul>
        
           
                    <ul class="nav navbar-nav navbar-right" >
                        <li> <a href="MonProfil.php"><i class="glyphicon glyphicon-user"></i> </a></li>
                        <li><a href="seDeconnecter.php"><i class="glyphicon glyphicon-log-out"></i> &nbsp;Deconnexion</a></li>
                    </ul>
           
                <ul class="nav navbar-nav navbar-right" >
                    <li><a href="NouveauCompte.php"> <i class="glyphicon glyphicon-log-in"></i>&nbsp;Connexion</a></li>
                </ul>
             
            



    </div>
</nav>