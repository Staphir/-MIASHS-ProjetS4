<a href="#" id="viewSave" download></a>
<label for="options"></label>
<textarea hidden id="options">
{
  "flipXY": 1,
  "width": 1000,
  "height": 800,
  "labelLineSpacing": 15,
  "cornerRounding": 5,
  "labelPadding": 2,
  "arrowHeadSize": 5,
  "arrowsUp": 0,
  "siblingGap": 0.11,
  "idealSiblingGap": 0.3,
  "minimumCousinGap": 0.5,
  "idealCousinGap": 1.2,
  "levelsGap": 0.5,
  "minimumDepth": 6,
  "minimumBreadth": 6,
  "drawRoot": false
}
  </textarea>
<label for="options"></label>
<textarea hidden id="styles">
text {
  text-anchor: middle;
  font-size: small;
  font-weight: bold;
  fill: white;
}

rect {
  fill: #ba0000;
  <!--stroke: black;-->
  stroke-width: 1.5;
}

line {
  stroke: black;
  opacity: 0.5;
  stroke-width: 1.5;
}
  </textarea>

<div style='overflow:auto'>
  <span>
    <svg id="diagramSvg" xmlns="http://www.w3.org/2000/svg">
      <style id="stylesheet"> </style>
      <defs>
        <marker id="arrowHead" viewBox="-10 -5 10 10"
                markerUnits="strokeWidth" markerWidth="6" markerHeight="5"
                orient="auto">
          <path d="M -10 -5 L 0 0 L -10 5 z"></path>
        </marker>
      </defs>
      <g id="diagramGroup"></g>
    </svg>
  </span>
</div>