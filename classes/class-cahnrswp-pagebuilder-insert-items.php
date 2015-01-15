<?php namespace cahnrswp\pagebuilder;

class CAHNRSWP_Pagebuilder_Insert_Items {
	
	private $view;
	
	private $model;
	
	public function __construct( $instance = array() ) {
		
		$this->model = new \stdClass();
		
		$this->model->instance = $instance;
		
		$this->model->input_name = false;
		
		require_once DIR . 'classes/class-cahnrswp-pagebuilder-insert-items-view.php';
		
		$this->view = new CAHNRSWP_Pagebuilder_Insert_Items_View( $this, $this->model  );
		
	} // end method __construct
	
	/*
	 * @desc - Sets the instance property
	 * @param array $instance - New instance array.
	*/
	public function cwp_set_instance( $instance ) {
		
		$this->model->instance = $instance;
		
	} // end cwp_set_instance
	
	/*
	 * @desc - Sets input name property
	 * @param string $input - New input name
	*/
	public function cwp_set_input_name( $input ) {
		
		$this->model->input_name = $input;
		
	} // end method cwp_set_input_name
	
	/*
	 * @desc - Output editor form from view;
	 * @param 
	*/
	public function cwp_editor_form( $input_name = '' ){
		
		$this->view->cwp_output_editor_form( $input_name );
		
	} // end method cwp_editor_form
	
	
	
	
}