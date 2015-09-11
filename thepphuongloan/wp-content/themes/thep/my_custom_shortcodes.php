[sourcecode language='php']
<?php

function custom_list_category(){
	$args = array(
    'orderby' => 'name',
    'order' => 'ASC',
    'parent' => 0
    );
  $categories = get_categories($args);
    echo '<div class="cat-title">'."Sản Phẩm".'</div>';
    echo '<div class="clear">'.'</div>';
    foreach($categories as $category) {
      echo '<div>';
      echo '<div class="cat-img"><img src="https://placehold.it/128x100">'. '</div>'; 
      echo '<div class="cat-info">';
      echo '<div class="cat-name"><a href="' . get_category_link( $category->term_id ) . '" title="' . sprintf( __( "Xem bài viết trong %s" ), $category->name ) . '" ' . '>' . $category->name.'</a> </div> ';
      echo '<div class="cat-description">'. $category->description . '</div>';
      echo '</div>';
      echo '</div>';
      echo '<div class="clear">'.'</div>';
      echo '<br/>';
    }
}

?>
[/sourcecode]