<?php $image = false; ?>
<?php $image = apply_filters( 'cahnrs_pagebuilder_pagebuilder_background_image', $image , $row );?>
<?php if( $image ):?>
<div class="pagebuilder-row-background unbound recto verso" style="width: 1545px; margin-right: -79.5px; margin-left: -277.5px; background-image: url(<?php echo $image; ?>);">
            </div>
<?php endif;?>