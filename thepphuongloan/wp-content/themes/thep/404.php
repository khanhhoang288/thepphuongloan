<?php get_header(); ?>
	<div class="content">
			
		<div class="post error404 full-width">
			<div class="post-inner">
				<div class="title-404"><?php _eti( '404 :(' ); ?></div>
				<h2 class="post-title"><?php _eti( 'Not Found' ); ?></h2>
				<div class="clear"></div>
				<div class="entry">
					<p><?php _eti( 'Apologies, but the page you requested could not be found. Perhaps searching will help.' ); ?></p>
					
					<div class="search-block-large">
						<form method="get" action="<?php echo home_url(); ?>/">
							<button class="search-button" type="submit" value="<?php if( !$is_IE ) _eti( 'Search' , 'tie' ) ?>"><i class="fa fa-search"></i></button>	
							<input type="text" id="s" name="s" value="<?php _eti( 'Search' ) ?>" onfocus="if (this.value == '<?php _eti( 'Search' ) ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php _eti( 'Search' ) ?>';}"  />
						</form>
					</div><!-- .search-block /-->	
				</div><!-- .entry /-->	
	
				<?php 
					$original_post = $post;

					$args = array( 'posts_per_page'=> 4 , 'no_found_rows' => 1 );	
					$related_query = new wp_query( $args );
					if( $related_query->have_posts() ) : $count=0;
				?>

			
				<?php
				endif;
				
				$post = $original_post;
				wp_reset_query();
				?>
	
			</div><!-- .post-inner -->
		</div><!-- .post-listing -->
	</div>
<?php get_footer(); ?>