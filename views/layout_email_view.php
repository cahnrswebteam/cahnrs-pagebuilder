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
					$layout.= '<td>';
					if( isset( $row['columns']['column-'.$c]['items'] ) ){
						
						foreach( $row['columns']['column-'.$c]['items'] as $itemKey => $item ){
								$args['before_widget'] = '<table>';
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
				$layout.= '</tr></table>';
			}
		}
		return $layout;
	}
	
};?>