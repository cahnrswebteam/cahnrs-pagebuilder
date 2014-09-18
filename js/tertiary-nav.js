jQuery(document).ready(function($) {
	$( 'body' ).on( 'click', '#pagebuilder-tertiary-nav a.selected', function(event) {
		//$( this ).addClass('selected');
		//$(this).closest('ul').toggleClass('selected');
		//event.preventDefault();
		$(this).closest('ul').toggleClass('open');
		event.preventDefault();
	});
});