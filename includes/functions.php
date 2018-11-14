<?php
/**
 *   Add customizer styles to <head>
 */
function mphb_divi_customizer_css(){

    $button_text_size = absint( et_get_option( 'all_buttons_font_size', '' ) );
    $button_text_color = et_get_option( 'all_buttons_text_color', '' );
    $button_bg_color = et_get_option( 'all_buttons_bg_color', '' );
    $button_border_width = absint( et_get_option( 'all_buttons_border_width', '' ) );
    $button_border_color = et_get_option( 'all_buttons_border_color', '' );
    $button_border_radius = absint( et_get_option( 'all_buttons_border_radius', '' ) );
    $button_text_style = et_get_option( 'all_buttons_font_style', '', '', true );
    $button_spacing = intval( et_get_option( 'all_buttons_spacing', '' ) );
    $button_text_color_hover = et_get_option( 'all_buttons_text_color_hover', '' );
    $button_bg_color_hover = et_get_option( 'all_buttons_bg_color_hover', '' );
    $button_border_color_hover = et_get_option( 'all_buttons_border_color_hover', '' );
    $button_border_radius_hover = absint( et_get_option( 'all_buttons_border_radius_hover', '' ) );
    $button_spacing_hover = intval( et_get_option( 'all_buttons_spacing_hover', '' ) );
    
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
        if($button_text_size !== ''):
        ?>
            font-size: <?php echo $button_text_size;?>px;
        <?php
        endif;
        if($button_text_color !== ''):
        ?>
            color: <?php echo $button_text_color;?>;
        <?php
         endif;
         if($button_bg_color !== ''):
         ?>
            background: <?php echo $button_bg_color;?>;
        <?php
        endif;
        if($button_border_width !== ''):
        ?>
            border-width: <?php echo $button_border_width;?>px !important;
        <?php
        endif;
        if($button_border_color !== ''):
        ?>
            border-color: <?php echo $button_border_color;?>;
        <?php
        endif;
        if($button_border_radius !== ''):
        ?>
            border-radius: <?php echo $button_border_radius;?>px;
        <?php
        endif;
        if($button_text_style !== ''):
        ?>
        <?php echo esc_html( et_pb_print_font_style($button_text_style));?>;
        <?php
        endif;
        if($button_spacing !== ''):
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
        if($button_text_color_hover !== ''):
        ?>
            color: <?php echo $button_text_color_hover;?> !important;
        <?php
        endif;
        if($button_bg_color_hover !== ''):
        ?>
            background: <?php echo $button_bg_color_hover;?> !important;
        <?php
        endif;
        if($button_border_color_hover !== ''):
        ?>
            border-color: <?php echo $button_border_color_hover;?> !important;
        <?php
        endif;
        if($button_border_radius_hover !== ''):
        ?>
            border-radius: <?php echo $button_border_radius_hover;?>px !important;
        <?php
        endif;
        if($button_spacing_hover !== ''):
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
