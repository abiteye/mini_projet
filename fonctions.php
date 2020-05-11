<?php
#fonction qui recupère les fichiers json 
function getData($file="utilisateur"){
  $data=file_get_contents("./data/".$file.".json");
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
          $question = getData('questions');
          $_SESSION['question']=nbreQuestionParJeu($question);
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

function is_entier($char) {
  return (preg_match("/[0-9]/",$char)); 
}
##########################################
function nbreQuestionParJeu($tableauQuestion) {
  $nombre = getData("nombreQuestion");
  $tableau = array();
  while (count($tableau) < $nombre['nombre']) {
    $aleatoire = rand(0,(count($tableauQuestion)-1));
    if (!in_array($tableauQuestion[$aleatoire], $tableau)) {
      $tableau[] = $tableauQuestion[$aleatoire];
    }
  }
  return $tableau;
}



function scoreTotal($tableau){
  $total = 0;
  for ($i=0; $i < count($tableau) ; $i++) { 
    $total = $total + $tableau[$i]['score'];
  }
  return $total;
}


function score($question){
  $score = 0;
  $cocher= '';
  $multiple = [];
  $radio = '';
  for ($i=0; $i < count($question); $i++) { 
      if ($question[$i]['type'] == 'simple') {
          for ($j=0; $j < count($question[$i]['reponsePossible']); $j++) { 
              if ((!empty($question[$i]['answer'])) && in_array($j, $question[$i]['answer'])) {
                  $cocher = $question[$i]['reponsePossible'][$j];
              }
          }
          if ($cocher === $question[$i]['bonneReponse']) {
              $score = $score + $question[$i]['score'];
          }
      }
      elseif ($question[$i]['type'] == 'text') {
          if ((!empty($question[$i]['answer'])) && $question[$i]['answer'] === $question[$i]['bonneReponse']) 
          {
              $score = $score + $question[$i]['score'];
          } 
      }
      else{
          for ($j=0; $j < count($question[$i]['reponsePossible']); $j++) { 
              if (!empty($question[$i]['answer']) && in_array('result'.$j, $question[$i]['answer'])) {
                  $multiple[] = $question[$i]['reponsePossible'][$j];
              }
          }
          if ($multiple === $question[$i]['bonneReponse']) {
              $score = $score + $question[$i]['score'];
          }
          $multiple = [];
      }       
      
  }
  return $score;
}
?>