/* Javascript Document */
/* Created by redAtom Studios @ 2012 */

/**/// User customizable options
/**/   var slideSpeed = 300; 	// Speed of sliding animation in milliseconds, larger numbers mean slower speeds
/**/   var holdTime = 8000;		// Time to hold each slide in milliseconds
/**/   var currentSlide = 1;	// Slide to start at, make sure this is less than the total number of slides
/**/// End of user customization options


// System variables, no need to be modifiying these unless slider core needs to be altered.
var slideWidth = 0, slideCount = 0, sliderState;

var setupSlider = function() {
	var totalWidth = 0;
	var slideTrain = $('div#slider ul').children('li');
	if(slideTrain) {
		slideCount = slideTrain.length;
	
		if(slideCount <= 1) {
			return false;
		}
	
		slideWidth = $(slideTrain[0]).outerWidth(true);
		totalWidth = slideWidth*slideCount;
	
		if(totalWidth) {
			$('div#slider ul').width(totalWidth).css({left: -slideWidth*(currentSlide - 1) + 'px'});
			$('div#slider').prepend('<img class="slideControl" id="slideControlLeft" src="' + siteBase + 'resources/images/slider/sliderLeft.png" alt="Previous" />' + 
			'<img class="slideControl" id="slideControlRight" src="' + siteBase + 'resources/images/slider/sliderRight.png" alt="Next" />')
			gotoSlide(currentSlide);
		} else {
			setTimeout(setupSlider, 100);
		}
	}
}

var gotoSlide = function(slide) {
	if(sliderState) {
		clearTimeout(sliderState);
	}

	if(slide > slideCount) {
		slide %= slideCount;
	} else if(slide <= 0) {
		slide = slideCount;
	}

	$('div#slider ul').animate({left: -slideWidth*(slide - 1) + 'px'}, slideSpeed);
	$('div#slider ul li').queue('fx', []).animate({opacity: 0});
	$($('div#slider ul li')[slide - 1]).queue('fx', []).animate({opacity: 1});

	currentSlide = slide;
	sliderState = setTimeout("gotoSlide(++currentSlide)", holdTime + slideSpeed);
}

jQuery(document).ready(function($){
	setupSlider();
	$('#slider').on('click', '#slideControlRight', function(){
		gotoSlide(++currentSlide);
	}).on('click', '#slideControlLeft', function(){
		gotoSlide(--currentSlide);
	});
});