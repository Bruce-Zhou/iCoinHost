// Parallax Slider
$(document).ready(function(){

	// Main Slider
		'use strict';
		var options = {
			autoPlay: true,
			nextButton: true,
			prevButton: true,
			navigationSkip: true,
			animateStartingFrameIn: true,
			autoPlayDelay:3000,
			pauseOnHover : false,
			transitionThreshold:1500,
			preloader: false,
			preloadTheseImages: [
			    "../images/slider/1.jpg",
			    "../images/slider/2.jpg",
			    "../images/slider/3.jpg"
			],
			reverseAnimationsWhenNavigatingBackwards : false,	
			preventDelayWhenReversingAnimations : true
		};
		try{
			var sequence = $("#sequence").sequence(options).data("sequence");
		}
		catch(err){}	
	$('.slide_bg').css({
		marginLeft: - ($(window).width() - $('.slide_section').outerWidth())/2,
		height: ($(window).height()),
		width : ($(window).width()) + 200
	}); 
	$('#sequence').css({
	  height: ($(window).height())
	 });

});

$( window ).resize(function() {
 $('.slide_bg').css({
  marginLeft: - ($(window).width() - $('.slide_section').outerWidth())/2,
  height: ($(window).height()),
  width : ($(window).width()) + 200
 });
 
 $('.slider_holder').css({
  height: ($(window).height())
 });
});