/* Javascript Document */
/* Created by redAtom Studios @ 2012 */

var confirmObj, formObj;

function hidePopupSlider() {
	$('#popupSlider').queue('fx', []).animate({height: 0}, function(){ $(this).hide().html(''); });
}

function openPopupSlider(htmlContent) {
	if(htmlContent)  {
		$('#popupSlider').queue('fx', []).html(htmlContent).show().animate({height: 100 + '%'});
	} else {
		$('#popupSlider').queue('fx', []).show().animate({height: 100 + '%'});
	}
}

function submitForm(confirm, form) {
	$(confirm).attr({value: 'true'});
	$(form).submit();
}

function openForm(dataFields) {
	var form = "<form action='" + dataFields.action + "' method='" + dataFields.method + "'";
		if(dataFields.enctype) {
			form += " enctype='" + dataFields.enctype + "'"; 
		}
		form += " class='spaceTop'>";
		form += "<h1 style='font-size: 3em; font-weight: bold; padding: 0 20px;'>" + dataFields.heading + "</h1>";
	var elements = dataFields.elements;
	for(thisElement in elements) {
		thisElement = elements[thisElement];
		switch(thisElement.type) {
			case 'text':
			case 'password':
			form += '<div class="gridTwo spaceTop spaceBottom small">';
			form += '<label for="' + thisElement.name + '">' + thisElement.label + '</label>'
			form += "<input id='" + thisElement.name + "' ";	
			for(attribute in thisElement) {
				form += attribute + "='" + thisElement[attribute] + "' ";
			}
			form += "/></div>";
			break;
			// END OF TEXT --------------------------------------------------------------------------------
			case 'hidden':
			form += "<input id='" + thisElement.name + "' ";	
			for(attribute in thisElement) {
				form += attribute + "='" + thisElement[attribute] + "' ";
			}
			form += "/>";
			break;
			// END OF HIDDEN ------------------------------------------------------------------------------
			case "textarea":
			form += '<div class="gridOne spaceTop spaceBottom small">';
			form += '<label for="' + thisElement.name + '">' + thisElement.label + '</label>';
			form += "<textarea style='min-height: 150px;' id='" + thisElement.name + "' name='" + thisElement.name + "'></textarea>";
			form += "</div>";
			break;	
			// END OF TEXTAREA ----------------------------------------------------------------------------
			case 'file':
			form += '<div class="gridTwo spaceTop spaceBottom small">';
			form += '<label for="' + thisElement.name + '">' + thisElement.label + '</label>'
			form += "<input id='" + thisElement.name + "' ";	
			for(attribute in thisElement) {
				form += attribute + "='" + thisElement[attribute] + "' ";
			}
			form += "/></div>";
			break;
		}
		// form += thisElement.type;
	}
	form += "<div class='clear'></div><div class='gridOne spaceTop small'><input type='submit' value='Submit' /><input type='button' value='Cancel' onclick='hidePopupSlider();' /></div>"; 
	form += "</form>"
	openPopupSlider(form);
}

function showAttachments(dataFields) {
	var data = "<div class='gridOne spaceTop'>";

	// data += "<form action='' method='POST'>";
	data += "<table class='displayAttachments'>";
	data += "<thead>" +
				"<th>Filename</th>" +
				"<th>Time</th>" +
				// "<th>Delete?</th>" +
			"</thead>" +
			"<tbody>";
		
	for(thisAttachment in dataFields.attachments) {
		thisAttachment = dataFields.attachments[thisAttachment];
		data += "<tr>" +
					"<td>" + thisAttachment['filename'] + "</td>" +
					"<td>" + thisAttachment['timestamp'] + "</td>" +
					// "<td><input type='checkbox' class='deleteAttachmentFlag' value='' /></td>" +
				"</tr>";
	}

	data += "</tbody></table>"; 
	// data += '<input id="attachmentsToDelete" type="hidden" name"deleteFiles" value="" /></form>';
	// data += "<div class='clear'></div><div class='gridOne spaceTop small'><input type='submit' value='Submit' /><input type='button' value='Cancel' onclick='hidePopupSlider();' /></div>"
	data += "</div>";

	filesToDelete = '';

	openPopupSlider(data);
	$('table.displayAttachments').dataTable({
        "bPaginate": true,
        "bLengthChange": false,
        "bFilter" : true,
        "bInfo" : true,
        "bSort": false
	});
}

