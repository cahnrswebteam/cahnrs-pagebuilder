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
				'before' => 'Before Content',
				'after' => 'After Content',
				);
			echo '<label>Tertiary Nav Position: </label>';
			echo '<select name="_pagebuilder_settings[tertiary]">';
				echo '<option value="0" '.selected( 0 , $pos , false ).' >None</option>';
				foreach( $tertiary_args as $value => $title ){
					echo '<option value="'.$value.'" '.selected( $value , $pos , false ).' >'.$title.'</option>';
				}
			echo '</select>';
		echo '</p><p>';
			$tn_top = ( isset( $sets['tn-top'] ) )? $sets['tn-top'] : 0;
			echo '<input style="display: none;" type="checkbox" name="_pagebuilder_settings[tn-top]" value="0" checked="checked" />';
			echo '<input type="checkbox" name="_pagebuilder_settings[tn-top]" value="1" '.checked( 1 , $tn_top , false ) .' />';
			echo '<label> Render on Top Level</label>';
			
			$tn_home = ( isset( $sets['tn-home'] ) )? $sets['tn-home'] : 0;
			echo '<input style="display: none;" type="checkbox" name="_pagebuilder_settings[tn-home]" value="0" checked="checked" />';
			echo '<input type="checkbox" name="_pagebuilder_settings[tn-home]" value="1" '.checked( 1 , $tn_home , false ) .' />';
			echo '<label> Exclude Homepage</label>';
			
			$tn_parent = ( isset( $sets['tn-parent'] ) )? $sets['tn-parent'] : 0;
			echo '<input style="display: none;" type="checkbox" name="_pagebuilder_settings[tn-parent]" value="0" checked="checked" />';
			echo '<input type="checkbox" name="_pagebuilder_settings[tn-parent]" value="1" '.checked( 1 , $tn_parent , false ) .' />';
			echo '<label> Exclude Current Parent</label>';
		echo '</p>';
	}

};?>