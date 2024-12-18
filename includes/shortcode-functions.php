<?php
// Register the VC Widgets
add_action('vc_before_init', 'register_widgets_for_inner_page');
function register_widgets_for_inner_page() {
	vc_map(array(
		"name" => __("Property Detail Gallery", "salient"),
		"base" => "ez_property_detail_gallery_func", 
		"category" => __("Elzan Property Details Gallery Widgets", "salient"),
		"description" => __("A custom gallery for property details.", "salient"),
		"params" => array()
	));

	vc_map(array(
		"name" => __("Property Detail Pricing Section", "salient"),
		"base" => "ez_property_detail_price_details_func", 
		"category" => __("Elzan Property Details Pricing Widgets", "salient"),
		"description" => __("A custom pricing widget for property details.", "salient"),
		"params" => array()
	));

	vc_map(array(
		"name" => __("Property Detail Description Section", "salient"),
		"base" => "ez_property_detail_description_func", 
		"category" => __("Elzan Property Details description Widgets", "salient"),
		"description" => __("A custom description widget for property details.", "salient"),
		"params" => array()
	));

    vc_map(array(
		"name" => __("Property Detail Features & Amenities Section", "salient"),
		"base" => "ez_property_detail_feature_and_amenities_func", 
		"category" => __("Elzan Property Details Features & Amenities Widgets", "salient"),
		"description" => __("A custom features and amenities widget for property details.", "salient"),
		"params" => array()
	));

    vc_map(array(
		"name" => __("Property Detail Brochure Section", "salient"),
		"base" => "ez_property_detail_brochure_func", 
		"category" => __("Elzan Property Details Brochure Widgets", "salient"),
		"description" => __("A custom brochure widget for property details.", "salient"),
		"params" => array()
	));

    vc_map(array(
		"name" => __("Property Detail Availability Section", "salient"),
		"base" => "ez_property_detail_availability_func", 
		"category" => __("Elzan Property Details Availability Widgets", "salient"),
		"description" => __("A custom availability widget for property details.", "salient"),
		"params" => array()
	));

    vc_map(array(
		"name" => __("Property Detail Location Section", "salient"),
		"base" => "ez_property_detail_location_func", 
		"category" => __("Elzan Property Details Location Widgets", "salient"),
		"description" => __("A custom location widget for property details.", "salient"),
		"params" => array()
	));
}


/**
 * Callback function to render the property detail gallery.
 */
add_shortcode('ez_property_detail_gallery_func', 'ez_property_detail_gallery_callback');
function ez_property_detail_gallery_callback() {
    // Start output buffering
    ob_start();

    $post_id = get_the_ID(); // Get the current post ID
    $images = get_field('gallery', $post_id);

    // If no images are found, return an empty string
    if (empty($images) || !is_array($images)) {
        return ''; // Return nothing if there are no images
    }

    // Start building the output
    echo '<div class="gallery-container">';

        echo '<div class="main-image">'; // Main Image Section (First image in the gallery)
            // Validate the first image and check if it's an attachment ID
            $main_image_id = $images[0];
            if ($main_image_id && is_numeric($main_image_id)) {
                echo wp_get_attachment_image($main_image_id, 'full', false, array(
                    'data-fbox' => 0,
                    'class'     => 'cfbox',
                    'id'        => 'mainImage'
                ));
            }
        echo '</div>'; // Close main-image div
        
        // Thumbnail Image Section
        echo '<div class="thumbnail-container">';
            // Loop through the gallery images (starting from the second image, if available)
            foreach ($images as $index => $image_id) {
                // Only process valid image IDs
                if ($image_id && is_numeric($image_id)) {
                    echo wp_get_attachment_image($image_id, 'full', false, array(
                        'data-fbox' => $index + 1,
                        'class'     => 'cfbox thumbnail'
                    ));
                }
            }
        echo '</div>'; // Close thumbnail-container div

    echo '</div>'; // Close gallery-container div

    $output = ob_get_clean(); // Get the buffered content and clean the buffer
    return $output; // Return the gallery HTML
}

