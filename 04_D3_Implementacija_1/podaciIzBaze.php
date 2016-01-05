<?php
//NIJE RJESENJE ALI CE POMOCI
ini_set('memory_limit', '-1');

$veza = new PDO("mysql:dbname=omszsi2016;host=localhost;charset=utf8","root","000000",
				array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    				PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
					)
				);

$izraz = $veza->prepare("
select 
year(datum) as godina, 
month(datum) as mjesec, 
day(datum) as dan, 
hour(datum) as sat,
count(status) as ukupno 
from svidamisestatus 
group by 
year(datum),
month(datum),
day(datum),
hour(datum)
");
$izraz->execute();
$skup = $izraz->fetchALL(PDO::FETCH_OBJ);
foreach($skup as $p):	
	echo "godina-mjesec-dan-sat," . $p->ukupno . "\n";		
 endforeach; 
 
 
 
 $izraz = $veza->prepare("
select 
year(datum) as godina, 
month(datum) as mjesec, 
day(datum) as dan,
count(status) as ukupno 
from svidamisestatus 
group by 
year(datum),
month(datum),
day(datum)
");
$izraz->execute();
$skup = $izraz->fetchALL(PDO::FETCH_OBJ);
foreach($skup as $p):	
	echo "godina-mjesec-dan," . $p->ukupno . "\n";		
 endforeach; 
 
 
 
 
  $izraz = $veza->prepare("
select 
year(datum) as godina, 
month(datum) as mjesec, 
count(status) as ukupno 
from svidamisestatus 
group by 
year(datum),
month(datum)
");
$izraz->execute();
$skup = $izraz->fetchALL(PDO::FETCH_OBJ);
foreach($skup as $p):	
	echo "godina-mjesec," . $p->ukupno . "\n";		
 endforeach; 
 
 
 
   $izraz = $veza->prepare("
select 
year(datum) as godina,
count(status) as ukupno 
from svidamisestatus 
group by 
year(datum)
");
$izraz->execute();
$skup = $izraz->fetchALL(PDO::FETCH_OBJ);
foreach($skup as $p):	
	echo "godina," . $p->ukupno . "\n";		
 endforeach; 