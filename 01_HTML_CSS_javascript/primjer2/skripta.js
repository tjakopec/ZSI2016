/* ovdje pišemo JavaScript kod */

var ocjene = [
				{"naziv": "Hrvatski", "ocjena": 2},
				{"naziv": "Matematika", "ocjena": 5},
				{"naziv": "Informatika", "ocjena": 5},
				{"naziv": "Engleski", "ocjena": 5},
				{"naziv": "Fizika", "ocjena": 5},
				{"naziv": "Kemija", "ocjena": 3}
			];
var ukupno=0;
for(var i=0;i<ocjene.length;i++){
	document.writeln("<div class=\"ocjena-" + ocjene[i].ocjena + "\">" + ocjene[i].naziv + "</div>");
	ukupno+=ocjene[i].ocjena;
	//console.log(ocjene[i].naziv);
}

document.writeln("<p class=\"clear\">Prosjek: " + (ukupno/ocjene.length).toFixed(2) + "</p>");
