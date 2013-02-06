<?php
/**
 * Secondary Sidebar Template
 *
 * Displays widgets for the Secondary dynamic sidebar if any have been added to the sidebar through the 
 * widgets screen in the admin by the user.  Otherwise, nothing is displayed.
 *
 * @package Seamless
 * @subpackage Template
 */

if ( is_active_sidebar( 'secondary' ) ) : ?>

	<div id="sidebar-secondary" class="sidebar" role="complementary">

		<?php dynamic_sidebar( 'secondary' ); ?>

	</div><!-- #sidebar-secondary .aside -->

<?php endif; ?>