/**
 * Restarter Customizer preview scripts
 * A generic range with value control you can use to replace the range control.
 * 
 * @see         https://github.com/soderlind/class-customizer-range-value-control/blob/master/js/customizer-range-value-control.js
 * @author      Mahdi Yazdani
 * @package     Restarter
 * @since       1.1.0
 */
(function(wp, $) {
    // Bail if the customizer isn't initialized
    if (!wp || !wp.customize) {
        return;
    }
    // Range control
    wp.customize.bind('ready', function() {
        rangeSlider();
    });

    function rangeSlider() {
        var slider = $('.restarter-range-slider'),
            range = $('.range-slider-range'),
            value = $('.range-slider-value');
        slider.each(function() {
            value.each(function() {
                var value = $(this).prev().attr('value');
                var suffix = ($(this).prev().attr('suffix')) ? $(this).prev().attr('suffix') : '';
                $(this).html(value + suffix);
            });
            range.on('input', function() {
                var suffix = ($(this).attr('suffix')) ? $(this).attr('suffix') : '';
                $(this).next(value).html(this.value + suffix);
            });
        });
    }
})(window.wp, jQuery);