<?php namespace cahnrswp\pagebuilder; 
if ( isset( $post_array['featured_image']['attachment_meta']['sizes']['thumbnail']['url'] ) ){ 

	$image_src = $post_array['featured_image']['attachment_meta']['sizes']['thumbnail']['url'];
	
} else {
	
	$image_src = false;
	
}; // end if

$link_start = '<a href="' . $post_array['link'] . '" >';

$link_end = '</a>';

?>
<tr>
	<?php if ( $image_src ):?> 
    <td  class="feed promo image" valign="top" rowspan="2" style="width: 160px;">
    	<?php echo $link_start;?>
        	<img src="<?php echo $image_src;?>" style="width: 150px; height: auto; max-width: 100%; border: none;" />
        <?php echo $link_end;?>
    </td>
    <?php endif;?>
    <td class="feed promo <?php if ( $image_src ) echo ' has-image';?>" valign="top" <?php if ( ! $image_src ) echo 'colspan="2"';?> >
    	<h3><?php echo $link_start;?><?php echo $post_array['title']; ?><?php echo $link_end;?></h3>
        <?php echo $post_array['excerpt']; ?>
    </td>
</tr><tr>
    <td class="feed promo" align="right" valign="bottom">
    	<span class="feed-read-more">
        <?php echo $link_start;?>&nbsp;&nbsp;Read More&nbsp;&nbsp;<?php echo $link_end;?></span>
    </td>
</tr>

