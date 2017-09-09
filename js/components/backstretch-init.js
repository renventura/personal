jQuery(document).ready(function($) {
	var backgrounds = $( '.backstretch' );
	$.each(backgrounds, function(key, element){
		container = $(element);
		var image = container.css('background-image');
		image = image.replace('url(','').replace(')','').replace(/\"/gi, "");
		container.backstretch(image);
	});
});