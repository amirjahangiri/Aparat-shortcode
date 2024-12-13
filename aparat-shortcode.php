<?php
/**
 * Plugin Name: کد کوتاه آپارات
 * Description: دکمه ای برای درج کدهای کوتاه ویدیویی آپارات به ویرایشگر وردپرس اضافه می کند.
 * Version: 1.0.0
 * Author: Amir Jahangiri
 * Author URI: https://amirjahangiri.ir
 */

// Enqueue necessary scripts and styles
add_action('admin_enqueue_scripts', function () {
    wp_enqueue_script('aparat-bootstrap', plugin_dir_url(__FILE__) . 'assets/js/bootstrap.bundle.min.js', [], null, true);
    wp_enqueue_style('aparat-bootstrap-css', plugin_dir_url(__FILE__) . 'assets/css/bootstrap.min.css', [], null);
    wp_enqueue_style('aparat-custom-css', plugin_dir_url(__FILE__) . 'assets/css/custom.css', [], null);
    wp_enqueue_script('aparat-shortcode-script', plugin_dir_url(__FILE__) . 'assets/js/aparat-j.js', ['jquery'], null, true);
    wp_localize_script('aparat-shortcode-script', 'aparatShortcode', [
        'ajax_url' => admin_url('admin-ajax.php'),
    ]);
});

// Add the button to the WordPress editor
add_action('media_buttons', function () {
    echo '<button type="button" id="aparat-insert-button" class="button">اضافه کردن ویدیو آپارات</button>';
});

// Handle the shortcode
add_shortcode('aparat-j', function ($atts) {
    $atts = shortcode_atts(['id' => ''], $atts, 'aparat-j');
    $iframe_id = 'aparat-j-' . esc_attr($atts['id']);
    $iframe_src = 'https://www.aparat.com/video/video/embed/videohash/' . esc_attr($atts['id']) . '/vt/frame';
    return "
    <div class='aparat-frame-wrapper'>
        <iframe id='{$iframe_id}' src='{$iframe_src}' allowfullscreen='true' class='aparat-frame'></iframe>
    </div>";
});


add_action('wp_head', function () {
    ?>
    <style>
        .aparat-frame-wrapper {
            position: relative;
            width: 100%;
            padding-bottom: 56.25%;
            /* 16:9 aspect ratio */
            height: 0;
        }

        .aparat-frame {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: 0;
        }
    </style>
    <?php
});