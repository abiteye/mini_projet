<?php
if (isset($_POST['btn_save'])) {
    //var_dump($_POST);
    //die();
    $question=$_POST['question'];
    $question=preg_match("/^(\s)*[A-Z].+[.?!](\s)*$/",$question);
    $nbrepoint=$_POST['nbrepoint'];
    $typeQuestion=$_POST['typeQuestion'];
    $reponsePossible=$_POST['ReponseMultiple'];
    $cpt=count($reponsePossible);
    if($typeQuestion=="multiple"){
        for($i=1; $i<=$cpt; $i++){
            if (!empty($_POST['multipleChoice'.$i])) {
                $tableauReponse[] = $reponsePossible[$i-1];
            }
        }
    }elseif($typeQuestion=="text"){
        $tableauReponse[] = $reponsePossible[0];

    }elseif($typeQuestion=="simple"){
        for($i=0; $i<$cpt; $i++){
            if($_POST['reponse'] == $i+1){
                $tableauReponse[]= $reponsePossible[$i]; 
            }
        }
    }
    $file = "../data/questions.json";
    $result = file_get_contents($file);
    $data = json_decode($result, true);
    $id=count($data)+1;

    $data[] =  array(
        "id"=>$id,
        "question"=>$question,
        "type"=>$typeQuestion,
        "point" => $nbrepoint, 
        "reponsePossible" => $reponsePossible,
        "bonne_reponse" => $tableauReponse 
    );
    
    $json_file = json_encode($data, JSON_PRETTY_PRINT);
    $stock = file_put_contents($file, $json_file);
    ##############################################

}

?>


<div class="containt-questions">
    <div class="titre-question">PARAMÉTRER VOTRE QUESTION</div>
    <div class="zone-question">
        <form method="post" id="form-connexion">
                <div class="form-input-ques">
                    <label for="">Questions</label> 
                    <input type="text" name="question" id="like-textarea" class="form-cont-question1" erreur='erreur-12'>
                    <div class="erreur-form" id="erreur-12"></div>
                </div>
                <div class="form-input-ques" id="aide-question">
                    <label for="">Nbre de points</label>
                    <input type="number" name="nbrepoint" 
                           class="form-cont-question2" erreur='erreur-13'>
                    <div class="erreur-form" id="erreur-13"></div>
                </div>
                <div class="form-input-ques" id="aide-question">
                    <label for="">Type de Question</label>
                    <select name="typeQuestion" id="aideOption" class="form-cont-question3" 
                            onchange="document.getElementById('type-reponse').innerHTML=''; 
                            document.getElementById('ajout-question').style.display='inline'">  
                        <option value="">Donnez le type de réponse</option>
                        <option value="text">Choix texte</option>               
                        <option value="simple">Choix simple</option>
                        <option value="multiple">Choix multiple</option>
                    </select>

                    <a href="javascript:void(0);" id="ajout-question" title="ajout field">
                        <div id="btn-ajout-plus"></div>
                    </a>


                    <div class="erreur-form" id="erreur-1"></div>
                </div>
                <div id="type-reponse">

                </div>
                <div class="input-form-admin input-form-user"> 
                    <button type="submit" name="btn_save" class="btn-save">Enregistrer</button> 

                </div>
            </form>
    </div>
