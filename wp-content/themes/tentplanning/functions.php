<?php

if (function_exists('add_theme_support'))
{
    // Add Menu Support
    add_theme_support('menus');

    // Add Thumbnail Theme Support
    add_theme_support('post-thumbnails');

}


// HTML5 Blank navigation
function tentplan_nav()
{
    wp_nav_menu(
        array(
            'theme_location'  => 'header-menu',
            'menu'            => '',
            'container'       => 'div',
            'container_class' => 'menu-{menu slug}-container',
            'container_id'    => '',
            'menu_class'      => 'menu',
            'menu_id'         => '',
            'echo'            => true,
            'fallback_cb'     => 'wp_page_menu',
            'before'          => '',
            'after'           => '',
            'link_before'     => '',
            'link_after'      => '',
            'items_wrap'      => '<ul>%3$s</ul>',
            'depth'           => 0,
            'walker'          => ''
        )
    );
}


add_action('wp_enqueue_scripts', 'tentplan_scripts'); // Add Theme Scripts
function tentplan_scripts()
{
    if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {
        wp_register_script('bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js', array('jquery'));
        wp_enqueue_script('bootstrap');
    }
}

add_action('wp_enqueue_scripts', 'tentplan_styles'); // Add Theme Stylesheet
function tentplan_styles()
{
    wp_register_style('bootstrap-styles', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css');
    wp_enqueue_style('bootstrap-styles');

    wp_register_style('custom-styles', get_template_directory_uri() . '/style.css');
    wp_enqueue_style('custom-styles');
}


add_action('init', 'tentplan_menus'); // Add HTML5 Blank Menu
function tentplan_menus()
{
    register_nav_menus(array(
        'header-menu' => 'Header Menu',
        'user-menu' => 'User Menu',
    ));
}


add_filter('body_class', 'add_slug_to_body_class');
function add_slug_to_body_class($classes)
{
    global $post;
    if (is_home()) {
        $key = array_search('blog', $classes);
        if ($key > -1) {
            unset($classes[$key]);
        }
    } elseif (is_page()) {
        $classes[] = sanitize_html_class($post->post_name);
    } elseif (is_singular()) {
        $classes[] = sanitize_html_class($post->post_name);
    }

    return $classes;
}

