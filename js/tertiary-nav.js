jQuery(document).ready(function($) {
	$( 'body' ).on( 'click', '#pagebuilder-tertiary-nav a', function(event) {
		$( this ).addClass('selected');
		$(this).closest('ul').toggleClass('selected');
		event.preventDefault();
	});
});