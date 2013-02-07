<?php
/**
 * subsidiary Menu Template
 *
 * Displays the subsidiary Menu if it has active menu items.
 *
 * @package Seamless
 * @subpackage Template
 */

if ( has_nav_menu( 'subsidiary' ) ) : ?>

	<?php do_atomic( 'before_menu_primary' ); // seamless_before_menu_primary ?>

	<nav id="menu-subsidiary" role="navigation" class="subsidiary-navigation site-navigation">
		<h1 class="assistive-text"><?php _e( 'Navigation', 'seamless' ); ?></h1>
		<div class="assistive-text skip-link"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'seamless' ); ?>"><?php _e( 'Skip to content', 'seamless' ); ?></a></div>

		<div class="wrap">

			<?php do_atomic( 'open_menu_primary' ); // seamless_open_menu_primary ?>

			<?php wp_nav_menu( array( 'theme_location' => 'subsidiary', 'container_class' => 'menu', 'menu_class' => '', 'menu_id' => 'menu-subsidiary-items', 'depth' => 1, 'fallback_cb' => '' ) ); ?>
			
			<?php do_atomic( 'close_menu_primary' ); // seamles_sclose_menu_primary ?>

		</div><!-- .wrap -->

	</nav><!-- #menu-subsidiary .menu-container -->

	<?php do_atomic( 'after_menu_primary' ); // seamless_after_menu_primary ?>

<?php endif; ?>