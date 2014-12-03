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
		
		if( $this->pagebuilder_model->layout ){
			foreach( $this->pagebuilder_model->layout as $rowid => $row ){
				if( 'row-100' == $rowid && !isset( $row['columns']['column-1']['items'] ) ) continue;

				$layout.= '<table id="'.$rowid.'" class="row '.$row['layout'].' ' . $row['class'] . '" border="0" cellpadding="0" cellspacing="0" style="border-collapse:collapse" align="center" ><tr>';
				for( $c = 1; $c <= $row['column_count']; $c++){
					$layout.= '<td id="'.$rowid.'-column-'.$c.'" class="column column-'.$c.'" valign="top">';
					if( isset( $row['columns']['column-'.$c]['items'] ) ){
						
						foreach( $row['columns']['column-'.$c]['items'] as $itemKey => $item ){
							$item_id = ( isset( $item->ID ) )? $item->ID : $item->id;
								$args['before_widget'] = '<table cellpadding="0" cellspacing="0" class="item '.$item_id.'" border="0" style="border-collapse:collapse" >';
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