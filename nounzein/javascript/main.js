//email
(function($){
	$.fn.mailHider = function(replaceText){
		return $("a[href^=mailto]",this).each(function(){
			var token = this.rel;
			this.onmouseover = this.oncontextmenu = function(){
				this.href = this.href.split("?")[0].replace(token, "");
				this.onmouseover = this.oncontextmenu = null;
			}
			if(replaceText!==0){this.innerHTML = this.innerHTML.replace(token, '<b style="display:none">'+token+'</b>');}
		});
	}
})(jQuery);

jQuery(document).ready(function($){

	$(document).mailHider();



	var $container = $('.gallery'), $filters = $('#MainMenu li a.filter');

	$container.isotope({
		itemSelector : 'li',
		layoutMode : 'masonry',
		masonry: {
			columnWidth: 52
		}
	});

	$container.find('li a').colorbox({width:"75%", height:"75%"});

	$('#MainMenu li a.filter').click(function(e){
		e.preventDefault();
		var $el = $(this);
		var selector = $el.attr('data-filter');
		$filters.not($el.addClass('current')).removeClass('current');
		$container.isotope({filter: selector});
		return false;
	})
})
