<?php namespace cahnrswp\pagebuilder;

class item_page_title_model {
	
	public $id = 'page_title';
	public $name = 'Post/Page Title';
	public $description = 'Adds the title to the page (H1).';
	public $is_content = false;
	public $subtype = 'page_item';
	public $instance;
	
	public function __construct( $instance = array() ){
		$this->instance = $instance;
	}
	
	public function get_form( $instance, $ipt_name ){?>
    	<h4>Alternate Title</h4>
			<p><input type="text" style="width: 90%; max-width: 100%;" name="<?php echo $ipt_name.'[settings][title]'; ?>" value="<?php echo $instance['title'];?>" /></p>
	<?php }
	
	public function render_site( $post ){
		//if( has_post_thumbnail( $post->ID ) ){
			//the_post_thumbnail('large');
		//} else {
			//echo 'No featured image set';
		//}
		
	}
	
	public function item_render_site( $post , $instance ){?>
    	<?php if( $instance['settings']['title']):?>
        <h1 class="site-title"><?php echo $instance['settings']['title'];?></h1>
        <?php else:?>
		<h1 class="site-title pagebuilder-site-title"><?php echo get_the_title($post->ID );?></h1>
        <style type="text/css">/*h1 {display: none !important;} - PC */.article-title { display: none; }/* h1.pagebuilder-site-title { display: block; }*/</style>
        <?php endif;?>
	<?php }
	
	public function render_html_email( $pagebuilder_model ){
		$post = $pagebuilder_model->post;
		$settings = $this->instance['settings'];
		if( isset( $settings['title'] ) && $settings['title'] ){
			$title = '<h1 class="site-title" style="margin-top: 0px; margin-bottom: 0px; margin-left: 0px; margin-right: 0px;">'.$settings['title'].'</h1>';
		} else {
			$title = '<h1 class="site-title pagebuilder-site-title" style="margin-top: 0px; margin-bottom: 0px; margin-left: 0px; margin-right: 0px;">'.get_the_title($post->ID ).'</h1>';
		}
		return '<tr><td>'.$title.'</td></tr>';
	}
	
};?>