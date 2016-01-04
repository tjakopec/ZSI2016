/* Ova linija mora ostati jer ona definira svu foundation javascript fukcionalnost */
//$(document).foundation();

/* ovdje pišemo JavaScript kod */
$(function(){
	var ocjene = [
				{"naziv": "Hrvatski", "ocjena": 2},
				{"naziv": "Matematika", "ocjena": 5},
				{"naziv": "Informatika", "ocjena": 5},
				{"naziv": "Engleski", "ocjena": 5},
				{"naziv": "Fizika", "ocjena": 4},
				{"naziv": "Kemija", "ocjena": 3}
			];
	var sadrzaj="";
	for(var i=0;i<ocjene.length;i++){
		sadrzaj+="<div class=\"large-2 medium-2 small-4 columns\"><div class=\"callout centar\"><div class=\"slider vertical\" data-slider data-initial-start=\"" + ocjene[i].ocjena + "\" data-end=\"5\" data-vertical=\"true\"><span class=\"slider-handle\" data-slider-handle role=\"slider\" tabindex=\"1\"></span><span class=\"slider-fill\" data-slider-fill></span><input type=\"hidden\"></div><br />" + ocjene[i].naziv + "<br />" + ocjene[i].ocjena + "</div></div>";
	}
	//$("#tijelo").html(sadrzaj);
	
	$(document).foundation();
});
