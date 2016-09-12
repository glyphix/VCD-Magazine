<?php

/*------------------------------------*\
	Theme Support
\*------------------------------------*/

if (!isset($content_width))
{
    $content_width = 900;
}

if (function_exists('add_theme_support'))
{
    // Add Menu Support
    add_theme_support('menus');

    // Add Thumbnail Theme Support
    add_theme_support('post-thumbnails');
    add_image_size('large', 700, '', true); // Large Thumbnail
    add_image_size('medium', 250, '', true); // Medium Thumbnail
    add_image_size('small', 120, '', true); // Small Thumbnail
    add_image_size('custom-size', 700, 200, true); // Custom Thumbnail Size call using the_post_thumbnail('custom-size');

    // Localisation Support
    load_theme_textdomain('html5blank', get_template_directory() . '/languages');
}

/*------------------------------------*\
	Functions
\*------------------------------------*/

// HTML5 Blank navigation
function html5blank_nav()
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
		'walker'          => '',
		)
	);
}

// Load HTML5 Blank scripts (header.php)
function html5blank_header_scripts()
{
    if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {

    	wp_register_script('conditionizr', get_template_directory_uri() . '/js/lib/conditionizr-4.3.0.min.js', array(), '4.3.0');
        wp_enqueue_script('conditionizr'); // Enqueue it!

        wp_register_script('modernizr', get_template_directory_uri() . '/js/lib/modernizr-2.7.1.min.js', array(), '2.7.1');
        wp_enqueue_script('modernizr'); // Enqueue it!

        wp_register_script('html5blankscripts', get_template_directory_uri() . '/js/scripts.js', array('jquery'), '1.0.0');
        wp_enqueue_script('html5blankscripts'); // Enqueue it!
        
       wp_register_script('swiper', get_template_directory_uri() . '/js/swiper.min.js', array(), '1.0.0');
        wp_enqueue_script('swiper'); // Enqueue it!
    }
}

// Load HTML5 Blank conditional scripts
function html5blank_conditional_scripts()
{
    if (is_page('pagenamehere')) {
        wp_register_script('scriptname', get_template_directory_uri() . '/js/scriptname.js', array('jquery'), '1.0.0'); // Conditional script(s)
        wp_enqueue_script('scriptname'); // Enqueue it!
    }
}

// Load HTML5 Blank styles
function html5blank_styles()
{
    wp_register_style('normalize', get_template_directory_uri() . '/normalize.css', array(), '1.0', 'all');
    wp_enqueue_style('normalize'); // Enqueue it!

    wp_register_style('html5blank', get_template_directory_uri() . '/style.css', array(), '1.0', 'all');
    wp_enqueue_style('html5blank'); // Enqueue it!

    wp_register_style('html5blank', get_template_directory_uri() . '/desktop1.css', array(), '1.0', 'all');
    wp_enqueue_style('html5blank'); // Enqueue it!

    wp_register_style('color', get_template_directory_uri() . '/color-presets.css', array(), '1.0', 'all');
    wp_enqueue_style('color'); // Enqueue it!

    wp_register_style('swiper', get_template_directory_uri() . '/swiper.min.css', array(), '1.0', 'all');
    wp_enqueue_style('swiper'); // Enqueue it!
}

// Register HTML5 Blank Navigation
function register_html5_menu()
{
    register_nav_menus(array( // Using array to specify more menus if needed
        'header-menu' => __('Header Menu', 'html5blank'), // Main Navigation
        'sidebar-menu' => __('Sidebar Menu', 'html5blank'), // Sidebar Navigation
        'extra-menu' => __('Extra Menu', 'html5blank') // Extra Navigation if needed (duplicate as many as you need!)
    ));
}

// Remove the <div> surrounding the dynamic navigation to cleanup markup
function my_wp_nav_menu_args($args = '')
{
    $args['container'] = false;
    return $args;
}

