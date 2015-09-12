<?php

define ('THEME_NAME',	"Sahifa" );
define ('THEME_FOLDER',	"sahifa" );
define ('THEME_VER', 	5 );

define( 'NOTIFIER_XML_FILE', "http://themes.tielabs.com/xml/".THEME_FOLDER.".xml" );
define( 'DOCUMENTATION_URL', "http://themes.tielabs.com/docs/".THEME_FOLDER );

if ( ! isset( $content_width ) ) $content_width = 618;

// Main Functions
require_once ( get_template_directory() . '/framework/functions/theme-functions.php');
require_once ( get_template_directory() . '/framework/functions/common-scripts.php' );
require_once ( get_template_directory() . '/framework/functions/mega-menus.php'     );
require_once ( get_template_directory() . '/framework/functions/pagenavi.php'       );
require_once ( get_template_directory() . '/framework/functions/breadcrumbs.php'    );
require_once ( get_template_directory() . '/framework/functions/tie-views.php'      );
require_once ( get_template_directory() . '/framework/functions/translation.php'    );
require_once ( get_template_directory() . '/framework/widgets.php'                  );
require_once ( get_template_directory() . '/framework/admin/framework-admin.php'    );
require_once ( get_template_directory() . '/framework/shortcodes/shortcodes.php'    );

if( tie_get_option( 'live_search' ) )
	require_once ( get_template_directory() . '/framework/functions/search-live.php');

if( !tie_get_option( 'disable_arqam_lite' ) )
	require_once ( get_template_directory() . '/framework/functions/arqam-lite.php');

// Add custom sourcecode
add_shortcode( 'custom_list_category_sc', 'custom_list_category' );

// add_action( 'woocommerce_archive_description', 'woocommerce_category_image', 2 );
// function woocommerce_category_image() {
//     if ( is_product_category() ){
// 	    global $wp_query;
// 	    $cat = $wp_query->get_queried_object();
// 	    $thumbnail_id = get_woocommerce_term_meta( $cat->term_id, 'thumbnail_id', true );
// 	    $image = wp_get_attachment_url( $thumbnail_id );
// 	    if ( $image ) {
// 		    echo '<img src="' . $image . '" alt="" />';
// 		}
// 	}
// }
?>

<?php
function custom_list_category(){
  $args = array(
    'number'     => 0,
    'orderby' => 'name',
    'order' => 'ASC',
    'hide_empty' => false,
    'include'    => $ids
  );

  $product_categories = get_terms( 'product_cat', $args );
  $categories = $product_categories;
    echo '<div class="cat-title">';
    echo '<div class="float-l">Sản Phẩm</div>';
    echo '<div class="float-r dot-dot" style="width:85%"></div>';
    echo '</div>';
    echo '<div class="clear">'.'</div>';
    foreach($categories as $category) {
      // get the thumbnail id user the term_id
      $thumbnail_id = get_woocommerce_term_meta( $category->term_id, 'thumbnail_id', true ); 
      // get the image URL
      $image = wp_get_attachment_url( $thumbnail_id ); 
    
      echo '<div>';
      echo "<div class='cat-img'><img src='{$image}' alt='' /></div>";
      echo '<div class="cat-info">';
      echo '<div class="cat-name"><a href="' . get_category_link( $category->term_id ) . '" title="' . sprintf( __( "Xem bài viết trong %s" ), $category->name ) . '" ' . '>' . $category->name.'</a> </div> ';
      echo '<div class="cat-description">'. wp_trim_words( $category->description, $num_words = 55, $more = null ) . '</div>';
      echo '</div>';
      echo '</div>';
      echo '<div class="clear">'.'</div>';
      echo '<div class="hr"></div>';
      echo '<br/>';
    }
}
?>
