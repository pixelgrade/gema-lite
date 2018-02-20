Logo = function() {

	this.$header = $( '.header' );
	this.$logo = $( '.site-branding' );
	this.$clone = null;
	this.distance = null;
	this.initialized = false;

};

Logo.prototype.adjustSiteTitle = function() {

	$( '.site-title' ).each( function( i, obj ) {
		var $title = $( obj ).removeAttr( 'style' ).css( 'fontSize', '' ),
			$branding = $title.closest( '.site-branding' ),
			$span = $title.find( 'span' ),
			titleWidth = $title.width(),
			brandingHeight,
			spanWidth = $span.width(),
			fontSize = parseInt( $title.css( 'fontSize', '' ).css( 'fontSize' ) ),
			scaling = spanWidth / parseFloat( titleWidth ),
			maxLines = $body.is( '.singular' ) ? 3 : 2;

		/* if site title is too long use a smaller font size */
		if ( spanWidth > titleWidth ) {
			fontSize = parseInt( fontSize / scaling );
			$title.css( 'fontSize', fontSize );
		}

		var titleHeight = $title.outerHeight();

		if ( $title.closest( '.mobile-logo' ).length ) {
			var mobileHeight = $( '.mobile-logo' ).outerHeight();
			fontSize = parseInt( fontSize * mobileHeight / titleHeight );
			if ( mobileHeight < titleHeight ) {
				$title.css( 'fontSize', fontSize );
			}
			return;
		}

		brandingHeight = $branding.outerHeight();

		/* if site title is too long use a smaller font size */
		if ( brandingHeight < titleHeight ) {
			fontSize = parseInt( fontSize * brandingHeight / titleHeight );
			$title.css( 'fontSize', fontSize );
			return;
		}

		/* if site title is too tall, again, use a smaller font size */
		var lineHeight = parseFloat( $title.css( 'lineHeight' ) ) / fontSize,
			lines = Math.round( titleHeight / fontSize / lineHeight );

		while ( lines > maxLines ) {
			fontSize = fontSize - 1;
			$title.css( 'fontSize', fontSize );
			titleHeight = $title.outerHeight();
			lines = titleHeight / fontSize / lineHeight;
		}
	} );
};

Logo.prototype.adjustArchiveTitle = function() {

	$( '.archive-title' ).each( function( i, obj ) {
		var $title = $( obj ).removeAttr( 'style' ).css( 'fontSize', '' ),
			fontSize = parseInt( $title.css( 'font-size' ) ),
			$span = $title.find( 'span' ),
			titleWidth = $title.width(),
			spanWidth = $span.width(),
			scaling = spanWidth / parseFloat( titleWidth );

		/* if site title is too long use a smaller font size */
		if ( spanWidth > titleWidth ) {
			fontSize = parseInt( fontSize / scaling );
			$title.css( 'fontSize', fontSize );
		}
	} );

};

Logo.prototype.prepare = function( scrollY ) {

	var that = this;

	scrollY = scrollY || (window.pageYOffset || document.documentElement.scrollTop) - (document.documentElement.clientTop || 0);

	if ( that.$logo.length ) {

		that.$logo.imagesLoaded(function() {

			if ( that.$clone === null ) {
				that.$clone = that.$logo.clone().appendTo( '.mobile-logo' );
			} else {
				that.$clone.removeAttr( 'style' );
			}

			that.logoMid = that.$logo.offset().top + that.$logo.height() / 2;
			that.cloneMid = that.$clone.offset().top + that.$clone.height() / 2 - scrollY;
			that.distance = that.logoMid - that.cloneMid;

			that.initialized = true;

			that.update( scrollY );

			that.$clone.css( 'opacity', 1 );

		});
	}
};

Logo.prototype.update = function( scrollY ) {

	if ( ! this.initialized ) {
		return;
	}

	if ( this.distance < scrollY ) {
		this.$clone.css( 'transform', 'none' );
		return;
	}

	this.$clone.css( 'transform', 'translateY(' + ( this.distance - scrollY ) + 'px)' );
};
