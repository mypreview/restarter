<?php
/**
 * Display loop HTML wrapper start tag(s).
 *
 * @package 		Hooked into "restarter_before_loop"
 * @author  		Mahdi Yazdani
 * @package 		Restarter
 * @since 		    1.0.0
 */

if (is_active_sidebar('sidebar')):
?>
<!-- Container -->
<div id="restarter-container" class="container space-bottom-2x">
	<div class="row">
		<!-- Content -->
		<div class="col-lg-9 col-md-8 col-sm-7">
<?php else: ?>
<!-- Content -->
<div id="restarter-container" class="content-no-sidebar space-bottom-2x">
<?php endif;