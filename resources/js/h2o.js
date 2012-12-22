/* Javascript Document */
/* Created by redAtom Studios @ 2012 */

jQuery(document).ready(function() {
	$('table.data').dataTable({
		"sScrollY": "350px",
        "bPaginate": false,
        "bScrollCollapse": true
	});

	$('.datePicker').datepicker({minDate: 0, numberOfMonths: 3});

	$('.bodyContent').append('<div class="clear"></div>');
});