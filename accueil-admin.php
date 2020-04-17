<?php
    is_connet();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="wclassth=device-wclassth, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/quizz.css"/>
    <title>accueil</title>
</head>
<body>
    <div class="cadre">
        <div class="entete1">
            <div class="titre">CRÉER ET PARAMÉTRER VOS QUIZZ</div>
            <button type="submit" class="dec-form" name=><a href="index.php?statut=logout">Déconnexion</a></button>
        </div>
        <div class="container-menu">
            <div class="profil-form">
                <img src="../Images/img5.jpg" class="photo-form" alt="l'avatar de l'admin">
                    AAA<br>BBB 
            </div>
            <div class="menu-form">
                <ul>
                    <li><a href="index.php?lien=accueil&menu=liste-question">Liste Questions                
                        <img src="../Images/icônes/ic-liste-active.png" alt="" class="form-icon-menu"></a>
                    </li>
                    <li><a href="index.php?lien=accueil&menu=inscription">Créer Admin
                        <img src="../Images/Icônes/ic-ajout.png" alt="l'ajout d'admin" class="form-icon-menu"></a>
                    </li>
                    <li><a href="index.php?lien=accueil&menu=joueur">Liste joueurs
                        <img src="../Images/Icônes/ic-liste.png" alt="liste des joueurs" class="form-icon-menu"></a>
                    </li>
                    <li><a href="">Créer Questions
                        <img src="../Images/Icônes/ic-ajout.png" alt="l'ajout de questions" class="form-icon-menu"></a>
                    </li>
                </ul>
            </div>
            <?php
                if(isset($_GET['menu']))
                {
                    if($_GET['menu']=="liste-question"){
                        include("../pages/liste-question.php");
                    } 
                    if($_GET['menu']=="inscription"){
                        include("../pages/inscription.php");
                    } 
                    if($_GET['menu']=="joueur"){
                        include("../pages/joueur.php");
                    } 
                    if($_GET['menu']=="question"){
                        include("../pages/question.php");
                    } 
                }else{
                    include("../pages/liste-question.php");
                }
            ?>
        </div>        
    </div>
</body>
</html>