<?php



class feed {
    public $title = '';  // channel的title
    public $link = '';   // channel的link
    public $description = '';   // channel的descrition;
    public $items = array();

    public $template = './feed.xml'; //xml模板
    protected $dom = null;
    protected $rss = null;

    public function __construct() {
        $this->dom = new DomDocument('1.0','utf-8');
        $this->dom->load($this->template);
        $this->rss = $this->dom->getElementsByTagName('rss')->item(0);
    }

    
    // 调用createItem,把所有的item节点都生成,再输出
    public function display() {
        $this->createChannel();
        $this->addItem($this->items);
        header('content-type: text/xml');
        echo $this->dom->savexml();
    }

    // 封装createChannel方法,用来创建Rss的唯一且必须的channel节点
    protected function createChannel() {
        $channel = $this->dom->createElement('channel');
        $channel->appendChild($this->createEle('title',$this->title));
        $channel->appendChild($this->createEle('link',$this->link));
        $channel->appendChild($this->createEle('description',$this->description));

        $this->rss->appendChild($channel);
    }

    // 封装addItem方法,把所有的商品增加到RSS里面去
    // $list是商品列表,是二维数据,每一行是一个商品
    protected function addItem($list) {
        foreach($list as $goods) {
            $this->rss->appendChild($this->createItem($goods));
        }
    }

    // 封装一个方法,用来造item
    protected function createItem($arr) {
        $item = $this->dom->createElement('item');
        foreach($arr as $k=>$v) {
            $item->appendChild($this->createEle($k,$v));
        }

        return $item;
    }
    
    // 封装一个方法,直接创建开如 <ele>some text</ele>这样的节点
    protected function createEle($name,$value) {
        $ele = $this->dom->createElement($name);
        $text = $this->dom->createTextNode($value);
        $ele->appendChild($text);

        return $ele;
    }
}


$conn = mysql_connect('localhost','root','root');
mysql_query('set names utf8',$conn);
mysql_query('use boolshop');

$sql = 'select goods_name as title,goods_brief as description from goods order by add_time desc limit 8';

$rs = mysql_query($sql,$conn);

$list = array();
while($row = mysql_fetch_assoc($rs)) {
    $list[] = $row;
}


$feed = new feed();
$feed->title = '布尔商城';
$feed->link = 'http://localhost/bool';
$feed->description = '这是商城的优惠信息集合';
$feed->items = $list;
$feed->display();

