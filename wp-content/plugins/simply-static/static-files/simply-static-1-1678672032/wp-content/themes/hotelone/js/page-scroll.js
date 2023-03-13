
/* Page Scroll JS
----------------------------------------------------------------*/
jQuery(document).ready(function ($) {
	
	$(window).scroll(function () {
		if ($(this).scrollTop() > 100) {
			$('.bottomScrollBtn').fadeIn();
		} else {
			$('.bottomScrollBtn').fadeOut();
		}
	});
	

	var stickyOffset = ($('.nav_sticky').offset() || { "top": NaN }).top;
	var navH = $('.nav_sticky').outerHeight();
	$(window).scroll(function () {
		if ($(window).scrollTop() >= stickyOffset){
			$('.nav_sticky').addClass('fixed');
			$('.nav-spacer').attr('hieght', navH + 'px'); 
		}else {
			$('.nav_sticky').removeClass('fixed');
			$('.nav-spacer').attr('hieght','0px');
		}
	});
	

	$('.bottomScrollBtn, .header_scroll_logo .custom-logo-link').click(function () {
		$("html, body").animate({
			scrollTop: 0
		}, 600);
		return false;
	});
	
	/* Bootstrap Tool Tip
	---------------------*/
	$( '[data-toggle="tooltip"], [rel="tooltip"]' ).tooltip();
});	