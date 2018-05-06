"use strict";

function textToTree(text) {

    var lines = text.split(/\n/);

    var rootNode = {label: "root",
        type: "",//ajout
        id_parent: "",//ajout
        id_element: "",//ajout
        parent: "",
        children: []};

    var stackParents = [rootNode];
    var stackIndents = [-1];
    for (var idx = 0; idx != lines.length; idx++) {

        var line = lines[idx];
        var step_or_choice = type[idx];//ajout
        var id_par = id_parents[idx];//ajout
        var id_elem = id_element[idx];//ajout
        var content = line.trim();
        if (!content.length)
            continue;
        var indent = line.indexOf(content);
        while (stackIndents[stackIndents.length - 1] >= indent) {
            stackIndents.pop();
            stackParents.pop();
        }
        var parent = stackParents[stackParents.length - 1];
        var node = {label: content,
            type: step_or_choice,//ajout
            id_parent: id_par,//ajout
            id_element: id_elem,//ajout
            parent: parent,
            children: []};
        parent.children.push(node);
        stackParents.push(node);
        stackIndents.push(indent);
    }

    return rootNode;
}