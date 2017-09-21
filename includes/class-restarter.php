<?php
/**
 * Theme setup and custom theme supports.
 *
 * @author  	Mahdi Yazdani
 * @package 	Restarter
 * @since 	    1.0.0
 */
if (!defined('ABSPATH')):
	exit;
endif;
if (!class_exists('Restarter')):
	/**
	 * The setup Restarter class
	 */
	class Restarter

	{
		private $public_assets_url;
		/**
		 * Setup class.
		 *
		 * @since 1.0.0
		 */
		public function __construct()

		{
			$this->public_assets_url = esc_url(get_template_directory_uri() . '/assets/');
			add_filter('show_recent_comments_widget_style', '__return_false');
			add_action('after_setup_theme', array(
				$this,
				'setup'
			) , 10);
			add_action('wp_enqueue_scripts', array(
				$this,
				'enqueue'
			) , 10);
			add_action('widgets_init', array(
				$this,
				'widgets'
			) , 10);
			add_action('wp_enqueue_scripts', array(
				$this,
				'child_scripts'
			) , 30);
			add_action('wp_head', array(
				$this,
				'javascript_detection'
			) , 0);
			add_action('wp_head', array(
				$this,
				'pingback_header'
			) , 10);
			add_filter('body_class', array(
				$this,
				'body_classes'
			) , 10);
			add_filter('adjust_body_class', array(
				$this,
				'adjust_body_class'
			) , 10);
			add_filter('get_custom_logo', array(
				$this,
				'change_logo_class'
			) , 10);
			add_filter('excerpt_length', array(
				$this,
				'custom_excerpt_length'
			) , 10, 1);
			add_filter('excerpt_more', array(
				$this,
				'custom_excerpt_more'
			) , 10, 1);
			add_filter('walker_nav_menu_start_el', array(
				$this,
				'nav_menu_social_icons'
			) , 10, 4);
			add_filter('previous_posts_link_attributes', array(
				$this,
				'prev_posts_link_cls'
			) , 10, 1);
			add_filter('next_posts_link_attributes', array(
				$this,
				'next_posts_link_cls'
			) , 10, 1);
			add_filter('wp_list_categories', array(
				$this,
				'cat_count_span'
			) , 10, 1);
			add_filter('get_archives_link', array(
				$this,
				'archive_count_span'
			) , 10, 1);
			add_filter('wp_tag_cloud', array(
				$this,
				'tagcloud_remove_parentheses'
			) , 10, 1);
			add_filter('comment_form_fields', array(
				$this,
				'move_comment_field_to_bottom'
			) , 10, 1);
		}
		/**
		 * Sets up theme defaults and registers support for various WordPress features.
		 *
		 * Note that this function is hooked into the after_setup_theme hook, which
		 * runs before the init hook. The init hook is too late for some features, such
		 * as indicating support for post thumbnails.
		 *
		 * @since 1.0.0
		 */
		public function setup()

		{
			/**
			 * Set the content width based on the theme's design and stylesheet.
			 */
			if (!isset($content_width))
			{
				$content_width = apply_filters('restarter_content_width', 1920); /* pixels */
			}
			/*
			* Make theme available for translation.
			* Translations can be filed in the /languages/ directory.
			* If you're building a theme based on restarter, use a find and replace
			* to change 'restarter' to the name of your theme in all the template files
			*/
			// Loads wp-content/languages/themes/restarter-it_IT.mo.
			load_theme_textdomain('restarter', trailingslashit(WP_LANG_DIR) . 'themes/');
			// Loads wp-content/themes/child-theme-name/languages/it_IT.mo.
			load_theme_textdomain('restarter', get_stylesheet_directory() . '/languages');
			// Loads wp-content/themes/restarter/languages/it_IT.mo.
			load_theme_textdomain('restarter', get_template_directory() . '/languages');
			// Add default posts and comments RSS feed links to head.
			add_theme_support('automatic-feed-links');
			/*
			* Let WordPress manage the document title.
			* By adding theme support, we declare that this theme does not use a
			* hard-coded <title> tag in the document head, and expect WordPress to
			* provide it for us.
			*/
			add_theme_support('title-tag');
			/*
			* Enable support for Post Thumbnails on posts and pages.
			*
			* @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
			*/
			add_theme_support('post-thumbnails');
			// This theme uses wp_nav_menu() in one location.
			register_nav_menus(array(
				'primary' => __('Primary', 'restarter') ,
				'footer' => __('Footer', 'restarter') ,
				'header-social-links' => __('Header Social Links', 'restarter') ,
				'footer-social-links' => __('Footer Social Links', 'restarter')
			));
			/*
			* Switch default core markup for search form, comment form, comments, galleries, captions and widgets
			* to output valid HTML5.
			*/
			add_theme_support('html5', array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'widgets'
			));
			/*
			* Enable support for Post Formats.
			*
			* See: https://codex.wordpress.org/Post_Formats
			*/
			add_theme_support('post-formats', array(
				'image',
				'video',
				'quote',
				'gallery'
			));
			/**
			 * Enable support for site logo
			 */
			add_theme_support('custom-logo', array(
			    'width' => 520,
				'height' => 208,
				'flex_width'  => true,
				'flex-height' => false
			));
			/**
			 *  Add support for the Site Logo plugin and the site logo functionality in JetPack
			 *  https://github.com/automattic/site-logo
			 *  http://jetpack.me/
			 */
			add_theme_support('site-logo', array(
				'size' => 'full'
			));
			// Setup the WordPress core custom header feature.
			add_theme_support('custom-header', apply_filters('restarter_custom_header_args', array(
				'default-image' => '',
				'header-text' => false,
				'width' => 1920,
				'height' => 650,
				'flex_width'  => true, 
			    'flex_height' => false
			)));
			// Setup the WordPress core custom background feature.
			add_theme_support('custom-background', apply_filters('restarter_custom_background_args', array(
				'default-color' => '#f3f3f3'
			)));
			// Declare support for selective refreshing of widgets.
			add_theme_support('customize-selective-refresh-widgets');
			/**
			 *  This theme styles the visual editor to resemble the theme style,
			 *  specifically font, colors, icons, and column width.
			 */
			add_editor_style(array(
				get_stylesheet_directory_uri() . '/assets/css/editor-style.css',
				add_query_arg(apply_filters('restarter_default_font_family', array(
					'family' => urlencode('Lato:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i') ,
					'subset' => urlencode('latin,latin-ext')
				)) , 'https://fonts.googleapis.com/css')
			));
		}
		/**
		 * Enqueue scripts and styles.
		 *
		 * @since 1.0.0
		 */
		public function enqueue()

		{
			$is_customize_preview = false;
			if (is_customize_preview()):
				$is_customize_preview = true;
			endif;
			wp_enqueue_style('restarter-font', add_query_arg(apply_filters('restarter_default_font_family', array(
				'family' => urlencode('Lato:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i') ,
				'subset' => urlencode('latin,latin-ext')
			)) , 'https://fonts.googleapis.com/css') , array() , RestarterThemeVersion);
			wp_enqueue_style('restarter-styles', $this->public_assets_url . 'css/restarter-core.min.css', array() , RestarterThemeVersion);
			wp_enqueue_style('restarter-theme-styles', $this->public_assets_url . 'css/restarter.css', array() , RestarterThemeVersion);
			wp_enqueue_script('jquery');
			wp_register_script('restarter-scripts', $this->public_assets_url . 'js/restarter-core.min.js', array(
				'jquery'
			) , RestarterThemeVersion, true);
			wp_localize_script('restarter-scripts', 'restarter_core_vars', array(
				'is_customize_preview' => (bool) $is_customize_preview ,
			));
			wp_enqueue_script('restarter-scripts');
			wp_register_script('restarter-theme-scripts', $this->public_assets_url . 'js/restarter.js', array(
				'jquery',
				'restarter-scripts'
			) , RestarterThemeVersion, true);
			wp_localize_script('restarter-theme-scripts', 'restarter_vars', array(
				'ajaxurl' => admin_url('admin-ajax.php') ,
				'security' => wp_create_nonce('restarter_theme_nonce') ,
				'gallery_loop' => apply_filters('restarter_gallery_post_format_loop', true) ,
				'gallery_autoplay' => apply_filters('restarter_gallery_post_format_loop', true) ,
				'gallery_timeout' => apply_filters('restarter_gallery_post_format_timeout', 5000) ,
				'gallery_auto_height' => apply_filters('restarter_gallery_post_format_auto_height', false) ,
				'gallery_dots' => apply_filters('restarter_gallery_post_format_dots', false) ,
			));
			wp_enqueue_script('restarter-theme-scripts');
			if (is_singular() && comments_open() && get_option('thread_comments')):
				wp_enqueue_script('comment-reply');
			endif;
		}
		/**
		 * Declaring widget(s) and widget area(s).
		 *
		 * @see https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
		 * @since 1.0.0
		 */
		public function widgets()

		{
			register_sidebar(apply_filters('restarter_widget_markup_args', array(
				'name' => esc_html__('Sidebar', 'restarter') ,
				'id' => 'sidebar',
				'description' => esc_html__('Widgets added to this region will appear in blog archive pages.', 'restarter') ,
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget' => '</section>',
				'before_title' => '<h3 class="widget-title">',
				'after_title' => '</h3>',
			)));
		}
		/**
		 * Enqueue child theme stylesheet.
		 * A separate function is required as the child theme css needs to be enqueued _after_ the parent theme
		 * primary css and the separate WooCommerce css.
		 *
		 * @since 1.0.0
		 */
		public function child_scripts()

		{
			if (is_child_theme()):
				wp_enqueue_style('restarter-child-style', get_stylesheet_uri() , '');
			endif;
		}
		/**
		 * Handles JavaScript detection.
		 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
		 *
		 * @since 1.0.0
		 */
		public function javascript_detection()

		{
			echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
		}
		/**
		 * Add a pingback url auto-discovery header for singularly identifiable articles.
		 *
		 * @since 1.0.0
		 */
		public function pingback_header()

		{
			if (is_singular() && pings_open()):
				printf('<link rel="pingback" href="%s">' . "\n", get_bloginfo('pingback_url'));
			endif;
		}
		/**
		 * Adds custom classes to the array of body classes.
		 *
		 * @since 1.0.0
		 */
		public function body_classes($classes)

		{
			// Adds a class of group-blog to blogs with more than 1 published author.
			if (is_multi_author()):
				$classes[] = 'group-blog';
			endif;
			// Adds a class of hfeed to non-singular pages.
			if (!is_singular()):
				$classes[] = 'hfeed';
			endif;
			// Enabling/disabling background parallax effect.
			if (apply_filters('restarter_body_parallax', true)):
				$classes[] = 'parallax';
			endif;
			// Used for page preloading animation.
			if (apply_filters('restarter_preloader', true) && ! is_customize_preview()):
				$classes[] = 'is-preloader';
			endif;
			return $classes;
		}
		/**
		 * Adds custom classes to the array of body classes.
		 *
		 * @since 1.0.0
		 */
		public function adjust_body_class($classes)

		{
			foreach($classes as $key => $value):
				if ($value == 'tag'):
					unset($classes[$key]);
				endif;
			endforeach;
			return $classes;
		}
		/**
		 * Replaces logo CSS class.
		 *
		 * @since 1.0.0
		 */
		public function change_logo_class($html)

		{
			$html = str_replace('class="custom-logo"', 'class="img-responsive"', $html);
			$html = str_replace('class="custom-logo-link"', 'class="site-logo custom-logo-link"', $html);
			return $html;
		}
		/**
		 * Control Excerpt Length Using Filters.
		 *
		 * @since 1.0.0
		 */
		public function custom_excerpt_length($length)

		{
			return apply_filters('restarter_excerpt_length', 55);
		}
		/**
		 * Adds the ... to the end of excerpt read more link.
		 *
		 * @since 1.0.0
		 */
		public function custom_excerpt_more($more)

		{
			return apply_filters('restarter_excerpt_more', '...');
		}
		/**
		 * Display font icons in social links menu.
		 *
		 * @since 1.0.0
		 */
		public function nav_menu_social_icons($item_output, $item, $depth, $args)

		{
			$social_icons = $this->get_social_links_icons();
			$title_display = false;
			// Change SVG icon inside social links menu if there is supported URL.
			if ('header-social-links' === $args->theme_location || 'footer-social-links' === $args->theme_location):
				if ($args->menu_class === 'dropdown'):
					$title_display = true;
				endif;
				foreach((array) $social_icons as $attr => $value):
					if (false !== strpos($item_output, $attr)):
						$item_output = str_replace($args->link_after, '</span>' . $this->get_icons_markup(array(
							'icon' => esc_attr($value),
							'title' => esc_attr($item->title),
							'title_display' => $title_display
						)) , $item_output);
					endif;
				endforeach;
			endif;
			return $item_output;
		}
		/**
		 * Return font icon HTML markup.
		 *
		 * @since 1.0.0
		 */
		public static function get_icons_markup($args = array())

		{
			// Make sure $args are an array.
			if (empty($args)):
				return __('Please define default parameters in the form of an array.', 'restarter');
			endif;
			// Set defaults.
			$defaults = array(
				'icon' => '',
				'title' => '',
				'title_display' => false,
				'aria_hidden' => true, // Hide from screen readers.
				'fallback' => false,
			);
			$tooltip = '';
			// Parse args.
			$args = wp_parse_args($args, $defaults);
			// Set aria hidden.
			$aria_hidden = '';
			if (true === $args['aria_hidden']):
				$aria_hidden = ' aria-hidden="true"';
			endif;
			// Begin font icon HTML markup.
			$icon = '<span class="sb-' . esc_attr($args['icon']) . '"' . $aria_hidden . '';
			// If there is a title, display it.
			if ($args['title'] && ! $args['title_display']):
				$icon.= ' data-toggle="tooltip" data-placement="top" title="' . esc_attr($args['title']) . '"';
			endif;
			$icon.= '><i class="fa fa-' . esc_attr($args['icon']) . '"></i>';
			// If there is a link title, display it.
			if ($args['title_display']):
				$icon.= esc_attr($args['title']);
			endif;
			$icon.= '</span>';
			return $icon;
		}
		/**
		 * Returns an array of supported social links (URL and icon name).
		 *
		 * @since 1.0.0
		 */
		private function get_social_links_icons()

		{
			$social_links_icons = array(
				'behance.net'     => 'behance',
				'codepen.io'      => 'codepen',
				'deviantart.com'  => 'deviantart',
				'digg.com'        => 'digg',
				'dribbble.com'    => 'dribbble',
				'dropbox.com'     => 'dropbox',
				'facebook.com'    => 'facebook',
				'flickr.com'      => 'flickr',
				'foursquare.com'  => 'foursquare',
				'plus.google.com' => 'google-plus',
				'github.com'      => 'github',
				'instagram.com'   => 'instagram',
				'linkedin.com'    => 'linkedin',
				'mailto:'         => 'envelope-o',
				'medium.com'      => 'medium',
				'path.com'        => 'path',
				'pinterest.com'   => 'pinterest-p',
				'getpocket.com'   => 'get-pocket',
				'polldaddy.com'   => 'polldaddy',
				'reddit.com'      => 'reddit-alien',
				'skype.com'       => 'skype',
				'skype:'          => 'skype',
				'slideshare.net'  => 'slideshare',
				'snapchat.com'    => 'snapchat-ghost',
				'soundcloud.com'  => 'soundcloud',
				'spotify.com'     => 'spotify',
				'stumbleupon.com' => 'stumbleupon',
				'tumblr.com'      => 'tumblr',
				'twitch.tv'       => 'twitch',
				'twitter.com'     => 'twitter',
				'vimeo.com'       => 'vimeo',
				'vine.co'         => 'vine',
				'vk.com'          => 'vk',
				'wordpress.org'   => 'wordpress',
				'wordpress.com'   => 'wordpress',
				'yelp.com'        => 'yelp',
				'youtube.com'     => 'youtube',
			);
			return apply_filters('restarter_social_links_icons', $social_links_icons);
		}
		/**
		 * Append CSS class name to prev page link.
		 *
		 * @since 1.0.0
		 */
		public function prev_posts_link_cls($cls)

		{
			$class = 'class="prev page-numbers"';
			return $class;
		}
		/**
		 * Append CSS class name to prev next link.
		 *
		 * @since 1.0.0
		 */
		public function next_posts_link_cls($cls)

		{
			$class = 'class="next page-numbers"';
			return $class;
		}
		/**
		 * Adds a span around post counts in category widget.
		 *
		 * @since 1.0.0
		 */
		public function cat_count_span($links)

		{
			$links = str_replace('</a> (', '<span class="count">', $links);
			$links = str_replace(')', '</span></a>', $links);
			return $links;
		}
		/**
		 * Adds a span around post counts in archive widget.
		 *
		 * @since 1.0.0
		 */
		public function archive_count_span($links)

		{
			$links = str_replace('</a>&nbsp;(', '<span class="count">', $links);
			$links = str_replace(')', '</span></a>', $links);
			return $links;
		}
		/**
		 * Remove parentheses from tag cloud count.
		 *
		 * @since 1.0.0
		 */
		public function tagcloud_remove_parentheses($links)

		{
			$links = str_replace('<span class="tag-link-count"> (', '<span class="tag-link-count">', $links);
			$links = str_replace(')</span>', '</span>', $links);
			return $links;
		}
		/**
		 * Moving the comment text field to bottom.
		 *
		 * @since 1.0.0
		 */
		public function move_comment_field_to_bottom($fields)

		{
			$comment_field = $fields['comment'];
			unset($fields['comment']);
			$fields['comment'] = $comment_field;
			return $fields;
		}
		/**
		 * Display the breadcrumbs for the current page.
		 *
		 * @since 1.0.0
		 */
		public static function the_breadcrumb()

		{
			if (!is_home()):
				?>
				<a href="<?php echo esc_url(home_url()); ?>" target="_self"><?php esc_html_e('Home', 'restarter'); ?></a>
				<?php
				if (is_category() && ! is_single()):
					single_cat_title('<span>', '</span>');
				elseif (is_page()):
					the_title('<span>', '</span>');
				elseif (is_single()):
					$categories = get_categories();
					if (is_array($categories) && ! empty($categories)):
						foreach ((array) $categories as $category):
							$category_id = absint($category->term_id);
						?>
						<a href="<?php echo esc_url(get_category_link($category_id)); ?>" target="_self"><?php echo esc_html($category->name); ?></a>
						<?php
						endforeach;
					endif;
					the_title('<span>', '</span>');
				elseif (is_day()):
				?>
				<span>
					<?php 
					esc_html_e('Archive for ', 'restarter');
					the_time('F jS, Y'); 
					?>
				</span>
				<?php elseif (is_month()): ?>
				<span>
					<?php 
					esc_html_e('Archive for ', 'restarter');
					the_time('F, Y'); 
					?>
				</span>
				<?php elseif (is_year()): ?>
				<span>
					<?php 
					esc_html_e('Archive for ', 'restarter');
					the_time('Y'); 
					?>
				</span>
				<?php elseif (is_search()): ?>
				<span>
					<?php 
					esc_html_e('Search results for ', 'restarter');
					echo esc_html(wp_unslash($_GET['s'])); 
					?>
				</span>
				<?php
				elseif (is_tag()):
					single_tag_title('<span>', '</span>');
				endif;
			endif;
		}
		/**
		 * Print HTML with date for current post.
		 *
		 * @since 1.0.0
		 */
		public static function entry_date($echo = true)

		{
			$format_prefix = '%2$s';
			$date = sprintf('<span class="post-date"><a href="%1$s" rel="bookmark"><time class="entry-date" datetime="%2$s">%3$s</time></a></span><!-- .post-date -->', esc_url(get_permalink()) , esc_attr(get_the_date('c')) , esc_html(sprintf($format_prefix, get_post_format_string(get_post_format()) , get_the_date())));
			if ($echo && get_post_type() === 'post'):
				echo $date;
			endif;
			return $date;
		}
		/**
		 * Determines whether or not the current post is a paginated post.
		 *
		 * @since 1.0.0
		 */
		public static function is_paginated()

		{
			global $multipage;
			return 0 !== $multipage;
		}
		/**
		 * Comments list template.
		 *
		 * @since 1.0.0
		 */
		public static function comments_list($comment, $args, $depth)

		{
			?>
			<li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
				<div class="inner">
					<div class="comment-author-ava">
						<?php echo get_avatar($comment, 160); ?>
					</div><!-- .comment-author-ava -->
					<div class="comment-body">
						<div class="comment-meta">
							<div class="column">
								<h4 class="comment-author-name" itemprop="author">
									<?php 
									$get_comment_author_url = get_comment_author_url($comment);
									if (! empty($get_comment_author_url)):
									?>
									<a href="<?php echo esc_url($get_comment_author_url); ?>" target="_blank" rel="external nofollow">
										<?php echo esc_html(get_comment_author($comment)); ?>
									</a>
									<?php
									else:
										echo esc_html(get_comment_author($comment));
									endif; 
									?>
								</h4>
							</div><!-- .column -->
							<div class="column">
								<span class="comment-date">
									<time datetime="<?php echo esc_attr(get_comment_date('c')); ?>"><?php echo esc_html(get_comment_date()); ?></time>
								</span>
								<?php
								comment_reply_link(array_merge($args, array(
		                            'reply_text' => sprintf(__('%s Reply', 'restarter'), '<i class="pe-7s-back"></i>'),
		                            'depth' => $depth,
		                            'max_depth' => $args['max_depth']
		                        )));
								?>
							</div><!-- .column -->
						</div><!-- .comment-meta -->
						<?php
						comment_text($comment);
						if ('0' == $comment->comment_approved):
						?>
						<em class="restarter-comment-awaiting-moderation">
							<?php esc_html_e('Your comment is awaiting moderation.', 'restarter'); ?>
						</em><!-- .restarter-comment-awaiting-moderation -->
						<?php endif; ?>
					</div><!-- .comment-body -->
				</div><!-- .inner -->
			<?php
		}
	}
endif;
return new Restarter();