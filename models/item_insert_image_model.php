<?php namespace cahnrswp\pagebuilder;

class item_insert_image_model {
	
	public $id = 'insert_image';
	public $name = 'Insert Image';
	public $description = 'Add additional images to layout.';
	public $subtype = 'page_item';
	public $instance;
	
	public function __construct( $instance = array() ){
		$this->instance = $instance;
	}
	
	public function get_form( $instance, $ipt_name ){

		include DIR.'inc/form-part-insert-image.php';
		
	}
	
	public function item_render_site( $post , $instance ){
		
		if( !isset( $instance['image-size'] ) || !$instance['image-size'] ) {
			$instance['image-size'] = 'large';
		} 
		
		if( isset( $instance['image-id'] ) ) {
			
			$img_url = wp_get_attachment_image_src( $instance['image-id'], $instance['image-size'] );
			
        	$img_url = $img_url[0];
			
			$img = '<img src="' . $img_url . '" />';
			
		} // end if

	}
	
	public function render_html_email( $pagebuilder_model ){
		
		if( !isset( $this->instance['image-size'] ) || !$this->instance['image-size'] ) {
			$this->instance['image-size'] = 'large';
		} 
		
		if( isset( $this->instance['image-id'] ) ) {
			
			$img_url = wp_get_attachment_image_src( $this->instance['image-id'], $this->instance['image-size'] );
			
        	$img_url = $img_url[0];
			
			$image = '<img class="insert-image" src="'.$img_url.'" width="100%" style="display: block;" />';
			
			return '<tr><td style="width: 100%;">'.$image.'</td></tr>';
			
		} else { // end if
		
			return '<tr><td></td></tr>';
			
		}
	}
	
};?>