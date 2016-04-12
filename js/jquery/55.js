//1、直接给jquery添加全局函数
/*jQuery.myalert = function (str){
	alert(str);
}

jQuery.myalert2 = function (str){
	alert(str);
}*/


//2、用extend()方法
/*jQuery.extend({
	myalert1:function (str){
		alert(str);
	},
	myalert2:function (str){
		alert(str);
	}
})*/


//3、使用命名空间
jQuery.zc = {
	myalert1:function (str){
		alert(str);
	},
	myalert2:function (str){
		alert(str);
	}
}