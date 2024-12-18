<?php

add_action('wp_enqueue_scripts', 'salient_child_enqueue_styles', 100);
function salient_child_enqueue_styles()
{
	$nectar_theme_version = nectar_get_theme_version();
	wp_enqueue_style('slick-slider', get_stylesheet_directory_uri() . '/css/slick.css', '', '1');
	wp_enqueue_style('salient-child-style', get_stylesheet_directory_uri() . '/style.css', '', $nectar_theme_version);
	wp_enqueue_style('BW-Gradual-font', get_stylesheet_directory_uri() . '/fonts/bw-gradual/stylesheet.css', '', $nectar_theme_version);
	wp_enqueue_style('Theinhardt-font', get_stylesheet_directory_uri() . '/fonts/theinhardt/stylesheet.css', '', $nectar_theme_version);
	wp_enqueue_style('rangeSlider-css', get_stylesheet_directory_uri() . '/css/ion-rangeSlider-min.css', '', $nectar_theme_version);

	wp_enqueue_style('custom-style', get_stylesheet_directory_uri() . '/css/custom-style.css', '', '1');

	if (is_rtl()) {
		wp_enqueue_style('salient-rtl',  get_template_directory_uri() . '/rtl.css', array(), '1', 'screen');
	}


	wp_enqueue_script('slick-slider', get_stylesheet_directory_uri() . '/js/slick.js', array('jquery'), null, true);
	wp_enqueue_script('rangeSlider', get_stylesheet_directory_uri() . '/js/ion-rangeSlider-min.js', array('jquery'), true);
	wp_enqueue_script('custom-script', get_stylesheet_directory_uri() . '/js/custom-script.js', array('jquery'), true);

	$wp_ajx_array = array('wp_ajax_url' => admin_url('admin-ajax.php'));
	wp_localize_script('custom-script', 'admin_ajaax', $wp_ajx_array); // localize ajax url in script
}

require_once(get_stylesheet_directory() . "/includes/custom-function.php");
require_once(get_stylesheet_directory() . "/includes/shortcode-functions.php");
require_once(get_stylesheet_directory() . "/includes/shortcode-helper-functions.php");
require_once(get_stylesheet_directory() . "/includes/custom-search-shortcode.php");
require_once(get_stylesheet_directory() . "/includes/custom-search-helpers-function.php");
require_once(get_stylesheet_directory() . "/includes/listing-functions.php");

//add SVG to allowed file uploads
add_action('upload_mimes', 'add_file_types_to_uploads');
function add_file_types_to_uploads($file_types)
{
	$new_filetypes = array();
	$new_filetypes['svg'] = 'image/svg+xml';
	$file_types = array_merge($file_types, $new_filetypes);
	return $file_types;
}

add_filter("redux/salient_redux/field/typography/custom_fonts", "salient_redux_custom_fonts");
function salient_redux_custom_fonts()
{
	return array(
		'Custom Fonts' => array(
			'Rockness' => 'Rockness',
			'Product Sans' => 'Product Sans',
		)
	);
}

add_action("vc_before_init", "elzan_custom_widgets");

function elzan_custom_widgets()
{
	// Online booking section
	vc_map(array(
		'name'     => __('Single Project', 'salient'),
		'base'     => 'elzan_single_project',
		'category' => __('Elzan Widgets', 'salient'),
		'params'   => array(
			array(
				'type'        => 'attach_image',
				'heading'     => __('Project Image', 'salient'),
				'param_name'  => 'image',
			),
			array(
				'type'        => 'textfield',
				'heading'     => __('Project Label', 'salient'),
				'param_name'  => 'label',
			),
			array(
				'type'        => 'textfield',
				'heading'     => __('Project Title', 'salient'),
				'param_name'  => 'Title',
			),
			array(
				'type'        => 'param_group',
				'heading'     => __('Project Details', 'salient'),
				'param_name'  => 'details',
				'params'      => array(
					array(
						'type'        => 'textfield',
						'heading'     => __('Detail', 'salient'),
						'param_name'  => 'detail',
					)
				)
			),
			array(
				'type'        => 'vc_link',
				'heading'     => __('Project Link', 'salient'),
				'param_name'  => 'link',
			)
		),
	));
}

add_shortcode('elzan_single_project', 'elzan_single_project_callback');
function elzan_single_project_callback($atts)
{
	ob_start();
	echo 'project here';
	return ob_get_clean();
}

add_shortcode('property_details', 'property_details');
function property_details()
{
	// Start output buffering
	ob_start();
?>
<div class="row_col_wrap_12 col span_12 custom_row">
	<div class="vc_col-sm-8">
		<div class="gallery_slider slider-for">
			<div class="large_img">
				<img src="/wp-content/uploads/2024/12/Rectangle-24.png">
			</div>
			<div class="large_img">
				<img src="/wp-content/uploads/2024/12/image1.jpg">
			</div>
			<div class="large_img">
				<img src="/wp-content/uploads/2024/12/image.jpg">
			</div>
			<div class="large_img">
				<img src="/wp-content/uploads/2024/12/image3.jpg">
			</div>
			<div class="large_img">
				<img src="/wp-content/uploads/2024/12/image4.jpg">
			</div>
		</div>
		<div class="gallery_thumb slider_nav">
			<div class="small_img">
				<img src="/wp-content/uploads/2024/12/Rectangle-24.png">
			</div>
			<div class="small_img">
				<img src="/wp-content/uploads/2024/12/image1.jpg">
			</div>
			<div class="small_img">
				<img src="/wp-content/uploads/2024/12/image.jpg">
			</div>
			<div class="small_img">
				<img src="/wp-content/uploads/2024/12/image3.jpg">
			</div>
			<div class="small_img">
				<img src="/wp-content/uploads/2024/12/image4.jpg">
			</div>
		</div>
	</div>
	<div class="vc_col-sm-4">
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
				<p>Eastgate is a unique development that combines both residential and commercial spaces. With two levels of parking, a supermarket on the lower floor, and commercial areas on the ground floor, convenience is at your doorstep. The residential units, available in two and three-bedroom layouts, are thoughtfully designed for comfort, with many offering lovely countryside views. A communal pool adds a touch of luxury, and the units will be sold externally finished, including features like balcony waterproofing, tiles, and railings. The ground level also includes a 3,300 sqm plant nursery, offering a green and peaceful space for residents.</p>
			</div>
			<div class="property-actions">
				<button class="callback-button">Request a callback</button>
			</div>
			<div class="sales-team">
				<img src="/wp-content/uploads/2024/12/Ellipse-9.png" alt="Mike Magri" class="sales-image" />
				<div class="sales-info">
					<h4 class="sales-name"><strong>Mike Magri</strong></h4>
					<span class="sales-role">SALES TEAM</span>
					<p class="sales-contact">+356-9945-9350</p>
					<p class="sales-email">jennifer@elzanproperties.com</p>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row_col_wrap_12 col span_12 custom_row mobile_tab">
	<div class="vc_col-sm-4">
		<div class="toggle_heading">
			<h4>Description</h4>
		</div>
		<div class="slide_open">
			<p>A unique, ambitious and exciting project in one of Malta’s most popular areas, Grecale is an opportunity not to be missed. Close to amenities, major public transport links and within walking distance to the MCAST Main Campus, Grecale in Paola is conveniently central while benefitting from a quiet neighbourhood – the best of both worlds! This impressive project comprises a selection of 30, 1/2/3 bedroomed apartments built in 4 blocks. 35 underground garages compliment this development. </p>
		</div>
	</div>
	<div class="vc_col-sm-4">
		<div class="toggle_heading">
			<h4>Features and Amenities </h4>
		</div>
		<div class="slide_open">
			<ul>
				<li>Lift</li>
				<li>Stairs in marble or Travertine</li>
				<li>Landing in marble or Travertine</li>
				<li>Staircase railing</li>
				<li>Yard and/or large terrace if any: one one-way lighting point and one rainwater floor drain</li>
				<li>Intercom linked to block the main door with automated lock</li>
				<li>Numbered letterboxes</li>
				<li>Numbered apartment front door</li>
				<li>Drainage and rainwater piping</li>
				<li>Automatic lighting</li>
				<li>Membrane on terraces and on Roof</li>
				<li>Plastering painting of internal shafts</li>
				<li>GR1000 on party walls (apoggi)</li>
				<li>Plastering of facades in Silacato</li>
				<li>Rustproof railings in back balconies (if any)</li>
				<li>Glass Railings for front terraces</li>
				<li>Marble/Travertine window sills</li>
				<li>Block name</li>
				<li>Tiling of balconies, terraces, yards</li>
				<li>Outdoor lighting as required.</li>
			</ul>
		</div>
	</div>
	<div class="vc_col-sm-4">
		<div class="toggle_heading d-none">
			<h4>property details</h4>
		</div>
		<div class="slide_open">
			<table>
				<tbody>
					<tr>
						<td>Property Brochure</td>
						<td><button class="download-btn" type="button">Download</button></td>
					</tr>
					<tr>
						<td>Floor Plans</td>
						<td><button class="download-btn" type="button">Download</button></td>
					</tr>
					<tr>
						<td>Completion Date</td>
						<td><b>2025</b></td>
					</tr>
					<tr>
						<td>Completion Date</td>
						<td><b>2025</b></td>
					</tr>
					<tr>
						<td>Floors</td>
						<td><b>1</b></td>
					</tr>
					<tr>
						<td>SQMs</td>
						<td><b>82.3m²</b></td>
					</tr>
					<tr>
						<td>Garages</td>
						<td><b>82.3m²</b></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>
<div class="full_row">
	<div class="custom_row">
		<div class="vc_col-sm-5">
			<div class="media_thumb">
				<img src="/wp-content/uploads/2024/12/Rectangle-33.png">
			</div>
		</div>
		<div class="vc_col-sm-7">
			<div class="table_data">
				<table>
					<tbody>
						<tr>
							<td>Residences</td>
							<td>Beds</td>
							<td>Floor</td>
							<td>Int. Size</td>
							<td>Ext. Size</td>
							<td>Price</td>
							<td>Downloads</td>
						</tr>
						<tr>
							<td class="d-none"><span class="avail-td">AVAILABILITY</span></td>
							<td><span class="d-none">Residences</span> A4B</td>
							<td><span class="d-none">Beds</span> 2</td>
							<td><span class="d-none">Floor</span> 1</td>
							<td><span class="d-none">Int. Size</span> 82.3m²</td>
							<td><span class="d-none">Ext. Size</span> 21m²</td>
							<td><span class="d-none">Price</span> €260,000</td>
							<td><span class="d-none">Downloads</span> <button class="download-btn" type="button">Floor Plan</button></td>
						</tr>
						<tr>
							<td class="d-none"><span class="avail-td">AVAILABILITY</span></td>
							<td><span class="d-none">Residences</span> A4B</td>
							<td><span class="d-none">Beds</span> 2</td>
							<td><span class="d-none">Floor</span> 1</td>
							<td><span class="d-none">Int. Size</span> 82.3m²</td>
							<td><span class="d-none">Ext. Size</span> 21m²</td>
							<td><span class="d-none">Price</span> €260,000</td>
							<td><span class="d-none">Downloads</span> <button class="download-btn" type="button">Floor Plan</button></td>
						</tr>
						<tr>
							<td class="d-none"><span class="avail-td">AVAILABILITY</span></td>
							<td><span class="d-none">Residences</span> A4B</td>
							<td><span class="d-none">Beds</span> 2</td>
							<td><span class="d-none">Floor</span> 1</td>
							<td><span class="d-none">Int. Size</span> 82.3m²</td>
							<td><span class="d-none">Ext. Size</span> 21m²</td>
							<td><span class="d-none">Price</span> €260,000</td>
							<td><span class="d-none">Downloads</span> <button class="download-btn" type="button">Floor Plan</button></td>
						</tr>
						<tr>
							<td class="d-none"><span class="avail-td">AVAILABILITY</span></td>
							<td><span class="d-none">Residences</span> A4B</td>
							<td><span class="d-none">Beds</span> 2</td>
							<td><span class="d-none">Floor</span> 1</td>
							<td><span class="d-none">Int. Size</span> 82.3m²</td>
							<td><span class="d-none">Ext. Size</span> 21m²</td>
							<td><span class="d-none">Price</span> €260,000</td>
							<td><span class="d-none">Downloads</span> <button class="download-btn" type="button">Floor Plan</button></td>
						</tr>
						<tr>
							<td class="d-none"><span class="avail-td">AVAILABILITY</span></td>
							<td><span class="d-none">Residences</span> A4B</td>
							<td><span class="d-none">Beds</span> 2</td>
							<td><span class="d-none">Floor</span> 1</td>
							<td><span class="d-none">Int. Size</span> 82.3m²</td>
							<td><span class="d-none">Ext. Size</span> 21m²</td>
							<td><span class="d-none">Price</span> €260,000</td>
							<td><span class="d-none">Downloads</span> <button class="download-btn" type="button">Floor Plan</button></td>
						</tr>
						<tr>
							<td class="d-none"><span class="avail-td">AVAILABILITY</span></td>
							<td><span class="d-none">Residences</span> A4B</td>
							<td><span class="d-none">Beds</span> 2</td>
							<td><span class="d-none">Floor</span> 1</td>
							<td><span class="d-none">Int. Size</span> 82.3m²</td>
							<td><span class="d-none">Ext. Size</span> 21m²</td>
							<td><span class="d-none">Price</span> <span class="sold-text">SOLD</span></td>
							<td><span class="d-none">Downloads</span> <button class="download-btn sold-btn" type="button">Floor Plan</button></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<?php
	$content = ob_get_clean();
	return $content;
}

