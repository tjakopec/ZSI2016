/* Ova linija mora ostati jer ona definira svu foundation javascript fukcionalnost */
$(document).foundation();

/* ovdje pišemo JavaScript kod */

//upravljanje događajem
d3.select("#gumb").on("click",function(){
	d3.selectAll(".callout").style("color", "red");
});

//umetanje elemenata
d3.select("body").selectAll("p")
    .data([4, 8, 15, 16, 23, 42])
  .enter().append("p")
    .text(function(d) { return "I’m number " + d + "!"; });
    
//tranzicije
d3.select("body").transition()
    .style("background-color", "orange");
    
