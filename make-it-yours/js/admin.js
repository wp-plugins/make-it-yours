jQuery(function($){
	$('.pick-color').live('click', function(){
		var thiz = $(this),
			el = thiz.prev().prev();
		$(thiz.prev().show()).farbtastic(function(color){
			el.val(color);
		});
		return false;
	});
	$(document).mousedown(function(){
		$('div.color-selector').each(function(){
			if( $(this).css('display') == 'block' )
				$(this).fadeOut();
		});
	});
});