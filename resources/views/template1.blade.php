<!DOCTYPE html>
<html lang="en">
<head>
    <title>Template 1</title>
    <style>
      .node {
  cursor: pointer;
}

.node circle {
  fill: #fff;
  stroke-width: 3px;
}

.node text {
  font: 12px sans-serif;
}

.link {
  fill: none;
  stroke: #ccc;
  stroke-width: 2px;
}
.plus-button{
  color:red;
  background-color:red;
}
.svgcontainer{
    margin:auto;
    background-color:lightgrey;
}
    </style>
   
</head>
<body>
<button id="move" style="background-color:black;padding:5px;width:50px;height:50px;color:white;">Move</button>
<!-- <button onClick="add_child()" style="background-color:black;padding:5px;width:50px;height:50px;color:white;">Add child</button> -->
<!-- <button id="create_map" style="background-color:black;padding:5px;width:50px;height:50px;color:white;" onClick="createMap()">create map</button> -->



<div id="canvas" class="ui-widget-content  resizable input-group mb-3 " style="height:10px;"></div>
   

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/d3/3.5.5/d3.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
  const data=["hello"];
  const margin ={top: 10, right: 100, bottom: 120, left: 200};

  var width = 990 - margin.right - margin.left;
  var height = 500 - margin.top - margin.bottom;

 

  var canvas=d3.select('#canvas')
                .append('svg')
                .attr('width',width + margin.right + margin.left)
                .attr('height', height + margin.top + margin.bottom)
                .attr('class','svgcontainer')
                .append('g')
                .attr('transform', 'translate(' + margin.left + ',' + margin.top + ')');

  var nodeEnter=canvas.selectAll('.node') 
                      .data(data) 
                      .enter()
                      .append('g') 
                      .attr('class', 'node') 
                      .attr('transform', (d, i) => `translate(0, ${i * 35})`);

    ShowTemplate1(); 
    
    

 function ShowTemplate1(){
  nodeEnter.append('rect')
            .attr('x', 0)
            .attr('y', 0)
            .attr('width', 55)
            .attr('height', 30)
            .attr('stroke', 'black')
            .attr('fill', '#69a3b2');

   nodeEnter.append('text')
            .attr('x', 10) 
            .attr('y', 20) 
            .attr('fill', 'black')
            .text((d) => {
                return d;
            })
            .on('dblclick',function(){
              // d3.select(this).attr('fill', 'yellow');
              const parent = d3.select(this.parentNode);
              var text = d3.select(this);
              var textValue = text.text();
              updateNodeText(parent,text);
            });
            AddPlusButton(nodeEnter);           
 } 
 
 
 function updateNodeText(parent,text){
 
  var foreignObject = parent.append('foreignObject')
                                        .attr("width", 55)
                                        .attr("height", 30);

    foreignObject.append("xhtml:body")
                  .style("font", "14px 'Helvetica Neue'")
                  .html("<input type='text' value='me'>");

    foreignObject.select("input")
                .on("keydown", function () {
                  var newTextValue=$(this).val();
                
                  if (d3.event.keyCode === 13) {
                    text.text(newTextValue);
                    foreignObject.remove();
                  }
                  
                });               
 }

//  function AddPlusButton(nodeEnter) {
//   // Loop to create multiple children within each nodeEnter
//   for (let i = 0; i < numberOfChildren; i++) {
//     // Append the child element within nodeEnter
//     nodeEnter.append('rect')
//       .attr('x', Math.random() * i)
//       .attr('y', Math.random() * i)
//       .attr('width',55)
//       .attr('height', 30)
//       .attr('stroke', 2)
//       .attr('fill', 'green');

//     nodeEnter.append('text')
//       .attr('x', Math.random() * i)
//       .attr('y',  Math.random() * i)
//       .attr('fill', 'orange')
//       .text(function(d){
//         return d;
//       })
//       .on('dblclick', function() {
//         AddNewNode(d3.select(this.parentNode));
//       });
//   }
// }

// function AddPlusButton(nodeEnter) {

//   for (let i = 0; i < numberOfChildren; i++) {
//   console.log('test')

//   // Append the first set of child elements within nodeEnter
//   var rect1 = nodeEnter.append('rect')
//     .attr('x', 500)
//     .attr('y', 200)
//     .attr('width', 55)
//     .attr('height', 30)
//     .attr('stroke', 2)
//     .attr('fill', 'green');

//   var text1 = nodeEnter.append('text')
//     .attr('x', function() { return 500 + Math.random() * 100; }) // Adjust the x position as needed
//     .attr('y', function() { return 200 + Math.random() * 100; }) // Adjust the y position as needed
//     .attr('fill', 'orange')
//     .text(function(d) {
//       return d;
//     })
//     .on('dblclick', function() {
//       AddNewNode(d3.select(this.parentNode));
//     });

//   // Append the second set of child elements within nodeEnter
//   var rect2 = nodeEnter.append('rect')
//     .attr('x', 600)
//     .attr('y', 600)
//     .attr('width', 55)
//     .attr('height', 30)
//     .attr('stroke', 2)
//     .attr('fill', 'green');

//   var text2 = nodeEnter.append('text')
//     .attr('x', function() { return 600 + Math.random() * 100; }) // Adjust the x position as needed
//     .attr('y', function() { return 600 + Math.random() * 100; }) // Adjust the y position as needed
//     .attr('fill', 'orange')
//     .text(function(d) {
//       return d;
//     })
//     .on('dblclick', function() {
//       AddNewNode(d3.select(this.parentNode));
//     });

