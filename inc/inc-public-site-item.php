<?php namespace cahnrswp\pagebuilder;

switch( $item['type'] ){
    case 'native' :
        echo $args['before_widget'];
        $item_obj = $layout_model->get_item_object( $item );
        $item_obj->item_render_site( $post , $item );
        echo $args['after_widget'];
        break;
    case 'widget' :
        \the_widget( $item['id'] , $item['settings'], $args );
        break;
};