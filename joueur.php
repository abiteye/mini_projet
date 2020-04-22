<?php
$liste = getData();
$liste = array_sort($liste, 'score', SORT_DESC);
foreach ($liste as $key => $value) {
    if ($value['profil'] == 'joueur') {
        $tableau[]=$value;
    }
}
$_SESSION['tableau']= $tableau;

$nbrePage=ceil(sizeof($tableau)/12);
if(!isset($_GET['page'])){
    $page=1;    
}else{
    $page=$_GET['page'];    
}
$min=($page-1)*12; $max=$min+12;
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
<link rel="stylesheet" type="text/css" href="../css/quizz.css"/>
<div class="container-list-joueur"> 
    <div class="titre-joueur">LISTE DES JOUEURS PAR SCORE
    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Score</th>
            </tr>
        </thead> 
        <tbody>
        <?php
            
            for ($i=$min; $i<$max; $i++) 
            { 
                ?>
                <tr> 
                    <td> <?= $_SESSION['tableau'][$i]['nom'];?> </td> 
                    <td> <?= $_SESSION['tableau'][$i]['prenom'];?> </td>
                    <td> <?= $_SESSION['tableau'][$i]['score'];?> </td>
                </tr>
                <?php 
            }         
        ?>
        </tbody>
    </table>            
    <button type="submit" name="soumettre" class="btn-form-suiv">
        <a href="index.php?lien=accueil&menu=joueur&page=<?=$page+1?>" class="btn-suivant">Suivant</a></button>
    </div>
</div>