<?php
/**
 * Singlular Content Template
 *
 * Displays content to be called by get_template_part() in singular templates
 *
 * @package Seamless
 * @subpackage Template
 */
?>
<article id="post-<?php the_ID(); ?>" class="<?php hybrid_entry_class(); ?>">

	<header class="entry-header">

		<?php echo apply_atomic( 'entry_title', the_title( '<h1 class="entry-title">', '</h1>', false ) ); ?>
		
		<?php get_template_part( 'loop', 'byline' ); ?>
		
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'seamless' ) ); ?>
		<?php wp_link_pages( array( 'before' => '<p class="page-links">' . __( 'Pages:', 'seamless' ), 'after' => '</p>' ) ); ?>
	</div><!-- .entry-content -->
	
	<?php get_template_part( 'loop', 'entry-meta' ); ?>

</article><!-- .hentry -->

<?php comments_template( '/comments.php', true ); ?>