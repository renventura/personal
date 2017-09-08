jQuery(document).ready(function($) {
	if ( typeof backstretch != 'undefined' ) {
		var hero = $( '.backstretch' );
		hero.backstretch( backstretch.url );
		// $( '.hero-content-wrap' ).height( Number( hero.height() - $( '#header-elements-wrap' ).height() ) );
	}
});