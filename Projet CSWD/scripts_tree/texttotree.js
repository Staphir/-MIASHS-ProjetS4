"use strict";

function textToTree(text) {

  var linesArray = [];
  var i = 0;
  var lines = text.split(/\n/);
  for (var stringLine in lines){
    var str = lines[stringLine];
    linesArray[i] = {};
    linesArray[i].id_story = str.split("%")[0];
    linesArray[i].id_parent = str.split("%")[1];
    linesArray[i].content = str.split("%")[2];
    i++;
  }
  //textToTree("1%3% salut\n2%5%   coucou") -> 
  //linesArray = [
  //    { id_story: "1", id_parent: "3", content: " salut" }, 
  //    { id: "2", parent: "5", content: "   coucou" }
  // ]
  ​
  //récupération info1%info2%


  var rootNode = {label: "root",
    parent: "",
    children: []};

  var stackParents = [rootNode];
  var stackIndents = [-1];
  for (var idx = 0; idx != linesArray.length; idx++) {
    
    var line = linesArray[idx].content;
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
      parent: parent,
      children: []};
    parent.children.push(node);
    stackParents.push(node);
    stackIndents.push(indent);
  }


  return rootNode;
}