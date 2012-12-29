/* Javascript Document */
/* Created by redAtom Studios @ 2012 */

var confirmObj, formObj;

function hidePopupSlider() {
	$('#popupSlider').animate({height: 0}, function(){ $(this).hide().html(''); });
}

function submitForm(confirm, form) {
	$(confirm).attr({value: 'true'});
	$(form).submit();
}

jQuery(document).ready(function() {
	$('table.data').dataTable({
		"sScrollY": "350px",
        "bPaginate": false,
        "bScrollCollapse": true
	});

	$('.datePicker').datepicker({minDate: 0, numberOfMonths: 3});

	$('.bodyContent').append('<div class="clear"></div>');

	// Initialize the confirmation and popup windows
	$('body').append('<div id="popupSlider"></div>');

	// Add hidden element to forms to check if they've been confirmed
	$('form').prepend('<input type="hidden" name="confirmed" value="false" />');

	if($('.projectLeader')[0]) {
		var selectedValue = $('.projectLeader')[0].value;
	}
	$('.projectMembers option').each(function() {
		if(this.value == selectedValue) {
			$(this).attr({disabled: 'disabled'}).removeAttr('selected');
		} else {
			$(this).removeAttr('disabled');
		}
	});

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
	    	$('#popupSlider').show().animate({height: 100 + '%'}).html(divString);
	    }
    });
	
	$('#liveSector').change(function() {
		$('#liveSubsector').html(subSectors[this.value]);
	});

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

	$('#memberRank').change(function() {
		if(this.value == "3") {
			$('#displaySubordinates').show();
		} else {
			$('#displaySubordinates').hide();
		}
	})

});