add_shortcode('propertylist', 'propertylist');
function propertylist()
{
	ob_start();
?>
<div class="property_count">
	<span><b>10</b> PROPERTIES FOUND</span>
	<select>
		<option value>Filter by</option>
		<option value="high-low">Price High To Low</option>
		<option value="low-high">Price Low To High</option>
	</select>
</div>
<div class="property-list">
	<div class="property-item">
		<div class="thumb_img">
			<img src="/wp-content/uploads/2024/12/Rectangle-24.jpg">
			<span class="progress_dots"><span class="dots"></span> In Development</span>
		</div>
		<div class="properly_content">
			<div class="d-row">
				<div class="first_row">
					<h3>Ta’ Duru Houses</h3>
					<small>Nadur - Gozo</small>
				</div>
				<div class="last_row">
					<small>Starting from</small>
					<h4>€260,000</h4>
				</div>
			</div>
			<ul class="property_icon">
				<li>
					<svg width="12" height="10" viewBox="0 0 19 16" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M15.4284 16.0002H3.49222C2.48311 16.0002 1.66197 15.2043 1.66197 14.2262V9.22528H1.45421L1.37012 9.2061C0.97439 9.10541 0.628126 8.88964 0.380795 8.57319C-0.237534 7.79645 -0.0841881 6.67927 0.712219 6.08473L8.37949 0.355032C9.01761 -0.119646 9.97725 -0.119646 10.6154 0.355032L18.2826 6.07993C18.6685 6.36762 18.9208 6.78476 18.9801 7.25944C19.0444 7.72932 18.9158 8.19441 18.6141 8.57319C18.2826 8.99033 17.7929 9.23486 17.2587 9.26363V14.2262C17.2587 15.2043 16.4376 16.0002 15.4284 16.0002ZM1.65208 7.88275L3.03219 7.89234L3.04208 14.2214C3.04208 14.4611 3.24489 14.6577 3.49222 14.6577H15.4284C15.6758 14.6577 15.8786 14.4611 15.8786 14.2214V7.92111H17.1647C17.3082 7.92111 17.4368 7.85878 17.5209 7.75329C17.5951 7.6574 17.6247 7.54712 17.6099 7.43205C17.5951 7.31697 17.5357 7.21628 17.4368 7.14436L9.77444 1.41946C9.6211 1.30439 9.37871 1.30439 9.22537 1.41946L1.55809 7.13957C1.36023 7.28821 1.3256 7.5615 1.474 7.7485C1.51852 7.80604 1.58283 7.85398 1.65208 7.88275Z" fill="#59C2FF" />
					</svg>
					<span>Terraced House</span>
				</li>
				<li>
					<svg width="12" height="12" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M0.439619 3.97917L8.96674 0.0693542C8.96674 0.0693542 8.97697 0.0693542 8.98208 0.0644051C9.00764 0.0545068 9.0332 0.0446085 9.06387 0.0347103C9.08432 0.0297611 9.10477 0.0198629 9.13033 0.0149137C9.15078 0.00996459 9.17634 0.00996459 9.19679 0.00501546C9.22746 0.00501546 9.25302 -0.00488281 9.2837 -0.00488281C9.28881 -0.00488281 9.29392 -0.00488281 9.29903 -0.00488281C9.31437 -0.00488281 9.33482 -0.00488281 9.35015 6.63213e-05C9.38083 6.63213e-05 9.40639 6.63213e-05 9.43706 0.00996459C9.46262 0.00996459 9.48307 0.0198629 9.50863 0.024812C9.53419 0.0297611 9.55464 0.0396594 9.5802 0.0446085C9.60576 0.0545068 9.62621 0.0644051 9.64666 0.0743033C9.66711 0.0842016 9.68756 0.0940999 9.70801 0.108947C9.72846 0.123795 9.74891 0.133693 9.76935 0.14854C9.7898 0.163388 9.81025 0.178235 9.82559 0.193083C9.84092 0.20793 9.86137 0.227726 9.87671 0.247523C9.89205 0.26732 9.90738 0.282167 9.92272 0.301964C9.93806 0.326709 9.95339 0.346506 9.96873 0.371251C9.97895 0.386099 9.98918 0.395997 9.99429 0.415794C9.99429 0.415794 9.99429 0.425692 9.9994 0.430641C10.0096 0.455387 10.0199 0.480132 10.0301 0.509827C10.0352 0.529624 10.0454 0.554369 10.0505 0.574166C10.0556 0.593962 10.0556 0.618708 10.0607 0.638505C10.0607 0.668199 10.071 0.692945 10.071 0.72264C10.071 0.72264 10.071 0.732538 10.071 0.737487V3.01904L11.7222 3.86039L17.591 6.85957L17.6012 6.86452C17.6012 6.86452 17.6114 6.86452 17.6166 6.86946C17.6268 6.87441 17.637 6.88431 17.6472 6.88926C17.6626 6.89916 17.6779 6.90411 17.6881 6.91401C17.7035 6.9239 17.7137 6.9338 17.729 6.9437C17.7392 6.9536 17.7546 6.9635 17.7648 6.9734C17.775 6.98329 17.7904 6.99814 17.8006 7.01299C17.8108 7.02289 17.821 7.03773 17.8313 7.04763C17.8415 7.06248 17.8517 7.07238 17.8619 7.08723C17.8722 7.10207 17.8824 7.11197 17.8875 7.12682C17.8977 7.14167 17.9028 7.15651 17.9131 7.17136C17.9182 7.18621 17.9284 7.20106 17.9335 7.21095C17.9386 7.2258 17.9437 7.24065 17.954 7.26045C17.9591 7.27529 17.9642 7.29014 17.9693 7.30499C17.9693 7.31984 17.9795 7.33963 17.9795 7.35448C17.9795 7.36933 17.9846 7.38417 17.9897 7.39902C17.9897 7.41387 17.9897 7.43367 17.9897 7.45346C17.9897 7.46831 17.9897 7.47821 17.9897 7.49306V7.498C17.9897 7.498 17.9897 7.50295 17.9897 7.5079V12.462C17.9897 12.8728 17.6472 13.2044 17.2229 13.2044C16.7986 13.2044 16.4561 12.8728 16.4561 12.462V12.0413L9.84604 16.0056V17.2428C9.84604 17.6536 9.50352 17.9852 9.07921 17.9852C8.6549 17.9852 8.31238 17.6536 8.31238 17.2428V16.0056L1.52851 11.9918V12.2838C1.52851 12.6946 1.186 13.0262 0.761684 13.0262C0.337374 13.0262 -0.00514221 12.6946 -0.00514221 12.2838V4.63246C-0.00514221 4.34541 0.168671 4.0831 0.434505 3.95937L0.439619 3.97917ZM9.2837 4.30581L7.15703 5.31544L7.64268 5.65198L9.73868 4.54337L9.2837 4.31076V4.30581ZM5.58759 6.05781L2.40781 7.56729L3.2002 8.00282L6.14993 6.44384L5.5927 6.05781H5.58759ZM1.53362 6.32506L8.52709 3.00914V1.91538L1.53362 5.12242V6.32506ZM11.3695 5.36988L4.76453 8.86891L9.08432 11.2494L15.6535 7.55244L11.3746 5.36988H11.3695ZM16.4663 8.80952L9.85626 12.5313V14.2734L16.4663 10.3042V8.80458V8.80952ZM8.32261 14.2833V12.5313L2.81167 9.49251L1.53874 8.79468V10.2695L8.32772 14.2833H8.32261Z" fill="#59C2FF" />
					</svg>
					<span>2</span>
				</li>
				<li>
					<svg width="13" height="8" viewBox="0 0 20 12" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M18.2647 2.92583H4.21828V1.94885C4.21828 1.5601 4.44202 1.29923 4.59482 1.29923H6.58117C6.72851 1.29923 6.95771 1.5601 6.95771 1.94885C6.95771 2.30691 7.26876 2.59847 7.65075 2.59847C8.03274 2.59847 8.34379 2.30691 8.34379 1.94885C8.34379 0.87468 7.55252 0 6.58117 0H4.59482C3.62347 0 2.8322 0.87468 2.8322 1.94885V2.92583H1.74079C0.780355 2.92583 0 3.60102 0 4.42967C0 5.15601 0.600273 5.76471 1.39154 5.90281C1.53342 5.95908 1.69168 6 1.84993 6.02046L2.794 10.1279C2.83765 11.1662 3.75443 12.0051 4.87312 12.0051H15.1269C16.2401 12.0051 17.146 11.1867 17.206 10.1586L18.5375 5.9335C18.5375 5.9335 18.5812 5.91304 18.603 5.90793C19.3997 5.76982 20 5.16113 20 4.43478C20 3.60614 19.2196 2.93095 18.2592 2.93095L18.2647 2.92583ZM15.8199 9.95908V10.0512C15.8199 10.4092 15.5089 10.7008 15.1269 10.7008H4.87312C4.49113 10.7008 4.18008 10.4092 4.18008 10.0512V9.98466L3.25239 5.9335H17.0914L15.8199 9.95908ZM18.2647 4.63427H1.74079C1.54434 4.63427 1.39154 4.52685 1.39154 4.42967C1.39154 4.33248 1.54434 4.22506 1.74079 4.22506H18.2647C18.4611 4.22506 18.6139 4.33248 18.6139 4.42967C18.6139 4.52685 18.4611 4.63427 18.2647 4.63427Z" fill="#59C2FF" />
					</svg>
					<span>2.5</span>
				</li>
				<li>
					<svg width="11" height="10" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M16.8932 5.63175C16.8932 5.63175 16.9145 5.60919 16.9217 5.58663C16.9359 5.54904 16.9501 5.51896 16.9644 5.48137C16.9929 5.39114 17.0071 5.2934 17 5.20317C17 5.18062 17 5.16558 17 5.14302C17 5.09039 16.9858 5.04528 16.9715 4.99265C16.9715 4.98513 16.9644 4.97761 16.9644 4.97009C16.9501 4.9325 16.9359 4.88738 16.9145 4.84979C16.9145 4.83475 16.9003 4.82723 16.8932 4.8122C16.8718 4.78212 16.8576 4.75205 16.8362 4.72197C16.822 4.69942 16.8006 4.68438 16.7863 4.66934C16.7721 4.6543 16.7507 4.63175 16.7365 4.61671C16.7151 4.59415 16.6866 4.57911 16.6581 4.56408C16.6439 4.55656 16.6368 4.54152 16.6225 4.534L10.7256 1.28588C10.5119 1.1731 10.2627 1.16558 10.049 1.28588L8.74571 1.97009L5.14202 0.0828741C4.92836 -0.0299078 4.6791 -0.0223891 4.46544 0.0903929L0.391705 2.38363C0.14956 2.52648 0 2.78964 0 3.08287C0 3.37611 0.156682 3.63926 0.405949 3.7746L6.58777 7.06784L0.797654 10.3686C0.797654 10.3686 0.776288 10.3836 0.762044 10.3987C0.733557 10.4137 0.705069 10.4363 0.683703 10.4588C0.662338 10.4739 0.648094 10.4964 0.626728 10.5114C0.612484 10.5265 0.591119 10.5415 0.576875 10.5641C0.555509 10.5942 0.534143 10.6242 0.519899 10.6543C0.512778 10.6693 0.505656 10.6769 0.498534 10.6919C0.477168 10.737 0.462924 10.7821 0.44868 10.8272C0.441558 10.8573 0.434437 10.8799 0.427315 10.9099C0.427315 10.9325 0.413071 10.9626 0.413071 10.9851C0.413071 11.0152 0.413071 11.0378 0.413071 11.0678C0.413071 11.0904 0.413071 11.1129 0.413071 11.1355C0.413071 11.1731 0.427315 11.2032 0.434437 11.2408C0.434437 11.2558 0.434437 11.2708 0.441558 11.2859C0.455802 11.331 0.477168 11.3836 0.498534 11.4287C0.498534 11.4287 0.498534 11.4287 0.498534 11.4363C0.527021 11.4889 0.562631 11.534 0.59824 11.5791C0.612484 11.5942 0.619606 11.6017 0.63385 11.6167C0.66946 11.6468 0.705069 11.6769 0.740679 11.7069C0.754923 11.7145 0.762044 11.722 0.776288 11.7295C0.776288 11.7295 0.78341 11.7295 0.790532 11.737L8.14747 15.8949C8.14747 15.8949 8.21156 15.925 8.24717 15.9325C8.26854 15.94 8.2899 15.9551 8.31127 15.9551C8.37537 15.9701 8.43946 15.9851 8.49644 15.9851C8.55341 15.9851 8.61751 15.9776 8.68161 15.9626C8.70297 15.9626 8.71722 15.9475 8.73858 15.94C8.76707 15.9325 8.80268 15.9175 8.83117 15.9024L16.1382 11.9851C16.5015 11.7896 16.651 11.316 16.4659 10.9325C16.4587 10.9175 16.4445 10.9024 16.4374 10.8799C16.3946 10.6543 16.2593 10.4588 16.0528 10.346L12.385 8.39114L16.6154 5.90242C16.6154 5.90242 16.6297 5.88738 16.6439 5.87987C16.6724 5.85731 16.708 5.84227 16.7365 5.8122C16.7507 5.79716 16.765 5.78212 16.7792 5.76708C16.8006 5.74453 16.8148 5.72949 16.8362 5.70693C16.8576 5.67686 16.8718 5.6543 16.886 5.62423L16.8932 5.63175ZM4.82866 1.66182L7.17176 2.88739L4.75744 4.33851L2.35023 3.0528L4.82866 1.66182ZM14.3506 11.2032L8.51068 14.331L2.71345 11.0528L8.19732 7.92498L14.3506 11.2032ZM8.53205 6.34603L6.34562 5.18062L9.1018 3.52648L10.3766 2.85731L14.7067 5.24829L10.7897 7.54904L8.53205 6.34603Z" fill="#59C2FF" />
					</svg>
					<span>190 sqm</span>
				</li>
			</ul>
		</div>
	</div>
	<div class="property-item">
		<div class="thumb_img">
			<img src="/wp-content/uploads/2024/12/Rectangle-24.jpg">
			<span class="progress_dots"><span class="dots done_dots"></span> Completed</span>
		</div>
		<div class="properly_content">
			<div class="d-row">
				<div class="first_row">
					<h3>Ta’ Duru Houses</h3>
					<small>Nadur - Gozo</small>
				</div>
				<div class="last_row">
					<small>Starting from</small>
					<h4>€260,000</h4>
				</div>
			</div>
			<ul class="property_icon">
				<li>
					<svg width="12" height="10" viewBox="0 0 19 16" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M15.4284 16.0002H3.49222C2.48311 16.0002 1.66197 15.2043 1.66197 14.2262V9.22528H1.45421L1.37012 9.2061C0.97439 9.10541 0.628126 8.88964 0.380795 8.57319C-0.237534 7.79645 -0.0841881 6.67927 0.712219 6.08473L8.37949 0.355032C9.01761 -0.119646 9.97725 -0.119646 10.6154 0.355032L18.2826 6.07993C18.6685 6.36762 18.9208 6.78476 18.9801 7.25944C19.0444 7.72932 18.9158 8.19441 18.6141 8.57319C18.2826 8.99033 17.7929 9.23486 17.2587 9.26363V14.2262C17.2587 15.2043 16.4376 16.0002 15.4284 16.0002ZM1.65208 7.88275L3.03219 7.89234L3.04208 14.2214C3.04208 14.4611 3.24489 14.6577 3.49222 14.6577H15.4284C15.6758 14.6577 15.8786 14.4611 15.8786 14.2214V7.92111H17.1647C17.3082 7.92111 17.4368 7.85878 17.5209 7.75329C17.5951 7.6574 17.6247 7.54712 17.6099 7.43205C17.5951 7.31697 17.5357 7.21628 17.4368 7.14436L9.77444 1.41946C9.6211 1.30439 9.37871 1.30439 9.22537 1.41946L1.55809 7.13957C1.36023 7.28821 1.3256 7.5615 1.474 7.7485C1.51852 7.80604 1.58283 7.85398 1.65208 7.88275Z" fill="#59C2FF" />
					</svg>
					<span>Terraced House</span>
				</li>
				<li>
					<svg width="12" height="12" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M0.439619 3.97917L8.96674 0.0693542C8.96674 0.0693542 8.97697 0.0693542 8.98208 0.0644051C9.00764 0.0545068 9.0332 0.0446085 9.06387 0.0347103C9.08432 0.0297611 9.10477 0.0198629 9.13033 0.0149137C9.15078 0.00996459 9.17634 0.00996459 9.19679 0.00501546C9.22746 0.00501546 9.25302 -0.00488281 9.2837 -0.00488281C9.28881 -0.00488281 9.29392 -0.00488281 9.29903 -0.00488281C9.31437 -0.00488281 9.33482 -0.00488281 9.35015 6.63213e-05C9.38083 6.63213e-05 9.40639 6.63213e-05 9.43706 0.00996459C9.46262 0.00996459 9.48307 0.0198629 9.50863 0.024812C9.53419 0.0297611 9.55464 0.0396594 9.5802 0.0446085C9.60576 0.0545068 9.62621 0.0644051 9.64666 0.0743033C9.66711 0.0842016 9.68756 0.0940999 9.70801 0.108947C9.72846 0.123795 9.74891 0.133693 9.76935 0.14854C9.7898 0.163388 9.81025 0.178235 9.82559 0.193083C9.84092 0.20793 9.86137 0.227726 9.87671 0.247523C9.89205 0.26732 9.90738 0.282167 9.92272 0.301964C9.93806 0.326709 9.95339 0.346506 9.96873 0.371251C9.97895 0.386099 9.98918 0.395997 9.99429 0.415794C9.99429 0.415794 9.99429 0.425692 9.9994 0.430641C10.0096 0.455387 10.0199 0.480132 10.0301 0.509827C10.0352 0.529624 10.0454 0.554369 10.0505 0.574166C10.0556 0.593962 10.0556 0.618708 10.0607 0.638505C10.0607 0.668199 10.071 0.692945 10.071 0.72264C10.071 0.72264 10.071 0.732538 10.071 0.737487V3.01904L11.7222 3.86039L17.591 6.85957L17.6012 6.86452C17.6012 6.86452 17.6114 6.86452 17.6166 6.86946C17.6268 6.87441 17.637 6.88431 17.6472 6.88926C17.6626 6.89916 17.6779 6.90411 17.6881 6.91401C17.7035 6.9239 17.7137 6.9338 17.729 6.9437C17.7392 6.9536 17.7546 6.9635 17.7648 6.9734C17.775 6.98329 17.7904 6.99814 17.8006 7.01299C17.8108 7.02289 17.821 7.03773 17.8313 7.04763C17.8415 7.06248 17.8517 7.07238 17.8619 7.08723C17.8722 7.10207 17.8824 7.11197 17.8875 7.12682C17.8977 7.14167 17.9028 7.15651 17.9131 7.17136C17.9182 7.18621 17.9284 7.20106 17.9335 7.21095C17.9386 7.2258 17.9437 7.24065 17.954 7.26045C17.9591 7.27529 17.9642 7.29014 17.9693 7.30499C17.9693 7.31984 17.9795 7.33963 17.9795 7.35448C17.9795 7.36933 17.9846 7.38417 17.9897 7.39902C17.9897 7.41387 17.9897 7.43367 17.9897 7.45346C17.9897 7.46831 17.9897 7.47821 17.9897 7.49306V7.498C17.9897 7.498 17.9897 7.50295 17.9897 7.5079V12.462C17.9897 12.8728 17.6472 13.2044 17.2229 13.2044C16.7986 13.2044 16.4561 12.8728 16.4561 12.462V12.0413L9.84604 16.0056V17.2428C9.84604 17.6536 9.50352 17.9852 9.07921 17.9852C8.6549 17.9852 8.31238 17.6536 8.31238 17.2428V16.0056L1.52851 11.9918V12.2838C1.52851 12.6946 1.186 13.0262 0.761684 13.0262C0.337374 13.0262 -0.00514221 12.6946 -0.00514221 12.2838V4.63246C-0.00514221 4.34541 0.168671 4.0831 0.434505 3.95937L0.439619 3.97917ZM9.2837 4.30581L7.15703 5.31544L7.64268 5.65198L9.73868 4.54337L9.2837 4.31076V4.30581ZM5.58759 6.05781L2.40781 7.56729L3.2002 8.00282L6.14993 6.44384L5.5927 6.05781H5.58759ZM1.53362 6.32506L8.52709 3.00914V1.91538L1.53362 5.12242V6.32506ZM11.3695 5.36988L4.76453 8.86891L9.08432 11.2494L15.6535 7.55244L11.3746 5.36988H11.3695ZM16.4663 8.80952L9.85626 12.5313V14.2734L16.4663 10.3042V8.80458V8.80952ZM8.32261 14.2833V12.5313L2.81167 9.49251L1.53874 8.79468V10.2695L8.32772 14.2833H8.32261Z" fill="#59C2FF" />
					</svg>
					<span>2</span>
				</li>
				<li>
					<svg width="13" height="8" viewBox="0 0 20 12" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M18.2647 2.92583H4.21828V1.94885C4.21828 1.5601 4.44202 1.29923 4.59482 1.29923H6.58117C6.72851 1.29923 6.95771 1.5601 6.95771 1.94885C6.95771 2.30691 7.26876 2.59847 7.65075 2.59847C8.03274 2.59847 8.34379 2.30691 8.34379 1.94885C8.34379 0.87468 7.55252 0 6.58117 0H4.59482C3.62347 0 2.8322 0.87468 2.8322 1.94885V2.92583H1.74079C0.780355 2.92583 0 3.60102 0 4.42967C0 5.15601 0.600273 5.76471 1.39154 5.90281C1.53342 5.95908 1.69168 6 1.84993 6.02046L2.794 10.1279C2.83765 11.1662 3.75443 12.0051 4.87312 12.0051H15.1269C16.2401 12.0051 17.146 11.1867 17.206 10.1586L18.5375 5.9335C18.5375 5.9335 18.5812 5.91304 18.603 5.90793C19.3997 5.76982 20 5.16113 20 4.43478C20 3.60614 19.2196 2.93095 18.2592 2.93095L18.2647 2.92583ZM15.8199 9.95908V10.0512C15.8199 10.4092 15.5089 10.7008 15.1269 10.7008H4.87312C4.49113 10.7008 4.18008 10.4092 4.18008 10.0512V9.98466L3.25239 5.9335H17.0914L15.8199 9.95908ZM18.2647 4.63427H1.74079C1.54434 4.63427 1.39154 4.52685 1.39154 4.42967C1.39154 4.33248 1.54434 4.22506 1.74079 4.22506H18.2647C18.4611 4.22506 18.6139 4.33248 18.6139 4.42967C18.6139 4.52685 18.4611 4.63427 18.2647 4.63427Z" fill="#59C2FF" />
					</svg>
					<span>2.5</span>
				</li>
				<li>
					<svg width="11" height="10" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M16.8932 5.63175C16.8932 5.63175 16.9145 5.60919 16.9217 5.58663C16.9359 5.54904 16.9501 5.51896 16.9644 5.48137C16.9929 5.39114 17.0071 5.2934 17 5.20317C17 5.18062 17 5.16558 17 5.14302C17 5.09039 16.9858 5.04528 16.9715 4.99265C16.9715 4.98513 16.9644 4.97761 16.9644 4.97009C16.9501 4.9325 16.9359 4.88738 16.9145 4.84979C16.9145 4.83475 16.9003 4.82723 16.8932 4.8122C16.8718 4.78212 16.8576 4.75205 16.8362 4.72197C16.822 4.69942 16.8006 4.68438 16.7863 4.66934C16.7721 4.6543 16.7507 4.63175 16.7365 4.61671C16.7151 4.59415 16.6866 4.57911 16.6581 4.56408C16.6439 4.55656 16.6368 4.54152 16.6225 4.534L10.7256 1.28588C10.5119 1.1731 10.2627 1.16558 10.049 1.28588L8.74571 1.97009L5.14202 0.0828741C4.92836 -0.0299078 4.6791 -0.0223891 4.46544 0.0903929L0.391705 2.38363C0.14956 2.52648 0 2.78964 0 3.08287C0 3.37611 0.156682 3.63926 0.405949 3.7746L6.58777 7.06784L0.797654 10.3686C0.797654 10.3686 0.776288 10.3836 0.762044 10.3987C0.733557 10.4137 0.705069 10.4363 0.683703 10.4588C0.662338 10.4739 0.648094 10.4964 0.626728 10.5114C0.612484 10.5265 0.591119 10.5415 0.576875 10.5641C0.555509 10.5942 0.534143 10.6242 0.519899 10.6543C0.512778 10.6693 0.505656 10.6769 0.498534 10.6919C0.477168 10.737 0.462924 10.7821 0.44868 10.8272C0.441558 10.8573 0.434437 10.8799 0.427315 10.9099C0.427315 10.9325 0.413071 10.9626 0.413071 10.9851C0.413071 11.0152 0.413071 11.0378 0.413071 11.0678C0.413071 11.0904 0.413071 11.1129 0.413071 11.1355C0.413071 11.1731 0.427315 11.2032 0.434437 11.2408C0.434437 11.2558 0.434437 11.2708 0.441558 11.2859C0.455802 11.331 0.477168 11.3836 0.498534 11.4287C0.498534 11.4287 0.498534 11.4287 0.498534 11.4363C0.527021 11.4889 0.562631 11.534 0.59824 11.5791C0.612484 11.5942 0.619606 11.6017 0.63385 11.6167C0.66946 11.6468 0.705069 11.6769 0.740679 11.7069C0.754923 11.7145 0.762044 11.722 0.776288 11.7295C0.776288 11.7295 0.78341 11.7295 0.790532 11.737L8.14747 15.8949C8.14747 15.8949 8.21156 15.925 8.24717 15.9325C8.26854 15.94 8.2899 15.9551 8.31127 15.9551C8.37537 15.9701 8.43946 15.9851 8.49644 15.9851C8.55341 15.9851 8.61751 15.9776 8.68161 15.9626C8.70297 15.9626 8.71722 15.9475 8.73858 15.94C8.76707 15.9325 8.80268 15.9175 8.83117 15.9024L16.1382 11.9851C16.5015 11.7896 16.651 11.316 16.4659 10.9325C16.4587 10.9175 16.4445 10.9024 16.4374 10.8799C16.3946 10.6543 16.2593 10.4588 16.0528 10.346L12.385 8.39114L16.6154 5.90242C16.6154 5.90242 16.6297 5.88738 16.6439 5.87987C16.6724 5.85731 16.708 5.84227 16.7365 5.8122C16.7507 5.79716 16.765 5.78212 16.7792 5.76708C16.8006 5.74453 16.8148 5.72949 16.8362 5.70693C16.8576 5.67686 16.8718 5.6543 16.886 5.62423L16.8932 5.63175ZM4.82866 1.66182L7.17176 2.88739L4.75744 4.33851L2.35023 3.0528L4.82866 1.66182ZM14.3506 11.2032L8.51068 14.331L2.71345 11.0528L8.19732 7.92498L14.3506 11.2032ZM8.53205 6.34603L6.34562 5.18062L9.1018 3.52648L10.3766 2.85731L14.7067 5.24829L10.7897 7.54904L8.53205 6.34603Z" fill="#59C2FF" />
					</svg>
					<span>190 sqm</span>
				</li>
			</ul>
		</div>
	</div>
	<div class="property-item">
		<div class="thumb_img">
			<img src="/wp-content/uploads/2024/12/Rectangle-24.jpg">
			<span class="progress_dots"><span class="dots"></span> In Development</span>
		</div>
		<div class="properly_content">
			<div class="d-row">
				<div class="first_row">
					<h3>Ta’ Duru Houses</h3>
					<small>Nadur - Gozo</small>
				</div>
				<div class="last_row">
					<small>Starting from</small>
					<h4>€260,000</h4>
				</div>
			</div>
			<ul class="property_icon">
				<li>
					<svg width="12" height="10" viewBox="0 0 19 16" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M15.4284 16.0002H3.49222C2.48311 16.0002 1.66197 15.2043 1.66197 14.2262V9.22528H1.45421L1.37012 9.2061C0.97439 9.10541 0.628126 8.88964 0.380795 8.57319C-0.237534 7.79645 -0.0841881 6.67927 0.712219 6.08473L8.37949 0.355032C9.01761 -0.119646 9.97725 -0.119646 10.6154 0.355032L18.2826 6.07993C18.6685 6.36762 18.9208 6.78476 18.9801 7.25944C19.0444 7.72932 18.9158 8.19441 18.6141 8.57319C18.2826 8.99033 17.7929 9.23486 17.2587 9.26363V14.2262C17.2587 15.2043 16.4376 16.0002 15.4284 16.0002ZM1.65208 7.88275L3.03219 7.89234L3.04208 14.2214C3.04208 14.4611 3.24489 14.6577 3.49222 14.6577H15.4284C15.6758 14.6577 15.8786 14.4611 15.8786 14.2214V7.92111H17.1647C17.3082 7.92111 17.4368 7.85878 17.5209 7.75329C17.5951 7.6574 17.6247 7.54712 17.6099 7.43205C17.5951 7.31697 17.5357 7.21628 17.4368 7.14436L9.77444 1.41946C9.6211 1.30439 9.37871 1.30439 9.22537 1.41946L1.55809 7.13957C1.36023 7.28821 1.3256 7.5615 1.474 7.7485C1.51852 7.80604 1.58283 7.85398 1.65208 7.88275Z" fill="#59C2FF" />
					</svg>
					<span>Terraced House</span>
				</li>
				<li>
					<svg width="12" height="12" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M0.439619 3.97917L8.96674 0.0693542C8.96674 0.0693542 8.97697 0.0693542 8.98208 0.0644051C9.00764 0.0545068 9.0332 0.0446085 9.06387 0.0347103C9.08432 0.0297611 9.10477 0.0198629 9.13033 0.0149137C9.15078 0.00996459 9.17634 0.00996459 9.19679 0.00501546C9.22746 0.00501546 9.25302 -0.00488281 9.2837 -0.00488281C9.28881 -0.00488281 9.29392 -0.00488281 9.29903 -0.00488281C9.31437 -0.00488281 9.33482 -0.00488281 9.35015 6.63213e-05C9.38083 6.63213e-05 9.40639 6.63213e-05 9.43706 0.00996459C9.46262 0.00996459 9.48307 0.0198629 9.50863 0.024812C9.53419 0.0297611 9.55464 0.0396594 9.5802 0.0446085C9.60576 0.0545068 9.62621 0.0644051 9.64666 0.0743033C9.66711 0.0842016 9.68756 0.0940999 9.70801 0.108947C9.72846 0.123795 9.74891 0.133693 9.76935 0.14854C9.7898 0.163388 9.81025 0.178235 9.82559 0.193083C9.84092 0.20793 9.86137 0.227726 9.87671 0.247523C9.89205 0.26732 9.90738 0.282167 9.92272 0.301964C9.93806 0.326709 9.95339 0.346506 9.96873 0.371251C9.97895 0.386099 9.98918 0.395997 9.99429 0.415794C9.99429 0.415794 9.99429 0.425692 9.9994 0.430641C10.0096 0.455387 10.0199 0.480132 10.0301 0.509827C10.0352 0.529624 10.0454 0.554369 10.0505 0.574166C10.0556 0.593962 10.0556 0.618708 10.0607 0.638505C10.0607 0.668199 10.071 0.692945 10.071 0.72264C10.071 0.72264 10.071 0.732538 10.071 0.737487V3.01904L11.7222 3.86039L17.591 6.85957L17.6012 6.86452C17.6012 6.86452 17.6114 6.86452 17.6166 6.86946C17.6268 6.87441 17.637 6.88431 17.6472 6.88926C17.6626 6.89916 17.6779 6.90411 17.6881 6.91401C17.7035 6.9239 17.7137 6.9338 17.729 6.9437C17.7392 6.9536 17.7546 6.9635 17.7648 6.9734C17.775 6.98329 17.7904 6.99814 17.8006 7.01299C17.8108 7.02289 17.821 7.03773 17.8313 7.04763C17.8415 7.06248 17.8517 7.07238 17.8619 7.08723C17.8722 7.10207 17.8824 7.11197 17.8875 7.12682C17.8977 7.14167 17.9028 7.15651 17.9131 7.17136C17.9182 7.18621 17.9284 7.20106 17.9335 7.21095C17.9386 7.2258 17.9437 7.24065 17.954 7.26045C17.9591 7.27529 17.9642 7.29014 17.9693 7.30499C17.9693 7.31984 17.9795 7.33963 17.9795 7.35448C17.9795 7.36933 17.9846 7.38417 17.9897 7.39902C17.9897 7.41387 17.9897 7.43367 17.9897 7.45346C17.9897 7.46831 17.9897 7.47821 17.9897 7.49306V7.498C17.9897 7.498 17.9897 7.50295 17.9897 7.5079V12.462C17.9897 12.8728 17.6472 13.2044 17.2229 13.2044C16.7986 13.2044 16.4561 12.8728 16.4561 12.462V12.0413L9.84604 16.0056V17.2428C9.84604 17.6536 9.50352 17.9852 9.07921 17.9852C8.6549 17.9852 8.31238 17.6536 8.31238 17.2428V16.0056L1.52851 11.9918V12.2838C1.52851 12.6946 1.186 13.0262 0.761684 13.0262C0.337374 13.0262 -0.00514221 12.6946 -0.00514221 12.2838V4.63246C-0.00514221 4.34541 0.168671 4.0831 0.434505 3.95937L0.439619 3.97917ZM9.2837 4.30581L7.15703 5.31544L7.64268 5.65198L9.73868 4.54337L9.2837 4.31076V4.30581ZM5.58759 6.05781L2.40781 7.56729L3.2002 8.00282L6.14993 6.44384L5.5927 6.05781H5.58759ZM1.53362 6.32506L8.52709 3.00914V1.91538L1.53362 5.12242V6.32506ZM11.3695 5.36988L4.76453 8.86891L9.08432 11.2494L15.6535 7.55244L11.3746 5.36988H11.3695ZM16.4663 8.80952L9.85626 12.5313V14.2734L16.4663 10.3042V8.80458V8.80952ZM8.32261 14.2833V12.5313L2.81167 9.49251L1.53874 8.79468V10.2695L8.32772 14.2833H8.32261Z" fill="#59C2FF" />
					</svg>
					<span>2</span>
				</li>
				<li>
					<svg width="13" height="8" viewBox="0 0 20 12" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M18.2647 2.92583H4.21828V1.94885C4.21828 1.5601 4.44202 1.29923 4.59482 1.29923H6.58117C6.72851 1.29923 6.95771 1.5601 6.95771 1.94885C6.95771 2.30691 7.26876 2.59847 7.65075 2.59847C8.03274 2.59847 8.34379 2.30691 8.34379 1.94885C8.34379 0.87468 7.55252 0 6.58117 0H4.59482C3.62347 0 2.8322 0.87468 2.8322 1.94885V2.92583H1.74079C0.780355 2.92583 0 3.60102 0 4.42967C0 5.15601 0.600273 5.76471 1.39154 5.90281C1.53342 5.95908 1.69168 6 1.84993 6.02046L2.794 10.1279C2.83765 11.1662 3.75443 12.0051 4.87312 12.0051H15.1269C16.2401 12.0051 17.146 11.1867 17.206 10.1586L18.5375 5.9335C18.5375 5.9335 18.5812 5.91304 18.603 5.90793C19.3997 5.76982 20 5.16113 20 4.43478C20 3.60614 19.2196 2.93095 18.2592 2.93095L18.2647 2.92583ZM15.8199 9.95908V10.0512C15.8199 10.4092 15.5089 10.7008 15.1269 10.7008H4.87312C4.49113 10.7008 4.18008 10.4092 4.18008 10.0512V9.98466L3.25239 5.9335H17.0914L15.8199 9.95908ZM18.2647 4.63427H1.74079C1.54434 4.63427 1.39154 4.52685 1.39154 4.42967C1.39154 4.33248 1.54434 4.22506 1.74079 4.22506H18.2647C18.4611 4.22506 18.6139 4.33248 18.6139 4.42967C18.6139 4.52685 18.4611 4.63427 18.2647 4.63427Z" fill="#59C2FF" />
					</svg>
					<span>2.5</span>
				</li>
				<li>
					<svg width="11" height="10" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M16.8932 5.63175C16.8932 5.63175 16.9145 5.60919 16.9217 5.58663C16.9359 5.54904 16.9501 5.51896 16.9644 5.48137C16.9929 5.39114 17.0071 5.2934 17 5.20317C17 5.18062 17 5.16558 17 5.14302C17 5.09039 16.9858 5.04528 16.9715 4.99265C16.9715 4.98513 16.9644 4.97761 16.9644 4.97009C16.9501 4.9325 16.9359 4.88738 16.9145 4.84979C16.9145 4.83475 16.9003 4.82723 16.8932 4.8122C16.8718 4.78212 16.8576 4.75205 16.8362 4.72197C16.822 4.69942 16.8006 4.68438 16.7863 4.66934C16.7721 4.6543 16.7507 4.63175 16.7365 4.61671C16.7151 4.59415 16.6866 4.57911 16.6581 4.56408C16.6439 4.55656 16.6368 4.54152 16.6225 4.534L10.7256 1.28588C10.5119 1.1731 10.2627 1.16558 10.049 1.28588L8.74571 1.97009L5.14202 0.0828741C4.92836 -0.0299078 4.6791 -0.0223891 4.46544 0.0903929L0.391705 2.38363C0.14956 2.52648 0 2.78964 0 3.08287C0 3.37611 0.156682 3.63926 0.405949 3.7746L6.58777 7.06784L0.797654 10.3686C0.797654 10.3686 0.776288 10.3836 0.762044 10.3987C0.733557 10.4137 0.705069 10.4363 0.683703 10.4588C0.662338 10.4739 0.648094 10.4964 0.626728 10.5114C0.612484 10.5265 0.591119 10.5415 0.576875 10.5641C0.555509 10.5942 0.534143 10.6242 0.519899 10.6543C0.512778 10.6693 0.505656 10.6769 0.498534 10.6919C0.477168 10.737 0.462924 10.7821 0.44868 10.8272C0.441558 10.8573 0.434437 10.8799 0.427315 10.9099C0.427315 10.9325 0.413071 10.9626 0.413071 10.9851C0.413071 11.0152 0.413071 11.0378 0.413071 11.0678C0.413071 11.0904 0.413071 11.1129 0.413071 11.1355C0.413071 11.1731 0.427315 11.2032 0.434437 11.2408C0.434437 11.2558 0.434437 11.2708 0.441558 11.2859C0.455802 11.331 0.477168 11.3836 0.498534 11.4287C0.498534 11.4287 0.498534 11.4287 0.498534 11.4363C0.527021 11.4889 0.562631 11.534 0.59824 11.5791C0.612484 11.5942 0.619606 11.6017 0.63385 11.6167C0.66946 11.6468 0.705069 11.6769 0.740679 11.7069C0.754923 11.7145 0.762044 11.722 0.776288 11.7295C0.776288 11.7295 0.78341 11.7295 0.790532 11.737L8.14747 15.8949C8.14747 15.8949 8.21156 15.925 8.24717 15.9325C8.26854 15.94 8.2899 15.9551 8.31127 15.9551C8.37537 15.9701 8.43946 15.9851 8.49644 15.9851C8.55341 15.9851 8.61751 15.9776 8.68161 15.9626C8.70297 15.9626 8.71722 15.9475 8.73858 15.94C8.76707 15.9325 8.80268 15.9175 8.83117 15.9024L16.1382 11.9851C16.5015 11.7896 16.651 11.316 16.4659 10.9325C16.4587 10.9175 16.4445 10.9024 16.4374 10.8799C16.3946 10.6543 16.2593 10.4588 16.0528 10.346L12.385 8.39114L16.6154 5.90242C16.6154 5.90242 16.6297 5.88738 16.6439 5.87987C16.6724 5.85731 16.708 5.84227 16.7365 5.8122C16.7507 5.79716 16.765 5.78212 16.7792 5.76708C16.8006 5.74453 16.8148 5.72949 16.8362 5.70693C16.8576 5.67686 16.8718 5.6543 16.886 5.62423L16.8932 5.63175ZM4.82866 1.66182L7.17176 2.88739L4.75744 4.33851L2.35023 3.0528L4.82866 1.66182ZM14.3506 11.2032L8.51068 14.331L2.71345 11.0528L8.19732 7.92498L14.3506 11.2032ZM8.53205 6.34603L6.34562 5.18062L9.1018 3.52648L10.3766 2.85731L14.7067 5.24829L10.7897 7.54904L8.53205 6.34603Z" fill="#59C2FF" />
					</svg>
					<span>190 sqm</span>
				</li>
			</ul>
		</div>
	</div>
	<div class="property-item">
		<div class="thumb_img">
			<img src="/wp-content/uploads/2024/12/Rectangle-24.jpg">
			<span class="progress_dots"><span class="dots"></span> In Development</span>
		</div>
		<div class="properly_content">
			<div class="d-row">
				<div class="first_row">
					<h3>Ta’ Duru Houses</h3>
					<small>Nadur - Gozo</small>
				</div>
				<div class="last_row">
					<small>Starting from</small>
					<h4>€260,000</h4>
				</div>
			</div>
			<ul class="property_icon">
				<li>
					<svg width="12" height="10" viewBox="0 0 19 16" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M15.4284 16.0002H3.49222C2.48311 16.0002 1.66197 15.2043 1.66197 14.2262V9.22528H1.45421L1.37012 9.2061C0.97439 9.10541 0.628126 8.88964 0.380795 8.57319C-0.237534 7.79645 -0.0841881 6.67927 0.712219 6.08473L8.37949 0.355032C9.01761 -0.119646 9.97725 -0.119646 10.6154 0.355032L18.2826 6.07993C18.6685 6.36762 18.9208 6.78476 18.9801 7.25944C19.0444 7.72932 18.9158 8.19441 18.6141 8.57319C18.2826 8.99033 17.7929 9.23486 17.2587 9.26363V14.2262C17.2587 15.2043 16.4376 16.0002 15.4284 16.0002ZM1.65208 7.88275L3.03219 7.89234L3.04208 14.2214C3.04208 14.4611 3.24489 14.6577 3.49222 14.6577H15.4284C15.6758 14.6577 15.8786 14.4611 15.8786 14.2214V7.92111H17.1647C17.3082 7.92111 17.4368 7.85878 17.5209 7.75329C17.5951 7.6574 17.6247 7.54712 17.6099 7.43205C17.5951 7.31697 17.5357 7.21628 17.4368 7.14436L9.77444 1.41946C9.6211 1.30439 9.37871 1.30439 9.22537 1.41946L1.55809 7.13957C1.36023 7.28821 1.3256 7.5615 1.474 7.7485C1.51852 7.80604 1.58283 7.85398 1.65208 7.88275Z" fill="#59C2FF" />
					</svg>
					<span>Terraced House</span>
				</li>
				<li>
					<svg width="12" height="12" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M0.439619 3.97917L8.96674 0.0693542C8.96674 0.0693542 8.97697 0.0693542 8.98208 0.0644051C9.00764 0.0545068 9.0332 0.0446085 9.06387 0.0347103C9.08432 0.0297611 9.10477 0.0198629 9.13033 0.0149137C9.15078 0.00996459 9.17634 0.00996459 9.19679 0.00501546C9.22746 0.00501546 9.25302 -0.00488281 9.2837 -0.00488281C9.28881 -0.00488281 9.29392 -0.00488281 9.29903 -0.00488281C9.31437 -0.00488281 9.33482 -0.00488281 9.35015 6.63213e-05C9.38083 6.63213e-05 9.40639 6.63213e-05 9.43706 0.00996459C9.46262 0.00996459 9.48307 0.0198629 9.50863 0.024812C9.53419 0.0297611 9.55464 0.0396594 9.5802 0.0446085C9.60576 0.0545068 9.62621 0.0644051 9.64666 0.0743033C9.66711 0.0842016 9.68756 0.0940999 9.70801 0.108947C9.72846 0.123795 9.74891 0.133693 9.76935 0.14854C9.7898 0.163388 9.81025 0.178235 9.82559 0.193083C9.84092 0.20793 9.86137 0.227726 9.87671 0.247523C9.89205 0.26732 9.90738 0.282167 9.92272 0.301964C9.93806 0.326709 9.95339 0.346506 9.96873 0.371251C9.97895 0.386099 9.98918 0.395997 9.99429 0.415794C9.99429 0.415794 9.99429 0.425692 9.9994 0.430641C10.0096 0.455387 10.0199 0.480132 10.0301 0.509827C10.0352 0.529624 10.0454 0.554369 10.0505 0.574166C10.0556 0.593962 10.0556 0.618708 10.0607 0.638505C10.0607 0.668199 10.071 0.692945 10.071 0.72264C10.071 0.72264 10.071 0.732538 10.071 0.737487V3.01904L11.7222 3.86039L17.591 6.85957L17.6012 6.86452C17.6012 6.86452 17.6114 6.86452 17.6166 6.86946C17.6268 6.87441 17.637 6.88431 17.6472 6.88926C17.6626 6.89916 17.6779 6.90411 17.6881 6.91401C17.7035 6.9239 17.7137 6.9338 17.729 6.9437C17.7392 6.9536 17.7546 6.9635 17.7648 6.9734C17.775 6.98329 17.7904 6.99814 17.8006 7.01299C17.8108 7.02289 17.821 7.03773 17.8313 7.04763C17.8415 7.06248 17.8517 7.07238 17.8619 7.08723C17.8722 7.10207 17.8824 7.11197 17.8875 7.12682C17.8977 7.14167 17.9028 7.15651 17.9131 7.17136C17.9182 7.18621 17.9284 7.20106 17.9335 7.21095C17.9386 7.2258 17.9437 7.24065 17.954 7.26045C17.9591 7.27529 17.9642 7.29014 17.9693 7.30499C17.9693 7.31984 17.9795 7.33963 17.9795 7.35448C17.9795 7.36933 17.9846 7.38417 17.9897 7.39902C17.9897 7.41387 17.9897 7.43367 17.9897 7.45346C17.9897 7.46831 17.9897 7.47821 17.9897 7.49306V7.498C17.9897 7.498 17.9897 7.50295 17.9897 7.5079V12.462C17.9897 12.8728 17.6472 13.2044 17.2229 13.2044C16.7986 13.2044 16.4561 12.8728 16.4561 12.462V12.0413L9.84604 16.0056V17.2428C9.84604 17.6536 9.50352 17.9852 9.07921 17.9852C8.6549 17.9852 8.31238 17.6536 8.31238 17.2428V16.0056L1.52851 11.9918V12.2838C1.52851 12.6946 1.186 13.0262 0.761684 13.0262C0.337374 13.0262 -0.00514221 12.6946 -0.00514221 12.2838V4.63246C-0.00514221 4.34541 0.168671 4.0831 0.434505 3.95937L0.439619 3.97917ZM9.2837 4.30581L7.15703 5.31544L7.64268 5.65198L9.73868 4.54337L9.2837 4.31076V4.30581ZM5.58759 6.05781L2.40781 7.56729L3.2002 8.00282L6.14993 6.44384L5.5927 6.05781H5.58759ZM1.53362 6.32506L8.52709 3.00914V1.91538L1.53362 5.12242V6.32506ZM11.3695 5.36988L4.76453 8.86891L9.08432 11.2494L15.6535 7.55244L11.3746 5.36988H11.3695ZM16.4663 8.80952L9.85626 12.5313V14.2734L16.4663 10.3042V8.80458V8.80952ZM8.32261 14.2833V12.5313L2.81167 9.49251L1.53874 8.79468V10.2695L8.32772 14.2833H8.32261Z" fill="#59C2FF" />
					</svg>
					<span>2</span>
				</li>
				<li>
					<svg width="13" height="8" viewBox="0 0 20 12" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M18.2647 2.92583H4.21828V1.94885C4.21828 1.5601 4.44202 1.29923 4.59482 1.29923H6.58117C6.72851 1.29923 6.95771 1.5601 6.95771 1.94885C6.95771 2.30691 7.26876 2.59847 7.65075 2.59847C8.03274 2.59847 8.34379 2.30691 8.34379 1.94885C8.34379 0.87468 7.55252 0 6.58117 0H4.59482C3.62347 0 2.8322 0.87468 2.8322 1.94885V2.92583H1.74079C0.780355 2.92583 0 3.60102 0 4.42967C0 5.15601 0.600273 5.76471 1.39154 5.90281C1.53342 5.95908 1.69168 6 1.84993 6.02046L2.794 10.1279C2.83765 11.1662 3.75443 12.0051 4.87312 12.0051H15.1269C16.2401 12.0051 17.146 11.1867 17.206 10.1586L18.5375 5.9335C18.5375 5.9335 18.5812 5.91304 18.603 5.90793C19.3997 5.76982 20 5.16113 20 4.43478C20 3.60614 19.2196 2.93095 18.2592 2.93095L18.2647 2.92583ZM15.8199 9.95908V10.0512C15.8199 10.4092 15.5089 10.7008 15.1269 10.7008H4.87312C4.49113 10.7008 4.18008 10.4092 4.18008 10.0512V9.98466L3.25239 5.9335H17.0914L15.8199 9.95908ZM18.2647 4.63427H1.74079C1.54434 4.63427 1.39154 4.52685 1.39154 4.42967C1.39154 4.33248 1.54434 4.22506 1.74079 4.22506H18.2647C18.4611 4.22506 18.6139 4.33248 18.6139 4.42967C18.6139 4.52685 18.4611 4.63427 18.2647 4.63427Z" fill="#59C2FF" />
					</svg>
					<span>2.5</span>
				</li>
				<li>
					<svg width="11" height="10" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M16.8932 5.63175C16.8932 5.63175 16.9145 5.60919 16.9217 5.58663C16.9359 5.54904 16.9501 5.51896 16.9644 5.48137C16.9929 5.39114 17.0071 5.2934 17 5.20317C17 5.18062 17 5.16558 17 5.14302C17 5.09039 16.9858 5.04528 16.9715 4.99265C16.9715 4.98513 16.9644 4.97761 16.9644 4.97009C16.9501 4.9325 16.9359 4.88738 16.9145 4.84979C16.9145 4.83475 16.9003 4.82723 16.8932 4.8122C16.8718 4.78212 16.8576 4.75205 16.8362 4.72197C16.822 4.69942 16.8006 4.68438 16.7863 4.66934C16.7721 4.6543 16.7507 4.63175 16.7365 4.61671C16.7151 4.59415 16.6866 4.57911 16.6581 4.56408C16.6439 4.55656 16.6368 4.54152 16.6225 4.534L10.7256 1.28588C10.5119 1.1731 10.2627 1.16558 10.049 1.28588L8.74571 1.97009L5.14202 0.0828741C4.92836 -0.0299078 4.6791 -0.0223891 4.46544 0.0903929L0.391705 2.38363C0.14956 2.52648 0 2.78964 0 3.08287C0 3.37611 0.156682 3.63926 0.405949 3.7746L6.58777 7.06784L0.797654 10.3686C0.797654 10.3686 0.776288 10.3836 0.762044 10.3987C0.733557 10.4137 0.705069 10.4363 0.683703 10.4588C0.662338 10.4739 0.648094 10.4964 0.626728 10.5114C0.612484 10.5265 0.591119 10.5415 0.576875 10.5641C0.555509 10.5942 0.534143 10.6242 0.519899 10.6543C0.512778 10.6693 0.505656 10.6769 0.498534 10.6919C0.477168 10.737 0.462924 10.7821 0.44868 10.8272C0.441558 10.8573 0.434437 10.8799 0.427315 10.9099C0.427315 10.9325 0.413071 10.9626 0.413071 10.9851C0.413071 11.0152 0.413071 11.0378 0.413071 11.0678C0.413071 11.0904 0.413071 11.1129 0.413071 11.1355C0.413071 11.1731 0.427315 11.2032 0.434437 11.2408C0.434437 11.2558 0.434437 11.2708 0.441558 11.2859C0.455802 11.331 0.477168 11.3836 0.498534 11.4287C0.498534 11.4287 0.498534 11.4287 0.498534 11.4363C0.527021 11.4889 0.562631 11.534 0.59824 11.5791C0.612484 11.5942 0.619606 11.6017 0.63385 11.6167C0.66946 11.6468 0.705069 11.6769 0.740679 11.7069C0.754923 11.7145 0.762044 11.722 0.776288 11.7295C0.776288 11.7295 0.78341 11.7295 0.790532 11.737L8.14747 15.8949C8.14747 15.8949 8.21156 15.925 8.24717 15.9325C8.26854 15.94 8.2899 15.9551 8.31127 15.9551C8.37537 15.9701 8.43946 15.9851 8.49644 15.9851C8.55341 15.9851 8.61751 15.9776 8.68161 15.9626C8.70297 15.9626 8.71722 15.9475 8.73858 15.94C8.76707 15.9325 8.80268 15.9175 8.83117 15.9024L16.1382 11.9851C16.5015 11.7896 16.651 11.316 16.4659 10.9325C16.4587 10.9175 16.4445 10.9024 16.4374 10.8799C16.3946 10.6543 16.2593 10.4588 16.0528 10.346L12.385 8.39114L16.6154 5.90242C16.6154 5.90242 16.6297 5.88738 16.6439 5.87987C16.6724 5.85731 16.708 5.84227 16.7365 5.8122C16.7507 5.79716 16.765 5.78212 16.7792 5.76708C16.8006 5.74453 16.8148 5.72949 16.8362 5.70693C16.8576 5.67686 16.8718 5.6543 16.886 5.62423L16.8932 5.63175ZM4.82866 1.66182L7.17176 2.88739L4.75744 4.33851L2.35023 3.0528L4.82866 1.66182ZM14.3506 11.2032L8.51068 14.331L2.71345 11.0528L8.19732 7.92498L14.3506 11.2032ZM8.53205 6.34603L6.34562 5.18062L9.1018 3.52648L10.3766 2.85731L14.7067 5.24829L10.7897 7.54904L8.53205 6.34603Z" fill="#59C2FF" />
					</svg>
					<span>190 sqm</span>
				</li>
			</ul>
		</div>
	</div>
	<div class="property-item">
		<div class="thumb_img">
			<img src="/wp-content/uploads/2024/12/Rectangle-24.jpg">
			<span class="progress_dots"><span class="dots"></span> In Development</span>
		</div>
		<div class="properly_content">
			<div class="d-row">
				<div class="first_row">
					<h3>Ta’ Duru Houses</h3>
					<small>Nadur - Gozo</small>
				</div>
				<div class="last_row">
					<small>Starting from</small>
					<h4>€260,000</h4>
				</div>
			</div>
			<ul class="property_icon">
				<li>
					<svg width="12" height="10" viewBox="0 0 19 16" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M15.4284 16.0002H3.49222C2.48311 16.0002 1.66197 15.2043 1.66197 14.2262V9.22528H1.45421L1.37012 9.2061C0.97439 9.10541 0.628126 8.88964 0.380795 8.57319C-0.237534 7.79645 -0.0841881 6.67927 0.712219 6.08473L8.37949 0.355032C9.01761 -0.119646 9.97725 -0.119646 10.6154 0.355032L18.2826 6.07993C18.6685 6.36762 18.9208 6.78476 18.9801 7.25944C19.0444 7.72932 18.9158 8.19441 18.6141 8.57319C18.2826 8.99033 17.7929 9.23486 17.2587 9.26363V14.2262C17.2587 15.2043 16.4376 16.0002 15.4284 16.0002ZM1.65208 7.88275L3.03219 7.89234L3.04208 14.2214C3.04208 14.4611 3.24489 14.6577 3.49222 14.6577H15.4284C15.6758 14.6577 15.8786 14.4611 15.8786 14.2214V7.92111H17.1647C17.3082 7.92111 17.4368 7.85878 17.5209 7.75329C17.5951 7.6574 17.6247 7.54712 17.6099 7.43205C17.5951 7.31697 17.5357 7.21628 17.4368 7.14436L9.77444 1.41946C9.6211 1.30439 9.37871 1.30439 9.22537 1.41946L1.55809 7.13957C1.36023 7.28821 1.3256 7.5615 1.474 7.7485C1.51852 7.80604 1.58283 7.85398 1.65208 7.88275Z" fill="#59C2FF" />
					</svg>
					<span>Terraced House</span>
				</li>
				<li>
					<svg width="12" height="12" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M0.439619 3.97917L8.96674 0.0693542C8.96674 0.0693542 8.97697 0.0693542 8.98208 0.0644051C9.00764 0.0545068 9.0332 0.0446085 9.06387 0.0347103C9.08432 0.0297611 9.10477 0.0198629 9.13033 0.0149137C9.15078 0.00996459 9.17634 0.00996459 9.19679 0.00501546C9.22746 0.00501546 9.25302 -0.00488281 9.2837 -0.00488281C9.28881 -0.00488281 9.29392 -0.00488281 9.29903 -0.00488281C9.31437 -0.00488281 9.33482 -0.00488281 9.35015 6.63213e-05C9.38083 6.63213e-05 9.40639 6.63213e-05 9.43706 0.00996459C9.46262 0.00996459 9.48307 0.0198629 9.50863 0.024812C9.53419 0.0297611 9.55464 0.0396594 9.5802 0.0446085C9.60576 0.0545068 9.62621 0.0644051 9.64666 0.0743033C9.66711 0.0842016 9.68756 0.0940999 9.70801 0.108947C9.72846 0.123795 9.74891 0.133693 9.76935 0.14854C9.7898 0.163388 9.81025 0.178235 9.82559 0.193083C9.84092 0.20793 9.86137 0.227726 9.87671 0.247523C9.89205 0.26732 9.90738 0.282167 9.92272 0.301964C9.93806 0.326709 9.95339 0.346506 9.96873 0.371251C9.97895 0.386099 9.98918 0.395997 9.99429 0.415794C9.99429 0.415794 9.99429 0.425692 9.9994 0.430641C10.0096 0.455387 10.0199 0.480132 10.0301 0.509827C10.0352 0.529624 10.0454 0.554369 10.0505 0.574166C10.0556 0.593962 10.0556 0.618708 10.0607 0.638505C10.0607 0.668199 10.071 0.692945 10.071 0.72264C10.071 0.72264 10.071 0.732538 10.071 0.737487V3.01904L11.7222 3.86039L17.591 6.85957L17.6012 6.86452C17.6012 6.86452 17.6114 6.86452 17.6166 6.86946C17.6268 6.87441 17.637 6.88431 17.6472 6.88926C17.6626 6.89916 17.6779 6.90411 17.6881 6.91401C17.7035 6.9239 17.7137 6.9338 17.729 6.9437C17.7392 6.9536 17.7546 6.9635 17.7648 6.9734C17.775 6.98329 17.7904 6.99814 17.8006 7.01299C17.8108 7.02289 17.821 7.03773 17.8313 7.04763C17.8415 7.06248 17.8517 7.07238 17.8619 7.08723C17.8722 7.10207 17.8824 7.11197 17.8875 7.12682C17.8977 7.14167 17.9028 7.15651 17.9131 7.17136C17.9182 7.18621 17.9284 7.20106 17.9335 7.21095C17.9386 7.2258 17.9437 7.24065 17.954 7.26045C17.9591 7.27529 17.9642 7.29014 17.9693 7.30499C17.9693 7.31984 17.9795 7.33963 17.9795 7.35448C17.9795 7.36933 17.9846 7.38417 17.9897 7.39902C17.9897 7.41387 17.9897 7.43367 17.9897 7.45346C17.9897 7.46831 17.9897 7.47821 17.9897 7.49306V7.498C17.9897 7.498 17.9897 7.50295 17.9897 7.5079V12.462C17.9897 12.8728 17.6472 13.2044 17.2229 13.2044C16.7986 13.2044 16.4561 12.8728 16.4561 12.462V12.0413L9.84604 16.0056V17.2428C9.84604 17.6536 9.50352 17.9852 9.07921 17.9852C8.6549 17.9852 8.31238 17.6536 8.31238 17.2428V16.0056L1.52851 11.9918V12.2838C1.52851 12.6946 1.186 13.0262 0.761684 13.0262C0.337374 13.0262 -0.00514221 12.6946 -0.00514221 12.2838V4.63246C-0.00514221 4.34541 0.168671 4.0831 0.434505 3.95937L0.439619 3.97917ZM9.2837 4.30581L7.15703 5.31544L7.64268 5.65198L9.73868 4.54337L9.2837 4.31076V4.30581ZM5.58759 6.05781L2.40781 7.56729L3.2002 8.00282L6.14993 6.44384L5.5927 6.05781H5.58759ZM1.53362 6.32506L8.52709 3.00914V1.91538L1.53362 5.12242V6.32506ZM11.3695 5.36988L4.76453 8.86891L9.08432 11.2494L15.6535 7.55244L11.3746 5.36988H11.3695ZM16.4663 8.80952L9.85626 12.5313V14.2734L16.4663 10.3042V8.80458V8.80952ZM8.32261 14.2833V12.5313L2.81167 9.49251L1.53874 8.79468V10.2695L8.32772 14.2833H8.32261Z" fill="#59C2FF" />
					</svg>
					<span>2</span>
				</li>
				<li>
					<svg width="13" height="8" viewBox="0 0 20 12" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M18.2647 2.92583H4.21828V1.94885C4.21828 1.5601 4.44202 1.29923 4.59482 1.29923H6.58117C6.72851 1.29923 6.95771 1.5601 6.95771 1.94885C6.95771 2.30691 7.26876 2.59847 7.65075 2.59847C8.03274 2.59847 8.34379 2.30691 8.34379 1.94885C8.34379 0.87468 7.55252 0 6.58117 0H4.59482C3.62347 0 2.8322 0.87468 2.8322 1.94885V2.92583H1.74079C0.780355 2.92583 0 3.60102 0 4.42967C0 5.15601 0.600273 5.76471 1.39154 5.90281C1.53342 5.95908 1.69168 6 1.84993 6.02046L2.794 10.1279C2.83765 11.1662 3.75443 12.0051 4.87312 12.0051H15.1269C16.2401 12.0051 17.146 11.1867 17.206 10.1586L18.5375 5.9335C18.5375 5.9335 18.5812 5.91304 18.603 5.90793C19.3997 5.76982 20 5.16113 20 4.43478C20 3.60614 19.2196 2.93095 18.2592 2.93095L18.2647 2.92583ZM15.8199 9.95908V10.0512C15.8199 10.4092 15.5089 10.7008 15.1269 10.7008H4.87312C4.49113 10.7008 4.18008 10.4092 4.18008 10.0512V9.98466L3.25239 5.9335H17.0914L15.8199 9.95908ZM18.2647 4.63427H1.74079C1.54434 4.63427 1.39154 4.52685 1.39154 4.42967C1.39154 4.33248 1.54434 4.22506 1.74079 4.22506H18.2647C18.4611 4.22506 18.6139 4.33248 18.6139 4.42967C18.6139 4.52685 18.4611 4.63427 18.2647 4.63427Z" fill="#59C2FF" />
					</svg>
					<span>2.5</span>
				</li>
				<li>
					<svg width="11" height="10" viewBox="0 0 17 16" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M16.8932 5.63175C16.8932 5.63175 16.9145 5.60919 16.9217 5.58663C16.9359 5.54904 16.9501 5.51896 16.9644 5.48137C16.9929 5.39114 17.0071 5.2934 17 5.20317C17 5.18062 17 5.16558 17 5.14302C17 5.09039 16.9858 5.04528 16.9715 4.99265C16.9715 4.98513 16.9644 4.97761 16.9644 4.97009C16.9501 4.9325 16.9359 4.88738 16.9145 4.84979C16.9145 4.83475 16.9003 4.82723 16.8932 4.8122C16.8718 4.78212 16.8576 4.75205 16.8362 4.72197C16.822 4.69942 16.8006 4.68438 16.7863 4.66934C16.7721 4.6543 16.7507 4.63175 16.7365 4.61671C16.7151 4.59415 16.6866 4.57911 16.6581 4.56408C16.6439 4.55656 16.6368 4.54152 16.6225 4.534L10.7256 1.28588C10.5119 1.1731 10.2627 1.16558 10.049 1.28588L8.74571 1.97009L5.14202 0.0828741C4.92836 -0.0299078 4.6791 -0.0223891 4.46544 0.0903929L0.391705 2.38363C0.14956 2.52648 0 2.78964 0 3.08287C0 3.37611 0.156682 3.63926 0.405949 3.7746L6.58777 7.06784L0.797654 10.3686C0.797654 10.3686 0.776288 10.3836 0.762044 10.3987C0.733557 10.4137 0.705069 10.4363 0.683703 10.4588C0.662338 10.4739 0.648094 10.4964 0.626728 10.5114C0.612484 10.5265 0.591119 10.5415 0.576875 10.5641C0.555509 10.5942 0.534143 10.6242 0.519899 10.6543C0.512778 10.6693 0.505656 10.6769 0.498534 10.6919C0.477168 10.737 0.462924 10.7821 0.44868 10.8272C0.441558 10.8573 0.434437 10.8799 0.427315 10.9099C0.427315 10.9325 0.413071 10.9626 0.413071 10.9851C0.413071 11.0152 0.413071 11.0378 0.413071 11.0678C0.413071 11.0904 0.413071 11.1129 0.413071 11.1355C0.413071 11.1731 0.427315 11.2032 0.434437 11.2408C0.434437 11.2558 0.434437 11.2708 0.441558 11.2859C0.455802 11.331 0.477168 11.3836 0.498534 11.4287C0.498534 11.4287 0.498534 11.4287 0.498534 11.4363C0.527021 11.4889 0.562631 11.534 0.59824 11.5791C0.612484 11.5942 0.619606 11.6017 0.63385 11.6167C0.66946 11.6468 0.705069 11.6769 0.740679 11.7069C0.754923 11.7145 0.762044 11.722 0.776288 11.7295C0.776288 11.7295 0.78341 11.7295 0.790532 11.737L8.14747 15.8949C8.14747 15.8949 8.21156 15.925 8.24717 15.9325C8.26854 15.94 8.2899 15.9551 8.31127 15.9551C8.37537 15.9701 8.43946 15.9851 8.49644 15.9851C8.55341 15.9851 8.61751 15.9776 8.68161 15.9626C8.70297 15.9626 8.71722 15.9475 8.73858 15.94C8.76707 15.9325 8.80268 15.9175 8.83117 15.9024L16.1382 11.9851C16.5015 11.7896 16.651 11.316 16.4659 10.9325C16.4587 10.9175 16.4445 10.9024 16.4374 10.8799C16.3946 10.6543 16.2593 10.4588 16.0528 10.346L12.385 8.39114L16.6154 5.90242C16.6154 5.90242 16.6297 5.88738 16.6439 5.87987C16.6724 5.85731 16.708 5.84227 16.7365 5.8122C16.7507 5.79716 16.765 5.78212 16.7792 5.76708C16.8006 5.74453 16.8148 5.72949 16.8362 5.70693C16.8576 5.67686 16.8718 5.6543 16.886 5.62423L16.8932 5.63175ZM4.82866 1.66182L7.17176 2.88739L4.75744 4.33851L2.35023 3.0528L4.82866 1.66182ZM14.3506 11.2032L8.51068 14.331L2.71345 11.0528L8.19732 7.92498L14.3506 11.2032ZM8.53205 6.34603L6.34562 5.18062L9.1018 3.52648L10.3766 2.85731L14.7067 5.24829L10.7897 7.54904L8.53205 6.34603Z" fill="#59C2FF" />
					</svg>
					<span>190 sqm</span>
				</li>
			</ul>
		</div>
	</div>
</div>
<div class="loading center">
	<button class="load_btn" type="button">
		View More
		<svg width="8" height="16" viewBox="0 0 8 16" fill="none" xmlns="http://www.w3.org/2000/svg">
			<path d="M4.5 0.941406C4.5 0.665264 4.27614 0.441406 4 0.441406C3.72386 0.441406 3.5 0.665264 3.5 0.941406L4.5 0.941406ZM3.64645 15.4126C3.84171 15.6079 4.15829 15.6079 4.35355 15.4126L7.53553 12.2306C7.7308 12.0354 7.7308 11.7188 7.53553 11.5235C7.34027 11.3283 7.02369 11.3283 6.82843 11.5235L4 14.3519L1.17157 11.5235C0.97631 11.3283 0.659728 11.3283 0.464466 11.5235C0.269203 11.7188 0.269203 12.0354 0.464466 12.2306L3.64645 15.4126ZM3.5 0.941406L3.5 15.0591L4.5 15.0591L4.5 0.941406L3.5 0.941406Z" fill="#051B33"></path>
		</svg>
	</button>
</div>
<?php
	return ob_get_clean();
}
add_shortcode('filter', 'filter');
function filter()
{
	ob_start();
?>
<div class="filter_bar main_filter_bar">

	<!-- <div class="dropdown ">
		<div class="filter_button location_btn">
			<input type="text" placeholder="Location" >
			<img src="/wp-content/uploads/2024/12/Group-225.png" alt="">
		</div>

		<ul class="dropdown_menu v1_dropdown">
			<li>Studio</li>
			<li>2 Bedrooms</li>
			<li>3 Bedrooms</li>
			<li>4 Bedrooms</li>
			<li>5+ Bedrooms</li>
		</ul>
	</div> -->


	<div class="location-filter">
		<div class="location-input">
		  <div class="selected-locations-container"></div>
		  <input type="text" id="locationInput" placeholder="City or Neighborhood">
		</div>
		<div class="location-dropdown" id="locationDropdown">
		  <!-- Items will be added dynamically -->
		</div>
	  </div>


	

	<div class="dropdown">
		<button class="filter_button" type="button">
			Type
			<svg width="8" height="16" viewBox="0 0 8 16" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M4.5 0.941406C4.5 0.665264 4.27614 0.441406 4 0.441406C3.72386 0.441406 3.5 0.665264 3.5 0.941406L4.5 0.941406ZM3.64645 15.4126C3.84171 15.6079 4.15829 15.6079 4.35355 15.4126L7.53553 12.2306C7.7308 12.0354 7.7308 11.7188 7.53553 11.5235C7.34027 11.3283 7.02369 11.3283 6.82843 11.5235L4 14.3519L1.17157 11.5235C0.97631 11.3283 0.659728 11.3283 0.464466 11.5235C0.269203 11.7188 0.269203 12.0354 0.464466 12.2306L3.64645 15.4126ZM3.5 0.941406L3.5 15.0591L4.5 15.0591L4.5 0.941406L3.5 0.941406Z" fill="#051B33" />
			</svg>
		</button>
		<ul class="dropdown_menu v1_dropdown">
			<li>Studio</li>
			<li>2 Bedrooms</li>
			<li>3 Bedrooms</li>
			<li>4 Bedrooms</li>
			<li>5+ Bedrooms</li>
		</ul>
	</div>
	<div class="dropdown">
		<button class="filter_button" type="button">
			Bedrooms
			<svg width="8" height="16" viewBox="0 0 8 16" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M4.5 0.941406C4.5 0.665264 4.27614 0.441406 4 0.441406C3.72386 0.441406 3.5 0.665264 3.5 0.941406L4.5 0.941406ZM3.64645 15.4126C3.84171 15.6079 4.15829 15.6079 4.35355 15.4126L7.53553 12.2306C7.7308 12.0354 7.7308 11.7188 7.53553 11.5235C7.34027 11.3283 7.02369 11.3283 6.82843 11.5235L4 14.3519L1.17157 11.5235C0.97631 11.3283 0.659728 11.3283 0.464466 11.5235C0.269203 11.7188 0.269203 12.0354 0.464466 12.2306L3.64645 15.4126ZM3.5 0.941406L3.5 15.0591L4.5 15.0591L4.5 0.941406L3.5 0.941406Z" fill="#051B33" />
			</svg>
		</button>
		<ul class="dropdown_menu v1_dropdown">
			<li>Studio</li>
			<li>2 Bedrooms</li>
			<li>3 Bedrooms</li>
			<li>4 Bedrooms</li>
			<li>5+ Bedrooms</li>
		</ul>
	</div>
	<div class="dropdown">
		<button class="filter_button" type="button">
			Bathrooms
			<svg width="8" height="16" viewBox="0 0 8 16" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M4.5 0.941406C4.5 0.665264 4.27614 0.441406 4 0.441406C3.72386 0.441406 3.5 0.665264 3.5 0.941406L4.5 0.941406ZM3.64645 15.4126C3.84171 15.6079 4.15829 15.6079 4.35355 15.4126L7.53553 12.2306C7.7308 12.0354 7.7308 11.7188 7.53553 11.5235C7.34027 11.3283 7.02369 11.3283 6.82843 11.5235L4 14.3519L1.17157 11.5235C0.97631 11.3283 0.659728 11.3283 0.464466 11.5235C0.269203 11.7188 0.269203 12.0354 0.464466 12.2306L3.64645 15.4126ZM3.5 0.941406L3.5 15.0591L4.5 15.0591L4.5 0.941406L3.5 0.941406Z" fill="#051B33" />
			</svg>
		</button>
		<ul class="dropdown_menu v1_dropdown">
			<li>Studio</li>
			<li>2 Bedrooms</li>
			<li>3 Bedrooms</li>
			<li>4 Bedrooms</li>
			<li>5+ Bedrooms</li>
		</ul>
	</div>
	<div class="dropdown">
		<button class="filter_button" type="button">
			Price Range
			<svg width="8" height="16" viewBox="0 0 8 16" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M4.5 0.941406C4.5 0.665264 4.27614 0.441406 4 0.441406C3.72386 0.441406 3.5 0.665264 3.5 0.941406L4.5 0.941406ZM3.64645 15.4126C3.84171 15.6079 4.15829 15.6079 4.35355 15.4126L7.53553 12.2306C7.7308 12.0354 7.7308 11.7188 7.53553 11.5235C7.34027 11.3283 7.02369 11.3283 6.82843 11.5235L4 14.3519L1.17157 11.5235C0.97631 11.3283 0.659728 11.3283 0.464466 11.5235C0.269203 11.7188 0.269203 12.0354 0.464466 12.2306L3.64645 15.4126ZM3.5 0.941406L3.5 15.0591L4.5 15.0591L4.5 0.941406L3.5 0.941406Z" fill="#051B33" />
			</svg>
		</button>
		<div class="dropdown_menu">
			<div class="filter_dropdown">
				<div class="dropdown_body">
					<div class="head_dropdown">
						<h6>Price Range</h6>
						<span class="reset-price">reset</span>
					</div>
					<div class="extra-controls">
						<div class="min">
							€
							<input id="min" type="text" step="50000" min='0' max='2000000' class="only_number min js-input-from" placeholder="Min"/>
							<input style="display: none" type="number" name="min_price">
						</div>
						<span>-</span>
						<div class="max">
							€
							<input id="max" type="text" step="50000" min='0' max='2000000' class="only_number max js-input-to" placeholder="Max"/>
							<input style="display: none" type="number" name="max_price">
						</div>
					</div>
					<div class="range-slider">
						<input id="range" type="text" class="range js-range-slider" value="" />
					</div>
				</div>
				<div class="footer_dropdown">
					<button type="button" class="price apply_btn">Apply</button>
				</div>
			</div>
		</div>
	</div>

	<div class="dropdown">
		<button class="filter_button" type="button">
			Status
			<svg width="8" height="16" viewBox="0 0 8 16" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M4.5 0.941406C4.5 0.665264 4.27614 0.441406 4 0.441406C3.72386 0.441406 3.5 0.665264 3.5 0.941406L4.5 0.941406ZM3.64645 15.4126C3.84171 15.6079 4.15829 15.6079 4.35355 15.4126L7.53553 12.2306C7.7308 12.0354 7.7308 11.7188 7.53553 11.5235C7.34027 11.3283 7.02369 11.3283 6.82843 11.5235L4 14.3519L1.17157 11.5235C0.97631 11.3283 0.659728 11.3283 0.464466 11.5235C0.269203 11.7188 0.269203 12.0354 0.464466 12.2306L3.64645 15.4126ZM3.5 0.941406L3.5 15.0591L4.5 15.0591L4.5 0.941406L3.5 0.941406Z" fill="#051B33" />
			</svg>
		</button>
		<ul class="dropdown_menu v1_dropdown">
			<li>Studio</li>
			<li>2 Bedrooms</li>
			<li>3 Bedrooms</li>
			<li>4 Bedrooms</li>
			<li>5+ Bedrooms</li>
		</ul>
	</div>
	<div class="dropdown">
		<button class="filter_button filter_search" type="button">
			Search
			<svg width="8" height="16" viewBox="0 0 8 16" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M4.5 0.941406C4.5 0.665264 4.27614 0.441406 4 0.441406C3.72386 0.441406 3.5 0.665264 3.5 0.941406L4.5 0.941406ZM3.64645 15.4126C3.84171 15.6079 4.15829 15.6079 4.35355 15.4126L7.53553 12.2306C7.7308 12.0354 7.7308 11.7188 7.53553 11.5235C7.34027 11.3283 7.02369 11.3283 6.82843 11.5235L4 14.3519L1.17157 11.5235C0.97631 11.3283 0.659728 11.3283 0.464466 11.5235C0.269203 11.7188 0.269203 12.0354 0.464466 12.2306L3.64645 15.4126ZM3.5 0.941406L3.5 15.0591L4.5 15.0591L4.5 0.941406L3.5 0.941406Z" fill="#051B33" />
			</svg>
		</button>
	</div>
</div>
<?php
	return ob_get_clean();
}

