<?php

// 使用'who am i'，没有输出，需要去掉空格
var_dump(exec('whoami',$out,$status));
var_dump(system('whoami'));

?>