var HandleSubmenusOnTouch = (function() {

	var $theUsualSuspects,
		$theUsualAnchors,
		initialInit = false;

	function init() {
		if( initialInit || !isTouchDevice ) return;

		$theUsualSuspects = $('li[class*=children]').removeClass('hover');
		$theUsualAnchors = $theUsualSuspects.find('> a');

		unbind();

		$theUsualAnchors.on('click', function (e) {
			e.preventDefault();
			e.stopPropagation();

			if( $(this).hasClass('active') ) {
				window.location.href = $(this).attr('href');
			}

			$theUsualAnchors.removeClass('active');
			$(this).addClass('active');

			// When a parent menu item is activated,
			// close other menu items on the same level
			$(this).parent().siblings().removeClass('hover');

			// Open the sub menu of this parent item
			$(this).parent().addClass('hover');
		});

		bindOuterNavClick();

		initialInit = true;
	}

	function unbind() {
		$theUsualAnchors.unbind();
		isHorizontalInitiated = false;
	}

	// When a sub menu is open, close it by a touch on
	// any other part of the viewport than navigation.
	// use case: normal, horizontal menu, touch events,
	// sub menus are not visible.
	function bindOuterNavClick() {
		$body.on('touchstart', function (e) {
			var container = $('.main-navigation');

			if (!container.is(e.target) // if the target of the click isn't the container...
					&& container.has(e.target).length === 0) // ... nor a descendant of the container
			{
				$theUsualSuspects.removeClass('hover').removeClass('active');
			}
		});
	}

	return {
		init: init
	}
}());

function checkForSmallImageOnSingle() {
	if ( ! $body.hasClass( 'singular' ) || $body.hasClass( 'no-featured-image' ) ) {
		return;
	}

	if ( windowWidth > 900 ) {
		if ( $( '.entry-featured img' ).width() < 500 ) {
			$body.addClass( 'has--small-featured-image' );
			$( '.post__content' ).css( 'paddingTop', $( '.entry-featured' ).height() + 30 );
		}
	} else {
		$( '.post__content' ).removeAttr( 'style' );
	}
}
