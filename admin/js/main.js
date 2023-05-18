var $ = jQuery.noConflict();
// document ready
$(document).ready(function() {
    // Different Text for Archive and Single is checkbox is checked
    if ($('#woocatct_global_txt_diff').is(':checked')) {
        $('.woocatct_diff_txt_archive_single').removeClass('woocatct_disabled');
        $('.woocatct_global_txt_outer_wrap').addClass('woocatct_disabled');
    } else {
        $('.woocatct_diff_txt_archive_single').addClass('woocatct_disabled');
        $('.woocatct_global_txt_outer_wrap').removeClass('woocatct_disabled');
    }

    // Different Text for Archive and Single on change
    $('#woocatct_global_txt_diff').on('change', function() {
        if ($(this).is(':checked')) {
            $('.woocatct_diff_txt_archive_single').removeClass('woocatct_disabled');
            $('.woocatct_global_txt_outer_wrap').addClass('woocatct_disabled');
        } else {
            $('.woocatct_diff_txt_archive_single').addClass('woocatct_disabled');
            $('.woocatct_global_txt_outer_wrap').removeClass('woocatct_disabled');
        }
    });

    // Archive different product types is checkbox is checked
    if ($('#woocatct_product_type_txt_diff_archive').is(':checked')) {
        $('.woocatct_product_type_items_archive').removeClass('woocatct_disabled');
        $('.woocatct_archive_option_main').addClass('woocatct_disabled');
    }else{
        $('.woocatct_product_type_items_archive').addClass('woocatct_disabled');
        $('.woocatct_archive_option_main').removeClass('woocatct_disabled');
    }

    // Archive different product types on change 
    $('#woocatct_product_type_txt_diff_archive').on('change', function() {
        if ($(this).is(':checked')) {
            $('.woocatct_product_type_items_archive').removeClass('woocatct_disabled');
            $('.woocatct_archive_option_main').addClass('woocatct_disabled');
        }else{
            $('.woocatct_product_type_items_archive').addClass('woocatct_disabled');
            $('.woocatct_archive_option_main').removeClass('woocatct_disabled');
        }
    });

    // Single different product types is checkbox is checked
    if ($('#woocatct_product_type_txt_diff_single').is(':checked')) {
        $('.woocatct_product_type_items_single').removeClass('woocatct_disabled');
        $('.woocatct_single_options_main').addClass('woocatct_disabled');
    }else{
        $('.woocatct_product_type_items_single').addClass('woocatct_disabled');
        $('.woocatct_single_options_main').removeClass('woocatct_disabled');
    }

    // Single different product types on change 
    $('#woocatct_product_type_txt_diff_single').on('change', function() {
        if ($(this).is(':checked')) {
            $('.woocatct_product_type_items_single').removeClass('woocatct_disabled');
            $('.woocatct_single_options_main').addClass('woocatct_disabled');
        }else{
            $('.woocatct_product_type_items_single').addClass('woocatct_disabled');
            $('.woocatct_single_options_main').removeClass('woocatct_disabled');
        }
    });

});