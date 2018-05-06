function modifyData(Id, firstname, lastname) {
    //création nouveau champs
    var obj = document.getElementById(Id);
    var editBtn = document.getElementById(Id+"Img");
    var inputContainer = document.getElementById(Id+"Container");

    var firstname = document.getElementById('constantFirstname').value;
    var lastname = document.getElementById('constantLastname').value;

    if (obj.nodeName == "P") {
        var text = obj.textContent; 
        obj.outerHTML = "";
        var newObj = document.createElement("input");
        
        newObj.type = "text";
        newObj.id = Id;
        newObj.placeholder = "...";
        newObj.value = text;
        newObj.name = Id;

        document.getElementById(Id+"Container").appendChild(newObj);
        editBtn.src = "images/editActive.png";
        inputContainer.insertBefore(newObj, inputContainer.childNodes[1]);
    } else {
        var text = obj.value;
        toCompare = (obj.id=='firstname')?firstname:lastname;
        if (text == toCompare) {
            obj.outerHTML = "";
            var newObj = document.createElement("p");
            
            newObj.id = Id;
            newObj.textContent = text;
    
            editBtn.src = "images/edit.png";
            inputContainer.insertBefore(newObj, inputContainer.childNodes[1]);
        }
    }
    var saveContainer = document.getElementById('saveData');
    var saveBtn = document.createElement("input");

    saveBtn.type = 'submit';
    saveBtn.value = 'Enregister les modification';

    if (saveContainer.innerHTML==="") {
        saveContainer.appendChild(saveBtn);
    } else {
        if (document.getElementById('firstname').nodeName == "P" && document.getElementById('lastname').nodeName == "P") {
            saveContainer.innerHTML = "";
        }
    }
}