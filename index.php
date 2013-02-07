<?php
/**
 * Index Template
 *
 * This is the default template.  It is used when a more specific template can't be found to display
 * posts.  It is unlikely that this template will ever be used, but there may be rare cases.
 *
 */

get_header(); // Loads the header.php template. ?>

	<?php do_atomic( 'before_content' ); // seamless_before_content ?>

	<div id="content" role="main">

		<?php do_atomic( 'open_content' ); // seamless_open_content ?>

		<section class="hfeed">

			<?php get_template_part( 'loop-meta' ); // Loads the loop-meta.php template. ?>

			<?php if ( have_posts() ) : ?>

				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content' ); ?>

					<?php if ( is_singular() ) { ?>

						<?php do_atomic( 'after_singular' ); // seamless_after_singular ?>

						<?php comments_template( '/comments.php', true ); // Loads the comments.php template. ?>

					<?php } ?>

				<?php endwhile; ?>

			<?php else : ?>

				<?php get_template_part( 'loop-error' ); // Loads the loop-error.php template. ?>

			<?php endif; ?>

		</section><!-- .hfeed -->

		<?php do_atomic( 'close_content' ); // seamless_close_content ?>

		<?php get_template_part( 'loop-nav' ); // Loads the loop-nav.php template. ?>

	</div><!-- #content -->

	<?php do_atomic( 'after_content' ); // seamless_after_content ?>

<?php get_footer(); // Loads the footer.php template. ?>