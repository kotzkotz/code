<?php
/****
燕十八 公益PHP讲堂

论  坛: http://www.zixue.it
微  博: http://weibo.com/Yshiba
YY频道: 88354001
****/



defined('ACC')||exit('Acc Deined');


class OGModel extends Model {
    protected $table = 'ordergoods';
    protected $pk = 'og_id';




    // 把订单的商品写入ordergoods表
    public function addOG($data) {
        if($this->add($data)) {
            $sql = 'update goods set goods_number = goods_number - ' . $data['goods_number'] . ' where goods_id = ' . $data['goods_id'];

            return $this->db->query($sql); // 减少库存
        }

        return false;

    }

}


