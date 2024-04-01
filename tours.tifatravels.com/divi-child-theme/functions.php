<?php

add_action( 'wp_enqueue_scripts', 'divi_enqueue_scripts_styles' );

function divi_enqueue_scripts_styles() {
    $parenthandle = 'divi-style'; 
    $theme = wp_get_theme();
    wp_enqueue_style( $parenthandle, get_template_directory_uri() . '/style.css', 
        array(),
        $theme->parent()->get('Version')
    );
    wp_enqueue_style( 'divi-child-theme-style', get_stylesheet_uri(),
        array( $parenthandle ),
        $theme->get('Version')
    );
}

// remove projects post type in divi elegante themes
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

// ADDING CUSTOM POST TYPES (WITH CPT UI) - SERVICES, TRAVEL BLOG, & TRAVEL PACKAGES

function cptui_register_my_cpts() {

    /**
     * Post Type: Travel Blog.
     */
    
    $labels = [
        "name" => esc_html__( "Travel Blog", "custom-post-type-ui" ),
        "singular_name" => esc_html__( "Travel Blog", "custom-post-type-ui" ),
        "menu_name" => esc_html__( "Travel Blog", "custom-post-type-ui" ),
        "all_items" => esc_html__( "All Travel Blog", "custom-post-type-ui" ),
        "add_new" => esc_html__( "Add new", "custom-post-type-ui" ),
        "add_new_item" => esc_html__( "Add new Travel Blog", "custom-post-type-ui" ),
        "edit_item" => esc_html__( "Edit Travel Blog", "custom-post-type-ui" ),
        "new_item" => esc_html__( "New Travel Blog", "custom-post-type-ui" ),
        "view_item" => esc_html__( "View Travel Blog", "custom-post-type-ui" ),
        "view_items" => esc_html__( "View Travel Blog", "custom-post-type-ui" ),
        "search_items" => esc_html__( "Search Travel Blog", "custom-post-type-ui" ),
        "not_found" => esc_html__( "No Travel Blog found", "custom-post-type-ui" ),
        "not_found_in_trash" => esc_html__( "No Travel Blog found in trash", "custom-post-type-ui" ),
        "parent" => esc_html__( "Parent Travel Blog:", "custom-post-type-ui" ),
        "featured_image" => esc_html__( "Featured image for this Travel Blog", "custom-post-type-ui" ),
        "set_featured_image" => esc_html__( "Set featured image for this Travel Blog", "custom-post-type-ui" ),
        "remove_featured_image" => esc_html__( "Remove featured image for this Travel Blog", "custom-post-type-ui" ),
        "use_featured_image" => esc_html__( "Use as featured image for this Travel Blog", "custom-post-type-ui" ),
        "archives" => esc_html__( "Travel Blog archives", "custom-post-type-ui" ),
        "insert_into_item" => esc_html__( "Insert into Travel Blog", "custom-post-type-ui" ),
        "uploaded_to_this_item" => esc_html__( "Upload to this Travel Blog", "custom-post-type-ui" ),
        "filter_items_list" => esc_html__( "Filter Travel Blog list", "custom-post-type-ui" ),
        "items_list_navigation" => esc_html__( "Travel Blog list navigation", "custom-post-type-ui" ),
        "items_list" => esc_html__( "Travel Blog list", "custom-post-type-ui" ),
        "attributes" => esc_html__( "Travel Blog attributes", "custom-post-type-ui" ),
        "name_admin_bar" => esc_html__( "Travel Blog", "custom-post-type-ui" ),
        "item_published" => esc_html__( "Travel Blog published", "custom-post-type-ui" ),
        "item_published_privately" => esc_html__( "Travel Blog published privately.", "custom-post-type-ui" ),
        "item_reverted_to_draft" => esc_html__( "Travel Blog reverted to draft.", "custom-post-type-ui" ),
        "item_scheduled" => esc_html__( "Travel Blog scheduled", "custom-post-type-ui" ),
        "item_updated" => esc_html__( "Travel Blog updated.", "custom-post-type-ui" ),
        "parent_item_colon" => esc_html__( "Parent Travel Blog:", "custom-post-type-ui" ),
    ];
    
    $args = [
        "label" => esc_html__( "Travel Blog", "custom-post-type-ui" ),
        "labels" => $labels,
        "description" => "",
        "public" => true,
        "publicly_queryable" => true,
        "show_ui" => true,
        "show_in_rest" => true,
        "rest_base" => "",
        "rest_controller_class" => "WP_REST_Posts_Controller",
        "rest_namespace" => "wp/v2",
        "has_archive" => true,
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "delete_with_user" => false,
        "exclude_from_search" => false,
        "capability_type" => "post",
        "map_meta_cap" => true,
        "hierarchical" => false,
        "can_export" => true,
        "rewrite" => [ "slug" => "blog", "with_front" => true ],
        "query_var" => true,
        "menu_position" => 5,
        "menu_icon" => "dashicons-welcome-write-blog",
        "supports" => [ "title", "editor", "thumbnail", "excerpt", "custom-fields", "comments", "revisions", "author", "page-attributes" ],
        "taxonomies" => [ "category", "post_tag" ],
        "show_in_graphql" => false,
    ];
    
    register_post_type( "blog", $args );
    
    /**
     * Post Type: Travel Packages.
     */
    
    $labels = [
        "name" => esc_html__( "Travel Packages", "custom-post-type-ui" ),
        "singular_name" => esc_html__( "Travel Package", "custom-post-type-ui" ),
        "menu_name" => esc_html__( "Travel Packages", "custom-post-type-ui" ),
        "all_items" => esc_html__( "All Travel Packages", "custom-post-type-ui" ),
        "add_new" => esc_html__( "Add new", "custom-post-type-ui" ),
        "add_new_item" => esc_html__( "Add new Travel Package", "custom-post-type-ui" ),
        "edit_item" => esc_html__( "Edit Travel Package", "custom-post-type-ui" ),
        "new_item" => esc_html__( "New Travel Package", "custom-post-type-ui" ),
        "view_item" => esc_html__( "View Travel Package", "custom-post-type-ui" ),
        "view_items" => esc_html__( "View Travel Packages", "custom-post-type-ui" ),
        "search_items" => esc_html__( "Search Travel Packages", "custom-post-type-ui" ),
        "not_found" => esc_html__( "No Travel Packages found", "custom-post-type-ui" ),
        "not_found_in_trash" => esc_html__( "No Travel Packages found in trash", "custom-post-type-ui" ),
        "parent" => esc_html__( "Parent Travel Package:", "custom-post-type-ui" ),
        "featured_image" => esc_html__( "Featured image for this Travel Package", "custom-post-type-ui" ),
        "set_featured_image" => esc_html__( "Set featured image for this Travel Package", "custom-post-type-ui" ),
        "remove_featured_image" => esc_html__( "Remove featured image for this Travel Package", "custom-post-type-ui" ),
        "use_featured_image" => esc_html__( "Use as featured image for this Travel Package", "custom-post-type-ui" ),
        "archives" => esc_html__( "Travel Package archives", "custom-post-type-ui" ),
        "insert_into_item" => esc_html__( "Insert into Travel Package", "custom-post-type-ui" ),
        "uploaded_to_this_item" => esc_html__( "Upload to this Travel Package", "custom-post-type-ui" ),
        "filter_items_list" => esc_html__( "Filter Travel Packages list", "custom-post-type-ui" ),
        "items_list_navigation" => esc_html__( "Travel Packages list navigation", "custom-post-type-ui" ),
        "items_list" => esc_html__( "Travel Packages list", "custom-post-type-ui" ),
        "attributes" => esc_html__( "Travel Packages attributes", "custom-post-type-ui" ),
        "name_admin_bar" => esc_html__( "Travel Package", "custom-post-type-ui" ),
        "item_published" => esc_html__( "Travel Package published", "custom-post-type-ui" ),
        "item_published_privately" => esc_html__( "Travel Package published privately.", "custom-post-type-ui" ),
        "item_reverted_to_draft" => esc_html__( "Travel Package reverted to draft.", "custom-post-type-ui" ),
        "item_scheduled" => esc_html__( "Travel Package scheduled", "custom-post-type-ui" ),
        "item_updated" => esc_html__( "Travel Package updated.", "custom-post-type-ui" ),
        "parent_item_colon" => esc_html__( "Parent Travel Package:", "custom-post-type-ui" ),
    ];
    
    $args = [
        "label" => esc_html__( "Travel Packages", "custom-post-type-ui" ),
        "labels" => $labels,
        "description" => "",
        "public" => true,
        "publicly_queryable" => true,
        "show_ui" => true,
        "show_in_rest" => true,
        "rest_base" => "",
        "rest_controller_class" => "WP_REST_Posts_Controller",
        "rest_namespace" => "wp/v2",
        "has_archive" => "packages",
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "delete_with_user" => false,
        "exclude_from_search" => false,
        "capability_type" => "post",
        "map_meta_cap" => true,
        "hierarchical" => false,
        "can_export" => true,
        "rewrite" => [ "slug" => "package", "with_front" => true ],
        "query_var" => true,
        "menu_position" => 6,
        "menu_icon" => "dashicons-airplane",
        "supports" => [ "title", "editor", "thumbnail", "excerpt", "custom-fields", "revisions" ],
        "taxonomies" => [ "location", "package_type" ],
        "show_in_graphql" => false,
    ];
    
    register_post_type( "package", $args );
    
    /**
     * Post Type: Travel Services.
     */
    
    $labels = [
        "name" => esc_html__( "Travel Services", "custom-post-type-ui" ),
        "singular_name" => esc_html__( "Travel Service", "custom-post-type-ui" ),
        "menu_name" => esc_html__( "Travel Services", "custom-post-type-ui" ),
        "all_items" => esc_html__( "All Travel Services", "custom-post-type-ui" ),
        "add_new" => esc_html__( "Add new", "custom-post-type-ui" ),
        "add_new_item" => esc_html__( "Add new Travel Service", "custom-post-type-ui" ),
        "edit_item" => esc_html__( "Edit Travel Service", "custom-post-type-ui" ),
        "new_item" => esc_html__( "New Travel Service", "custom-post-type-ui" ),
        "view_item" => esc_html__( "View Travel Service", "custom-post-type-ui" ),
        "view_items" => esc_html__( "View Travel Services", "custom-post-type-ui" ),
        "search_items" => esc_html__( "Search Travel Services", "custom-post-type-ui" ),
        "not_found" => esc_html__( "No Travel Services found", "custom-post-type-ui" ),
        "not_found_in_trash" => esc_html__( "No Travel Services found in trash", "custom-post-type-ui" ),
        "parent" => esc_html__( "Parent Travel Service:", "custom-post-type-ui" ),
        "featured_image" => esc_html__( "Featured image for this Travel Service", "custom-post-type-ui" ),
        "set_featured_image" => esc_html__( "Set featured image for this Travel Service", "custom-post-type-ui" ),
        "remove_featured_image" => esc_html__( "Remove featured image for this Travel Service", "custom-post-type-ui" ),
        "use_featured_image" => esc_html__( "Use as featured image for this Travel Service", "custom-post-type-ui" ),
        "archives" => esc_html__( "Travel Service archives", "custom-post-type-ui" ),
        "insert_into_item" => esc_html__( "Insert into Travel Service", "custom-post-type-ui" ),
        "uploaded_to_this_item" => esc_html__( "Upload to this Travel Service", "custom-post-type-ui" ),
        "filter_items_list" => esc_html__( "Filter Travel Services list", "custom-post-type-ui" ),
        "items_list_navigation" => esc_html__( "Travel Services list navigation", "custom-post-type-ui" ),
        "items_list" => esc_html__( "Travel Services list", "custom-post-type-ui" ),
        "attributes" => esc_html__( "Travel Services attributes", "custom-post-type-ui" ),
        "name_admin_bar" => esc_html__( "Travel Service", "custom-post-type-ui" ),
        "item_published" => esc_html__( "Travel Service published", "custom-post-type-ui" ),
        "item_published_privately" => esc_html__( "Travel Service published privately.", "custom-post-type-ui" ),
        "item_reverted_to_draft" => esc_html__( "Travel Service reverted to draft.", "custom-post-type-ui" ),
        "item_scheduled" => esc_html__( "Travel Service scheduled", "custom-post-type-ui" ),
        "item_updated" => esc_html__( "Travel Service updated.", "custom-post-type-ui" ),
        "parent_item_colon" => esc_html__( "Parent Travel Service:", "custom-post-type-ui" ),
    ];
    
    $args = [
        "label" => esc_html__( "Travel Services", "custom-post-type-ui" ),
        "labels" => $labels,
        "description" => "",
        "public" => true,
        "publicly_queryable" => true,
        "show_ui" => true,
        "show_in_rest" => true,
        "rest_base" => "",
        "rest_controller_class" => "WP_REST_Posts_Controller",
        "rest_namespace" => "wp/v2",
        "has_archive" => "services",
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "delete_with_user" => false,
        "exclude_from_search" => false,
        "capability_type" => "post",
        "map_meta_cap" => true,
        "hierarchical" => false,
        "can_export" => true,
        "rewrite" => [ "slug" => "service", "with_front" => true ],
        "query_var" => true,
        "menu_position" => 7,
        "menu_icon" => "dashicons-welcome-learn-more",
        "supports" => [ "title", "editor", "thumbnail", "excerpt", "custom-fields", "revisions", "page-attributes" ],
        "show_in_graphql" => false,
    ];
    
    register_post_type( "service", $args );
    }
    
    add_action( 'init', 'cptui_register_my_cpts' );
    
    // END CUSTOM POST TYPES (WITH CPT UI) - SERVICES, TRAVEL BLOG, & TRAVEL PACKAGES
    
    // ADDING CUSTOM TAXONOMIES (WITH CPT UI) - LOCATIONS, & TYPE
    
    function cptui_register_my_taxes() {
    
    /**
     * Taxonomy: Locations.
     */
    
    $labels = [
        "name" => esc_html__( "Locations", "custom-post-type-ui" ),
        "singular_name" => esc_html__( "Location", "custom-post-type-ui" ),
        "menu_name" => esc_html__( "Locations", "custom-post-type-ui" ),
        "all_items" => esc_html__( "All Locations", "custom-post-type-ui" ),
        "edit_item" => esc_html__( "Edit Location", "custom-post-type-ui" ),
        "view_item" => esc_html__( "View Location", "custom-post-type-ui" ),
        "update_item" => esc_html__( "Update Location name", "custom-post-type-ui" ),
        "add_new_item" => esc_html__( "Add new Location", "custom-post-type-ui" ),
        "new_item_name" => esc_html__( "New Location name", "custom-post-type-ui" ),
        "parent_item" => esc_html__( "Parent Location", "custom-post-type-ui" ),
        "parent_item_colon" => esc_html__( "Parent Location:", "custom-post-type-ui" ),
        "search_items" => esc_html__( "Search Locations", "custom-post-type-ui" ),
        "popular_items" => esc_html__( "Popular Locations", "custom-post-type-ui" ),
        "separate_items_with_commas" => esc_html__( "Separate Locations with commas", "custom-post-type-ui" ),
        "add_or_remove_items" => esc_html__( "Add or remove Locations", "custom-post-type-ui" ),
        "choose_from_most_used" => esc_html__( "Choose from the most used Locations", "custom-post-type-ui" ),
        "not_found" => esc_html__( "No Locations found", "custom-post-type-ui" ),
        "no_terms" => esc_html__( "No Locations", "custom-post-type-ui" ),
        "items_list_navigation" => esc_html__( "Locations list navigation", "custom-post-type-ui" ),
        "items_list" => esc_html__( "Locations list", "custom-post-type-ui" ),
        "back_to_items" => esc_html__( "Back to Locations", "custom-post-type-ui" ),
        "name_field_description" => esc_html__( "The name is how it appears on your site.", "custom-post-type-ui" ),
        "parent_field_description" => esc_html__( "Assign a parent term to create a hierarchy. The term Jazz, for example, would be the parent of Bebop and Big Band.", "custom-post-type-ui" ),
        "slug_field_description" => esc_html__( "The slug is the URL-friendly version of the name. It is usually all lowercase and contains only letters, numbers, and hyphens.", "custom-post-type-ui" ),
        "desc_field_description" => esc_html__( "The description is not prominent by default; however, some themes may show it.", "custom-post-type-ui" ),
    ];
    
    
    $args = [
        "label" => esc_html__( "Locations", "custom-post-type-ui" ),
        "labels" => $labels,
        "public" => true,
        "publicly_queryable" => true,
        "hierarchical" => true,
        "show_ui" => true,
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "query_var" => true,
        "rewrite" => [ 'slug' => 'location', 'with_front' => true,  'hierarchical' => true, ],
        "show_admin_column" => true,
        "show_in_rest" => true,
        "show_tagcloud" => false,
        "rest_base" => "location",
        "rest_controller_class" => "WP_REST_Terms_Controller",
        "rest_namespace" => "wp/v2",
        "show_in_quick_edit" => true,
        "sort" => true,
        "show_in_graphql" => false,
    ];
    register_taxonomy( "location", [ "package" ], $args );
    
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
        "rewrite" => [ 'slug' => 'package_type', 'with_front' => true, ],
        "show_admin_column" => true,
        "show_in_rest" => true,
        "show_tagcloud" => false,
        "rest_base" => "package_type",
        "rest_controller_class" => "WP_REST_Terms_Controller",
        "rest_namespace" => "wp/v2",
        "show_in_quick_edit" => true,
        "sort" => true,
        "show_in_graphql" => false,
    ];
    register_taxonomy( "package_type", [ "package" ], $args );
    }
    add_action( 'init', 'cptui_register_my_taxes' );
    
    // END CUSTOM TAXONOMIES (WITH CPT UI) - LOCATIONS, & TYPE


/* ALLOW DIVI ACCESS TO 'woff' and 'woff2' files */

/* Mime Types Support */
/* add_filter('upload_mimes', 'custom_mime_types', 999999);

function custom_mime_types($mimes) {
  $mimes['otf'] = 'application/x-font-opentype';
  $mimes['woff'] = 'application/font-woff';
  $mimes['woff2'] = 'application/font-woff2';
  return $mimes;
} */

/* Custom Font Types Support */
/* add_filter('et_pb_supported_font_formats', 'custom_font_formats', 1);

function custom_font_formats() { 
return array('otf', 'woff', 'woff2');
} */

