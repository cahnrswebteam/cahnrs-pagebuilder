<?php namespace cahnrswp\pagebuilder;

class layout_email_view {
	public $controller;
	public $pagebuilder_model;
	
	public function __construct( $controller , $pagebuilder_model ){
		$this->controller = $controller;
		$this->pagebuilder_model = $pagebuilder_model;
	}
	
	public function get_email(){
		global $email_styles;
		$layout_width = ( isset( $email_styles['layout-width'] ) )? $email_styles['layout-width'] : $this->pagebuilder_model->width;
		$row_bg = ( isset( $email_styles['content-row']['bgcolor'] ) )? $email_styles['content-row']['bgcolor'] : '';
		if( $this->pagebuilder_model->layout ){
			foreach( $this->pagebuilder_model->layout as $rowid => $row ){
				$bg_color = ( 'row-100' !== $rowid )? $row_bg : ''; 
				$layout.= '<table bgcolor="'.$bg_color.'" style="border-collapse: collapse;" align="center" cellpadding="0" cellspacing="0" width="'.$layout_width.'" id="'.$rowid.'" class="row" ><tr>';
				for( $c = 1; $c <= $row['column_count']; $c++){
					$col_width_ratio = $row['columns']['column-'.$c]['width'];
					$col_css = array();
					if( 'row-100' != $rowid ){
						$col_css[] = 'width:'.( 100 * $col_width_ratio ).'%;';
					}
					$layout.= '<td id="'.$rowid.'-column-'.$c.'" class="column" style="'.implode( ' ', $col_css ).'" valign="top"><br />&nbsp;<br />';
					if( isset( $row['columns']['column-'.$c]['items'] ) ){
						
						foreach( $row['columns']['column-'.$c]['items'] as $itemKey => $item ){
							$item_id = ( isset( $item->ID ) )? $item->ID : $item->id;
								$args['before_widget'] = '<table cellpadding="0" cellspacing="0" style="border-collapse: collapse;" class="item '.$item_id.'">';
								$args['after_widget'] = '</table>';
								if( isset( $item->ID ) ){
									ob_start();
									\the_widget( $item->ID , $item->settings , $args );
									$layout.= ob_get_clean();
								} 
								else if( is_object( $item ) ) {
									if( method_exists( $item , 'render_html_email' ) ){
										$layout.= $args['before_widget'];
										$layout.= $item->render_html_email( $this->pagebuilder_model );
										$layout.= $args['after_widget'];
									}
								} else {
									
								}
						}
					}
					$layout.= '</td>';
				}
				$layout.= '</tr></table>';
			}
		}
		return $layout;
	}
	
};?>