<?php

define ('THEME_NAME',	"ANC" );
define ('THEME_FOLDER',	"ANC" );
define ('THEME_VER', 	1 );

define( 'NOTIFIER_XML_FILE', "#" );
define( 'DOCUMENTATION_URL', "#");
define( 'SUPPORT_URL', "#");

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
add_shortcode( 'custom_list_category_with_products_sc', 'custom_list_category_with_products' );

add_shortcode( 'slider_list_category_sc', 'slider_list_category' );
add_shortcode( 'other_pro_cats_sc', 'other_pro_cats' );
add_shortcode( 'btn_contact_sc', 'btn_contact' );
add_shortcode( 'online_support_sc', 'online_support' );
add_shortcode( 'wp_statistics_useronline_sc', 'wp_statistics_useronline_ft' );
add_shortcode( 'wp_statistics_visit_today_sc', 'wp_statistics_visit_today_ft' );
add_shortcode( 'wp_statistics_visit_total_sc', 'wp_statistics_visit_total_ft' );
add_shortcode( 'get_image_url_sc', 'get_image_url' );

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
    echo '<div class="float-l">Nhóm Sản Phẩm</div>';
    echo '<div class="float-r dot-dot" style="width:80%"></div>';
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
      echo '<div class="cat-name"><a href="' . get_category_link( $category ) . '" title="' . sprintf( __( "Xem bài viết trong %s" ), $category->name ) . '" ' . '>' . $category->name.'</a> </div> ';
      echo '<div class="cat-description">'. wp_trim_words( $category->description, $num_words = 55, $more = null ) . '</div>';
      echo '</div>';
      echo '</div>';
      echo '<div class="clear">'.'</div>';
      echo '<div class="hr"></div>';
      echo '<br/>';
    }
}
?>
<?php
function custom_list_category_with_products(){
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
    echo '<div class="float-l">Nhóm Sản Phẩm</div>';
    echo '<div class="float-r dot-dot" style="width:80%"></div>';
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
      echo '<div class="cat-name"><a href="' . get_category_link( $category ) . '" title="' . sprintf( __( "Xem bài viết trong %s" ), $category->name ) . '" ' . '>' . $category->name.'</a> </div> ';
      echo '<div class="cat-description">'. wp_trim_words( $category->description, $num_words = 55, $more = null ) . '</div>';
      echo '</div>';
      echo '</div>';
      echo '<div class="clear">'.'</div>';
      echo '<br/>';

      $args = array(
            'posts_per_page' => 5,
            'tax_query' => array(
                'relation' => 'AND',
                array(
                    'taxonomy' => 'product_cat',
                    'field' => 'slug',
                    // 'terms' => 'white-wines'
                    'terms' => $category->slug
                )
            ),
            'post_type' => 'product',
            'orderby' => 'rand'
        );
        $products = new WP_Query( $args);
        if ($products->have_posts()){
          echo "<div class='post-inner inside'>";
          echo "<ul class='products'>";
          while ( $products->have_posts() ) {
              $products->the_post();
                  wc_get_template_part( 'content', 'product' );
          }
          echo "</ul>";
          echo "</div>";
        }

      echo '<div class="hr"></div>';
      echo '<br/>';
    }
}
?>
<?php
// function list_product_by_cat
?>
<?php
function other_pro_cats(){
  $args = array(
    'number'     => 0,
    'orderby' => 'name',
    'order' => 'ASC',
    'hide_empty' => false,
    'include'    => $ids
  );

  $product_categories = get_terms( 'product_cat', $args );
  $categories = $product_categories;
  $first = key($categories);

  echo '<div class="dot-dot" style="width:90%;text-align:center;margin-top:10px;"></div>';
  echo '<div class="other-pro-cats">';
  echo '<em>Các sản phẩm khác: </em>';
  foreach($categories as $key => $category) {
    end($categories);
    echo '<span class="other-cat-name"><a href="' . get_category_link( $category )  . '">' . $category->name.'</a></span>';
    if ($key != key($categories)){
      echo ', ';
    }
  }
  echo '</div>';
}
?>
<?php
function btn_contact(){
  echo '<div class="btn_contact">';
  echo '<a href="http://www.thepphuongloan.com/lien-he" title="Thông tin phản hồi mẫu" class="fancybox"><span>Tư vấn thông tin về sản phẩm</span></a>';
  echo '</div>';
}
?>
<?php
function online_support(){
  echo '<div class="box-content">';
    echo '<div class="box_support">';
      echo '<div class="row">';
        echo '<div class="nick yahoo" nick="thepphuongloan@yahoo.com.vn" nick_type="yahoo"><a href="ymsgr:sendIM?thepphuongloan@yahoo.com.vn"><img src="'.get_stylesheet_directory_uri().'/images/tpl/yahoo_on.gif'.'" alt="" />'.'</a></div>';
        echo '<div class="nick skype" nick="" nick_type="skype"><a href="Skype:?chat"><img src="'.get_stylesheet_directory_uri().'/images/tpl/skype_on.gif'.'"></a></div>';
      echo '</div>';
      echo '<div class="clear"></div>';
      echo '<div class="hotline">';
        echo '<table>';
        echo '<tr>';
        echo '<td class="l-span">Hotline:</td>';
        echo '<td>08.38.660.340</td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td class="l-span"></td>';
        echo '<td>08.6265.4166</td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td class="l-span">Email:</td>';
        echo '<td><a href="mailto:Info@ThepPhuongLoan.com">Info@thepphuongloan.com</a></td>';
        echo '</tr>';
        echo '</table>';
      echo '</div>';
      echo '<div class="camera">';
        echo '<a href="http://khophuongloan.homeip.net:81"><img src="'.get_stylesheet_directory_uri().'/images/tpl/CameraPhuongloan1.jpg" alt="Công ty thép Phương Loan" title="Công ty thép Phương Loan" style="width:180px;height:140px;"></a>';
      echo '</div>';
    echo '</div>';
  echo '</div>';
}
?>
<?php
function slider_list_category(){
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
    echo '<div class="float-l">NhómSản Phẩm</div>';
    echo '<div class="float-r dot-dot" style="width:85%"></div>';
    echo '</div>';
    echo '<div class="clear">'.'</div>';
    echo '<div id="carousel">';
    foreach($categories as $category) {
      // get the thumbnail id user the term_id
      $thumbnail_id = get_woocommerce_term_meta( $category->term_id, 'thumbnail_id', true ); 
      // get the image URL
      $image = wp_get_attachment_url( $thumbnail_id ); 
    
      echo '<div class="slide">';
        echo "<img src='{$image}' width='90' height='70' alt='' />";
        echo '<span class="slider-info">';
        echo '<div class="slider-name"><a href="' . get_category_link( $category ) . '" title="' . sprintf( __( "Xem bài viết trong %s" ), $category->name ) . '" ' . '>' . $category->name.'</a> </div> ';
        echo '<div class="slider-description">'. wp_trim_words( $category->description, $num_words = 30, $more = null ) . '</div>';
        echo '</span>';
      echo '</div>';
    }
    echo '</div>';
}
?>
<?php
/**
 * Proper way to enqueue scripts and styles
 */
