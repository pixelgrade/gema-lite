(function ($) {
	$(document).ready(function () {
		var $noticeContainer = $( '.pixcare-notice__container' ),
			$noticeDownload = $noticeContainer.find( '.pixcare-notice--download' ),
			$noticeThankYou = $noticeContainer.find( '.pixcare-notice--thankyou' ),
			$button = $noticeDownload.find( '.js-handle-pixcare' ),
			buttonBox;

		if ( $button.length ) {
			buttonBox = $button[0].getBoundingClientRect();
			$button.css( 'width', buttonBox.right - buttonBox.left );
		}

		$button.on('click', function() {

			var downloadHeight = $noticeDownload.height(),
				thankyouHeight = $noticeThankYou.height();

			$noticeDownload.addClass('pixcare-notice--hidden' );
			$noticeDownload.height( downloadHeight );

			setTimeout(function() {
				$noticeDownload.height( thankyouHeight );
			}, 300);

			setTimeout( function() {
				$noticeThankYou.removeClass( 'pixcare-notice--hidden' ).css( 'position', 'static' );
				$noticeDownload.hide();
			}, 800);
		})

		// Send ajax on click of dismiss icon
		$noticeContainer.on( 'click', '.notice-dismiss', function() {
			ajaxDismiss( $(this) );
		});

		// Send ajax
		function ajaxDismiss( dismissElement ) {
			$.ajax({
				url: pixcareNotice.ajaxurl,
				type: 'post',
				data: {
					action: 'pixcare_download_dismiss_admin_notice',
					nonce_dismiss: $noticeContainer.find('#nonce-pixcare_download-dismiss').val()
				}
			})
		}
	});
})(jQuery);
