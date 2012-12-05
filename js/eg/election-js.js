jQuery(document).ready(function($){
	var children;
	var wrapper = '#election-guide-wrapper';
	var html_container = "";
	//$('#election-guide-wrapper').height($('#election-grid').height());
	$('.eg-item').bind({
		mouseenter: function(){
			children = $(this).children().children();
			//$(children[0]).removeClass('transparent');
			$(children[0]).css('z-index', '3');
			$(children[1]).removeClass('hidden').css('z-index', '2')
			//$(children[1]).removeClass('hidden');
		},
		mouseleave: function(){
			$(children[1]).addClass('hidden').css('z-index', '0')
			$(children[0]).css('z-index', '1')
		
		},
	});
  
	$(".eg-image").fancybox({
		'autoDimensions' : false,
		'width' : 740,
		'height' : 282
	});
});
