<?php namespace cahnrswp\pagebuilder; ?>
<div id="<?php echo $row['id']; ?>" class="<?php echo $row_class; ?>">
	<?php if( isset( $row['bgimage'] ) && $row['bgimage'] ):?>
		<?php $image = wp_get_attachment_image_src( $row['bgimage'], 'full' );?> 
        	<div class="pagebuilder-row-background<?php if( isset( $row['bgfull'] ) && $row['bgfull'] ) echo ' unbound recto verso';?>" style="background-image: url(<?php echo $image[0];?>);">
            </div>
    <?php endif;?>
                    <?php if( isset( $row['category'] )) echo '<a name="'.$row['category'].'" ></a>';?>
                    <?php if( isset( $row['titletag'] ) && $row['titletag'] ):
						$id = ( isset( $row['category'] ) && $row['category'] )? 'section-'.$row['category'] : '';?>
                    	<?php echo '<'. $row['titletag'].' id="'.$id.'">'.$row['name'].'</'. $row['titletag'].'>';?>
                    <?php endif;?>
                
       
                    <?php for( $i = 1; $i <= $column_count; $i++ ):
						//if( 'pagbuilder-layout-aside' == $row['layout'] ){
							///if( 1 == $i ) $c = 2;
							//if( 2 == $i ) $c = 1;
						//} else {
							$c = $i;
						//}
						$column_id = 'column-'.$c;
						$column = ( isset( $row['columns'][$column_id]) )? $row['columns'][$column_id] : array();
						$column_style = $layout_model->layout_styles[ $row['layout'] ][ $column_id ];
                        ?><div id="<?php echo $row['id'].'-column-'.$c;?>" class="pagebuilder-column pagebuilder-column-<?php echo $c;?>" style="<?php echo $column_style;?>">
                        <?php if( $column['items']){
                        	foreach( $column['items'] as $item_key => $item ){
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
								$args['before_widget'] = $this->get_item_wrapper( $tag , 'before' , $item, $item_key );
								$args['after_widget'] = $this->get_item_wrapper( $tag );
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
                        };?>
                        </div><?php 
					endfor;?>
                </div>