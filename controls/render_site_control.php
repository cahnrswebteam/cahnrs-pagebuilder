<?php namespace cahnrswp\pagebuilder;

class render_site_control {
	
	public $layout_model;
	public $site_view;
	
	public function __construct(){
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
			$template = DIR.'html-email-themes/html_email.php';
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
		
		$this->layout_model = new layout_model( $post ); // init layout model with post object
		
		
		$layout_obj = $this->layout_model->get_layout_obj( $post ); // Legacy - get rid of this soon
		
		ob_start(); // It'll buff out
		
		/*************************************
		** Start tertiary nav before **
		*************************************/
		if( $this->layout_model->tertiary_nav && 'before' ==  $this->layout_model->tertiary_position ){
			$tertiary_nav = new tertiary_nav_view( $this , $this->layout_model ); // Get nav view
			$tertiary_nav->get_nav( array() );
		}

		$this->site_view->get_site_view( $post , $layout_obj , $this->layout_model ); // Render View
		
		/*************************************
		** Start tertiary nav after **
		*************************************/
		if( $this->layout_model->tertiary_nav && 'after' ==  $this->layout_model->tertiary_position ){
			$tertiary_nav = new tertiary_nav_view( $this , $this->layout_model ); // Get nav view
			$tertiary_nav->get_nav( array() );
		}
		
		return ob_get_clean(); // Return content
	}
	
	public function render_email( $content , $post ){
		$item_view = new item_view();
		$pagebuilder_model = new pagebuilder_model( $content , $post );
		//$item_view->replace_email_items( $pagebuilder_model );
		$email_view = new layout_email_view( $this , $pagebuilder_model );
		return $email_view->get_email();
	}
	
	public function add_scripts(){
		\wp_register_style( 'pagebuilder_css', URL . '/css/pagebuilder.css', false, '1.6.0' );
		\wp_enqueue_style( 'pagebuilder_css' );
		// Preferably enqueue this conditionally
		\wp_enqueue_script( 'tertiary-nav', URL . '/js/tertiary-nav.js', array( 'jquery' ), '1.8.0' );
	}
	
}
?>