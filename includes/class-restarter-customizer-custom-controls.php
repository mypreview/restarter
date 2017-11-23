<?php
/**
 * Restarter Customizer custom controls.
 *
 * @author  	Mahdi Yazdani
 * @package 	Restarter
 * @since 	    1.1.0
 */
if (!class_exists('WP_Customize_Control')):
	return NULL;
endif;
/**
 * A generic toggle control you can use to replace the checkbox control.
 * Enable / disable the control title by toggeling its .disabled-control-title style class on or off.
 *
 * @see         https://github.com/soderlind/class-customizer-toggle-control/blob/master/js/customizer-toggle-control.js
 * @author  	Mahdi Yazdani
 * @package 	Restarter
 * @since 	    1.1.4
 */
if (!class_exists('Restarter_Toggle_Control')):
	class Restarter_Toggle_Control extends WP_Customize_Control

	{
		/**
		 * Control type.
		 *
		 * @since 1.1.0
		 */
		public $type = 'restarter-ios';
		/**
		 * Control setup.
		 *
		 * @since 1.1.0
		 */
		public function __construct($manager, $id, $args = array())

		{
        	parent::__construct($manager, $id, $args);
    	}
		/**
		 * Render the content of the "Toggle" field type.
		 *
		 * @since 1.1.4
		 */
		public function render_content()

		{
			?>
			<label class="restarter-toggle">
				<div>
					<span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
					<input id="cb<?php echo intval($this->instance_number); ?>" type="checkbox" class="tgl tgl-<?php echo esc_attr(str_replace('restarter-', '', $this->type)); ?>" value="<?php echo esc_attr($this->value()); ?>" <?php $this->link(); checked($this->value()); ?> />
					<label for="cb<?php echo intval($this->instance_number) ?>" class="tgl-btn"></label>
				</div>
				<span class="description customize-control-description"><?php echo esc_html($this->description); ?></span>
			</label>
        	<?php
		}
	}
endif;
/**
 * A generic range with value control you can use to replace the range control.
 * 
 * @see         https://github.com/soderlind/class-customizer-range-value-control/blob/master/js/customizer-range-value-control.js
 * @author  	Mahdi Yazdani
 * @package 	Restarter
 * @since 	    1.1.4
 */
if (!class_exists('Restarter_Range_Control')):
	class Restarter_Range_Control extends WP_Customize_Control

	{
		/**
		 * Control type.
		 *
		 * @since 1.1.0
		 */
		public $type = 'restarter-range';
		/**
		 * Control setup.
		 *
		 * @since 1.1.0
		 */
		public function __construct($manager, $id, $args = array())

		{
        	parent::__construct($manager, $id, $args);
    	}
		/**
		 * Render the content of the "Range" field type.
		 *
		 * @since 1.1.4
		 */
		public function render_content()

		{
			?>
			<span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
			<span class="description customize-control-description"><?php echo esc_html($this->description); ?></span>
			<div class="restarter-range-slider">
				<span>
					<input class="range-slider-range" type="range" value="<?php echo esc_attr($this->value()); ?>" <?php $this->input_attrs(); $this->link(); ?>>
					<span class="range-slider-value"><?php echo intval(0); ?></span>
				</span>
			</div>
        	<?php
		}
	}
endif;
if (!class_exists('Restarter_Gallery_Control')):
	class Restarter_Gallery_Control extends WP_Customize_Control

	{
		/**
		 * Control type.
		 *
		 * @since 1.1.0
		 */
		public $type = 'restarter-gallery';
		/**
		 * Control setup.
		 *
		 * @since 1.1.0
		 */
		public function __construct($manager, $id, $args = array())

		{
        	parent::__construct($manager, $id, $args);
    	}
		/**
		 * Render the content of the "Gallery" field type.
		 *
		 * @since 1.1.0
		 */
		public function render_content()

		{
			?>
			<div class="restarter-gallery">
				<label>
					<span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
					<span class="description customize-control-description"><?php echo esc_html($this->description); ?></span>
					<div class="gallery-screenshot clearfix">
			    	<?php
					$ids = explode(',', $this->value());
					foreach($ids as $attachment_id):
						$img = wp_get_attachment_image_src($attachment_id, 'full');
						?>
						<div class="screen-thumb">
						<?php echo '<img src="' . esc_url($img[0]) . '" />'; ?>
						</div>
						<?php
					endforeach;
					?>
			    	</div>
			    	<input id="edit-gallery" class="button upload_gallery_button" type="button" value="<?php esc_attr_e('Add / Edit Gallery', 'restarter') ?>" />
					<input id="clear-gallery" class="button upload_gallery_button" type="button" value="<?php esc_attr_e('Clear', 'restarter') ?>" />
					<input type="hidden" class="gallery_values" <?php echo $this->link(); ?> value="<?php echo esc_attr($this->value()); ?>">
				</label>
			</div>
        	<?php
		}
	}
