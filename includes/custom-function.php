<?php
function register_property_post_type() {
    $labels = array(
        'name'               => _x('Properties', 'post type general name'),
        'singular_name'      => _x('Property', 'post type singular name'),
        'menu_name'          => _x('Properties', 'admin menu'),
        'name_admin_bar'     => _x('Property', 'add new on admin bar'),
        'add_new'            => _x('Add New', 'Property'),
        'add_new_item'       => __('Add New Property'),
        'new_item'           => __('New Property'),
        'edit_item'          => __('Edit Property'),
        'view_item'          => __('View Property'),
        'all_items'          => __('All Properties'),
        'search_items'       => __('Search Properties'),
        'not_found'          => __('No Properties found.'),
        'not_found_in_trash' => __('No Properties found in Trash.')
    );

    $args = array(
        'labels'             => $labels,
        'public'             => false,  // Set to false to hide from front-end
        'publicly_queryable' => false,  // Don't allow public query
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'property'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
        'show_in_rest'       => true, // For Gutenberg support
    );

    // Register the custom post type
    register_post_type('property', $args);


    $labels = array(
        'name'               => _x('Projects', 'post type general name'),
        'singular_name'      => _x('Project', 'post type singular name'),
        'menu_name'          => _x('Projects', 'admin menu'),
        'name_admin_bar'     => _x('Project', 'add new on admin bar'),
        'add_new'            => _x('Add New', 'Project'),
        'add_new_item'       => __('Add New Project'),
        'new_item'           => __('New Project'),
        'edit_item'          => __('Edit Project'),
        'view_item'          => __('View Project'),
        'all_items'          => __('All Projects'),
        'search_items'       => __('Search Projects'),
        'not_found'          => __('No Projects found.'),
        'not_found_in_trash' => __('No Projects found in Trash.')
    );
    
    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'project'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
        'show_in_rest'       => true, // For Gutenberg support
    );
    
    // Register the custom post type for projects
    register_post_type('project', $args);


    $labels = array(
        'name'               => _x('Agents', 'post type general name'),
        'singular_name'      => _x('Agent', 'post type singular name'),
        'menu_name'          => _x('Agents', 'admin menu'),
        'name_admin_bar'     => _x('Agent', 'add new on admin bar'),
        'add_new'            => _x('Add New', 'Agent'),
        'add_new_item'       => __('Add New Agent'),
        'new_item'           => __('New Agent'),
        'edit_item'          => __('Edit Agent'),
        'view_item'          => __('View Agent'),
        'all_items'          => __('All Agents'),
        'search_items'       => __('Search Agents'),
        'not_found'          => __('No Agents found.'),
        'not_found_in_trash' => __('No Agents found in Trash.')
    );
    
    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'agent'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
        'show_in_rest'       => true, // For Gutenberg support
    );
    
    // Register the custom post type for agents
    register_post_type('agent', $args);
}

add_action('init', 'register_property_post_type');


 /**
 * We have hide the property cpt posts from the front side but use it in the backend queries
 */
function exclude_property_from_frontend_queries($query) {
    if (!is_admin() && $query->is_main_query()) {
        // Exclude Property CPT from the main queries on the front-end
        if (is_post_type_archive('property') || is_singular('property') || is_search()) {
            $query->set('post_type', array('post', 'page'));  // Exclude "property" CPT
        }
    }
}
add_action('pre_get_posts', 'exclude_property_from_frontend_queries');


 /**
 * Add acf map key
 * Method 1: Filter.
 */
add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');
function my_acf_google_map_api( $api ){
    $api['key'] = 'AIzaSyAO29XEV5gSZlmKnsAvIwydgN4admrSFEQ';
    return $api;
}