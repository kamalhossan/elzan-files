<?php
// get_lowest_price_for_project
function get_lowest_price_for_project($project_id) {
    // Ensure a valid project ID is passed
    if (empty($project_id) || !is_numeric($project_id)) {
        return null; // Return null if the project ID is invalid
    }

    // Set up a custom WP_Query to fetch all properties with the given project ID
    $args = array(
        'post_type'      => 'property', // Custom post type for Property
        'posts_per_page' => -1, // Get all properties (you can limit this if needed)
        'meta_query'     => array(
            array(
                'key'     => 'select_project', // The ACF relationship field name
                'value'   => '"' . $project_id . '"', // Check if the project ID is in the relationship field
                'compare' => 'LIKE', // Use LIKE to check if the project ID exists in the relationship field
            ),
        ),
    );

    // Run the query
    $query = new WP_Query($args);

    // Initialize a variable to store the lowest price (set to a high number initially)
    $lowest_price = null;

    // Check if there are any posts found
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();

            // Get the price for the current property
            $price = get_field('price'); // ACF field name for price

            // If a price is found and is lower than the current lowest price, update it
            if ($price && is_numeric($price)) {
                if ($lowest_price === null || $price < $lowest_price) {
                    $lowest_price = $price;
                }
            }
        }
    }

    // Reset the post data after the custom query
    wp_reset_postdata();

    // Return the lowest price (or null if no prices were found)
    return $lowest_price;
}

// get_agent_details_by_agent_id
function get_agent_details_by_agent_id($agent_id) {
    // Ensure a valid post ID is provided
    if (empty($agent_id) || !is_numeric($agent_id)) {
        return null; // Return null if the post ID is invalid
    }

    // Get the Agent custom post details
    $agent_details = array();

    // Get the agent's image (ACF field)
    $agent_image = get_field('agent_image', $agent_id); // ACF field for agent image
    if ($agent_image) {
        $agent_details['agent_image'] = $agent_image;
    } else {
        $agent_details['agent_image'] = null; // If no image found, set as null
    }

    // Get the agent's number (ACF field)
    $agent_number = get_field('agent_number', $agent_id); // ACF field for agent number
    if ($agent_number) {
        $agent_details['agent_number'] = $agent_number;
    } else {
        $agent_details['agent_number'] = null; // If no number found, set as null
    }

    // Get the agent's email (ACF field)
    $agent_email = get_field('agent_email', $agent_id); // ACF field for agent email
    if ($agent_email) {
        $agent_details['agent_email'] = $agent_email;
    } else {
        $agent_details['agent_email'] = null; // If no email found, set as null
    }

    // Get the agent's name (post title)
    $agent_name = get_the_title($agent_id); // Post title for agent name
    if ($agent_name) {
        $agent_details['agent_name'] = $agent_name;
    } else {
        $agent_details['agent_name'] = null; // If no title found, set as null
    }

    $agent_label = get_field('agent_label', $agent_id); // Post title for agent name
    if ($agent_name) {
        $agent_details['agent_label'] = $agent_label;
    } else {
        $agent_details['agent_label'] = null; // If no title found, set as null
    }

    // Return the agent details array
    return $agent_details;
}

// get_property_details_for_project
function get_property_details_for_project($project_id) {
    // Ensure a valid project ID is passed
    if (empty($project_id) || !is_numeric($project_id)) {
        return null; // Return null if the project ID is invalid
    }

    // Set up a custom WP_Query to fetch all properties with the given project ID
    $args = array(
        'post_type'      => 'property', // Custom post type for Property
        'posts_per_page' => -1, // Get all properties (you can limit this if needed)
        'meta_query'     => array(
            array(
                'key'     => 'select_project', // The ACF relationship field name
                'value'   => '"' . $project_id . '"', // Check if the project ID is in the relationship field
                'compare' => 'LIKE', // Use LIKE to check if the project ID exists in the relationship field
            ),
        ),
    );

    // Run the query
    $query = new WP_Query($args);

    // Initialize an array to store the property details
    $properties = [];

    // Check if there are any posts found
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();

            // Get the post ID
            $post_id = get_the_ID();
            $post_title = get_the_title();

            // Get ACF fields for the current property, with the post ID as the second parameter
            $bedroom = get_field('bedroom', $post_id); // ACF field for number of bedrooms
            $bathroom = get_field('bathroom', $post_id); // ACF field for number of bathrooms
            $price = get_field('price', $post_id); // ACF field for price
            $is_this_property_sold = get_field('is_this_property_sold', $post_id); // ACF checkbox for sold status
            $property_type = get_field('property_type', $post_id); // ACF field for property type
            $gallery = get_field('gallery', $post_id); // ACF field for gallery
            $area = get_field('area', $post_id); // ACF field for area (m²)
            $internal_size = get_field('internal_size', $post_id); // ACF field for internal size (m²)
            $external_size = get_field('external_size', $post_id); // ACF field for external size (m²)
            $floor_plan = get_field('floor_plan', $post_id); // ACF field for floor plan (file)
            $floor = get_field('floor', $post_id); // ACF field for floor
            $select_project = get_field('select_project', $post_id); // ACF relationship field for project

            // Prepare the property details and include the post_id
            $properties[] = array(
                'post_title'            => $post_title,
                'post_id'               => $post_id, // Include post ID here
                'bedroom'               => $bedroom,
                'bathroom'              => $bathroom,
                'price'                 => $price,
                'is_this_property_sold' => $is_this_property_sold,
                'property_type'         => $property_type,
                'gallery'               => $gallery,
                'area'                  => $area,
                'internal_size'         => $internal_size,
                'external_size'         => $external_size,
                'floor_plan'            => $floor_plan,
                'floor'                 => $floor,
                'select_project'        => $select_project,
            );
        }
    }

    // Reset the post data after the custom query
    wp_reset_postdata();

    // If properties are found, return the properties array, else return null
    if (!empty($properties)) {
        return $properties;
    }

    return null;
}
