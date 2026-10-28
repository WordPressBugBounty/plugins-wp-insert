/* Free resources slider: arrow buttons page through a scroll-snap track. */
( function () {
	function init( slider ) {
		var track = slider.querySelector( '.wp-insert-resources-track' );
		var prev = slider.querySelector( '.wp-insert-resources-prev' );
		var next = slider.querySelector( '.wp-insert-resources-next' );
		if ( ! track || ! prev || ! next ) {
			return;
		}
		var reduceMotion = window.matchMedia && window.matchMedia( '(prefers-reduced-motion: reduce)' ).matches;

		function step() {
			var item = track.querySelector( '.wp-insert-resources-item' );
			if ( ! item ) {
				return track.clientWidth;
			}
			var gap = parseFloat( window.getComputedStyle( track ).columnGap ) || 0;
			return item.getBoundingClientRect().width + gap;
		}

		function update() {
			var maxScroll = track.scrollWidth - track.clientWidth;
			prev.disabled = track.scrollLeft <= 1;
			next.disabled = track.scrollLeft >= maxScroll - 1;
			slider.classList.toggle( 'is-scrollable', maxScroll > 1 );
		}

		function go( direction ) {
			track.scrollBy( { left: direction * step(), behavior: reduceMotion ? 'auto' : 'smooth' } );
		}

		prev.addEventListener( 'click', function () { go( -1 ); } );
		next.addEventListener( 'click', function () { go( 1 ); } );
		track.addEventListener( 'scroll', update, { passive: true } );
		window.addEventListener( 'resize', update );
		update();
	}

	function ready() {
		var sliders = document.querySelectorAll( '.wp-insert-resources' );
		for ( var i = 0; i < sliders.length; i++ ) {
			init( sliders[ i ] );
		}
	}

	if ( document.readyState === 'loading' ) {
		document.addEventListener( 'DOMContentLoaded', ready );
	} else {
		ready();
	}
} )();
