function ajout_champ() {
    //création nouveau champs
    var newLi = document.createElement("li");
    var newInput = document.createElement("input");
    newInput.type = "text";
    var nbChoix = document.getElementById("choix").childNodes.length;
    newLi.id = "li"+nbChoix;
    newInput.id = "choix"+nbChoix;
    newInput.name = "choix"+nbChoix;
    newInput.size = "115";
    newInput.placeholder = "Nouveau choix";
    newInput.required = true;
    newLi.appendChild(newInput);

    //insertion dans le html
    document.getElementById("choix").appendChild(newLi);

    var newButton = document.createElement("button");
    newButton.type = "button";
    newButton.id = "supp"+nbChoix;
    newButton.textContent = "X";
    newButton.setAttribute("onclick", "supp_champ("+nbChoix+")");
    newLi.appendChild(newButton);

    document.getElementById("nb_choix").value++;

}

function supp_champ(nbChoix) {
    var li = document.getElementById("li"+nbChoix);
    li.outerHTML = "";

    document.getElementById("nb_choix").value--;
}