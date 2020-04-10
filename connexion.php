<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="miniprojet.css"/>
    <title>Page de connexion</title>
</head>
<body>
    <?php include ("entete.php");?>

    <div class="conteneur">

        <div class="ouverture">
            <div id="haut">
                <p>Login Form</p><input id="bouton" type="submit" value="x"> 
            </div>
            <div id="bas">
              <form action="" method="post"> 
                <input id="login" type="text" placeholder="Login" name="login">
                <img id="image1" src="Images/Icônes/ic-login.png" alt="l'icone dulogin"><br>
                <input id="password" type="password" placeholder="Password" name="password">
                <img id="image2" src="Images/Icônes/ic-password.png" alt="l'icone du mot de passe"><br>
                <input id="boutonconnecter" type="submit" name="connecter" value="Connexion">
                <a href="inscription.php">S'inscrire pour jouer?</a> 
              </form> 
            </div>

        </div>

    </div>

</body>
</html>