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
		/*if( has_post_thumbnail( $post->ID ) ){
			$size = 'large';
			if( isset( $instance['image_size'] ) ) $size = $instance['image_size'];
			if( isset( $instance['image_position'] ) && $instance['image_position'] ){
				$banner_img_url = wp_get_attachment_image_src( get_post_thumbnail_id( $this->header_model->post->ID ), $size );
        		$banner_img_url = $banner_img_url[0];
				echo '<div class="featured-image column-item" style="background-image:url('.$banner_img_url.')"></div>';
			} else {
				echo get_the_post_thumbnail( $post->ID, $size );
			}
		}*/
	}
	
	public function render_html_email( $pagebuilder_model ){
		/*$post = $pagebuilder_model->post;
		if( has_post_thumbnail( $post->ID ) ){
			$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' );
			$image = '<img class="featured-image" src="'.$image[0].'" style="display: block;" />';
			return '<tr><td style="width: 100%;">'.$image.'</td></tr>';
		}
		return '<tr><td></td></tr>';*/
	}
	
};?>