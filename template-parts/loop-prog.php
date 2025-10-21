<?php
echo "entramos loop2";
$post_categoria = get_post(array('category_name'=>'prog', 'numberposts' =>-1));

if ($post_categoria){
    foreach ($post_categoria as $post){
        the_title();
        the_content();
    }
}