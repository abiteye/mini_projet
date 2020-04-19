<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/quizz.css"/>
    <title>index</title>
</head>
<body>
    <div class="entete">
        <div class="logo"></div>
        <div class="entete-text">Le plaisir de jouer</div>
    </div>
    <div class="conteneur">
        <?php
        session_start();
            require_once('../traitement/fonctions.php');

            if(isset($_GET['lien'])) {
                switch($_GET['lien']){ 
                    case "accueil":
                        require_once('../pages/accueil-admin.php'); 
                    break;    
                    case "jeux":
                        require_once('../pages/jeux.php');
                    break;    
                    case "inscriptionjoueur": 
                        require_once('../pages/inscription_joueur.php');
                    break;    
                }
            }else{
                if(isset($_GET['statut']) && $_GET['statut']==="logout"){ 
                    deconnexion();
                }
                require_once('../pages/connexion.php');
            }
        ?>
    </div>
</body>
</html>