<?php namespace cahnrswp\pagebuilder;

class settings_control {
	
	public function register_settings(){
		add_settings_section(
			'pagebuilder_options',
			'Pagebuilder Options',
			array( $this , 'pagebuilder_options_text' ),
			'reading'
		);
		
		add_settings_field(
			'_pagebuilder_settings',
			'Edit Pagebuilder Settings: ',
			array( $this , 'settings_form' ),
			'reading',
			'pagebuilder_options'
		);
		register_setting( 'reading', '_pagebuilder_settings' );
	}
	
	public function pagebuilder_options_text(){
		echo 'helper text here';
	}
	
	public function settings_form(){
		echo '<p>';
			$sets = get_option( '_pagebuilder_settings' );
			$pos = ( isset( $sets['tertiary'] ) )? $sets['tertiary'] : 0;
			$tertiary_args = array( 
				'header-before' => 'Above All Content',
				'header-after' => 'After Content Header',
				'footer-before' => 'Before Content Footer',
				'footer-after' => 'After Content Footer',
				);
			echo '<label>Tertiary Nav Position: </label>';
			echo '<select name="_pagebuilder_settings[tertiary]">';
				echo '<option value="0" '.selected( 0 , $pos , false ).' >None</option>';
				foreach( $tertiary_args as $value => $title ){
					echo '<option value="'.$value.'" '.selected( $value , $pos , false ).' >'.$title.'</option>';
				}
			echo '</select>';
		echo '</p>';
	}

};?>