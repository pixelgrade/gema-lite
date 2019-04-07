var Grid = function() {

};

Grid.prototype.refresh = function() {
	this.alignTitles();
	this.addMargins();
	this.adjustCardMeta();
	this.offsetFirstColumn();
};

Grid.prototype.alignTitles = function() {

	$( '.card-title-wrap' ).each( function( i, obj ) {
		var $title = $( obj );
		$title.closest( '.card__wrap' ).css( 'paddingBottom', $title.outerHeight() * 0.5 );
	} );

};

Grid.prototype.addMargins = function() {

	var $columns = $( '.column' ),
		$compare;

	$( '.grid__item--mb' ).removeClass( 'grid__item--mb' );

	$columns.each( function( i, column ) {
		var $column = $( column );

		if ( i % 2 == 1 ) {

			$column.children( '.entry-card--portrait, .entry-card--text' ).each( function( j, obj ) {
				var $obj = $( obj );

				if ( $obj.is( ':nth-child(2n+1)' ) ) {
					$compare = $columns.eq( i - 1 );
				} else {
					$compare = $columns.eq( i + 1 );
				}

				if ( typeof $compare == "undefined" ) {
					return;
				}

				var bottom = $obj.offset().top + $obj.outerHeight(),
					$neighbour;

				$compare.children().each( function( j, item ) {
					var $item = $( item ),
						thisBottom = $( item ).offset().top + $( item ).outerHeight();

					if ( thisBottom < bottom ) {
						$neighbour = $item;
					} else {
						return false;
					}
				} );

				if ( typeof $neighbour !== "undefined" ) {
					$neighbour.addClass( 'grid__item--mb' );
				}
			} );
		}
	} );
};

Grid.prototype.showCards = function( $cards ) {

	$cards.each( function( i, obj ) {
		var $obj = $( obj );

		setTimeout( function() {
			$obj.addClass( 'is-visible' );
		}, i * 150 );

		setTimeout( function() {
			$obj.removeClass( 'ajax-loaded' );
		}, 400 + i * 150 );

		$obj.imagesLoaded( function() {

			var $img = $( '<img>' ),
				$thumbnail = $obj.find( '.card__image--large' );

			$img.attr( 'src', $thumbnail.data( 'src' ) );

			$img.imagesLoaded( function() {
				$obj.addClass( 'is-loaded' );
			} );

			$thumbnail.replaceWith( $img );
		} );
	} );

};

Grid.prototype.adjustCardMeta = function() {

	if ( $body.is( '.singular' ) || windowWidth < 480 ) {
		$( '.card__meta' ).attr( 'style', '' );
	} else {
		$( '.card--image' ).each( function( i, obj ) {
			var $cardMeta = $( obj ).find( '.card__meta' );
			$cardMeta.css( 'marginTop', - 1 * $cardMeta.height() );
		} );
	}

};

Grid.prototype.offsetFirstColumn = function() {
	var $columns = $( '.bricklayer-column' );
	if ( $columns.length > 1 ) {
		var height = $( '.header .site-branding' ).outerHeight();
		$columns.css( 'marginTop', '' ).eq( 1 ).css( 'marginTop', height );
	}
};