//   // Optionally, return the created elements if needed
//   return { rect1, text1, rect2, text2 };
//   }
// }



 function AddPlusButton(Node){

  var plusButton = Node.append('g')
        .attr('class', 'plus-button')
        .attr('transform', 'translate(55,15)')
        .style('cursor', 'pointer') // Make it clickable 
        
         // Append a circle for the plus button
   plusButton.append('circle')
            .attr('cx', Math.random() * -2)
            .attr('cy', Math.random() * 2)
            .attr('r', 7)
            .attr('stroke', 'black')
            .attr('fill', 'none')
            .attr('stroke-width', '10')
            .on("click",function() {
              // alert("click");
             
                AddNewNode(d3.select(this.parentNode));
             
                  
                 
              })
            .on("dblclick",function(){
              RemoveChildNode(d3.select(this.parentNode));
           });

        // Append text for the plus button
        plusButton.append('text')
            .attr('x', -6)
            .attr('y', 5)
            .attr('fill', 'black')
            .attr('font-size', '15px')
            .text('+') ;
 }

 let functionCallCount = 0;

 function AddNewNode(parent) {
    // Increment the counter each time the function is called
    functionCallCount++;

    // Calculate dynamic coordinates based on the function call count
    const rectX = 0;
    const rectY = -15 + functionCallCount * 50; // Adjust the spacing between nodes
    const lineX1 = -95;
    const lineX2 = 0;
    const textX = 10;
    const textY = 5 + functionCallCount * 50; // Adjust the spacing between nodes

    var newGroup = parent.append('g')
        .attr('transform', 'translate(100, 0)');

    newGroup.append('rect')
        .attr('x', rectX)
        .attr('y', rectY)
        .attr('width', 100)
        .attr('height', 30)
        .attr('stroke', 'black')
        .attr('fill', '#69a3b2');

    newGroup.append('line')
        .attr('x1', lineX1)
        .attr('x2', lineX2)
        .attr('y1', 0 + functionCallCount * 50) // Adjust the y-coordinate based on count
        .attr('y2', 0 + functionCallCount * 50) // Adjust the y-coordinate based on count
        .attr('stroke', 'black');

    newGroup.append('text')
        .attr('x', textX)
        .attr('y', textY)
        .attr('fill', 'black')
        .text("New Text " + functionCallCount)
        .on('dblclick', function () {
            const parent = d3.select(this.parentNode);
            var text = d3.select(this);
            var textValue = text.text();
            updateNodeText(parent, text);
        });

    // AddPlusButton(newGroup); // Add any additional functionality if needed
}

//  function AddNewNode(parent){

    

    // testing function

    
    
//     var newGroup = parent.append('g')
//                   .attr('transform', 'translate(100, 0)');
                 

//               newGroup.append('rect')
//               .attr('x',0)
//               .attr('y',20)
//               .attr('width', 100)
//               .attr('height', 30)
//               .attr('stroke', 'black')
//               .attr('fill', '#69a3b2');

//               newGroup.append('rect')
//               .attr('x',0)
//               .attr('y',60)
//               .attr('width', 100)
//               .attr('height', 30)
//               .attr('stroke', 'black')
//               .attr('fill', '#69a3b2');

//               newGroup.append('rect')
//               .attr('x',0)
//               .attr('y',100)
//               .attr('width', 100)
//               .attr('height', 30)
//               .attr('stroke', 'black')
//               .attr('fill', '#69a3b2');

//               newGroup.append('rect')
//               .attr('x',0)
//               .attr('y',140)
//               .attr('width', 100)
//               .attr('height', 30)
//               .attr('stroke', 'black')
//               .attr('fill', '#69a3b2');

    
//  }

//  function AddNewNode(parent){
    
//     var newGroup = parent.append('g')
//                   .attr('transform', 'translate(100, 0)');
                 

//               newGroup.append('rect')
//               .attr('x',0)
//               .attr('y', -15)
//               .attr('width', 100)
//               .attr('height', 30)
//               .attr('stroke', 'black')
//               .attr('fill', '#69a3b2');

//               newGroup.append('line')
//                   .attr('x1', -95)  
//                   .attr('x2', 0)  
//                   .attr('y1', 0)  
//                   .attr('y2',0 )  
//                   .attr('stroke', 'black');

//               newGroup.append('text')
//                   .attr('x', 10) 
//                   .attr('y', 5) 
//                   .attr('fill', 'black')
//                   .text("New Text")
//                   .on('dblclick',function(){
//               // d3.select(this).attr('fill', 'yellow');
//               const parent = d3.select(this.parentNode);
//               var text = d3.select(this);
//               var textValue = text.text();
//               updateNodeText(parent,text);
//             });
//             AddPlusButton(newGroup);
//  }

 function RemoveChildNode(parent){
 
          parent.selectAll('g')
          .transition() // Add transition
          
          .duration(500) // Set duration in milliseconds
          .ease('linear')
          .style("opacity", 0)
          .remove();
 }



 $(document).ready(function(){
  $('#move').on('click',function(e){
          $('#canvas').addClass('draggable').draggable();
          
       });
});

</script>
   
</body>
</html>