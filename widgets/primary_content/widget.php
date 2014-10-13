<?php 
class pagebuilder_primary_content extends \WP_Widget {


	/**
	 * Sets up the widgets name etc.
	 */
	public function __construct() {

		parent::__construct(
			'pagebuilder_primary_content', // Base ID
			'Primary Content', // Name
			array( 'description' => 'Content from the standard Wordpress editor.' ) // Args
		);

	}

	public function widget( $args, $instance ) {

	}

	public function form( $instance ) {

	}

	public function update( $new_instance, $old_instance ) {

		return $instance;

	}


}


/**
 * Register widget with WordPress.
 */
add_action( 'widgets_init', function() {
	register_widget( 'pagebuilder_primary_content' );
});

?>