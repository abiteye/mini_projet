<?php
    is_connect();

    $liste = getData();
    $liste = array_sort($liste, 'score', SORT_DESC);
    foreach ($liste as $key => $value) {        
        $tableau[]=$value;
    }
    $_SESSION['tableau']= $tableau;  
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
            <div class="zone-num-questions">
         <?php
            ###############################
            $file = "./data/questions.json";
            $result = file_get_contents($file);
            $data = json_decode($result, true);
            foreach($data as $value){
                $listQuestion[]=$value;
            }
            ################################
            $file = "./data/nombre_question.json";
            $result = file_get_contents($file);
            $data = json_decode($result, true);
            $_SESSION['nbreDeQuestion']=$data;
            
            const nbreParPage=1;
            $nbreDePage=ceil(sizeof($listQuestion)/nbreParPage);
            if(!isset($_GET['page'])){
                $page=1;    
            }else{
                $page=$_GET['page'];    
            }
            $min=($page-1)*nbreParPage; $max=$min+nbreParPage;
            if($page<=1){
                $page=1;
                $prec='none';                                               
            }elseif($page>$nbreDePage){
                $page=$nbreDePage;
            }
            if($page==$nbreDePage){
                $max=sizeof($listQuestion);
                $next='none'; 
            }
            for($i=$min; $i<$max; $i++){
                if(isset($listQuestion[$i]))
                {?>
                    <div class="libelle-questions">
                        <?="<label class='libelle'> Question".$listQuestion[$i]['id']."</label><br/>";?>
                         <?= $listQuestion[$i]['question'].'<br>';?>
                    </div>
            <?php
                }
            }

         ?>
            </div>
            <div class="zone-point">
            <?php
            for($i=$min; $i<$max; $i++){
                if(isset($listQuestion[$i]))
                {?>
                <div class="nbre-point">
                    <?= $listQuestion[$i]['point']." pts";'<br>'?>
                </div>
        <?php
                }
            }
        ?>
            </div>
            <div class="zone-aff-questions">
        <?php        
            for($i=$min; $i<$max; $i++){
              if(isset($listQuestion[$i])){
                if(isset($listQuestion[$i]))
                {?>
                    <?php
                   if($listQuestion[$i]['type']=="multiple"){                     
                     for($j=0; $j<count($listQuestion[$i]['reponsePossible']); $j++){                           
                        $listQuestion[$i]['reponsePossible'][$j];                                                                         
                    ?>
                            <input type="checkbox" name="" class="form-checkbox">
                                            
                        <?php    echo $listQuestion[$i]['reponsePossible'][$j].'<br>';
                                                                    
                        }
                    }elseif($listQuestion[$i]['type']=="simple"){
                        for($j=0; $j<count($listQuestion[$i]['reponsePossible']); $j++){                           
                            $listQuestion[$i]['reponsePossible'][$j];
                                                     
                        ?>
                              <div class="choix-radio">

                                <input type="radio" name="" class="form-radio">
                                                
                                 <?= $listQuestion[$i]['reponsePossible'][$j].'<br>';?>
                                
                              </div>
                    <?php 
                            }
                        }                        
                            if ($listQuestion[$i]['type']=="text"){
                    ?>
                                <div class="rep-texte">
                                    <input type="text" name="Reponse_text" class="reponse-text" value="">
                                </div>
                        <?php                   
                            }
                        ?>        
                                <br>
                        <?php
                        } 
                        ?> 
             <?php      
            }
                    
        }
            ?>
            </div>
            <?php   if($page < $nbreDePage){ ?>
                            <button type="submit" name="suivant" class="btn-form-suivant">
                                <a href="index.php?lien=jeux&page=<?=$page+1?>" class="btn-liste-question">Suivant</a>
                            </button>   
            <?php   } ?>   
            <?php   if($page > 1){ ?>                                              
                            <button type="submit" name="precedent" class=" btn-form-preced">
                                <a href="index.php?lien=jeux&page=<?=$page-1?>" class="btn-liste-question">Précédent</a>
                            </button>
            <?php   } ?>                   
            <?php   if($page == $nbreDePage){ ?> 
                            <button type="submit" name="btn_ter" class="btn-form-suivant">Terminer</button>   
            <?php   } ?>   

        </div>

        <div class="partie-score">
            <button type="button" class="afficheScore" >
                <a href="index.php?lien=jeux&choix=topfive" class="link-top-five">Top scores</a>
            </button>
            <button type="button" class="afficheScore"> 
            <a href="index.php?lien=jeux&choix=topfav" class="link-top-fav">Mon meilleur score</a>
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
            $file= './data/utilisateur.json';
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
<style>
    .libelle{
        font-size:20px;
        font-weight:bold;
    }
    .nbre-point{
        text-align:center;
        margin-top:15px;
    }
    .rep-texte{
        text-align:center;
        margin-top:50px;
    }
    .reponse-text{
        height:40px;
        width:80%;
        border-radius:5px;
        font-size:20px;
        font-weight:bold;
        
    }
    .choix-radio{
        text-align:center;
        margin-left:50px
    }
    .libelle-questions{
        text-align:center;
        
    }
</style>