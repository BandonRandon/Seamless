<?php
/**
 * Content Template for the "Image" post format
 *
 * Displays the "Image" post format content to be called by get_template_part() in the various templates
 *
 * @package Seamless
 * @subpackage Template
 */
?>
<?php do_atomic( 'before_entry' ); // Before loop hook ?>

<article id="post-<?php the_ID(); ?>" class="<?php hybrid_entry_class(); ?>">

	<?php do_atomic( 'open_entry' ); // Open loop hook ?>
	
	<header class="entry-header">
		
		<?php echo apply_atomic_shortcode( 'entry_title', '[entry-title]' ); ?>
	
		<?php get_template_part( 'loop', 'byline' ); ?>
		
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php wp_link_pages( array( 'before' => '<p class="page-links">' . __( 'Pages:', 'seamless' ), 'after' => '</p>' ) ); ?>
	</div><!-- .entry-content -->

	<?php get_template_part( 'loop', 'entry-meta' ); ?>

	<?php do_atomic( 'close_entry' ); // Close loop hook ?>

</article><!-- .hentry -->

<?php do_atomic( 'after_entry' ); // After loop hook ?>