// Remove Injected classes, ID's and Page ID's from Navigation <li> items
function my_css_attributes_filter($var)
{
    return is_array($var) ? array() : '';
}

// Remove invalid rel attribute values in the categorylist
function remove_category_rel_from_category_list($thelist)
{
    return str_replace('rel="category tag"', 'rel="tag"', $thelist);
}

// Add page slug to body class, love this - Credit: Starkers Wordpress Theme
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

// Customize read more link
add_filter( 'the_content_more_link', 'modify_read_more_link' );
function modify_read_more_link() {
return '<a class="more-link" href="' . get_permalink() . '">Its gonna be great>></a>';
}

// If Dynamic Sidebar Exists
if (function_exists('register_sidebar'))
{
    // Define Sidebar Widget Area 1
    register_sidebar(array(
        'name' => __('Widget Area 1', 'html5blank'),
        'description' => __('Main Footer Widgets', 'html5blank'),
        'id' => 'widget-area-1',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="keep-in-touch">',
        'after_title' => '</h3>'
    ));

    // Define Sidebar Widget Area 2
    register_sidebar(array(
        'name' => __('Credits', 'html5blank'),
        'description' => __('Information about the VCD Mag contributors', 'html5blank'),
        'id' => 'widget-area-2',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));
}

// Pagination for paged posts, Page 1, Page 2, Page 3, with Next and Previous Links, No plugin
function html5wp_pagination()
{
    global $wp_query;
    $big = 999999999;
    echo paginate_links(array(
        'base' => str_replace($big, '%#%', get_pagenum_link($big)),
        'format' => '?paged=%#%',
        'current' => max(1, get_query_var('paged')),
        'total' => $wp_query->max_num_pages
    ));
}

// Custom View Article link to Post
function html5_blank_view_article($more)
{
    global $post;
    return '... <a class="view-article" href="' . get_permalink($post->ID) . '">' . __('View Article', 'html5blank') . '</a>';
}

// Remove Admin bar
function remove_admin_bar()
{
    return false;
}

// Remove 'text/css' from our enqueued stylesheet
function html5_style_remove($tag)
{
    return preg_replace('~\s+type=["\'][^"\']++["\']~', '', $tag);
}

// Remove thumbnail width and height dimensions that prevent fluid images in the_thumbnail
function remove_thumbnail_dimensions( $html )
{
    $html = preg_replace('/(width|height)=\"\d*\"\s/', "", $html);
    return $html;
}

// Custom Gravatar in Settings > Discussion
function html5blankgravatar ($avatar_defaults)
{
    $myavatar = get_template_directory_uri() . '/img/gravatar.jpg';
    $avatar_defaults[$myavatar] = "Custom Gravatar";
    return $avatar_defaults;
}

function wps_recent_posts_dw() {
?>
<style type="text/css">
.widget-container {
    margin: 0;
}
#custom-post-widget{
    border-bottom: solid 1px #E7E7E7;
    padding: 1.3em;
}
#custom-post-widget h3,
#custom-post-widget h4 {
    display: inline-block;
    margin-bottom: 0;
}
#custom-post-widget h3{
    font-size: 1.5em;
}
#custom-post-widget h4{
    color: #767676;
    text-indent: 0.3em;
}
#custom-post-widget a:link{
    text-decoration: none;
}
#custom-post-widget a.post-edit-link:link{
    margin-left: 0.3em;
}
#custom-post-widget p{
    margin: 0.3em 0 0 0;
}
</style>
    <ul class="widget-container">

        <?php
        global $post;
        $args = array(
            'numberposts' => 1000,
            'post_type' => array('story','letter','points-of-pride','interview'),
            'orderby' => 'meta_value_num',
            'meta_key' => 'issue_number',
            'order' => 'ASC',
        );
        $myposts = get_posts( $args );
        foreach( $myposts as $post ) :  setup_postdata($post); ?>
                
        <li id="custom-post-widget">

            <h3><?php the_title(); ?></h3>
            <h4>
                <?php
                echo "Issue ";
                $issue_number = get_field( "issue_number" );

                if ($issue_number == "one") {

                    echo "1";

                } else {

                 the_field("issue_number");

                } ?>
            </h4>
            <p>Posted on <?php echo get_the_date(); ?><?php edit_post_link('Edit'); ?> | <a href="<?php the_permalink(); ?>">View</a></p>
        </li>
        <?php endforeach; ?>
   </ul>
