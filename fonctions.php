<?php
#fonction de connexion
function connexion($loginUser, $passwordUser) {
  $erreur="Il faut remplir ces champs";
  $donnee=file_get_contents('fichier.json');
  $tabdon = json_decode($donnee, true);
  $tabadmin=$tabdon['admins'];
  $tabjoueur=$tabdon['joueurs'];
  for($i=0; $i<count($tabadmin); $i++) {
    if(($tabadmin[$i]['login']==$loginUser) && ($tabadmin[$i]['password']==$passwordUser)) {
      return $tabdon[$i];
    }
    if($i==(count($tabadmin)-1)) {
      return $erreur;
    }
  }
  var_dump($tabadmin);

}  
?>