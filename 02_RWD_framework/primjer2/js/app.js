/* Ova linija mora ostati jer ona definira svu foundation javascript fukcionalnost */
//$(document).foundation();

/* ovdje pišemo JavaScript kod */
var ocjene = [
				{"naziv": "Hrvatski", "ocjena": 2},
				{"naziv": "Matematika", "ocjena": 5},
				{"naziv": "Informatika", "ocjena": 5},
				{"naziv": "Engleski", "ocjena": 5},
				{"naziv": "Fizika", "ocjena": 4},
				{"naziv": "Kemija", "ocjena": 3}
			];	

$(function(){
	var sadrzaj="";
	for(var i=0;i<ocjene.length;i++){
		sadrzaj+="<div class=\"large-2 medium-2 small-4 columns\"><div class=\"callout centar\"><div class=\"slider vertical\" data-slider data-initial-start=\"" + ocjene[i].ocjena + "\" data-end=\"5\" data-vertical=\"true\"><span class=\"slider-handle\"  data-slider-handle role=\"slider\" tabindex=\"1\" aria-controls=\"" + ocjene[i].naziv + "\"></span><span class=\"slider-fill\" data-slider-fill></span></div><br />" + ocjene[i].naziv + "<br /> <input class=\"brojcano\" type=\"number\" min=\"1\" max=\"5\" id=\"" + ocjene[i].naziv + "\"></div></div>";
	}
	$("#tijelo").html(sadrzaj);
	Foundation.Slider.defaults.decimal=0;
	$(document).foundation();
	izracunajProsjek();
	
	$(".brojcano").change(function(){
		//console.log($(this).val());
		$(this).val(Math.round($(this).val()));
		
		izracunajProsjek();
	});
	
	
});


function izracunajProsjek(){
	var ukupno=0;
		$( ".brojcano" ).each(function( index ) {
		  ukupno+= parseInt($(this).val());
		});
		//console.log(ukupno);
		//console.log(ocjene.length);
		$("#prosjek").html((ukupno/ocjene.length).toFixed(2));
}
