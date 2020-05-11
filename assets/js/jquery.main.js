// JavaScript Document

/**
 * 開閉機能
 */

( function() {
	$( function() {
		$( '.js-toggle-state' ).on( 'click' , toggleClassOpen );

		function toggleClassOpen() {
			$( '.js-toggle-state' ).toggleClass( 'is-open' );
		}
	} );
} ) ( jQuery );

/**
 * inView
 * jquery.inview.min.js
 */

( function() {
	$( '.animated' ).on( 'inview', function( event, isInView ) {
		if ( isInView ) { //表示領域に入った時
			var animateName = $( this ).data( 'animate' );
			$( this ).addClass( animateName );
		}
	});
} ) ( jQuery );
