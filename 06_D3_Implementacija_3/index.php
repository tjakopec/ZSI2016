<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>No. Of Victims</title>
	
	<link rel="stylesheet" href="css/app.css" />
	<script src="js/d3.min.js"></script>

<body>
<div id = "svgContent"></div>

<script>
var data = [

<?php 
$veza = new PDO("mysql:dbname=omszsi2016;host=localhost;charset=utf8","root","000000",
				array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    				PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
					)
				);
$izraz = $veza->prepare("

select a.sifra, a.tekst, count(b.operater) as ukupno
from status a inner join svidamisestatus b on a.sifra=b.status
group by a.sifra, a.tekst
order by 3 desc limit 20

");
$izraz->execute();
$skup = $izraz->fetchALL(PDO::FETCH_OBJ);
foreach($skup as $p):	
	echo "{\"status\":\"" . $p->tekst . "\",\"svidanja\":" . $p->ukupno . "},\n";		
 endforeach; 
?>
            
            ];
var margin = {top:40,left:40,right:40,bottom:40};
width = 350;
height = 350;
radius = Math.min(width-100,height-100)/2;
var color = d3.scale.category10();
var arc = d3.svg.arc()  
         .outerRadius(radius -230)
         .innerRadius(radius - 50)
		 .cornerRadius(20);
var arcOver = d3.svg.arc()  
.outerRadius(radius +50)
.innerRadius(0);

var a=width/2 - 20;
var b=height/2 - 90;
var svg = d3.select("#svgContent").append("svg")
          .attr("viewBox", "0 0 " + width + " " + height/2)
    .attr("preserveAspectRatio", "xMidYMid meet")
          .append("g")
          .attr("transform","translate("+a+","+b+")");

		  div = d3.select("body")
.append("div") 
.attr("class", "tooltip");
var pie = d3.layout.pie()
          .sort(null)
          .value(function(d){return d.svidanja;})
		  .padAngle(.02);
var g = svg.selectAll(".arc")
        .data(pie(data))
        .enter()
        .append("g")
        .attr("class","arc")
         .on("mousemove",function(d){
        	var mouseVal = d3.mouse(this);
        	div.style("display","none");
        	div
        	.html("Status: "+d.data.status+"<br />"+"Broj sviđanja: "+d.data.svidanja)
            .style("left", (d3.event.pageX+12) + "px")
            .style("top", (d3.event.pageY-10) + "px")
            .style("opacity", 1)
            .style("display","block");
        })
        .on("mouseout",function(){div.html(" ").style("display","none");});
        
        
        
		g.append("path")
		.attr("d",arc)
		.style("fill",function(d){return color(d.data.status);})
		 .attr("d", arc);;
</script>


</body>
</html>