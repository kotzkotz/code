<?php

/*
定义钩子的函数
*/
function add($hook, $actionFunc) {
 global $emHooks;
 if (!@in_array($actionFunc, $emHooks[$hook])) {
  $emHooks[$hook][] = $actionFunc;
 }
 return true;
}
/**
 * 执行挂在钩子上的函数,支持多参数 eg:doAction('post_comment', $author, $email, $url, $comment);
 *
 * @param string $hook
 */
function doo($hook) {
 global $emHooks;
 $args = array_slice(func_get_args(), 1);
 if (isset($emHooks[$hook])) {
  foreach ($emHooks[$hook] as $function) {
   $string = call_user_func_array($function, $args);
  }
 }
}


/*
使用方法就是  自己 定义一个 函数 然后在 出现 goods_head 的地方调用这个 koot_web 的函数
function koot_web()
{
	
}
add("goods_head","koot_web");
 
不管在那个地方出现的 goods_head 他都会调用所以定义在 add 里面的函数
doo("goods_head");
*/






?>