<?php
}

function add_wps_recent_posts_dw() {
       wp_add_dashboard_widget( 'wps_recent_posts_dw', __( 'All Posts' ), 'wps_recent_posts_dw' );
}


add_action('wp_dashboard_setup', 'add_wps_recent_posts_dw' ); // Show recent posts in Dashboard



/*------------------------------------*\
	Actions + Filters + ShortCodes
\*------------------------------------*/

// Add Actions
add_action('init', 'html5blank_header_scripts'); // Add Custom Scripts to wp_head
add_action('wp_print_scripts', 'html5blank_conditional_scripts'); // Add Conditional Page Scripts
add_action('get_header', 'enable_threaded_comments'); // Enable Threaded Comments
add_action('wp_enqueue_scripts', 'html5blank_styles'); // Add Theme Stylesheet
add_action('init', 'register_html5_menu'); // Add HTML5 Blank Menu

add_action('init', 'create_post_type_story'); // Add Custom Post Type
add_action('init', 'create_post_type_letter'); 
add_action('init', 'create_post_type_interview'); 
add_action('init', 'create_post_type_points_of_pride'); 

add_action('widgets_init', 'my_remove_recent_comments_style'); // Remove inline Recent Comment Styles from wp_head()
add_action('init', 'html5wp_pagination'); // Add our HTML5 Pagination

// Remove Actions
remove_action('wp_head', 'feed_links_extra', 3); // Display the links to the extra feeds such as category feeds
remove_action('wp_head', 'feed_links', 2); // Display the links to the general feeds: Post and Comment Feed
remove_action('wp_head', 'rsd_link'); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action('wp_head', 'wlwmanifest_link'); // Display the link to the Windows Live Writer manifest file.
remove_action('wp_head', 'index_rel_link'); // Index link
remove_action('wp_head', 'parent_post_rel_link', 10, 0); // Prev link
remove_action('wp_head', 'start_post_rel_link', 10, 0); // Start link
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // Display relational links for the posts adjacent to the current post.
remove_action('wp_head', 'wp_generator'); // Display the XHTML generator that is generated on the wp_head hook, WP version
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'rel_canonical');
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);

