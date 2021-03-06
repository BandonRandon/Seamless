<?php
/**
 * Footer Template
 *
 * The footer template is generally used on every page of your site. Nearly all other
 * templates call it somewhere near the bottom of the file. It is used mostly as a closing
 * wrapper, which is opened with the header.php file. It also executes key functions needed
 * by the theme, child themes, and plugins. 
 *
 * @package Seamless
 * @subpackage Template
 */
?>
		<?php get_sidebar( 'primary' ); // Loads the sidebar-primary.php template. ?>

		<?php get_sidebar( 'secondary' ); // Loads the sidebar-secondary.php template. ?>

		<?php get_sidebar( 'subsidiary' ); // Loads the sidebar-subsidiary.php template. ?>

		<?php get_template_part( 'menu', 'subsidiary' ); // Loads the menu-subsidiary.php template. ?>

		<?php do_atomic( 'before_footer' ); // seamless_before_footer ?>
		<div id="footer">
		<?php do_atomic( 'open_footer' ); // seamless_open_footer ?>
			<div class="wrap">
				<?php echo apply_atomic_shortcode( 'footer_content', hybrid_get_setting( 'footer_insert' ) ); ?>
				<?php do_atomic( 'footer' ); // seamless_footer ?>
			</div><!-- .wrap -->
		
		<?php do_atomic( 'close_footer' ); // seamless_close_footer ?>
		
		</div><!-- #footer -->
		<?php do_atomic( 'after_footer' ); // seamless_after_footer ?>
		<?php do_atomic( 'close_main' ); // seamless_close_main ?>
			</div><!-- .wrap -->

		</div><!-- #main -->
		<?php do_atomic( 'after_main' ); // seamless_after_main ?>
        </div><!-- #container -->

	<?php do_atomic( 'close_body' ); // seamless_close_body ?>

	<?php wp_footer(); // wp_footer ?>

</body>
</html>
