function ajout_champs() {
    var newLi = document.createElement("li");
    var newInput = document.createElement("input");
    newInput.type = "text";
    var nbChoix = document.getElementById("choix").childNodes.length-2;
    newInput.id = "choix"+nbChoix;
    newInput.placeholder = "Nouveau choix";
    newLi.appendChild(newInput);
    document.getElementById("choix").appendChild(newLi);
}