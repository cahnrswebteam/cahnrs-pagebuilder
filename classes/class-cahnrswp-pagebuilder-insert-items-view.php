<?php namespace cahnrswp\pagebuilder;

class CAHNRSWP_Pagebuilder_Insert_Items_View {
	
	private $controller;
	
	private $model;	

	/*
	 * @desc - Sets controller and model for the view
	 * @param object $controller
	 * @param array $model
	*/
	public function __construct( $controller , $model ) {
		
		$this->controller = $controller;
		
		$this->model = $model;
		
	} // end method __construct
	
	/*
	 * @desc - Outputs the editro form
	*/
	public function cwp_output_editor_form(){
		
		include DIR . '/inc/inc-form-insert-items.php'; 
		
	} // end method cwp_output_editor_form
	
	public function get_field_name( $field ) {
		
		if ( method_exists( $controller , 'get_field_name' ) {
			
			return
		}
		
	} // end method get_field_name
}