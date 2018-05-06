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

    var newImg = document.createElement("img");
    newImg.src = "../images/trash.png";

    newImg.id = "supp"+nbChoix;
    newImg.classList = "inner";
    newImg.setAttribute("onclick", "supp_champ("+nbChoix+")");
    newImg.setAttribute("onmouseover", "this.src='../images/trash_hover.png'");
    newImg.setAttribute("onmouseout", "this.src='../images/trash.png'");
    newImg.setAttribute("onmousedown", "this.src='../images/trash_down.png'");
    newLi.appendChild(newImg);

    document.getElementById("nb_choix").value++;

}

function supp_champ(nbChoix) {
    var li = document.getElementById("div"+nbChoix);
    li.outerHTML = "";

    document.getElementById("nb_choix").value--;
}

ajout_champ();

function modifyDescription() {
    //création nouveau champs
    var obj = document.getElementById('description');
    var editBtn = document.getElementById("editImg");
    var inputContainer = document.getElementById("descriptionContainer");

    if (!obj) {
        var text = inputContainer.innerHTML;
        inputContainer.innerHTML = '';
        var newObj = document.createElement("textarea");
        
        newObj.type = "comment";
        newObj.id = 'description';
        newObj.placeholder = "...";
        newObj.value = text.trim();
        newObj.name = 'stream';
        newObj.style = "resize:vertical; width:100%; height:100%; box-sizing:border-box; -moz-box-sizing:border-box; -webkit-box-sizing: border-box; border:none;"

        document.getElementById("descriptionContainer").appendChild(newObj);
        editBtn.src = "../images/editActive.png";
    } else {
        var text = obj.value;
        obj.outerHTML = "";
        inputContainer.innerHTML = text;
        editBtn.src = "../images/edit.png";
    }
}

function getDesc() {
    var hiddenInput = document.getElementById('hiddenDesc');
    var visibleInput = document.getElementById('description');
    if (!visibleInput) {
        hiddenInput.value = document.getElementById('descriptionContainer').innerHTML;
    } else {
        hiddenInput.value = document.getElementById('description').value;
    }
}