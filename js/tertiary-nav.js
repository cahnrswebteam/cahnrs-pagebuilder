jQuery(document).ready(function($) {
	$( '#pagebuilder-tertiary-nav a.selected' ).on( 'click', function(event) {
		$(this).closest('ul').toggleClass('open');
		event.preventDefault();
	});
});