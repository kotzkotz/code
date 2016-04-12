索引
索引:是针对数据所建立的目录.
作用: 可以加快查询速度
负面影响: 降低了增删改的速度.

案例:
设有新闻表15列,10列上有索引,共500W行数据, 如何快速导入?
1:把空表的索引全部删除
2:导入数据
3:数据导入完毕后,集中建索引.

索引的创建原则:
1:不要过度索引
2:在where条件最频繁的列上加.
3:尽量索引散列值,过于集中的值加索引意义不大.

索引的类型
普通索引: index 仅仅是加快查询速度.
唯一索引: unique index 行上的值不能重复
主键索引: primary key 不能重复.
　　主键必唯一,但是唯一索引不一定是主键.
　　一张表上,只能有一个主键, 但是可以用一个或多个唯一索引.
全文索引 : fulltext index
(上述3种索引,都是针对列的值发挥作用,但全文索引,可以针对值中的某个单词,比如一篇文章,)

建立索引
可以在建表时,直接声明索引,即在列声明完毕后,声明索引.
例如下:
 create table test5 (
 id int,
 username varchar(20),
 school varchar(20),
 intro text,
 primary key (id),
 unique (username),
 index (school),
 fulltext (intro)
 ) engine myisam charset utf8;

查看一张表上所有索引
Show index from 表名 \G  #\G后面不需要加分号

建立索引
Alter table 表名 add index/unique/fulltext [索引名] (列名)
#alter table yld add index (password);
Alter table 表名 add primary key (列名)   #不要加索引名,因为主键只有一个
#CREATE INDEX可对表增加普通索引或UNIQUE索引。
create index 索引名 on 表 (列1,列名2);
CREATE UNIQUE INDEX index_name ON table_name (column_list)
#create index on yld(name);

删除索引
删除非主键索引:Alter table 表名 drop index 索引名;
删除主键: alter table 表名 drop primary key

查询是否使用索引
explain 可以帮助我们在不真正执行某个sql语句时，就执行mysql怎样执行，这样利用我们去分析sql指令.
explain select * from yld where id=1;

id: 1   								#查询序列号
select_type: SIMPLE 					#查询类型
table: emp								#查询表名
type: const       						#扫描方式all表示全表扫描
possible_keys: PRIMARY          		#可能使用到底索引
key: PRIMARY       						#真正使用的索引
key_len: 3 
ref: const
rows: 1                          		#扫描的行数
Extra:                             		#sql语句的额外信息


查看索引使用的情况:
show status like 'Handler_read%';
handler_read_key						#这个值表示使用索引查询到的次数。
handler_read_rnd_next					#这个值越高，说明查询低效。


关于全文索引的用法
Match (全文索引名) against ('keyword');
select * from articles where match(title) against('database'); 

关于全文索引的停止词
全文索引不针对非常频繁的词做索引,
如this, is, you, my等等.

全文索引:在mysql的默认情况下, 对于中文意义不大.
因为英文有空格,标点符号来拆成单词,进而对单词进行索引.
而对于中文,没有空格来隔开单词,mysql无法识别每个中文词.