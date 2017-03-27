<?php

class Opettaja extends BaseModel {
    public $id, $laitos_id, $nimi;
    
    public function __construct($attributes) {
        parent::__construct($attributes);
    }
   
    
    public static function laitoksenOpettajat($laitos_id) {
        $query = DB::connection()->prepare('SELECT * FROM Opettaja WHERE laitos_id=:id');
        $query->execute(array('id' => $laitos_id));
        $rows = $query->fetchAll();
        return self::luoOpettajat($rows);
    }
    
    public static function kaikki() {
        $query = DB::connection()->prepare('SELECT * FROM Opettaja');
        $query->execute();
        $rows = $query->fetchAll();
        return self::luoOpettajat($rows);
    }
    
    public static function etsi($id) {
        $query = DB::connection()->prepare('SELECT * FROM Opettaja WHERE id=:id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();
        
        $opettaja = NULL;
        
        if ($row) {
            $opettaja = new Opettaja(array(
                'id' => $row['id'],
                'laitos_id' => $row['laitos_id'],
                'nimi' => $row['nimi']
            ));
        }
        return $opettaja;
    }
    
     private static function luoOpettajat($rows) {
        $opettaja = array();
        foreach($rows as $row) {
            $opettajat[] = new Opettaja(array(
                'id' => $row['id'],
                'laitos_id' => $row['laitos_id'],
                'nimi' => $row['nimi']
            ));
        }
        return $opettajat;
    }
    
}
