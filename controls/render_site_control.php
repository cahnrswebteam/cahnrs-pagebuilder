<?php namespace cahnrswp\pagebuilder;

class render_site_control {
	
	public $layout_model;
	public $site_view;
	
	public function __construct(){
		//$this->layout_model = new updated_layout_model();
		$this->layout_model = new layout_model();
		$this->site_view = new site_view();
	}
	
	public function init(){
		
		 \add_filter( 'the_content', array( $this , 'render_builder' ), 15 ); 
		 
		 \add_action( 'wp_enqueue_scripts', array( $this , 'add_scripts' ) );
		 
		 \add_filter('template_include', array( $this , 'get_email_template' ), 1, 1);
	}
	
	public function get_email_template( $template ){
		global $post;
		if( 'html_email' == $post->post_type ){
			$template = DIR.'templates/html_email.php';
		}
		return $template;
	}
	
	public function render_builder( $content ){
		global $post; // WP Post object
		if ( ( is_singular('post') || is_singular('page') || is_singular('html_email') ) /*&& is_main_query()*/ ) {
			global $in_loop; 
			global $force_builder;
			if( $in_loop ) return $content;
			$in_loop = true;
			if( 'html_email' == $post->post_type ){ 
				$content = $this->render_email( $content , $post );
			} else {
				$content = $this->render_site( $content , $post );
			}
			$in_loop = false;
			return $content;
		}
		return '<div class="pagebuilder-item">'.$content.'</div>';
	}
	
	public function render_site( $content , $post ) {
		$layout_obj = $this->layout_model->get_layout_obj( $post );
		ob_start();
		$this->site_view->get_site_view( $post , $layout_obj , $this->layout_model );
		$this->add_tertiary_nav( $post , $layout_obj , $this->layout_model );
		return ob_get_clean();
	}
	
	public function render_email( $content , $post ){
		$item_view = new item_view();
		$pagebuilder_model = new pagebuilder_model( $content , $post );
		//$item_view->replace_email_items( $pagebuilder_model );
		$email_view = new layout_email_view( $this , $pagebuilder_model );
		return $email_view->get_email();
	}
	
	private function add_tertiary_nav( $post , $layout_obj , $layout_model ){
		/************************************************
		** Add third level nav to layout **
		*************************************************/
		if ( $layout_obj['tertiary_nav'] ) {
			echo '<nav id="pagebuilder-tertiary-nav" role="navigation">';
			echo '<ul>';
			$is_active = false;
			$i = 0;
			foreach ( $layout_obj['tertiary_nav'] as $menu_item ){
				if( $menu_item->object_id == $post->ID ) $is_active = $post->ID;
			}
			foreach ( $layout_obj['tertiary_nav'] as $menu_item ) {
				if( $is_active ){
					$active = (  $is_active == $menu_item->object_id  )? 'selected' : '';
				} 
				else {
					$active = (  0 == $i )? 'selected' : '';
				}
				$dynamic = ( $menu_item->type == 'post_type' )? 'is-dynamic' : '';
				echo '<li class="' . $active . '"><a class="'.$dynamic.'" href="' . $menu_item->url . '" data-index="'.$i.'">' . $menu_item->title . '</a></li>';
				$i++;
			}
			echo '</ul>';
			echo '</nav>';
			$i = 0;
			foreach ( $layout_obj['tertiary_nav'] as $menu_item ) {
				if( $is_active ){
					$active = (  $is_active == $menu_item->object_id  )? 'selected' : 'inactive';
				} 
				else {
					$active = (  0 == $i )? 'selected' : '';
				}
				if( $menu_item->type == 'post_type' ){
					echo '<div class="pagebuilder-tertiary-page tertiary-'.$i.' '.$active.'" >';
					$post = get_post( $menu_item->object_id );
					$lay_obj = $this->layout_model->get_layout_obj( $post );
					$this->site_view->get_site_view( $post , $lay_obj , $layout_model );
					echo '</div>';
				}
				$i++;
			}
		}
		//$this->get_third_level_nav( $post );
	}
	
	public function add_scripts(){
		\wp_register_style( 'pagebuilder_css', URL . '/css/pagebuilder.css', false, '1.6.0' );
		\wp_enqueue_style( 'pagebuilder_css' );
		// Preferably enqueue this conditionally
		\wp_enqueue_script( 'tertiary-nav', URL . '/js/tertiary-nav.js', array( 'jquery' ), '1.8.0' );
	}
	
}
?>