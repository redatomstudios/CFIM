/* Notifier Variables */
var alert_id = 0;
var notify_delay = 3000;
var notifyStack = [];
var liveNotifications = 0;
var maxParallelNotify = 2;

// Notification functions
var openNotification = function() {
	if(notifyStack.length > 0 && liveNotifications <= maxParallelNotify) {
		var thisMessage = notifyStack.shift(); // Get the latest message
		var thisType = thisMessage.split('^')[1]; // Separate the message type and message
		thisMessage = thisMessage.split('^')[0];
		$('div#notifier').append('<div id="m'+alert_id+'" class="'+(thisType == '1' ? 'notification' : 'alert')+'">'+thisMessage+'</div>') // Create control string to output to JS
		var this_id = '#m' + alert_id++;
		$(this_id).animate({height: 2+'em'}, function(){
			liveNotifications++;
			if(liveNotifications < maxParallelNotify) { // Open notifications in parallel, until limit reached
				openNotification();
			}
			setTimeout(function(){
				$(this_id).queue('fx', []).animate({height: 0}, function(){
					$(this).hide().remove();
					if(liveNotifications == maxParallelNotify)
						openNotification(); // When last message is fired, check stack and repeat if there are more messages.
					liveNotifications--;
				});
			}, notify_delay);
		});
	}
}

var stackNotify = function(message, type) {
	notifyStack.push(message + '^' + type);
}

var Notify = function(messages) {
	$.each(messages, function(index, value){
		stackNotify(value[0], value[1]);
	});
	openNotification();
}

jQuery(document).ready(function($){
	$('html').prepend('<div id="notifier"></div>');
});