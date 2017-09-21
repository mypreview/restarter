<?php
/**
 * Template for displaying search forms
 *
 * @author      Mahdi Yazdani
 * @package     Restarter
 * @since       1.0.0
 */
 ?>
<form method="get" id="searchform" class="search-box" action="<?php echo esc_url(home_url('/')); ?>">
	<label class="sr-only" for="s"><?php esc_html_e('Search for:', 'restarter'); ?></label>
	<input name="s" id="s" type="text" class="form-control" placeholder="<?php esc_attr_e('Search', 'restarter'); ?>" required="required" value="<?php echo get_search_query(); ?>" />
	<button type="submit"><i class="pe-7s-search"></i></button>
</form><!-- .search-box -->