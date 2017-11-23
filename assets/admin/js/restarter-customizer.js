/**
 * Restarter Customizer Scripts
 *
 * @author      Mahdi Yazdani
 * @package     Restarter
 * @since       1.1.4
 */
(function(window, $, undefined) {
    jQuery(document).ready(function($) {
        'use strict';
        // Gallery control.
        $('.restarter-gallery .upload_gallery_button').click(function(event) {
            var current_gallery = $(this).closest('label');
            if (event.currentTarget.id === 'clear-gallery') {
                // Remove value from input
                current_gallery.find('.gallery_values').val('').trigger('change');
                // Remove preview images
                current_gallery.find('.gallery-screenshot').html('');
                return;
            }
            // Make sure the media gallery API exists.
            if (typeof wp === 'undefined' || !wp.media || !wp.media.gallery) {
                return;
            }
            event.preventDefault();
            // Activate the media editor.
            var val = current_gallery.find('.gallery_values').val(),
                final;

            if (!val) {
                final = '[gallery ids="0"]';
            } else {
                final = '[gallery ids="' + val + '"]';
            }
            var frame = wp.media.gallery.edit(final);

            frame.state('gallery-edit').on(
                'update',
                function(selection) {
                    // Clear screenshot div so we can append new selected images.
                    current_gallery.find('.gallery-screenshot').html('');
                    var element, preview_html = '',
                        preview_img;
                    var ids = selection.models.map(
                        function(e) {
                            element = e.toJSON();
                            preview_img = typeof element.sizes.full !== 'undefined' ? element.sizes.full.url : element.url;
                            preview_html = "<div class='screen-thumb'><img src='" + preview_img + "'/></div>";
                            current_gallery.find('.gallery-screenshot').append(preview_html);
                            return e.id;
                        }
                    );
                    current_gallery.find('.gallery_values').val(ids.join(',')).trigger('change');
                }
            );
            return false;
        });
        // Font icons control.
        $('body').on('click', '.restarter-icon-list li', function() {
            var icon_class = $(this).find('i').attr('class');
            $(this).addClass('icon-active').siblings().removeClass('icon-active');
            $(this).parent('.restarter-icon-list').prev('.restarter-selected-icon').children('i').attr('class', '').addClass(icon_class);
            $(this).parent('.restarter-icon-list').next('input').val(icon_class).trigger('change');
        });
        $('body').on('click', '.restarter-selected-icon', function() {
            $(this).next().slideToggle();
            $(this).find('span > i').toggleClass('icon-arrow-up icon-arrow-down');
        });
    });
})(this, jQuery);
/**
 * "Plus" theme section
 * Using the Customize API for adding a "plus" link to the customizer.
 *
 * @see         https://github.com/justintadlock/trt-customizer-pro/blob/master/example-1/class-customize.php
 * @author      Mahdi Yazdani
 * @package     Restarter
 * @since       1.1.0
 */
(function(api) {
    // Extends our custom section.
    api.sectionConstructor['restarter_go_plus_control'] = api.Section.extend({
        // No events for this type of section.
        attachEvents: function() {},
        // Always make the section active.
        isContextuallyActive: function() {
            return true;
        }
    });
})(wp.customize);
/**
 * A generic toggle control you can use to replace the checkbox control.
 * Enable / disable the control title by toggeling its .disabled-control-title style class on or off.
 *
 * @see         https://github.com/soderlind/class-customizer-toggle-control/blob/master/js/customizer-toggle-control.js
 * @author      Mahdi Yazdani
 * @package     Restarter
 * @since       1.1.4
 */
(function(wp, $) {
    // Bail if the customizer isn't initialized
    if (!wp || !wp.customize) {
        return;
    }
    // Toggle control
    wp.customize.bind('ready', function() { 
        // Customize object alias.
        var customize = this; 
        // Array with the control names
        var toggleControls = $.parseJSON(restarter_customizer_vars.toggle_controllers);
        $.each(toggleControls, function(index, control_name) {
            customize(control_name, function(value) {
                // Get control  title.
                var controlTitle = customize.control(control_name).container.find('.customize-control-title'),
                    controlDescription = customize.control(control_name).container.find('.customize-control-description'); 
                // 1. On loading.
                controlTitle.toggleClass('disabled-control-title', !value.get());
                controlDescription.toggleClass('disabled-control-title', !value.get());
                // 2. Binding to value change.
                value.bind(function(to) {
                    controlTitle.toggleClass('disabled-control-title', !value.get());
                    controlDescription.toggleClass('disabled-control-title', !value.get());
                });
            });
        });
    });
})(window.wp, jQuery);
/**
 * A generic range with value control you can use to replace the range control.
 * 
 * @see         https://github.com/soderlind/class-customizer-range-value-control/blob/master/js/customizer-range-value-control.js
 * @author      Mahdi Yazdani
 * @package     Restarter
 * @since       1.1.4
 */
(function(wp, $) {
    // Range control
    wp.customize.bind('ready', function() {
        RestarterRangeSlider();
    });

})(window.wp, jQuery);
function RestarterRangeSlider() {
    var slider = jQuery('.restarter-range-slider'),
        range = jQuery('.range-slider-range'),
        value = jQuery('.range-slider-value');
    slider.each(function() {
        value.each(function() {
            var value = jQuery(this).prev().attr('value');
            var suffix = (jQuery(this).prev().attr('suffix')) ? jQuery(this).prev().attr('suffix') : '';
            jQuery(this).html(value + suffix);
        });
        range.on('input', function() {
            var suffix = (jQuery(this).attr('suffix')) ? jQuery(this).attr('suffix') : '';
            jQuery(this).next(value).html(this.value + suffix);
        });
    });
}