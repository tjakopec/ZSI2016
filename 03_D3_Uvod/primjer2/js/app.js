/* Ova linija mora ostati jer ona definira svu foundation javascript fukcionalnost */
$(document).foundation();

/* ovdje pišemo JavaScript kod */

       //Make an SVG Container
 var svgContainer = d3.select("#tijelo").append("svg")
                                     .attr("width", 200)
                                     .attr("height", 200);
 
 //Draw the line
 var circle = svgContainer.append("line")
                          .attr("x1", 0)
                          .attr("y1", 200)
                         .attr("x2", 200)
                         .attr("y2", 0)
                         .attr("stroke-width", 2)
                         .attr("stroke", "black");
