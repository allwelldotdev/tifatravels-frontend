<?php

// enqueue css stylesheets
function divi_enqueue_scripts_styles() {
    $parenthandle = 'divi-style'; 
    $theme = wp_get_theme();
    wp_enqueue_style( $parenthandle, get_template_directory_uri() . '/style.css', array(),
        $theme->parent()->get('Version')
    );
    wp_enqueue_style('font-awesome-solid', get_stylesheet_directory_uri() . '/css/solid.css', array($parenthandle), '6.3.0', 'all');
    wp_enqueue_style('font-awesome', get_stylesheet_directory_uri() . '/css/fontawesome.min.css', array($parenthandle, 'font-awesome-solid'), '6.3.0', 'all');
    wp_enqueue_style( 'divi-child-theme', get_stylesheet_uri(), array( $parenthandle, 'font-awesome' ),
        $theme->get('Version') /* filemtime(get_stylesheet_directory() . '/style.css') */
    );
}
add_action( 'wp_enqueue_scripts', 'divi_enqueue_scripts_styles' );

// remove projects post type in divi elegant themes
add_filter('et_project_posttype_args', 'mytheme_et_project_posttype_args', 10, 1);
function mytheme_et_project_posttype_args($args) {
    return array_merge($args, array(
        'public'              => false,
		'exclude_from_search' => false,
		'publicly_queryable'  => false,
		'show_in_nav_menus'   => false,
		'show_ui'             => false
    ));
}


// ADDING CUSTOM POST TYPES (WITH CPT UI) - HOLIDAYS

