<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/quizz.css"/>
    <title>inscription</title>
</head>
<body>
<div class="form-joueur">
    <div class="titre-ins"><b>S'INSCRIRE</b><br>
        Pour tester votre niveau de culture générale.             
    </div>
    <div class="input-ins-form">
        <div class=>Prénom</div>
        <input type="text" class="form-control-ins" error="" name="prenom" id="" placeholder="Prenom">
        <div class="error-form-ins" id=""></div>
    </div>
    <div class="input-ins-form">
        <div class=>Nom</div>
        <input type="text" class="form-control-ins" error="" name="nom" id="" placeholder="Nom"> 
        <div class="error-form-ins" id=""></div>
    </div>
    <div class="input-ins-form">
        <div class=>Login</div>
        <input type="text" class="form-control-ins" error="" name="login" id="" placeholder="Login">
        <div class="error-form-ins" id=""></div>
    </div>
    <div class="input-ins-form">
        <div class=>Password</div>
        <input type="password" class="form-control-ins" error="" name="password" id="" placeholder="Password">
        <div class="error-form-ins" id=""></div>
    </div>
    <div class="input-ins-form">
        <div class=>Confirmer Password</div>
        <input type="password" class="form-control-ins" error="" name="password2" id="" placeholder="Confirmmer Password">
        <div class="error-form-ins" id=""></div>
    </div>
    <div class="input-ins-form"> 
        <div class=>Avatar
        <input class="form-avatar-form" type="file" name="photo" onchange="loadFile(event)"></div>
        <img src="" alt="" id="output" class="avatar-active-jou">
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
    <div class="">
        <button type="submit" class="btn-compte" name="" id="">Créer compte</button> 
    </div>
</div>
</body>
</html>