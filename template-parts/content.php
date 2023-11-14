<?php
/**
 * The default template for displaying content
 *
 * Used for both singular and index.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<?php

	get_template_part( 'template-parts/entry-header' );

	// if ( ! is_search() ) {
	// 	get_template_part( 'template-parts/featured-image' );
	// }

	?>

	<div class="post-inner <?php echo is_page_template( 'templates/template-full-width.php' ) ? '' : 'thin'; ?> ">

		<div class="entry-content">
			
		<p>
		<em>
		<?php echo get_the_term_list( $post->ID, 'series_category', 'This article is part of the following series: ', ', ' ); ?></em>
</p>
			<?php
			if ( is_search() || ! is_singular() && 'summary' === get_theme_mod( 'blog_content', 'full' ) ) {
				the_excerpt();
			} else {
				the_content( __( 'Continue reading', 'twentytwenty' ) );
			}
			?>
			
			<?php if (is_page(1301)) { ?>
						<ul class="subnav">
						  <?php wp_list_pages('title_li=&child_of='.$post->ID); ?>
						</ul>
						<?php } ?>
			
				<?php if (is_page(1554)) { ?>
						<ul class="guests">
							<?php
							
							$blogusers = get_users( 'orderby=meta_value&meta_key=last_name&role=contributor' );
// Array of WP_User objects.
foreach ( $blogusers as $user ) {
	echo '<li><a href="' . get_author_posts_url($user->ID) . '">' . esc_html( $user->display_name ) . '</a></li>';
}
				
							?>
						</ul>
						<?php } ?>
			
			
				<?php //show citations from academic citation plugin
				if (function_exists('outputCitations') && is_single()):?>
					<div class="citations-block">
					<?php echo outputCitations();?>
					</div>
				<?php endif;?>
			
			

		</div><!-- .entry-content -->

	</div><!-- .post-inner -->

	<div class="section-inner">
		<?php
		wp_link_pages(
			array(
				'before'      => '<nav class="post-nav-links bg-light-background" aria-label="' . esc_attr__( 'Page', 'twentytwenty' ) . '"><span class="label">' . __( 'Pages:', 'twentytwenty' ) . '</span>',
				'after'       => '</nav>',
				'link_before' => '<span class="page-number">',
				'link_after'  => '</span>',
			)
		);

		edit_post_link();

		// Single bottom post meta.
		twentytwenty_the_post_meta( get_the_ID(), 'single-bottom' );

		if ( post_type_supports( get_post_type( get_the_ID() ), 'author' ) && is_single() ) {

			get_template_part( 'template-parts/entry-author-bio' );

		}
		?>

	</div><!-- .section-inner -->

	<?php

	if ( is_single() ) {

		get_template_part( 'template-parts/navigation' );

	}

	/*
	 * Output comments wrapper if it's a post, or if comments are open,
	 * or if there's a comment number – and check for password.
	 */
	if ( ( is_single() ) && ( comments_open() || get_comments_number() ) && ! post_password_required() ) {
		?>

		<div class="comments-wrapper section-inner">

			<?php comments_template(); ?>

		</div><!-- .comments-wrapper -->

		<?php
	}
	?>

</article><!-- .post -->
