<?php namespace cahnrswp\pagebuilder;

class item_insert_site_section_model {
	
	public $id = 'insert_site_section';
	public $name = 'Insert Section';
	public $description = 'Insert Content Another Page.';
	public $subtype = 'page_item';
	public $instance;
	
	public function __construct( $instance = array() ){
		$this->instance = $instance;
	}
	
	public function get_form($instance, $ipt_name){
		$instance['url'] = ( isset( $instance['url'] ) )? $instance['url'] : '';
		$instance['row'] = ( isset( $instance['row'] ) )? $instance['row'] : false;
		$instance['column'] = ( isset( $instance['column'] ) )? $instance['column'] : false;
		echo '<label>URL: </label>';
		echo '<input type="text" name="'.$ipt_name.'[url]" value="'.$instance['url'].'">';
		echo '<label>Row Name: </label>';
		echo '<input type="text" name="'.$ipt_name.'[row]" value="'.$instance['row'].'">';
		echo '<label>Column: </label>';
		echo '<select name="'.$ipt_name.'[column]">';
			echo '<option value=1 '. selected( $instance['column'] , 1 , false ) .'>1</option>';
			echo '<option value=2 '. selected( $instance['column'] , 2 , false ) .'>2</option>';
			echo '<option value=3 '. selected( $instance['column'] , 3 , false ) .'>3</option>';
			echo '<option value=4 '. selected( $instance['column'] , 4 , false ) .'>4</option>';
		echo '</select>';
	}
	
	public function item_render_site( $post , $instance ){
		
		$render_items = array();
		
		$instance['row'] = ( isset( $instance['row'] ) )? $instance['row'] : false;
		
		$instance['column'] = ( isset( $instance['column'] ) )? $instance['column'] : false;
		
		if( isset( $instance['url'] ) ){
			
			$post_id = url_to_postid( $instance['url'] );
			
			if( $post_id ) {
				
				$post = get_post( $post_id );
				
				if( $post ){
					
					
					$site_view = new site_view();
					
					$layout_model = new layout_model( $post ); // init layout model with post object
					
					$layout_obj = $layout_model->get_layout_obj( $post ); // Legacy - get rid of this soon
					
					foreach( $layout_obj as $row_id => $row ){
						
						if( $instance['row'] && $instance['row'] == $row['name'] ){
							
							if( $instance['column'] && isset( $row['columns']['column-'.$instance['column'] ]['items'] ) ) {
								
								$items = $row['columns']['column-'.$instance['column'] ]['items'];
								
								if( is_array( $items ) ){
									
									foreach( $items as $item_key => $item ){
										
										$render_items[ $item_key ] = $item;
										
									} // end foreach
									
								} // end if is_array
								
							} // end if $instance['column']
							
						} // end if $instance['row']
						
					} // end foreach
					
				} // end if $post 
				
			} // end if $post_id
			
		} // end if $instance['url']
		
		foreach( $render_items as $item_key => $item ) {
			
			$is_content = ( isset( $item['settings']['is_content'] ) )? $item['settings']['is_content'] : false;
			if( 'insert_site_section' == $item['id'] ) {
				$tag = false;
			} else if( $is_content || 'page_content' == $item['id'] || 'content_block' == $item['id'] ){
				$tag = 'div';
			} else {
				$tag = 'aside';
			}
			//$tag = ( $item['settings']['is_content'] )? 'div' : 'aside';
			//$tag = ( 'page_content' == $item['id'] || 'content_block' == $item['id'] )? 'article' : $tag;
			//$title = $this->get_title( $item );
			$args = array();
			$args['before_widget'] = $site_view->get_item_wrapper( $tag , 'before' , $item, $item_key );
			$args['after_widget'] = $site_view->get_item_wrapper( $tag );
			switch( $item['type'] ){
				case 'native' :
					echo $args['before_widget'];
					$item_obj = $layout_model->get_item_object( $item );
					$item_obj->item_render_site( $post , $item );
					echo $args['after_widget'];
					break;
				case 'widget' :
					\the_widget( $item['id'] , $item['settings'], $args );
					break;
			};
			
		}
	}
	
	public function render_html_email( $pagebuilder_model ){
		$content = explode( '<!-- PRIMARY CONTENT -->' , $pagebuilder_model->content );
		$content = ( count( $content ) > 1 )? $content[1] : implode( $content );
		return '<tr><td>'.$content.'</td></tr><tr><td>&nbsp;</td></tr>';
	}
	
};?>