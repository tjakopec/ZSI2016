<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sviđači</title>
    <script src="js/d3.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/colorBrewer.css">
	<script src="js/circosJS.js" type="text/javascript"></script>
  </head>
  <body>
	<svg id='chart' style='display: block; margin: auto;'></svg>


<?php 

$veza = new PDO("mysql:dbname=omszsi2016;host=localhost;charset=utf8","root","000000",
				array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    				PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
					)
				);

?>

<script type='text/javascript'>



var layout_data = [
<?php 

$izraz = $veza->prepare("call brojdanaumjesecu()");
$izraz->execute();
$skup = $izraz->fetchALL(PDO::FETCH_OBJ);
foreach($skup as $p):	
	echo "{ \"len\": " . $p->ukupno . ", \"color\": \"#8dd3c7\",  \"id\": \"m" . $p->mjesec . "\" },\n";		
 endforeach; 
?>
];


var dani = [
	<?php 
		foreach($skup as $p):	
			$izraz = $veza->prepare("
			select 
			day(datum) as dan, 
			count(status) as ukupno 
			from svidamisestatus 
	        where concat(year(datum),month(datum))=:mjesec
			group by 
			day(datum)
			order by datum;
			");
			$izraz->execute(array("mjesec" => $p->mjesec));
			$podskup = $izraz->fetchALL(PDO::FETCH_OBJ);
			$broj=0;
			foreach($podskup as $r):
					echo "\t['m" . $p->mjesec . "'," . $broj . "," . ++$broj . "," . $r->ukupno . "],\n";
			endforeach; 
			$p->podskup=$podskup;	
	 	endforeach; 
	?>
];
sati = [
    <?php 
    //VRLO LOŠ PRISTUP PROBLEMU, preveliki broj odlazaka u bazu
		foreach($skup as $p):	
			foreach($p->podskup as $r):
				$izraz = $veza->prepare("
				select 
				hour(datum) as dan, 
				count(status) as ukupno 
				from svidamisestatus 
		        where concat(year(datum),month(datum),day(datum))=:dan
				group by 
				hour(datum)
				order by datum;
				");
				$izraz->execute(array("dan" => $p->mjesec . $r->dan));
				$podpodskup = $izraz->fetchALL(PDO::FETCH_OBJ);
				$broj=0;
				foreach($podpodskup as $t):
						echo "\t['m" . $p->mjesec . "'," . $broj . "," . ++$broj . "," . $t->ukupno . "],\n";
				endforeach; 	
			endforeach; 
	 	endforeach; 
	?>
];



  var circos = new circosJS({
      container: '#chart',
      width: 650,
      height: 650,
  });

  circos
    .layout(
        {
            innerRadius: 160,
            outerRadius: 200,
            ticks: {display: false},
            labels: {
              position: 'center',
              display: true,
              size: 14,
              color: '#000',
              radialOffset: 15,
            }
        },
        layout_data
    )
    .heatmap('dani', {
        innerRadius: 90,
        outerRadius: 155,
        logScale: true,
        colorPalette: 'YlOrRd',
    }, dani)
    .heatmap('sati', {
        innerRadius: 30,
        outerRadius: 85,
        logScale: true,
        colorPalette: 'Blues'
    }, sati)
    .render();
</script>


  </body>
</html>
