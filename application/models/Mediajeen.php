<?php

namespace application\models;

use application\core\Model;

class Mediajeen extends Model {

    public function deleteTwoProbilSql(){
        $context = $this->dbSQL("row", "SELECT * FROM located_village");
        foreach ($context as $key => $val) {
            $params = [
                'village' => $val['village']

            ];
            $id = $this->dbSQL("row", "SELECT * FROM located_village WHERE village = :village", $params);
            debug($id);

//            if () {
//
//                $params = [
//                    'id' => $val['id'],
//                    'village' => $newVal,
//                ];
//                $this->db->query("DELETE FROM located_village WHERE id = :id", $params);
//            }
        }
    }
}