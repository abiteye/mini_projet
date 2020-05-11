<?php

       if (isset($_POST['btn_okey']))
       {               
            $nombre=$_POST['nombre'];
                      
            $file = "./data/nombre_question.json";
            //$result = file_get_contents($file);
            //$data = json_decode($result, true);

            $data[]=  array(

                "nombre"=>$nombre              
            );
    
            $json_file= json_encode($data, JSON_PRETTY_PRINT);
                         file_put_contents($file, $json_file);
       }

?>

<link rel="stylesheet" type="text/css" href="../css/quizz.css"/>
<div class="page-droite">    
    <div class="titre-page"><p>Nbre de question/jeu</p>
       <form method="post" id="form-afficher">
        <input type="text" name="nombre" value="" error="error" id="input"/>
        <div class="btn-ok">
            <button  type="submit" name="btn_okey" class="btn-ok-affiche" id="form-afficher">OK</button>
        </div>
       </form>
    </div>
    <div class="zone-liste-question">
      <div class="text-question">   
<?php
    $file = "./data/questions.json";
    $result = file_get_contents($file);
    $data = json_decode($result, true);
    foreach($data as $value){
        $listQuestion[]=$value;
    }
        const nbrePage=3;
        $nbrePage=ceil(sizeof($listQuestion)/nbrePage);
        if(!isset($_GET['fenetre'])){
            $page=1;    
        }else{
            $page=$_GET['fenetre'];    
        }
        $min=($page-1)*nbrePage; $max=$min+nbrePage;
        if($page<=1){
            $page=1;
            $prec='none';                                               
        }elseif($page>$nbrePage){
            $page=$nbrePage;
        }
        if($page==$nbrePage){
            $max=sizeof($listQuestion);
            $next='none'; 
        }
                #Affichage des questions avec leur reponse possible
                
        for($i=$min; $i<$max; $i++){
            $k=0;
            if(isset($listQuestion[$i])){
                if(isset($listQuestion[$i]))
                {?>
                    <?= $listQuestion[$i]['id'].". ".$listQuestion[$i]['question'].'<br>';?>
                    <?php
                   if($listQuestion[$i]['type']=="multiple"){                     
                     for($j=0; $j<count($listQuestion[$i]['reponsePossible']); $j++){                           
                        $listQuestion[$i]['reponsePossible'][$j];
                        $exist=false;
                        for($k=0; $k<count($listQuestion[$i]['bonne_reponse']); $k++){                           
                            if( $listQuestion[$i]['reponsePossible'][$j]==$listQuestion[$i]['bonne_reponse'][$k]){
                                $exist=true;
                            }

                        }
                        
                        if($exist==true){?>
                            <input type="checkbox" name="" checked class="form-checkbox"  onclick="return false;"> 
                                           
                    <?php                      
                                echo $listQuestion[$i]['reponsePossible'][$j].'<br>'; 
                                                
                        }else{
                                                 
                    ?>
                            <input type="checkbox" name="" class="form-checkbox" onclick="return false;">
                                            
                        <?php    echo $listQuestion[$i]['reponsePossible'][$j].'<br>';
                                        
                            }
                        }
                        }elseif($listQuestion[$i]['type']=="simple"){
                            for($j=0; $j<count($listQuestion[$i]['reponsePossible']); $j++){                           
                                $listQuestion[$i]['reponsePossible'][$j];
                                $exist=false;
                                for($k=0; $k<count($listQuestion[$i]['bonne_reponse']); $k++){                           
                                    if( $listQuestion[$i]['reponsePossible'][$j]==$listQuestion[$i]['bonne_reponse'][$k]){
                                        $exist=true;
                                    }
    
                                }
                            
                                if($exist==true){?>
                                    <input type="radio" name="" checked class="form-radio"  onclick="return false;"> 
                                               
                            <?php                      
                                        echo $listQuestion[$i]['reponsePossible'][$j].'<br>'; 
                                                    
                                }else{
                                                     
                            ?>
                                    <input type="radio" name="" class="form-radio" onclick="return false;">
                                                
                            <?php       echo $listQuestion[$i]['reponsePossible'][$j].'<br>';
                                            
                                }
                            }
                        }                        
                            if ($listQuestion[$i]['type']=="text"){
                        ?>
                                    <input type="text" readonly name="Reponse_text" 
                                           class="reponse-text" value="<?= $listQuestion[$i]['reponsePossible'][$k] ?>">
                        <?php                   
                            }
                        ?>        
                                <br>
                        <?php
                                $k++;
                        } 
                        ?> 
             <?php      
            }
                    
        }
            ?>
            </div>

    </div>
    <button type="submit" name="suivant" class="btn-form-suivant">
        <a href="index.php?lien=accueil&menu=liste-question&fenetre=<?=$page+1?>" class="btn-liste-question">Suivant</a>
    </button>

    <button type="submit" name="precedent" class=" btn-form-preced">
        <a href="index.php?lien=accueil&menu=liste-question&fenetre=<?=$page-1?>" class="btn-liste-question">Précédent</a>
    </button>    
</div>
<script>
        const inputs= document.getElementById("input");
            input.addEventListener("keyup", function(e){
                if(e.target.hasAttribute("error")) {
                    var idDiverror=e.target.getAttribute("error");
                    document.getElementById(idDiverror).innerText=""

                }
            })
        
    document.getElementById("form-afficher").addEventListener("submit", function(e){
        const inputs= document.getElementById("input");
        var error=false;

                if(input.hasAttribute("error")){
                    var idDiverror=input.getAttribute("error");
                        if(!input.value){
                            document.getElementById(idDiverror).innerText=
                            alert('Veuillez remplir ce champ');
                            error=true
                        }else 
                            if(input.value < 5){
                            document.getElementById(idDiverror).innerText=
                            alert('Le nombre doit supérieur ou égal à 5');
                            error=true

                            }
                }
            
    if(error){
        e.preventDefault();
        return false; 
    }        
    })
</script>
<style>
.reponse-text{
    width:40%;
    height:20px;
    
    
}
.text-question{
    margin-left:20px;
    float:left;
    font-size:20px;
    font-weight:bold;
    margin:10px;   
}
</style>
    