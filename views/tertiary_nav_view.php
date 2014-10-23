<?php namespace cahnrswp\pagebuilder;

class tertiary_nav_view {
	private $controller;
	private $layout_model;
	public $nav;
	
	public function __construct( $controller, $layout_model ){
		$this->controller = $controller;
		$this->layout_model = $layout_model;
	}
	
	public function get_nav( $args = array() ) {
		$nav = '<nav id="pagebuilder-tertiary-nav" role="navigation">';
		$nav .= $this->render_nav( $args );
		/*$nav .= $this->render_pages( $args );*/
		$nav .= '</nav>';
		if( isset( $args['echo'] ) && !$args['echo'] ){
			return $nav;
		} else {
			echo $nav;
		}
	}
	
	public function render_nav( $args ){
		$nav = '<ul>';
		foreach ( $this->layout_model->tertiary_nav as $menu_item ) {
			$active = ( $menu_item->object_id == $this->layout_model->post->ID )? 'selected':'';
			$nav .= '<li class="' . $active . '"><a class="" href="' . $menu_item->url . '">' . $menu_item->title . '</a></li>';
		};
		
		$nav .= '</ul>';
		return $nav;
	}
	
	public function render_pages( $args ){
		$i = 0;
		foreach ( $this->layout_model->tertiary_nav as $menu_item ) {
			if( $is_active ){
				$active = (  $is_active == $menu_item->object_id  )? 'selected' : 'inactive';
			} 
			else {
				$active = (  0 == $i )? 'selected' : '';
			}
			if( $menu_item->type == 'post_type' ){
				$nav .= '<div class="pagebuilder-tertiary-page tertiary-'.$i.' '.$active.'" >';
				$post = get_post( $menu_item->object_id );
				$layout_model = new layout_model( $post );
				$layout_model->tertiary_nav = false;
				$lay_obj = $layout_model->get_layout_obj( $post );
				$site_view = new site_view;
				ob_start();
				$site_view->get_site_view( $post , $lay_obj , $layout_model );
				$nav .= ob_get_clean();
				//$this->get_site_view( $post , $lay_obj , $layout_model, array( 'tertirary-nav' => false ) );
				$nav .= '</div>'; 
			}
			$i++;
		}
		return $nav;
	}
	
	
	
	
}?>