<?php

class Ilmoittautuminen extends BaseModel {
    public $id, $kurssi_id, $oppilas_id;
    
    public function __construct($attributes) {
        parent::__construct($attributes);
    }
    
    public function talleta() {
        $query = DB::connection()->prepare(
                'INSERT INTO Ilmoittautuminen (kurssi_id, oppilas_id) '
                . 'VALUES (:kurssi_id, :oppilas_id)');
        $query->execute(array(
            'kurssi_id' => $this->kurssi_id,
            'oppilas_id' => $this->oppilas_id
        ));
    }
    
}
