/**
 * Restarter Customizer Scripts
 *
 * @author      Mahdi Yazdani
 * @package     Restarter
 * @since       1.1.1
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
        if ($('#customize-header-actions a.customize-controls-close').length > 0) {
            var closeBTN = $('#customize-header-actions a.customize-controls-close').attr('href'),
                closeBTNURL = closeBTN.substring(0, closeBTN.indexOf('/?customize_changeset_uuid') + '/?customize_changeset_uuid'.length).replace('?customize_changeset_uuid', '');
            $('#customize-header-actions a.customize-controls-close').click(function(e) {
                e.preventDefault();
                window.location.href = closeBTNURL;
            });
        }
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