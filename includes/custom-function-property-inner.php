<?php

add_action('vc_before_init', 'register_search_page_widget');
// Register the VC Widget
function register_search_page_widget() {
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

add_shortcode('ez_property_detail_gallery_func', 'ez_property_detail_gallery_callback');
function ez_property_detail_gallery_callback() {
    // Start output buffering
    ob_start();
    ?>
    <!-- Property Gallery -->


    <div class="gallery-container">
            <!-- Main Image -->
            <div class="main-image">
                <img id="mainImage" src="https://elzan.bisontesting.com/wp-content/uploads/2024/12/Rectangle-24.png" alt="Main View" />
            </div>

            <!-- Thumbnail Images -->
            <div class="thumbnail-container">
                <img class="thumbnail " src="https://elzan.bisontesting.com/wp-content/uploads/2024/12/Rectangle-25.png" data-large="https://elzan.bisontesting.com/wp-content/uploads/2024/12/Rectangle-24.png" alt="Image 1" />
                <img class="thumbnail" src="https://elzan.bisontesting.com/wp-content/uploads/2024/12/Rectangle-26-1.png" data-large="https://elzan.bisontesting.com/wp-content/uploads/2024/12/big1.png" alt="Image 2" />
                <img class="thumbnail" src="https://elzan.bisontesting.com/wp-content/uploads/2024/12/Rectangle-27.png" data-large="https://elzan.bisontesting.com/wp-content/uploads/2024/12/Rectangle-24.png" alt="Image 3" />
                <img class="thumbnail" src="https://elzan.bisontesting.com/wp-content/uploads/2024/12/Rectangle-28.png" data-large="https://elzan.bisontesting.com/wp-content/uploads/2024/12/big1.png" alt="Image 4" />
                <img class="thumbnail" src="https://elzan.bisontesting.com/wp-content/uploads/2024/12/Rectangle-29.png" data-large="https://elzan.bisontesting.com/wp-content/uploads/2024/12/Rectangle-24.png" alt="Image 5" />
            </div>
    </div>
      



    <?php
    // Capture the output into a variable and return it
    $content = ob_get_clean();
    return $content;
}

add_shortcode('ez_property_detail_price_details_func', 'ez_property_detail_price_details_callback');
function ez_property_detail_price_details_callback() {
    // Start output buffering
    ob_start();
    ?>
    <!-- Property Pricing -->



          <div class="property-card">
                <div class="property-header">
                    <div>
                    <h2 class="property-title">Eastgate</h2>
                    <p class="property-location">Ghajnsielem – Gozo</p>
                    </div>
                    <div class="property-price">
                    <p>Starting from</p>
                    <h3>€170,000</h3>
                    </div>
                </div>
                <div class="property-status">
                    <p>Reference No: <span class="reference-number">026902</span></p>
                    <div class="status-badge">
                    <span class="status-dot"></span> In Development
                    </div>
                </div>
                <div class="property-description">
                    <p>
                    Eastgate is a unique development that combines both residential and 
                    commercial spaces. With two levels of parking, a supermarket on the 
                    lower floor, and commercial areas on the ground floor, convenience 
                    is at your doorstep. The residential units, available in two and 
                    three-bedroom layouts, are thoughtfully designed for comfort, with 
                    many offering lovely countryside views. A communal pool adds a touch 
                    of luxury, and the units will be sold externally finished, including 
                    features like balcony waterproofing, tiles, and railings. The ground 
                    level also includes a 3,300 sqm plant nursery, offering a green and 
                    peaceful space for residents.
                    </p>
                </div>
                <div class="property-actions">
                    <button class="callback-button">Request a callback</button>
                </div>
                <div class="sales-team">
                    <img src="https://elzan.bisontesting.com/wp-content/uploads/2024/12/Ellipse-9.png" alt="Mike Magri" class="sales-image" />
                    <div class="sales-info">
                    <h4 class="sales-name"><strong>Mike Magri</strong></h4>
                    <span class="sales-role">SALES TEAM</span>
                    <p class="sales-contact">+356-9945-9350</p>
                    <p class="sales-email">jennifer@elzanproperties.com</p>
                    </div>
                </div>
        </div>





    <?php
    // Capture the output into a variable and return it
    $content = ob_get_clean();
    return $content;
}

add_shortcode('ez_property_detail_description_func', 'ez_property_detail_description_callback');
function ez_property_detail_description_callback() {
    // Start output buffering
    ob_start();
    ?>
    <!-- Property Description -->


    <div class="invisible_on_phone">
        <div class="property_description">
            <h3 class="des_heading"><strong>Description</strong></h3>
            <p class="des_detail">
            A unique, ambitious and exciting project in one of Malta’s most popular areas, Grecale is an opportunity not to be missed. Close to amenities, major public transport links and within walking distance to the MCAST Main Campus, Grecale in Paola is conveniently central while benefitting from a quiet neighbourhood – the best of both worlds! This impressive project comprises a selection of 30, 1/2/3 bedroomed apartments built in 4 blocks. 35 underground garages compliment this development. 
            </p>
        </div>
    </div>

    <?php
    // Capture the output into a variable and return it
    $content = ob_get_clean();
    return $content;
}

add_shortcode('ez_property_detail_feature_and_amenities_func', 'ez_property_detail_feature_and_amenities_callback');
function ez_property_detail_feature_and_amenities_callback() {
    // Start output buffering
    ob_start();
    ?>
    <!-- Property Features & Amenities -->

    <div class="invisible_on_phone">
        <div class="property_features">
            <h3 class="des_heading"><strong>Features and Amenities </strong></h3>

            <ul class="des_detail">
                <li>Lift</li>
                <li>Stairs in marble or Travertine</li>
                <li>Landing in marble or Travertine</li>
                <li>Staircase railing</li>
                <li>Yard and/or large terrace if any: one one-way lighting point and one rainwater floor drain</li>
                <li>Intercom linked to block the main door with automated lock</li>
                <li>Numbered letterboxes</li>
                <li>Numbered apartment front doo</li>
                <li>Drainage and rainwater piping</li>
                <li>Automatic lighting</li>
                <li>Membrane on terraces and on Roof</li>
                <li>Plastering painting of internal shafts</li>
                <li>GR1000 on party walls (apoggi)</li>
                <li>Plastering of facades in Silacato</li>
                <li>Rustproof railings in back balconies (if any)</li>
                <li>Glass Railings for front terraces</li>
                <li>Marble/Travertine window sills</li>
                <li>Block nam</li>
                <li>Tiling of balconies, terraces, yards</li>
                <li>Outdoor lighting as required</li>

            </ul>
        </div>
     </div>

    <?php
    // Capture the output into a variable and return it
    $content = ob_get_clean();
    return $content;
}

add_shortcode('ez_property_detail_brochure_func', 'ez_property_detail_brochure_callback');
function ez_property_detail_brochure_callback() {
    // Start output buffering
    ob_start();
    ?>
    <!-- Property Brochure -->

    <div class="invisible_on_phone">
        <div class="property-details">
              <div class="download-section">
                <div class="download-item">
                  <span>Property Brochure</span>
                  <button class="download-btn">Download</button>
                </div>
                <div class="download-item">
                  <span>Floor Plans</span>
                  <button class="download-btn">Download</button>
                </div>
              </div>
              <div class="info">
                <div class="info-item">
                  <span>Completion Date</span>
                  <strong>2025</strong>
                </div>
                <div class="info-item">
                  <span>Floors</span>
                  <strong>1</strong>
                </div>
                <div class="info-item">
                  <span>SQMs</span>
                  <strong>82.3m²</strong>
                </div>
                <div class="info-item">
                  <span>Garages</span>
                  <strong>82.3m²</strong>
                </div>
              </div>
        </div>
     </div>


     <div class="accordion-container">
          <div class="accordion">
            <div class="accordion-item">
              <button class="accordion-header">Description <img src="https://elzan.bisontesting.com/wp-content/uploads/2024/12/Vector.png" alt=""></button>
              
              <div class="accordion-content">
                    <div class="property_description">
                      <!-- <h3 class="des_heading"><strong>Description</strong></h3> -->
                      <p class="des_detail">
                      A unique, ambitious and exciting project in one of Malta’s most popular areas, Grecale is an opportunity not to be missed. Close to amenities, major public transport links and within walking distance to the MCAST Main Campus, Grecale in Paola is conveniently central while benefitting from a quiet neighbourhood – the best of both worlds! This impressive project comprises a selection of 30, 1/2/3 bedroomed apartments built in 4 blocks. 35 underground garages compliment this development. 
                      </p>
                  </div>
              </div>
            </div>
            <div class="accordion-item">
              <button class="accordion-header">Features and Amenities <img src="https://elzan.bisontesting.com/wp-content/uploads/2024/12/Vector.png" alt=""></button>
              

              <div class="accordion-content">
                      <div class="property_features">
                          <!-- <h3 class="des_heading"><strong>Features and Amenities </strong></h3> -->

                          <ul class="des_detail">
                              <li>Lift</li>
                              <li>Stairs in marble or Travertine</li>
                              <li>Landing in marble or Travertine</li>
                              <li>Staircase railing</li>
                              <li>Yard and/or large terrace if any: one one-way lighting point and one rainwater floor drain</li>
                              <li>Intercom linked to block the main door with automated lock</li>
                              <li>Numbered letterboxes</li>
                              <li>Numbered apartment front doo</li>
                              <li>Drainage and rainwater piping</li>
                              <li>Automatic lighting</li>
                              <li>Membrane on terraces and on Roof</li>
                              <li>Plastering painting of internal shafts</li>
                              <li>GR1000 on party walls (apoggi)</li>
                              <li>Plastering of facades in Silacato</li>
                              <li>Rustproof railings in back balconies (if any)</li>
                              <li>Glass Railings for front terraces</li>
                              <li>Marble/Travertine window sills</li>
                              <li>Block nam</li>
                              <li>Tiling of balconies, terraces, yards</li>
                              <li>Outdoor lighting as required</li>

                          </ul>
                     </div>
              </div>
            </div>
            <div class="accordion-item">
              <button class="accordion-header">Property Details <img src="https://elzan.bisontesting.com/wp-content/uploads/2024/12/Vector.png" alt=""></button>
              

              <div class="accordion-content">
              
              

              <div class="property-details">
                <div class="download-section">
                      <div class="download-item">
                        <span>Property Brochure</span>
                        <button class="download-btn">Download</button>
                      </div>
                      <div class="download-item">
                        <span>Floor Plans</span>
                        <button class="download-btn">Download</button>
                      </div>
                    </div>
                    <div class="info">
                      <div class="info-item">
                        <span>Completion Date</span>
                        <strong>2025</strong>
                      </div>
                      <div class="info-item">
                        <span>Floors</span>
                        <strong>1</strong>
                      </div>
                      <div class="info-item">
                        <span>SQMs</span>
                        <strong>82.3m²</strong>
                      </div>
                      <div class="info-item">
                        <span>Garages</span>
                        <strong>82.3m²</strong>
                      </div>
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

add_shortcode('ez_property_detail_availability_func', 'ez_property_detail_availability_callback');
function ez_property_detail_availability_callback() {
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

add_shortcode('ez_property_detail_location_func', 'ez_property_detail_location_callback');
function ez_property_detail_location_callback() {
    // Start output buffering
    ob_start();
    ?>
    Property Location Map
    <?php
    // Capture the output into a variable and return it
    $content = ob_get_clean();
    return $content;
}

?>
