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
    
    public static function poista_kurssin_ilmoittautumiset($kurssi_id) {
        $query = DB::connection()->prepare("DELETE FROM Ilmoittautuminen WHERE kurssi_id=:kurssi_id");
        $query->execute(array('kurssi_id' => $kurssi_id));
    }
    
    public static function kurssin_ilmoittautumiset($id) {
        $query = DB::connection()->prepare("SELECT * FROM Ilmoittautuminen WHERE kurssi_id=:id");
        $query->execute(array('id' => $id));
        $rows = $query->fetchAll();
        
        $ilmoittautumiset = array();
        foreach ($rows as $row) {
            $ilmoittautumiset[] = new Ilmoittautuminen(array(
                'id' => $row['id'],
                'kurssi_id' => $row['kurssi_id'],
                'oppilas_id' => $row['oppilas_id']
            ));
        }
        return $ilmoittautumiset;
    }
    
}
