<?php
/**
 * Created by PhpStorm.
 * User: endzev
 * Date: 10/9/2018
 * Time: 12:20 PM
 */

/**
 *   Add customizer styles to <head>
 */
function mphb_divi_customizer_css(){

    $button_text_size = absint( et_get_option( 'all_buttons_font_size', '20' ) );
    $button_text_color = et_get_option( 'all_buttons_text_color', '#ffffff' );
    $button_bg_color = et_get_option( 'all_buttons_bg_color', 'rgba(0,0,0,0)' );
    $button_border_width = absint( et_get_option( 'all_buttons_border_width', '2' ) );
    $button_border_color = et_get_option( 'all_buttons_border_color', '#ffffff' );
    $button_border_radius = absint( et_get_option( 'all_buttons_border_radius', '3' ) );
    $button_text_style = et_get_option( 'all_buttons_font_style', '', '', true );
    $button_spacing = intval( et_get_option( 'all_buttons_spacing', '0' ) );
    $button_text_color_hover = et_get_option( 'all_buttons_text_color_hover', '#ffffff' );
    $button_bg_color_hover = et_get_option( 'all_buttons_bg_color_hover', 'rgba(255,255,255,0.2)' );
    $button_border_color_hover = et_get_option( 'all_buttons_border_color_hover', 'rgba(0,0,0,0)' );
    $button_border_radius_hover = absint( et_get_option( 'all_buttons_border_radius_hover', '3' ) );
    $button_spacing_hover = intval( et_get_option( 'all_buttons_spacing_hover', '0' ) );

    ?>

    <style id="mphb-divi-customizer-css">
        .mphb_sc_rooms-wrapper .button,
        .mphb_sc_search-wrapper .button,
        .mphb_sc_search_results-wrapper .button,
        .mphb_sc_checkout-wrapper .button,
        .mphb_sc_room-wrapper .button,
        .mphb_sc_booking_form-wrapper .button,
        .widget_mphb_rooms_widget .button,
        .widget_mphb_search_availability_widget form .button,
        .mphb-booking-form .button{
        <?php
        if($button_text_size != 20):
        ?>
            font-size: <?php echo $button_text_size;?>px;

        <?php
        endif;
        if($button_text_color != '#ffffff'):
        ?>
            color: <?php echo $button_text_color;?>;
        <?php
         endif;
         if($button_bg_color != 'rgba(0,0,0,0)'):
         ?>
            background: <?php echo $button_bg_color;?>;
        <?php
        endif;
        if($button_border_width != 2):
        ?>
            border-width: <?php echo $button_border_width;?>px !important;
        <?php
        endif;
        if($button_border_color != '#ffffff'):
        ?>
            border-color: <?php echo $button_border_color;?>;
        <?php
        endif;
        if($button_border_radius != 3):
        ?>
            border-radius: <?php echo $button_border_radius;?>px;
        <?php
        endif;
        if($button_text_style != ''):
        ?>
        <?php echo $button_text_style;?>;
        <?php
        endif;
        if($button_spacing != 0):
        ?>
            letter-spacing: <?php echo $button_spacing;?>px;
        <?php
        endif;
        if(et_pb_get_specific_default_font( et_get_option( 'all_buttons_font', 'none' ) ) != 'none'):
        ?>
            font-family: <?php echo sanitize_text_field(et_pb_get_specific_default_font( et_get_option( 'all_buttons_font', 'none' ) ));?>, sans-serif;
        <?php
        endif;
        ?>
        }
        .mphb_sc_rooms-wrapper .button:hover,
        .mphb_sc_search-wrapper .button:hover,
        .mphb_sc_search_results-wrapper .button:hover,
        .mphb_sc_checkout-wrapper .button:hover,
        .mphb_sc_room-wrapper .button:hover,
        .mphb_sc_booking_form-wrapper .button:hover,
        .widget_mphb_rooms_widget .button:hover,
        .widget_mphb_search_availability_widget form .button:hover,
        .mphb-booking-form .button:hover{
        <?php
        if($button_text_color_hover != '#ffffff'):
        ?>
            color: <?php echo $button_text_color_hover;?> !important;
        <?php
        endif;
        if($button_bg_color_hover != 'rgba(255,255,255,0.2)'):
        ?>
            color: <?php echo $button_bg_color_hover;?> !important;
        <?php
        endif;
        if($button_border_color_hover != 'rgba(0,0,0,0)'):
        ?>
            border-color: <?php echo $button_border_color_hover;?> !important;
        <?php
        endif;
        if($button_border_radius_hover != 3):
        ?>
            border-radius: <?php echo $button_border_radius_hover;?>px !important;
        <?php
        endif;
        if($button_spacing_hover != 0):
        ?>
            letter-spacing: <?php echo $button_spacing_hover;?>px !important;
        <?php
        endif;
        ?>
        }
    </style>

    <?php
}

add_action('wp_head', 'mphb_divi_customizer_css');
