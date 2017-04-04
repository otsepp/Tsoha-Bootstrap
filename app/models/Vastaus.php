<?php

class Vastaus extends BaseModel {
    public $id, $kysely_id, $kysymys_id, $arvosana;
    
     public function __construct($attributes) {
         parent::__construct($attributes);
     }
    
     public function poista($id) {
         $query = DB::connection()->prepare('DELETE FROM Vastaus WHERE kysymys_id=:id');
         $query->execute(array('id' => $id));
     }
     
     public static function kysymyksen_vastaukset($kysymys_id) {
         $query = DB::connection()->prepare('SELECT * FROM Vastaus WHERE kysymys_id=:id');
         $query->execute(array(
             'id' => $kysymys_id
         ));
         $rows = $query->fetchAll();
         $vastaukset = array();
         foreach($rows as $row) {
             $vastaukset[] = new Vastaus(array(
                'id' => $row['id'],
                'kysely_id' => $row['kysely_id'],
                'kysymys_id' => $row['kysymys_id'],
                'arvosana' => $row['arvosana']
             ));
         }
         return $vastaukset;
     }
     
}
