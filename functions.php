<?php

function Katepress() {
	wp_enqueue_style('style', get_stylesheet_uri());

	wp_enqueue_script('jquery', get_template_directory_uri() . '/assets/js/jquery-1.11.3.min.js');
	wp_enqueue_script('main', get_template_directory_uri() . '/assets/js/main.js');
}
add_action( 'wp_enqueue_scripts', 'Katepress' );

// --------------------

function dynamicNav() {
  register_nav_menu('mainNav',__('Main nav'));
}
add_action('init', 'dynamicNav');

// --------------------

function sidebar(){
  register_sidebar(array(
    'name'          => __('Sidebar'),
    'id'            => 'sidebar',
    'description'   => __('This is a sidebar description.'),
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widgetTitle">',
		'after_title'   => '</h3>'
  ));
}
add_action( 'widgets_init', 'sidebar' );

// --------------------

add_theme_support('post-thumbnails', array('post'));

// --------------------

function removeTagSupport(){
  global $wp_taxonomies;
  $tax = 'post_tag';
  if(taxonomy_exists($tax))
    unset($wp_taxonomies[$tax]);
}
add_action('init', 'removeTagSupport');

// --------------------

function removeAdminBarItems(){
  global $wp_admin_bar;
  $wp_admin_bar->remove_menu('wp-logo');
  $wp_admin_bar->remove_menu('comments');
}
add_action('wp_before_admin_bar_render', 'removeAdminBarItems', 0);

// --------------------

function adminDashboardText(){
  echo 'Website desenvolvido por <em><a href="http://www.sitefy.com.br" target="_blank">Sitefy</a></em>.';
}
add_filter('admin_footer_text', 'adminDashboardText');

// --------------------

function removeAdminDashboardTabs($old_help, $screen_id, $screen){
  $screen->remove_help_tabs();
  return $old_help;
}
add_filter('contextual_help', 'removeAdminDashboardTabs', 999, 3);
add_filter('screen_options_show_screen', '__return_false');

// --------------------

/*
* Child page conditional
* @ Accept's page ID, page slug or page title as parameters
*/
function is_child($parent='') {
  global $post;

  $parent_obj = get_page( $post->post_parent, ARRAY_A );
  $parent = (string) $parent;
  $parent_array = (array) $parent;

  if ( in_array( (string) $parent_obj['ID'], $parent_array ) ) {
    return true;
  } elseif ( in_array( (string) $parent_obj['post_title'], $parent_array ) ) {
    return true;
  } elseif ( in_array( (string) $parent_obj['post_name'], $parent_array ) ) {
    return true;
  } else {
    return false;
  }
}

// --------------------

// This wraps video/iframes on a div to make it responsive :D
function oembedFilter($html, $url, $attr, $post_ID) {
	$return = '<div class="video-container">'.$html.'</div>';
	return $return;
}
add_filter( 'embed_oembed_html', 'oembedFilter', 10, 4 ) ;

// --------------------

// Disable support for comments and trackbacks in post types
function df_disable_comments_post_types_support() {
	$post_types = get_post_types();
	foreach ($post_types as $post_type) {
		if(post_type_supports($post_type, 'comments')) {
			remove_post_type_support($post_type, 'comments');
			remove_post_type_support($post_type, 'trackbacks');
		}
	}
}
add_action('admin_init', 'df_disable_comments_post_types_support');

// Close comments on the front-end by default
function df_disable_comments_status() {
	return false;
}
add_filter('comments_open', 'df_disable_comments_status', 20, 2);
add_filter('pings_open', 'df_disable_comments_status', 20, 2);

// Hide existing comments
function df_disable_comments_hide_existing_comments($comments) {
	$comments = array();
	return $comments;
}
add_filter('comments_array', 'df_disable_comments_hide_existing_comments', 10, 2);

// Remove comments page in menu
function df_disable_comments_admin_menu() {
	remove_menu_page('edit-comments.php');
}
add_action('admin_menu', 'df_disable_comments_admin_menu');

// Redirect any user trying to access comments page
function df_disable_comments_admin_menu_redirect() {
	global $pagenow;
	if ($pagenow === 'edit-comments.php') {
		wp_redirect(admin_url()); exit;
	}
}
add_action('admin_init', 'df_disable_comments_admin_menu_redirect');

// Remove comments metabox from dashboard
function df_disable_comments_dashboard() {
	remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');
}
add_action('admin_init', 'df_disable_comments_dashboard');

// Remove comments links from admin bar
function df_disable_comments_admin_bar() {
	if (is_admin_bar_showing()) {
		remove_action('admin_bar_menu', 'wp_admin_bar_comments_menu', 60);
	}
}
add_action('init', 'df_disable_comments_admin_bar');