function theme_name_scripts() {
  wp_enqueue_script('jquery');
  wp_enqueue_script( 'script-name', get_template_directory_uri() . '/js/jquery.bxslider/jquery.bxslider.js', array('jquery'), '1.0.0', true );
  wp_enqueue_script( 'script2-name', get_template_directory_uri() . '/js/slider.js', array('jquery'), '1.0.0', true );
}
  add_action( 'wp_enqueue_scripts', 'theme_name_scripts' );
?>
<?php
  function wp_statistics_useronline_ft(){
    return sprintf('%06d', wp_statistics_useronline());
  }
  function wp_statistics_visit_today_ft(){
    return sprintf('%06d', wp_statistics_visit('today'));
  }
  function wp_statistics_visit_total_ft(){
    return sprintf('%06d', 500000 + wp_statistics_visit('total'));
  }
?>
<?php
function get_image_url(){
  return get_stylesheet_directory_uri();
}
?>
<?php
// Exclude Doi tac & Khach hang from Search page
/* Exclude a Category from Search Results */

add_filter( 'pre_get_posts' , 'search_exc_cats' );
function search_exc_cats( $query ) {

  if( $query->is_admin )
    return $query;

  if( $query->is_search ) {
    $query->set( 'category__not_in' , array( 63, 64 ) ); // Cat ID
  }
  return $query;
}
?>