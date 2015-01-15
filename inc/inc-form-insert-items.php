<div class="cwp-form">
	<div class="cwp-form-section">
        <p>
            <input class="widefat" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>">
        </p>
    </div>
    <!-- Form Section -->
	<div class="cwp-form-section">
    	<a href="#" class="cwp-form-section-title">
        	Step 1: Select Feed Type
        </a>
        <div class="cwp-form-section-content active-form-section">
        	<p>
            	<input type="radio" class="dynamic-radio-field" data-field="feed-static" name="<?php echo $this->get_field_name( 'feed_type' )?>" value="static" /> <strong>Static:</strong> Select specific post/pages by URL.
            </p>
           <!-- <p>
            	<input type="radio" class="dynamic-radio-field" data-field="feed-dynamic" name="<?php echo $this->get_field_name( 'feed_type' )?>" value="dynamic" /> <strong>Dynamic:</strong> Feed by type, categories or tags. 
            </p> -->
        </div>
    </div>
    <!-- Form Section -->
    <div class="cwp-form-section">
    	<a href="#" class="cwp-form-section-title">
        	Step 2: Select Content
        </a>
        <div class="cwp-form-section-content">
        	<div class="dynamic-field feed-static active-field">
                <p>
                URL: <input type="text" value="" data-addname="<?php echo $this->get_field_name( 'insert_urls' )?>" /><br />
                <a href="#" class="action-add-insert pagebuilder-button-standard">+ ADD</a>
                </p>
                <p>
                	<strong>Selected Posts/Pages</strong>
                </p>
                <ul class="add-insert">
                	<?php if ( $instance['insert_urls'] && is_array( $instance['insert_urls'] ) ):?>
                    	<?php foreach ( $instance['insert_urls'] as $url ): ?>
                    		<li class="add-insert-item">
                    			<?php echo $url;?>
                        		<input type="hidden" name="<?php echo $this->get_field_name( 'insert_urls' )?>[]" value="<?php echo $url;?>" />
                                <a href="#"></a>
                            </li>
                    	<?php endforeach; ?>
                    <?php endif;?> 
                </ul>
            </div>
        	<div class="dynamic-field feed-dynamic" >
                <p>
                    Comming Soon
                </p>
            </div>
        </div>
    </div>
    <!-- Form Section -->
    <div class="cwp-form-section">
    	<a href="#" class="cwp-form-section-title">
        	Step 3: Set Display Style
        </a>
        <div class="cwp-form-section-content">
        	<p>
            	Promo display only - More comming soon.
            </p>
        </div>
    </div>
    <!-- Form Section -->
</div>