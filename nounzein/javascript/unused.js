		var max_size = 500;

	function resizeImage($img,$container){
		var _w = $img.width();
		var _h = $img.height();
		$container.data({'w':_w,'h':_h});
		$img.width(400).height(400);
	}

	function resizeImageProportional($img,$container){
		var w,h,_w,_h;
		_w = $img.width();
		_h = $img.height();
		if (_h > _w) {
			h = max_size;
			w = Math.ceil(_w / _h * max_size);
		} else {
			w = max_size;
			h = Math.ceil(_h / _w * max_size);
		}
		$container.data({'w':_w,'h':_h});
		$img.width(w).height(h);
	}

	function returnImage($img,$container){
		console.log($img);
		console.log($container);
		var w = $container.data().w,h = $container.data().h;
		$img.width(w).height(h);
	}

	$container.delegate('li a','click', function(e){
		e.preventDefault();
		var $a = $(this).toggleClass('large');;
		var $others = $container.find('li a.large').not($a);
		if($others.length){
			returnImage($others.first().find('img'),$others.first().removeClass('large'));
		}
		var $img = $a.find('img');
		if($a.hasClass('large')){
			if(!$img.hasClass('loaded')){
				var url = $a.addClass('loading').attr('href');
				var image = new Image();
				$(image).load(function(){
					resizeImage($img,$a);
					$a.removeClass('loading');
					$a.empty().append(this);
					$container.isotope('reLayout');
				}).attr('src',url);
			}else{
				resizeImage($img,$a);
				$container.isotope('reLayout');
			}
		}else{
			returnImage($img,$a);
			$container.isotope('reLayout');
		}
		return false;
	});