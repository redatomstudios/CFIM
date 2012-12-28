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

	(function( $ ) {
		$.widget( "ui.combobox", {
			_create: function() {
				var input,
					that = this,
					select = this.element.hide(),
					selected = select.children( ":selected" ),
					value = selected.val() ? selected.text() : "",
					wrapper = this.wrapper = $( "<span>" )
						.addClass( "ui-combobox" )
						.insertAfter( select );

				function removeIfInvalid(element) {
					var value = $( element ).val(),
						matcher = new RegExp( "^" + $.ui.autocomplete.escapeRegex( value ) + "$", "i" ),
						valid = false;
					select.children( "option" ).each(function() {
						if ( $( this ).text().match( matcher ) ) {
							this.selected = valid = true;
							select[0].parentNode.children[3].value = "";
							return false;
						}
					});
					if ( !valid ) {
						// remove invalid value, as it didn't match anything
						// $( element )
							//.val( "" )
							//.attr( "title", value + " didn't match any item" )
							//.tooltip( "open" );
						select.val( "" );
						select[0].parentNode.children[3].value = $( element ).val();
						setTimeout(function() {
							input.tooltip( "close" ).attr( "title", "" );
						}, 2500 );
						input.data( "autocomplete" ).term = "";
						return false;
					}
				}

				input = $( "<input>" )
					.appendTo( wrapper )
					.val( value )
					.attr( "title", "" )
					.addClass( "ui-state-default ui-combobox-input" )
					.autocomplete({
						delay: 0,
						minLength: 0,
						source: function( request, response ) {
							var matcher = new RegExp( $.ui.autocomplete.escapeRegex(request.term), "i" );
							response( select.children( "option" ).map(function() {
								var text = $( this ).text();
								if ( this.value && ( !request.term || matcher.test(text) ) )
									return {
										label: text.replace(
											new RegExp(
												"(?![^&;]+;)(?!<[^<>]*)(" +
												$.ui.autocomplete.escapeRegex(request.term) +
												")(?![^<>]*>)(?![^&;]+;)", "gi"
											), "<strong>$1</strong>" ),
										value: text,
										option: this
									};
							}) );
						},
						select: function( event, ui ) {
							ui.item.option.selected = true;
							that._trigger( "selected", event, {
								item: ui.item.option
							});
						},
						change: function( event, ui ) {
							if ( !ui.item )
								return removeIfInvalid( this );
						}
					})
					.addClass( "ui-widget ui-widget-content ui-corner-left" );

				input.data( "autocomplete" )._renderItem = function( ul, item ) {
					return $( "<li>" )
						.data( "item.autocomplete", item )
						.append( "<a>" + item.label + "</a>" )
						.appendTo( ul );
				};

				$( "<a>" )
					.attr( "tabIndex", -1 )
					//.attr( "title", "Show All Items" )
					//.tooltip()
					.appendTo( wrapper )
					.button({
						icons: {
							primary: "ui-icon-triangle-1-s"
						},
						text: false
					})
					.removeClass( "ui-corner-all" )
					.addClass( "ui-corner-right ui-combobox-toggle" )
					.css({height: 25 + 'px'})
					.click(function() {
						// close if already visible
						if ( input.autocomplete( "widget" ).is( ":visible" ) ) {
							input.autocomplete( "close" );
							removeIfInvalid( input );
							return;
						}

						// work around a bug (likely same cause as #5265)
						$( this ).blur();

						// pass empty string as value to search for, displaying all results
						input.autocomplete( "search", "" );
						input.focus();
					});

					input
						.tooltip({
							position: {
								of: this.button
							},
							tooltipClass: "ui-state-highlight"
						});
			},

			destroy: function() {
				this.wrapper.remove();
				this.element.show();
				$.Widget.prototype.destroy.call( this );
			}
		});
	})( jQuery );
 
    $(function() {
        $( ".combobox" ).combobox();
    });

    $('form').submit(function(e) {
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
	    	console.log(confirmObj, formObj);
	    	divString += "<div class='gridTwo spaceTop'><input type='button' value='Confirm' onClick='submitForm(confirmObj, formObj)' /><input type='button' value='Cancel' onclick='hidePopupSlider();' /></div>"; 
	    	$('#popupSlider').show().animate({height: 100 + '%'}).html(divString);
	    }
    });
});