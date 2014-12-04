<div class="pagebuilder-settings-form add-row-settings pagebuilder-lightbox-window">            
    <div class="settings-wrapper">
        <header>
            Row Settings
        </header>
        
        <section class="form-content">
        <input type="hidden" name="<?php echo $input_base;?>[id]" value="<?php echo $row['id'];?>" />
        <input class="input-row-order" type="hidden" name="<?php echo $input_base;?>[order]" value="<?php echo $row['order'];?>" />
        <p>
        <label>Row Name</label><br />
        <input class="input-row-name" type="text" name="<?php echo $input_base;?>[name]" value="<?php echo $row['name'];?>" /><br />
        </p>
        <ul class="pb-editor-form-accordion">
        	<?php if( !isset( $row['url'] ) || !$row['url'] ):?> 
        	<li>
                <header>Row Layout</header>
                <ul>
                    <li>
                    	<label>Display Title As:</label><br />
						<?php $r_tags = array( 'h2','h3','h4');?>
                        <select name="<?php echo $input_base;?>[titletag]">
                        <option value="">NA</option>
                            <?php foreach( $r_tags as $r_tag ):?>
                                <option value="<?php echo $r_tag;?>" <?php \selected( $row['titletag'] , $r_tag );?>><?php echo $r_tag;?></option>
                            <?php endforeach;?>
                        </select>
                     
                      
                        
                        <p>
                        <label>Columns</label><br />
                        <select class="input-column-layout" name="<?php echo $input_base;?>[layout]">
                            <option value="pagbuilder-layout-full" <?php \selected( $row['layout'] , 'pagbuilder-layout-full' );?>>One</option>
                            <option value="pagbuilder-layout-aside" <?php \selected( $row['layout'] , 'pagbuilder-layout-aside' );?>>Two - Sidebar Right</option>
                            <option value="pagbuilder-layout-half" <?php \selected( $row['layout'] , 'pagbuilder-layout-half' );?>>Two - Half</option>
                            <option value="pagbuilder-layout-third-right" <?php \selected( $row['layout'] , 'pagbuilder-layout-third-right' );?>>Two - 1/3 Right</option>
                            <option value="pagbuilder-layout-third-left" <?php \selected( $row['layout'] , 'pagbuilder-layout-third-left' );?>>Two - 1/3 Left</option>
                            <option value="pagbuilder-layout-thirds" <?php \selected( $row['layout'] , 'pagbuilder-layout-thirds' );?>>Three</option>
                            <option value="pagbuilder-layout-fourths" <?php \selected( $row['layout'] , 'pagbuilder-layout-fourths' );?>>Four</option>
                        </select></p>
                        <p>
                    </li>
                </ul>
            </li>
            <?php else: // $row['url'] ?>
            <li>
                	<header>Existing Post/Page</header>
                    <ul>
                    	<li>
                        	<label>Post/Page URL</label><br />
            				<input class="input-row-url" style="width: 90%;" type="text" name="<?php echo $input_base;?>[url]" value="<?php echo $row['url'];?>" /><br />
                            <input type="checkbox" name="<?php echo $input_base;?>[import_title]" value="1" <?php checked( $row['import_title'] , 1  );?> />
                             <label>Import Title as H2</label>
                            <input type="hidden" name="<?php echo $input_base;?>[urlid]" value="<?php echo $row['urlid'];?>" />
                        </li>
                    </ul>
                </li>
            <?php endif; // $row['url'] ?>
            <li>
                <header>Advanced Settings</header>
                <ul>
                    <li>
                        <label>Row Category</label><br />
                        <select class="input-column-layout" name="<?php echo $input_base;?>[category]">
                        <?php $categories = get_categories(array( 'hide_empty' => 0 ) );?> 
                        <option value="">Select</option>
                        <?php foreach ( $categories as $category ) :?>
                          <option value="<?php echo $category->slug;?>" <?php \selected( $row['category'] , $category->slug );?>>
                          <?php echo $category->cat_name;?></option>
                        <?php endforeach;?>
                        </select></p>
                        <h4>Advanced Settings</h4>
                        <p>CSS Hook: <input class="input-css-hook" type="text"   name="<?php echo $input_base;?>[class]" value="<?php echo $row['class'];?>" /></p>
                        <p>Background Image ID: <input type="text"   name="<?php echo $input_base;?>[bgimage]" value="<?php echo $row['bgimage'];?>" /></p>
                        <p><input  style="display: none;" type="checkbox"   name="<?php echo $input_base;?>[bgscroll]" value="0"  checked="checked" /><input type="checkbox"   name="<?php echo $input_base;?>[bgscroll]" value="1" <?php checked( $row['bgscroll'] , 1 );?> /> Scroll Over Background<br />
                        <input type="checkbox"   name="<?php echo $input_base;?>[bgfull]" value="1" checked=checked />
                        <input style="display: none;" type="checkbox"   name="<?php echo $input_base;?>[bgfull]" <?php checked( $row['bgfull'] , 0 );?> value="0"  /> Full Width Background
                        </p> 
                    </li>
                </ul>
            </li>
        </ul>
        </section>
        <footer>
            <a href="#" class="update-row-action lb-close-action">Done</a><br />
            <?php if( 'row-100' != $row['id'] && 'row-200' != $row['id'] ):?>
            <a href="#" class="delete-row-action lb-close-action">Delete Row</a>
            <?php endif;?>
        </footer>
    </div>
</div>