<?php

/**
 * Do not edit anything in this file unless you know what you're doing
 */

use Roots\Sage\Config;
use Roots\Sage\Container;

/**
 * Helper function for prettying up errors
 * @param string $message
 * @param string $subtitle
 * @param string $title
 */
$sage_error = function ($message, $subtitle = '', $title = '') {
    $title = $title ?: __('Sage &rsaquo; Error', 'sage');
    $footer = '<a href="https://roots.io/sage/docs/">roots.io/sage/docs/</a>';
    $message = "<h1>{$title}<br><small>{$subtitle}</small></h1><p>{$message}</p><p>{$footer}</p>";
    wp_die($message, $title);
};

/**
 * Ensure compatible version of PHP is used
 */
if (version_compare('7.1', phpversion(), '>=')) {
    $sage_error(__('You must be using PHP 7.1 or greater.', 'sage'), __('Invalid PHP version', 'sage'));
}

/**
 * Ensure compatible version of WordPress is used
 */
if (version_compare('4.7.0', get_bloginfo('version'), '>=')) {
    $sage_error(__('You must be using WordPress 4.7.0 or greater.', 'sage'), __('Invalid WordPress version', 'sage'));
}

/**
 * Ensure dependencies are loaded
 */
if (!class_exists('Roots\\Sage\\Container')) {
    if (!file_exists($composer = __DIR__ . '/../vendor/autoload.php')) {
        $sage_error(
            __('You must run <code>composer install</code> from the Sage directory.', 'sage'),
            __('Autoloader not found.', 'sage')
        );
    }
    require_once $composer;
}

/**
 * Sage required files
 *
 * The mapped array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 */
array_map(function ($file) use ($sage_error) {
    $file = "../app/{$file}.php";
    if (!locate_template($file, true, true)) {
        $sage_error(sprintf(__('Error locating <code>%s</code> for inclusion.', 'sage'), $file), 'File not found');
    }
}, ['helpers', 'setup', 'filters', 'admin']);

/**
 * Here's what's happening with these hooks:
 * 1. WordPress initially detects theme in themes/sage/resources
 * 2. Upon activation, we tell WordPress that the theme is actually in themes/sage/resources/views
 * 3. When we call get_template_directory() or get_template_directory_uri(), we point it back to themes/sage/resources
 *
 * We do this so that the Template Hierarchy will look in themes/sage/resources/views for core WordPress themes
 * But functions.php, style.css, and index.php are all still located in themes/sage/resources
 *
 * This is not compatible with the WordPress Customizer theme preview prior to theme activation
 *
 * get_template_directory()   -> /srv/www/example.com/current/web/app/themes/sage/resources
 * get_stylesheet_directory() -> /srv/www/example.com/current/web/app/themes/sage/resources
 * locate_template()
 * ├── STYLESHEETPATH         -> /srv/www/example.com/current/web/app/themes/sage/resources/views
 * └── TEMPLATEPATH           -> /srv/www/example.com/current/web/app/themes/sage/resources
 */
array_map(
    'add_filter',
    ['theme_file_path', 'theme_file_uri', 'parent_theme_file_path', 'parent_theme_file_uri'],
    array_fill(0, 4, 'dirname')
);
Container::getInstance()
    ->bindIf('config', function () {
        return new Config([
            'assets' => require dirname(__DIR__) . '/config/assets.php',
            'theme' => require dirname(__DIR__) . '/config/theme.php',
            'view' => require dirname(__DIR__) . '/config/view.php',
        ]);
    }, true);

// IMAGE SIZES
add_image_size('big', 2560, 999999);

function limit($value, $limit = 100, $end = '...')
{
    if (mb_strlen($value) <= $limit) return $value;
    return mb_substr($value, 0, $limit) . $end;
}

function fix_post_id_on_preview($null, $post_id)
{
    if (is_preview()) {
        return get_the_ID();
    }
}
add_filter('acf/pre_load_post_id', 'fix_post_id_on_preview', 10, 2);


function render_sage_template($template)
{
    $blade = app('blade'); // Get the Sage Blade instance
    return $blade->make($template)->render();
}

function filter_posts()
{
    $page = 12;
    // Check if the selected value is set
    $selected_value = sanitize_text_field($_POST['selected_value']);
    $selected_load = sanitize_text_field($_POST['selected_load']);


    if ($selected_load == "12") {
        $page += 8;
    }

    // Define your query arguments based on the selected value
    if ($selected_value == "Best Selling") {
        $args = array(
            'post_type' => 'product', // Query for products
            'meta_key' => 'total_sales', // Meta key for total sales
            'orderby' => 'meta_value_num', // Order by numeric meta value
            'order' => 'DESC',
            'posts_per_page' => $page,

        );
    }
    if ($selected_value == "Newest") {
        $args = array(
            'post_type' => 'product',
            'orderby' => 'date',
            'order' => 'DESC',
            'posts_per_page' => $page,

        );
    }

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();

            echo \App\template('components.product');
        }
        wp_reset_postdata();
    } else {
        echo '<p>No posts found.</p>';
    }


    // Always die in functions echoing AJAX content
    wp_die();
}
add_action('wp_ajax_filter_posts', 'filter_posts');
add_action('wp_ajax_nopriv_filter_posts', 'filter_posts');

function my_enqueue()
{

    wp_enqueue_script('ajax-script', get_template_directory_uri() . '/views/partials/content-home.blade.php', array('jquery'));

    wp_localize_script(
        'ajax-script',
        'my_ajax_object',
        array('ajax_url' => admin_url('admin-ajax.php'))
    );
}
add_action('wp_enqueue_scripts', 'my_enqueue');

