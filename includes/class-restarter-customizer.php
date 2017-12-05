<?php
/**
 * Restarter Customizer.
 *
 * @author      Mahdi Yazdani
 * @package     Restarter
 * @since       1.1.5
 */
if (!defined('ABSPATH')):
    exit;
endif;
if (!class_exists('Restarter_Customizer')):
    /**
     * The setup Restarter class
     */
    class Restarter_Customizer

    {
        private $public_assets_url;
        private $admin_assets_url;
        /**
         * Setup class.
         *
         * @since 1.1.0
         */
        public function __construct()

        {
            $this->public_assets_url = esc_url(get_template_directory_uri() . '/assets/');
            $this->admin_assets_url = esc_url(get_template_directory_uri() . '/assets/admin/');
            add_action('customize_controls_enqueue_scripts', array(
                $this,
                'enqueue_customizer'
            ) , 0);
            add_action('customize_register', array(
                $this,
                'customize_register'
            ) , 10, 1);
        }
        /**
         * Enqueue scripts and styles.
         *
         * @since 1.1.4
         */
        public function enqueue_customizer()

        {
            wp_enqueue_style('feather-icons', $this->public_assets_url . 'css/vendor/feather-icons.css', array() , RESTARTER_THEME_VERSION);
            wp_enqueue_style('restarter-customizer-styles', $this->admin_assets_url . 'css/restarter-customizer.css', array() , RESTARTER_THEME_VERSION);
            wp_register_script('restarter-customizer-scripts', $this->admin_assets_url . 'js/restarter-customizer.js', array(
                'jquery'
            ) , RESTARTER_THEME_VERSION, true);
            wp_localize_script('restarter-customizer-scripts', 'restarter_customizer_vars', array(
                'toggle_controllers' => apply_filters('restarter_customizer_toggle_controllers', json_encode(array(
                    'restarter_jumbotron_btn_url_target',
                    'restarter_jumbotron_background_parallax',
                    'restarter_jumbotron_slider_loop',
                    'restarter_jumbotron_slider_autoplay'
                )))
            ));
            wp_enqueue_script('restarter-customizer-scripts');
        }
        /**
         * Theme Customizer along with several other settings.
         *
         * @param WP_Customize_Manager $wp_customize Theme Customizer object.
         * @since 1.1.5
         */
        public function customize_register($wp_customize)

        {
            require get_template_directory() . '/includes/class-restarter-customizer-custom-controls.php';

            /**
             * Site footer logo
             *
             * @since 1.0.0
             */
            $wp_customize->add_setting('restarter_footer_logo', array(
                'capability' => 'edit_theme_options',
                'sanitize_callback' => 'absint'
            ));
            $wp_customize->add_control(new WP_Customize_Cropped_Image_Control($wp_customize, 'restarter_footer_logo', array(
                'label' => __('Footer Logo', 'restarter') ,
                'section' => 'title_tagline',
                'settings' => 'restarter_footer_logo',
                'priority' => 9,
                'width' => 520,
                'height' => 208,
                'flex_width' => true,
                'flex-height' => false
            )));
            /**
             * "Jumbotron" panel
             *
             * @since 1.1.0
             */
            $wp_customize->add_panel('restarter_jumbotron_pnl', array(
                'title' => __('Jumbotron', 'restarter') ,
                'description' => __('A jumbotron indicates a big box for calling extra attention to some special content or information.', 'restarter') ,
                'capability' => 'edit_theme_options',
                'priority' => 30,
                'active_callback' => function ()
                {
                    if (Restarter::is_homepage_template()):
                        return true;
                    else:
                        return false;
                    endif;
                }
            ));
            /**
             * "Jumbotron" sections
             *
             * @since 1.1.0
             */
            $wp_customize->add_section('restarter_jumbotron_content_sec', array(
                'title' => __('Content', 'restarter') ,
                'panel' => 'restarter_jumbotron_pnl',
                'priority' => 10
            ));
            $wp_customize->add_section('restarter_jumbotron_device_sec', array(
                'title' => __('Device', 'restarter') ,
                'panel' => 'restarter_jumbotron_pnl',
                'priority' => 30
            ));
            $wp_customize->add_section('restarter_jumbotron_slider_sec', array(
                'title' => __('Slider', 'restarter') ,
                'panel' => 'restarter_jumbotron_pnl',
                'priority' => 40,
                'active_callback' => array(
                    $this,
                    'is_frame_carousel_layout'
                )
            ));
            $wp_customize->add_section('restarter_jumbotron_background_sec', array(
                'title' => __('Background', 'restarter') ,
                'panel' => 'restarter_jumbotron_pnl',
                'priority' => 60
            ));
            /**
             * "Jumbotron" panel
             * "Content" section
             * Heading
             *
             * @since 1.1.0
             */
            $wp_customize->add_setting('restarter_jumbotron_heading', array(
                'default' => apply_filters('restarter_jumbotron_heading_default_value', '') ,
                'capability' => 'edit_theme_options',
                'sanitize_callback' => 'sanitize_text_field'
            ));
            $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'restarter_jumbotron_heading', array(
                'label' => __('Heading', 'restarter') ,
                'description' => __('Enter text to be displayed in the jumbotron component header.', 'restarter') ,
                'section' => 'restarter_jumbotron_content_sec',
                'settings' => 'restarter_jumbotron_heading',
                'type' => 'text',
                'priority' => 10
            )));
            // Abort if selective refresh is not available.
            if (isset($wp_customize->selective_refresh)):
                $wp_customize->get_setting('restarter_jumbotron_heading')->transport = 'postMessage';
                $wp_customize->selective_refresh->add_partial('restarter_jumbotron_heading', array(
                    'selector' => '.restarter-jumbotron .heading',
                    'render_callback' => function ()
                    {
                        return esc_html(get_theme_mod('restarter_jumbotron_heading'));
                    }
                ));
            endif;
            /**
             * "Jumbotron" panel
             * "Content" section
             * Description
             *
             * @since 1.1.0
             */
            $wp_customize->add_setting('restarter_jumbotron_description', array(
                'default' => apply_filters('restarter_jumbotron_description_default_value', '') ,
                'capability' => 'edit_theme_options',
                'sanitize_callback' => 'wp_kses_post'
            ));
            $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'restarter_jumbotron_description', array(
                'label' => __('Description', 'restarter') ,
                'description' => __('Specify the text to be displayed in the jumbotron component content area. The output is processed with "wp_kses_post", which means you can insert HTML.', 'restarter') ,
                'section' => 'restarter_jumbotron_content_sec',
                'settings' => 'restarter_jumbotron_description',
                'type' => 'textarea',
                'priority' => 20,
                'active_callback' => array(
                    $this,
                    'is_frame_carousel_layout'
                )
            )));
            // Abort if selective refresh is not available.
            if (isset($wp_customize->selective_refresh)):
                $wp_customize->get_setting('restarter_jumbotron_description')->transport = 'postMessage';
                $wp_customize->selective_refresh->add_partial('restarter_jumbotron_description', array(
                    'selector' => '.restarter-jumbotron .description',
                    'render_callback' => function ()
                    {
                        return wp_kses_post(get_theme_mod('restarter_jumbotron_description'));
                    }
                ));
            endif;
            /**
             * "Jumbotron" panel
             * "Content" section
             * Button text
             *
             * @since 1.1.0
             */
            $wp_customize->add_setting('restarter_jumbotron_btn_txt', array(
                'default' => apply_filters('restarter_jumbotron_btn_txt_default_value', '') ,
                'capability' => 'edit_theme_options',
                'sanitize_callback' => 'sanitize_text_field'
            ));
            $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'restarter_jumbotron_btn_txt', array(
                'label' => __('Button Text', 'restarter') ,
                'description' => __('Specify the text displayed on the button in the jumbotron component. If this field is empty, no button will be displayed.', 'restarter') ,
                'section' => 'restarter_jumbotron_content_sec',
                'settings' => 'restarter_jumbotron_btn_txt',
                'type' => 'text',
                'priority' => 30,
                'active_callback' => array(
                    $this,
                    'is_frame_carousel_layout'
                )
            )));
            /**
             * "Jumbotron" panel
             * "Content" section
             * Button URL
             *
             * @since 1.1.0
             */
            $wp_customize->add_setting('restarter_jumbotron_btn_url', array(
                'default' => apply_filters('restarter_jumbotron_btn_url_default_value', '') ,
                'capability' => 'edit_theme_options',
                'sanitize_callback' => 'esc_url'
            ));
            $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'restarter_jumbotron_btn_url', array(
                'label' => __('Button URL', 'restarter') ,
                'description' => __('Specify the URL the button in the jumbotron component links to.', 'restarter') ,
                'section' => 'restarter_jumbotron_content_sec',
                'settings' => 'restarter_jumbotron_btn_url',
                'type' => 'url',
                'priority' => 40,
                'active_callback' => array(
                    $this,
                    'is_frame_carousel_layout'
                )
            )));
            /**
             * "Jumbotron" panel
             * "Content" section
             * URL target
             *
             * @since 1.1.0
             */
            $wp_customize->add_setting('restarter_jumbotron_btn_url_target', array(
                'default' => apply_filters('restarter_jumbotron_btn_url_target_default_value', false) ,
                'capability' => 'edit_theme_options',
                'sanitize_callback' => 'sanitize_text_field'
            ));
            $wp_customize->add_control(new Restarter_Toggle_Control($wp_customize, 'restarter_jumbotron_btn_url_target', array(
                'label' => __('URL Target', 'restarter') ,
                'description' => __('Specify if the linked document or page should open in a new window or tab.', 'restarter') ,
                'section' => 'restarter_jumbotron_content_sec',
                'settings' => 'restarter_jumbotron_btn_url_target',
                'priority' => 50,
                'active_callback' => array(
                    $this,
                    'is_frame_carousel_layout'
                )
            )));
            /**
             * "Jumbotron" panel
             * "Content" section
             * Button icon
             *
             * @since 1.1.0
             */
            $wp_customize->add_setting('restarter_jumbotron_btn_icon', array(
                'default' => apply_filters('restarter_jumbotron_btn_txt_default_value', 'icon-arrow-right') ,
                'capability' => 'edit_theme_options',
                'sanitize_callback' => 'sanitize_text_field'
            ));
            $wp_customize->add_control(new Restarter_Font_Icon_Control($wp_customize, 'restarter_jumbotron_btn_icon', array(
                'label' => __('Button Icon', 'restarter') ,
                'description' => __('Select an icon from the collection below.', 'restarter') ,
                'section' => 'restarter_jumbotron_content_sec',
                'settings' => 'restarter_jumbotron_btn_icon',
                'priority' => 60,
                'active_callback' => array(
                    $this,
                    'is_frame_carousel_layout'
                )
            )));
            /**
             * "Jumbotron" panel
             * "Content" section
             * Button icon float
             *
             * @since 1.1.0
             */
            $wp_customize->add_setting('restarter_jumbotron_btn_icon_float', array(
                'default' => apply_filters('restarter_jumbotron_btn_icon_float_default_value', 'right') ,
                'capability' => 'edit_theme_options',
                'sanitize_callback' => array(
                    $this,
                    'sanitize_choices'
                )
            ));
            $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'restarter_jumbotron_btn_icon_float', array(
                'label' => __('Button Icon Float', 'restarter') ,
                'description' => __('Specify the button icon float to the left or right side of the text.', 'restarter') ,
                'section' => 'restarter_jumbotron_content_sec',
                'settings' => 'restarter_jumbotron_btn_icon_float',
                'type' => 'select',
                'priority' => 70,
                'choices' => array(
                    'right' => __('Right', 'restarter') ,
                    'left' => __('Left', 'restarter')
                ) ,
                'active_callback' => array(
                    $this,
                    'is_frame_carousel_layout'
                )
            )));
            /**
             * "Jumbotron" panel
             * "Device" section
             * Device frame
             *
             * @since 1.1.0
             */
            $wp_customize->add_setting('restarter_jumbotron_frame_image', array(
                'default' => apply_filters('restarter_jumbotron_frame_image_default_value', '') ,
                'capability' => 'edit_theme_options',
                'sanitize_callback' => 'absint'
            ));
            $wp_customize->add_control(new WP_Customize_Cropped_Image_Control($wp_customize, 'restarter_jumbotron_frame_image', array(
                'label' => __('Device Frame', 'restarter') ,
                'description' => __('Use WordPress Media Uploader to upload and select an image from your computer or use an existing photo from your media library to create carousel within frame.', 'restarter') ,
                'section' => 'restarter_jumbotron_device_sec',
                'settings' => 'restarter_jumbotron_frame_image',
                'priority' => 10,
                'width' => 400,
                'height' => 762,
                'flex_width' => false,
                'flex-height' => false
            )));
            /**
             * "Jumbotron" panel
             * "Slider" section
             * Slider images
             *
             * @since 1.1.0
             */
            $wp_customize->add_setting('restarter_jumbotron_slider_images', array(
                'default' => apply_filters('restarter_jumbotron_slider_images_default_value', '') ,
                'capability' => 'edit_theme_options',
                'sanitize_callback' => 'sanitize_text_field'
            ));
            $wp_customize->add_control(new Restarter_Gallery_Control($wp_customize, 'restarter_jumbotron_slider_images', array(
                'label' => __('Slider Images', 'restarter') ,
                'description' => __('Use WordPress Media Uploader to upload and select multiple images from your computer or use existing photos from your media library.', 'restarter') ,
                'section' => 'restarter_jumbotron_slider_sec',
                'settings' => 'restarter_jumbotron_slider_images',
                'priority' => 20
            )));
            /**
             * "Jumbotron" panel
             * "Slider" section
             * Slider loop
             *
             * @since 1.1.5
             */
            $wp_customize->add_setting('restarter_jumbotron_slider_loop', array(
                'default' => apply_filters('restarter_jumbotron_slider_loop_default_value', false) ,
                'capability' => 'edit_theme_options',
                'sanitize_callback' => 'sanitize_text_field'
            ));
            $wp_customize->add_control(new Restarter_Toggle_Control($wp_customize, 'restarter_jumbotron_slider_loop', array(
                'label' => __('Loop', 'restarter') ,
                'description' => __('Infinity loop. Duplicate last and first items to get loop illusion.', 'restarter') ,
                'section' => 'restarter_jumbotron_slider_sec',
                'settings' => 'restarter_jumbotron_slider_loop',
                'priority' => 30
            )));
            /**
             * "Jumbotron" panel
             * "Slider" section
             * Slider autoplay
             *
             * @since 1.1.0
             */
            $wp_customize->add_setting('restarter_jumbotron_slider_autoplay', array(
                'default' => apply_filters('restarter_jumbotron_slider_autoplay_default_value', true) ,
                'capability' => 'edit_theme_options',
                'sanitize_callback' => 'sanitize_text_field'
            ));
            $wp_customize->add_control(new Restarter_Toggle_Control($wp_customize, 'restarter_jumbotron_slider_autoplay', array(
                'label' => __('Autoplay', 'restarter') ,
                'description' => __('Slider can switch its slides automatically.', 'restarter') ,
                'section' => 'restarter_jumbotron_slider_sec',
                'settings' => 'restarter_jumbotron_slider_autoplay',
                'priority' => 40
            )));
            /**
             * "Jumbotron" panel
             * "Slider" section
             * Slider interval
             *
             * @since 1.1.0
             */
            $wp_customize->add_setting('restarter_jumbotron_slider_interval', array(
                'default' => apply_filters('restarter_jumbotron_slider_interval_default_value', 4000) ,
                'capability' => 'edit_theme_options',
                'sanitize_callback' => 'absint'
            ));
            $wp_customize->add_control(new Restarter_Range_Control($wp_customize, 'restarter_jumbotron_slider_interval', array(
                'label' => __('Autoplay Timeout', 'restarter') ,
                'description' => __('Autoplay interval timeout (Delay) between slides.', 'restarter') ,
                'section' => 'restarter_jumbotron_slider_sec',
                'settings' => 'restarter_jumbotron_slider_interval',
                'priority' => 50,
                'input_attrs' => array(
                    'min' => 1000,
                    'max' => 10000,
                    'step' => 100,
                ) ,
                'active_callback' => array(
                    $this,
                    'is_autoplay_enabled'
                )
            )));
            /**
             * "Jumbotron" panel
             * "Background" section
             * Background image
             *
             * @since 1.1.0
             */
            $wp_customize->add_setting('restarter_jumbotron_background_image', array(
                'default' => '',
                'capability' => 'edit_theme_options',
                'sanitize_callback' => 'absint'
            ));
            $wp_customize->add_control(new WP_Customize_Cropped_Image_Control($wp_customize, 'restarter_jumbotron_background_image', array(
                'label' => __('Background Image', 'restarter') ,
                'section' => 'restarter_jumbotron_background_sec',
                'settings' => 'restarter_jumbotron_background_image',
                'priority' => 10,
                'width' => 1920,
                'height' => 1150,
                'flex_width' => false,
                'flex-height' => true
            )));
            /**
             * "Jumbotron" panel
             * "Background" section
             * Background parallax effect
             *
             * @since 1.1.0
             */
            $wp_customize->add_setting('restarter_jumbotron_background_parallax', array(
                'default' => apply_filters('restarter_jumbotron_background_parallax_default_value', 'on') ,
                'capability' => 'edit_theme_options',
                'sanitize_callback' => 'sanitize_text_field'
            ));
            $wp_customize->add_control(new Restarter_Toggle_Control($wp_customize, 'restarter_jumbotron_background_parallax', array(
                'label' => __('Parallax Effect', 'restarter') ,
                'description' => __('Toggle the parallax effect applied to the background image. If no background image is set, this setting does nothing.', 'restarter') ,
                'section' => 'restarter_jumbotron_background_sec',
                'settings' => 'restarter_jumbotron_background_parallax',
                'priority' => 20
            )));
            /**
             * "Jumbotron" panel
             * "Background" section
             * Background parallax scroll speed
             *
             * @since 1.1.0
             */
            $wp_customize->add_setting('restarter_jumbotron_background_parallax_scroll_speed', array(
                'default' => apply_filters('restarter_jumbotron_background_parallax_scroll_speed_default_value', 5) ,
                'capability' => 'edit_theme_options',
                'sanitize_callback' => 'absint'
            ));
            $wp_customize->add_control(new Restarter_Range_Control($wp_customize, 'restarter_jumbotron_background_parallax_scroll_speed', array(
                'label' => __('Parallax Scroll Speed', 'restarter') ,
                'description' => __('If you want the background image to reposition on scroll, Lower down the following attribute. The ratio is relative to the natural scroll speed.', 'restarter') ,
                'section' => 'restarter_jumbotron_background_sec',
                'settings' => 'restarter_jumbotron_background_parallax_scroll_speed',
                'priority' => 30,
                'input_attrs' => array(
                    'min' => 0,
                    'max' => 10,
                    'step' => 1,
                    'suffix' => ''
                ) ,
                'active_callback' => array(
                    $this,
                    'is_background_parallax_enabled'
                )
            )));
            /**
             * "Jumbotron" panel
             * "Background" section
             * Overlay opacity
             *
             * @since 1.1.0
             */
            $wp_customize->add_setting('restarter_jumbotron_background_overlay_opacity', array(
                'default' => apply_filters('restarter_jumbotron_background_overlay_opacity_default_value', 8) ,
                'capability' => 'edit_theme_options',
                'sanitize_callback' => 'absint'
            ));
            $wp_customize->add_control(new Restarter_Range_Control($wp_customize, 'restarter_jumbotron_background_overlay_opacity', array(
                'label' => __('Overlay Opacity', 'restarter') ,
                'description' => __('Specify the overlay opacity. This setting is useful if you are using a visually noisy background image and finding the text in your jumbotron component difficult to read.', 'restarter') ,
                'section' => 'restarter_jumbotron_background_sec',
                'settings' => 'restarter_jumbotron_background_overlay_opacity',
                'priority' => 40,
                'input_attrs' => array(
                    'min' => 0,
                    'max' => 10,
                    'step' => 1,
                )
            )));
            /**
             * "Layout" section
             *
             * @since 1.1.0
             */
            $wp_customize->add_section('restarter_layout_sec', array(
                'title' => __('Layout', 'restarter') ,
                'capability' => 'edit_theme_options',
                'priority' => 50
            ));
            /**
             * "Layout" section
             * Layout
             *
             * @since 1.1.0
             */
            $wp_customize->add_setting('restarter_layout_sidebar', array(
                'default' => apply_filters('restarter_layout_sidebar_default_value', 'right') ,
                'capability' => 'edit_theme_options',
                'sanitize_callback' => array(
                    $this,
                    'sanitize_choices'
                )
            ));
            $wp_customize->add_control(new Restarter_Radio_Image_Control($wp_customize, 'restarter_layout_sidebar', array(
                'label' => __('General Layout', 'restarter') ,
                'description' => __('Reposition sidebar area from right to left or vice versa.', 'restarter') ,
                'section' => 'restarter_layout_sec',
                'settings' => 'restarter_layout_sidebar',
                'priority' => 10,
                'choices' => array(
                    'left' => $this->admin_assets_url . '/img/left-sidebar.png',
                    'right' => $this->admin_assets_url . '/img/right-sidebar.png',
                )
            )));
            /**
             * "Go Plus" section
             * Go Plus button
             *
             * @since 1.1.0
             */
            $wp_customize->register_section_type('Restarter_Go_Plus_Control');
            $wp_customize->add_section(new Restarter_Go_Plus_Control($wp_customize, 'restarter_go_plus_control', array(
                'title' => __('Restater Plus', 'restarter') ,
                'go_plus_text' => __('Upgrade Now!', 'restarter') ,
                'go_plus_url' => esc_url(RESTARTER_THEME_URI)
            )));
        }
        /**
         * Sanitizes choices (selects/radios)
         * Checks that the input matches one of the available choices
         *
         * @since 1.1.0
         */
        public function sanitize_choices($input, $setting)

        {
            // Ensure input is a slug.
            $input = sanitize_key($input);
            // Get list of choices from the control associated with the setting.
            $choices = $setting->manager->get_control($setting->id)->choices;
            // If the input is a valid key, return it; otherwise, return the default.
            return (array_key_exists($input, $choices) ? $input : $setting->default);
        }
        /**
         * Parallax scroll speed callback.
         *
         * @since 1.1.0
         */
        public function is_background_parallax_enabled($control)

        {
            return $control->manager->get_setting('restarter_jumbotron_background_parallax')->value() ? true : false;
        }
        /**
         * Slider autoplay callback.
         *
         * @since 1.1.0
         */
        public function is_autoplay_enabled($control)

        {
            return $control->manager->get_setting('restarter_jumbotron_slider_autoplay')->value() ? true : false;
        }
        /**
         * Is frame carousel layout selected?
         *
         * @since 1.1.0
         */
        public function is_frame_carousel_layout($control)

        {
            if ((!class_exists('Restarter_Plus_Jumbotron')) || (class_exists('Restarter_Plus_Jumbotron') && $control->manager->get_setting('restarter_plus_jumbotron_layout')->value() === 'frame_carousel')):
                return true;
            endif;
            return false;
        }
        /**
         * Enqueue scripts and styles.
         *
         * @since 1.1.0
         */
        public static function inline_style()

        {
            $jumbotron_overlay_opacity = absint(get_theme_mod('restarter_jumbotron_background_overlay_opacity', 8));
            $jumbotron_overlay_opacity = (int)$jumbotron_overlay_opacity / 10;
            $customizer_css = apply_filters('restarter_customizer_custom_css', "
                .restarter-jumbotron .overlay{
                    opacity: {$jumbotron_overlay_opacity};
            }");
            return (!empty($customizer_css)) ? wp_strip_all_tags($customizer_css, false) : '';
        }
        /**
         * Return an array of feather font icons
         *
         * @since 1.1.0
         */
        public static function get_font_icons()

        {
            $font_icons = '';
            $font_icons = array(
                'icon-eye','icon-paper-clip','icon-mail','icon-toggle','icon-layout','icon-link','icon-bell','icon-lock','icon-unlock','icon-ribbon','icon-image','icon-signal','icon-target','icon-clipboard','icon-clock','icon-watch','icon-air-play','icon-camera','icon-video','icon-disc','icon-printer','icon-monitor','icon-server','icon-cog','icon-heart','icon-paragraph','icon-align-justify','icon-align-left','icon-align-center','icon-align-right','icon-book','icon-layers','icon-stack','icon-stack-2','icon-paper','icon-paper-stack','icon-search','icon-zoom-in','icon-zoom-out','icon-reply','icon-circle-plus','icon-circle-minus','icon-circle-check','icon-circle-cross','icon-square-plus','icon-square-minus','icon-square-check','icon-square-cross','icon-microphone','icon-record','icon-skip-back','icon-rewind','icon-play','icon-pause','icon-stop','icon-fast-forward','icon-skip-forward','icon-shuffle','icon-repeat','icon-folder','icon-umbrella','icon-moon','icon-thermometer','icon-drop','icon-sun','icon-cloud','icon-cloud-upload','icon-cloud-download','icon-upload','icon-download','icon-location','icon-location-2','icon-map','icon-battery','icon-head','icon-briefcase','icon-speech-bubble','icon-anchor','icon-globe','icon-box','icon-reload','icon-share','icon-marquee','icon-marquee-plus','icon-marquee-minus','icon-tag','icon-power','icon-command','icon-alt','icon-esc','icon-bar-graph','icon-bar-graph-2','icon-pie-graph','icon-star','icon-arrow-left','icon-arrow-right','icon-arrow-up','icon-arrow-down','icon-volume','icon-mute','icon-content-right','icon-content-left','icon-grid','icon-grid-2','icon-columns','icon-loader','icon-bag','icon-ban','icon-flag','icon-trash','icon-expand','icon-contract','icon-maximize','icon-minimize','icon-plus','icon-minus','icon-check','icon-cross','icon-move','icon-delete','icon-menu','icon-archive','icon-inbox','icon-outbox','icon-file','icon-file-add','icon-file-subtract','icon-help','icon-open','icon-ellipsis'
            );
            return apply_filters('restarter_customizer_font_icons', $font_icons);
        }
	}
endif;
return new Restarter_Customizer();