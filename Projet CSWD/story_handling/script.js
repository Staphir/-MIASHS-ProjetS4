    function ajout_champ(idChoice) {
        //création nouveau champs
        var newLi = document.createElement("div");
        var newInput = document.createElement("input");
        newInput.type = "text";
        var nbChoix = document.getElementById("choix").childNodes.length;
        newLi.id = "div" + nbChoix;
        newLi.classList = "choix";
        newInput.id = "choix" + nbChoix;
        newInput.name = "choix" + nbChoix;
        newInput.size = "115";
        newInput.placeholder = "Nouveau choix";
        newInput.required = true;
        newInput.classList = "inner";
        newLi.appendChild(newInput);

        //insertion dans le html
        document.getElementById("choix").appendChild(newLi);

        var newImg = document.createElement("img");
        newImg.src = "../images/trash.png";

        newImg.id = "supp" + nbChoix;
        newImg.classList = "inner";
        newImg.width = 30;
        newImg.setAttribute("onclick", "supp_champ(" + nbChoix + "," + idChoice + " )");
        newImg.setAttribute("onmouseover", "this.src='../images/trash_hover.png'");
        newImg.setAttribute("onmouseout", "this.src='../images/trash.png'");
        newImg.setAttribute("onmousedown", "this.src='../images/trash_down.png'");

        newLi.appendChild(newImg);

        document.getElementById("nb_choix").value++;

    }

    function ajout_champ_enfant(text, idChoice) {
        ajout_champ(idChoice);
        var nbChoix = document.getElementById("choix").childNodes.length;
        var idChoix = "choix" + (nbChoix - 1);
        var champEnfant = document.getElementById(idChoix);
        champEnfant.placeholder = "";
        champEnfant.value = text;
    }

    function supp_champ(nbChoix, idChoice) {

        //remettre les id à 1, 2, 3,... pour éviter d'avoir plusieurs 1 ou 2 ou... et supprimer seulement le 1er des 1 ou 2 ou...
        // var tabChilds = $("#choix").children();
        //
        // for(var i=0; i<nbChoix-1; i++){
        //     var splited = tabChilds[i].id.split("v");
        //     if( splited[1] !== toString(i+1)){
        //         console.log(typeof toString(i+1));
        //         document.getElementById(tabChilds[i].id).id = splited[0]+"v"+(i+1);
        //     }
        // }

    if (idChoice != null){
        var confirme = confirm("êtes-vous sûr de vouloir supprimer ce choix et toute l'histoire qui lui est associé ?");
        if (confirme == true) {
            console.log("ok");
            var li = document.getElementById("div" + nbChoix);
            li.outerHTML = "";

                $.ajax({
                    type: "POST",
                    url: "delete_choice.php",
                    data: {
                        id: idChoice,
                        id_story: idStory
                    }
                });

            }

            document.getElementById("nb_choix").value--;
        }else{
        var li = document.getElementById("div" + nbChoix);
        li.outerHTML = "";
        document.getElementById("nb_choix").value--;
        alert(document.getElementById("car").inne);
    }
    }