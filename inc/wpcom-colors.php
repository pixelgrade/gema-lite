<?php
/* Custom Colors: Gema */

//Background
add_color_rule( 'bg', '#ffffff', array(
	array( 'body,
		input,
		select,
		textarea,
		.mobile-header-wrapper,
		.nav-menu > li > a:before,
		.nav-menu ul,
		.main-navigation,
		.card--text .card__meta,
		.card--text .card__wrap,
		.sticky.card--text .card__wrap:before,
		.card__title,
		.card__image,
		.comment__avatar,
		.bypostauthor > .comment__article .comment__avatar,
		.content-quote:before,
		.widget-area,
		.widget,
		.jetpack_subscription_widget.widget:before,
		.widget_blog_subscription.widget:before,
		.singular .entry-header,
		.attachment .entry-header,
		.sticky,
		input[type="submit"],
		.btn,
		.search-submit,
		div#infinite-handle span button,
		div#infinite-handle span button:hover,
		body.singular .nav-menu > li > a:before', 'background-color' ),

	// Color
	array( 'input[type="submit"],
		.btn,
		.search-submit,
		div#infinite-handle span button,
		div#infinite-handle span button:hover,
		.nav-menu ul li:hover > a,
		.nav-menu ul li.hover > a,
		.nav-menu ul li:hover:after,
		.nav-menu ul li.hover:after,
		.sticky.card--text .card__wrap,
		.sticky.card--text .cat-links,
		.sticky.card--text .byline .author,
		.sticky.card--text .post-edit-link,
		.sticky.card--text .card__wrap:after,
		.sticky.card--text .card__meta,
		.sticky.card--text .byline,
		.sticky.card--text .byline + .posted-on,
		.jetpack_subscription_widget .widget__title,
		.widget_blog_subscription .widget__title,
		.jetpack_subscription_widget input[type="submit"],
		.widget_blog_subscription input[type="submit"],
		.jetpack_subscription_widget.widget,
		.widget_blog_subscription.widget', 'color' ),

	array( '.more-link', 'color', 'txt' ),

	// Border
	array( '.nav-menu:before,
		.sticky.card--text .btn,
		.sticky.card--text .search-submit,
		.sticky.card--text span button,
		.sticky.card--text .more-link,
		.sticky.format-quote .content-quote:after,
		.jetpack_subscription_widget #subscribe-email input,
		.jetpack_subscription_widget input[name="email"],
		.widget_blog_subscription #subscribe-email input,
		.widget_blog_subscription input[name="email"],
		.jetpack_subscription_widget input[type="submit"],
		.widget_blog_subscription input[type="submit"]', 'border-color' ),
), __('Background') );

// Text
add_color_rule( 'txt', '#000000', array(
	// Color contrasts against bg - more contrast
	array( 'body,
		.byline,
		input,
		select,
		textarea,
		.site-branding a,
		.entry-content a:hover,
		.entry-content a:focus,
		.comment__content a:hover,
		.comment__content a:focus,
		.entry-meta .cat-links,
		.byline,
		.entry-meta .byline .author,
		.main-navigation li.hover > a,
		.byline + .posted-on,
		.post-edit-link,
		.comment-respond:not(.js) .comment-form input[type="text"],
		.comment-respond:not(.js) .comment-form input[type="email"],
		.comment-respond:not(.js) .comment-form input[type="url"],
		.comment-respond:not(.js) .comment-form textarea,
		.nav-links a:hover,
		.archive-navigation span.page-numbers.current,
		.archive-navigation a:hover,
		.widget_recent_comments .recentcommentstextend a,
		.widget_recent_comments .recentcommentstextend,
		.widget_flickr table#flickr_badge_wrapper a:last-of-type,
		div#jp-relatedposts div.jp-relatedposts-items .jp-relatedposts-post .jp-relatedposts-post-title a', 'color', 'bg', 8 ),

	array( '.tags a,
		.wpl-count-text,
		.entry-content a,
		.comment__content a', 'color', 'bg', 4 ),

	array( '::-webkit-input-placeholder', 'color', 'bg', 4 ),
	array( ':-moz-placeholder', 'color', 'bg', 4 ),
	array( '::-moz-placeholder', 'color', 'bg', 4 ),
	array( ':-ms-input-placeholder', 'color', 'bg', 4 ),

	// Background - contrasts against bg - more contrast
	array( 'input[type="submit"],
		.btn,
		.search-submit,
		div#infinite-handle span button,
		div#infinite-handle span button:hover,
		.nav-menu ul li:hover > a,
		.nav-menu ul li.hover > a,
		.jetpack_subscription_widget.widget,
		.widget_blog_subscription.widget,
		.card__shadow:after,
		.comments-area:before,
		.sticky.card--text .card__wrap:after,
		.sticky.card--text .card__meta,
		.widget:before', 'background-color', 'bg', 8 ),

	array( '.more-link', 'background-color' ),

	// Border - contrasts against bg
	array( '.nav-menu > li > a:after,
		.card__title,
		.card__image,
		.comment__avatar img,
		.bypostauthor > .comment__article .comment__avatar,
		.widget,
		.jetpack_subscription_widget.widget:before,
		.widget_blog_subscription.widget:before,
		.singular .entry-header,
		.attachment .entry-heade,
		.nav-menu ul,
		.card--text .card__wrap:before,
		.card--text .card__wrap:after,
		.archive-navigation .current,
		.singular .entry-header:after,
		.attachment .entry-header:after,
		input,
		textarea,
		select,
		.site-footer,
		.content-quote:after,
		.archive-navigation .page-numbers.prev:before,
		.archive-navigation .page-numbers.next:after,
		.singular .site-header,
		.attachment .site-header', 'border-color', 'bg', 8 ),

	array( '.comments-area:before,
		.widget_jetpack_display_posts_widget h4 ~ p:after,
		.widget_recent_comments tr,
		.widget_authors > ul > li,
		.widget_rss li,
		.mobile-header-wrapper,
		.comment__alert,
		.comment-respond:not(.js) .comment-form input[type="text"],
		.comment-respond:not(.js) .comment-form input[type="email"],
		.comment-respond:not(.js) .comment-form input[type="url"],
		.comment-respond:not(.js) .comment-form textarea,
		.entry-content dl dt,
		.comment__content dl dt,
		.entry-content dl dd,
		.comment__content dl dd,
		.widget:before,
		.widget_recent_entries > ul > li + li:before,
  		.widget_recent_comments > ul > li + li:before,
  		body:not(.singular) .nav-menu > li > a:after,
  		body.singular .nav-menu > li > a:after', 'border-color', 'bg', 4 ),
), __( 'Accent' ) );

add_color_rule( 'extra', '#ffffff', array(
	array( '', 'color', 'bg' ),
) );

//Extra CSS
function gema_extra_css() { ?>
	#flickr_badge_wrapper {
		background-color: transparent;
	}

	@media only screen and (max-width: 1399px) {
		body.singular .nav-menu > li > a:before {
			background: transparent;
		}
	}

	@media only screen and (min-width: 900px) {
		.widget-area {
			background: transparent !important;
		}
	}

	@media only screen and (max-width: 899px) {
		.widget:before {
			background: transparent !important;
		}
	}

<?php }
add_theme_support( 'custom_colors_extra_css', 'gema_extra_css' );

//Additional palettes
add_color_palette( array(
	'#e3dbce',
	'#882436'
), __( 'Beige and Red' ) );

add_color_palette( array(
	'#31589a',
	'#ffffff',
), __( 'Blueprint' ) );

add_color_palette( array(
	'#d0cacf',
	'#421c39'
), __( 'Violet' ) );
