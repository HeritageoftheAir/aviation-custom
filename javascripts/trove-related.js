


jQuery(document).ready(function($){
	var tags = $("#item-tags div.element-text a").text();
	console.log(tags);
	//if (isArray(tags))
//	var q = encodeURI(tags.join(" OR "));
	var q = encodeURI(tags);
	var url = "http://connectingthenation.net.au/trove.php?query="+q;
	//var url = "http://api.trove.nla.gov.au/?query="+q+"&l-australia=y&l-availability=y/f&key=vl6ahuf5l47j4vaq&encoding=json&callback=?";
	//
	// $('#trove-related').append("<ul>");

	// $.getJSON(url, function(data){

	// 	data.response.zone.forEach(function(z){
	// 		var li= $("<li>").text(z.name + " - " + z.records.total);
	// 		$("#trove-related ul").append(li);
	// 	});
	// });


});

