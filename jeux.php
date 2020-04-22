
<?php
    is_connect();

    $liste = getData();
    $liste = array_sort($liste, 'score', SORT_DESC);
    foreach ($liste as $key => $value) {
        if ($value['profil'] == 'joueur') {
            $tableau[]=$value;
        }
    }
    $_SESSION['tableau']= $tableau;
    
    $nbrePage=ceil(sizeof($tableau)/5);
    if(!isset($_GET['page'])){
        $page=1;    
    }else{
        $page=$_GET['page'];    
    }
    $min=($page-1)*5; $max=$min+5;
    if($page<=1){
        $page=1;
        $prec='none';
    }elseif($page>$nbrePage){
        $page=$nbrePage;
    }
    if($page==$nbrePage){
        $max=sizeof($tableau);
        $next='none'; 
    }    
?>
<div class="cadre-jeux">
    <div class="entete-jeux">
        <img src="<?=$_SESSION['user']['photo'];?>" alt="" class="photo-form-joueur">
        <div class="titre-jeux">BIENVENUE SUR LA PLATEFORME DE JEUX DE QUIZZ<br>
                                JOUER ET TESTER VOTRE NIVEAU DE CULTURE GÉNÉRALE</div>        
        <div class="prenom-nom-jou"><?=$_SESSION['user']['prenom']?> 
                                    <?=$_SESSION['user']['nom']?>
        </div>
        <button type="submit" class="dec-form-jeux">
        <a class="link-dec-form-jeux" href="index.php?statut=logout">Déconnexion</a></button> 
    </div>
    <div class="bg-page-jeu">
        <div class="partie-jeu">
        </div>

        <div class="partie-score">
            <button type="button" class="afficheScore" >
                <a href="index.php?lien=jeux&choix=topfive">Top scores</a>
            </button>
            <button type="button" class="afficheScore"> 
            <a href="index.php?lien=jeux&choix=topfav">Mon meilleur score</a>
            </button>
<?php
if(isset($_GET['choix'])){
    if($_GET['choix']=="topfav"){
        echo $_SESSION['user']['score']; 
    }

}
        if(isset($_GET['choix'])){
            if ($_GET['choix']=="topfive") {
                ?>
                <table>

        <tbody>
            <?php
            $file= '../data/utilisateur.json';
            $data= file_get_contents($file);
            $array= json_decode($data, true);
            $point= "pts"; 

            
            $k=0;
            for ($i=0; $i<count($array); $i++)
            { 
                if(isset($array[$i]["profil"])&&($array[$i]["profil"]=="joueur")){
                    $k++;

                ?>
                <div class="top-five"> 
                     <?= $array[$i]['prenom']?>
                     <?= $array[$i]['nom']?> 
                     <?= $array[$i]['score']?> pts<br> 
                </div> 
                <?php

                if($k==5){
                break;
                }
            }
            } 
        
            ?>
            </tbody>
            </table> 
          <?php  }
        }
 ?>
        </div>
    </div>
 
</div>