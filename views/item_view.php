<?php namespace cahnrswp\pagebuilder;

class item_view {
	
	public function replace_email_items( &$pagebuilder_model ){
		if( $pagebuilder_model->layout ){
			foreach( $pagebuilder_model->layout as $rowid => &$row ){
				for( $c = 0; $c < $row['column_count']; $c++){
					if( isset( $row['columns'][$c]['items'] ) ){
						foreach( $row['columns'][$c]['items'] as $itemKey => &$item ){
							//$item = print_r( $item , true );
							/*$args['before_widget'] = '<table>';
							$args['after_widget'] = '</table>';
							switch( $item['type'] ){
								case 'native' :
									echo $args['before_widget'];
									//$item_obj = $layout_model->get_item_object( $item );
									//$item_obj->item_render_site( $post , $item );
									echo $args['after_widget'];
									break;
								case 'widget' :
									\the_widget( $item['id'] , $item['settings'], $args );
									break;
							};*/
							
							
							
							
							
						}
					}
				}
			}
		}
	}
	
};?>