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
	var form = "<form action='" + dataFields.action + "' method='" + dataFields.method + "' class='spaceTop'>";
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

jQuery(document).ready(function() {
	$('table.data').dataTable({
		"sScrollY": "350px",
        "bPaginate": false,
        "bFilter" : false,
        "bInfo" : false,
        "bScrollCollapse": true
	});

	$('table.displayOnly').dataTable({
        "bPaginate": true,
        "iDisplayLength": 5,
        "bLengthChange": false,
        "bFilter" : false,
        "bInfo" : false,
        "bSort": false
	});

	$('table.singleRow').dataTable({
        "bPaginate": false,
        "bLengthChange": false,
        "bFilter" : false,
        "bInfo" : false,
        "bSort": false
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
	    	$('#popupSlider').html(divString);
	    	openPopupSlider();
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

	$('body').on('click', 'a.disabled', function(e){
		e.preventDefault();
	});

});