add_shortcode('elzan_landing_testimonials', 'elzan_landing_testimonials_callback');
function elzan_landing_testimonials_callback()
{
	ob_start();
?>
<div class="elzan_testimonials_wrapper">
	<div class="section-title">
		<h2>Here is What Our Happy Homeowners Have to Say</h2>
	</div>
	<div class="elzan_testimoanils">
		<div class="testimonials-item">
			<div class="testimoanils-image">
				<div class="person-image">
					<img src="/wp-content/uploads/2024/11/review-client.png" alt="" srcset="">
				</div>
			</div>
			<div class="testimonials-item-content">
				<div class="quote-img">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/quote.png" alt="">
				</div>
				<div class="desc">
					<p>At Elzan Properties, we strive to provide a seamless and enjoyable buying experience for all our clients. </p>
				</div>
				<div class="info">
					<h2 class="author">
						Nuno Gamez
					</h2>
				</div>
			</div>
		</div>
		<div class="testimonials-item">
			<div class="testimoanils-image">
				<div class="person-image">
					<img src="/wp-content/uploads/2024/11/review-client.png" alt="" srcset="">
				</div>
			</div>
			<div class="testimonials-item-content">
				<div class="quote-img">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/quote.png" alt="">
				</div>
				<div class="desc">
					<p>At Elzan Properties, we strive to provide a seamless and enjoyable buying experience for all our clients. </p>
				</div>
				<div class="info">
					<h2 class="author">
						Nuno Gamez
					</h2>
				</div>
			</div>
		</div>
		<div class="testimonials-item">
			<div class="testimoanils-image">
				<div class="person-image">
					<img src="/wp-content/uploads/2024/11/review-client.png" alt="" srcset="">
				</div>
			</div>
			<div class="testimonials-item-content">
				<div class="quote-img">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/quote.png" alt="">
				</div>
				<div class="desc">
					<p>At Elzan Properties, we strive to provide a seamless and enjoyable buying experience for all our clients. </p>
				</div>
				<div class="info">
					<h2 class="author">
						Nuno Gamez
					</h2>
				</div>
			</div>
		</div>
		<div class="testimonials-item">
			<div class="testimoanils-image">
				<div class="person-image">
					<img src="/wp-content/uploads/2024/11/review-client.png" alt="" srcset="">
				</div>
			</div>
			<div class="testimonials-item-content">
				<div class="quote-img">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/quote.png" alt="">
				</div>
				<div class="desc">
					<p>At Elzan Properties, we strive to provide a seamless and enjoyable buying experience for all our clients. </p>
				</div>
				<div class="info">
					<h2 class="author">
						Nuno Gamez
					</h2>
				</div>
			</div>
		</div>

	</div>
</div>
<?php
	return ob_get_clean();
}

