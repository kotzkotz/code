jQuery.zc = {
	'zhong':function (obj){
		obj.css({
			'top':($(window).height()-obj.height())/2,
			'left':($(window).width()-obj.width())/2,
			'position':'absolute'
		})

		return obj;
	}
}
