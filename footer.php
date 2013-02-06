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

		<div id="footer">

			<div class="wrap">

				<?php echo apply_atomic_shortcode( 'footer_content', hybrid_get_setting( 'footer_insert' ) ); ?>

			</div><!-- .wrap -->

		</div><!-- #footer -->

			</div><!-- .wrap -->

		</div><!-- #main -->
	
        </div><!-- #container -->

	<?php wp_footer(); // wp_footer ?>

</body>
</html>