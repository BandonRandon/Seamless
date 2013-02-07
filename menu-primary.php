<?php
/**
 * primary Menu Template
 *
 * Displays the primary Menu if it has active menu items.
 *
 * @package Seamless
 * @subpackage Template
 */

if ( has_nav_menu( 'primary' ) ) : ?>

	<?php do_atomic( 'before_menu_primary' ); // seamless_before_menu_primary ?>

	<nav id="menu-primary" role="navigation" class="primary-navigation site-navigation">
		<h1 class="assistive-text"><?php _e( 'Menu', 'seamless' ); ?></h1>
		<div class="assistive-text skip-link"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'seamless' ); ?>"><?php _e( 'Skip to content', 'seamless' ); ?></a></div>

		<div class="wrap">

			<?php do_atomic( 'open_menu_primary' ); // seamless_open_menu_primary ?>

			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'container_class' => 'menu', 'menu_class' => 'primary', 'menu_id' => 'menu-primary-items', 'fallback_cb' => '' ) ); ?>
			
			<?php do_atomic( 'close_menu_primary' ); // seamless_close_menu_primary ?>

		</div><!-- .wrap -->

	</nav><!-- #menu-primary .menu-container -->

	<?php do_atomic( 'after_menu_primary' ); // seamless_after_menu_primary ?>

<?php endif; ?>