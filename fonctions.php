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
#Verification de l'etat de la connexion
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
#fonction permettant de faire linscription d'un user
function addData($utilisateur){
  $utilisateur=array();
           

  $data= file_get_contents('../data/utilisateur.json');

  $data= json_decode($data, true);    

  $data[]= $utilisateur;

  $data= json_encode($data);

    if (file_put_contents('../data/utilisateur.json', $data)) {
      return true;
    }else{
      return false;
    }  
  
}
# inscription()
?>