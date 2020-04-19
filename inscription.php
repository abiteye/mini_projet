<?php
#Enregistrement dans le fichier json
        if(isset($_POST['creer'])) 
        {
            $utilisateur=array();

            $utilisateur['prenom']=$_POST['prenom'];
            $utilisateur['nom']=$_POST['nom'];
            $utilisateur['login']=$_POST['login'];
            $utilisateur['pwd']=$_POST['pwd'];
            $utilisateur['photo']=$_POST['photo'];

            $data= file_get_contents('../data/utilisateur.json');

            $data= json_decode($data, true);    

            $data[]= $utilisateur;

            $data= json_encode($data);

            file_put_contents('../data/utilisateur.json', $data);  
        }

?>

<link rel="stylesheet" type="text/css" href="../css/quizz.css"/>
<div class="container-form">
    <div class="titre-ins"><b>S'INSCRIRE</b><br>
        Pour proposer des quizz             
    </div>
  <form action="" method="post" id="form-creation"> 
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
        <input type="password" class="form-control-ins" erreur="erreur-4" name="pwd" id="" placeholder="Password">
        <div class="erreur-form-ins" id="erreur-4"></div>
    </div>
    <div class="input-ins-form">
        <label for="password">Confirmer Password</label><br>
        <input type="password" class="form-control-ins" erreur="erreur-5" name="pwd" id="" placeholder="Confirmmer Password">
        <div class="erreur-form-ins" id="erreur-5"></div> 
    </div>
    <div class="input-ins-form"> 
        <div class=>Avatar        
        <input type="file" class="form-avatar-form" accept="image/PNG,JPEG" name="photo" onchange="loadFile(event)"></div> 
        <img id="output" alt="" class="avatar-active" src=""/>          
<script>
  var loadFile = function(event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
      URL.revokeObjectURL(output.src) 
    }
  };
</script>
    </div>
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