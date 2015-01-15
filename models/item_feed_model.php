<?php namespace cahnrswp\pagebuilder;

class item_feed_model {
	
	public $id = 'feed';
	
	public $name = 'Content Feed';
	
	public $description = 'Feeds content from other posts and sites.';
	
	public $is_content = false;
	
	public $subtype = 'page_item';
	
	private $input_name = false;
	
	public $instance;
	
	public function __construct( $instance = array() ){
		
		$this->instance = $instance;
		
	}
	
	/*
	 * @desc - Set default values
	 * @param array $instance - Passed by reference
	*/
	public function set_defaults( &$instance ){
		
		if( !isset( $instance['title'] ) ) $instance['title'] = '';
		
		if( !isset( $instance['post_type'] ) ) $instance['post_type'] = 'post';
		
		if( !isset( $instance['tax_query'] ) ) $instance['tax_query'] = 'category';
		
		if( !isset( $instance['tax_terms'] ) ) $instance['tax_terms'] = '';
		
		if( !isset( $instance['posts_per_page'] ) ) $instance['posts_per_page'] = 3;
		
		if( !isset( $instance['display'] ) ) $instance['display'] = 'promo';
		
		if( !isset( $instance['feed_type'] ) ) $instance['feed_type'] = 'static';
		
		if( !isset( $instance['insert_urls'] ) ) $instance['insert_urls'] = array();
		
	} // end method set_defaults
	
	public function get_form( $instance, $ipt_name ){
		
		$this->input_name = $ipt_name;
		
		$this->set_defaults( $instance );
		
		include DIR . '/inc/inc-form-insert-items.php';
		
	}
	
	/*
	 * @desc - Gets current field name
	 * @param string $field - Name of current field.
	 * @return string - Full name.
	*/
	public function get_field_name( $field ) {
		
		if ( $this->input_name ) {
			
			return $this->input_name . '[' . $field . ']';
			
		} else {
			
			return $field;
			
		};// end if
		
	} // end method get_field_name
	
	
	public function item_render_site( $post , $instance ){ 
	
	}
	
	public function render_html_email( $pagebuilder_model ){
		$instance = $this->instance;
		
		$this->set_defaults( $instance );
		
		ob_start();
		
		if( $instance['insert_urls'] ) {
			
			//echo '<table style="border-collapse: collapse; border: none;" border="0" >';
		
			foreach( $instance['insert_urls'] as $index => $url ) {
				
				$response = wp_remote_get( $url . '?rest-ext=true' );
				
				if ( $response ){
					
					 $body = wp_remote_retrieve_body(&$response);
					 
					 $post_array = json_decode( $body , true );
					 
					 if( $post_array ){
						 
						 include DIR . '/inc/inc-display-promo-email.php';
						 
					 }; // end if
					
				}; // end if
				
			}; // end foreach
			
			//echo '</table>';
			
		}; // end if
		
		return ob_get_clean();
	
	}
	
};?>