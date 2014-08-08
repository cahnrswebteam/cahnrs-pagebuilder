<?php namespace cahnrswp\pagebuilder;

class site_view {
	public $meta_base = '_pagebuilder';
	public $content_base = '_pagebuilder_editors';
	
	public function get_site_view( $post , $layout_obj, $layout_model ){
		/************************************************
		** START LAYOUT **
		*************************************************/?>
    	<section class="pagebuilder-layout" >
        <?php foreach( $layout_obj as $row ):?>
        <?php 
			/** TO DO: CONSOLIDATE THE COLUMN COUNT AND COULUMN STYLES INTO ONE ARRAY - DB **/
			$column_count = $layout_model->get_columns_by_layout( $row['layout'] ); // GET COLUMN COUNT FOR NOW
			/*************************************
			** If the row is a two column with an empty right column then render as one column aka "pagbuilder-layout-aside-empty" **
			**************************************/
			$row['layout'] =( !isset( $row['columns']['column-2'] ) && 'pagbuilder-layout-aside' == $row['layout'] )? 
				$row['layout'].'-empty' : $row['layout'];
        	if( isset( $row['columns'] ) ):?>
				<?php $empty_aside = ( isset( $row['columns']['column-2'] ))? '' : 'empty-aside'; ?>
                <div id="<?php echo $row['id'];?>" class="pagebuilder-row <?php echo $row['id'].' '.$row['layout'].' '.$empty_aside;?>" >
                    <?php for( $i = 1; $i <= $column_count; $i++ ):
						if( 'pagbuilder-layout-aside' == $row['layout'] ){
							if( 1 == $i ) $c = 2;
							if( 2 == $i ) $c = 1;
						} else {
							$c = $i;
						}
						$column_id = 'column-'.$c;
						$column = ( isset( $row['columns'][$column_id]) )? $row['columns'][$column_id] : array();
						$column_style = $layout_model->layout_styles[ $row['layout'] ][ $column_id ];
                        ?><div id="<?php echo $row['id'].'-column-'.$c;?>" class="pagebuilder-column pagebuilder-column-<?php echo $c;?>" style="<?php echo $column_style;?>">
                        <?php if( $column['items']){
                        	foreach( $column['items'] as $item_key => $item ){
								$tag = ( $item['settings']['is_content'] )? 'article' : 'aside';
								$tag = ( 'page_content' == $item['id'] || 'content_block' == $item['id'] )? 'article' : $tag;
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
        	<?php endif;?>
        <?php endforeach;?>
        </section>
        <?php
	}
	
	public function get_email_view( $post , $layout_obj, $layout_model ){
		/************************************************
		** START LAYOUT **
		*************************************************/
		$email_width = 700;?>
        <table align="center" border="0" cellpadding="0" cellspacing="0" width="<?php echo $email_width;?>" style="border-collapse: collapse;">
            <tr>
                <td>
                	<center>&nbsp;<br />
                    <?php if( is_user_logged_in() ):?><a href="#" style="font-size: 10px;">View in Browser</a> | <a href="#" style="font-size: 10px;">Visit Website</a><?php endif;?>
                    <br />&nbsp;</center>
                </td>
            </tr>
        </table>
        <table align="center" border="0" cellpadding="0" cellspacing="0" width="<?php echo $email_width;?>" style="border-collapse: collapse;">
        	<?php foreach( $layout_obj as $row ):?>
            	<?php if( 'row-100' == $row['id'] ){
					$row_style = ' style="padding-top: 0px; padding-bottom: 0px; padding-left: 0px; padding-right: 0px;"';
				} else if( 'row-200' == $row['id'] ) {
					$row_style = 'bgcolor="#dddddd" style="padding-top: 0px; padding-bottom: 0px; padding-left: 0px; padding-right: 0px;"';
				} else {
					$row_style = 'style="padding-top: 0px; padding-bottom: 0px; padding-left: 0px; padding-right: 0px;"';
				}//if( isset( $row['columns'] ) ):?>
                <tr >
                    <td <?php echo $row_style;?>>
                    <?php if( isset( $row['columns'] ) ):?>
                    	<table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" style="border-collapse: collapse;">
                        	<tr>
                            <?php $column_count = $layout_model->get_columns_by_layout( $row['layout'] );
							$adj_width = $email_width;
                            for( $i = 1; $i <= $column_count; $i++ ){
								$c_style = '';
								$c_id = 'column-'.$i;
								$c_width = round( $adj_width * $layout_model->email_column_widths[ $row['layout'] ][ $c_id ] );
								if( 'pagbuilder-layout-aside' == $row['layout'] ){
									if( !isset( $row['columns']['column-2'] ) ) $c_width = $adj_width;
									if( 'column-2' == $c_id ) $c_style .= ' bgcolor="#eeeeee"';
								}
								$c_style .= ' width="'.$c_width.'"';
								$c_style .= ' align="center" valign="top"';
								if( isset( $row['columns'][ $c_id ] ) ){?>
									<td <?php echo $c_style;?>>
                                    <?php if( 'row-100' != $row['id'] ) echo' &nbsp;<br />';?>
                                    
                                    
                                    
                                    
                                    
                                    <?php if( $row['columns'][ $c_id ]['items']){
										foreach( $row['columns'][ $c_id ]['items'] as $item_key => $item ){
											$item['email-width'] = $c_width - 40;
											//$tag = ( $item['settings']['is_content'] )? 'article' : 'aside';
											//$tag = ( 'page_content' == $item['id'] || 'content_block' == $item['id'] )? 'article' : $tag;
											//$title = $this->get_title( $item );
											$args = array();
											$args['before_widget'] = $this->get_item_email_wrapper( 'before' , $item, $item_key );
											$args['after_widget'] = $this->get_item_email_wrapper();
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
                                    
                                        
                                        
                                        
                                        <?php if( 'row-100' != $row['id'] ) echo '<br />&nbsp;';?>
                    				</td>
								<?php }
							};?> 
                    		</tr>
                    	</table>
                    <?php endif;?>
                    </td>
                </tr>
            <?php endforeach;?>
            	<tr>
                	<td>
                    &nbsp;<br />&nbsp;
            		</td>
                </tr>
        </table>
        <?php
	}
	
	
	private function get_title( $item_instance ){
		if( $item_instance['settings']['title_tag'] && $item_instance['settings']['title'] ){
			$tag = $item_instance['settings']['title_tag'];
			$title = $item_instance['settings']['title'];
			return '<'.$tag.'>'.$title.'</'.$tag.'>';
		} else {
			return '';
		}
	}
	
	private function get_item_wrapper( $tag , $position = 'after' , $item = array(), $item_key = '' ){
		switch( $position ){
			case 'before':
				$title = $this->get_title( $item );
				$wrapper = '<'.$tag.' id="'.$item_key.'" class="widget_'.$item['id'].' '.$item['settings']['css_hook'].'"><div class="item-inner-wrapper" >'.$title;
				break;
			default:
				$wrapper = '<div style="clear:both"></div></div></'.$tag.'>';
				break;
		}
		return $wrapper;
	}
	
	private function get_item_email_wrapper($position = 'after' , $item = array(), $item_key = '' ){
		switch( $position ){
			case 'before':
				//$title = $this->get_title( $item );
				$wrapper = '<table width="'.$item['email-width'].'" border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse;"><tr><td>';
				break;
			default:
				$wrapper = '</td></tr></table>';
				break;
		}
		return $wrapper;
	}
};?>