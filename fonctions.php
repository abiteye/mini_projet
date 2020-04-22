<?php
#fonction qui recupère les fichiers json 
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
function is_connect(){
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
function array_sort($array,$on,$order=SORT_ASC)
{
    $new_array = array();
    $sortable_array = array();

    if (count($array) > 0) {
        foreach ($array as $k => $v) {
            if (is_array($v)) {
                foreach ($v as $k2 => $v2) {
                    if ($k2 == $on) { 
                        $sortable_array[$k] = $v2;
                    }
                }
            } else {
                $sortable_array[$k] = $v;
            }
        }

        switch ($order) {
            case SORT_ASC:
                asort($sortable_array);
                break;
            case SORT_DESC:
                arsort($sortable_array);
                break;
        }

        foreach ($sortable_array as $k => $v) {
            $new_array[$k] = $array[$k];
        }
    }

    return $new_array;
}
?>