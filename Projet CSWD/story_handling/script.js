function ajout_champ(supp) {
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
    if (supp === true) {
        var newImg = document.createElement("img");
        newImg.src = "../images/trash.png";

        newImg.id = "supp" + nbChoix;
        newImg.classList = "inner";
        newImg.width = 30;
        newImg.setAttribute("onclick", "supp_champ(" + nbChoix + ")");
        newImg.setAttribute("onmouseover", "this.src='../images/trash_hover.png'");
        newImg.setAttribute("onmouseout", "this.src='../images/trash.png'");
        newImg.setAttribute("onmousedown", "this.src='../images/trash_down.png'");

        newLi.appendChild(newImg);
    }
    document.getElementById("nb_choix").value++;

}

function ajout_champ_enfant(text, supp) {
    ajout_champ(supp);
    var nbChoix = document.getElementById("choix").childNodes.length;
    var idChoix = "choix"+(nbChoix-1);
    var champEnfant = document.getElementById(idChoix);
    console.log(text);
    champEnfant.placeholder = "";
    champEnfant.value = text;
}

function supp_champ(nbChoix) {
    var li = document.getElementById("div"+nbChoix);
    li.outerHTML = "";

    document.getElementById("nb_choix").value--;
}
