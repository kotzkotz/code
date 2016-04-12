/*
jquery插件模板
'plugin'为自定义函数名
'options'代表参数
'this.each()'里面是函数功能,参数的调用方法options.参数名
'return this'是方便链式操作
*/
;(function($){

	$.fn.plugin=function(options){
		var defaults = {
			//各种参数，各种属性
		}

		var options = $.extend(defaults,options);

		this.each(function(){
			//实现功能的代码
		});

		return this;
	}

})(jQuery);