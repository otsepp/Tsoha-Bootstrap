<?php

class Vastaus extends BaseModel {
    public $id, $kysely_id, $kysymys_id, $arvosana;
    
     public function __construct($attributes) {
         parent::__construct($attributes);
         $this->validators = $this->validate_arvosana();
     }
     
     
     public function validate_arvosana() {
         $errors = array();
         if (!filter_var($this->arvosana, FILTER_VALIDATE_INT)) {
             $errors[] = 'Arvosanan tulee olla kokonaisluku väliltä 0-5';
         } else if ($this->arvosana < 0 || $this->arvosana > 5) {
             $errors[] = 'Arvosanan tulee olla välillä 0-5';
         }
         return $errors;
     }
     
     public function talleta() {
         $query = DB::connection()->prepare(
                 'INSERT INTO Vastaus (kysely_id, kysymys_id, arvosana) '
                 .'VALUES (:kysely_id, :kysymys_id, :arvosana) '
                 .'RETURNING id');
         $query->execute(array(
             'kysely_id' => $this->kysely_id,
             'kysymys_id' => $this->kysymys_id,
             'arvosana' => $this->arvosana
         ));
        $row = $query->fetch();
        $this->id = $row['id'];
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
