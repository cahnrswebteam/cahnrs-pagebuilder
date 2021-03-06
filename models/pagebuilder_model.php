<?php namespace cahnrswp\pagebuilder;

class pagebuilder_model {
	public $post;
	public $content;
	public $meta;
	public $layout;
	public $width = 700;
	public $layout_columns = array(
		'pagebuilder-layout-full' => 1,
		'pagebuilder-layout-aside-empty' => 1,
		'pagebuilder-layout-aside' => 2,
		'pagebuilder-layout-half' => 2,
		'pagebuilder-layout-third-left' => 2,
		'pagebuilder-layout-third-right' => 2,
		'pagebuilder-layout-thirds' => 3,
		'pagebuilder-layout-fourths' => 4,
		);
	public $width_ratios = array(
		'pagebuilder-layout-full' => array( 1 ),
		'pagebuilder-layout-aside-empty' => array( 1 ),
		'pagebuilder-layout-aside' => array( 0.70 , 0.30 ),
		'pagebuilder-layout-half' => array( 0.50 , 0.50 ),
		'pagebuilder-layout-third-left' => array( 0.33 , 0.67 ),
		'pagebuilder-layout-third-right' => array( 0.67 , 0.33 ),
		'pagebuilder-layout-thirds' => array( 0.33 , 0.34, 0.33 ),
		'pagebuilder-layout-fourths' => array( 0.25 , 0.25, 0.25, 0.25 ),
		);
	
	public function __construct( $content , $post ){
		$this->content = $content;
		$this->post = $post;
		$this->pagebuilder_meta = \get_post_meta( $post->ID , '_cahnrs_layout' , true );
		if( isset( $this->pagebuilder_meta ) && $this->pagebuilder_meta ){
			$this->layout = $this->pagebuilder_meta;
		} else {
			$this->layout = $this->set_default();
		}
		$this->set_layout_data();
		//$this->set_item_models();
	}
	
	public function set_default(){
		$layout = array(
				'row-100' => array(
						'id' => 'row-100',
						'name' => 'Header',
						'layout' => 'pagebuilder-layout-full',
						'column_count' => 1,
						'columns' => array(),
					),
				'row-1' => array(
					'id' => 'row-1',
					'name' => 'Content Row',
					'layout' => 'pagebuilder-layout-full',
					'column_count' => 1,
					'columns' => array(
						'column-1' => array(
							'id' => 'column-1',
							'items' => array(
								'page_content-1' => array(
									'id' => 'page_content',
									'instance' => 1,
									'type' => 'native',
								),
							),
						),
					),
				),
				'row-200' => array(
						'id' => 'row-200',
						'name' => 'Footer',
						'column_count' => 1,
						'layout' => 'pagebuilder-layout-full',
					),
			);
		return $layout;
	}
	
	public function set_layout_data(){
		if( $this->layout ){
			foreach( $this->layout as $rowid => &$row ){
				$this->get_column_count( $row );
				for( $c = 1; $c <= $row['column_count']; $c++){
					$this->set_column_width( $row , $c );
					if( isset( $row['columns']['column-'.$c]['items'] ) ){
						
						foreach( $row['columns']['column-'.$c]['items'] as $itemKey => &$item ){
							
							switch ( $item['type'] ){
								case 'native':
									  $item_class = __NAMESPACE__.'\\item_'.$item['id'].'_model';
									  if( class_exists( $item_class, true ) ){
										$item = new $item_class( $item );
									  } else {
										  $item = false;
									  }
									  break;
								  case 'widget':
								  		$item_obj = new \stdClass();
										$item_obj->ID = $item['id'];
										$item_obj->NID = $item['instance'];
										$item_obj->settings = $item['settings'];
										$item = $item_obj;
									  break;
							  }; // End Switch
						} // End foreach
					}// End If
				} // End For
			} // End Foreach
		}// End if
	}
	
	public function set_column_width( &$row , $c ){
		if( array_key_exists( $row['layout'] , $this->width_ratios ) ) {
			$row['columns']['column-'.$c]['width'] = $this->width_ratios[ $row['layout'] ][$c - 1];
		}
	}
	
	public function get_column_count( &$row ){
		$row['layout'] = str_replace('pagbuilder', 'pagebuilder', $row['layout'] );
		if( 'pagebuilder-layout-aside' == $row['layout'] && !isset( $row['columns']['column-2']['items'] ) ){
			$row['layout'] = 'pagebuilder-layout-aside-empty';
		}
		if( array_key_exists( $row['layout'] , $this->layout_columns ) ) {
			$row['column_count'] = $this->layout_columns[ $row['layout'] ];
		} else {
			$row['column_count'] = 1;
		}
	}
	
};?>