endif;
if (!class_exists('Restarter_Font_Icon_Control')):
	class Restarter_Font_Icon_Control extends WP_Customize_Control

	{
		/**
		 * Control type.
		 *
		 * @since 1.1.0
		 */
		public $type = 'restarter-icon';
		/**
		 * Control setup.
		 *
		 * @since 1.1.0
		 */
		public function __construct($manager, $id, $args = array())

		{
        	parent::__construct($manager, $id, $args);
    	}
		/**
		 * Render the content of the "Font Icon" field type.
		 *
		 * @since 1.1.0
		 */
		public function render_content()

		{
			?>
			<div class="restarter-font-icons">
			<label>
                <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
	            <span class="description customize-control-description"><?php echo esc_html($this->description); ?></span>
                <div class="restarter-selected-icon">
                	<i class="<?php echo esc_attr($this->value()); ?>"></i>
                	<span><i class="icon-arrow-down"></i></span>
                </div>
                <ul class="restarter-icon-list clearfix">
                	<?php
					$icons = Restarter_Customizer::get_font_icons();
					foreach((array)$icons as $icon):
						$icon_class = $this->value() == $icon ? 'icon-active' : '';
						echo '<li class=' . esc_attr($icon_class) . '><i class="' . esc_attr($icon) . '"></i></li>';
					endforeach;
					?>
                </ul>
                <input type="hidden" value="<?php echo esc_attr($this->value()); ?>" <?php $this->link(); ?> />
            </label>
        	</div>
        	<?php
		}
	}
endif;
/**
 * Create a Radio-Image control
 * Inspired by Storefront class-storefront-customizer-control-radio-image.php
 *
 * @see 		https://github.com/woocommerce/storefront
 * @author  	Mahdi Yazdani
 * @package 	Restarter
 * @since 	    1.1.0
 */
if (!class_exists('Restarter_Radio_Image_Control')):
	class Restarter_Radio_Image_Control extends WP_Customize_Control

	{
		/**
		 * Control type.
		 *
		 * @since 1.1.0
		 */
		public $type = 'restarter-radio-image';
		/**
		 * Control setup.
		 *
		 * @since 1.1.0
		 */
		public function __construct($manager, $id, $args = array())

		{
        	parent::__construct($manager, $id, $args);
    	}
    	/**
         * Enqueue scripts and styles.
         *
         * @since 1.1.0
         */
		public function enqueue() 

		{
			wp_enqueue_script('jquery-ui-button');
		}
		/**
		 * Render the content of the "Font Icon" field type.
		 *
		 * @since 1.1.0
		 */
		public function render_content()

		{
			if (empty($this->choices)):
				return;
			endif;
			$name = '_customize-radio-' . $this->id;
			?>
			<div class="restarter-radio-image">
	            <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
	            <span class="description customize-control-description"><?php echo esc_html($this->description); ?></span>
	            <div id="input_<?php echo esc_attr($this->id); ?>" class="image ui-buttonset">
					<?php foreach ($this->choices as $value => $label ) : ?>
						<input class="image-select" type="radio" value="<?php echo esc_attr($value); ?>" id="<?php echo esc_attr($this->id . $value); ?>" name="<?php echo esc_attr($name); ?>" <?php $this->link(); checked($this->value(), $value); ?>>
							<label for="<?php echo esc_attr($this->id) . esc_attr($value); ?>">
								<img src="<?php echo esc_html($label); ?>" alt="<?php echo esc_attr($value); ?>" title="<?php echo esc_attr($value); ?>">
							</label>
						</input>
					<?php endforeach; ?>
				</div>
        	</div>
        	<script type="text/javascript">jQuery(document).ready(function($) { $('[id="input_<?php echo esc_attr($this->id); ?>"]' ).buttonset(); });</script>
        	<?php
		}
	}
endif;
/**
 * "Plus" theme section
 * Using the Customize API for adding a "plus" link to the customizer.
 *
 * @see         https://github.com/justintadlock/trt-customizer-pro/blob/master/example-1/class-customize.php
 * @author  	Mahdi Yazdani
 * @package 	Restarter
 * @since 	    1.1.0
 */
if (!class_exists('Restarter_Go_Plus_Control')):
	class Restarter_Go_Plus_Control extends WP_Customize_Section

	{
		/**
		 * Control type.
		 *
		 * @since 1.1.0
		 */
		public $type = 'restarter-plus';
		public $go_plus_text = '';
    	public $go_plus_url = '';
		/**
         * Add custom parameters to pass to the JS via JSON.
         *
         * @since 1.1.0
         */
        public function json()

        {
            $json = parent::json();
            $json['go_plus_text'] = $this->go_plus_text;
            $json['go_plus_url']  = esc_url($this->go_plus_url);
            return $json;
        }
		/**
         * Outputs the Underscore.js template.
         *
         * @since 1.1.0
         */
        protected function render_template()
        
        {
            ?>
            <li id="accordion-section-{{ data.id }}" class="accordion-section control-section control-section-{{ data.type }} cannot-expand">
				<h3 class="accordion-section-title">
					{{ data.title }}
					<# if (data.go_plus_text && data.go_plus_url) { #>
						<a href="{{ data.go_plus_url }}" class="button button-primary alignright" target="_blank">{{ data.go_plus_text }}</a>
					<# } #>
				</h3>
			</li>
            <?php
        }
	}
endif;