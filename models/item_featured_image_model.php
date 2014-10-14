<?php namespace cahnrswp\pagebuilder;

class item_featured_image_model {
	
	public $id = 'featured_image';
	public $name = 'Featured Image';
	public $description = 'If a featured image is set, displays the featured image.';
	public $subtype = 'page_item';
	public $instance;
	
	public function __construct( $instance = array() ){
		$this->instance = $instance;
	}
	
	public function get_form( $instance, $ipt_name ){
		$vals = array();
		$vals['full'] = 'Full Size';
		$image_sizes = \get_intermediate_image_sizes();
		foreach ( $image_sizes as $size_name ){
			$vals[ $size_name ] = $size_name;
		}
		echo '<p>'; 
		echo '<label>Image Size: </label>';
		echo '<select name="'.$ipt_name.'[image_size]" >';
			$size = ( isset( $instance['image_size'] ) )? $instance['image_size'] : 'large';
			foreach( $vals as $id => $title ){
				echo '<option value="'.$id.'" '.selected( $id, $size , false ).'>'.$title.'</option>';
			}
			echo '</select>';
		echo '</p>';
	}
	
	public function render_site( $post ){
		if( has_post_thumbnail( $post->ID ) ){
			the_post_thumbnail('large');
		} else {
			echo 'No featured image set';
		}
		
	}
	
	public function item_render_site( $post , $instance ){
		if( has_post_thumbnail( $post->ID ) ){
			$size = ( 'email' == $post->post_type )? 'email-700' : 'large';
			if( isset( $instance['image_size'] ) ) $size = $instance['image_size'];
			echo '<div class="featured_image column-item">';
				echo get_the_post_thumbnail( $post->ID, $size );
			echo '</div>';
		}
	}
	
	public function render_html_email( $pagebuilder_model ){
		$post = $pagebuilder_model->post;
		if( has_post_thumbnail( $post->ID ) ){
			$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' );
			$image = '<img src="'.$image[0].'" width="700" style="width: 700px; height: auto; max-width: 100%;" />';
			return '<tr><td>'.$image.'</td></tr>';
		}
		return '<tr><td></td></tr>';
	}
	
};?>