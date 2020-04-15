joueur
<?php
is_connet();
echo $_SESSION['user']['nom'] ."\n\n";
echo $_SESSION['user']['prenom'] ."\n\n";
echo $_SESSION['user']['login'] ."\n\n";
echo $_SESSION['user']['photo'];
?>
<br>
<a href="index.php?statut=logout">Deconnexion</a>