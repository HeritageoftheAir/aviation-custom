


jQuery(document).ready(function($){
	console.log("init foo");
	var audio = document.getElementById("html5-media-1");

	var segmentTimes = [];
	var currentSegment;
	$('#audio-transcript div.transcript-segment span.starttime').each(function(){
		secs = timecodeToSeconds($(this).text());
		segmentTimes.push(secs);
	});

	console.log(segmentTimes);

	audio.addEventListener( "timeupdate", function(e) {
		var newSegment;
		for(var s=0; s<segmentTimes.length-1; s++){
			if (audio.currentTime >= segmentTimes[s] ) newSegment = s;
		}
		if (newSegment != currentSegment){
			currentSegment = newSegment;
			$('#audio-transcript div.transcript-segment').removeClass('playing');
			$('#audio-transcript div.transcript-segment').eq(currentSegment).addClass('playing');
		}
	});


	$('#audio-transcript div.transcript-segment').on('click', function(){
		var starttime = $(this).find(".starttime").text();
		console.log(starttime + " starttime");
		var secs = timecodeToSeconds(starttime);
		console.log(secs + " seconds" );
		audio.currentTime = secs;
		audio.play();
	});


	function timecodeToSeconds(tc){
		// string like "1:15:22"
		tcbits = tc.split(":");
		seconds = 0;
		for (var i = tcbits.length - 1; i >= 0; i--) {
				if (i == tcbits.length-1) seconds += parseInt(tcbits[i]); //seconds
				if (i == tcbits.length-2) seconds += parseInt(tcbits[i])*60; // minutes
				if (i == tcbits.length-3) seconds += parseInt(tcbits[i])*3600; // hours
			};
		return seconds;	
	}

});

