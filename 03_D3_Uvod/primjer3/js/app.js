/* Ova linija mora ostati jer ona definira svu foundation javascript fukcionalnost */
$(document).foundation();

/* ovdje pišemo JavaScript kod */

var margin ={top:20, right:30, bottom:30, left:40},
    width=960-margin.left - margin.right, 
    height=600-margin.top-margin.bottom;

// scale to ordinal because x axis is not numerical
var x = d3.scale.ordinal().rangeRoundBands([0, width], 0.1);

//scale to numerical value by height
var y = d3.scale.linear().range([height, 0]);

var chart = d3.select("#chart")  
              .append("svg")  //append svg element inside #chart
              .attr("width", width+(margin.left)+margin.right)    //set width
              .attr("height", height+margin.top+margin.bottom);  //set height
              
              
var xAxis = d3.svg.axis()
              .scale(x) 
              .orient("bottom");  //orient bottom because x-axis will appear below the bars

var yAxis = d3.svg.axis()
              .scale(y)
              .orient("left");
              


d3.json("ocjene.json", function(error, data){
  x.domain(data.map(function(d){ return d.naziv}));
  y.domain([0, 5.5]);
  
  
  var bar = chart.selectAll("g")
                    .data(data)
                  .enter()
                    .append("g")
                    .attr("transform", function(d, i){
                      return "translate("+x(d.naziv)+", 0)";
                    }) ;
  
  //stupovi (pravokutnici) 
  bar.append("rect")
      .attr("y", function(d) { 
        return y(d.ocjena)+2; 
      })
      .attr("x", function(d,i){
        return x.rangeBand()+(margin.left/4)-100;
      })
      .attr("height", function(d) { 
        return height - y(d.ocjena); 
      })
      .attr("width", x.rangeBand())//set width base on range on ordinal data
      .style("fill", function(d) { 
      	switch(d.ocjena){
      		case 2:
      			return "red";
      			break;
      		case 3:
      			return "pink";
      			break;
      		case 4:
      			return "orange";
      			break;
      		case 5:
      			return "gold";
      			break;
      	}
      	}) ;  

	//ocjene (brojevi) na vrhu
  bar.append("text")
      .attr("x", x.rangeBand()+margin.left - 70 )
      .attr("y", function(d) { return y(d.ocjena) -20; })
      .attr("dy", ".35em")
      .style("fill", "red")   
      .text(function(d) { return d.ocjena; });
  
  //x os
  chart.append("g")
        .attr("transform", "translate("+ margin.left +","+ height+")")   
        .style("fill", "gray")     
        .call(xAxis);
  
  //test ocjena okomito
  chart.append("g")
        .attr("transform", "translate("+ margin.left+",0)")
        .call(yAxis)
        .append("text")
        .attr("transform", "rotate(-90)")
        .attr("dy", ".71em")
        .style("text-anchor", "end")
        .text("ocjena")
        .style("fill", "blue");
});