// Add Filters
add_filter('avatar_defaults', 'html5blankgravatar'); // Custom Gravatar in Settings > Discussion
add_filter('body_class', 'add_slug_to_body_class'); // Add slug to body class (Starkers build)
add_filter('widget_text', 'do_shortcode'); // Allow shortcodes in Dynamic Sidebar
add_filter('widget_text', 'shortcode_unautop'); // Remove <p> tags in Dynamic Sidebars (better!)
add_filter('wp_nav_menu_args', 'my_wp_nav_menu_args'); // Remove surrounding <div> from WP Navigation
// add_filter('nav_menu_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected classes (Commented out by default)
// add_filter('nav_menu_item_id', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected ID (Commented out by default)
// add_filter('page_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> Page ID's (Commented out by default)
add_filter('the_category', 'remove_category_rel_from_category_list'); // Remove invalid rel attribute
add_filter('show_admin_bar', 'remove_admin_bar'); // Remove Admin bar
add_filter('style_loader_tag', 'html5_style_remove'); // Remove 'text/css' from enqueued stylesheet
add_filter('post_thumbnail_html', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to thumbnails
add_filter('image_send_to_editor', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to post images


function custom_editor_styles() {
add_editor_style( 'my-editor-styles.css');
}
add_action( 'admin_init', 'custom_editor_styles' );


function add_editor_buttons($buttons) {
$buttons[] = 'styleselect';
return $buttons;
}
add_filter('mce_buttons_2', 'add_editor_buttons');


// add custom styles to the WordPress editor
function my_mce_before_init_insert_formats( $init_array ) {

$style_formats = array(
// These are the custom styles
array(
'title' => 'Question',
'inline' => 'span',
'classes' => 'question color-1',
'wrapper' => true,
),
array(
'title' => 'Answer',
'inline' => 'span',
'classes' => 'answer',
'wrapper' => true,
),
array(
'title' => 'Initials',
'inline' => 'span',
'classes' => 'initials color-1 background-color-2',
'wrapper' => false,
),
);
// Insert the array, JSON ENCODED, into 'style_formats'
$init_array['style_formats'] = json_encode( $style_formats );

return $init_array;

}
// Attach callback to 'tiny_mce_before_init'
add_filter( 'tiny_mce_before_init', 'my_mce_before_init_insert_formats' );


/*------------------------------------*\
	Custom Post Types
\*------------------------------------*/

// Story
function create_post_type_story()
{
    register_taxonomy_for_object_type('category', 'Story'); // Register Taxonomies for Category
    register_taxonomy_for_object_type('post_tag', 'Story');
    register_post_type('Story', // Register Story Post Type
        array(
        'labels' => array(
            'name' => __('Story', 'story'), // Rename these to suit
            'label' => 'Story','description' => '',
            'singular_name' => __('Story', 'Story'),
            'add_new' => __('Add New', 'story'),
            'add_new_item' => __('Add New Story', 'story'),
            'edit' => __('Edit', 'story'),
            'edit_item' => __('Edit Story', 'story'),
            'new_item' => __('New Story', 'story'),
            'view' => __('View Story', 'story'),
            'view_item' => __('View Story', 'story'),
            'search_items' => __('Search Story', 'story'),
            'not_found' => __('No Story', 'story'),
            'not_found_in_trash' => __('No Story found in Trash', 'story')
        ),
        'public' => true,
        'hierarchical' => true, // Allows posts to behave like Hierarchy Pages
        'has_archive' => true,
        'supports' => array(
            'title',
            'editor',
            'thumbnail'
        ), // Go to Dashboard Story for supports
        'can_export' => true, // Allows export in Tools > Export
        'taxonomies' => array(
            'post_tag',
            'category'
        ) // Add Category and Post Tags support
    ));
}

// Letter
function create_post_type_letter()
{
    register_taxonomy_for_object_type('category', 'Letter'); // Register Taxonomies for Category
    register_taxonomy_for_object_type('post_tag', 'Letter');
    register_post_type('Letter', // Register Letter Post Type
        array(
        'labels' => array(
            'name' => __('Letter from the Director', 'letter'), // Rename these to suit
            'label' => 'Letter','description' => '',
            'singular_name' => __('Letter', 'Letter'),
            'add_new' => __('Add New', 'letter'),
            'add_new_item' => __('Add New Letter', 'letter'),
            'edit' => __('Edit', 'letter'),
            'edit_item' => __('Edit Letter', 'letter'),
            'new_item' => __('New Letter', 'letter'),
            'view' => __('View Letter', 'letter'),
            'view_item' => __('View Letter', 'letter'),
            'search_items' => __('Search Letter', 'letter'),
            'not_found' => __('No Letter', 'letter'),
            'not_found_in_trash' => __('No Letter found in Trash', 'letter')
        ),
        'public' => true,
        'hierarchical' => true, // Allows posts to behave like Hierarchy Pages
        'has_archive' => true,
        'supports' => array(
            'title',
            'editor',
            'thumbnail'
        ), // Go to Dashboard Letter for supports
        'can_export' => true, // Allows export in Tools > Export
        'taxonomies' => array(
            'post_tag',
            'category'
        ) // Add Category and Post Tags support
    ));
}

// Q and A
function create_post_type_interview()
{
    register_taxonomy_for_object_type('category', 'Interview'); // Register Taxonomies for Category
    register_taxonomy_for_object_type('post_tag', 'Interview');
    register_post_type('Interview', // Register Interview Post Type
        array(
        'labels' => array(
            'name' => __('Interview', 'interview'), // Rename these to suit
            'label' => 'Interview','description' => '',
            'singular_name' => __('Interview', 'Interview'),
            'add_new' => __('Add New', 'interview'),
            'add_new_item' => __('Add New Interview', 'interview'),
            'edit' => __('Edit', 'interview'),
            'edit_item' => __('Edit Interview', 'interview'),
            'new_item' => __('New Interview', 'interview'),
            'view' => __('View Interview', 'interview'),
            'view_item' => __('View Interview', 'interview'),
            'search_items' => __('Search Interview', 'interview'),
            'not_found' => __('No Interview', 'interview'),
            'not_found_in_trash' => __('No Interview found in Trash', 'interview')
        ),
        'public' => true,
        'hierarchical' => true, // Allows your posts to behave like Hierarchy Pages
        'has_archive' => true,
        'supports' => array(
            'title',
            'editor',
            'thumbnail'
        ), // Go to Dashboard Q and A for supports
        'can_export' => true, // Allows export in Tools > Export
        'taxonomies' => array(
            'post_tag',
            'category'
        ) // Add Category and Post Tags support
    ));
}

// Points of Pride
function create_post_type_points_of_pride()
{
    register_taxonomy_for_object_type('category', 'Points of Pride'); // Register Taxonomies for Category
    register_taxonomy_for_object_type('post_tag', 'Points of Pride');
    register_post_type('points-of-pride', // Register Points of Pride Post Type
        array(
        'labels' => array(
            'name' => __('Points of Pride', 'points-of-pride'), // Rename these to suit
            'label' => 'Points of Pride','description' => '',
            'singular_name' => __('Points of Pride', 'points-of-pride'),
            'add_new' => __('Add New', 'points-of-pride'),
            'add_new_item' => __('Add New Points of Pride', 'points-of-pride'),
            'edit' => __('Edit', 'points-of-pride'),
            'edit_item' => __('Edit Points of Pride', 'points-of-pride'),
            'new_item' => __('New Points of Pride', 'points-of-pride'),
            'view' => __('', 'points-of-pride'),
            'view_item' => __('View Points of Pride', 'points-of-pride'),
            'search_items' => __('Search Points of Pride', 'points-of-pride'),
            'not_found' => __('No Points of Pride', 'points-of-pride'),
            'not_found_in_trash' => __('No Points of Pride found in Trash', 'points-of-pride')
        ),
        'public' => true,
        'hierarchical' => true, // Allows your posts to behave like Hierarchy Pages
        'has_archive' => true,
        'supports' => array(
            'title',
            'editor',
            'thumbnail'
        ), // Go to Dashboard Points of Pride for supports
        'can_export' => true, // Allows export in Tools > Export
        'taxonomies' => array(
            'post_tag',
            'category'
        ) // Add Category and Post Tags support
    ));
}

// add category in body and post class
function category_id_class( $classes ) {
    global $post;
    foreach ( get_the_category( $post->ID ) as $category ) {
        $classes[] = $category->category_featured;
    }
    return $classes;
}

add_filter( 'post_class', 'category_id_class' );
add_filter( 'body_class', 'category_id_class' );


// Show all post types in loop
add_action( 'pre_get_posts', 'add_my_post_types_to_query' );

function add_my_post_types_to_query( $query )
{
    if ( is_home() && $query->is_main_query() )
        $query->set( 'post_type', array( 'story', 'interview' ) );
    return $query;
}

?>