</div>
<script>
    // mettre le premier select en display none
    let aideOption = document.getElementById("aideOption");
    let selectOption = aideOption.getElementsByTagName("option");
    selectOption[0].disabled = true;
    
    // generation des inputs
    
    (function() {
        var aideOption = document.getElementById("aideOption");
        var typeQuestion = document.getElementById('aideOption');
        var cpt = 0;
        var btn = document.getElementById('ajout-question');
        var question = document.getElementById('type-reponse');
        
        // La fonction pour le choix multiple
        var choixMultiple = function() {
            cpt++;
            var div = document.createElement("div");
            var label = document.createElement("label");
            var newquestion = document.createTextNode("Réponse " +cpt);
            var input = document.createElement("input");
            var img = document.createElement('img');
            var diverreur = document.createElement('div');
            diverreur.setAttribute('class', 'erreur-form');
            diverreur.id = 'erreur-'+cpt;
            var checkbox = document.createElement('input');
            div.id = 'supprimer' +cpt;
            div.setAttribute('class', 'form-input-ques');
            label.appendChild(newquestion);
            input.id = 'generated-input';
            input.type = 'text';
            input.setAttribute('erreur','erreur-' +cpt);
            checkbox.type = 'checkbox';
            checkbox.name = 'multipleChoice'+cpt;
            input.name = 'ReponseMultiple[]';
            img.src = '../Images/Icônes/ic-supprimer.png ';
            img.setAttribute("onclick", "document.getElementById('supprimer" +cpt+ "').innerHTML=''");
            div.appendChild(label);
            div.appendChild(input);
            div.appendChild(checkbox);
            div.appendChild(img);
            div.appendChild(diverreur);
            question.appendChild(div);
        };

        
        // La fonction pour le choix est simple
        var cpt = 0;
        var choixSimple = function() {
            cpt++;
            var div = document.createElement("div");
            var label = document.createElement("label");
            var newquestion = document.createTextNode("Réponse "+cpt);
            var input = document.createElement("input");
            var img = document.createElement('img');
            var radio = document.createElement('input');
            var diverreur = document.createElement('div');
            diverreur.setAttribute('class', 'erreur-form');
            diverreur.id = 'erreur-'+cpt;
            div.id = 'supprimer'+cpt;
            label.appendChild(newquestion);
            input.id = 'generated-input';
            div.setAttribute('class', 'form-input-ques');
            input.setAttribute('erreur','erreur-'+cpt);
            input.type = 'text';
            radio.type = 'radio';
            radio.name = "reponse";
            radio.value = cpt;
            input.name = 'ReponseMultiple[]';
            img.src = '../Images/Icônes/ic-supprimer.png';
            img.setAttribute("onclick", "document.getElementById('supprimer"+cpt+"').innerHTML=''");
            div.appendChild(label);
            div.appendChild(input);
            div.appendChild(radio);
            div.appendChild(img);
            div.appendChild(diverreur);
            question.appendChild(div);
        };


        // La fonction pour le choix est question
        var cpt = 0;
        var choixTexte = function() {
            cpt++;
            var div = document.createElement("div");
            var label = document.createElement("label");
            var newquestion = document.createTextNode("Reponse");
            var input = document.createElement("input");
            var diverreur = document.createElement('div');
            diverreur.setAttribute('class', 'erreur-form');
            input.setAttribute('erreur','erreur-'+cpt);
            diverreur.id = 'erreur-'+cpt;
            div.setAttribute('class', 'form-input-ques');
            label.appendChild(newquestion);
            input.id = 'generated-input';
            input.type = 'text';
            input.name = 'ReponseMultiple[]';
            div.appendChild(label);
            div.appendChild(input);
            div.appendChild(diverreur);
            question.appendChild(div);
        };


        // l'evenement sur le bouton ajout
        btn.addEventListener('click', function() {
            if (aideOption.value == 'multiple') {
                choixMultiple();
                
                
            } else if (aideOption.value == 'simple') {
                choixSimple();
                
            }
            else if (aideOption.value == 'text') {
                choixTexte();
                btn.style.display = "none";
              
            }
            
        }.bind(this));
        return false
    })();


    const inputs = document.getElementsByTagName("input");
    for (input of inputs) {
        input.addEventListener("keyup", function(e) {
            if (e.target.hasAttribute("erreur")) {
                var idDiverreur = e.target.getAttribute("erreur");
                document.getElementById(idDiverreur).innerHTML = ""
            }
        })
    }
    document.getElementById("form-connexion").addEventListener("submit", function(e) {
        const inputs = document.getElementsByTagName("input");
        var erreur = false;
        for (input of inputs) {
            if (input.hasAttribute("erreur")) {
                var idDiverreur = input.getAttribute("erreur");
                if (!input.value) {
                    document.getElementById(idDiverreur).innerText= "Ce champ est obligatoire"
                    erreur = true
                }

            }
        }
        if (erreur) {
            e.preventDefault();
            return false;
        }
    })
</script>