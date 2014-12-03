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
		echo '<p>';
		echo '<input style="display: none;" type="checkbox" name="'.$ipt_name.'[image_position]" value="0" checked="checked" />'; 
		echo '<input type="checkbox" name="'.$ipt_name.'[image_position]" value="1" '.checked( 1 , $instance['image_position'] , false ) .' />';
		echo '<label> As Background Image</label>';
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
			$size = 'large';
			if( isset( $instance['image_size'] ) ) $size = $instance['image_size'];
			if( isset( $instance['image_position'] ) && $instance['image_position'] ){
				$banner_img_url = wp_get_attachment_image_src( get_post_thumbnail_id( $this->header_model->post->ID ), $size );
        		$banner_img_url = $banner_img_url[0];
				echo '<div class="featured-image column-item" style="background-image:url('.$banner_img_url.')"></div>';
			} else {
				echo get_the_post_thumbnail( $post->ID, $size );
			}
		}
	}
	
	public function render_html_email( $pagebuilder_model , $instance = array() ){
		$post = $pagebuilder_model->post;
		if( has_post_thumbnail( $post->ID ) ){
			$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' );
			$image = '<img class="featured-image" src="'.$image[0].'" style="display: block;" />';
			return '<tr><td style="width: 100%;">'.$image.'</td></tr>';
		}
		return '<tr><td></td></tr>';
	}
	
};?>