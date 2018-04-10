function ajout_champ() {
    //création nouveau champs
    var newLi = document.createElement("div");
    var newInput = document.createElement("input");
    newInput.type = "text";
    var nbChoix = document.getElementById("choix").childNodes.length;
    newLi.id = "div"+nbChoix;
    newLi.classList = "choix";
    newInput.id = "choix"+nbChoix;
    newInput.name = "choix"+nbChoix;
    newInput.size = "115";
    newInput.placeholder = "Nouveau choix";
    newInput.required = true;
    newInput.classList = "inner";
    newLi.appendChild(newInput);

    //insertion dans le html
    document.getElementById("choix").appendChild(newLi);

    var newButton = document.createElement("button");
    newButton.type = "button";
    newButton.id = "supp"+nbChoix;
    newButton.textContent = "Supprimer";
    newButton.classList = "inner";
    newButton.setAttribute("onclick", "supp_champ("+nbChoix+")");
    newLi.appendChild(newButton);

    document.getElementById("nb_choix").value++;

}

function supp_champ(nbChoix) {
    var li = document.getElementById("div"+nbChoix);
    li.outerHTML = "";

    document.getElementById("nb_choix").value--;
}