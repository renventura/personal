(function($) {

	/**
	 * Handles the sticky header
	 */


	var	header = $(".header-elements-wrap"),
		clone = header.clone(),
		didScroll,
		offset = header.outerHeight() + 50,
		previousScroll = 0,
		senseSpeed = 30;

	// Bail if sticky header is not enabled
	if ( header.data('sticky-header') !== 'enabled' ) {
		return;
	}

	// Add class to cloned header
	clone.addClass('header-clone');

	// Insert cloned header after original
	header.after(clone);

	// Set time interval to reduce payload
	setInterval(function() {
		if ( didScroll ) {
			hasScrolled();
			didScroll = false;
		}
	}, 250);

	// User scrolled
	$(window).scroll(function() {
		didScroll = true;
	});

	function hasScrolled() {

		// Get distance from top
		var scroller = $(this).scrollTop();

		// Outside offset
		if ( Math.abs( scroller ) > offset ) {

			if ( scroller - senseSpeed > previousScroll ) {

				// Scrolling down
				if ( clone.hasClass('stuck') ) {
					clone.removeClass('stuck');
				}

			} else if ( scroller + senseSpeed <= previousScroll ) {

				// Scrolling up
				clone.addClass('stuck');
			}

		} else {

			// Within the offset
			if ( clone.hasClass('stuck') ) {
				clone.removeClass('stuck');
			}
		}

		// Set last scroll position
		previousScroll = scroller;
	}



	/**
	 * Handles toggling the navigation menu
	 */


	// Get supported menus that are in use
	var menus = {
			main_nav: $('#primary-menu').clone()
		},
		offcanvas = $('#offcanvas'),
		open_menu = $('.open-offcanvas'),
		close_menu = $('#close-offcanvas');

	// Loop through each menu and add it to mobile menu
	$.each(menus,function(index, el) {
		el.removeClass();
		offcanvas.append(el);
	});


	// Open offcanvas
	open_menu.click(function() {
		offcanvas.addClass('toggled');
		offcanvas.attr('aria-expanded', 'true');
		open_menu.attr('aria-expanded', 'true');
	});

	// Close offcanvas
	close_menu.click(function() {
		offcanvas.removeClass('toggled');
		offcanvas.attr('aria-expanded', 'false');
		open_menu.attr('aria-expanded', 'false');
	});

})(jQuery);