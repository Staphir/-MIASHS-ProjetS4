function ajout_champ() {
    //création nouveau champs
    var newLi = document.createElement("li");
    var newInput = document.createElement("input");
    newInput.type = "text";
    var nbChoix = document.getElementById("choix").childNodes.length;
    newInput.id = "choix"+nbChoix;
    newInput.name = "choix"+nbChoix;
    newInput.size = "115";
    newInput.placeholder = "Nouveau choix";
    newInput.required = true;
    newLi.appendChild(newInput);

    //insertion dans le html
    document.getElementById("choix").appendChild(newLi);

}

function supp_champ() {
    var ul = document.getElementById("choix");
    var nbChilds = ul.childNodes.length;
    ul.removeChild(ul.childNodes[nbChilds-1]);
}

ajout_champ();