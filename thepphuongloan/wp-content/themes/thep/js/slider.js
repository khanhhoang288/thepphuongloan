jQuery(document).ready(function($) {
	// Slider for category
	if ($('#carousel')){
		$('#carousel').bxSlider({
	      slideWidth: 180,
	      minSlides: 1,
	      maxSlides: 5,
	      slideMargin: 10
	    });
	}
	// Workaround for LightBox
	// jQuery("iframe").contents().each(function(r,e){
	// 	var z= e.body;
	// 	if (z){
	// 		z.style.textAlign='center';
	// 	}
	// });
});