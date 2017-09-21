<?php
/**
 * Restarter Customizer.
 *
 * @author  	Mahdi Yazdani
 * @package 	Restarter
 * @since 	    1.0.0
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
		/**
		 * Setup class.
		 *
		 * @since 1.0.0
		 */
		public function __construct()

		{
			add_action('customize_register', array(
                $this,
                'customize_register'
            ) , 10);
		}
		/**
         * Theme Customizer along with several other settings.
         *
         * @param WP_Customize_Manager $wp_customize Theme Customizer object.
         * @since 1.0.0
         */
        public function customize_register($wp_customize)
        
        {
        	$wp_customize->add_setting('restarter_footer_logo', array(
                'capability' => 'edit_theme_options',
                'sanitize_callback' => 'absint'
            ));
            $wp_customize->add_control(new WP_Customize_Cropped_Image_Control($wp_customize, 'restarter_footer_logo', array(
                'label' => __('Footer Logo', 'restarter') ,
                'section' => 'title_tagline',
                'priority' => 9,
                'settings' => 'restarter_footer_logo',
                'width' => 520,
                'height' => 208,
                'flex_width'  => true,
                'flex-height' => false
            )));
        }
	}
endif;
return new Restarter_Customizer();