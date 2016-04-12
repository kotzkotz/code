/*
需求：
开发一个插件：要求奇数行的颜色是#38a38a，偶数行的颜色是#09f,当鼠标移动到当前行的时候，当前行的颜色变成yellow，当鼠标移开时还是显示原来的颜色
*/
;(function($){

	$.fn.table=function(options){
		var defaults = {
			//各种参数，各种属性
			evenRowClass:'evenRow',
			oddRowClass:'oddRow',
			currentRowClass:'currentRow',
			eventType:'mouseover',
			oddType:'mouseout'
		}

		var options = $.extend(defaults,options);

		this.each(function(){
			//实现功能的代码
			var _this = $(this);
			_this.find('tr:even').addClass(options.evenRowClass);
			_this.find('tr:odd').addClass(options.oddRowClass);
			_this.find('tr').bind(options.eventType,function (){
				$(this).addClass(options.currentRowClass);
			}).bind(options.oddType,function (){
				$(this).removeClass(options.currentRowClass);
			})
		});

		return this;
	}

})(jQuery);