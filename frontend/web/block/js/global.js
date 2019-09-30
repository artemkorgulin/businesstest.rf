/*
Author: WebThemez
Author URL: http://webthemez.com 
*/
$( function() {
// Add background image
	//$.backstretch('images/road2.jpg');
    var date_split = openDate.split(" ");
    var date = date_split[0];
    date = date.split("-");
    var time = date_split[1];
    time = time.split(":");
    var date_object = new Date(date[0],date[1]-1,date[2],time[0],time[1],time[2]);

	var endDate = date_object;
	$('.countdown.simple').countdown({ date: endDate });
	$('.countdown.styled').countdown({
	  date: endDate,
	  render: function(data) {
		$(this.el).html("<div>" + this.leadingZeros(data.days, 3) + " <span>DAYS</span></div><div>" + this.leadingZeros(data.hours, 2) + " <span>HOURS</span></div><div>" + this.leadingZeros(data.min, 2) + " <span>MINUTES</span></div><div>" + this.leadingZeros(data.sec, 2) + " <span>SECONDS</span></div>");
	  }
	});
	$('.countdown.callback').countdown({
	  date: +(new Date) + 10000,
	  render: function(data) {
		$(this.el).text(this.leadingZeros(data.sec, 2) + " sec");
	  },
	  onEnd: function() {
		$(this.el).addClass('ended');
	  }
	}).on("click", function() {
	  $(this).removeClass('ended').data('countdown').update(+(new Date) + 10000).start();
	});

});
