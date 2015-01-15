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
	<?php if ( $image_src ): ?> 
	<td class="feed promo image" valign="top" style="width: 150px;">
		<?php echo $link_start; ?>
			<img src="<?php echo $image_src;?>" style="width: 150px; height: auto; max-width: 100%; border: none;" />
		<?php echo $link_end; ?>
	</td>
	<?php endif; ?>
	<td class="feed promo content<?php if ( $image_src ) echo ' has-image'; ?>" valign="top">
		<h3><?php echo $link_start;?><?php echo $post_array['title']; ?><?php echo $link_end;?></h3>
		<?php echo $post_array['excerpt']; ?>
	</td>
</tr>
<tr>
	<td class="feed promo read-more" align="right"<?php if ( $image_src ) echo ' colspan="2"'; ?> valign="bottom">
		<span><?php echo $link_start; ?>Read More<?php echo $link_end; ?></span>
	</td>
</tr>