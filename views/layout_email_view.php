<?php namespace cahnrswp\pagebuilder;

class layout_email_view {
	public $controller;
	public $pagebuilder_model;
	
	public function __construct( $controller , $pagebuilder_model ){
		$this->controller = $controller;
		$this->pagebuilder_model = $pagebuilder_model;
	}
	
	public function get_email(){
		if( $this->pagebuilder_model->layout ){
			foreach( $this->pagebuilder_model->layout as $rowid => $row ){
				$layout.= '<table width="'.$this->pagebuilder_model->width.'px"><tr>';
				for( $c = 1; $c <= $row['column_count']; $c++){
					$col_width_ratio = $row['columns']['column-'.$c]['width'];
					$col_width = $col_width_ratio * $this->pagebuilder_model->width;
					$col_css = array();
					if( 'row-100' != $rowid ){
						$col_padding = 30 * $col_width_ratio;
						$col_css[] = 'width:'.$col_width.'px;';
						$col_css[] = 'padding-left: '.$col_padding.'px;';
						$col_css[] = 'padding-right: '.$col_padding.'px;';
					}
					$layout.= '<td width="'.$col_width.'" style="'.implode( ' ', $col_css ).'" valign="top">';
					if( isset( $row['columns']['column-'.$c]['items'] ) ){
						
						foreach( $row['columns']['column-'.$c]['items'] as $itemKey => $item ){
								$item_width = ( isset( $col_padding ) )? 
									( $col_width - ( 2 * $col_padding ) ): 
									$this->pagebuilder_model->width;
								$args['before_widget'] = '<table width="'.$item_width.'" style="width:'.$item_width.'px;">';
								$args['after_widget'] = '</table>';
								if( isset( $item->ID ) ){
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
				$layout.= '</tr><tr><td>&nbsp;</td></tr></table>';
			}
		}
		return $layout;
	}
	
};?>