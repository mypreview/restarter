/**
 * Restarter Customizer preview scripts
 * A generic toggle control you can use to replace the checkbox control.
 * Enable / disable the control title by toggeling its .disabled-control-title style class on or off.
 *
 * @see         https://github.com/soderlind/class-customizer-toggle-control/blob/master/js/customizer-toggle-control.js
 * @author      Mahdi Yazdani
 * @package     Restarter
 * @since       1.1.0
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
        var toggleControls = $.parseJSON(restarter_customizer_toggle_control_vars.toggle_controllers);
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