/**
 * Callback function to render the property details like name, lowest price, agent details.
 */
add_shortcode('ez_property_detail_price_details_func', 'ez_property_detail_price_details_callback');
function ez_property_detail_price_details_callback() {
    // Start output buffering
    ob_start();

    $project_id = get_the_ID(); // Get the current post ID
    $title = get_the_title(); // Get the current post title
    $location = get_field('location', $project_id); // Get location ACF field
    $lowest_price = get_lowest_price_for_project($project_id); // Custom function to get lowest price
    $reference_number = get_field('reference_number', $project_id); // Get reference number ACF field
    $status = get_field('status', $project_id); // Get status ACF field (which is an array)
    $description = get_field('description', $project_id); // Get description ACF field
    $select_agent = get_field('select_agent', $project_id); // Get selected agent (relationship field)

    // Initialize agent details to null
    $agent_image = $agent_number = $agent_email = $agent_name = null;

    if (!empty($select_agent) && isset($select_agent[0])) {
        // Fetch agent details based on the agent ID
        $agent_details = get_agent_details_by_agent_id($select_agent[0]);
        
        // Extract individual details from the agent details array
        $agent_image = isset($agent_details['agent_image']) ? $agent_details['agent_image'] : null;
        $agent_number = isset($agent_details['agent_number']) ? $agent_details['agent_number'] : null;
        $agent_email = isset($agent_details['agent_email']) ? $agent_details['agent_email'] : null;
        $agent_name = isset($agent_details['agent_name']) ? $agent_details['agent_name'] : null;
        $agent_label = isset($agent_details['agent_label']) ? $agent_details['agent_label'] : null;
    }

    // Access the status label (if available)
    $status_label = isset($status['label']) ? $status['label'] : null;
    
    ?>
    <!-- Property Pricing -->
    <div class="property-card">
        <div class="property-header">
            <div>
                <!-- Property Title -->
                <h2 class="property-title"><?php echo esc_html($title); ?></h2>
                
                <?php if ($location) { ?>
                    <!-- Property Location -->
                    <p class="property-location"><?php echo esc_html($location); ?></p>
                <?php } ?>
            </div>
            
            <?php if ($lowest_price) { ?>
                <div class="property-price">
                    <p>Starting from</p>
                    <!-- Property Price -->
                    <h3><?php echo esc_html('€' . number_format($lowest_price, 2)); ?></h3>
                </div>
            <?php } ?>
        </div>
        
        <?php if (!empty($reference_number) || !empty($status_label)  ) { ?>
            <div class="property-status">
                <?php if ($reference_number) { ?>
                    <div class="property-status">
                        <p>Reference No: <span class="reference-number"><?php echo esc_html($reference_number); ?></span></p>
                    </div>
                <?php } ?>

                <?php if ($status_label) { ?>
                    <div class="status-badge">
                        <span class="status-dot"></span> 
                        <span class="status"><?php echo esc_html($status_label); ?></span>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>

        <?php if ($description) { ?>
            <div class="property-description">
                <p>
                    <!-- Property Description -->
                    <?php echo esc_html($description); ?>
                </p>
            </div>
        <?php } ?>

        <div class="property-actions">
            <button class="callback-button">Request a callback</button>
        </div>

        <?php if ($agent_name || $agent_image || $agent_number || $agent_email) { ?>
            <div class="sales-team">
                <?php if ($agent_image) { ?>
                    <img src="<?php echo esc_url($agent_image); ?>" alt="<?php echo esc_attr($agent_name ? $agent_name : 'Agent Image'); ?>" class="sales-image" />
                <?php } ?>
                
                <div class="sales-info">
                    <?php if ($agent_name) { ?>
                        <h4 class="sales-name"><strong><?php echo esc_html($agent_name); ?></strong></h4>
                    <?php } ?>

                    <?php if ($agent_label) { ?>
                        <span class="sales-role"><?php echo esc_html($agent_label); ?></span>
                    <?php } ?>
                    
                    <?php if ($agent_number) { ?>
                        <p class="sales-contact"><?php echo esc_html($agent_number); ?></p>
                    <?php } ?>
                    
                    <?php if ($agent_email) { ?>
                        <p class="sales-email">
                            <a href="mailto:<?php echo esc_attr($agent_email); ?>"><?php echo esc_html($agent_email); ?></a>
                        </p>
                    <?php } ?>
                </div>
            </div>
        <?php } ?>
    </div>
    <?php
    // Capture the output into a variable and return it
    $content = ob_get_clean();
    return $content;
}

/**
 * Callback function to render the other description.
 */
add_shortcode('ez_property_detail_description_func', 'ez_property_detail_description_callback');
function ez_property_detail_description_callback() {
    $project_id = get_the_ID();
	$description_2 = get_field('description_2', $project_id);

	// Check if the field is empty
	if (empty($description_2)) {
		return ''; // Exit early if the field is empty
	}

	// Start output buffering
	ob_start();
	?>
	<!-- Property Description -->
	<div class="invisible_on_phone">
		<div class="property_description">
			<h3 class="des_heading"><strong>Description</strong></h3>
			<p class="des_detail">
				<?php echo $description_2;?>
			</p>
		</div>
	</div>

	<?php
	// Capture the output into a variable and return it
	$content = ob_get_clean();
	return $content;
}

/**
 * Callback function to render the features and amenities.
 */
add_shortcode('ez_property_detail_feature_and_amenities_func', 'ez_property_detail_feature_and_amenities_callback');
function ez_property_detail_feature_and_amenities_callback() {
    // Get the current post ID
    $project_id = get_the_ID();

    // Retrieve the features and amenities ACF field (which is a repeater field)
    $features_and_amenities = get_field('features_and_amenities', $project_id);

    // If there are no features and amenities, return an empty string to prevent rendering
    if (empty($features_and_amenities)) {
        return '';
    }

    // Start output buffering
    ob_start();
    ?>

    <!-- Property Features & Amenities -->
    <div class="invisible_on_phone">
        <div class="property_features">
            <h3 class="des_heading"><strong>Features and Amenities</strong></h3>

            <ul class="des_detail">
                <?php
                // Loop through each feature and amenity
                foreach ($features_and_amenities as $single_feature_and_amenity) {
                    // Check if the 'single_feature_or_amenities' field is not empty
                    $single_item = isset($single_feature_and_amenity['single_feature_or_amenities']) ? $single_feature_and_amenity['single_feature_or_amenities'] : '';

                    // Only output if the feature is not empty
                    if (!empty($single_item)) {
                        // Sanitize and display the feature/amenity
                        echo '<li>' . esc_html($single_item) . '</li>';
                    }
                }
                ?>
            </ul>
        </div>
    </div>

    <?php
    // Capture the output into a variable and return it
    $content = ob_get_clean();
    return $content;
}

/**
 * Callback function to render the brochure.
 * it is also having description, features and amenities, brochure for mobile
 */
add_shortcode('ez_property_detail_brochure_func', 'ez_property_detail_brochure_callback');
function ez_property_detail_brochure_callback() {
    // Get the current post ID
    $post_id = get_the_ID();

    // Retrieve the ACF fields
    $description_2 = get_field('description_2', $post_id); // Mobile description
    $features_and_amenities = get_field('features_and_amenities', $post_id); // Features and amenities
    $property_brochure = get_field('property_brochure', $post_id); // Property brochure URL
    $floor_plan = get_field('floor_plan', $post_id); // Floor plan URL
    $completion_date = get_field('completion_date', $post_id); // Completion date
    $additional_things_to_add = get_field('additional_things_to_add', $post_id); // Additional information (e.g., garages, SQM, etc.)
    // Start output buffering
    ob_start();
    ?>
    <!-- Property Brochure -->
    <div class="invisible_on_phone">
        <div class="property-details">
            <div class="download-section">
                <?php if (!empty($property_brochure)) { ?>
                    <div class="download-item">
                        <span>Property Brochure</span>
                        <a href="<?php echo esc_url($property_brochure); ?>" class="download-btn" target="_blank">Download</a>
                    </div>
                <?php } ?>
                
                <?php if (!empty($floor_plan)) { ?>
                    <div class="download-item">
                        <span>Floor Plans</span>
                        <a href="<?php echo esc_url($floor_plan); ?>" class="download-btn" target="_blank">Download</a>
                    </div>
                <?php } ?>
            </div>
            
            <div class="info">
                <?php if (!empty($completion_date)) { ?>
                    <div class="info-item">
                        <span>Completion Date</span>
                        <strong><?php echo esc_html($completion_date); ?></strong>
                    </div>
                <?php } ?>
                
                <?php if (!empty($additional_things_to_add)) { ?>
                    <?php foreach ($additional_things_to_add as $item) { ?>
                        <?php
                        $title = isset($item['title']) ? $item['title'] : '';
                        $value = isset($item['value']) ? $item['value'] : '';
                        if (!empty($title) && !empty($value)) { ?>
                            <div class="info-item">
                                <span><?php echo esc_html($title); ?></span>
                                <strong><?php echo esc_html($value); ?></strong>
                            </div>
                        <?php } ?>
                    <?php } ?>
                <?php } ?>
            </div>
        </div>
    </div>

    <!-- Mobile View -->
    <div class="accordion-container">
        <div class="accordion">
            <?php if (!empty($description_2)) { ?>
                <div class="accordion-item">
                    <button class="accordion-header">Description <img src="https://elzan.bisontesting.com/wp-content/uploads/2024/12/Vector.png" alt=""></button>
                    <div class="accordion-content">
                        <div class="property_description">
                            <p class="des_detail"><?php echo esc_html($description_2); ?></p>
                        </div>
                    </div>
                </div>
            <?php } ?>

            <?php if (!empty($features_and_amenities)) { ?>
                <div class="accordion-item">
                    <button class="accordion-header">Features and Amenities <img src="https://elzan.bisontesting.com/wp-content/uploads/2024/12/Vector.png" alt=""></button>
                    <div class="accordion-content">
                        <div class="property_features">
                            <ul class="des_detail">
                                <?php foreach ($features_and_amenities as $feature) { ?>
                                    <?php
                                    $feature_item = isset($feature['single_feature_or_amenities']) ? $feature['single_feature_or_amenities'] : '';
                                    if (!empty($feature_item)) { ?>
                                        <li><?php echo esc_html($feature_item); ?></li>
                                    <?php } ?>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
            <?php } ?>

            <div class="accordion-item">
                <button class="accordion-header">Property Details <img src="https://elzan.bisontesting.com/wp-content/uploads/2024/12/Vector.png" alt=""></button>
                <div class="accordion-content">
                    <div class="property-details">
                        <div class="download-section">
                            <?php if (!empty($property_brochure)) { ?>
                                <div class="download-item">
                                    <span>Property Brochure</span>
                                    <a href="<?php echo esc_url($property_brochure); ?>" class="download-btn" target="_blank">Download</a>
                                </div>
                            <?php } ?>
                            
                            <?php if (!empty($floor_plan)) { ?>
                                <div class="download-item">
                                    <span>Floor Plans</span>
                                    <a href="<?php echo esc_url($floor_plan); ?>" class="download-btn" target="_blank">Download</a>
                                </div>
                            <?php } ?>
                        </div>
                        
                        <div class="info">
                            <?php if (!empty($completion_date)) { ?>
                                <div class="info-item">
                                    <span>Completion Date</span>
                                    <strong><?php echo esc_html($completion_date); ?></strong>
                                </div>
                            <?php } ?>

                            <?php if (!empty($additional_things_to_add)) { ?>
                                <?php foreach ($additional_things_to_add as $item) { ?>
                                    <?php
                                    $title = isset($item['title']) ? $item['title'] : '';
                                    $value = isset($item['value']) ? $item['value'] : '';
                                    if (!empty($title) && !empty($value)) { ?>
                                        <div class="info-item">
                                            <span><?php echo esc_html($title); ?></span>
                                            <strong><?php echo esc_html($value); ?></strong>
                                        </div>
                                    <?php } ?>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    // Capture the output into a variable and return it
    $content = ob_get_clean();
    return $content;
}

/**
 * Callback function to render the table of properties for the project.
 */
add_shortcode('ez_property_detail_availability_func', 'ez_property_detail_availability_callback');
function ez_property_detail_availability_callback1() {
    // Get the current post ID
    $project_id = get_the_ID();
    $relavant_properties_data =  get_property_details_for_project($project_id);

    echo "<pre>relavant_properties_data:: ";
    print_r($relavant_properties_data);
    echo "</pre>";
    exit;

	// Start output buffering
	ob_start();
	?>
	<!-- Property Aailability -->

	<div class="property-overview">
		<!-- Left Section with Image -->
		<div class="property-image">
			<img src="https://elzan.bisontesting.com/wp-content/uploads/2024/12/Rectangle-33.png" alt="Property" />
			<div class="image-overlay">
				<h2>A1 SOLD</h2>
				<p>2 BED | 120.9 SQM</p>
			</div>
		</div>

		<!-- Right Section with Table -->
		<div class="property-table">
			<table>
				<thead>
					<tr>
						<th>Residences</th>
						<th>Beds</th>
						<th>Floor</th>
						<th>Int. Size</th>
						<th>Ext. Size</th>
						<th>Price</th>
						<th>Downloads</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>A4B</td>
						<td>2</td>
						<td>1</td>
						<td>82.3m²</td>
						<td>21m²</td>
						<td>€260,000</td>
						<td><button class="floor-btn">Floor Plan</button></td>
					</tr>
					<tr>
						<td>A4B</td>
						<td>2</td>
						<td>1</td>
						<td>82.3m²</td>
						<td>21m²</td>
						<td>€260,000</td>
						<td><button class="floor-btn">Floor Plan</button></td>
					</tr>
					<tr>
						<td>A4B</td>
						<td>2</td>
						<td>1</td>
						<td>82.3m²</td>
						<td>21m²</td>
						<td>€260,000</td>
						<td><button class="floor-btn">Floor Plan</button></td>
					</tr>
					<tr>
						<td>A4B</td>
						<td>2</td>
						<td>1</td>
						<td>82.3m²</td>
						<td>21m²</td>
						<td>€260,000</td>
						<td><button class="floor-btn">Floor Plan</button></td>
					</tr>
					<tr>
						<td>A4B</td>
						<td>2</td>
						<td>1</td>
						<td>82.3m²</td>
						<td>21m²</td>
						<td>€260,000</td>
						<td><button class="floor-btn">Floor Plan</button></td>
					</tr>
					<tr>
						<td>A4B</td>
						<td>2</td>
						<td>1</td>
						<td>82.3m²</td>
						<td>21m²</td>
						<td><span class="sold">SOLD</span></td>
						<td><button class="floor-btn">Floor Plan</button></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>

	<div class="availability-container">
		<div class="availability-section">
			<h3>Availability</h3>
			<ul>
				<li><strong>Residences:</strong> A4B</li>
				<li><strong>Beds:</strong> 2</li>
				<li><strong>Floor:</strong> 1</li>
				<li><strong>Int. Size:</strong> 82.3m<sup>2</sup></li>
				<li><strong>Ext. Size:</strong> 21m<sup>2</sup></li>
				<li><strong>Price:</strong> $260,000</li>
				<li><strong>Downloads:</strong> <a href="#">Floor Plan</a></li>
				<li><strong>Residences:</strong> A4B</li>
			</ul>
		</div>
		<button class="toggle-btn" >Show Less</button>
	</div>

	<?php
	// Capture the output into a variable and return it
	$content = ob_get_clean();
	return $content;
}

/**
 * callback function to render the availability table
 */
add_shortcode('ez_property_detail_availability_func', 'ez_property_detail_availability_callback');
function ez_property_detail_availability_callback() {
    // Get the current project ID
    $project_id = get_the_ID();
    $relavant_properties_data = get_property_details_for_project($project_id);

    if (!$relavant_properties_data) {
        return 'No properties found for this project.';
    }

    // Start output buffering
    ob_start();
    ?>
    <!-- Property Availability -->
    <div class="property-overview">
        <!-- Left Section with Image -->
        <div class="property-image">
            <?php 
            // Use the first property gallery image as the featured image
            if (isset($relavant_properties_data[0]['gallery'][0])) {
                $first_image_url = $relavant_properties_data[0]['gallery'][0];
                echo '<img src="' . esc_url($first_image_url) . '" alt="Property" />';
            }
            ?>
            <div class="image-overlay">
                <?php
                // Loop through relevant properties and show status for each
                foreach ($relavant_properties_data as $property) {
                    $bedroom = $property['bedroom'];
                    $area = $property['area'];
                    $price = $property['price'];
                    $is_sold = !empty($property['is_this_property_sold']) ? 'SOLD' : '';
                    echo "<h2>{$is_sold}</h2><p>{$bedroom} BED | {$area} SQM</p>";
                }
                ?>
            </div>
        </div>

        <!-- Right Section with Table -->
        <div class="property-table">
            <table>
                <thead>
                    <tr>
                        <th>Residences</th>
                        <th>Beds</th>
                        <th>Floor</th>
                        <th>Int. Size</th>
                        <th>Ext. Size</th>
                        <th>Price</th>
                        <th>Downloads</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Loop through the properties and create a row for each
                    foreach ($relavant_properties_data as $property) {
                        $post_title = !empty($property['post_title']) ? $property['post_title'] : '-';
                        $bedroom = !empty($property['bedroom']) ? $property['bedroom'] : '-';
                        $floor = !empty($property['floor']) ? $property['floor'] : '-';
                        $internal_size = !empty($property['internal_size']) ? $property['internal_size'] . ' m²' : '-';
                        $external_size = !empty($property['external_size']) ? $property['external_size'] . ' m²' : '-';
                        $floor_plan_url = !empty($property['floor_plan']) ? $property['floor_plan'] : 'javascript:void(0)';
                        
                        // Check if the property is sold
                        $is_sold = !empty($property['is_this_property_sold']) ? '<span class="sold">SOLD</span>' : '-';
                        $price = !empty($property['price']) ? '€' . number_format($property['price'], 0, '.', ',') : '-';
                    
                        // If the property is sold, set the price to an empty string
                        if (!empty($property['is_this_property_sold']) && isset($property['is_this_property_sold'][0]) && $property['is_this_property_sold'][0] == 'yes') {
                            $price = '<span class="sold">SOLD</span>';
                        }
                    
                        echo "<tr>
                                <td>{$post_title}</td>
                                <td>{$bedroom}</td>
                                <td>{$floor}</td>
                                <td>{$internal_size}</td>
                                <td>{$external_size}</td>
                                <td>{$price}</td>
                                <td><a href='{$floor_plan_url}' target='_blank' class='floor-btn'>Floor Plan</a></td>
                              </tr>";
                    }                             
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="availability-container">
        <?php
        // Loop through the properties and create a new availability section for each
        foreach ($relavant_properties_data as $property) :
            ?>
            <div class="availability-section">
                <h3>Availability</h3>
                <ul>
                    <?php if (!empty($property['post_title'])) : ?>
                        <li><strong>Residences:</strong><?php echo esc_html($property['post_title']); ?></li>
                    <?php endif; ?>
                    
                    <?php if (!empty($property['bedroom'])) : ?>
                        <li><strong>Beds:</strong> <?php echo esc_html($property['bedroom']); ?></li>
                    <?php endif; ?>

                    <?php if (!empty($property['floor'])) : ?>
                        <li><strong>Floor:</strong> <?php echo esc_html($property['floor']); ?></li>
                    <?php endif; ?>

                    <?php if (!empty($property['internal_size'])) : ?>
                        <li><strong>Int. Size:</strong> <?php echo esc_html($property['internal_size']); ?>m²</li>
                    <?php endif; ?>

                    <?php if (!empty($property['external_size'])) : ?>
                        <li><strong>Ext. Size:</strong> <?php echo esc_html($property['external_size']); ?>m²</li>
                    <?php endif; ?>

                    <?php if (!empty($property['price'])) : ?>
                        <li><strong>Price:</strong> €<?php echo number_format($property['price'], 0, '.', ','); ?></li>
                    <?php endif; ?>

                    <?php if (!empty($property['floor_plan'])) : ?>
                        <li><strong>Downloads:</strong> <a href="<?php echo esc_url($property['floor_plan']); ?>" target="_blank">Floor Plan</a></li>
                    <?php endif; ?>
                </ul>
            </div>
            <button class="toggle-btn">Show Less</button>
        <?php endforeach; ?>
    </div>

    <?php
    // Capture the output into a variable and return it
    $content = ob_get_clean();
    return $content;
}

/**
 * callback function to render the map and location information
 */
add_shortcode('ez_property_detail_location_func', 'ez_property_detail_location_callback');
function ez_property_detail_location_callback() {
    $project_id = get_the_ID();
    $map_location = get_field('map_location', $project_id); // ACF Google Map field
    $anything_to_add_for_location = get_field('anything_to_add_for_location', $project_id); // ACF Google Map field
	// Start output buffering
	ob_start();
	    // Check if there is a map location (latitude and longitude are available)
        if ($map_location) {
            // Get the latitude and longitude from the map_location field
            $latitude = $map_location['lat'];
            $longitude = $map_location['lng'];
            $address = $map_location['address'];
            ?>
            <div class="property-map">
                <div class="property-location-info">
                    <h3>Location</h3>
                    <?php if(!empty($anything_to_add_for_location)) { ?>
                        <?php echo $anything_to_add_for_location; ?>
                    <?php } ?>
                </div>
                <div id="map" style="width: 100%; height: 400px;"></div>
            </div>

            <script>
                // Initialize the map using the latitude and longitude from the ACF field
                function initMap() {
                    var propertyLocation = { lat: <?php echo esc_js($latitude); ?>, lng: <?php echo esc_js($longitude); ?> };
                    
                    var map = new google.maps.Map(document.getElementById('map'), {
                        zoom: 14,
                        center: propertyLocation,
                    });

                    var marker = new google.maps.Marker({
                        position: propertyLocation,
                        map: map,
                    });
                }

                // Load the Google Maps API and execute the initMap function when the script loads
                function loadGoogleMapScript() {
                    var script = document.createElement('script');
                    script.src = "https://maps.googleapis.com/maps/api/js?key=AIzaSyAO29XEV5gSZlmKnsAvIwydgN4admrSFEQ&callback=initMap";
                    script.async = true;
                    document.head.appendChild(script);
                }

                // Load the Google Map
                loadGoogleMapScript();
            </script>
            <?php
        } else {
            echo "<p>No map location available for this property.</p>"; // Message if no map location is set
        }
	// Capture the output into a variable and return it
	$content = ob_get_clean();
	return $content;
}
