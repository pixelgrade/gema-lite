var Gema = new pixelgradeTheme(),
	log = Gema.log,
	resizeEvent = 'ontouchstart' in window && 'onorientationchange' in window ? 'pxg:orientationchange' : 'pxg:resize',
	$html = $( 'html' ),
	$body = $( 'body' );

window.bricklayer = null;

Gema.init = function() {
	$body.toggleClass( 'is--webkit', isWekbit );
	$body.toggleClass( 'is--ie', isIE );
	$body.toggleClass( 'is--ie-le10', isiele10 );

	Gema.Grid = new Grid();
	Gema.Logo = new Logo();

	checkForSmallImageOnSingle();

	HandleSubmenusOnTouch.init();

	$( 'ul.nav-menu' ).ariaNavigation();

	$( '.grid, .site-header' ).css( 'opacity', 1 );

	if ( $body.is( '.singular' ) ) {
		prepareSingle();
	} else {
		prepareArchive();
	}

	Gema.adjustLayout();
};

Gema.onPostLoad = function( event, data ) {
	var $elements = $( data.html ).filter( '.grid__item' ).addClass( 'ajax-loaded' ).each( function( i, obj ) {
		if ( $.fn.mediaelementplayer ) {
			$( obj ).find( 'audio, video' ).mediaelementplayer();
		}
	});

	$( '.infinite-loader' ).remove();

	if ( $( '.grid' ).length && bricklayer !== null ) {
		bricklayer.append( $.makeArray( $elements ) );
	}

	// Clean up the duplicate posts that are appended
	// by default by Jetpack's Infinite Scroll to div#main
	// (and also the corresponding HTML comments)
	$( '#main' ).contents().each( function() {
		if ( $( this ).is( 'article' ) || this.nodeType === Node.COMMENT_NODE ) {
			$( this ).remove();
		}
	} );

	Gema.adjustLayout();

	Gema.Grid.showCards( $elements );
};

Gema.bindEvents = function() {

	$( window ).on( resizeEvent, Gema.adjustLayout );
	$( window ).on( 'load', Gema.adjustLayout );
	$( document.body ).on( 'post-load', Gema.onPostLoad );

	Gema.ev.on( 'render', Gema.update );

	$( '.overlay-toggle' ).on( 'touchstart click', toggleOverlay );
	$( '.menu-toggle' ).on( 'touchstart click', toggleNav );
	$( '.sidebar-toggle' ).on( 'touchstart click', toggleSidebar );

}

function toggleOverlay( e ) {
	e.preventDefault();
	e.stopPropagation();

	$body.toggleClass( 'overlay-is-open' );

	if ( $body.hasClass( 'overlay-is-open' ) ) {
		$body.width( $body.width() );
		$body.css( 'overflow', 'hidden' );
	} else {
		$body.css( 'overflow', '' );
	}
}

function toggleNav( e ) {
	e.preventDefault();
	e.stopPropagation();

	if ( $body.hasClass( 'nav-is-open' ) ) {
		// closing the menu
		$( '.menu-toggle' ).attr( 'aria-expanded', 'false' );
	} else {
		// opening the menu
		$( '.menu-toggle' ).attr( 'aria-expanded', 'true' );
	}

	$body.toggleClass( 'nav-is-open' );
}

function toggleSidebar( e ) {
	e.preventDefault();
	e.stopPropagation();

	if ( $body.hasClass( 'sidebar-is-open' ) ) {
		//closing the sidebar
		$( '.sidebar-toggle' ).attr( 'aria-expanded', 'false' );
	} else {
		// opening the sidebar
		$( '.sidebar-toggle' ).attr( 'aria-expanded', 'true' );
	}

	$body.toggleClass( 'sidebar-is-open' );
}

function prepareArchive() {

	var $cards = $( '.card' );

	if ( $( '.grid' ).length && bricklayer === null ) {
		bricklayer = new Bricklayer( document.querySelector( '.grid' ) );
		bricklayer.redraw();
	}

	Gema.Grid.showCards( $cards );

	$body.css( 'opacity', 1 );
}

function prepareSingle() {

	var $mobileHeader = $( '.mobile-header-wrapper' ),
		scrollTo;

	if ( $mobileHeader.is( ':visible' ) ) {
		scrollTo = $( '.content-area' ).offset().top - $mobileHeader.outerHeight();
		setTimeout( function() {
			window.scrollTo( 0, scrollTo );
			$body.css( 'opacity', 1 );
		} );
	} else {
		$body.css( 'opacity', 1 );
	}
}

Gema.hidePanels = function() {
	$body.removeClass( 'nav-is-open' )
	     .removeClass( 'sidebar-is-open' )
	     .removeClass( 'overlay-is-open' )
	     .css( 'width', '' )
	     .css( 'overflow', '' );
};

Gema.update = function() {
	if ( typeof Gema.Logo !== "undefined" ) {
		Gema.Logo.update( Gema.getScroll() );
	}
};

Gema.adjustLayout = function() {

	if ( Gema.getWindowWidth() > 900 ) {
		Gema.hidePanels();
	}

	// Single
	checkForSmallImageOnSingle();
	Gema.placeSidebar();

	// Archive
	Gema.Logo.adjustSiteTitle();
	Gema.Logo.adjustArchiveTitle();
	Gema.Logo.prepare();

	Gema.Grid.offsetFirstColumn();
	Gema.Grid.adjustCardMeta();
	Gema.Grid.alignTitles();
	Gema.Grid.addMargins();
};

Gema.placeSidebar = function() {

	if ( ! $body.hasClass( 'has-active-sidebar' ) ) {
		return;
	}

	var $sidebar = $( '.widget-area' ),
		$content = $( '.content-area' );

	if ( Gema.getWindowWidth() > 900 ) {

		if ( ! $sidebar.length ) {
			return;
		}

		if ( $body.hasClass( 'no-featured-image' ) ) {
			$sidebar.addClass( 'is--placed' ).css( 'top', $( '.site-main' ).css( 'padding-top' ) );
		} else {
			// If we are past the breakpoint
			var $featuredImage = $( '.entry-featured' ),
				featuredImageBottom = $featuredImage.height() + parseInt( $( '.post__content' ).css( 'margin-top' ), 10 );

			// position: absolute; on the sidebar(via ".is--placed")
			// below the featured image;
			if ( ! $body.hasClass( 'has--small-featured-image' ) ) {
				$sidebar.addClass( 'is--placed' ).css( 'top', featuredImageBottom );
			} else {
				$sidebar.addClass( 'is--placed' ).css( 'top', 108 );
			}
		}

		// and set a height on the content so that everything seems in place.
		$content.css( "minHeight", $sidebar.offset().top + $sidebar.height() );
	} else {
		// Remove the height (possibly) set above.
		$content.removeAttr( 'style' );
		$sidebar.css( 'top', '' );
	}
};

$.Gema = Gema;
$.Gema.init();
Gema.bindEvents();
