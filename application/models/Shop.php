<?php

namespace application\models;

use application\core\Model;
use application\lib\Upload;

class Shop extends Model {

    // Дії над Shop
    public function goodsUploadImage($path, $id, $name, $one = true) {
        if($one){
            $this->uploadImage($path, $id, $name);
        }elseif(!empty($path[0])){
//            $path = array_reverse($path);
            for ($i=0; $i < count($path); $i++) {
                $this->uploadImage($path[$i], $id, $i+$name);
            }
            return count($path);
        }
        return 0;
    }

    public function uploadImage($path, $id, $name){
        $image = new Upload($path);
//        $image->file_max_size = '20480';
        $image->image_x = 1080;
        $image->image_ratio_y = true;
        $image->image_ratio_crop = true;
        $image->image_resize = true;
        $image->auto_create_dir = true;
        $image->file_safe_name = false;
        $image->file_overwrite = true;
        $image->image_convert = 'jpg';
        $image->file_new_name_body   = $name;
        $image->process("materials/responsive/goods/$id");
    }

    public function countAdditImg($data, $id) {
        $params = [
            'id' => $id,
            'countAdditImg' => $data,
        ];
        $this->db->query("UPDATE goods SET countAdditImg = :countAdditImg WHERE id = :id", $params);
    }

    public function goodsAdd($goods) {
        if (isset($goods['dropshop'])) {
            $goods['dropshop'] = 1;
        }else {
            $goods['dropshop'] = 0;
        }
        if (isset($goods['options'])) {
            $goods['options'] = 1;
        }else {
            $goods['options'] = 0;
        }
        $params = [
            'id' => '',
            'diller' => $_SESSION['account']['id'],
            'name' => $goods['name'],
            'description' => $goods['description'],
            'options' => $goods['options'],
            'price' => $goods['price'],
            'category' => $goods['category'],
            'dropshop' => $goods['dropshop'],
            'addDate' => date('Y-m-d'),
            'countAdditImg' => 0,
        ];
        $values = implode(", :", array_keys($params));
        $this->db->query("INSERT INTO goods VALUES (:$values)", $params);
        return $this->db->lastInsertId($id = null);
    }

    public function categoryAdd($post) {
        $params = [
            'id' => '',
            'name' => $post['category'],
            'createdad' => $_SESSION['account']['id'],
            'status' => 1,
        ];
        $values = implode(", :", array_keys($params));
        $this->db->query("INSERT INTO category VALUES (:$values)", $params);
        return $this->db->lastInsertId($id = null);
    }

    public function editGoods($goods, $id, $goodsdata) {
        $where = 'id';
        $last = 'countAdditImg';
        $params = [
            'id' => $id,
            'name' => $goods['name'],
            'description' => $goods['description'],
            'price' => $goods['price'],
            'countAdditImg' => $goods['countAdditImg'],
        ];
        $valkeys = '';
        foreach ($params as $key => $value) {
            if ($key != $where) {
                if ($key == $last) {
                    $valkeys .= "$key= :$key";
                }else {
                    $valkeys .= "$key= :$key, ";
                }
            }
        }
        $this->db->query("UPDATE goods SET $valkeys WHERE $where = :$where", $params);
    }


    public function cleavegoodsAdd($datagoods, $post = false) {
        $params = [
            'id' => '',
            'idgoods' => $datagoods['id'],
            'idclient' => $_SESSION['account']['id'],
            'idsupplies' => $datagoods['diller'],
            'howgoods' => $post['howgoods'],
            'pricegoods' => $datagoods['price'],
            'data_add' => date('Y-m-d'),
            'status' => 0,

        ];
        $values = implode(", :", array_keys($params));
        $this->db->query("INSERT INTO cleave VALUES (:$values)", $params);
        return $this->db->lastInsertId($id = null);
    }

    public function ordergoodsAdd($datagoods, $post) {
        $params = [
            'id' => '',
            'idgoods' => $datagoods['id'],
            'idclient' => $_SESSION['account']['id'],
            'idsupplies' => $datagoods['diller'],
            'howgoods' => $post['howgoods'],
            'pricegoods' => $datagoods['price'],
            'data_add' => date('Y-m-d'),
            'numbankcard' => '',
            'numtransfer' => '',
            'SendIdGoods' => '',
            'messageclient' => '',
            'status' => 0,
        ];
        $values = implode(", :", array_keys($params));
        $this->db->query("INSERT INTO ordergoods VALUES (:$values)", $params);
        return $this->db->lastInsertId($id = null);
    }

    public function ordergoodsUpdate($data) {
        if (isset($data['paymentgoods_f'])) {
            $where = 'id';
            $last = 'status';
            $params = [
                'id' => $data['id'],
                'numbankcard' => $data['why-payment'],
                'numtransfer' => $data['numtransfer'],
                'messageclient' => $data['messageclient'],
                'status' => 1,
            ];
        }elseif (isset($data['orderYesgoods_f'])) {
            $where = 'id';
            $last = 'status';
            $dataorder = $this->dbSelectFromWhere('howgoods, idgoods', 'ordergoods', 'id', $data['id'], 'row')[0];
            $thisparams = [
                'id' => $dataorder['idgoods'],
                'remainder' => (int)$this->dbSelectFromWhere('many_opt_goods', 'goods', 'id', $dataorder['idgoods']) - (int)$dataorder['howgoods'],
            ];
            $this->db->query("UPDATE goods SET remainder = :remainder WHERE $where = :$where", $thisparams);
            $params = [
                'id' => $data['id'],
                'status' => 2,
            ];
        }elseif (isset($data['orderSendgoods_f'])) {
            $where = 'id';
            $last = 'status';
            $params = [
                'id' => $data['id'],
                'SendIdGoods' => $data['SendIdGoods'],
                'status' => 3,
            ];
        }

        $valkeys = '';
        foreach ($params as $key => $value) {
            if ($key != $where) {
                if ($key == $last) {
                    $valkeys .= "$key= :$key";
                }else {
                    $valkeys .= "$key= :$key, ";
                }
            }
        }
        $this->db->query("UPDATE ordergoods SET $valkeys WHERE $where = :$where", $params);
    }

    public function searchList($post){
        $vars = [];
        $data = $this->dbSelectAll('id, name, description, price, category', 'goods');
        foreach ($data as $key => $val) {
            if (mb_stripos($val['name'] .' '. $val['description'] .' '. $val['category'], $post) !== false) {
                $vars['list'][] = $val;
            }
        }
        return $vars;
    }
}