function cptui_register_my_cpts() {

    /**
     * Post Type: Holidays.
     */
    
    $labels = [
        "name" => esc_html__( "Holidays", "custom-post-type-ui" ),
        "singular_name" => esc_html__( "Holiday", "custom-post-type-ui" ),
        "menu_name" => esc_html__( "Holidays", "custom-post-type-ui" ),
        "all_items" => esc_html__( "All Holidays", "custom-post-type-ui" ),
        "add_new" => esc_html__( "Add new", "custom-post-type-ui" ),
        "add_new_item" => esc_html__( "Add new Holiday", "custom-post-type-ui" ),
        "edit_item" => esc_html__( "Edit Holiday", "custom-post-type-ui" ),
        "new_item" => esc_html__( "New Holiday", "custom-post-type-ui" ),
        "view_item" => esc_html__( "View Holiday", "custom-post-type-ui" ),
        "view_items" => esc_html__( "View Holidays", "custom-post-type-ui" ),
        "search_items" => esc_html__( "Search Holidays", "custom-post-type-ui" ),
        "not_found" => esc_html__( "No Holidays found", "custom-post-type-ui" ),
        "not_found_in_trash" => esc_html__( "No Holidays found in trash", "custom-post-type-ui" ),
        "parent" => esc_html__( "Parent Holiday:", "custom-post-type-ui" ),
        "featured_image" => esc_html__( "Featured image for this Holiday", "custom-post-type-ui" ),
        "set_featured_image" => esc_html__( "Set featured image for this Holiday", "custom-post-type-ui" ),
        "remove_featured_image" => esc_html__( "Remove featured image for this Holiday", "custom-post-type-ui" ),
        "use_featured_image" => esc_html__( "Use as featured image for this Holiday", "custom-post-type-ui" ),
        "archives" => esc_html__( "Holiday archives", "custom-post-type-ui" ),
        "insert_into_item" => esc_html__( "Insert into Holiday", "custom-post-type-ui" ),
        "uploaded_to_this_item" => esc_html__( "Upload to this Holiday", "custom-post-type-ui" ),
        "filter_items_list" => esc_html__( "Filter Holidays list", "custom-post-type-ui" ),
        "items_list_navigation" => esc_html__( "Holidays list navigation", "custom-post-type-ui" ),
        "items_list" => esc_html__( "Holidays list", "custom-post-type-ui" ),
        "attributes" => esc_html__( "Holidays attributes", "custom-post-type-ui" ),
        "name_admin_bar" => esc_html__( "Holiday", "custom-post-type-ui" ),
        "item_published" => esc_html__( "Holiday published", "custom-post-type-ui" ),
        "item_published_privately" => esc_html__( "Holiday published privately.", "custom-post-type-ui" ),
        "item_reverted_to_draft" => esc_html__( "Holiday reverted to draft.", "custom-post-type-ui" ),
        "item_scheduled" => esc_html__( "Holiday scheduled", "custom-post-type-ui" ),
        "item_updated" => esc_html__( "Holiday updated.", "custom-post-type-ui" ),
        "parent_item_colon" => esc_html__( "Parent Holiday:", "custom-post-type-ui" ),
    ];
    
    $args = [
        "label" => esc_html__( "Holidays", "custom-post-type-ui" ),
        "labels" => $labels,
        "description" => "",
        "public" => true,
        "publicly_queryable" => true,
        "show_ui" => true,
        "show_in_rest" => true,
        "rest_base" => "",
        "rest_controller_class" => "WP_REST_Posts_Controller",
        "rest_namespace" => "wp/v2",
        "has_archive" => "holidays",
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "delete_with_user" => false,
        "exclude_from_search" => false,
        "capability_type" => "post",
        "map_meta_cap" => true,
        "hierarchical" => false,
        "can_export" => true,
        "rewrite" => [ "slug" => "holiday", "with_front" => true ],
        "query_var" => true,
        "menu_position" => 6,
        "menu_icon" => "dashicons-airplane",
        "supports" => [ "title", "editor", "thumbnail", "excerpt", "custom-fields", "revisions" ],
        "taxonomies" => [ "destination", "holiday_type" ],
        "show_in_graphql" => false,
    ];
    
    register_post_type( "holiday", $args );
    }
    
    add_action( 'init', 'cptui_register_my_cpts' );
    
    // END CUSTOM POST TYPES (WITH CPT UI) - HOLIDAYS
    
    // ADDING CUSTOM TAXONOMIES (WITH CPT UI) - DESTINATIONS, & TYPE
    
    function cptui_register_my_taxes() {
    
    /**
     * Taxonomy: Destinations.
     */
    
    $labels = [
        "name" => esc_html__( "Destinations", "custom-post-type-ui" ),
        "singular_name" => esc_html__( "Destination", "custom-post-type-ui" ),
        "menu_name" => esc_html__( "Destinations", "custom-post-type-ui" ),
        "all_items" => esc_html__( "All Destinations", "custom-post-type-ui" ),
        "edit_item" => esc_html__( "Edit Destination", "custom-post-type-ui" ),
        "view_item" => esc_html__( "View Destination", "custom-post-type-ui" ),
        "update_item" => esc_html__( "Update Destination name", "custom-post-type-ui" ),
        "add_new_item" => esc_html__( "Add new Destination", "custom-post-type-ui" ),
        "new_item_name" => esc_html__( "New Destination name", "custom-post-type-ui" ),
        "parent_item" => esc_html__( "Parent Destination", "custom-post-type-ui" ),
        "parent_item_colon" => esc_html__( "Parent Destination:", "custom-post-type-ui" ),
        "search_items" => esc_html__( "Search Destinations", "custom-post-type-ui" ),
        "popular_items" => esc_html__( "Popular Destinations", "custom-post-type-ui" ),
        "separate_items_with_commas" => esc_html__( "Separate Destinations with commas", "custom-post-type-ui" ),
        "add_or_remove_items" => esc_html__( "Add or remove Destinations", "custom-post-type-ui" ),
        "choose_from_most_used" => esc_html__( "Choose from the most used Destinations", "custom-post-type-ui" ),
        "not_found" => esc_html__( "No Destinations found", "custom-post-type-ui" ),
        "no_terms" => esc_html__( "No Destinations", "custom-post-type-ui" ),
        "items_list_navigation" => esc_html__( "Destinations list navigation", "custom-post-type-ui" ),
        "items_list" => esc_html__( "Destinations list", "custom-post-type-ui" ),
        "back_to_items" => esc_html__( "Back to Destinations", "custom-post-type-ui" ),
        "name_field_description" => esc_html__( "The name is how it appears on your site.", "custom-post-type-ui" ),
        "parent_field_description" => esc_html__( "Assign a parent term to create a hierarchy. The term Jazz, for example, would be the parent of Bebop and Big Band.", "custom-post-type-ui" ),
        "slug_field_description" => esc_html__( "The slug is the URL-friendly version of the name. It is usually all lowercase and contains only letters, numbers, and hyphens.", "custom-post-type-ui" ),
        "desc_field_description" => esc_html__( "The description is not prominent by default; however, some themes may show it.", "custom-post-type-ui" ),
    ];
    
    
    $args = [
        "label" => esc_html__( "Destinations", "custom-post-type-ui" ),
        "labels" => $labels,
        "public" => true,
        "publicly_queryable" => true,
        "hierarchical" => true,
        "show_ui" => true,
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "query_var" => true,
        "rewrite" => [ 'slug' => 'destination', 'with_front' => true,  'hierarchical' => true, ],
        "show_admin_column" => true,
        "show_in_rest" => true,
        "show_tagcloud" => false,
        "rest_base" => "destination",
        "rest_controller_class" => "WP_REST_Terms_Controller",
        "rest_namespace" => "wp/v2",
        "show_in_quick_edit" => true,
        "sort" => true,
        "show_in_graphql" => false,
    ];
    register_taxonomy( "destination", [ "holiday" ], $args );
    
    /**
     * Taxonomy: Types.
     */
    
    $labels = [
        "name" => esc_html__( "Types", "custom-post-type-ui" ),
        "singular_name" => esc_html__( "Type", "custom-post-type-ui" ),
        "menu_name" => esc_html__( "Types", "custom-post-type-ui" ),
        "all_items" => esc_html__( "All Types", "custom-post-type-ui" ),
        "edit_item" => esc_html__( "Edit Type", "custom-post-type-ui" ),
        "view_item" => esc_html__( "View Type", "custom-post-type-ui" ),
        "update_item" => esc_html__( "Update Type name", "custom-post-type-ui" ),
        "add_new_item" => esc_html__( "Add new Type", "custom-post-type-ui" ),
        "new_item_name" => esc_html__( "New Type name", "custom-post-type-ui" ),
        "parent_item" => esc_html__( "Parent Type", "custom-post-type-ui" ),
        "parent_item_colon" => esc_html__( "Parent Type:", "custom-post-type-ui" ),
        "search_items" => esc_html__( "Search Types", "custom-post-type-ui" ),
        "popular_items" => esc_html__( "Popular Types", "custom-post-type-ui" ),
        "separate_items_with_commas" => esc_html__( "Separate Types with commas", "custom-post-type-ui" ),
        "add_or_remove_items" => esc_html__( "Add or remove Types", "custom-post-type-ui" ),
        "choose_from_most_used" => esc_html__( "Choose from the most used Types", "custom-post-type-ui" ),
        "not_found" => esc_html__( "No Types found", "custom-post-type-ui" ),
        "no_terms" => esc_html__( "No Types", "custom-post-type-ui" ),
        "items_list_navigation" => esc_html__( "Types list navigation", "custom-post-type-ui" ),
        "items_list" => esc_html__( "Types list", "custom-post-type-ui" ),
        "back_to_items" => esc_html__( "Back to Types", "custom-post-type-ui" ),
        "name_field_description" => esc_html__( "The name is how it appears on your site.", "custom-post-type-ui" ),
        "parent_field_description" => esc_html__( "Assign a parent term to create a hierarchy. The term Jazz, for example, would be the parent of Bebop and Big Band.", "custom-post-type-ui" ),
        "slug_field_description" => esc_html__( "The slug is the URL-friendly version of the name. It is usually all lowercase and contains only letters, numbers, and hyphens.", "custom-post-type-ui" ),
        "desc_field_description" => esc_html__( "The description is not prominent by default; however, some themes may show it.", "custom-post-type-ui" ),
    ];
    
    
    $args = [
        "label" => esc_html__( "Types", "custom-post-type-ui" ),
        "labels" => $labels,
        "public" => true,
        "publicly_queryable" => true,
        "hierarchical" => false,
        "show_ui" => true,
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "query_var" => true,
        "rewrite" => [ 'slug' => 'holiday_type', 'with_front' => true, ],
        "show_admin_column" => true,
        "show_in_rest" => true,
        "show_tagcloud" => false,
        "rest_base" => "holiday_type",
        "rest_controller_class" => "WP_REST_Terms_Controller",
        "rest_namespace" => "wp/v2",
        "show_in_quick_edit" => true,
        "sort" => true,
        "show_in_graphql" => false,
    ];
    register_taxonomy( "holiday_type", [ "holiday" ], $args );
    }
    add_action( 'init', 'cptui_register_my_taxes' );
    
// END CUSTOM TAXONOMIES (WITH CPT UI) - DESTINATIONS, & TYPE

