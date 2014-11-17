<?php namespace cahnrswp\pagebuilder;

/**
* Plugin Name: CAHNRS Page Builder
* Plugin URI: http://cahnrs.wsu.edu/communications
* Description: Builds Custom Layouts For Pages/Posts
* Version: 1.5
* Author: CAHNRS Communication, Danial Bleile, Phil Cabel
* Author URI: http://URI_Of_The_Plugin_Author
* License: GPL2
*/

class cahnrs_pagebuilder{
	private $pagebuilder_view;
	private $pagebuilder_model;
	public $pagebuilder_controller;
	
	public function __construct(){
		$this->pagebuilder_model = new pagebuilder_model;
		$this->pagebuilder_controller = new pagebuilder_control( $this->pagebuilder_model );
		$this->pagebuilder_view = new pagebuilder_view();
		
		\add_action( 'customize_register', array( $this->pagebuilder_view, 'add_custom_settings' ) );
		$this->init_autoload(); // ACTIVATE CUSTOM AUTOLOADER FOR CLASSES
		$this->define_constants(); // YEP, THAT'S WHAT IT DOES
		
		//$init_layout_tab = new layout_control();
		//$init_layout_tab->init();
		
		//$init_save = new save_control();
	}
	
	public function init(){
		if ( is_admin() ) { 
			add_action( 'load-post.php', array( $this , 'init_admin_post' ) );
			add_action( 'load-post-new.php', array( $this , 'init_admin_post' ) );
			$settings = new settings_control();
			add_action( 'admin_init', array( $settings ,'register_settings' ) );
		}
		if( isset( $_GET['cahnrs-pagebuilder'] ) ){
			$ajax_control = new ajax_page_control();
			$ajax_control->init();
		}
		
		$manage_items = new item_control();
		$manage_items->init();
		
		$render_site = new render_site_control();
		$render_site->init();
	}
	
	public function init_admin_post(){
		$metabox = new metabox_control();
		$metabox->init();
	}
	
	private function init_autoload(){
		require_once 'controls/autoload_control.php'; //REQUIRE AUTOLOADER CONTROL - MAKES IT MORE PORTABLE
		$autoload = new autoload_contol(); // INIT AUTOLOADER SO WE DON'T HAVE TO USE REQUIRE ANY MORE
	}
	
	private function define_constants(){
		define( __NAMESPACE__.'\URL' , plugins_url( 'cahnrs-pagebuilder' ) ); // PLUGIN BASE URL
		define( __NAMESPACE__.'\DIR' , plugin_dir_path( __FILE__ ) ); // DIRECTORY PATH
	}
	
}
class pagebuilder_model {
	
	public function set_options(){
	}
}

class pagebuilder_control{
	private $pagebuilder_model;
	
	public function __construct( $pagebuilder_model ){
		$this->pagebuilder_model = $pagebuilder_model;
	}
	
	public function set_options(){
		$this->pagebuilder_model->set_options();
	}
}

class pagebuilder_view {
	public function add_custom_settings( $wp_customize ){
		$wp_customize->add_setting( 'cahnrs_pagebuilder_show_tertiary' , array(
			'default'     => '',
			'transport'   => 'refresh',
		) );
		$wp_customize->add_setting( 'cahnrs_pagebuilder_tn_show_alltime' , array(
			'default'     => '',
			'transport'   => 'refresh',
		) );
		$wp_customize->add_setting( 'cahnrs_pagebuilder_tn_show_homepage' , array(
			'default'     => '0',
			'transport'   => 'refresh',
		) );
		$wp_customize->add_section( 'cahnrs_pagebuilder' , array(
			'title'      => __( 'CAHNRS Pagebuilder' ),
			'priority'   => 99,
			) );
		$wp_customize->add_control(
			'pagebuilder_display_nav_control', 
			array(
				'label'    => __( 'Tertiary Nav' ),
				'section'  => 'cahnrs_pagebuilder',
				'settings' => 'cahnrs_pagebuilder_show_tertiary',
				'type'     => 'select',
				'choices'  => array(
					'0'  => 'Do Not Display',
					'1' => 'Top Level',
					'2' => 'Sub Pages Only'
				),
			)
		);
		$wp_customize->add_control(
			'pagebuilder_tn_show_all', 
			array(
				'label'    => __( 'Tertiary Nav: Always Display' ),
				'section'  => 'cahnrs_pagebuilder',
				'settings' => 'cahnrs_pagebuilder_tn_show_alltime',
				'type'     => 'checkbox',
			)
		);
		$wp_customize->add_control(
			'pagebuilder_tn_show_homepage_control', 
			array(
				'label'    => __( 'Tertiary Nav: Exclude Homepage' ),
				'section'  => 'cahnrs_pagebuilder',
				'settings' => 'cahnrs_pagebuilder_tn_show_homepage',
				'type'     => 'checkbox',
			)
		);
	}
}

$cahnrs_pabebuilder = new cahnrs_pagebuilder();
$cahnrs_pabebuilder->init();
?>