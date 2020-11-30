(function() {
	
$('.chrt-page-grids').each(function() {
	
	$(this).on('click', '.maximize', function (event) {
		
		$(this).offsetParent('div.chrt-page-grids').toggleClass('fullscreen');
		
		if($(this).offsetParent('div.chrt-page-grids').hasClass('fullscreen')){
			$(this).offsetParent('div.chrt-page-grids').animate({ 'zoom': 1.2 }, 1500);
		}
		else{
			$(this).offsetParent('div.chrt-page-grids').animate({ 'zoom': 1 }, 1500);
		}
    });
	
});	
})(jQuery);