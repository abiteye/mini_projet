<?php
#fonction qui trqite les fichiers json
function getData($file="utilisateur"){
  $data=file_get_contents("../data/".$file.".json");
  $data=json_decode($data, true);
  return $data;
}
#fonction pour la connexion des utilisateurs
function connexion($login,$pwd){
  $users=getData();
    foreach ($users as $key => $user){
      if($user["login"]===$login && $user["password"]===$pwd){
        $_SESSION['user']=$user;
        $_SESSION['statut']="login";
        if($user["profil"]=="admin"){
          return "accueil";
        }else{
          return "jeux"; 
        }
      }    
  }
  return "error";
}
#Verification de la connexion
function is_connet(){
  if(!isset($_SESSION['statut'])){  
    header("location:index.php");
  }
}
#fonction de deconnexion
function deconnexion(){
      unset($_SESSION['user']);
      unset($_SESSION['statut']);
      session_destroy();
}
?>