register_nav_menus(array('Footer Menu' => 'Footer menu'));






////

function mytheme_enqueue_ajax_filter_script() {
    wp_enqueue_script('mytheme-ajax-filter', get_template_directory_uri() . '/views/partials/content-shop.blade.php', array('jquery'), null, true);
    
    // Localize script to pass AJAX URL
    wp_localize_script('mytheme-ajax-filter', 'mytheme_ajaxfilter', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
    ));
}
add_action('wp_enqueue_scripts', 'mytheme_enqueue_ajax_filter_script');


////

////

function mytheme_ajax_filter_products() {
    // Get page, categories, sort, price sort, and search term from AJAX request
    $paged = isset($_POST['page']) ? intval($_POST['page']) : 1;
    $categories = isset($_POST['categories']) ? array_map('intval', $_POST['categories']) : [];
    $sort_by = isset($_POST['sort_by']) ? sanitize_text_field($_POST['sort_by']) : 'default';
    $price_sort = isset($_POST['price_sort']) ? sanitize_text_field($_POST['price_sort']) : 'default';

    // Get search term from either the AJAX request or the URL
    $search_term = isset($_POST['search_term']) ? sanitize_text_field($_POST['search_term']) : '';
    $search_cat = isset($_POST['search_cat']) ? sanitize_text_field($_POST['search_cat']) : '';
    
    // Arguments for WP_Query for WooCommerce products
    $args = array(
        'post_type' => 'product',
        'posts_per_page' => 4, // Number of products per page
        'paged' => $paged,
    );

    // Add search term to the query if it exists
    if ( ! empty( $search_term ) ) {
        $args['s'] = $search_term;
    }

    // Filter by selected product categories
    if ( !empty( $categories ) ) {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'product_cat',
                'field'    => 'term_id',
                'terms'    => $categories,
            ),
        );
    }

    if(!empty($search_cat)){
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'product_cat',
                'field' => 'term_id',
                'terms' => $search_cat
            ),
        );
    }

    // Add sorting logic
    if ( $sort_by == 'best_selling' ) {
        $args['meta_key'] = 'total_sales';
        $args['orderby'] = 'meta_value_num';
        $args['order'] = 'DESC';
    } elseif ( $sort_by == 'newest' ) {
        $args['orderby'] = 'date';
        $args['order'] = 'DESC';
    }

    // Handle price sorting
    if ( $price_sort == 'low_to_high' ) {
        $args['meta_key'] = '_price';
        $args['orderby'] = 'meta_value_num';
        $args['order'] = 'ASC';
    } elseif ( $price_sort == 'high_to_low' ) {
        $args['meta_key'] = '_price';
        $args['orderby'] = 'meta_value_num';
        $args['order'] = 'DESC';
    }

    // Execute WooCommerce product query
    $query = new WP_Query( $args );

    // Begin output buffering to collect HTML output
    ob_start();

    echo "<div class='content'>";
    // Display the products
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            echo \App\template('components.product');
        }
        wp_reset_postdata();
    } else {
        echo '<p>No products found.</p>';
    }
    echo "</div>";

    // Pagination links
    $total_pages = $query->max_num_pages;
    if ($total_pages > 1) {
        echo '<div class="pagination">';
        for ($i = 1; $i <= $total_pages; $i++) {
            $active_class = ($i == $paged) ? 'active' : '';
            echo '<a href="#" class="pagination-link ' . $active_class . '" data-page="' . $i . '">' . $i . '</a>';
        }
        echo '</div>';
    }

    // Get the buffered content (products and pagination) and stop buffering
    $products_html = ob_get_clean();
    
    // Return the response in JSON format
    wp_send_json(array(
        'products' => $products_html,
        'pagination' => $total_pages > 1 ? $products_html : '', // Return pagination if needed
    ));
}

// Register AJAX actions
add_action('wp_ajax_mytheme_filter_products', 'mytheme_ajax_filter_products');
add_action('wp_ajax_nopriv_mytheme_filter_products', 'mytheme_ajax_filter_products');










// AJAX handler for live search results
function mytheme_live_search() {
    $search_term = isset($_POST['search_term']) ? sanitize_text_field($_POST['search_term']) : '';
    
    if (empty($search_term)) {
        wp_send_json_error('Empty search term.');
        return;
    }

    $args = array(
        'post_type' => 'product',
        'posts_per_page' => 5, // Limit the number of live search results
        's' => $search_term,
    );

    $query = new WP_Query($args);

    $results = array();
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $results[] = array(
                'title' => get_the_title(),
                'link' => get_permalink(),
            );
        }
        wp_reset_postdata();
    }

    wp_send_json_success($results);
}

// Register AJAX actions for live search
add_action('wp_ajax_mytheme_live_search', 'mytheme_live_search');
add_action('wp_ajax_nopriv_mytheme_live_search', 'mytheme_live_search');

/**
 * Add a new country to countries list
 */
add_filter( 'woocommerce_countries',  'handsome_bearded_guy_add_my_country' );
function handsome_bearded_guy_add_my_country( $countries ) {
  $new_countries = array(
	                    'Kosova'  => __( 'Kosova', 'woocommerce' ),
	                    );

	return array_merge( $countries, $new_countries );
}

add_filter( 'woocommerce_continents', 'handsome_bearded_guy_add_my_country_to_continents' );
function handsome_bearded_guy_add_my_country_to_continents( $continents ) {
	$continents['EU']['countries'][] = 'Kosova';
	return $continents;
}


add_filter('stylesheet_directory', function ($tdir, $temp, $root) {
    if (!str_contains($tdir, 'templates')) {
        $tdir .= "/templates";
    }
   return $tdir;
}, 10, 3);
