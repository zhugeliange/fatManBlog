$(document).ready(function() 
{
	$(".clock").height($(".clock").width());
	var clockLength = $(".clock").width();
	var clock   = Snap("#clock");
	var hours   = clock.rect((0.5 * clockLength - 1.5), (0.5 * clockLength - 1.5), 3, (0.2 * clockLength)).attr({fill: "#fff", transform: "r" + 10 * 30 + "," + (0.5 * clockLength -1.5) + "," + (0.5 * clockLength -1.5)});
	var minutes = clock.rect((0.5 * clockLength - 1), (0.5 * clockLength - 1), 2, (0.3 * clockLength)).attr({fill: "#fff", transform: "r" + 10 * 6 + "," + (0.5 * clockLength - 1) + "," + (0.5 * clockLength -1)});
	var seconds = clock.rect((0.5 * clockLength - 0.5), (0.5 * clockLength - 0.5), 1, (0.4 * clockLength)).attr({fill: "#fff", transform: "r" + 0 + "," + (0.5 * clockLength - 0.5) + "," + (0.5 * clockLength -0.5)});
	var middle  = clock.circle((0.5 * clockLength), (0.5 * clockLength), 5).attr({fill: "#ff69b4"});

	var updateTime = function(_clock, _hours, _minutes, _seconds) 
	{
		var currentTime, hour, minute, second;
		currentTime = new Date();
		second = currentTime.getSeconds();
		minute = currentTime.getMinutes();
		hour = currentTime.getHours();
		hour = (hour > 12) ? hour - 12 : hour;
		hour = (hour == '00') ? 12 : hour;

		if(second == 0)
		{
			second = 60;
		}
		else if(second == 1 && _seconds)
		{
			_seconds.attr({transform: "r" + 0 + "," + (0.5 * clockLength) + "," + (0.5 * clockLength)});
		}
		if(minute == 0)
		{
			minute = 60;
		}
		else if(minute == 1)
		{
			_minutes.attr({transform: "r" + 0 + "," + (0.5 * clockLength) + "," + (0.5 * clockLength)});
		}

		_hours.animate({transform: "r" + hour * 30 + "," + (0.5 * clockLength) + "," + (0.5 * clockLength)}, 1000, mina.elastic);
		_minutes.animate({transform: "r" + minute * 6 + "," + (0.5 * clockLength) + "," + (0.5 * clockLength)}, 1000, mina.elastic);

		if(_seconds)
		{
			_seconds.animate({transform: "r" + second * 6 + "," + (0.5 * clockLength) + "," + (0.5 * clockLength)}, 1000, mina.elastic);
		}
	}

	setInterval(function(){updateTime(clock, hours, minutes, seconds);}, 1000);

	setTimeout(function(){
		if ($.cookie('new_user')) {
			$('#welcome').fadeIn('slow');
			$.cookie('new_user', '');
		}
	}, 2000);	

	$('#welcome').click(function() {
		$(this).fadeOut('slow');
	});
});