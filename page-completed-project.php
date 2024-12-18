<?php

/* Template Name: Elzan Completed Projects */

get_header(); ?>

<div class="wpb_row vc_row-fluid px-elzan py-news completed-projects">
    <!-- <div class="wpb_column column_container">
        <div class="news-breadcrumb breadcrumb">
            <p><a href="/">
                    < Back</a>
            </p>
        </div>
    </div> -->
    <div class="wpb_column column_container">
        <div class="page-title">
            <h1 class="title">ORAZIO COURT</h1>
        </div>
        <div class="project-features-img-wrapper">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/orazio-cour.jpg" alt="orazio-cour">
        </div>
        <div class="project-about-details">
            <div class="about-content">
                <div class="about-section">
                    <h2>About</h2>
                    <div class="details">
                        <div class="details-item">
                            <span class="location">Location</span>
                            <span class="value">Għajnsielem, Gozo</span>
                        </div>
                        <div class="details-item">
                            <span class="typlogy">Typlogy</span>
                            <span class="value">Apartment Block</span>
                        </div>
                        <div class="details-item">
                            <span class="status">Status</span>
                            <span class="value">Completed 2023</span>
                        </div>
                    </div>
                </div>
                <div class="content-section">
                    <p>Odio pellentesque diam volutpat commodo. Ut venenatis tellus in metus. Maecenas pharetra convallis posuere morbi leo. Tortor at auctor urna nunc. Dolor morbi non arcu risus quis varius quam.

                        It is a paradisematic country, in which roasted parts of sentences fly into your mouth. Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic life One day however a small line of blind text by the name of Lorem Ipsum decided to leave for the far World of Grammar.

                        Sed id semper risus in hendrerit gravida rutrum. Iaculis at erat pellentesque adipiscing commodo elit at imperdiet. Enim sed faucibus turpis in eu mi. Pellentesque pulvinar pellentesque habitant morbi tristique senectus et netus. Duis tristique sollicitudin nibh sit amet commodo. Eget velit aliquet sagittis id. Quisque non tellus orci ac auctor. Facilisis sed odio morbi quis commodo odio aenean sed adipiscing. At urna condimentum mattis pellentesque id nibh tortor id. Interdum velit euismod in pellentesque massa placerat duis ultricies lacus. Quam viverra orci sagittis eu volutpat odio facilisis mauris. Condimentum lacinia quis vel eros donec ac odio. Leo vel fringilla est ullamcorper eget nulla facilisi etiam dignissim</p>
                </div>
            </div>
            <div class="images-section">
                <div class="small-images">
                    <img class="image image-one" src="<?php echo get_stylesheet_directory_uri(); ?>/images/orazio-cour.jpg" alt="Small Image 1">
                    <img class="image image-two" src="<?php echo get_stylesheet_directory_uri(); ?>/images/orazio-cour.jpg" alt="Small Image 2">
                </div>
                <div class="large-image">
                    <img class="image image-large" src="<?php echo get_stylesheet_directory_uri(); ?>/images/orazio-cour.jpg" alt="Large Image">
                </div>
            </div>
        </div>
    </div>
</div>
<div class="wpb_column column_container completed-projects">
    <div class="features-banner">
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/orazio-cour.jpg" alt="">
    </div>
</div>
<div class="wpb_row vc_row-fluid px-elzan">
    <div class="wpb_column column_container">
        <div class="other-completed-project">
            <div class="section-title">
                <h4>Other Completed Projects</h4>
            </div>
            <div class="other-completed-project-grid">
                <?php get_template_part("template-part/projects", null, array("id" => "2")); ?>
                <?php get_template_part("template-part/projects", null, array("id" => "2")); ?>
                <?php get_template_part("template-part/projects", null, array("id" => "2")); ?>
            </div>
        </div>
    </div>
    <div class="wpb_column column_container av-prop py-elzan">
        <?php get_template_part("template-part/available-properties", null, array("id" => "1")) ?>
    </div>
</div>

<?php

the_content();
get_footer();
