$.Isotope.prototype._getMasonryGutterColumns = function() {
	var gutter = this.options.masonry && this.options.masonry.gutterWidth || 0;
	containerWidth = this.element.width();
	this.masonry.columnWidth = this.options.masonry && this.options.masonry.columnWidth || this.$filteredAtoms.outerWidth(true) || containerWidth;
	this.masonry.columnWidth += gutter;
	this.masonry.cols = Math.floor( ( containerWidth + gutter ) / this.masonry.columnWidth );
	this.masonry.cols = Math.max( this.masonry.cols, 1 );
};

$.Isotope.prototype._masonryReset = function() {
	this.masonry = {};
	this._getMasonryGutterColumns();
	var i = this.masonry.cols;
	this.masonry.colYs = [];
	while (i--) {
		this.masonry.colYs.push( 0 );
	}
};

$.Isotope.prototype._masonryResizeChanged = function() {
	var prevSegments = this.masonry.cols;
	this._getMasonryGutterColumns();
	return ( this.masonry.cols !== prevSegments );
};

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

	function capitalizeWord(word){
		return word.charAt(0).toUpperCase() + word.substr(1).toLowerCase();
	}

	function toTitleCase(str){
		if(str){
			return str.replace('_',' ').replace(/\w\S*/g,capitalizeWord);
		}
	}

	$(document).mailHider();

	var currentState = '/nounzein/all'
	,	$container = $('.gallery')
	,	$links = $('#MainMenu li a')
	,	$filters = $links.filter('.filter')
	,	$titles = $('#MainMenu>li h2 span').each(function(){
			var $t = $(this);
			$t.data('original',$t.html());
		})
	,	$Description = $('#Description')
	,	$About = $('#About')
	,	$lis = $('#MainMenu>li')
	,	$imageLinks = $('#Gallery li a')
	;



	$filters.add($imageLinks).each(function(){
		//var href = this.href.replace(document.location,'').replace(/\/$/,'').split('/');
		var $el = $(this);
		var href = this.href;
		$el.data('href',this.href);
		this.href = '#/'+this.id.split('-').join('/')
	})

	$lis.click(function(evt){
		$lis.not($(this).toggleClass('clicked')).removeClass('clicked');
	})

	$container.isotope({
		itemSelector : 'li',
		layoutMode : 'masonry',
		masonry: {
			columnWidth: 100 //function(containerWidth){return containerWidth;}
		,	gutterWidth: 5
		}
	});

	//$container.find('li a').colorbox({width:"75%", height:"75%"});

	var showImage = function(state){
		var id = '#'+state.join('-');
		var $l = $imageLinks.filter(id);
		var href= $l.data('href');
		var rel = (currentState.indexOf('/collection') == 0)?
				'.collection-'+$l.attr('rel')
				:(currentState.indexOf('/gallery') == 0)?
				'.gallery-'+state[1]
				:
				null
				;
		$.colorbox({
			href:href
		,	title:$l.attr('title')
		,	rel:rel
		,	onClosed:function(){
				$.History.go(currentState);
			}
		,	maxWidth:'100%'
		,	maxHeight:'100%'
		,	scalePhotos:true
		});
	}

	$.History.bind(function(s){
		state = s.split('/');
		state.shift();
		if(state[0]=='image'){
			showImage(state);
			return;
		}
		currentState = s;
		var title = state[state.length -1];
		var name = state.join('-');
		var id = '#'+name;
		var $link = $(id).addClass('current'); 
		var content = $link.html();
		var all = (title == 'all' ? true : false);
		var docTitle = toTitleCase(title);
		document.title = 'nounzein | ' + docTitle;
		if(!all){
			$('#'+state[0]+'-Title').html(toTitleCase(state[0] + ':' + docTitle));
		}else{
			$titles.each(function(){
				var $t = $(this);
				$t.html($t.data('original'))
			})
		}
		$links.not($link).removeClass('current');
		$lis.removeClass('clicked');
		if(all || title == 'about'){
			$About.show();
		}else{
			$About.hide();
		}
		if(title == 'About'){
			$container.isotope({filter:'none'});
			$About.show();
			return;
		}
		$Description.html(all ? '' : $link.next().html());
		$container.isotope({filter:(all?'*':'.'+name)});
	});

})