add_shortcode('elzan_properties_list', 'elzan_properties_list_callback');
function elzan_properties_list_callback()
{
	ob_start();
	// if($post == is_sticky()){
	//     get_template_part('template-part/single-property-two', null ,array('post_id' => $id));
	// } else {
	//     get_template_part('template-part/single-property', null ,array('post_id' => $id));
	// }
?>
<div class="elzan_properties_list_wrapper">
	<div class="properties-filter">
		<?php get_template_part('template-part/property-filter'); ?>
	</div>
	<?php

	$map = false;

	if ($map) { ?>
	<div class="properties-list-with-map">
		<div class="properties-list">
			<?php get_template_part('template-part/single-property-two'); ?>
			<?php get_template_part('template-part/single-property'); ?>
			<?php get_template_part('template-part/single-property'); ?>
			<?php get_template_part('template-part/single-property'); ?>
			<?php get_template_part('template-part/single-property'); ?>
			<?php get_template_part('template-part/single-property'); ?>
		</div>
		<div class="properties-map">

		</div>
	</div>
	<?php
			  } else { ?>
	<div class="properties-list">
		<?php get_template_part('template-part/single-property-two'); ?>
		<?php get_template_part('template-part/single-property'); ?>
		<?php get_template_part('template-part/single-property'); ?>
		<?php get_template_part('template-part/single-property'); ?>
		<?php get_template_part('template-part/single-property'); ?>
		<?php get_template_part('template-part/single-property'); ?>
	</div>
	<?php
					 }

	?>

	<div class="view-more">
		<a class="btn view-more properties" href="#">View More
			<div class="icon"><svg width="8" height="16" viewBox="0 0 8 16" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M4.5 0.941406C4.5 0.665264 4.27614 0.441406 4 0.441406C3.72386 0.441406 3.5 0.665264 3.5 0.941406L4.5 0.941406ZM3.64645 15.4126C3.84171 15.6079 4.15829 15.6079 4.35355 15.4126L7.53553 12.2306C7.7308 12.0354 7.7308 11.7188 7.53553 11.5235C7.34027 11.3283 7.02369 11.3283 6.82843 11.5235L4 14.3519L1.17157 11.5235C0.97631 11.3283 0.659728 11.3283 0.464466 11.5235C0.269203 11.7188 0.269203 12.0354 0.464466 12.2306L3.64645 15.4126ZM3.5 0.941406L3.5 15.0591L4.5 15.0591L4.5 0.941406L3.5 0.941406Z" fill="#051B33" />
				</svg>
			</div>
		</a>
	</div>
</div>

<?php
	// echo "shortcode loaded";
	return ob_get_clean();
}
add_shortcode('elzan_guides_post', 'elzan_guides_post_callback');
function elzan_guides_post_callback()
{
	ob_start();

?>
<div class="elzan_guides_list_wrapper">
	<div class="guides-posts">
		<div class="guides-card" style="background-image: url('<?php echo get_stylesheet_directory_uri(); ?>/images/bank-loans.jpg');">
			<div class="guides-card-content">
				<h2 class="guides-title">Bank Loans</h2>
				<div class="read-more">
					<a href="#">Read More <div class="icon">
						<svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
							<circle cx="9.37405" cy="9.37405" r="9.37405" fill="#59C2FF" />
							<path d="M13.9904 10.0118C14.1857 9.81649 14.1857 9.49991 13.9904 9.30465L10.8084 6.12267C10.6132 5.92741 10.2966 5.92741 10.1013 6.12267C9.90607 6.31793 9.90607 6.63451 10.1013 6.82978L12.9298 9.6582L10.1013 12.4866C9.90607 12.6819 9.90607 12.9985 10.1013 13.1937C10.2966 13.389 10.6132 13.389 10.8084 13.1937L13.9904 10.0118ZM4.54688 10.1582L13.6369 10.1582L13.6369 9.1582L4.54687 9.1582L4.54688 10.1582Z" fill="white" />
						</svg>
						</div>
					</a>
				</div>
			</div>

		</div>
		<div class="guides-card" style="background-image: url('<?php echo get_stylesheet_directory_uri(); ?>/images/bank-loans.jpg');">
			<div class="guides-card-content">
				<h2 class="guides-title">Bank Loans</h2>
				<div class="read-more">
					<a href="#">Read More <div class="icon">
						<svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
							<circle cx="9.37405" cy="9.37405" r="9.37405" fill="#59C2FF" />
							<path d="M13.9904 10.0118C14.1857 9.81649 14.1857 9.49991 13.9904 9.30465L10.8084 6.12267C10.6132 5.92741 10.2966 5.92741 10.1013 6.12267C9.90607 6.31793 9.90607 6.63451 10.1013 6.82978L12.9298 9.6582L10.1013 12.4866C9.90607 12.6819 9.90607 12.9985 10.1013 13.1937C10.2966 13.389 10.6132 13.389 10.8084 13.1937L13.9904 10.0118ZM4.54688 10.1582L13.6369 10.1582L13.6369 9.1582L4.54687 9.1582L4.54688 10.1582Z" fill="white" />
						</svg>
						</div>
					</a>
				</div>
			</div>

		</div>
		<div class="guides-card" style="background-image: url('<?php echo get_stylesheet_directory_uri(); ?>/images/bank-loans.jpg');">
			<div class="guides-card-content">
				<h2 class="guides-title">Bank Loans</h2>
				<div class="read-more">
					<a href="#">Read More <div class="icon">
						<svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
							<circle cx="9.37405" cy="9.37405" r="9.37405" fill="#59C2FF" />
							<path d="M13.9904 10.0118C14.1857 9.81649 14.1857 9.49991 13.9904 9.30465L10.8084 6.12267C10.6132 5.92741 10.2966 5.92741 10.1013 6.12267C9.90607 6.31793 9.90607 6.63451 10.1013 6.82978L12.9298 9.6582L10.1013 12.4866C9.90607 12.6819 9.90607 12.9985 10.1013 13.1937C10.2966 13.389 10.6132 13.389 10.8084 13.1937L13.9904 10.0118ZM4.54688 10.1582L13.6369 10.1582L13.6369 9.1582L4.54687 9.1582L4.54688 10.1582Z" fill="white" />
						</svg>
						</div>
					</a>
				</div>
			</div>

		</div>
		<div class="guides-card" style="background-image: url('<?php echo get_stylesheet_directory_uri(); ?>/images/bank-loans.jpg');">
			<div class="guides-card-content">
				<h2 class="guides-title">Bank Loans</h2>
				<div class="read-more">
					<a href="#">Read More <div class="icon">
						<svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
							<circle cx="9.37405" cy="9.37405" r="9.37405" fill="#59C2FF" />
							<path d="M13.9904 10.0118C14.1857 9.81649 14.1857 9.49991 13.9904 9.30465L10.8084 6.12267C10.6132 5.92741 10.2966 5.92741 10.1013 6.12267C9.90607 6.31793 9.90607 6.63451 10.1013 6.82978L12.9298 9.6582L10.1013 12.4866C9.90607 12.6819 9.90607 12.9985 10.1013 13.1937C10.2966 13.389 10.6132 13.389 10.8084 13.1937L13.9904 10.0118ZM4.54688 10.1582L13.6369 10.1582L13.6369 9.1582L4.54687 9.1582L4.54688 10.1582Z" fill="white" />
						</svg>
						</div>
					</a>
				</div>
			</div>

		</div>
		<div class="guides-card" style="background-image: url('<?php echo get_stylesheet_directory_uri(); ?>/images/bank-loans.jpg');">
			<div class="guides-card-content">
				<h2 class="guides-title">Bank Loans</h2>
				<div class="read-more">
					<a href="#">Read More <div class="icon">
						<svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
							<circle cx="9.37405" cy="9.37405" r="9.37405" fill="#59C2FF" />
							<path d="M13.9904 10.0118C14.1857 9.81649 14.1857 9.49991 13.9904 9.30465L10.8084 6.12267C10.6132 5.92741 10.2966 5.92741 10.1013 6.12267C9.90607 6.31793 9.90607 6.63451 10.1013 6.82978L12.9298 9.6582L10.1013 12.4866C9.90607 12.6819 9.90607 12.9985 10.1013 13.1937C10.2966 13.389 10.6132 13.389 10.8084 13.1937L13.9904 10.0118ZM4.54688 10.1582L13.6369 10.1582L13.6369 9.1582L4.54687 9.1582L4.54688 10.1582Z" fill="white" />
						</svg>
						</div>
					</a>
				</div>
			</div>

		</div>
		<div class="guides-card" style="background-image: url('<?php echo get_stylesheet_directory_uri(); ?>/images/bank-loans.jpg');">
			<div class="guides-card-content">
				<h2 class="guides-title">Bank Loans</h2>
				<div class="read-more">
					<a href="#">Read More <div class="icon">
						<svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
							<circle cx="9.37405" cy="9.37405" r="9.37405" fill="#59C2FF" />
							<path d="M13.9904 10.0118C14.1857 9.81649 14.1857 9.49991 13.9904 9.30465L10.8084 6.12267C10.6132 5.92741 10.2966 5.92741 10.1013 6.12267C9.90607 6.31793 9.90607 6.63451 10.1013 6.82978L12.9298 9.6582L10.1013 12.4866C9.90607 12.6819 9.90607 12.9985 10.1013 13.1937C10.2966 13.389 10.6132 13.389 10.8084 13.1937L13.9904 10.0118ZM4.54688 10.1582L13.6369 10.1582L13.6369 9.1582L4.54687 9.1582L4.54688 10.1582Z" fill="white" />
						</svg>
						</div>
					</a>
				</div>
			</div>

		</div>
		<div class="guides-card" style="background-image: url('<?php echo get_stylesheet_directory_uri(); ?>/images/bank-loans.jpg');">
			<div class="guides-card-content">
				<h2 class="guides-title">Bank Loans</h2>
				<div class="read-more">
					<a href="#">Read More <div class="icon">
						<svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
							<circle cx="9.37405" cy="9.37405" r="9.37405" fill="#59C2FF" />
							<path d="M13.9904 10.0118C14.1857 9.81649 14.1857 9.49991 13.9904 9.30465L10.8084 6.12267C10.6132 5.92741 10.2966 5.92741 10.1013 6.12267C9.90607 6.31793 9.90607 6.63451 10.1013 6.82978L12.9298 9.6582L10.1013 12.4866C9.90607 12.6819 9.90607 12.9985 10.1013 13.1937C10.2966 13.389 10.6132 13.389 10.8084 13.1937L13.9904 10.0118ZM4.54688 10.1582L13.6369 10.1582L13.6369 9.1582L4.54687 9.1582L4.54688 10.1582Z" fill="white" />
						</svg>
						</div>
					</a>
				</div>
			</div>
		</div>
	</div>
</div>

<?php
	// echo "shortcode loaded for guides";
	return ob_get_clean();
}