jQuery(document).ready(function() {

	// Datatable for showing large amounts of data and comments, scrolling enabled
	$('table.data').dataTable({
		"sScrollY": "350px",
        "bPaginate": false,
        "bFilter" : false,
        "bInfo" : false,
        "bScrollCollapse": true
	});

	// Datatable without advanced comments functionality, just pagination
	$('table.displayOnly').dataTable({
        "bPaginate": true,
        "iDisplayLength": 5,
        "bLengthChange": false,
        "bFilter" : false,
        "bInfo" : false,
        "bSort": false
	});

	// Datatable for showing single row, used just to show project details
	$('table.singleRow').dataTable({
        "bPaginate": false,
        "bLengthChange": false,
        "bFilter" : false,
        "bInfo" : false,
        "bSort": false
	});	

	// Initialize datepicker plugin on all pages
	$('.datePicker').datepicker({minDate: 0, numberOfMonths: 3});

	// Apply clearfix to bodyContent, make sure the body wraps around any floats inside it
	$('.bodyContent').append('<div class="clear"></div>');

	// Initialize the general purpose overlay DIV
	// Used for form submission confirmation, dynamically generated forms
	$('body').append('<div id="popupSlider"></div>');

	// Add hidden element to forms to check if they've been confirmed
	$('form').prepend('<input type="hidden" name="confirmed" value="false" />');

	// Get the value of the selected leader so we can disabled it in the member selection
	if($('.projectLeader')[0]) {
		var selectedValue = $('.projectLeader')[0].value;
	}
	// The same person can't be project leader AND member, so we disabled the selected
	// leader in the member selection menu 
	$('.projectMembers option').each(function() {
		if(this.value == selectedValue) {
			$(this).attr({disabled: 'disabled'}).removeAttr('selected');
		} else {
			$(this).removeAttr('disabled');
		}
	});

	/*
	 * For forms where confirmation is required
	 * Serialize the inputs, parse the string and display the data 
	 * along with a confirm and cancel button
	 * Confirmation is shown in the general purpose 
	 */

    $('form.confirmationRequired').submit(function(e) {
    	formObj = this;
    	var isConfirmed = $(this).find('input[name="confirmed"]')[0];
    	confirmObj = isConfirmed;
    	isConfirmed = isConfirmed.value;
    	if(isConfirmed == "false") {
	    	e.preventDefault();
	    	formFields = $(this).serialize();
	    	console.log(formFields);
	    	formFields = formFields.split('&');
	    	var divString = "<div class='gridOne spaceTop spaceBottom' style='margin-top: 100px'>The following values will be insterted into the database: Confirm to continue.</div>";
	    	for(thisField in formFields) {
	    		formFields[thisField] = formFields[thisField].split('=');
	    		if(formFields[thisField][1]) {
	    			var fieldName = decodeURIComponent(formFields[thisField][0]);
	    			var fieldValue = decodeURIComponent(formFields[thisField][1]);
	    			if(document.getElementsByName(fieldName)[0].type != 'hidden') {
		    			if(typeof(fieldValue) == 'number' || /^\d*$/.test(fieldValue.toString(10))) {
		    				// Check if it's a dropdown and if so, replace fieldValue with the string of the value
		    				var thisElement = document.getElementsByName(fieldName)[0];
		    				if(thisElement.tagName == "SELECT") {
		    					for(thisChild in thisElement.children) {
		    						if(thisElement.children[thisChild].value == fieldValue) {
		    							fieldValue = $(thisElement.children[thisChild]).html();
		    						}
		    					}
		    					divString += "<div class='gridTwo spaceTop'><label>" + fieldName + "</label>" + fieldValue + "</div>"; 
		    				} else {
		    					divString += "<div class='gridTwo spaceTop'><label>" + fieldName + "</label>" + fieldValue + "</div>"; 
		    				}
		    			} else {
		    				divString += "<div class='gridTwo spaceTop'><label>" + fieldName + "</label>" + fieldValue + "</div>"; 
		    			}
		    		}
	    		}
	    	}
	    	console.log(confirmObj, formObj);
	    	divString += "<div class='clear'></div><div class='gridOne spaceTop'><input type='button' value='Confirm' onClick='submitForm(confirmObj, formObj)' /><input type='button' value='Cancel' onclick='hidePopupSlider();' /></div>"; 
	    	$('#popupSlider').html(divString);
	    	openPopupSlider();
	    }
    });
	

	// Update the subsectors when a new sector is selected
	$('#liveSector').change(function() {
		if(subSectors[this.value]) {
			$('#liveSubsector').html(subSectors[this.value]);
		} else {
			$('#liveSubsector').empty();
		}
	});

	// When a project leader is selected, disable that option in member list
	$('.projectLeader').click(function() {
		var selectedValue = this.value;
		$('.projectMembers option').each(function() {
			if(this.value == selectedValue) {
				$(this).attr({disabled: 'disabled'}).removeAttr('selected');
			} else {
				$(this).removeAttr('disabled');
			}
		});
	});

	// Only show the subordinates if the selected rank is MEMBER
	$('#memberRank').change(function() {
		if(this.value == "3") {
			$('#displaySubordinates').show();
		} else {
			$('#displaySubordinates').hide();
		}
	})

	// Disabled anchors are used to display tooltips
	// When clicked, they shouldn't do anything.
	$('body').on('click', 'a.disabled', function(e){
		e.preventDefault();
	});

});


/*
 * NOTIFICATION SYSTEM
 */

/* Notifier Variables */
var alert_id = 0;
var notify_delay = 3000;
var notifyStack = [];
var liveNotifications = 0;
var maxParallelNotify = 2;
var emailRegex = /\S+@\S+\.\S+/;

var getElement = function(elementID) {
	return document.getElementById(elementID);
}

var checkEmail = function(email, errorStack) {
	if(!emailRegex.test(email)) {
		errorStack.push(['Please enter a valid email address.', 0]);
	}
}

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