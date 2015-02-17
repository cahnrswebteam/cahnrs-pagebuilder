<?php namespace cahnrswp\pagebuilder;

$layout_model = new layout_model();
$metabox_view = new metabox_view();

$row = array();
$row['id'] = ( isset( $_GET['i'] ))? 'row-'.$_GET['i'] : 'row-'.rand(10,100);

if( isset( $_GET['url'] ) &&  $_GET['url'] ) {
	
	$url = sanitize_text_field( $_GET['url'] );
	
	$row['name'] = 'Existing Content: ' . $url;
	
	$row['url'] = $url;
	
	$urlid = url_to_postid( $url ); // returns 0 on failure
	
	$row['urlid'] = $urlid;
	
	if( isset( $_GET['import-title'] ) && is_int( $_GET['import-title'] ) ){
		
		$row['import_title'] = $_GET['import-title'];
		
	}
	
	
} else if ( isset( $_GET['n'] ) ) {
	
	$row['name'] = sanitize_text_field( $_GET['n'] );
	
} else {
	
	$row['name'] = 'Content Row '. $row['id'];
	
}// end if $_GET['url']

$row['class'] = ( isset( $_GET['c'] ))? urldecode( $_GET['c'] ) : '';
$row['layout'] = ( isset( $_GET['l'] ))? urldecode( $_GET['l'] ) : '';

$layout_obj = array( $row );


$metabox_view->render_layout_editor_row( false , $row, $layout_obj );


//$layout_control = new layout_control();
//$item = $layout_control->get_item_object( $item_array );
//include DIR.'views/editor_item_include_view.phtml';?>