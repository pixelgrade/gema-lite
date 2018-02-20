// /* ====== SHARED VARS  - jQuery ====== */
// These depend on jQuery
var $window 			= $(window),
	windowHeight 		= $window.height(),
	windowWidth 		= $window.width(),
	latestKnownScrollY 	= window.scrollY,
	ticking 			= false,
	isTouchDevice   	= !!('ontouchstart' in window),
	$body               = $('body'),
	isWekbit            = ('WebkitAppearance' in document.documentElement.style) ? true : false,
	isIE                = typeof (is_ie) !== "undefined" || (!(window.ActiveXObject) && "ActiveXObject" in window),
	isiele10            = navigator.userAgent.match(/msie (9|([1-9][0-9]))/i);