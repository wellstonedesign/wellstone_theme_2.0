// JavaScript Document

/**
 * 開閉機能
 */

document.addEventListener( 'DOMContentLoaded', function() {
	var targets = document.querySelectorAll( '.js-toggle-state' );
	for( var i = 0; i < targets.length; ++i ) {
		targets[i].onclick = toggleClassOpen;
	}

	function toggleClassOpen() {
		for( var i = 0; i < targets.length; ++i ) {
			targets[i].classList.toggle( 'is-open' );
		}
	}
} );
