<?php
#Enregistrement des photos dans le dossier photos du projet quizz.

if(!empty($_FILES))
{
    $file_name= $_FILES['photo']['name'];
    $file_extention= strrchr($file_name, ".");

    $file_tmp_name= $_FILES['photo']['tmp_name'];
    $file_dest= "./photos/".$file_name;

    $extentions_autorisees= array('.jpg', '.jpeg', '.png');

    if(in_array($file_extention, $extentions_autorisees)){

        if(move_uploaded_file($file_tmp_name, $file_dest)){

            echo "<script>alert(\"Fichier envoyé avec succes\")</script>";

        }else{
            echo "<script>alert(\"Une erreur est survenue lors de l'envoi du fichier\")</script>";
        }
    }else{
            echo "<script>alert(\"Seuls les fichiers PNG et JPG sont autorisées\")</script>";
    }


}
#Enregistrement des données dans le fichier json.
    if(isset($_POST['creer'])) 
    {
           
        if(isset($_GET['menu'])){
            $utilisateur=array();
            $utilisateur['prenom']=$_POST['prenom'];
            $utilisateur['nom']=$_POST['nom'];
            $utilisateur['login']=$_POST['login'];
            $utilisateur['pwd1']=$_POST['pwd1'];
            $utilisateur['profil']="admin";
            $utilisateur['photo']=$_FILES['photo']['name'];

            $data= file_get_contents('./data/utilisateur.json');

            $data= json_decode($data, true);    

            $data[]= $utilisateur;

            $data= json_encode($data);

            file_put_contents('./data/utilisateur.json', $data);  
        }
        else{
            $utilisateur=array();
            $utilisateur['prenom']=$_POST['prenom'];
            $utilisateur['nom']=$_POST['nom'];
            $utilisateur['login']=$_POST['login'];
            $utilisateur['pwd1']=$_POST['pwd1'];
            $utilisateur['profil']="joueur";
            $utilisateur['score']="0"; 
            $utilisateur['photo']=$_FILES['photo']['name'];

            $data= file_get_contents('./data/utilisateur.json');

            $data= json_decode($data, true);    

            $data[]= $utilisateur;

            $data= json_encode($data);

            file_put_contents('./data/utilisateur.json', $data);  
        }
    }

?>

<link rel="stylesheet" type="text/css" href="./css/quizz.css"/>
<?php
 if(isset($_GET['menu'])){
?>
<div class="container-form">
    <div class="titre-ins"><b>S'INSCRIRE</b><br>
        Pour proposer des quizz             
    </div>
    <?php
 }else{
     ?>
     <div class="form-joueur">
    <div class="titre-ins"><b>S'INSCRIRE</b><br>
        Pour tester votre niveau de culture générale             
    </div>
<?php
 }
 ?>
  <form action="" method="post" id="form-creation" enctype="multipart/form-data"> 
    <div class="input-ins-form">
        <label for="prenom">Prénom</label><br>
        <input type="text" class="form-control-ins" erreur="erreur-1" name="prenom" id="" placeholder="Prenom">
        <div class="erreur-form-ins" id="erreur-1"></div>
    </div>
    <div class="input-ins-form">
        <label for="nom">Nom</label><br>
        <input type="text" class="form-control-ins" erreur="erreur-2" name="nom" id="" placeholder="Nom"> 
        <div class="erreur-form-ins" id="erreur-2"></div>
    </div>
    <div class="input-ins-form">
        <label for="login">login</label><br>
        <input type="text" class="form-control-ins" erreur="erreur-3" name="login" id="" placeholder="Login">
        <div class="erreur-form-ins" id="erreur-3"></div>
    </div>
    <div class="input-ins-form">
        <label for="password">Password</label><br>
        <input type="password" class="form-control-ins" erreur="erreur-4" name="pwd1" id="pwd1" placeholder="Password">
        <div class="erreur-form-ins" id="erreur-4"></div>
    </div>
<script>
//Verification des deux mots de passe    
    function verifpwd()
 {
    var pwd1 = document.getElementById("pwd1").value;
    var pwd2 = document.getElementById("pwd2").value;
 
    if(pwd1 == pwd2)
    {
        document.form.submit();
    }else{        
        alert("les mots de passe saisis sont différents");
        }
 }
</script>

    <div class="input-ins-form">
        <label for="password">Confirmer Password</label><br>
        <input type="password" class="form-control-ins" erreur="erreur-5" name="pwd2" id="pwd2" onBlur="verifpwd()" placeholder="Confirmmer Password">
        <div class="erreur-form-ins" id="erreur-5"></div> 
    </div>
    <div class="input-ins-form">
<?php
 if(isset($_GET['menu'])){
?>
    <div class=>Avatar        
    <input type="file" class="form-avatar-form"  name="photo" onchange="loadFile(event)"></div> 
    <img id="output" alt="" class="avatar-active" src=""/>                  
         
<script>
//Script d'affichage du fichier image pour le formulaire admin.
  var loadFile = function(event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
      URL.revokeObjectURL(output.src) 
    }
  }; 
</script>
    </div>
    <?php 
    }else{
    ?>
        <div class=>Avatar        
        <input type="file" class="form-avatar-form"  name="photo" onchange="loadFile(event)"></div> 
        <img id="output" alt="" class="avatar-active-jou" src=""/>
        <script>
//Script d'affichage du fichier image pour le formulaire joueur.
  var loadFile = function(event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
      URL.revokeObjectURL(output.src) 
    }
  }; 
</script>        
        <?php   
    }?>
    <div class="form-btn-compte">
        <button type="submit" class="btn-compte" name="creer" id="">Créer compte</button> 
    </div>
  </form>
   
</div>
<script>
        const inputs= document.getElementsByTagName("input");
        for(input of inputs){
            input.addEventListener("keyup", function(e){
                if(e.target.hasAttribute("erreur")) {
                    var idDiverreur=e.target.getAttribute("erreur");
                    document.getElementById(idDiverreur).innerText=""

                }
            })
        }
    document.getElementById("form-creation").addEventListener("submit", function(e){
        const inputs= document.getElementsByTagName("input");
        var erreur=false;
            for(input of inputs){
                if(input.hasAttribute("erreur")){
                    var idDiverreur=input.getAttribute("erreur");
                        if(!input.value){
                            document.getElementById(idDiverreur).innerText="Veuillez remplir ce champ"
                            erreur=true
                        }
                }
            }
    if(erreur){
        e.preventDefault();
        return false;
    }        
    })
</script>    
<?php
#unicite login
    if (isset($_POST['login'])) { 
 
        $_POST['login'] = htmlspecialchars($_POST['login']);
        if (preg_match("#^[a-zA-Z](.[^<>?]){6-20}#", $_POST['login'])) {

            echo "<script>alert(\"le login correct\")</script>"; 
        } else {
            echo "<script>alert(\"login mal écrit, il doit commencer par une lettre\")</script>";
            }
    } 
?>
