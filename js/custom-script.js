var $ = jQuery.noConflict();
jQuery(document).ready(function () {
	// Comman functions for range slider for price is started
	function formatWithCommas(value) {
		return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
	}

	function parseRawValue(value) {
		const parsedValue = value.replace(/,/g, ""); // Remove commas
		return parsedValue;
	}
	// Comman functions for range slider for price is done
	// Range slider functionality started for the desktop version
	var $range = jQuery(".range");
	var $inputFrom = jQuery("#min");
	var $inputTo = jQuery("#max");
	var min = 0,
		max = 2000000,
		from = 0,
		to = 2000000;

	$range.ionRangeSlider({
		skin: "round",
		type: "double",
		min: min,
		max: max,
		from: from,
		to: to,
		step: 50000,
		onStart: updateInputs,
		onChange: updateInputs,
		onFinish: updateInputs,
	});
	var instance = $range.data("ionRangeSlider");

	function updateInputs(data) {
		from = data.from;
		to = data.to;
		$inputFrom.val(formatWithCommas(from));
		$inputTo.val(formatWithCommas(to));
		jQuery('input[name="min_price"]').val(from);
		jQuery('input[name="max_price"]').val(to);
	}

	$inputFrom.on("input", function (e) {
		e.stopPropagation();
		var rawValue = parseRawValue($(this).val());
		var val = parseInt(rawValue, 10);

		if (isNaN(val)) val = min;
		if (val < min) val = min;
		else if (val > to) val = to;

		instance.update({ from: val });
		jQuery(this).val(formatWithCommas(val));
		jQuery('input[name="min_price"]').val(val);
	});

	$inputTo.on("input", function (e) {
		e.stopPropagation(); // Prevent Range Slider from Interfering
		var rawValue = parseRawValue($(this).val());
		var val = parseInt(rawValue, 10);
		if (isNaN(val)) val = max;
		if (val > max) val = max;
		else if (val < from) val = from;
		instance.update({ to: val });

		jQuery(this).val(formatWithCommas(val));
		jQuery('input[name="max_price"]').val(val);
	});
	// Range slider functionality done for the desktop version

	/*BACK TO TOP*/
	$(".footer-back-to-top").click(function () {
		$("html, body").animate({ scrollTop: 0 }, "slow");
	});
	/*back to top finish*/

	if (window.matchMedia("(max-width: 768px)").matches) {
		$(".widget_nav_menu ul.menu").hide();

		$(".widget_nav_menu h2.widgettitle").on("click", function () {
			$(".widget_nav_menu h2.widgettitle").removeClass("open");
			$(".widget_nav_menu ul.menu").hide();
			$(this).closest(".widget_nav_menu").find("ul.menu").show();
			$(this).addClass("open");
		});
	}

	console.log("custom script load");

	$(".toggle_heading").click(function () {
		$(this).toggleClass("active");
		$(this).next(".slide_open").stop("true", "true").slideToggle("slow");
	});
	$(".slider-for").slick({
		slidesToShow: 1,
		slidesToScroll: 1,
		arrows: false,
		fade: true,
		asNavFor: ".slider_nav",
	});
	$(".slider_nav").slick({
		slidesToShow: 5,
		slidesToScroll: 1,
		asNavFor: ".slider-for",
		dots: false,
		centerMode: true,
		focusOnSelect: true,
		centerPadding: "0px",
	});

	$(".elzan_testimoanils").slick({
		dots: false,
		infinite: false,
		speed: 300,
		slidesToShow: 1,
		slidesToScroll: 1,
		arrows: true,
		prevArrow:
		'<button type="button" class="slick-prev"><img src="/wp-content/themes/salient-child/images/prev-arrow.png" alt="Previous"></button>',
		nextArrow:
		'<button type="button" class="slick-next"><img src="/wp-content/themes/salient-child/images/next-arrow.png" alt="Next"></button>',
	});

	

	// Drag-to-Scroll functionality
	const container = document.querySelector(".thumbnail-container");
	let isDown = false;
	let startX, scrollLeft;

	// Prevent text or image selection during dragging
	container.style.userSelect = "none"; // CSS equivalent

	container.addEventListener("mousedown", (e) => {
		e.preventDefault(); // Prevent default actions like image selection
		isDown = true;
		startX = e.pageX - container.offsetLeft;
		scrollLeft = container.scrollLeft;
		container.style.cursor = "grabbing"; // Change cursor while dragging
	});

	container.addEventListener("mouseleave", () => {
		isDown = false;
		container.style.cursor = "grab";
	});

	container.addEventListener("mouseup", () => {
		isDown = false;
		container.style.cursor = "grab";
	});

	container.addEventListener("mousemove", (e) => {
		if (!isDown) return;
		e.preventDefault();
		const x = e.pageX - container.offsetLeft;
		const walk = (x - startX) * 2; // Adjust the scroll speed
		container.scrollLeft = scrollLeft - walk;
	});

	// Prevent images inside the container from being selected
	container.querySelectorAll("img").forEach((img) => {
		img.addEventListener("dragstart", (e) => e.preventDefault()); // Prevent dragging the image
	});

	// Default functionality for the first thumbnail
	const defaultThumbnail = $(".thumbnail").first();
	$("#mainImage").attr("src", defaultThumbnail.data("large"));
	defaultThumbnail.addClass("active");

	// Click to change the main image
	$(".thumbnail").on("click", function () {
		const newSrc = $(this).data("large");
		$("#mainImage").attr("src", newSrc);
		$(".thumbnail").removeClass("active");
		$(this).addClass("active");
	});

	// code for the accordian on property page
	$(".accordion-header").click(function () {
		$(this).next(".accordion-content").slideToggle();
		$(".accordion-content").not($(this).next()).slideUp();
	});

	// code for show more and show less button on property page
	$(".toggle-btn").click(function () {
		const section = $(".availability-section");
		const button = $(this);

		if (section.height() === 190) {
			section.animate({ height: section.get(0).scrollHeight }, 300);
			button.text("Show Less");
			button.css("color", "#000");
		} else {
			section.animate({ height: "190px" }, 300);
			button.text("Show More");
		}
	});
	/*jquery last line*/





	//location filter code starts here
	const locations = [
        "Sliema", "Valletta", "San Gwann", "Birkirkara", "Mellieha", "St. Julian's", "Zebbug", "Marsaxlokk", "Birzebbuga", "Gozo",
        "Rabat", "Mdina", "Attard", "Bugibba", "Qawra", "Naxxar", "Paola", "Zabbar", "Siggiewi", "Ghajnsielem",
        "Fgura", "Hamrun", "Kalkara", "Mosta", "Msida", "Gzira", "Balzan", "Floriana", "Tarxien", "Safi"
      ];

      const $input = $("#locationInput");
      const $dropdown = $("#locationDropdown");
      const $selectedContainer = $(".selected-locations-container");

      $input.on("input", function () {
        const query = $input.val().toLowerCase();
        $dropdown.empty();
        if (query.length >= 2) {
          const filteredLocations = locations.filter(location => location.toLowerCase().includes(query));
          if (filteredLocations.length) {
            filteredLocations.forEach(location => {
              const $item = $(`<div class="location-dropdown-item">${location}</div>`);
              $dropdown.append($item);
            });
            $dropdown.show();
          } else {
            $dropdown.hide();
          }
        } else {
          $dropdown.hide();
        }
      });

      $dropdown.on("click", ".location-dropdown-item", function () {
        const location = $(this).text();
        const $selected = $(`
          <div class="selected-locations">
            ${location}
            <span class="remove">&times;</span>
          </div>
        `);
        $selectedContainer.append($selected);
        $input.val("").focus();
        $dropdown.hide();
      });

      $selectedContainer.on("click", ".remove", function () {
        $(this).parent().remove();
      });

      $(document).on("click", function (e) {
        if (!$(e.target).closest(".location-filter").length) {
          $dropdown.hide();
        }
      });


});
