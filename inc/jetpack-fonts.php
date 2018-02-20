<?php

add_filter( 'typekit_add_font_category_rules', function( $category_rules ) {

	TypekitTheme::add_font_category_rule( $category_rules, 'body-text',
		'strong',
		array(
			array( 'property' => 'font-weight', 'value' => 'bold' ),
		)
	);

	TypekitTheme::add_font_category_rule( $category_rules, 'body-text',
		'body',
		array(
			array( 'property' => 'font-weight', 'value' => '200' ),
			array( 'property' => 'font-family', 'value' => '"Montserrat", sans-serif' ),
			array( 'property' => 'font-size', 'value' => '18px' ),
		)
	);

	TypekitTheme::add_font_category_rule( $category_rules, 'body-text',
		'body',
		array(
			array( 'property' => 'font-size', 'value' => '16px' ),
		),
		array(
			'only screen and (min-width: 740px)',
		)
	);

	TypekitTheme::add_font_category_rule( $category_rules, 'body-text',
		'.bold,
		b,
		strong',
		array(
			array( 'property' => 'font-weight', 'value' => '700' ),
		)
	);

	TypekitTheme::add_font_category_rule( $category_rules, 'body-text',
		'.italic,
		em,
		i,
		small',
		array(
			array( 'property' => 'font-style', 'value' => 'italic' ),
		)
	);

	TypekitTheme::add_font_category_rule( $category_rules, 'body-text',
		'.comment__content blockquote,
		.entry-content blockquote',
		array(
			array( 'property' => 'font-weight', 'value' => '700' ),
		)
	);

	TypekitTheme::add_font_category_rule( $category_rules, 'headings',
		'.h1,
		h1',
		array(
			array( 'property' => 'font-size', 'value' => '23px' ),
		)
	);

	TypekitTheme::add_font_category_rule( $category_rules, 'headings',
		'h1,
		h2,
		h3,
		.h1,
		.h2,
		.comment-reply-title,
		.h3,
		h4,
		h5,
		h6,
		.h4,
		.h5,
		.h6',
		array(
			array( 'property' => 'font-family', 'value' => '"Montserrat", sans-serif' ),
		)
	);

	TypekitTheme::add_font_category_rule( $category_rules, 'headings',
		'h1,
		h2,
		h3,
		.h1,
		.h2,
		.comment-reply-title,
		.h3',
		array(
			array( 'property' => 'font-weight', 'value' => '400' ),
		)
	);

	TypekitTheme::add_font_category_rule( $category_rules, 'headings',
		'h4,
		h5,
		h6,
		.h4,
		.h5,
		.h6',
		array(
			array( 'property' => 'font-weight', 'value' => '200' ),
		)
	);

	TypekitTheme::add_font_category_rule( $category_rules, 'headings',
		'h2,
		.h2,
		.comment-reply-title',
		array(
			array( 'property' => 'font-size', 'value' => '20px' ),
		)
	);

	TypekitTheme::add_font_category_rule( $category_rules, 'headings',
		'h3,
		.h3',
		array(
			array( 'property' => 'font-size', 'value' => '18px' ),
		)
	);

	TypekitTheme::add_font_category_rule( $category_rules, 'headings',
		'h4,
		.h4',
		array(
			array( 'property' => 'font-size', 'value' => '14px' ),
		)
	);

	TypekitTheme::add_font_category_rule( $category_rules, 'headings',
		'h5,
		h6,
		.h5,
		.h6',
		array(
			array( 'property' => 'font-size', 'value' => '12px' ),
		)
	);

	TypekitTheme::add_font_category_rule( $category_rules, 'body-text',
		'.wp-caption-text',
		array(
			array( 'property' => 'font-size', 'value' => '14px' ),
		)
	);

	TypekitTheme::add_font_category_rule( $category_rules, 'headings',
		'.archive-title',
		array(
			array( 'property' => 'font-family', 'value' => '"Abril Fatface", serif' ),
			array( 'property' => 'font-size', 'value' => '100px' ),
		)
	);

	TypekitTheme::add_font_category_rule( $category_rules, 'headings',
		'.archive-title--search',
		array(
			array( 'property' => 'font-size', 'value' => '50px' ),
		)
	);

	TypekitTheme::add_font_category_rule( $category_rules, 'headings',
		'.site-title',
		array(
			array( 'property' => 'font-size', 'value' => '90px' ),
		),
		array(
			'only screen and (min-width: 900px)',
		)
	);

	TypekitTheme::add_font_category_rule( $category_rules, 'headings',
		'.site-title',
		array(
			array( 'property' => 'font-family', 'value' => '"Abril Fatface", serif' ),
			array( 'property' => 'font-size', 'value' => '180px' ),
		)
	);

	TypekitTheme::add_font_category_rule( $category_rules, 'body-text',
		'.main-navigation',
		array(
			array( 'property' => 'font-size', 'value' => '30px' ),
			array( 'property' => 'font-weight', 'value' => '200' ),
		)
	);

	TypekitTheme::add_font_category_rule( $category_rules, 'body-text',
		'.main-navigation [class*="current-"] > a',
		array(
			array( 'property' => 'font-weight', 'value' => '300' ),
		)
	);

	TypekitTheme::add_font_category_rule( $category_rules, 'body-text',
		'.singular .nav-menu',
		array(
			array( 'property' => 'font-size', 'value' => '18px' ),
			array( 'property' => 'font-weight', 'value' => '200' ),
		),
		array(
			'only screen and (min-width: 900px)',
		)
	);

	TypekitTheme::add_font_category_rule( $category_rules, 'body-text',
		'.nav-menu li:hover > a,
		.nav-menu li:hover:after',
		array(
			array( 'property' => 'font-weight', 'value' => '300' ),
		),
		array(
			'only screen and (min-width: 900px)',
		)
	);

	TypekitTheme::add_font_category_rule( $category_rules, 'body-text',
		'.nav-menu ul',
		array(
			array( 'property' => 'font-size', 'value' => '16px' ),
		),
		array(
			'only screen and (min-width: 900px)',
		)
	);

	TypekitTheme::add_font_category_rule( $category_rules, 'body-text',
		'.nav-menu ul li:hover > a',
		array(
			array( 'property' => 'font-weight', 'value' => '100' ),
		),
		array(
			'only screen and (min-width: 900px)',
		)
	);

	TypekitTheme::add_font_category_rule( $category_rules, 'body-text',
		'.singular .nav-menu',
		array(
			array( 'property' => 'font-size', 'value' => '14px' ),
		),
		array(
			'only screen and (min-width: 900px) and (max-width: 1399.9px)',
		)
	);

	TypekitTheme::add_font_category_rule( $category_rules, 'body-text',
		'.singular .nav-menu > li,
		.singular .nav-menu li:hover > a,
		.singular .nav-menu li:hover:after',
		array(
			array( 'property' => 'font-weight', 'value' => '400' ),
		),
		array(
			'only screen and (min-width: 900px) and (max-width: 1399.9px)',
		)
	);

	TypekitTheme::add_font_category_rule( $category_rules, 'body-text',
		'.main-navigation',
		array(
			array( 'property' => 'font-size', 'value' => '18px' ),
			array( 'property' => 'font-weight', 'value' => '100' ),
		),
		array(
			'not screen and (min-width: 900px)',
		)
	);

	TypekitTheme::add_font_category_rule( $category_rules, 'body-text',
		'.main-navigation .sub-menu,
		.main-navigation .children',
		array(
			array( 'property' => 'font-size', 'value' => '20px' ),
		),
		array(
			'not screen and (min-width: 900px)',
		)
	);

	TypekitTheme::add_font_category_rule( $category_rules, 'body-text',
		'.main-navigation',
		array(
			array( 'property' => 'font-size', 'value' => '24px' ),
		),
		array(
			'only screen and (min-width: 480px)',
		)
	);

	TypekitTheme::add_font_category_rule( $category_rules, 'body-text',
		'.sub-menu,
		.children',
		array(
			array( 'property' => 'font-size', 'value' => '16px' ),
		),
		array(
			'only screen and (min-width: 480px)',
		)
	);

	TypekitTheme::add_font_category_rule( $category_rules, 'body-text',
		'.site-footer',
		array(
			array( 'property' => 'font-size', 'value' => '14px' ),
		)
	);

	TypekitTheme::add_font_category_rule( $category_rules, 'headings',
		'.site-info a',
		array(
			array( 'property' => 'font-weight', 'value' => '400' ),
		)
	);

	TypekitTheme::add_font_category_rule( $category_rules, 'body-text',
		'.footer-menu a',
		array(
			array( 'property' => 'font-weight', 'value' => '300' ),
		)
	);

	TypekitTheme::add_font_category_rule( $category_rules, 'body-text',
		'.card--text .btn,
		.card--text .search-submit,
		.card--text div#infinite-handle span button,
		div#infinite-handle span .card--text button,
		.card--text .more-link',
		array(
			array( 'property' => 'font-weight', 'value' => '400' ),
		)
	);

	TypekitTheme::add_font_category_rule( $category_rules, 'headings',
		'.card__title h2',
		array(
			array( 'property' => 'font-size', 'value' => '20px' ),
		)
	);

	TypekitTheme::add_font_category_rule( $category_rules, 'body-text',
		'.comment__links,
		.comment-reply-title small,
		.edit-link',
		array(
			array( 'property' => 'font-size', 'value' => '12px' ),
			array( 'property' => 'font-style', 'value' => 'normal' ),
			array( 'property' => 'font-weight', 'value' => '200' ),
		)
	);

	TypekitTheme::add_font_category_rule( $category_rules, 'body-text',
		'.intro',
		array(
			array( 'property' => 'font-size', 'value' => '18px' ),
			array( 'property' => 'font-weight', 'value' => '400' ),
		)
	);

	TypekitTheme::add_font_category_rule( $category_rules, 'body-text',
		'.dropcap',
		array(
			array( 'property' => 'font-size', 'value' => '54px' ),
			array( 'property' => 'font-weight', 'value' => '400' ),
		)
	);

	TypekitTheme::add_font_category_rule( $category_rules, 'body-text',
		'.comment,
		.pingback',
		array(
			array( 'property' => 'font-size', 'value' => '14px' ),
		)
	);

	TypekitTheme::add_font_category_rule( $category_rules, 'body-text',
		'.comment__author',
		array(
			array( 'property' => 'font-size', 'value' => '16px' ),
			array( 'property' => 'font-weight', 'value' => '300' ),
		)
	);

	TypekitTheme::add_font_category_rule( $category_rules, 'body-text',
		'.comment__alert',
		array(
			array( 'property' => 'font-weight', 'value' => '900' ),
		)
	);

	TypekitTheme::add_font_category_rule( $category_rules, 'body-text',
		'.comment-respond:not(.js) .comment-form input[type="text"],
		.comment-respond:not(.js) .comment-form input[type="email"],
		.comment-respond:not(.js) .comment-form input[type="url"],
		.comment-respond:not(.js) .comment-form textarea',
		array(
			array( 'property' => 'font-size', 'value' => '14px' ),
			array( 'property' => 'font-weight', 'value' => '200' ),
		)
	);

	TypekitTheme::add_font_category_rule( $category_rules, 'body-text',
		'.form-submit input[type="submit"]',
		array(
			array( 'property' => 'font-size', 'value' => '16px' ),
			array( 'property' => 'font-weight', 'value' => '200' ),
		)
	);

	TypekitTheme::add_font_category_rule( $category_rules, 'body-text',
		'.entry-content dl dt,
		.comment__content dl dt,
		.entry-content ul ol > li:before,
		.comment__content ul .entry-content ol > li:before,
		.entry-content ul .comment__content ol > li:before,
		.comment__content ul ol > li:before,
		.entry-content ol > li:before,
		.comment__content ol > li:before',
		array(
			array( 'property' => 'font-weight', 'value' => 'bold' ),
		)
	);

	TypekitTheme::add_font_category_rule( $category_rules, 'body-text',
		'.content-quote',
		array(
			array( 'property' => 'font-size', 'value' => '20px' ),
			array( 'property' => 'font-weight', 'value' => '400' ),
		)
	);

	TypekitTheme::add_font_category_rule( $category_rules, 'body-text',
		'.content-quote cite',
		array(
			array( 'property' => 'font-size', 'value' => '16px' ),
			array( 'property' => 'font-style', 'value' => 'normal' ),
		)
	);

	TypekitTheme::add_font_category_rule( $category_rules, 'body-text',
		'.tags a',
		array(
			array( 'property' => 'font-size', 'value' => '12px' ),
			array( 'property' => 'font-weight', 'value' => '200' ),
		)
	);

	TypekitTheme::add_font_category_rule( $category_rules, 'body-text',
		'.nav-links',
		array(
			array( 'property' => 'font-size', 'value' => '16px' ),
			array( 'property' => 'font-weight', 'value' => '400' ),
		)
	);

	TypekitTheme::add_font_category_rule( $category_rules, 'body-text',
		'.archive-navigation .current',
		array(
			array( 'property' => 'font-size', 'value' => '20px' ),
		)
	);

	TypekitTheme::add_font_category_rule( $category_rules, 'body-text',
		'.archive-navigation .page-numbers.next:hover,
		.archive-navigation .page-numbers.prev:hover',
		array(
			array( 'property' => 'font-size', 'value' => '16px' ),
		)
	);

	TypekitTheme::add_font_category_rule( $category_rules, 'body-text',
		'.widget',
		array(
			array( 'property' => 'font-size', 'value' => '14px' ),
		)
	);

	TypekitTheme::add_font_category_rule( $category_rules, 'body-text',
		'.widget_recent_entries a,
		.widget_recent_comments a,
		.milestone-widget .milestone-message,
		.widget_rss a.rsswidget,
		.widget_goodreads a',
		array(
			array( 'property' => 'font-weight', 'value' => '400' ),
		)
	);

	TypekitTheme::add_font_category_rule( $category_rules, 'body-text',
		'.widget_recent_entries .post-date',
		array(
			array( 'property' => 'font-size', 'value' => '12px' ),
		)
	);

	TypekitTheme::add_font_category_rule( $category_rules, 'body-text',
		'.widget_categories li',
		array(
			array( 'property' => 'font-weight', 'value' => '300' ),
		)
	);

	TypekitTheme::add_font_category_rule( $category_rules, 'body-text',
		'.widget_categories a',
		array(
			array( 'property' => 'font-weight', 'value' => '200' ),
		)
	);

	TypekitTheme::add_font_category_rule( $category_rules, 'body-text',
		'.widget_recent_comments .recentcommentstextend a:not(:last-of-type)',
		array(
			array( 'property' => 'font-size', 'value' => '12px' ),
			array( 'property' => 'font-weight', 'value' => '400' ),
		)
	);

	TypekitTheme::add_font_category_rule( $category_rules, 'headings',
		'.widget_jetpack_display_posts_widget .jetpack-display-remote-posts h4',
		array(
			array( 'property' => 'font-size', 'value' => '14px' ),
		)
	);

	TypekitTheme::add_font_category_rule( $category_rules, 'headings',
		'.widget_jetpack_display_posts_widget h4',
		array(
			array( 'property' => 'font-weight', 'value' => '400' ),
		)
	);

	TypekitTheme::add_font_category_rule( $category_rules, 'body-text',
		'.jetpack_subscription_widget #subscribe-text p,
		.widget_blog_subscription #subscribe-text p',
		array(
			array( 'property' => 'font-size', 'value' => '12px' ),
		)
	);

	TypekitTheme::add_font_category_rule( $category_rules, 'body-text',
		'.jetpack_subscription_widget input[type="submit"],
		.widget_blog_subscription input[type="submit"]',
		array(
			array( 'property' => 'font-size', 'value' => '14px' ),
			array( 'property' => 'font-weight', 'value' => '700' ),
		)
	);

	TypekitTheme::add_font_category_rule( $category_rules, 'headings',
		'.singular .site-title,
		.attachment .site-title',
		array(
			array( 'property' => 'font-size', 'value' => '32px' ),
		),
		array(
			'only screen and (min-width: 900px) and (max-width: 1399.9px)',
		)
	);

	TypekitTheme::add_font_category_rule( $category_rules, 'headings',
		'.singular .entry-title,
		.attachment .entry-title',
		array(
			array( 'property' => 'font-size', 'value' => '32px' ),
		),
		array(
			'only screen and (min-width: 400px) and (max-width: 899.9px)',
		)
	);

	TypekitTheme::add_font_category_rule( $category_rules, 'body-text',
		'.entry-meta',
		array(
			array( 'property' => 'font-size', 'value' => '10px' ),
			array( 'property' => 'font-weight', 'value' => '300' ),
		)
	);

	TypekitTheme::add_font_category_rule( $category_rules, 'body-text',
		'.more-link',
		array(
			array( 'property' => 'font-size', 'value' => '16px' ),
		)
	);

	TypekitTheme::add_font_category_rule( $category_rules, 'body-text',
		'.page-links',
		array(
			array( 'property' => 'font-weight', 'value' => '400' ),
		)
	);

	return $category_rules;
} );
